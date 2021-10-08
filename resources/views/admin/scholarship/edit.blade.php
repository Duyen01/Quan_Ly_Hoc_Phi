@extends('layouts.admin')
@section('main')

    <h1>Edit Scholarship</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('scholarship.update', $scholarship->id) }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">Scholarship</label>
                        <input type="text" class="form-control" name="money" id="money" value="{{ $scholarship->money }}">
                        @error('money')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 
    </div>

@stop()
