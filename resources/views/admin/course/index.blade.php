@extends('layouts.admin')
@section('main')

<h1>List Course</h1>
<form class="form-inline" method="get">
    @csrf
    <div class="form-group">
        <input type="text" name="key" value="{{ $key }}" class="form-control" placeholder="Enter name course..." aria-describedby="helpId">
    </div>
    <button class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
<a href="{{route('course.create')}}" class="btn btn-primary">Add course</a>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $course)    
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$course->name}}</td>
                {{-- text-right --}}
                <td class="">
                    <a href="{{route('course.edit', $course->id)}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    {{-- <a href="{{route('course.destroy', $course->id)}}" class="btn btn-danger btndelete">
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