@extends('layouts.admin')
@section('main')

    <h1>Edit Student</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('student.update', $student->id) }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" value="{{ $student->firstname }}" name="firstName" required>
                        @error('firstName')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" value="{{ $student->lastname }}" name="lastName" required>
                        @error('lastName')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" value="{{ $student->email }}" name="email" required>
                        @error('email')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                        <input type="hidden" class="form-control" id="password" value="{{ $student->password }}" name="password" required>
                    
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" value="{{$student->phone}}" 
                            name="phone" required>
                        @error('phone')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" value="{{$student->address}}" 
                            name="address" required>
                        @error('address')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of birth:</label>
                        <input type="date" class="form-control" id="dob" value="{{$student->dob}}" 
                            name="dob" required>
                        @error('dob')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="idScholarship">Scholarship:</label>
                        <select name="idScholarship" id="idScholarship" class="form-control">
                            <option value="">Select scholarship</option>
                            @foreach ($scholarship as $scholarships)
                                <option {{ ($scholarships->id) == ($student->scholarships->id) ? 'selected' : '' }} value="{{ $scholarships->id }}">{{ number_format($scholarships->money) }}đ</option>
                            @endforeach
                        </select>
                        @error('idScholarship')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="idGrade">Grade:</label>
                        <select name="idGrade" id="idGrade" class="form-control">
                            <option value="">Select grade</option>
                            @foreach ($grade as $gra)
                                <option {{ ($gra->id) == ($student->grade->id) ? 'selected' : '' }} value="{{ $gra->id }}">{{ $gra->name }}</option>
                            @endforeach
                        </select>
                        @error('idGrade')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="idTypePay">Type of Pay:</label>
                        <select name="idTypePay" id="idTypePay" class="form-control">
                            <option value="">Select type of pay</option>
                            @foreach ($typepay as $typ)
                                <option {{ ($typ->id) == ($student->typeofpay->id) ? 'selected' : '' }} value="{{ $typ->id }}">{{ $typ->typeofpay }}</option>
                            @endforeach
                        </select>
                        @error('idTypePay')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <div>
                            <input {{$student->gender == '1' ? "checked" : ""}} type="radio" value="1" id="gender" name="gender"> <label for="Male">Male</label>
                            <input {{$student->gender == '0' ? "checked" : ""}} type="radio" value="0" id="gender" name="gender"> <label for="Female">Female</label>
                        </div>
                        @error('gender')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Reset password:</label>
                        <div>
                            <input type="radio" id="password" name="password"> <label for="yes">Yes</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

@stop()
