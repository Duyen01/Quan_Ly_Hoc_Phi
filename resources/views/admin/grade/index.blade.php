@extends('layouts.admin')
@section('main')

<h1>List Grade</h1>
<form class="form-inline" method="get">
    @csrf
    <div class="form-group">
        <input type="text" name="key" value="{{$key}}" class="form-control" placeholder="Enter name..." aria-describedby="helpId">
    </div>
    <button class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
                Select major
            </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        <a class="dropdown-item" href="{{route('grade.index')}}">All Major</a>
        <div class="dropdown-divider"></div>
        @foreach ($major as $item)
            <a class="dropdown-item" href="{{ route('grade.filter', $idMajor = $item->id) }}">{{ $item->name }}</a>
            <div class="dropdown-divider"></div>
        @endforeach        
    </div>
</div>
<hr>
<a href="{{route('grade.create')}}" class="btn btn-primary">Add grade</a>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Course</th>
                <th>Major</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $grade)    
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$grade->name}}</td>
                <td>{{$grade->course->name}}</td>
                <td>{{$grade->major->name}}</td>
                {{-- text-right --}}
                <td class="">
                    <a href="{{route('grade.edit', $grade->id)}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    {{-- <a href="{{route('grade.destroy', $grade->id)}}" class="btn btn-danger btndelete">
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
