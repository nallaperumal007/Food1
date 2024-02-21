<div style="display: none">
    @include('front.theme.header')
</div>


<section class="py-0 row px-3">
    <div class="container">
        <div class="row justify-content-center order-success">
            <div class="col-md-8 d-grid justify-items-center text-center">
                <img src="{{ url('storage/app/public/front/images/ordersuccess.png') }}" class="success-img" alt="ordersuccess" srcset="">
                <h4>{{ trans('labels.order_successfull') }}</h4>
                <p class="mb-0 font-weight-normal">{{ trans('labels.order_success_note') }}</p>
                <div class="input-group my-3">
                    <input type="text" class="form-control {{ session()->get('direction') == 2 ? 'rounded' : '' }}" id="data" value="{{URL::to($getrestaurant->slug.'/track-order/'.$orderdata->order_number)}}" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary border-0 {{ session()->get('direction') == 2 ? 'rounded' : '' }}" type="button" id="tool"
                            onclick="copytext('{{ trans('labels.copied') }}')">{{ trans('labels.copy') }}</button>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="{{URL::to($getrestaurant->slug)}}" class="btn btn-primary btn-sm border-0 text-white mx-2">
                        <i class="far fa-home-lg {{ session()->get('direction') == 2 ? 'ml-1' : 'mr-1' }}"></i>
                        {{ trans('labels.continue_shop') }}
                    </a>
                    <a href="https://api.whatsapp.com/send?phone={{Helper::webinfo($getrestaurant->id)->contact}}&text={{$whmessage}}" target="_blank" class="btn btn-primary btn-sm border-0 text-white mx-2">
                        <i class="fab fa-whatsapp {{ session()->get('direction') == 2 ? 'ml-1' : 'mr-1' }}"></i>
                        {{ trans('labels.send_order_whatsapp') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<div style="display: none">
    @include('front.theme.footer')
    <script>
        function copytext(copied) {
            "use strict";
            var copyText = document.getElementById("data");
            copyText.select();
            document.execCommand("copy");
            document.getElementById("tool").innerHTML = copied;
        }
    </script>
</div>
