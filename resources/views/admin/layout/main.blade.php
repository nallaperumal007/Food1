<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Admin | @yield('page_title')</title>
   <link rel="icon" href='{{Helper::admininfo()->favicon}}' type="image/x-icon">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/fonts/feather/style.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/fonts/simple-line-icons/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/fonts/font-awesome/css/font-awesome.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/vendors/css/perfect-scrollbar.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/vendors/css/prism.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/vendors/css/chartist.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/vendors/css/tables/datatable/datatables.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/css/app.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/js/sweet-alert/plugins/sweetalert/css/sweetalert.css') }}">

   <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/admin-assets/js/toaster/toastr.min.css')}}">
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   @yield('styles')
</head>
<body>
   @include('admin.layout.header.header_navbar')
   @include('admin.layout.main_menu')
   <div class="main-panel">
      <div class="main-content">
         <div class="content-wrapper">
            <?php
            $checkplan = Helper::checkplan(Auth::user()->id);
            $v = json_decode(json_encode($checkplan));
            if ($v->original->status == "2") {
               $infomsg = $v->original->message;
            }
            ?>
            @if(isset($infomsg))
            <div class="alert alert-warning" role="alert">
               {{$infomsg}} <u><a href="{{ URL::to('/vendor/plans') }}">Click here</a></u> to upgrade.
            </div>
            @endif
            @yield('content')
         </div>
      </div>
   </div>
   </div>
   </div>
</body>
</html>
{{-- Edit Profile Modal Start --}}
<div class="modal fade text-left" id="bootstrap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel35"> {{trans('labels.update_profile')}} </h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form class="form" id="myProfileEditForm" action="{{ URL::to('admin/profile/edit/'.Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-body">
               <div class="form-group col-md-12">
                  <label for="name"> {{trans('labels.name')}} </label>
                  <input type="text" id="name" class="form-control" name="name" value="{{Auth::user()->name}}">
               </div>
               <div class="form-group col-md-12">
                  <label for="name"> {{trans('labels.email')}} </label>
                  <input type="email" id="email" class="form-control" name="email" value="{{Auth::user()->email}}" @if(Auth::user()->type == 2) readonly @endif>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{trans('labels.close')}}</button>
                  @if (env('Environment') == 'sendbox')
                  <button type="button" id="btn_update_profile" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="ft-edit"></i> {{trans('labels.update')}} </button>
                  @else
                  <button type="submit" id="btn_update_profile" class="btn btn-raised btn-primary"> <i class="ft-edit"></i> {{trans('labels.update')}} </button>
                  @endif

               </div>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- Change Password Modal Start --}}
<div class="modal fade text-left change_password_modal" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel35"> {{trans('labels.change_password')}} </h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <form class="form" id="change_password_form" action="{{ URL::to('admin/changepassword')}}" method="POST">
            @csrf

            <div class="form-body">
               <div class="form-group col-md-12">
                  <label for="old_password"> {{trans('labels.old_password')}} </label>
                  <div class="controls">
                     <input type="password" name="old_password" id="old_password" class="form-control  @error('pass_error') is-invalid @enderror">
                     @error('pass_error') <span class="text-danger" id="pass_error"></span> @enderror

                  </div>
               </div>
               <hr class="gray">
               <div class="form-group col-md-12">
                  <label for="new_password"> {{trans('labels.new_password')}} </label>
                  <div class="controls">
                     <input type="password" name="new_password" id="new_password" class="form-control  @error('new_password') is-invalid @enderror">
                  </div>
               </div>
               <div class="form-group col-md-12">
                  <label for="c_new_password"> {{trans('labels.confirm_password')}} </label>
                  <div class="controls">
                     <input type="password" name="c_new_password" id="c_new_password" class="form-control  @error('c_new_password') is-invalid @enderror">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">{{trans('labels.close')}}</button>
                  @if (env('Environment') == 'sendbox')
                  <button type="button" id="btn_update_profile" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="ft-edit"></i> {{trans('labels.update')}} </button>
                  @else
                  <input type="submit" id="btn_update_password" class="btn btn-raised btn-primary" value="{{trans('labels.change')}}">
                  @endif

               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script src="{{ asset('storage/app/public/admin-assets/js/jquery-3.6.0.js')}}"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/core/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/jquery.matchHeight-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/screenfull.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/vendors/js/datatable/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/js/app-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/js/notification-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/js/customizer.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/js/data-tables/datatable-basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/js/sweet-alert/plugins/sweetalert/js/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/js/toaster/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('storage/app/public/admin-assets/js/jquery.validate.js')}}" type="text/javascript"></script>

<script>
   // Toaster Success/error Message Start

   @if(Session::has('success'))
   toastr.options = {
      "closeButton": true,
      "progressBar": true

   }
   toastr.success("{{ session('success') }}");
   @endif

   @if(Session::has('error'))
   toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "timeOut": 10000

   }
   toastr.error("{{ session('error') }}");
   @endif

   // Change Password Form Validation 
   $("#change_password_form").validate({
      rules: {
         "old_password": {
            required: true
         },
         "new_password": {
            required: true
         },
         "c_new_password": {
            required: true,
            equalTo: "#new_password"
         }
      },
      messages: {
         "old_password": {
            required: "Please Enter Old Password"
         },
         "new_password": {
            required: "Please Enter New Password"
         },
         "c_new_password": {
            required: "Please Enter Confirm Password",
            equalTo: "Password Not Match To New Password"
         }
      }
   });
   $(document).on("submit", "#change_password_form", function(e) {
      var old_password = $("#old_password").val();
      var new_password = $("#new_password").val();
      var c_new_password = $("#c_new_password").val();
      if (old_password != new_password) {
         if (new_password == c_new_password) {
            return true;
         } else {
            alert("New Password and Confirm password must be same.");
            return false;
         }
      } else {
         alert("Old And New Pasword Must Be Different");
         return false;
      }
   })
   function myFunction() {
      toastr.error("Error!", "Permission disabled for demo mode");
   }
   $('.list-group-item-action').click(function() {
      $('.list-group-menu .active').removeClass('active');
      $(this).addClass('active');
      $('body').animate({
         scrollTop: eval($('#' + $(this).attr('target')).offset().top - 70)
      }, 1000);
   });
</script>

@yield('scripts')