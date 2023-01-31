<!DOCTYPE html>
<html lang="en">
<head id="head">
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title>Institute Management Software</title>

  <meta content="Native Institute Management Software" name="description"/>
  <meta content="Raihan Afroz; Saidul Islam; Dipta Day; Arif Hosen; Towhidul Islam;"
        name="author"/>
  <meta content="Touch & Solve" name="company"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Favicon -->
  <link href="{{asset('favicon.png')}}" rel="icon">
  <link href="{{asset('favicon.png')}}" rel="apple-touch-icon">
  {{--  <link rel="shortcut icon" href="{{ asset("fav.jpg") }}" type="image/png">--}}
  <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

  <style>
    body {
      font-size: 14px;
    }

    label {
      font-size: 12px;
    }

    .form-control {
      font-size: 14px;
    }


    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    .pagination{
      float: right;
    }


  </style>
  @yield('stylesheet')
  @vite('resources/js/app.js')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/custom.css') }}">


</head>
<body class="fixed-left">
<!-- Loader -->
<div id="preloader">
  <div id="status">
    <div class="spinner"></div>
  </div>
</div>

<div id="wrapper">
  <!-- ========== Left Sidebar Start ========== -->
  <div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
      <div class="text-center" style="padding-right: 35px">
        <a href="{{ route('home') }}" class="logo">
{{--          <x-admin-sidebar-logo/>--}}
        </a>
      </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
      <div id="sidebar-menu">
        <ul>

          <li>
            <a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard</span>
            </a>
          </li>

            @if(\App\Helper\CustomHelper::canView('Create User|Manage User|Delete User|View User|List Of User', 'Super Admin'))
                <li class="has_sub">
                    <a class="waves-effect"><i class="mdi mdi-account-multiple"></i><span> User <span
                                class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="list-unstyled">
                        @if(\App\Helper\CustomHelper::canView('Create User', 'Super Admin'))
                            <li><a href="{{ route('admin.user.create') }}">Create new</a></li>
                        @endif
                        @if(\App\Helper\CustomHelper::canView('Manage User|Delete User|View User|List Of User', 'Super Admin'))
                            <li><a href="{{ route('admin.user.list') }}">List of Users</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(\App\Helper\CustomHelper::canView('Create Role|Manage Role|Delete Role|View Role|List Of Role', 'Super Admin'))
                <li class="has_sub">
                    <a class="waves-effect"><i>
                            <iconify-icon icon="eos-icons:cluster-role-binding"></iconify-icon>
                        </i><span> Role <span
                                class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="list-unstyled">
                        @if(\App\Helper\CustomHelper::canView('Create Role', 'Super Admin'))
                            <li><a href="{{ route('admin.role.create') }}"> Create new</a></li>
                        @endif
                        @if(\App\Helper\CustomHelper::canView('Manage Role|Delete Role|View Role|List Of Role', 'Super Admin'))
                            <li><a href="{{ route('admin.role.list') }}">List of roles</a></li>
                        @endif
                    </ul>
                </li>
            @endif


            @if(\App\Helper\CustomHelper::canView('Manage Permission', 'Super Admin'))
                <li><a href="{{ route('admin.permission.manage') }}" class="waves-effect">
                        <i>
                            <iconify-icon icon="icon-park-solid:permissions"></iconify-icon>
                        </i>
                        <span>  Permissions</span>
                    </a></li>
            @endif


          @if(\App\Helper\CustomHelper::canView('Create Division|Manage Division|Delete Division|View Division|List Of Division', 'Super Admin'))
            <li class="has_sub">

              <a class="waves-effect"><i class="mdi mdi-city"></i><span> Division <span
                    class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
              <ul class="list-unstyled">
                @if(\App\Helper\CustomHelper::canView('Create Division', 'Super Admin'))
                  <li><a href="{{ route('admin.division.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage Division|Delete Division|View Division|List Of Division', 'Super Admin'))
                  <li><a href="{{ route('admin.division.list') }}">List of Divisions</a></li>
                @endif
              </ul>
            </li>
          @endif


            @if(\App\Helper\CustomHelper::canView('Create Event|Manage Event|Delete Event|View Event|List Of Event', 'Super Admin'))
            <li class="has_sub">

              <a class="waves-effect"><i class="mdi mdi-city"></i><span> Event <span
                    class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
              <ul class="list-unstyled">
                @if(\App\Helper\CustomHelper::canView('Create Event', 'Super Admin'))
                  <li><a href="{{ route('admin.event.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage Event|Delete Event|View Event|List Of Event', 'Super Admin'))
                  <li><a href="{{ route('admin.event.list') }}">List of Events</a></li>
                @endif
              </ul>
            </li>
          @endif
            {{--end event manage module --}}

          @if(\App\Helper\CustomHelper::canView('Create District|Manage District|Delete District|View District|List Of District', 'Super Admin'))
            <li class="has_sub">
              <a class="waves-effect"><i class="mdi mdi-houzz"></i><span> District <span
                    class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
              <ul class="list-unstyled">
                @if(\App\Helper\CustomHelper::canView('Create District', 'Super Admin'))
                  <li><a href="{{ route('admin.district.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage District|Delete District|View District|List Of District', 'Super Admin'))
                  <li><a href="{{ route('admin.district.list') }}">List of Districts</a></li>
                @endif
              </ul>
            </li>
          @endif

          @if(\App\Helper\CustomHelper::canView('Create Upazila|Manage Upazila|Delete Upazila|View Upazila|List Of Upazila', 'Super Admin'))
            <li class="has_sub">
              <a class="waves-effect"><i>
                  <iconify-icon icon="map:city-hall"></iconify-icon>
                </i><span> Upazila <span
                    class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
              <ul class="list-unstyled">
                @if(\App\Helper\CustomHelper::canView('Create Upazila', 'Super Admin'))
                  <li><a href="{{ route('admin.upazila.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage Upazila|Delete Upazila|View Upazila|List Of Upazila', 'Super Admin'))
                  <li><a href="{{ route('admin.upazila.list') }}">List of Upazilas</a></li>
                @endif
              </ul>
            </li>
          @endif

          @if(\App\Helper\CustomHelper::canView('Manage Permission', 'Institute Head'))
            <li><a href="{{ route('admin.backgroundImage') }}" class="waves-effect">
                <i class="mdi mdi-image-album"></i>
                <span>Login Background Slider</span>
              </a></li>
          @endif
          @if(\App\Helper\CustomHelper::canView('Create Voucher|Manage Voucher|Delete Voucher|View Voucher|List Of Voucher', 'Super Admin'))
            <li class="has_sub">
              <a class="waves-effect"><i aria-hidden="true">
                  <iconify-icon icon="majesticons:paper-fold-text"></iconify-icon>
                </i><span> Voucher <span
                    class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
              <ul class="list-unstyled">
                @if(\App\Helper\CustomHelper::canView('Create Voucher', 'Super Admin'))
                  <li><a href="{{ route('admin.voucher.create') }}">Create new</a></li>
                @endif
                @if(\App\Helper\CustomHelper::canView('Manage Voucher|Delete Voucher|View Voucher|List Of Voucher', 'Super Admin'))
                  <li><a href="{{ route('admin.voucher.list') }}">List of Vouchers</a></li>
                @endif
              </ul>
            </li>
          @endif

        </ul>
      </div>
      <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
  </div>
  <!-- Left Sidebar End -->

  <!-- Start right Content here -->
  <div class="content-page">

    <!-- Start content -->
    <div class="content">

      <!-- Top Bar Start -->
      <div class="topbar">

        <nav class="navbar-custom">
          <!-- Search input -->
          <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
              <input class="search-input" type="search" placeholder="Search"/>
              <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                <i class="mdi mdi-close-circle"></i>
              </a>
            </div>
          </div>
          <ul class="list-inline float-left mb-0">
            <li class="list-inline-item dropdown notification-list hidden-xs-down">
              <a class="nav-link waves-effect text-start" href="#" id="btn-fullscreen">
{{--               @if (isset(auth()->user()->institute->name))--}}
{{--               {{auth()->user()->institute->name}}--}}
{{--               @endif--}}
              </a>
            </li>
          </ul>
          <ul class="list-inline float-right mb-0">

            <!-- Fullscreen -->
            <li class="list-inline-item dropdown notification-list hidden-xs-down">
              <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                <i class="mdi mdi-fullscreen noti-icon"></i>
              </a>
            </li>

            <x-notification/>
            <li class="list-inline-item dropdown notification-list">
              <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#"
                 role="button"
                 aria-haspopup="false" aria-expanded="false">
                <img
                  src="{{ auth()->user()->profile_photo_path ? asset(auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}"
                  alt="user"
                  class="rounded-circle">
              </a>
              <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                @if(\App\Helper\CustomHelper::canView('', 'Institute Head'))
                  <a class="dropdown-item" href="{{ route('admin.instituteProfile') }}"><i
                      class="dripicons-user text-muted"></i>
                    Institute Profile</a>
                  <div class="dropdown-divider"></div>
                @endif
                <a class="dropdown-item" href="{{ route("admin.profile.show") }}"><i
                    class="dripicons-user text-muted"></i>
                  Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="dripicons-exit text-muted"></i>
                  Logout</a>
              </div>
            </li>
          </ul>
          <!-- Page title -->
          <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
              <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
              </button>
            </li>
          </ul>
          <div class="clearfix"></div>
        </nav>
      </div>
      <!-- Top Bar End -->

      <div class="page-content-wrapper">
        @yield('content')
        <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModal"
             aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Notification</h4>
              </div>
              <div class="modal-body">
                <strong id="notificationTitle"></strong>
                <p class="mt-2" id="notificationMessage"></p>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- Page content Wrapper -->
    </div>
    <footer class="footer">
      © 2023 Touch and Solve
      {{--      <span class="text-muted hidden-xs-down pull-right">Developed & Maintained by  <a href="https://touchandsolve.com"--}}
      {{--                                                                                       target="_blank">Touch & Solve</a></span>--}}
    </footer>
  </div>
</div>
<script src="{{asset('assets/admin/newicon/code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/waves.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>--}}


<!-- App js -->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
{{--@include('sweetalert::alert')--}}


<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.year-picker').datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      orientation: "bottom",
      autoclose: true //to close picker once year is selected
    });


    $('select[name="division_id"]').change(function () {
      const $this = $('select[name="district_id"]')
      var idDivision = this.value;
      $this.html('');
      $.ajax({
        url: "{{url('api/fetch-districts')}}/" + idDivision,
        type: "GET",
        dataType: 'json',
        success: function (result) {
          $this.html('<option value="">Choose a district</option>');
          $.each(result.districts, function (key, value) {
            $this.append('<option value="' + value
              .id + '">' + value.name + '</option>');
          });

        }
      });
    });
    $('select[name="district_id"]').change(function () {
      const $this = $('select[name="upazila_id"]')
      var idUpazila = this.value;
      $this.html('');
      $.ajax({
        url: "{{url('api/fetch-upazilas')}}/" + idUpazila,
        type: "GET",
        dataType: 'json',
        success: function (result) {
          $this.html('<option value="">Choose a upazila</option>');
          $.each(result.upazilas, function (key, value) {
            $this.append('<option value="' + value
              .id + '">' + value.name + '</option>');
          });
        }
      });
    });


    function checkDetails($id, $min, $max) {
      const $this = $('#' + $id)
      var $regex = /\s+/gi;
      var $wordcount = $.trim($this.val()).replace($regex, ' ').split(' ').length;
      if ($min > $wordcount) {
        $this.addClass('is-invalid')
        $('#' + $id + '_error').text('Minimum ' + $min + ' word required.')
      } else if ($wordcount > $max) {
        $this.addClass('is-invalid')
        $('#' + $id + '_error').text('Maximum ' + $max + ' word allow.')
      } else {
        $('#' + $id + '_error').text('')
        $this.removeClass('is-invalid')
      }
    }

    $('.notificationItems').click(function () {
      const $this = $(this)
      const title = $(this).data('title')
      const message = $(this).data('message')
      const url = $(this).data('url')
      $('#notificationTitle').text(title)
      $('#notificationMessage').text(message)
      $('#notificationModal').modal('show')
      $.ajax({
        url: url, type: "POST", dataType: 'html',
        success: function (result) {
          if (result === 'success') {
            const $notify = $('.unread-notification').text()
            $('.unread-notification').text((Number($notify) - 1))
            $this.addClass('active')
          }
        }
      })
    })

  })
</script>

@yield('script')
</body>
</html>
