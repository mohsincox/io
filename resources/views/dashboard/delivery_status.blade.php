@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Bar Chart of Delivery Status</h3>
                <div class="box-tools pull-right">
                    <h4>Total Order: <b>{{ $totalToday }}</b></h4>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <strong>Total Order of Today <span class="pull-right"><i class="fa fa-circle text-blue"></i> Total</span></strong>
                    <canvas id="barChart_total" style="height:230px"></canvas>
                </div>
                <div class="chart">
                    <strong>Delivery Status of Today <span class="pull-right"><i class="fa fa-circle text-red"></i> Pending &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-circle text-green"></i> Completed</span></strong>
                    <canvas id="barChart_status" style="height:230px"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@section('style')
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}"> -->
@endsection

@section('script')
    <script src="{{ asset('assets/js/Chart.js') }}"></script>

    <script>
        $(function () {
            // Delivery Status

            var hourWiseArrPending = <?php echo json_encode($hourWiseArrPending); ?>;
            var hourWiseArrCompleted = <?php echo json_encode($hourWiseArrCompleted); ?>;
            var barChartCanvas                   = $('#barChart_status').get(0).getContext('2d')
            var barChart                         = new Chart(barChartCanvas)
            var barChartData = {
                labels  : ['09-10 AM', '10-11 AM', '11-12 AM', '12-01 PM', '01-02 PM', '02-03 PM', '03-04 PM', '04-05 PM', '05-06 PM', '06-07 PM', '07-08 PM', '08-09 PM'],
                datasets: [
                    {
                        label               : 'Electronics',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : hourWiseArrPending
                    },
                    {
                        label               : 'Digital Goods',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : hourWiseArrCompleted
                    }
                ]
            }
            barChartData.datasets[0].fillColor   = '#EE5F59'
            barChartData.datasets[0].strokeColor = '#EE5F59'
            barChartData.datasets[0].pointColor  = '#EE5F59'

            barChartData.datasets[1].fillColor   = '#00a65a'
            barChartData.datasets[1].strokeColor = '#00a65a'
            barChartData.datasets[1].pointColor  = '#00a65a'

            var barChartOptions                  = {
                scaleBeginAtZero        : true,
                scaleShowGridLines      : true,
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                scaleGridLineWidth      : 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines  : true,
                barShowStroke           : true,
                barStrokeWidth          : 2,
                barValueSpacing         : 5,
                barDatasetSpacing       : 1,
                legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                responsive              : true,
                maintainAspectRatio     : true
            }

            barChartOptions.datasetFill = false
            barChart.Bar(barChartData, barChartOptions)


            // Total Order

            var hourWiseArrTotal = <?php echo json_encode($hourWiseArrTotal); ?>;
            var barChartCanvas1 = $("#barChart_total").get(0).getContext("2d");
            var barChart1 = new Chart(barChartCanvas1);
            var barChartData1 = {
                // labels: ['09 AM', '10 AM', '11 AM', '12 PM', '01 PM', '02 PM', '03 PM', '04 PM', '05 PM', '06 PM', '07 PM', '08 PM'],
                labels  : ['09-10 AM', '10-11 AM', '11-12 AM', '12-01 PM', '01-02 PM', '02-03 PM', '03-04 PM', '04-05 PM', '05-06 PM', '06-07 PM', '07-08 PM', '08-09 PM'],
                datasets: [
                    {
                        label: "Digital Goods",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: hourWiseArrTotal
                    }
                ]
            };
            // barChartData1.datasets[0].fillColor = "#00a65a";
            // barChartData1.datasets[0].strokeColor = "#00a65a";
            // barChartData1.datasets[0].pointColor = "#00a65a";

            var barChartOptions1 = {
                scaleBeginAtZero: true,
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines: true,
                barShowStroke: true,
                barStrokeWidth: 2,
                barValueSpacing: 5,
                barDatasetSpacing: 1,
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                responsive: true,
                maintainAspectRatio: true
            };
            barChartOptions1.datasetFill = false;
            barChart1.Bar(barChartData1, barChartOptions1); 
        });
    </script>
</script>
@endsection