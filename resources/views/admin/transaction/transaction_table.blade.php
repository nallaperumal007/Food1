<table class="table table-hover">
	<thead>
		<tr>
			<th>{{trans('labels.srno')}}</th>
			@if (Auth::user()->type == 1)
			<th>{{trans('labels.name')}}</th>
			@endif
			<th>{{trans('labels.plan')}}</th>
			<th>{{trans('labels.amount')}}</th>
			<th>{{trans('labels.payment_type')}}</th>
			<th>{{trans('labels.start_date')}}</th>
			<th>{{trans('labels.end_date')}}</th>
			<th>{{trans('labels.status')}}</th>
			@if (Auth::user()->type == 1)
			<th>{{trans('labels.action')}}</th>
			@endif
		</tr>
	</thead>
	<tbody>
		@if(!empty($transaction) && count($transaction)>0)
		@foreach($transaction as $rdata)
		<tr>
			<th scope="row">{{$rdata->id}}</th>
			@if (Auth::user()->type == 1)
			<td>{{$rdata['users']->name}}</td>
			@endif
			<td>{{$rdata->plan}} (
				@if($rdata->plan_period == 1)
					{{trans('labels.1_month')}}
				@endif
				@if($rdata->plan_period == 2)
					{{trans('labels.3_month')}}
				@endif
				@if($rdata->plan_period == 3)
					{{trans('labels.6_month')}}
				@endif
				@if($rdata->plan_period == 4)
					{{trans('labels.1_year')}}
				@endif
				)
			</td>
			<td>{{Helper::currency_format($rdata->amount,Auth::user()->id)}}</td>
			<td>
				@if ($rdata->payment_type == 1)
				{{ trans('labels.cod') }}
				@endif

				@if ($rdata->payment_type == 2)
				Razorpay : {{ $rdata->payment_id }}
				@endif

				@if ($rdata->payment_type == 3)
				Stripe : {{ $rdata->payment_id }}
				@endif

				@if ($rdata->payment_type == 4)
				Flutterwave : {{ $rdata->payment_id }}
				@endif

				@if ($rdata->payment_type == 5)
				Paystack : {{ $rdata->payment_id }}
				@endif

				@if ($rdata->payment_type == 6)
				{{ trans('labels.bank_transfer') }} : <a href="{{ asset('storage/app/payment/' . $rdata->screenshot) }}" target="_blank" class="text-danger">Click here for Screenshot</a>
				@endif

				@if ($rdata->payment_type == 7)
				Mercado Pago : {{ $rdata->payment_id }}
				@endif
			</td>
			<td>
				{{$rdata->date}}
			</td>
			<td>
				@if($rdata->date != "")
				<?php
				$now = date('Y-m-d');
				if ($rdata->plan_period == "1") {
					$purchasedate = $rdata->date;

					$exdate = date('Y-m-d', strtotime($purchasedate . ' +30 days'));
					if ($purchasedate <= $now && $now <= $exdate) {
						$showbuy = "yes";
					} else {
						$showbuy = "no";
					}
				}
				if ($rdata->plan_period == "2") {
					$purchasedate = $rdata->date;

					$exdate = date('Y-m-d', strtotime($purchasedate . ' +90 days'));
					if ($purchasedate <= $now && $now <= $exdate) {
						$showbuy = "yes";
					} else {
						$showbuy = "no";
					}
				}
				if ($rdata->plan_period == "3") {
					$purchasedate = $rdata->date;

					$exdate = date('Y-m-d', strtotime($purchasedate . ' +180 days'));
					if ($purchasedate <= $now && $now <= $exdate) {
						$showbuy = "yes";
					} else {
						$showbuy = "no";
					}
				}
				if ($rdata->plan_period == "4") {
					$purchasedate = $rdata->date;

					$exdate = date('Y-m-d', strtotime($purchasedate . ' +365 days'));

					if ($purchasedate <= $now && $now <= $exdate) {
						$showbuy = "yes";
					} else {
						$showbuy = "no";
					}
				}
				?>
				{{$exdate}}
				@endif
			</td>
			<td>
				@if ($rdata->payment_type == 6)
				@if($rdata->status == 1)
				{{trans('labels.pending')}}
				@endif
				@if($rdata->status == 2)
				{{trans('labels.approved')}}
				@endif
				@if($rdata->status == 3)
				{{trans('labels.rejected')}}
				@endif
				@endif
			</td>
			@if (Auth::user()->type == 1)
			<td>
				@if ($rdata->payment_type == 6)
				@if (env('Environment') == 'sendbox')
				@if($rdata->status == 1)
				<a class="success p-0" onclick="myFunction()"><i class="ft-check font-medium-3 mr-2"></i></a>
				<a class="danger p-0" onclick="myFunction()"><i class="ft-x font-medium-3 mr-2"></i></a>
				@endif
				@else
				@if($rdata->status == 1)
				<a class="success p-0" onclick="status('{{$rdata->id}}','2','{{ trans('messages.are_you_sure') }}','{{ trans('messages.yes') }}','{{ trans('messages.no') }}','{{ URL::to('admin/transaction/edit/status') }}','{{ trans('messages.wrong') }}','{{ trans('messages.record_safe') }}')"><i class="ft-check font-medium-3 mr-2"></i></a>
				<a class="danger p-0" onclick="status('{{$rdata->id}}','3','{{ trans('messages.are_you_sure') }}','{{ trans('messages.yes') }}','{{ trans('messages.no') }}','{{ URL::to('admin/transaction/edit/status') }}','{{ trans('messages.wrong') }}','{{ trans('messages.record_safe') }}')"><i class="ft-x font-medium-3 mr-2"></i></a>
				@else
				-
				@endif
				@endif
				@else
				-
				@endif
			</td>
			@endif
		</tr>
		@endforeach
		@if ($transaction->hasPages())
		<tr>
			<td colspan="9" class="text-right float-center">{{$transaction->links()}}</td>
		</tr>
		@endif
		@else
		<tr>
			<td colspan="9" class="text-center">{{trans('labels.no_data')}}</td>
		</tr>
		@endif
	</tbody>
</table>