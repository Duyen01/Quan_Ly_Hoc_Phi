<!-- check if has session, return homepage, exit -->
@if(Session::has('admin'))
      <script>window.location = "{{ route('admin.dashboard') }}";</script>
      <?php exit; ?>
@endif
<!-- end check -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('ad/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('ad/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('ad/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Login</b></a>
    </div>
    <div class="card-body">
      <!-- Error -->
      @if(Session::exists('error'))
      <div class="alert alert-warning" role="alert">
       {{ Session::get('error')}}
      </div>
      @endif
      @if ($errors->any() && retries > 0)
        <div class="alert alert-warning" role="alert">
          Remaining {{ $retries }} attempt.
        </div>
      @endif
      @if ($retries <= 0)
          <div id="secondsAttempt" class="alert alert-danger" role="alert">
            Please try again after {{ $seconds }} seconds.
          </div>
      @endif
      <form action="{{route('admin.login-process')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input name="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <div class="col-6">
            <a href="{{route('quen_mat_khau')}}">Forget password</a>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<script>
  setInterval(function (){
    // var seconds = document.querySelector('#secondsAttempt')
    $('#secondsAttempt').load(document.URL +  ' #secondsAttempt');
  }, 1000)
  
</script>
<!-- jQuery -->
<script src="{{asset('ad/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('ad/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('ad/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
