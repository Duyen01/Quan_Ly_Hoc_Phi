@extends('layouts.admin')
@section('main')
<h1>Thông tin chi tiết hóa đơn</h1>
<a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
<hr>

<div class="container">
<div class="content">
    <div class="container-fluid">
    	<div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating is-empty">
                    <label class="control">First name</label>
                    <input class="form-control" readonly value="{{ $student->firstname }}">
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating is-empty">
                    <label class="control">Last name</label>
                    <input class="form-control" readonly value="{{ $student->lastname }}">
                    <span class="material-input"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating is-empty">
                    <label class="control">Email address</label>
                    <input class="form-control" readonly value="{{ $student->email }}">
                    <span class="material-input"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group label-floating is-empty">
                    <label class="control">Grade</label>
                    <input class="form-control" readonly value="{{ $student->grade->name }}">
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group label-floating is-empty">
                    <label class="control">Gender</label>
                    <input class="form-control" readonly value="{{ $student->gender == 1? "Male":"Female" }}">
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group label-floating is-empty">
                    <label class="control">Course</label>
                    <input class="form-control" readonly value="{{ $student->grade->course->name }}">
                    <span class="material-input"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group label-floating is-empty">
                    <label class="control">DateTime</label>
                    <input class="form-control" readonly value="{{ $student->dateTime }}">
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group label-floating is-empty">
                    <label class="control">Money</label>
                    <input class="form-control" readonly value="{{ $student->money }}">
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group label-floating is-empty">
                    <label class="control">Admin</label>
                    <input class="form-control" readonly value="{{ $student->nameAdmin }}">
                    <span class="material-input"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating is-empty">
                    <label class="control">Scholarship</label>
                    <input class="form-control" readonly value="{{ $student->scholarships->money }}">
                    <span class="material-input"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating is-empty">
                    <label class="control">TypePay</label>
                    <input class="form-control" readonly value="{{ $student->typeofpay }}">
                    <span class="material-input"></span>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating is-empty">
                    <label class="control">Note</label>
                    <input class="form-control" readonly type="text" value="{{$student->note}}">
                    <span class="material-input"></span>
                </div>
            </div>
       
        </div>
    </div>
</div>
</div>
@stop           