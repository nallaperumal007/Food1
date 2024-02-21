@extends('admin.layout.main')

@section('page_title',trans('labels.transaction'))

@section('content')

	<section id="contenxtual">
	    <div class="row">
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h4 class="card-title">{{trans('labels.transaction')}}
	                  </h4>
	                </div>
	                <div class="card-body">

	                    <div class="card-block">

	                    	@include('admin.transaction.transaction_table')
	                        
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

@endsection
@section('scripts')
	<script src="{{asset('resources/views/admin/transaction/transaction.js')}}" type="text/javascript"></script>
@endsection