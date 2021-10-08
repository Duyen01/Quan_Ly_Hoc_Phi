@extends('layouts.admin')
@section('main')

    <h1>Add Tuition</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('tuition.store') }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="idCourse">Course:</label>
                        <select name="idCourse" id="idCourse" class="form-control">
                            <option value="">Select course:</option>
                            @foreach ($cou as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('idCourse')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="idMajor">Major:</label>
                        <select name="idMajor" id="idMajor" class="form-control">
                            <option value="">Select major: </option>
                            @foreach ($maj as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                        @error('idMajor')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tuitionNorm">Standard tuition:</label>
                        <input type="text" class="form-control" id="tuitionNorm" placeholder="Standard tuition here..." name="tuitionNorm">
                        @error('tuitionNorm')
                        <small class="help-block">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form> 
    </div>

@stop()
