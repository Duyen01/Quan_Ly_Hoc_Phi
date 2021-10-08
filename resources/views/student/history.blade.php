@extends('layouts.site')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
<div class="container">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table id="myTable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Datetime</th>
                                <th>Money</th>
                                <th>Admin</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $key =>$value)    
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$value->dateTime}}</td>
                                <td>{{number_format($value->money)}}đ</td>
                                <td>{{$value->nameAdmin}}</td>
                                <td>{{$value->note}}</td>                
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin: 0 auto;display: inline-block;">
                    {{$bill -> appends(request()->all())->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@stop