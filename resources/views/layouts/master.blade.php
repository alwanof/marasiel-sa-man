<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}-@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- flahs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.css" />
    @yield('head-js')
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div id="app" class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
<!--
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
-->


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

            @include('widgets.notifications')
            @php $locale = session()->get('locale'); @endphp

            <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-globe"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">{{ __('master.select-language') }}</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('lang','en') }}" class="dropdown-item">
                             English
                            <span class="float-right text-muted text-sm">
                                    <i class="flag-icon flag-icon-us"></i>
                            </span>
                        </a>
                        <div class="dropdown-d   ivider"></div>
                        <a href="{{ route('lang','ar') }}" class="dropdown-item">
                                Arabic
                               <span class="float-right text-muted text-sm">
                                       <i class="flag-icon flag-icon-sa"></i>
                               </span>
                           </a>
                    </div>
                </li>
                @switch($locale)
                @case('ar')
                <i class="flag-icon flag-icon-sa"></i>
                @break
                @default
                <i class="flag-icon flag-icon-us"></i>
                @endswitch



        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/logoD.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/logoD.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('me')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('master.dashboard') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link ">
                                <i class="fa fa-home nav-icon"></i>
                                <p>{{ __('master.home') }}</p>
                            </a>
                        </li>
                        @can('access-users')
                        <li class="nav-item ">
                            <a href="{{ route('users') }}" class="nav-link ">
                                <i class="fa fa-users nav-icon"></i>
                                <p>{{ __('master.users') }}</p>
                            </a>
                        </li>
                        @endcan
                        @can('access-configs')
                        <li class="nav-item">
                            <a href="{{ route('config.index') }}" class="nav-link ">
                                <i class="fas fa-cogs"></i>
                                <p>{{ __('master.config') }}</p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('config.settings') }}" class="nav-link ">
                                <i class="fas fa-cog"></i>
                                <p>{{ __('master.settings') }}</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fab fa-medapps"></i>
                        <p>
                            {{ __('master.modules') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('access-desktop')
                        <li class="nav-item">
                            <a href="{{ route('desktop') }}" class="nav-link ">
                                <i class="fas fa-desktop"></i>
                                <p>{{ __('master.desktop') }}</p>
                            </a>
                        </li>
                        @endcan
                        @can('access-drivers')
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link ">
                                <i class="fas fa-taxi"></i>
                                <p>{{ __('master.drivers') }}</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('manage_pending-drivers')
                                <li class="nav-item">
                                    <a href="{{ route('drivers.sheet') }}" class="nav-link">
                                        <i class="far fa-circle text-warning nav-icon"></i>
                                        <p>{{ __('master.pending-drivers') }}</p>
                                    </a>
                                </li>
                                @endcan
                                 @can('manage_active-drivers')
                                <li class="nav-item">
                                    <a href="{{ route('drivers.active') }}" class="nav-link">
                                        <i class="far fa-circle text-success nav-icon"></i>
                                        <p>{{ __('master.active-drivers') }}</p>
                                    </a>
                                </li>
                                     @endcan
                            </ul>
                        </li>
                        @endcan
                            @can('manage_customers')
                                <li class="nav-item has-treeview menu-open">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-users-cog"></i>
                                        <p>{{ __('customers.customers') }}</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('manage_active_customers')
                                            <li class="nav-item">
                                                <a href="{{ route('customers.active') }}" class="nav-link">
                                                    <i class="far fa-circle text-success nav-icon"></i>
                                                    <p>{{ __('customers.activecustomers') }}</p>
                                                </a>
                                            </li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan
                            @can('manage_orders')
                                <li class="nav-item has-treeview menu-open">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-check"></i>
                                        <p>{{ __('orders.orders') }}</p>
                                        <i class="right fa fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @can('orders_done')
                                            <li class="nav-item">
                                                <a href="{{ route('orders.sheet','done') }}" class="nav-link">
                                                    <i class="fas fa-dollar-sign text-success nav-icon"></i>
                                                    <p>{{ __('orders.completedorders') }}</p>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('orders_progress')
                                                <li class="nav-item">
                                                    <a href="{{ route('orders.sheet','progress') }}" class="nav-link">
                                                        <i class="fas fa-sync text-warning nav-icon"></i>
                                                        <p>{{ __('orders.progressorders') }}</p>
                                                    </a>
                                                </li>
                                        @endcan


                                    </ul>
                                </li>
                            @endcan
                    </ul>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{ __('master.logout') }}
                            <span class="right badge badge-danger">{{ __('master.goodBye') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
            @yield('nav')

    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.1
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://marasiel.com">Marasiel co.</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" ></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
@yield('js')
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
</body>
</html>
