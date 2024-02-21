@extends('admin.layout.main')

@section('page_title',trans('labels.payments'))

@section('content')
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.payments') }}</h4>
                        </div>

                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                    @include('admin.payment.paymenttable')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('resources/views/admin/payment/payment.js')}}" type="text/javascript"></script>
@endsection