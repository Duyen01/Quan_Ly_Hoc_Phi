@extends('layouts.app')
@section('main')
<div class="login-box">
  <div class="login-logo">
    <a href="{{route('admin.dashboard')}}"><b>Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      @php 
            $token = $_GET['token'];
            $email = $_GET['email'];
      @endphp
      <form action="{{route('reset_new_pass')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="hidden" name="email" value="{{$email}}"/>
      <input type="hidden"name="token" value="{{$token}}"/>
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
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