@extends('layouts.master')

@section('editle_noti_dot')
noti-dot
@endsection

@section('leave_ad_active')
active
@endsection


@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Leaves <span id="year"></span></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leaves</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Apply Leave</a>
                </div>
            </div>
        </div>
        <!-- Leave Statistics -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Today Presents</h6>
                    <h4>12 / 60</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Planned Leaves</h6>
                    <h4>8 <span>Today</span></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Unplanned Leaves</h6>
                    <h4>0 <span>Today</span></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Pending Requests</h6>
                    <h4>12</h4>
                </div>
            </div>
        </div>
        <!-- /Leave Statistics -->
        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating">
                    <label class="focus-label">Employee Name</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option selected disabled>Select Leave Type</option>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Earned Leave">Earned Leave</option>
                        <option value="Maternity Leave">Maternity Leave</option>
                        <option value="Paternity Leave">Paternity Leave</option>
                        <option value="Medical Leave">Medical Leave</option>
                        <option value="Leave without Pay">Leave Without Pay</option>
                    </select>
                    <label class="focus-label">Leave Type</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option> -- Select -- </option>
                        <option> Pending </option>
                        <option> Approved </option>
                        <option> Rejected </option>
                    </select>
                    <label class="focus-label">Leave Status</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text">
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text">
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <!-- /Search Filter -->

        <!-- /Page Header -->
        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0" id="datatable">
                        <thead>
                            <tr>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>No of Days</th>
                                <th>Reason</th>
                                <th class="text-center">Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(!empty($leaves))
                            @foreach ($leaves as $items )
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="{{ url('employee/profile/'.$items->rec_id) }}" class="avatar"><img alt="images/default.png" src="{{ URL::to('/assets/employee_image/'. $items->avatar) }}" alt="{{ $items->name }}"></a>
                                        <div>{{ $items->name }}<span>{{ $items->position }}</span></div>
                                    </h2>
                                </td>
                                <td hidden class="id">{{ $items->id }}</td>
                                <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                <td class="leave_type">{{$items->leave_type}}</td>
                                <td hidden class="from_date">{{ $items->from_date }}</td>
                                <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                <td hidden class="to_date">{{$items->to_date}}</td>
                                @if(!empty($items->to_date))
                                <td>{{date('d F, Y',strtotime($items->to_date)) }}</td>
                                @else
                                <td>N/A</td>
                                @endif
                                <td class="day">{{$items->day}} Day</td>
                                <td class="leave_reason">{{$items->leave_reason}}</td>

                                <td class="text-center">
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            @if( $items->status == 'New' )
                                            <i class="fa fa-dot-circle-o text-purple"></i> New
                                            @elseif( $items->status == 'Pending' )
                                            <i class="fa fa-dot-circle-o text-info"></i> Pending
                                            @elseif( $items->status == 'Approved' )
                                            <i class="fa fa-dot-circle-o text-success"></i> Approved
                                            @elseif( $items->status == 'Declined' )
                                            <i class="fa fa-dot-circle-o text-danger"></i> Declined
                                            @endif
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item pendingSubmit" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#pending_leave"><i class="fa fa-dot-circle-o text-info"></i> Pending</a>
                                            <a class="dropdown-item approveSubmit" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                            <a class="dropdown-item declinedSubmit" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#declined_leave"><i class="fa fa-dot-circle-o text-danger"></i> Declined</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item leaveUpdate" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item leaveDelete" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Leave Modal -->
    <div id="add_leave" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('form/leaves/save') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <select class="select" id="leaveType" name="leave_type">
                                <option selected disabled>Select Leave Type</option>
                                <option value="Casual Leave">Casual Leave</option>
                                <option value="Earned Leave">Earned Leave</option>
                                <option value="Maternity Leave">Maternity Leave</option>
                                <option value="Paternity Leave">Paternity Leave</option>
                                <option value="Medical Leave">Medical Leave</option>
                                <option value="Leave without Pay">Leave Without Pay</option>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="rec_id" name="rec_id" value="{{ Auth::user()->rec_id }}">
                        <input type="hidden" class="form-control" id="reporting_auth" name="reporting_auth" value="{{ Auth::user()->reporting_authority }}">
                        <div class="form-group">
                            <label>From <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" id="from_date" name="from_date">
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">(Press if more than 1 day)</label>
                            </div>
                        </div>
                        <div class="form-group leave-to">
                            <label>To</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" id="to_date" name="to_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Leave Reason <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" id="leave_reason" name="leave_reason"></textarea>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Leave Modal -->

    <!-- Edit Leave Modal -->
    <div id="edit_leave" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('form/leaves/edit') }}" method="POST">
                        @csrf
                        <input type="hidden" id="e_id" name="id" value="">
                        <div class="form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <select class="select" id="e_leave_type" name="leave_type">
                                <option selected disabled>Select Leave Type</option>
                                <option value="Casual Leave">Casual Leave</option>
                                <option value="Earned Leave">Earned Leave</option>
                                <option value="Maternity Leave">Maternity Leave</option>
                                <option value="Paternity Leave">Paternity Leave</option>
                                <option value="Medical Leave">Medical Leave</option>
                                <option value="Leave without Pay">Leave Without Pay</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>From <span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" id="e_from_date" name="from_date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" id="e_to_date" name="to_date" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Leave Reason <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" id="e_leave_reason" name="leave_reason" value=""></textarea>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Leave Modal -->

    <!-- Approve Leave Modal -->
    <div class="modal custom-modal fade" id="approve_leave" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Leave Approve</h3>
                        <p>Are you sure want to approve for this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="/form/leaves/status" id="approveSubmit" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="status" class="status" value="Approved">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Approve</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Approve Leave Modal -->

    <!-- Declined Leave Modal -->
    <div class="modal custom-modal fade" id="declined_leave" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Declined Leave</h3>
                        <p>Are you sure want to declined this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="/form/leaves/status" id="declinedSubmit" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="status" class="status" value="Declined">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Declined</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Declined Leave Modal -->

    <!-- Pending Leave Modal -->
    <div class="modal custom-modal fade" id="pending_leave" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Leave Pending</h3>
                        <p>Are you sure want to set pending for this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="/form/leaves/status" id="pendingSubmit" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="status" class="status" value="Pending">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Pending</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Pending Leave Modal -->

    <!-- Delete Leave Modal -->
    <div class="modal custom-modal fade" id="delete_approve" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Leave</h3>
                        <p>Are you sure want to delete this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('form/leaves/edit/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Leave Modal -->
</div>
<!-- /Page Wrapper -->
@section('script')
<script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
</script>
{{-- update js --}}
<script>
    $(document).on('click', '.leaveUpdate', function() {
        var _this = $(this).parents('tr');
        $('#e_id').val(_this.find('.id').text());
        $('#e_number_of_days').val(_this.find('.day').text());
        $('#e_from_date').val(_this.find('.from_date').text());
        $('#e_to_date').val(_this.find('.to_date').text());
        $('#e_leave_reason').val(_this.find('.leave_reason').text());

        var leave_type = (_this.find(".leave_type").text());
        var _option = '<option selected value="' + leave_type + '">' + _this.find('.leave_type').text() + '</option>'
        $(_option).appendTo("#e_leave_type");
    });
</script>
{{-- delete model --}}
<script>
    $(document).on('click', '.leaveDelete', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });
</script>

<!-- approve -->
<script>
    $(document).on('click', '.approveSubmit', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });

    $(document).on('click', '.declinedSubmit', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });

    $(document).on('click', '.pendingSubmit', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });

    //toggle leave to date box
    jQuery($ => {

        $(".leave-to").hide();

        $("#customSwitch1").on("input", function() {
            $(".leave-to").toggle();
        });

    });
</script>

@endsection
@endsection