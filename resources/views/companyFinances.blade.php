@extends('layout')
@section('pageH1', 'Finance report for "' . $company->name . '" from ' . $dateStart . ' to ' . $dateEnd)
@section('content')
    @include('_report')
    <canvas id="canvas"></canvas>
@endsection
@section('inlineJs')
    <script type="text/javascript">
        var report = {!! json_encode($report) !!};
        var dataPointsOpen = report.map(function (row) {
            return row[1]
        });
        var dataPointsClose = report.map(function (row) {
            return row[4]
        });
        var labels = report.map(function (row) {
            return [0];
        });
        console.log(dataPointsOpen, dataPointsClose);

        var lineChartData = {
            labels: labels,
            datasets: [{
                label: "Open Price",
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgb(255, 99, 132)',
                fill: false,
                data: dataPointsOpen,
                yAxisID: "y-axis-1",
            }, {
                label: "Close Price",
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgb(54, 162, 235)',
                fill: false,
                data: dataPointsClose,
                yAxisID: "y-axis-2"
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = Chart.Line(ctx, {
                data: lineChartData,
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title:{
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            type: "linear",
                            display: true,
                            position: "left",
                            id: "y-axis-1",
                        }, {
                            type: "linear",
                            display: true,
                            position: "right",
                            id: "y-axis-2",
                        }],
                    }
                }
            });
        };
    </script>
@endsection