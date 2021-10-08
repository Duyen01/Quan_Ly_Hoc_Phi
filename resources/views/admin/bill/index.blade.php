@extends('layouts.admin')
@section('main')

<h1>Bill</h1>
<a class="btn btn-secondary " href="{{ url()->previous() }}
">Go back</a>
<hr>
<form action="" class="form-inline" method="get">
    @csrf
    <div class="form-group">
        <input class="form-control" name="key" value="{{$key}}" class="form-control" placeholder="Enter name..." aria-describedby="helpId">
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
<a href="{{route('bill.create')}}" class="btn btn-primary">Add bill</a>
<hr>
    <table id="myTable" class="table table-hover table-striped">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Student</th>
                <th>Email</th>
                <th>Grade</th>
                <th>Datetime</th>
                <th>Money</th>
                <th>Admin</th>
                <th>Note</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($bill as $bil)    
            <tr>
                {{-- <td>{{$bil->id}}</td> --}}
                <td>{{($bil->firstname).
                    " ".($bil->lastname)}}</td>
                <td>{{$bil->email}}</td>
                <td>{{$bil->nameGrade}}</td>
                <td>{{$bil->dateTime}}</td>
                <td>{{number_format($bil->money)}}đ</td>
                <td>{{$bil->nameAdmin}}</td>
                <td>{{$bil->note}}</td>
                <td>
                    <form action="{{route('front.fb')}}" method="POST">
                        @csrf
                        <input type="hidden" name="idBill" value="{{$bil->id}}">
                        {{-- @method('PUT') --}}
                        <button class="btn btn-primary" onclick="return confirm('Gửi email cho {{$bil->lastname}}?')">
                        <i class="fas fa-mail-bulk"></i>
                    </button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{route('bill.detail', $bil->id)}}">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>  
                           
            </tr>
        @endforeach    
        </tbody>
    </table>
    <div class="">
        {{$bill -> appends(request()->all())->links()}}
    </div>
    @stop()

{{-- 
@section('js')

<script>
    $(document).ready(function(){
        $('#myTable').dataTable();
    });
</script> --}}


{{-- @stop() --}}