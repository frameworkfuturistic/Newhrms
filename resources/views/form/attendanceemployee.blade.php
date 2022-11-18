@extends('layouts.master')
@section('editemp_noti_dot')
noti-dot
@endsection

@section('att_admin_active')
active
@endsection


@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Timesheet <small class="text-muted">{{ $today_date->isoFormat('MMM Do YYYY') }}</small></h5>
                        <div class="punch-det" style="padding: 15px 20px;">
                            <h6>Punch In at</h6>
                            <p>Wed, {{ $today_date->isoFormat('MMM Do YYYY') }}</p>
                        </div>
                        <div class="punch-det" style="padding: 15px 20px;">
                            <h6>Punch Out at</h6>
                            <p>Wed, 11th Mar 2019 10.00 AM</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card att-statistics">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <div class="stats-list" style="height: auto;">
                            <div class="stats-info">
                                <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input type="text" class="form-control floating datetimepicker">
                    </div>
                    <label class="focus-label">Date</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option>-</option>
                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sep</option>
                        <option>Oct</option>
                        <option>Nov</option>
                        <option>Dec</option>
                    </select>
                    <label class="focus-label">Select Month</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option>-</option>
                        <option>2019</option>
                        <option>2018</option>
                        <option>2017</option>
                        <option>2016</option>
                        <option>2015</option>
                    </select>
                    <label class="focus-label">Select Year</label>
                </div>
            </div>
            <div class="col-sm-3">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <!-- /Search Filter -->

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date </th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>19 Feb 2019</td>
                                <td>10 AM</td>
                                <td>7 PM</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>20 Feb 2019</td>
                                <td>10 AM</td>
                                <td>7 PM</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Content -->


</div>
<!-- /Page Wrapper -->
@section('script')
@endsection
@endsection