 {{-- Navbar (Header) Start --}}
<nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
   <div class="container-fluid">
      <div class="navbar-header">
         <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <span class="d-lg-none navbar-right navbar-collapse-toggle">
            <a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a>
         </span>
      </div>
      <div class="navbar-container">
         <div id="navbarSupportedContent" class="collapse navbar-collapse">
               <h4>
                  @if(Auth::user()->type == 1)
                     {{Auth::user()->name}}
                  @elseif(Auth::user()->type == 2)
                     <a href="{{ URL::to(Auth::user()->slug)}}" target="_blank">{{Auth::user()->name}}</a>
                  @endif

               </h4>
            <ul class="navbar-nav">
               <li class="dropdown nav-item">
                  <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">
                     <i class="ft-user font-medium-3 blue-grey darken-4"></i><p class="d-none">{{ trans('labels.settings') }}</p>
                  </a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                     <!-- <a class="dropdown-item py-1" data-toggle="modal" data-target="#bootstrap"><i class="ft-edit mr-2"></i><span>{{ trans('labels.edit_profile') }}</span></a> -->
                     <a class="dropdown-item py-1 change_password_modal" data-toggle="modal" data-target="#change_password_modal"><i class="fa fa-key mr-2"></i><span>{{ trans('labels.change_password') }}</span></a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="{{ URL::to('admin/logout') }}"><i class="ft-power mr-2"></i><span>{{ trans('labels.logout') }}</span></a>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</nav>
<!-- Navbar (Header) Ends