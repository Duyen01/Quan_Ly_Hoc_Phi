<?php 
  $menus = config('menu');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lí học phí sinh viên</title>
  <link rel = "icon" href ="{{asset('ad/dist/img/logo_bkacad.png')}}" type = "image/x-icon">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('ad/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('ad/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('ad/dist/css/adminlte.min.css')}}">
  {{-- Ajax --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>  

  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  
<!-- Site wrapper -->
<!-- Success noti -->
@if(isset($success))
<div class="alert alert-success" role="alert">
  {{$success;}}
</div>
@endif
<!-- Error -->
@if(isset($error))
<div class="alert alert-warning" role="alert">
 {{ $error}}
</div>
@endif
<!-- End noti -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          {{-- Hi {{ Auth::user()->name }} --}}
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Hi {{ Session::get('admin.name') }}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#">Information</a></li>
                {{-- {{ route('logout') }} --}}
                <li><a onClick="return confirm('Are you sure want to logout')" href="{{route('admin.logout')}}">Logout</a></li>
            </ul>
        </li>
    </ul>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('ad/dist/img/admin.jpeg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Session::get('admin.name') }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @foreach($menus as $m)  
          <li class="nav-item">
            <a href="{{route($m['route'])}}" class="nav-link">
              <i class="nav-icon fas {{($m['icon'])}}"></i>
              <p>
                {{$m['label']}}
                @if(isset($m['items']))
                <i class="right fas fa-angle-left"></i>
                @endif
              </p>
            </a>
            @if(isset($m['items']))
              <ul class="nav nav-treeview">
                @foreach($m['items'] as $mit)  
                <li class="nav-item">
                  <a href="{{route($mit['route'])}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                   <p> {{$mit['label']}}</p>
                  </a>
                </li>
                @endforeach  
              </ul>
            @endif 
          </li> 
         @endforeach                                         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-body">
                @if(Session::has('error'))
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{Session::get('error')}}
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{Session::get('success')}}
                </div>
                @endif
              {{--   <script>
                  $(".alert").alert();
                </script> --}}
                @yield('main')
              </div>
            
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('ad/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('ad/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('ad/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('ad/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('ad/dist/js/demo.js')}}"></script> --}}
@yield('js')
</body>
</html>
