@extends('layouts.admin')
@section('main')

<h1>List Major</h1>
<form class="form-inline" method="get">
    @csrf
    <div class="form-group">
        <input type="text" name="key" value="{{ $key }}" class="form-control" placeholder="Enter name major..." aria-describedby="helpId">
    </div>
    <button class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
<a href="{{route('major.create')}}" class="btn btn-primary">Add major</a>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Ngày nhập học</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $major)    
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$major->name}}</td>
                <td>{{$major->dayAdmission}}</td>
                {{-- text-right --}}
                <td class="">
                    <a href="{{route('major.edit', $major->id)}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    {{-- <a href="{{route('major.destroy', $major->id)}}" class="btn btn-danger btndelete">
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