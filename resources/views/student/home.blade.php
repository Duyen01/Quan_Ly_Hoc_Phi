@extends('layouts.site')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
<div class="container">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-6">
<div class="form-group label-floating is-empty">
<h3>
<label for=""><b>Student: </b></label>
<label for="">{{$student->firstname . " ". $student->lastname}}</label>
<hr>
<label for=""><b>MSSV</b></label>
<label for="">{{"BKACAD".$student->id."1996"}}</label>
</h3>

</div>
</div>
<div class="col-md-6">
<div class="small-box bg-success">
<div class="inner">

<h3>{{$status? "Hoàn thành học phí":"Chưa hoàn thành học phí"}}
<sup style="font-size: 20px"></sup>
</h3>
</div>
</div>
</div>
</div>

{{-- Thông tin cơ bản sinh viên --}}
<div class="row">
<div class="col-md-6">
<div class="card">
<div class="card-content ">
{{-- <form> --}}
<div class="row">
<div class="col-md-12">
<div class="form-group label-floating is-empty">
<label class="control">Email address</label>
<input type="email" class="form-control" readonly name="email" value="{{ $student->email }}">
<span class="material-input"></span></div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group label-floating is-empty">
    <label class="control">Address</label>
    <input type="text" class="form-control" readonly name="address" value="{{ $student->address }}">
    <span class="material-input"></span></div>
</div>
</div>
<div class="row">
<div class="col-md-4">
    <div class="form-group label-floating is-empty">
        <label class="control">Phone</label>
        <input type="text" class="form-control" readonly name="phone" value="{{ $student->phone }}">
        <span class="material-input"></span></div>
    </div>
    <div class="col-md-4">
        <div class="form-group label-floating is-empty">
            <label class="control">Date of Birth</label>
            <input type="text" class="form-control" readonly name="dob" value="{{ $student->dob }}">
            <span class="material-input"></span></div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating is-empty">
                <label class="control">Gender</label>
                <input type="text" class="form-control" name="idGrade" value="{{ $student->gender == 1 ? "Nam":"Nữ"}}" readonly>
                <span class="material-input"></span></div>
            </div>

        </div>

        <div class="clearfix"></div>
    </div>
</div>
</div>
<div class="col-md-6">
<div class="card">
    <div class="card-content ">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating is-empty">
                    <label class="control">Grade</label>
                    <input type="text" class="form-control" name="idGrade" value="{{ $student->grade->name }}" readonly>

                    <span class="material-input"></span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group label-floating is-empty">
                        <label class="control">Scholarship</label>
                        <input type="text" class="form-control" readonly name="email" value="{{ $student->scholarships->money }}">
                        <span class="material-input"></span></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating is-empty">
                            <label class="control">Typepay</label>
                            <input type="text" class="form-control" readonly name="email" value="{{ $student->typeofpay->typeofpay }}">
                            <span class="material-input"></span></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group label-floating is-empty">
                                <label class="control">Tuition</label>
                                <input type="text" class="form-control" readonly name="email" value="{{ $student->scholarships->money }}">
                                <span class="material-input"></span></div>
                            </div>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Thông tin cơ bản học phí sinh viên --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <span style="font-size: 1.5rem"><b>Tổng đợt đã đóng</b></span>
                <hr>
                <span>{{$so_lan_theo_thang}}</span> Months
                <span>{{$so_lan_theo_ky}}</span> Semeters
                <span>{{$so_lan_theo_nam}}</span> Years
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <span style="font-size: 1.5rem"><b>Tổng số tiền đã đóng</b></span>
                <hr>
                <span>{{number_format($tong_tien)}} VNĐ</span>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
            <div class="inner">
                <span style="font-size: 1.5rem"><b>Số tháng cần đóng</b></span>
                <hr>
                <span>{{($so_thang_phai_dong)}}</span>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
            <div class="inner">
                <span style="font-size: 1.5rem"><b>Ngày nhập học</b></span>
                <hr>
                <span>{{ \Carbon\Carbon::parse($ngay_bat_dau)->format('d/m/Y')}}</span>
            </div>

        </div>
    </div>
    <!-- ./col -->
</div>
{{-- Biểu đồ thống kê học phí  --}}
<div id="chartContainer" style="height: 370px; width: 100%;display: block;margin: 0 auto;"></div>
{{-- Danh sách hóa đơn đã đóng của sinh viên  --}}



<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Học phí đã đóng các tháng trong năm nay"
            },
            axisY: {
                title: "Tổng tiền"
            },
            axisX: {
                title: "Tháng"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }

</script>
{{-- Biểu đồ thống kê số tiền đã đóng --}}
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection