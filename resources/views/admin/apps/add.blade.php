@extends('admin.layout.main')

@section('page_title')
	{{trans('labels.apps')}} | {{trans('labels.add')}}
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="bordered-layout-colored-controls">Install Addon</h4>
	            </div>
	            <div class="card-body">
	                <div class="px-3">
	                    <form method="post" action="{{ URL::to('admin/systemaddons/store')}}" name="about" id="about" enctype="multipart/form-data">
	                        @csrf

	                        <div class="row">
	                            <div class="col-sm-3 col-md-12">
	                                <div class="form-group">
	                                    <label for="addon_zip" class="col-form-label">Zip File</label>
	                                    <input type="file" class="form-control" name="addon_zip" id="addon_zip" required="">
	                                </div>
	                            </div>
	                        </div>

	                        @if (env('Environment') == 'sendbox')
	                            <button type="button" class="btn btn-primary" onclick="myFunction()">Install</button>
	                        @else
	                            <button type="submit" class="btn btn-primary">Install</button>
	                        @endif
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

@endsection