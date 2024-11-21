@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Grafik Penjualan</div>
                <div class="card-body">
                    <div id="grafik"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding-bottom: 30px"> <a class="btn btn-primary mt-3" href="{{ url('/laporan') }}">Kembali</a></div>
</div>
   <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
   var pendapatan = <?php echo json_encode($harga) ?>;
var bulan = <?php echo json_encode($bulan) ?>;
var data = [];

// Combine the bulan and pendapatan arrays into a single array of objects
for (var i = 0; i < bulan.length; i++) {
    data.push({ bulan: bulan[i], pendapatan: pendapatan[i] });
}

// Sort the data array based on the bulan values
data.sort(function(a, b) {
    return new Date(a.bulan) - new Date(b.bulan);
});
data.sort(function(a, b) {
    var bulanA = new Date(a.bulan);
    var bulanB = new Date(b.bulan);
    return bulanA - bulanB;
});
// Extract the sorted bulan and pendapatan arrays
bulan = data.map(function(obj) {
    return obj.bulan;
});

pendapatan = data.map(function(obj) {
    return obj.pendapatan;
});

Highcharts.chart('grafik', {
    title: {
        text: 'Grafik pendapatan bulanan'
    },
    xAxis: {
        categories: bulan
    },
    yAxis: {
        title: {
            text: 'Nominal Pendapatan Bulanan'
        }
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br />',
        pointFormat: 'bulan = {point.x}, pendapatan = {point.y}'
    },
    series: [{
        name: 'Nominal Pendapatan',
        data: pendapatan
    }]
});
    </script>
@endsection