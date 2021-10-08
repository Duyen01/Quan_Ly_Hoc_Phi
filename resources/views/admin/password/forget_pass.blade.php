@extends('layouts.app')
@section('main')
<div class="login-box">
  <div class="login-logo">
    <a href="{{route('admin.dashboard')}}"><b>Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Here you can easily retrieve a new password.</p>

      <form action="{{route('recover_pass')}}" method="post">
      	@csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email_account">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{route('admin.login')}}">Login</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
