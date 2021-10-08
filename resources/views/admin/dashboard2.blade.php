@extends('layouts.admin')
@section('main')
<div class="row">
	<div class="col-md-9">
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var data = <?php echo ($data)?>;
var ctx = document.getElementById('myChart').getContext('2d');
var labels = [];
var result = [];
for (var i in data) {
    labels.push(data[i].idStudent);
    result.push(data[i].so_luong);
}
console.log(labels);
console.log(result);
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Số giờ làm',
            data: result,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
               
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
               
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
