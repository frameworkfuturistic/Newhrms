@extends('layouts.master')

@section('dashboard_dot_class')
noti-dot
@endsection

@section('dashboard_active')
active
@endsection

@section('content')

<div class="page-wrapper">
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img src="{{ URL::to('/assets/employee_image/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, Admin {{ Auth::user()->name }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-book"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $pendingLeaves }}</h3> <span>Pending Leaves</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-address-book"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $totalStaff }}</h3> <span>Total Staff</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden">
                <input type="hidden" id="totalNoOfStaff" value="{{ $totalStaff }}">
            </div>


            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $totalPresentStaff }}</h3> <span>Present Staff</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-id-card"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $totalStaff - $totalPresentStaff }}</h3> <span>Absent Staff</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-md-6">
                <div class="card">
                    <div class="card-header">Level Wise Percentage</div>
                    <div class="card-body" style="height: 420px">
                        <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-6">
                <div class="card">
                    <div class="card-header">Total No. of Employees</div>
                    <div class="card-body" style="height: 420px">
                        <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div> <canvas id="chart-emp" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


</div>

@section('script')


<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script>
    $(document).ready(function() {
        var ctx = $("#chart-line");
        var myLineChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["State Level", "District Level", "Block Level"],
                datasets: [{
                    data: [120, 170, 80],
                    backgroundColor: ["rgba(255, 0, 0, 1)", "rgba(100, 255, 0, 1)", "rgba(200, 50, 255, 1)"]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Level'
                }
            }
        });
    });


    $(document).ready(function() {
        var ctx = $("#chart-emp");
        var totalStaff = document.getElementById('totalNoOfStaff').value;
        var myLineChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Total Employees"],
                datasets: [{
                    data: totalStaff,
                    backgroundColor: ["rgba(255, 0, 0, 1)"]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Level'
                }
            }
        });
    });
</script>

@endsection
@endsection