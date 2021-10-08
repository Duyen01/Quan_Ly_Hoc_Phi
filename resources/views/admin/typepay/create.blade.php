@extends('layouts.admin')
@section('main')

    <h1>Add Type of Pay</h1>
    <a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
    <div class="container">
        <form action="{{ route('typepay.store') }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="typeOfPay">Type of Pay</label>
                        <input type="text" class="form-control" name="typeOfPay" id="typeOfPay" placeholder="Enter type of pay here...">
                        @error('typeOfPay')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" name="discount" placeholder="Enter discount here...">
                        @error('discount')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="begin">Date Begin</label>
                        <input type="number" class="form-control" name="begin" id="begin" placeholder="Select date begin pay...">
                        @error('begin')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end">Date End</label>
                        <input type="number" class="form-control" name="end" id="end" placeholder="Select date end pay...">
                        @error('end')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form> 
    </div>

@stop()