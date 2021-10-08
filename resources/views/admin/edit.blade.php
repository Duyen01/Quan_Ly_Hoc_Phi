@extends('layouts.admin')
@section('main')

    <h1>Change information</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('admin.update') }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    {{-- @method('PUT') --}}
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" value="{{ $admin->name}}" name="name">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" value="{{ $admin->email}}" name="email" required>
                        @error('email')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">New password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password:</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                        @error('password_confirmation')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="oldpassword" value="{{ $admin->password }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@stop()