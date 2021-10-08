@extends('layouts.admin')
@section('main')

    <h1>Add Major</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('major.store') }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">Name Major</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name major here...">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dayAdmission">dayAdmission Major</label>
                        <input type="date" class="form-control" name="dayAdmission">
                        @error('dayAdmission')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form> 
    </div>

@stop()
{{-- @section('css')
    <! summernote>
    <link rel="stylesheet" href="{{ asset('ad/plugins/summernote/summernote-bs4.min.css') }}">
@stop()

@section('js')
    <! Summernote >
    <script src="{{ asset('ad/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#content').summernote({
                height: 150,
                placeholder: "Product description..."
            });

            // CodeMirror
        });

        // hide modal
     
        
    </script>
<script src="{{ url('ad') }}/js/slug.js"></script>
@stop()

 --}}