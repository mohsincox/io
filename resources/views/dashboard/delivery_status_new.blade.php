@extends('layouts.app')

@section('content')
<!-- <meta http-equiv="refresh" content="10" /> -->
<div class="container-fluid">
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Bar Chart of Delivery Status</h3>
                <div class="box-tools pull-right">
                    <h4>Total Order: <b>{{ $totalToday }}</b></h4>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="chart">
                            <strong>Total Order <span class="pull-right"><i class="fa fa-circle text-blue"></i> Total</span></strong>
                            <canvas id="barChart_total" style="height:300px"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="chart">
                            <strong>Order in Pie Chart <span class="pull-right"><i class="fa fa-circle" style="color: #3DC3EC"></i> Dhaka South &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-circle" style="color: #A04000;"></i> Dhaka North </span></strong>
                            <canvas id="pieChart" style="height:300px"></canvas>
                        </div>
                    </div>
                </div>
                <!-- <div class="container">
                    <div class="chart">
                        <strong>Total Order of Today <span class="pull-right"><i class="fa fa-circle text-blue"></i> Total</span></strong>
                        <canvas id="barChart_total" style="height:230px"></canvas>
                    </div>
                </div> -->
                <div class="chart">
                    <strong>Delivery Status of Today 
                        <span class="pull-right">
                            <i class="fa fa-circle" style="color: #D3D6DE"></i> Confirmed  <span class="label bg-gray" style="font-size: 15px;">{{ array_sum($hourWiseArrConfirmed) }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <i class="fa fa-circle" style="color: #FFA500;"></i> Collected <span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ array_sum($hourWiseArrDepot) }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <i class="fa fa-circle" style="color: #FFFF00"></i> On the way <span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ array_sum($hourWiseArrDeliver) }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-circle" style="color: #008000;"></i> Delivered <span class="label bg-green" style="font-size: 15px;">{{ array_sum($hourWiseArrCompleted) }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <i class="fa fa-circle" style="color: #FF0000;"></i> Cancelled <span class="label bg-red" style="font-size: 15px;">{{ array_sum($hourWiseArrCancelled) }}</span>
                        </span>
                    </strong>
                    <canvas id="barChart_status" style="height:230px"></canvas>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Table View</h3>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Delivery Status</th>
                                <th>09-10 AM</th>
                                <th>10-11 AM</th>
                                <th>11-12 AM</th>
                                <th>12-01 PM</th>
                                <th>01-02 PM</th>
                                <th>02-03 PM</th>
                                <th>03-04 PM</th>
                                <th>04-05 PM</th>
                                <th>05-06 PM</th>
                                <th>06-07 PM</th>
                                <th>07-08 PM</th>
                                <th>08-09 PM</th>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[0] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[1] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[2] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[3] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[4] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[5] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[6] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[7] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[8] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[9] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[10] }}</span></td>
                                <td class="text-center"><span class="label bg-blue" style="font-size: 15px;">{{ $hourWiseArrTotal[11] }}</span></td>
                            </tr>
                            <tr>
                                <td>Confirmed</td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[0] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[1] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[2] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[3] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[4] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[5] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[6] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[7] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[8] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[9] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[10] }}</span></td>
                                <td class="text-center"><span class="label bg-gray" style="font-size: 15px;">{{ $hourWiseArrConfirmed[11] }}</span></td>
                            </tr>
                            <tr>
                                <td>Collected</td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[0] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[1] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[2] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[3] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[4] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[5] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[6] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[7] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[8] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[9] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[10] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #F9A12E; font-size: 15px;">{{ $hourWiseArrDepot[11] }}</span></td>
                            </tr>
                            <tr>
                                <td>On the way</td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[0] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[1] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[2] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[3] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[4] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[5] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[6] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[7] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[8] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[9] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[10] }}</span></td>
                                <td class="text-center"><span class="label" style="background-color: #FCFF43; color: #000000; font-size: 15px;">{{ $hourWiseArrDeliver[11] }}</span></td>
                            </tr>
                            <tr>
                                <td>Delivered</td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[0] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[1] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[2] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[3] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[4] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[5] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[6] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[7] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[8] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[9] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[10] }}</span></td>
                                <td class="text-center"><span class="label bg-green" style="font-size: 15px;">{{ $hourWiseArrCompleted[11] }}</span></td>
                            </tr>
                            <tr>
                                <td>Cancelled</td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[0] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[1] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[2] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[3] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[4] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[5] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[6] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[7] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[8] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[9] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[10] }}</span></td>
                                <td class="text-center"><span class="label bg-red" style="font-size: 15px;">{{ $hourWiseArrCancelled[11] }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Area Chart</h3>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="areaChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Line Chart</h3>
                        <div class="box-tools pull-right">
                
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="lineChart" style="height:250px"></canvas>
                        </div>
                    </div>
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

            var hourWiseArrConfirmed = <?php echo json_encode($hourWiseArrConfirmed); ?>;
            var hourWiseArrDepot = <?php echo json_encode($hourWiseArrDepot); ?>;
            var hourWiseArrDeliver = <?php echo json_encode($hourWiseArrDeliver); ?>;
            var hourWiseArrCompleted = <?php echo json_encode($hourWiseArrCompleted); ?>;
            var hourWiseArrCancelled = <?php echo json_encode($hourWiseArrCancelled); ?>;
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
                        data                : hourWiseArrConfirmed
                    },
                    {
                        label               : 'Digital Goods',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : hourWiseArrDepot
                    },
                    {
                        label               : 'Electronics1',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : hourWiseArrDeliver
                    },
                    {
                        label               : 'Digital Goods1',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : hourWiseArrCompleted
                    },
                    {
                        label               : 'Electronics2',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : hourWiseArrCancelled
                    }
                ]
            }
            // barChartData.datasets[0].fillColor   = '#EE5F59'
            // barChartData.datasets[0].strokeColor = '#EE5F59'
            // barChartData.datasets[0].pointColor  = '#EE5F59'

            // barChartData.datasets[1].fillColor   = '#00a65a'
            // barChartData.datasets[1].strokeColor = '#00a65a'
            // barChartData.datasets[1].pointColor  = '#00a65a'

            barChartData.datasets[1].fillColor   = '#FFA500'
            barChartData.datasets[1].strokeColor = '#FFA500'
            barChartData.datasets[1].pointColor  = '#FFA500'

            barChartData.datasets[2].fillColor   = '#FFFF00'
            barChartData.datasets[2].strokeColor = '#FFFF00'
            barChartData.datasets[2].pointColor  = '#FFFF00'

            barChartData.datasets[3].fillColor   = '#008000'
            barChartData.datasets[3].strokeColor = '#008000'
            barChartData.datasets[3].pointColor  = '#008000'

            barChartData.datasets[4].fillColor   = '#FF0000'
            barChartData.datasets[4].strokeColor = '#FF0000'
            barChartData.datasets[4].pointColor  = '#FF0000'

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

        
        var totalTodayNorth = <?php echo $totalTodayNorth ?>;
        var totalTodaySouth = <?php echo $totalTodaySouth ?>;
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieChart       = new Chart(pieChartCanvas)
        var PieData        = [
          {
            value    : totalTodayNorth,
            color    : '#A04000',
            highlight: '#A04000',
            label    : 'Dhaka North'
          },
          {
            value    : totalTodaySouth,
            color    : '#3DC3EC',
            highlight: '#3DC3EC',
            label    : 'Dhaka South'
          }
        ]

        var pieOptions     = {
          segmentShowStroke    : true,
          segmentStrokeColor   : '#fff',
          segmentStrokeWidth   : 2,
          percentageInnerCutout: 50,
          animationSteps       : 100,
          animationEasing      : 'easeOutBounce',
          animateRotate        : true,
          animateScale         : false,
          responsive           : true,
          maintainAspectRatio  : true,
          legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        pieChart.Doughnut(PieData, pieOptions)



        var hourWiseArrTotal = <?php echo json_encode($hourWiseArrTotal); ?>;
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        var areaChart       = new Chart(areaChartCanvas)

        var areaChartData = {
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
              data                : hourWiseArrTotal
            }
          ]

          }

          areaChartData.datasets[0].fillColor = "#5B9AC1";
          areaChartData.datasets[0].strokeColor = "#5B9AC1";
          areaChartData.datasets[0].pointColor = "#5B9AC1";

        var areaChartOptions = {
          showScale               : true,
          scaleShowGridLines      : false,
          scaleGridLineColor      : 'rgba(0,0,0,.05)',
          scaleGridLineWidth      : 1,
          scaleShowHorizontalLines: true,
          scaleShowVerticalLines  : true,
          bezierCurve             : true,
          bezierCurveTension      : 0.3,
          pointDot                : false,
          pointDotRadius          : 4,
          pointDotStrokeWidth     : 1,
          pointHitDetectionRadius : 20,
          datasetStroke           : true,
          datasetStrokeWidth      : 2,
          datasetFill             : true,
          legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
          maintainAspectRatio     : true,
          responsive              : true
        }

        
        areaChart.Line(areaChartData, areaChartOptions)

        
        var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
        var lineChart                = new Chart(lineChartCanvas)
        var lineChartOptions         = areaChartOptions
        lineChartOptions.datasetFill = false
        lineChart.Line(areaChartData, lineChartOptions)

    </script>
</script>
@endsection