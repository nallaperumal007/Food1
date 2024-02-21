@extends('admin.layout.main')

@section('page_title',trans('labels.categories'))

@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{$paymentdetails->payment_name}} {{ trans('labels.payment_configuration') }} </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @if(Session::has('danger'))
                            <div class="alert alert-danger">
                                {{ Session::get('danger') }}
                                @php
                                    Session::forget('danger');
                                @endphp
                            </div>
                            @endif
                            <div class="px-3">
                                <form class="form" method="post" action="@if (Auth::user()->type == 1) {{URL::to('admin/payments/update-'.$paymentdetails->id)}} @endif @if (Auth::user()->type == 2) {{URL::to('vendor/payments/update-'.$paymentdetails->id)}} @endif
                                    ">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="id" id="id" value="{{$paymentdetails->id}}" class="form-control">
                                        <div class="form-group">
                                            <label>{{ trans('labels.environment') }}</label>
                                            <select id="environment" name="environment" class="form-control">
                                                <option selected="selected" value="">{{ trans('labels.select') }}</option>
                                                <option value="0" {{$paymentdetails->environment == 0  ? 'selected' : ''}}>{{ trans('labels.production') }}</option>
                                                <option value="1" {{$paymentdetails->environment == 1  ? 'selected' : ''}}>{{ trans('labels.sendbox') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                @if($paymentdetails->payment_name == "Stripe")
                                                <label>{{ trans('labels.public_key') }}</label>
                                                <input type="text" name="public_key" class="form-control" placeholder="{{ trans('labels.public_key') }}" value="{{$paymentdetails->public_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "RazorPay")
                                                <label>{{ trans('labels.public_key') }}</label>
                                                <input type="text" name="public_key" class="form-control" placeholder="{{ trans('labels.public_key') }}" value="{{$paymentdetails->public_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "Flutterwave")
                                                <label>{{ trans('labels.public_key') }}</label>
                                                <input type="text" name="public_key" class="form-control" placeholder="{{ trans('labels.public_key') }}" value="{{$paymentdetails->public_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "Paystack")
                                                <label>{{ trans('labels.public_key') }}</label>
                                                <input type="text" name="public_key" class="form-control" placeholder="{{ trans('labels.public_key') }}" value="{{$paymentdetails->public_key}}">
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                @if($paymentdetails->payment_name == "Stripe")
                                                <label>{{ trans('labels.secret_key') }}</label>
                                                <input type="text" name="secret_key" class="form-control" placeholder="{{ trans('labels.secret_key') }}" value="{{$paymentdetails->secret_key}}">
                                                @endif 

                                                @if($paymentdetails->payment_name == "RazorPay")
                                                <label>{{ trans('labels.secret_key') }}</label>
                                                <input type="text" name="secret_key" class="form-control" placeholder="{{ trans('labels.secret_key') }}" value="{{$paymentdetails->secret_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "Flutterwave")
                                                <label>{{ trans('labels.secret_key') }}</label>
                                                <input type="text" name="secret_key" class="form-control" placeholder="{{ trans('labels.secret_key') }}" value="{{$paymentdetails->secret_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "Paystack")
                                                <label>{{ trans('labels.secret_key') }}</label>
                                                <input type="text" name="secret_key" class="form-control" placeholder="{{ trans('labels.secret_key') }}" value="{{$paymentdetails->secret_key}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            @if($paymentdetails->payment_name == "Flutterwave") 
                                            <label>{{ trans('labels.encryption_key') }}</label>
                                            <input type="text" name="encryption_key" class="form-control" placeholder="{{ trans('labels.encryption_key') }}" value="{{$paymentdetails->encryption_key}}">
                                            @endif
                                        </div>
                                    </div>
                                    @if ($paymentdetails->payment_name == 'Bank transfer')
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>{{ trans('labels.bank_name') }}</label>
                                            <input type="text" name="bank_name" class="form-control" placeholder="{{ trans('labels.bank_name') }}" value="{{ $paymentdetails->bank_name }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ trans('labels.account_number') }}</label>
                                            <input type="text" name="account_number" class="form-control" placeholder="{{ trans('labels.account_number') }}" value="{{ $paymentdetails->account_number }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ trans('labels.account_holder_name') }}</label>
                                            <input type="text" name="account_holder_name" class="form-control" placeholder="{{ trans('labels.account_holder_name') }}" value="{{ $paymentdetails->account_holder_name }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{ trans('labels.ifsc') }}</label>
                                            <input type="text" name="ifsc" class="form-control" placeholder="{{ trans('labels.ifsc') }}" value="{{ $paymentdetails->ifsc }}">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="form-actions center">
                                        <a type="button" class="btn btn-raised btn-warning mr-1" href="@if (Auth::user()->type == 1) {{URL::to('admin/payments')}} @else {{URL::to('vendor/payments')}} @endif"><i class="ft-x"></i> {{trans('labels.cancel')}}</a>
                                        @if (env('Environment') == 'sendbox')
                                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"><i class="fa fa-check-square-o"></i> {{trans('labels.update')}} </button>
                                        @else
                                            <button type="submit" class="btn btn-raised btn-primary"><i class="fa fa-check-square-o"></i> {{trans('labels.update')}} </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('scripts')

@endsection