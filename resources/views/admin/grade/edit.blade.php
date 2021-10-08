@extends('layouts.admin')
@section('main')

    <h1>Edit Grade</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('grade.update', $grade->id) }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">Name Grade</label>
                        <input type="text" class="form-control-file" name="name" id="name" value="{{ $grade->name }}">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="idMajor">Major:</label>
                        <select name="idMajor" id="idMajor" class="form-control">
                            <option value="">Select major</option>
                            @foreach ($major as $maj)
                                <option value="{{ $maj->id }}" {{ ($maj->id) == ($grade->major->id) ? 'selected' : '' }} >{{ $maj->name }}</option>
                            @endforeach
                        </select>
                        @error('idMajor')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="idCourse">Course:</label>
                        <select name="idCourse" id="idCourse" class="form-control">
                            <option value="">Select course</option>
                            @foreach ($course as $cou)
                                <option value="{{ $cou->id }}" {{ ($cou->id) == ($grade->course->id) ? 'selected' : '' }} >{{ $cou->name }}</option>
                            @endforeach
                        </select>
                        @error('idCourse')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 
    </div>

@stop()