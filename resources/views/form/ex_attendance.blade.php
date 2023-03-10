@extends('layouts.master')
@section('editemp_noti_dot')
noti-dot
@endsection

@section('att_ad')
active
@endsection


@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Attendance (Admin)</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance (Admin)</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form action="/search-attendance-data" method="POST">
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="emp_name">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" name="month">
                            <option disabled selected>--Select--</option>
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                        <label class="focus-label">Select Month</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" name="year">
                            <option disabled selected>--Select--</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                        <label class="focus-label">Select Year</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button class="btn btn-success btn-block" type="submit"> Search </button>
                </div>
            </div>
        </form>
        <!-- /Search Filter -->


        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table table-nowrap mb-0" id="datatable">
                        <thead>
                            <tr>

                                <th>Employee Name</th>
                                @php
                                $today = today();
                                $dates = [];

                                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                    $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                    }

                                    @endphp
                                    @foreach ($dates as $date)
                                    <th>


                                        {{ $date }}

                                    </th>


                                    @endforeach

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_name as $ad)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar avatar-sm" href="#"><img alt="images/default.png" src="/assets/employee_image/{{ $ad->avatar }}"></a>
                                        <a href="#">{{ $ad->name }}</a>
                                    </h2>
                                </td>
                                @for ($i = 1; $i < $today->daysInMonth + 1; ++$i)



                                    <td>

                                        <div class="form-check form-check-inline ">

                                            @if (isset($check_attd))
                                            @if ($check_attd->status==1)
                                            <i class="fa fa-check text-success"></i>
                                            @else
                                            <i class="fa fa-check text-danger"></i>
                                            @endif

                                            @else
                                            <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </div>
                                        <div class="form-check form-check-inline">

                                            @if (isset($check_leave))
                                            @if ($check_leave->status==1)
                                            <i class="fa fa-check text-success"></i>
                                            @else
                                            <i class="fa fa-check text-danger"></i>
                                            @endif

                                            @else
                                            <i class="fas fa-times text-danger"></i>
                                            @endif


                                        </div>

                                    </td>
                                    @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Attendance Modal -->
    <div class="modal custom-modal fade" id="attendance_info" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card punch-status">
                                <div class="card-body">
                                    <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                                    <div class="punch-det">
                                        <h6>Punch In at</h6>
                                        <p>Wed, 11th Mar 2019 10.00 AM</p>
                                    </div>
                                    <div class="punch-info">
                                        <div class="punch-hours">
                                            <span>3.45 hrs</span>
                                        </div>
                                    </div>
                                    <div class="punch-det">
                                        <h6>Punch Out at</h6>
                                        <p>Wed, 20th Feb 2019 9.00 PM</p>
                                    </div>
                                    <div class="statistics">
                                        <div class="row">
                                            <div class="col-md-3 col-3 text-center">
                                            </div>
                                            <div class="col-md-6 col-6 text-center">
                                                <div class="stats-box">
                                                    <p>Break</p>
                                                    <h6>1.21 hrs</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card recent-activity">
                                <div class="card-body">
                                    <h5 class="card-title">Activity</h5>
                                    <ul class="res-activity-list">
                                        <li>
                                            <p class="mb-0">Punch In at</p>
                                            <p class="res-activity-time">
                                                <i class="fa fa-clock-o"></i>
                                                10.00 AM.
                                            </p>
                                        </li>
                                        <li>
                                            <p class="mb-0">Punch Out at</p>
                                            <p class="res-activity-time">
                                                <i class="fa fa-clock-o"></i>
                                                11.00 AM.
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Attendance Modal -->
</div>
<!-- Page Wrapper -->
@endsection