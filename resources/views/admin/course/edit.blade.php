@extends('layouts.admin')
@section('main')

    <h1>Edit Course</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('course.update', $course->id) }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">Name Course</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $course->name }}">
                        @error('name')
                            <small class="alert help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 
    </div>

@stop()
@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('ad/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

