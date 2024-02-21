@extends('admin.layout.main')
@section('page_title',trans('labels.pricing_plans'))
@section('content')
<section id="content-types">
	<div class="row">
		<div class="col-12 mt-3 mb-1">
			<h4 class="content-header">{{trans('labels.pricing_plans')}}</h4>
		</div>
	</div>
	<div class="row match-height">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card" style="height: 473px;">
				<div class="card-body">
					<div class="card-block">
						<h4 class="card-title">{{$plans->name}}</h4>
						<p class="card-text">{{$plans->description}}</p>
					</div>
					<ul class="list-group">
						<li class="list-group-item">
						<h4 class="card-title">{{Helper::currency_format($plans->price,1)}} / 
								@if($plans->plan_period == 1)
									{{trans('labels.1_month')}}
								@endif
								@if($plans->plan_period == 2)
									{{trans('labels.3_month')}}
								@endif
								@if($plans->plan_period == 3)
									{{trans('labels.6_month')}}
								@endif
								@if($plans->plan_period == 4)
									{{trans('labels.1_year')}}
								@endif
							</h4>
						</li>
						<li class="list-group-item"><i class="ft-check"></i>{{$plans->item_unit}} {{trans('labels.item_limit')}}</li>
						<li class="list-group-item"><i class="ft-check"></i>{{$plans->order_limit}} {{trans('labels.order_limit')}}</li>
						<?php
						$myString = $plans->features;
						$myArray = explode(',', $myString);
						?>
						@foreach($myArray as $features)
						<li class="list-group-item"><i class="ft-check"></i> {{$features}}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="card" style="height: 473px;">
				<div class="card-body">
					<div class="card-block">
						<h4 class="card-title">{{trans('labels.select_payment')}}</h4>
					</div>
					@foreach ($paymentlist as $key => $payment)
					<div class="list-group-item">
						<!-- Radio -->
						<div class="custom-control custom-radio">
							<!-- Input -->
							<input class="custom-control-input" id="{{$payment->payment_name}}" data-payment_type="{{$payment->id}}" name="payment" type="radio" @if (!$key) {!! "checked" !!} @endif>
							<!-- Label -->
							<label class="custom-control-label font-size-sm text-body text-nowrap" for="{{$payment->payment_name}}">
								@if($payment->payment_name == "RazorPay")
								<img src="{{asset('storage/app/public/payment/razorpay.png')}}" class="ml-2" alt="" width="30px" />
								<input type="hidden" name="razorpay" id="razorpay" value="{{$payment->public_key}}">
								@endif
								@if($payment->payment_name == "Stripe")
								<img src="{{asset('storage/app/public/payment/stripe.png')}}" class="ml-2" alt="" width="30px" />
								<input type="hidden" name="stripe" id="stripe" value="{{$payment->public_key}}">
								@endif
								@if($payment->payment_name == "Flutterwave")
								<img src="{{asset('storage/app/public/payment/flutterwave.png')}}" class="ml-2" alt="" width="30px" />
								<input type="hidden" name="flutterwavekey" id="flutterwavekey" value="{{$payment->public_key}}">
								@endif
								@if($payment->payment_name == "Paystack")
								<img src="{{asset('storage/app/public/payment/paystack.png')}}" class="ml-2" alt="" width="30px" />
								<input type="hidden" name="paystackkey" id="paystackkey" value="{{$payment->public_key}}">
								@endif
								@if($payment->payment_name == "Bank transfer")
								<img src="{{asset('storage/app/public/payment/bank.png')}}" class="ml-2" alt="" width="30px" />
								@endif
								{{$payment->payment_name}}
							</label>
						</div>
					</div>
					@endforeach
				</div>
				<div class="card-block">
					@if (env('Environment') == 'sendbox')
					<button onclick="myFunction()" class="btn btn-raised btn-success btn-min-width mr-1 mb-1">{{trans('labels.buy_now')}}</button>
					@else
					<button onclick="Paynow()" class="btn btn-raised btn-success btn-min-width mr-1 mb-1">{{trans('labels.buy_now')}}</button>
					@endif
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="plan" id="plan" value="{{$plans->name}}">
	<input type="hidden" name="amount" id="amount" value="{{$plans->price}}">
	<input type="hidden" name="plan_period" id="plan_period" value="{{$plans->plan_period}}">
	<input type="hidden" name="email" id="email" value="{{Helper::getrestaurant(Auth::user()->slug)->email}}">
	<input type="hidden" name="mobile" id="mobile" value="{{Helper::getrestaurant(Auth::user()->slug)->mobile}}">
	<input type="hidden" name="name" id="name" value="{{Helper::getrestaurant(Auth::user()->slug)->name}}">
</section>
@endsection
<!-- Bank info -->
<div class="modal fade" id="transaction_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ trans('labels.bank_transfer') }}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="form" enctype="multipart/form-data" action="{{ URL::to('/vendor/plans/order')}}" method="POST">
			@csrf
			<input type="hidden" name="payment_type" id="payment_type" class="form-control" value="">
			<input type="hidden" name="plan" id="plan_bank" class="form-control" value="">
			<input type="hidden" name="amount" id="amount_bank" class="form-control" value="">
			<input type="hidden" name="plan_period" id="plan_period_bank" class="form-control" value="">
			<div class="modal-body">
				<p>Bank name : {{$bankdetails->bank_name}}</p>
				<p>Account holder name : {{$bankdetails->account_holder_name}}</p>
				<p>Account number : {{$bankdetails->account_number}}</p>
				<p>IFSC : {{$bankdetails->ifsc}}</p>
				<hr>
				<div class="form-group col-md-12">
					<label for="screenshot"> Transaction image </label>
					<div class="controls">
						<input type="file" name="screenshot" id="screenshot" class="form-control  @error('screenshot') is-invalid @enderror" required>
						@error('screenshot') <span class="text-danger"> {{$message}} </span> @enderror
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn grey btn-outline-secondary" data-bs-dismiss="modal">{{trans('labels.close')}}</button>
				@if (env('Environment') == 'sendbox')
				<button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-edit"></i> {{trans('labels.update')}} </button>
				@else
				<input type="submit" class="btn btn-raised btn-primary" value="{{trans('labels.submit')}}">
				@endif
			</div>
			</form>
		</div>
	</div>
</div>
@section('scripts')
<script src="{{asset('resources/views/admin/plans/plans.js')}}" type="text/javascript"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
	function Paynow() {
		"use strict";
		var payment_type = $('input[name="payment"]:checked').attr("data-payment_type");
		var flutterwavekey = $('#flutterwavekey').val();
		var paystackkey = $('#paystackkey').val();
		var plan = $('#plan').val();
		var plan_period = $('#plan_period').val();
		var email = $('#email').val();
		var mobile = $('#mobile').val();
		var amount = $('#amount').val();
		var name = $('#name').val();
		//Razorpay
		if (payment_type == 2) {
			var options = {
				"key": $('#razorpay').val(),
				"amount": (parseInt(amount * 100)), // 2000 paise = INR 20
				"name": name,
				"description": "Plan payment",
				"image": "{{asset('storage/app/vendor/'.Helper::getrestaurant(Auth::user()->slug)->image)}}",
				"handler": function(response) {
					$('#preloader').show();
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: "{{ URL::to('/vendor/plans/order') }}",
						type: 'post',
						dataType: 'json',
						data: {
							payment_id: response.razorpay_payment_id,
							amount: amount,
							payment_type: payment_type,
							plan: plan,
							plan_period: plan_period,
						},
						success: function(response) {
							$('#preloader').hide();
							if (response.status == 1) {
								window.location.href = "{{ URL::to('/vendor/plans')}}";
							}
						},
						error: function(error) {
							$('#preloader').hide();
						}
					});
				},
				"prefill": {
					"contact": mobile,
					"email": email,
					"name": name,
				},
				"theme": {
					"color": "#366ed4"
				}
			};
			var rzp1 = new Razorpay(options);
			rzp1.open();
			e.preventDefault();
		}
		//Stripe
		if (payment_type == 3) {
			$('#preloader').show();
			var handler = StripeCheckout.configure({
				key: $('#stripe').val(),
				image: "{{asset('storage/app/vendor/'.Helper::getrestaurant(Auth::user()->slug)->image)}}",
				locale: 'auto',
				token: function(token) {
					// You can access the token ID with `token.id`.
					// Get the token ID to your server-side code for use.
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: "{{ URL::to('/vendor/plans/order') }}",
						data: {
							stripeToken: token.id,
							email: email,
							name: name,
							amount: amount,
							payment_type: payment_type,
							plan: plan,
							plan_period: plan_period,
						},
						method: 'POST',
						success: function(response) {
							$('#preloader').hide();
							if (response.status == 1) {
								window.location.href = "{{ URL::to('/vendor/plans')}}";
							}
						},
						error: function(error) {
							$('#preloader').hide();
						}
					});
				},
				opened: function() {
					$('#preloader').hide();
				},
				closed: function() {
					$('#preloader').hide();
				}
			});
			//Stripe Popup
			handler.open({
				name: name,
				description: 'Plan payment',
				amount: amount * 100,
				currency: "USD",
				email: email
			});
			e.preventDefault();
			// Close Checkout on page navigation:
			$(window).on('popstate', function() {
				handler.close();
			});
		}
		//Flutterwave
		if (payment_type == 4) {
			$('#preloader').show();
			FlutterwaveCheckout({
				public_key: flutterwavekey,
				tx_ref: name,
				amount: amount,
				currency: "NGN",
				payment_options: " ",
				customer: {
					email: email,
					phone_number: mobile,
					name: name,
				},
				callback: function(data) {
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: "{{ URL::to('/vendor/plans/order') }}",
						method: 'POST',
						dataType: 'json',
						data: {
							payment_id: data.flw_ref,
							amount: amount,
							payment_type: payment_type,
							plan: plan,
							plan_period: plan_period,
						},
						success: function(response) {
							$('#preloader').hide();
							if (response.status == 1) {
								window.location.href = "{{ URL::to('/vendor/plans')}}";
							}
						},
						error: function(error) {
							$('#preloader').hide();
						}
					});
				},
				onclose: function() {
					$('#preloader').hide();
				},
				customizations: {
					title: name,
					description: "Plan payment",
					logo: "{{asset('storage/app/vendor/'.Helper::getrestaurant(Auth::user()->slug)->image)}}",
				},
			});
		}
		//Paystack
		if (payment_type == 5) {
			$('#preloader').show();
			let handler = PaystackPop.setup({
				key: paystackkey,
				email: email,
				amount: amount * 100,
				currency: 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
				ref: 'trx_' + Math.floor((Math.random() * 1000000000) + 1),
				label: "Plan payment",
				onClose: function() {
					$('#preloader').hide();
				},
				callback: function(response) {
					$('#preloader').show();
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: "{{ URL::to('/vendor/plans/order') }}",
						data: {
							payment_id: response.trxref,
							amount: amount,
							payment_type: payment_type,
							plan: plan,
							plan_period: plan_period,
						},
						method: 'POST',
						success: function(response) {
							$('#preloader').hide();
							if (response.status == 1) {
								window.location.href = "{{ URL::to('/vendor/plans')}}";
							}
						},
						error: function(error) {
							$('#preloader').hide();
						}
					});
				}
			});
			handler.openIframe();
		}

		//Bank transfer
		if (payment_type == 6) {
			$('#transaction_details').modal('show'); 
			$('#payment_type').val(payment_type);
			$('#plan_bank').val(plan);
			$('#amount_bank').val(amount);
			$('#plan_period_bank').val(plan_period);
		}
	}
</script>
@endsection