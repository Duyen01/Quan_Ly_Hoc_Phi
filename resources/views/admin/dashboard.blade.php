@extends('layouts.admin')
@section('main')
{{-- Biểu đồ thống kê số sinh viên đã đóng và chưa đóng trong từng tháng --}}
{{-- Chon nam hien thi --}}
<form action="" method="get">
    @csrf
    <select name="year" class="form-control col-md-4">
        <?php
        for ($i = date('Y'); $i >= (date('Y') - 30); $i--) {
        $selected = (isset($year) && $year == $i) ? 'selected' : '';
        echo "<option value=$i $selected>$i</option>";
        }
        ?>
    </select>
    <button class="btn btn-primary">Select year</button>
</form>
{{-- End form chon nam --}}
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
              	<h5>Tổng tiền đã nhận trong tháng</h5>

                <p>{{number_format((float)$totalMoney)}} VNĐ</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>Số sinh viên đã đóng tháng này</h5>

                <p>{{$totalStudent}}</p>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$year}}</h3>

                <p>User Registrations: {{$totalUserRegistrations}}</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalBill}}</h3>

                <p>Total bill in month</p>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@stop()

@php
	$months = json_encode($dataPointsMonths, JSON_NUMERIC_CHECK);
	$semeters = json_encode($dataPointsSemeters, JSON_NUMERIC_CHECK);
	$years = json_encode($dataPointsYears, JSON_NUMERIC_CHECK);
@endphp

<script>

window.onload = function () {
	var months = {!! $months !!}
	var semeters = {!! $semeters !!}
	var years = {!! $years !!}
	console.log(months)
	console.log(semeters)
	console.log(years)

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Thống kê tổng số tiền đã đóng trong năm "+<?php echo $year;?>
	},
	// subtitles: [{
	// 	text: "Click Legend to Hide or Unhide Data Series"
	// }], 
	// axisX: {
	// 	title: "Tháng"
	// },
	axisY: {
		title: "Tổng tiền",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC",
		includeZero: true
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Months",
		showInLegend: true,      
		yValueFormatString: "#,##0.# VNĐ",
		dataPoints: months
	},
	{
		type: "column",
		name: "Semeters",
		// axisYType: "secondary",
		showInLegend: true,
		yValueFormatString: "#,##0.# VNĐ",
		dataPoints: semeters
	},
	{
		type: "column",
		name: "Years",
		// axisYType: "secondary",
		showInLegend: true,
		yValueFormatString: "#,##0.# VNĐ",
		dataPoints: years
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}

</script>
