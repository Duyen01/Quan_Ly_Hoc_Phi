<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lí học phí sinh viên</title>
  <link rel = "icon" href ="{{asset('ad/dist/img/logo_bkacad.png')}}" type = "image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('ad/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('ad/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('ad/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('ad/dist/css/adminlte.min.css')}}">
  @yield('css')
  {{-- Ajax --}}
</head>  
    <body class="hold-transition login-page">
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
    <script src="{{asset('ad/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('ad/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('ad/dist/js/adminlte.min.js')}}"></script>
    @yield('js')

    </body>
</html>
