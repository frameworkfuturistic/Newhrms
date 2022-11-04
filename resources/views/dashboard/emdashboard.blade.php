@extends('layouts.master')

@section('dashboard_dot_class')
noti-dot
@endsection

@section('emp_dashboard_active')
active
@endsection

@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-box">
                    <div class="welcome-img">
                        <img src="{{ URL::to('/assets/employee_image/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="welcome-det">
                        <h3>Welcome, {{ Auth::user()->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-book"></i></span>
                        <div class="dash-widget-info">
                            <h3>20</h3> <span>Holidays</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-address-book"></i></span>
                        <div class="dash-widget-info">
                            <h3>37</h3> <span>Staff Directory</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                        <div class="dash-widget-info">
                            <h3>218</h3> <span>Employees</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-id-card"></i></span>
                        <div class="dash-widget-info">
                            <h3>118</h3> <span>Profile Incomplete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        @php
        $pendingLeaves = DB::table('leaves_admins as la')
        ->leftjoin('users as u', 'la.rec_id', '=', 'u.rec_id')
        ->select('u.name', 'u.rec_id', 'u.avatar', 'u.position', 'u.reporting_authority', 'la.id', 'la.leave_type', 'la.from_date', 'la.to_date', 'la.day', 'la.leave_reason', 'la.status')
        ->where('la.reporting_authority', Auth()->user()->id)
        ->count();
        @endphp
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
                            @php
                            use App\Models\User;
                            $totalStaff = User::select('*')->count();
                            @endphp
                            <h3>{{ $totalStaff }}</h3> <span>Total Staff</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden">
                <input type="hidden" id="totalNoOfStaff" value="{{ $totalStaff }}">
            </div>
            @php
            use Illuminate\Support\Facades\DB;
            $totalPresentStaff = DB::table('attendance_records')->select('attend_date')->where('attend_date',date('Y-m-d'))->count();

            @endphp
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
                    <div class="card-header">Remaining Holidays</div>
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
<!-- /Page Wrapper -->

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