@extends('layouts.admin')
@section('main')

<h1>List Scholarship</h1>
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
<a href="{{route('scholarship.create')}}" class="btn btn-primary">Add scholarship</a>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Money</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $scholarship)    
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{number_format($scholarship->money)}}đ </td>
                {{-- text-right --}}
                <td class="">
                    <a href="{{route('scholarship.edit', $scholarship->id)}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                   {{--  <a href="{{route('scholarship.destroy', $scholarship->id)}}" class="btn btn-danger btndelete">
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


    