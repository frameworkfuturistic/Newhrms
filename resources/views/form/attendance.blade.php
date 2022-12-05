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
                <div class="col-sm-6">
                    <h3 class="page-title">Attendance (Admin)</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance (Admin)</li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#change_date_cycle"><i class="fa fa-plus"></i>Change Date cycle</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        {{-- message --}}
        {!! Toastr::message() !!}

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
                                <th>S.No.</th>
                                <th hidden>userID</th>
                                <th>Employee Name</th>
                                @foreach($no_of_days as $no_of_day)
                                <th>{{$no_of_day}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userAttendance as $key=>$ads)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td hidden class="ref_id">{{$ads[0]->refUserId}}</td>
                                <td>{{$ads[0]->name}}</td>

                                @foreach($ads as $ad)

                                @if($ad->selected_date > $currentDate)
                                <td><span class="first-off"><span class="text-secondary">--</span></span></td>
                                @else

                                @if($ad->attend_status==1)

                                <td hidden class="date_of_attend">{{ $ad->attend_date }}</td>
                                <td hidden class="time_in">{{ $ad->time_in }}</td>
                                <td hidden class="time_out">{{ $ad->time_out }}</td>
                                <td><a class="insertData" data-toggle="modal" data-target="#attendance_info"><span class="text-success">P</span></a></td>
                                @elseif($ad->attend_status==0)
                                <td><span class="first-off"><span class="text-danger">A</span></span></td>
                                @endif

                                @endif

                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Change Date Cycle Modal -->
    <div id="change_date_cycle" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Date Cycle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/change-date-cycle" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Enter From Date <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ $DateCycle }}" id="from_date_cycle" name="from_date_cycle" min="1" max="28">
                            </div>
                            <div class="alert-danger">@error('from_date_cycle'){{ $message }}@enderror</div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Change Date Cycle Modal -->

    <!-- Attendance Modal -->
    <div class="modal custom-modal fade" id="attendance_info" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-half-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card punch-status">
                                <div class="card-body">
                                    <h5 class="card-title">Timesheet <small class="text-muted">
                                            <input type="text" id="date_of_attend" value="" disabled>
                                        </small></h5>
                                    <div class="punch-det">
                                        <h6>Punch In at</h6>
                                        <p><input type="text" id="time_in" value="" disabled></p>
                                    </div>
                                    <div class="punch-info">
                                        <div class="punch-hours">
                                            <span>3.45 hrs</span>
                                        </div>
                                    </div>
                                    <div class="punch-det">
                                        <h6>Punch Out at</h6>
                                        <p><input type="text" id="time_out" value="" disabled></p>
                                    </div>
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

@section('script')
{{-- insert data of time in & time out --}}

<script>
    $(document).on('click', '.insertData', function() {
        var _this = $(this).parents('tr');
        $('#ref_id').val(_this.find('.ref_id').text());
        $('#date_of_attend').val(_this.find('.date_of_attend').text());
        $('#time_in').val(_this.find('.time_in').text());
        $('#time_out').val(_this.find('.time_out').text());
    });
</script>
@endsection