@extends('layouts.admin')
@section('main')

    <h1>Edit Major</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('major.update', $major->id) }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">Name Major</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $major->name }}">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dayAdmission">Ngày nhập học </label>
                        <input type="text" class="form-control" name="dayAdmission" value="{{ $major->dayAdmission }}">
                        @error('dayAdmission')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 
    </div>

@stop()