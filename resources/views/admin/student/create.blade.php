@extends('layouts.admin')
@section('main')

    <h1>Add Student</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('student.store') }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    {{-- @method('PUT') --}}
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First name here..." name="firstName" required>
                        @error('firstName')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last name here..." name="lastName" required>
                        @error('lastName')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" placeholder="Email..." name="email" required>
                        @error('email')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" placeholder="Phone number..."
                            name="phone" required>
                        @error('phone')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" placeholder="Address..."
                            name="address" required>
                        @error('address')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of birth:</label>
                        <input type="date" class="form-control" id="dob" placeholder="Date of birth..."
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
                                <option value="{{ $scholarships->id }}">{{ number_format($scholarships->money) }}đ</option>
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
                                <option value="{{ $gra->id }}">{{ $gra->name }}</option>
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
                                <option value="{{ $typ->id }}">{{ $typ->typeOfPay }}</option>
                            @endforeach
                        </select>
                        @error('idTypePay')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Password here..." name="password" required>
                        @error('password')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pwd">Gender:</label>
                        <div>
                            <input type="radio" checked value="1" name="gender"> <label for="pwd">Male</label>
                            <input type="radio" value="0" name="gender"> <label for="pwd">Female</label>
                            @error('gender')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                        </div>
                    </div>
{{-- 
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <div>
                            <input type="radio" checked value="1" id="status" name="status"> <label for="pwd">Public</label>
                            <input type="radio" value="0" id="status" name="status"> <label for="pwd">Private</label>
                            @error('status')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                        </div>
                    </div> --}}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

@stop()
