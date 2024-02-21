<?php

namespace App\Helpers;

use App\Models\Settings;
use App\Models\User;
use App\Models\Timing;
use App\Models\Plans;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Support\Facades\Mail;
use Str;

class helper

{

    public static function webinfo($restaurant)
    {

        $webinfo = Settings::select(\DB::raw("CONCAT('" . asset('/storage/app/public/images/') . "/', logo) AS image"), \DB::raw("CONCAT('" . asset('/storage/app/public/images/') . "/', favicon) AS favicon"), 'copyright', 'address', 'timezone', 'contact', 'currency', 'currency_position', 'email', 'description', 'website_title', 'meta_title', 'meta_description', \DB::raw("CONCAT('" . asset('/storage/app/public/images/') . "/', og_image) AS og_image"), 'facebook_link', 'twitter_link', 'instagram_link', 'linkedin_link', 'delivery_type', 'whatsapp_widget', 'whatsapp_message', 'item_message', 'primary_color', 'secondary_color', 'language','template')
            ->where('restaurant', $restaurant)
            ->first();

        return $webinfo;
    }
    public static function timings($restaurant)
    {
        $timings = Timing::where('restaurant',@$restaurant)->get();
        return $timings;
    }
    public static function is_store_closed($restaurant)
    {
        date_default_timezone_set(Helper::webinfo(@$restaurant)->timezone);
        $todaydata = Timing::where('restaurant',@$restaurant)->where('day',date("l",strtotime(date('d-m-Y'))))->first();
            
            $current_time = \DateTime::createFromFormat('H:i a', date("h:i a"));
            $open_time = \DateTime::createFromFormat('H:i a', $todaydata->open_time);
            $close_time = \DateTime::createFromFormat('H:i a', $todaydata->close_time);
            if ($current_time > $open_time && $current_time < $close_time && $todaydata->is_always_close == 2) {
                $is_store_closed = 2;
            } else {
                $is_store_closed = 1;
            }
        return $is_store_closed;
    }

    public static function image_path($image)
    {
        $path = asset('storage/app/public/images/not-found');
        if (Str::contains($image, 'res')) {
            $path = asset('storage/app/public/vendor/' . $image);
        }
        if (Str::contains($image, 'item')) {
            $path = asset('storage/app/public/item/' . $image);
        }
        if (Str::contains($image, 'logo')) {
            $path = asset('storage/app/public/images/' . $image);
        }
        if (Str::contains($image, 'favicon')) {
            $path = asset('storage/app/public/images/' . $image);
        }
        if (Str::contains($image, 'og')) {
            $path = asset('storage/app/public/images/' . $image);
        }
        return $path;
    }

    public static function currency_format($price, $restaurant)
    {
        $currency = Settings::select('currency', 'currency_position')->where('restaurant', $restaurant)->first();
        $position = strtolower($currency->currency_position);
        if ($position == "left") {
            return $currency->currency . number_format($price, 2);
        }
        if ($position == "right") {
            return number_format($price, 2) . $currency->currency;
        }
    }

    public static function getrestaurant($restaurant)
    {

        $restaurantinfo = User::where('slug', $restaurant)->first();

        return $restaurantinfo;
    }

    public static function restauranttime($restaurant)
    {

        $webinfo = Settings::select('timezone')
            ->where('restaurant', $restaurant)
            ->first();

        date_default_timezone_set($webinfo->timezone);

        $t = date('d-m-Y');

        $time = Timing::select('close_time')
            ->where('restaurant', $restaurant)
            ->where('day', date("l", strtotime($t)))
            ->first();

        $txt = "Opened until " . date("D", strtotime($t)) . " " . $time->close_time . "";

        return $txt;
    }

    public static function admininfo()
    {

        $admininfo = Settings::select('website_title', 'copyright', \DB::raw("CONCAT('" . asset('/storage/app/public/images/') . "/', logo) AS image"), \DB::raw("CONCAT('" . asset('/storage/app/public/images/') . "/', favicon) AS favicon"))
            ->where('restaurant', 1)
            ->first();

        return $admininfo;
    }

    public static function checkplan($restaurant)
    {
        date_default_timezone_set(Helper::webinfo($restaurant)->timezone);
        $restaurantinfo = User::where('id', $restaurant)->first();
        if ($restaurantinfo->is_verified == "2") {
            if ($restaurantinfo->is_available == "2") {
                return response()->json(['status' => 2, 'message' => trans('labels.restaurant_is_unavailable')], 200);
            }
            $checkplan = Plans::where('name', $restaurantinfo->plan)->first();
            $checkorder = Order::where('restaurant', $restaurant)->count();
            $checkitem = Item::where('restaurant', $restaurant)->count();

            if (!empty($checkplan)) {

                if (@$checkplan->plan_period == "1") {
                    $purchasedate = date("Y-m-d", strtotime($restaurantinfo->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' + 30 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->plan_period == "2") {
                    $purchasedate = date("Y-m-d", strtotime($restaurantinfo->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +90 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->plan_period == "3") {
                    $purchasedate = date("Y-m-d", strtotime($restaurantinfo->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +180 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->plan_period == "4") {
                    $purchasedate = date("Y-m-d", strtotime($restaurantinfo->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +365 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->item_unit != -1) {
                    if (@$checkitem >= @$checkplan->item_unit) {
                        return response()->json(['status' => 2, 'message' => trans('messages.item_unit_exceeded')], 200);
                    } else {
                        if (@$checkplan->order_limit != -1) {
                            if ($checkorder >= @$checkplan->order_limit) {
                                return response()->json(['status' => 2, 'message' => trans('messages.order_limit_exceeded')], 200);
                            } else {
                                return response()->json(['status' => 1], 200);
                            }
                        } else {
                            return response()->json(['status' => 1], 200);
                        }
                    }
                } else {
                    return response()->json(['status' => 1], 200);
                }
            } else {
                return response()->json(['status' => 2, 'message' => trans('labels.restaurant_is_unavailable')], 200);
            }
        } else {
            return response()->json(['status' => 1], 200);
        }
    }

    public static function create_order_invoice($emaildata, $orderdata, $itemdata)
    {
        $data = ['title' => trans('labels.order_placed'), 'email' => $emaildata->email, 'name' => $emaildata->name, 'order_number' => $orderdata->order_number, 'orderdata' => $orderdata, 'itemdata' => $itemdata, 'logo' => Helper::webinfo($orderdata->restaurant)->image];

        try {
            Mail::send('Email.emailinvoice', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 1;
        }
    }

    public static function send_pass($email, $name, $password, $id){
        $data = ['title'=>trans('labels.new_password'),'email'=>$email,'name'=>$name,'password'=>$password,'logo'=>Helper::webinfo($id)->image];
        try {
            Mail::send('Email.email',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
