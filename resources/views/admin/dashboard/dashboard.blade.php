@extends('admin.layouts.adminApp')


@section('css')

<!-- Chart.js CSS -->
<link href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css" rel="stylesheet">

@endsection

@section('content')

    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Chart Js <small>Some examples to get you started</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div> 
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Yearly<small>Report</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="yearly_chart"></canvas>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Monthly<small>Report</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="monthly_chart"></canvas>
                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daily<small>Report</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="daily_chart"></canvas>
                  </div>
                </div>
              </div>
            </div>





        </div>
    </div>


   

            








@endsection



@push('javascript')


<!-- Chart.js -->
<script src= "{{ asset('adminAssets/vendors/Chart.js/dist/Chart.min.js') }}"></script>


<script>

$(document).ready(function(){

    
            // chart yearly
            var url_yearly = "{{route('yearly.chart')}}";
            var Pendapatan = new Array();
            var Bulan = new Array();

              $.get(url_yearly, function(response){
                response.forEach(function(data){
                    Pendapatan.push(data.pendapatan);
                                       
                    Bulan.push(data.bulan);
                    
                });

                    var ctx = document.getElementById('yearly_chart');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Bulan,
                            datasets: [{
                                label: 'Pendapatan',
                                data: Pendapatan,
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });


            
            // Chart Monthly

            var url_monthly = "{{route('monthly.chart')}}";
            var Weekly_Pendapatan = new Array();
            var Minggu = new Array();

                $.get(url_monthly, function(response){
                response.forEach(function(data){
                    Weekly_Pendapatan.push(data.pendapatan);
  
                    Minggu.push(data.weeks);
                    // console.log(response);
                    
                });

                    var ctx2 = document.getElementById('monthly_chart');
                    var myChart = new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: Minggu,
                            datasets: [{
                                label: 'Pendapatan',
                                data: Weekly_Pendapatan,
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });


            // Chart Daily

            var url_daily = "{{route('daily.chart')}}";
            var Daily_Pendapatan = new Array();
            var Hari = new Array();

                $.get(url_daily, function(response){
                response.forEach(function(data){
                    Daily_Pendapatan.push(data.pendapatan);
  
                    Hari.push(data.hari);
                    // console.log(data.hari);
                    
                });

                    var ctx3 = document.getElementById('daily_chart');
                    var myChart = new Chart(ctx3, {
                        type: 'bar',
                        data: {
                            labels: Hari,
                            datasets: [{
                                label: 'Pendapatan',
                                data: Daily_Pendapatan,
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                });




});
            


</script>



@endpush