@extends('layouts.admin')
@section('main')

    <h1>Edit Type of Pay</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('typepay.update',$typepay->id) }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="typeofpay">Type of Pay</label>
                        <input type="text" class="form-control" name="typeofpay" id="typeofpay" value="{{$typepay->typeofpay}}">
                        @error('typeofpay')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">Discount</label>
                        <input type="text" class="form-control" name="discount" value="{{$typepay->discount}}">
                        @error('discount')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="begin">Date Begin</label>
                        <input type="number" class="form-control" name="begin" value="{{$typepay->begin}}">
                        @error('begin')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end">Date End</label>
                        <input type="number" class="form-control" name="end" value="{{$typepay->end}}">
                        @error('end')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 
    </div>

@stop()
