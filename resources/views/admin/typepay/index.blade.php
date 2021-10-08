@extends('layouts.admin')
@section('main')

<h1>List Type of Pay</h1>
<form class="form-inline" method="get">
    @csrf
    <div class="form-group">
        <input type="text" name="key" value="{{ $key }}" class="form-control" placeholder="Enter name scholarship..." aria-describedby="helpId">
    </div>
    <button class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
<a href="{{route('typepay.create')}}" class="btn btn-primary">Add typepay</a>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Type of pay</th>
                <th>Discount</th>
                <th>Day Begin</th>
                <th>Day End</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $typepay)    
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$typepay->typeofpay}} </td>
                <td>{{$typepay->discount}} </td>
                <td>{{$typepay->begin}} </td>
                <td>{{$typepay->end}} </td>
                {{-- text-right --}}
                <td class="">
                    <a href="{{route('typepay.edit', $typepay->id)}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    {{-- <a href="{{route('typepay.destroy', $typepay->id)}}" class="btn btn-danger btndelete">
                        <i class="fas fa-trash"></i>
                    </a> --}}
                </td>
                
            </tr>
        @endforeach    
        </tbody>
    </table>
    <hr>
    <div class="">
        {{$data -> appends(request()->all())->links()}}
    </div>
    @stop()