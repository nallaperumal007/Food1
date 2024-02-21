<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plans;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\SystemAddons;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Helper;

class PlansController extends Controller
{
    public function index()
    {
        $plans = Plans::where('is_deleted', 2)->orderBy('id', 'DESC')->get();
        return view('admin.plans.index', compact('plans'));
    }
    public function add()
    {
        return view('admin.plans.add');
    }
    public function store(Request $request)
    {
        $checkfreeplan = Plans::where('price', (float)$request->price)->first();

        if (!empty($checkfreeplan)) {
            if ($request->price == "0") {
                return Redirect()->back()->with('error', trans('messages.free_plan_exist'));
            } else {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'description' => 'required',
                        'features' => 'required',
                        'price' => 'required',
                        'item_unit' => 'required',
                        'plan_period' => 'required',
                        'order_limit' => 'required'
                    ],
                    [
                        "name.required" => trans('messages.plan_name_required'),
                        "description.required" => trans('messages.description_required'),
                        "features.required" => trans('messages.features_required'),
                        "price.required" => trans('messages.price_required'),
                        "item_unit.required" => trans('messages.item_limit_required'),
                        "plan_period.required" => trans('messages.plan_period_required'),
                        "order_limit.required" => trans('messages.order_limit_required'),
                    ]
                );
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                } else {

                    $plans = new Plans;
                    $plans->name = $request->name;
                    $plans->description = $request->description;
                    $plans->features = $request->features;
                    $plans->price = $request->price;
                    $plans->item_unit = $request->item_unit;
                    $plans->plan_period = $request->plan_period;
                    $plans->order_limit = $request->order_limit;
                    $plans->save();

                    return redirect(route('plans'))->with('success', trans('messages.success'));
                }
            }
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'description' => 'required',
                    'features' => 'required',
                    'price' => 'required',
                    'item_unit' => 'required',
                    'plan_period' => 'required',
                    'order_limit' => 'required'
                ],
                [
                    "name.required" => trans('messages.plan_name_required'),
                    "description.required" => trans('messages.description_required'),
                    "features.required" => trans('messages.features_required'),
                    "price.required" => trans('messages.price_required'),
                    "item_unit.required" => trans('messages.item_limit_required'),
                    "plan_period.required" => trans('messages.plan_period_required'),
                    "order_limit.required" => trans('messages.order_limit_required'),
                ]
            );
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            } else {

                $plans = new Plans;
                $plans->name = $request->name;
                $plans->description = $request->description;
                $plans->features = $request->features;
                $plans->price = $request->price;
                $plans->item_unit = $request->item_unit;
                $plans->plan_period = $request->plan_period;
                $plans->order_limit = $request->order_limit;
                $plans->save();

                return redirect(route('plans'))->with('success', trans('messages.success'));
            }
        }
    }

    public function del(Request $request)
    {
        $del = Plans::where('id', $request->id)->update(['is_deleted' => 1]);
        if ($del) {
            return 1;
        } else {
            return 0;
        }
    }

    public function show($id)
    {
        $pdata = Plans::where('is_deleted', 2)->where('id', $id)->first();
        return view('admin.plans.show', compact('pdata'));
    }

    public function update(Request $request, $id)
    {
        $checkfreeplan = Plans::where('price', (float)$request->price)->first();

        if (!empty($checkfreeplan)) {
            if ($request->price == "0") {
                return Redirect()->back()->with('error', trans('messages.free_plan_exist'));
            } else {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'description' => 'required',
                        'features' => 'required',
                        'price' => 'required',
                        'item_unit' => 'required',
                        'plan_period' => 'required',
                        'order_limit' => 'required'
                    ],
                    [
                        "name.required" => trans('messages.plan_name_required'),
                        "description.required" => trans('messages.description_required'),
                        "features.required" => trans('messages.features_required'),
                        "price.required" => trans('messages.price_required'),
                        "item_unit.required" => trans('messages.item_limit_required'),
                        "plan_period.required" => trans('messages.plan_period_required'),
                        "order_limit.required" => trans('messages.order_limit_required'),
                    ]
                );
                if ($validator->fails()) {
        
                    return redirect()->back()->withErrors($validator)->withInput();
                } else {
        
                    Plans::where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'description' => $request->description,
                            'features' => $request->features,
                            'price' => $request->price,
                            'item_unit' => $request->item_unit,
                            'plan_period' => $request->plan_period,
                            'order_limit' => $request->order_limit
                        ]);
                    return redirect()->back()->with('success', trans('messages.success'));
                }
            }
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'description' => 'required',
                    'features' => 'required',
                    'price' => 'required',
                    'item_unit' => 'required',
                    'plan_period' => 'required',
                    'order_limit' => 'required'
                ],
                [
                    "name.required" => trans('messages.plan_name_required'),
                    "description.required" => trans('messages.description_required'),
                    "features.required" => trans('messages.features_required'),
                    "price.required" => trans('messages.price_required'),
                    "item_unit.required" => trans('messages.item_limit_required'),
                    "plan_period.required" => trans('messages.plan_period_required'),
                    "order_limit.required" => trans('messages.order_limit_required'),
                ]
            );
            if ($validator->fails()) {
    
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
    
                Plans::where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'features' => $request->features,
                        'price' => $request->price,
                        'item_unit' => $request->item_unit,
                        'plan_period' => $request->plan_period,
                        'order_limit' => $request->order_limit
                    ]);
                return redirect()->back()->with('success', trans('messages.success'));
            }
        }
    }

    public function plans()
    {
        $plans = Plans::orderBy('id', 'DESC')->paginate(10);
        return view('admin.plans.plans', compact('plans'));
    }

    public function purchase(Request $request)
    {
		$plans = Plans::where('id', $request->id)->first();
		$paymentlist = Payment::where('status', '1')->where('payment_name', '!=', 'COD')->where('restaurant', null)->get();
		$bankdetails = Payment::where('payment_name', 'Bank transfer')->where('restaurant', null)->first();
		return view('admin.plans.purchase', compact('plans', 'paymentlist', 'bankdetails'));
    }

    public function order(Request $request)
    {
        date_default_timezone_set(Helper::webinfo(Auth::user()->id)->timezone);
        if ($request->payment_type == 2 or $request->payment_type == 4 or $request->payment_type == 5) {
            $payment_id = $request->payment_id;
        }

        if ($request->payment_type == 3) {
            $getstripe = Payment::select('environment', 'secret_key')->where('payment_name', 'Stripe')->first();

            $skey = $getstripe->secret_key;

            Stripe::setApiKey($skey);

            $customer = Customer::create(array(
                'email' => $request->email,
                'source' => $request->stripeToken,
                'name' => $request->name,
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'description' => 'Subscription payment',
            ));

            $payment_id = $charge['id'];
        }

        $transaction = new Transaction;

        if ($request->payment_type == 6) {
            if ($request->hasFile('screenshot')) {
                $validator = Validator::make($request->all(), [
                    'screenshot' => 'image|mimes:jpg,jpeg,png',
                ], [
                    'screenshot.mage' => trans('messages.enter_image_file'),
                    'screenshot.mimes' => trans('messages.valid_image'),
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                } else {
                    $file = $request->file('screenshot');
                    $filename = 'payment-' . time() . "." . $file->getClientOriginalExtension();
                    $file->move(storage_path() . '/app/payment/', $filename);
                    $transaction->screenshot = $filename;
                }
            }
            User::where('id', Auth::user()->id)
                ->update([
                    'payment_id' => @$payment_id,
                    'plan' => $request->plan,
                    'purchase_amount' => $request->amount,
                    'payment_type' => $request->payment_type,
                    'free_plan' => 1,
                    'purchase_date' => date("Y-m-d h:i:sa"),
                ]);
            $date = NULL;
            $status = "1";
            $amount = $request->amount;
        } else {
            User::where('id', Auth::user()->id)
                ->update([
                    'payment_id' => @$payment_id,
                    'plan' => $request->plan,
                    'purchase_amount' => $request->amount,
                    'payment_type' => $request->payment_type,
                    'free_plan' => 1,
                    'purchase_date' => date("Y-m-d h:i:sa"),
                ]);
            $date = date("Y-m-d h:i:sa");
            $status = "2";
            $amount = $request->amount;
        }

        $transaction->restaurant = Auth::user()->id;
        $transaction->plan = $request->plan;
        $transaction->amount = $amount;
        $transaction->payment_type = $request->payment_type;
        $transaction->payment_id = @$payment_id;
        $transaction->date = $date;
        $transaction->status = $status;
        $transaction->plan_period = $request->plan_period;
        $transaction->save();

        $admininfo = User::where('type', 1)->first();

        $msg = trans('labels.new_vendor_subscription');
        $vmsg = trans('labels.subscribed_package');

        if ($request->payment_type == 0) {
            $payment_type =  "FREE";
        }

        if ($request->payment_type == 2) {
            $payment_type =  "Razorpay : " . @$payment_id;
        }

        if ($request->payment_type == 3) {
            $payment_type = "Stripe : " . @$payment_id;
        }

        if ($request->payment_type == 4) {
            $payment_type = "Flutterwave : " . @$payment_id;
        }

        if ($request->payment_type == 5) {
            $payment_type = "Paystack : " . @$payment_id;
        }

        if ($request->payment_type == 6) {
            $payment_type = trans('labels.bank_transfer');
            $msg = trans('labels.request_for_subscription');
            $vmsg = trans('labels.received_package_request');
        }

        if ($request->payment_type == 6 or $request->payment_type == 0) {
            return redirect()->route('plans')->with('success', trans('messages.success'));
        } else {
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        }
    }
}
