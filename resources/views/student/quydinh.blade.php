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
	                <h1>Trang thông tin quy định học phí</h1>
            	</div>
        	</div>
    	</div>
	</div>
</div>
@stop