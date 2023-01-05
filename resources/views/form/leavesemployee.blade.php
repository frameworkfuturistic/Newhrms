@extends('layouts.master')

@section('editle_noti_dot')
noti-dot
@endsection

@section('leave_emp_active')
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
                    <h6>Casual Leave </h6>
                    <h4>12</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Earned Leave </h6>
                    <h4>3</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Special Leave</h6>
                    <h4>4</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-info">
                    <h6>Restricted Holiday</h6>
                    <h4>5</h4>
                </div>
            </div>
        </div>
        <!-- /Leave Statistics -->

        {{-- message --}}
        {!! Toastr::message() !!}

        @php
        use Carbon\Carbon;
        $today_date = Carbon::today()->format('Y-m-d');
        @endphp
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
                            @if($items->to_date != null)
                            @if($today_date < $items->from_date)
                                <tr>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                    <td class="leave_type">{{$items->leave_type}}</td>
                                    <td hidden class="from_date">{{ $items->from_date }}</td>
                                    <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                    <td hidden class="to_date">{{$items->to_date}}</td>
                                    <td>{{date('d F, Y',strtotime($items->to_date)) }}</td>
                                    <td class="day">{{$items->day}} Day</td>
                                    <td class="leave_reason">{{$items->leave_reason}}</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
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
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item leaveUpdate" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item leaveDelete" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @elseif(($today_date >= $items->from_date) && ($today_date < $items->to_date))
                                    <tr>
                                        <td hidden class="id">{{ $items->id }}</td>
                                        <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                        <td class="leave_type">{{$items->leave_type}}</td>
                                        <td hidden class="from_date">{{ $items->from_date }}</td>
                                        <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                        <td hidden class="to_date">{{$items->to_date}}</td>
                                        <td>{{date('d F, Y',strtotime($items->to_date)) }}</td>
                                        <td class="day">{{$items->day}} Day</td>
                                        <td class="leave_reason">{{$items->leave_reason}}</td>
                                        <td class="text-center">
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
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
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item leaveUpdate" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @elseif($today_date == $items->to_date)
                                    <tr>
                                        <td hidden class="id">{{ $items->id }}</td>
                                        <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                        <td class="leave_type">{{$items->leave_type}}</td>
                                        <td hidden class="from_date">{{ $items->from_date }}</td>
                                        <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                        <td hidden class="to_date">{{$items->to_date}}</td>
                                        <td>{{date('d F, Y',strtotime($items->to_date)) }}</td>
                                        <td class="day">{{$items->day}} Day</td>
                                        <td class="leave_reason">{{$items->leave_reason}}</td>
                                        <td class="text-center">
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
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
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item leaveUpdate" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="holiday-completed">
                                        <td hidden class="id">{{ $items->id }}</td>
                                        <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                        <td class="leave_type">{{$items->leave_type}}</td>
                                        <td hidden class="from_date">{{ $items->from_date }}</td>
                                        <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                        <td hidden class="to_date">{{$items->to_date}}</td>
                                        <td>{{date('d F, Y',strtotime($items->to_date)) }}</td>
                                        <td class="day">{{$items->day}} Day</td>
                                        <td class="leave_reason">{{$items->leave_reason}}</td>
                                        <td class="text-center">
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
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
                                            </div>
                                        </td>
                                        <td hidden></td>
                                    </tr>
                                    @endif
                                    @endif

                                    @if($items->to_date == null)
                                    @if($today_date < $items->from_date)
                                        <tr>
                                            <td hidden class="id">{{ $items->id }}</td>
                                            <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                            <td class="leave_type">{{$items->leave_type}}</td>
                                            <td hidden class="from_date">{{ $items->from_date }}</td>
                                            <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                            <td hidden class="to_date">{{$items->to_date}}</td>
                                            <td>N/A</td>
                                            <td class="day">{{$items->day}} Day</td>
                                            <td class="leave_reason">{{$items->leave_reason}}</td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
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
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item leaveUpdate" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item leaveDelete" href="#" data-toggle="modal" data-target="#delete_approve"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @elseif($today_date == $items->from_date)
                                        <tr>
                                            <td hidden class="id">{{ $items->id }}</td>
                                            <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                            <td class="leave_type">{{$items->leave_type}}</td>
                                            <td hidden class="from_date">{{ $items->from_date }}</td>
                                            <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                            <td hidden class="to_date">{{$items->to_date}}</td>
                                            <td>N/A</td>
                                            <td class="day">{{$items->day}} Day</td>
                                            <td class="leave_reason">{{$items->leave_reason}}</td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
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
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item leaveUpdate" href="#" data-toggle="modal" data-id="'.$items->id.'" data-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @else
                                        <tr class="holiday-completed">
                                            <td hidden class="id">{{ $items->id }}</td>
                                            <td hidden class="reporting_auth">{{ $items->reporting_authority }}</td>
                                            <td class="leave_type">{{$items->leave_type}}</td>
                                            <td hidden class="from_date">{{ $items->from_date }}</td>
                                            <td>{{date('d F, Y',strtotime($items->from_date)) }}</td>
                                            <td hidden class="to_date">{{$items->to_date}}</td>
                                            <td>N/A</td>
                                            <td class="day">{{$items->day}} Day</td>
                                            <td class="leave_reason">{{$items->leave_reason}}</td>
                                            <td class="text-center">
                                                <div class="action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
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
                                                </div>
                                            </td>
                                            <td hidden></td>
                                        </tr>
                                        @endif
                                        @endif
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
                    <form action="/form/leaves/apply-leave" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Leave Type <span class="text-danger">*</span></label>
                            <select class="select" name="leave_type">
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
                                <input class="form-control datetimepicker" name="from_date" id="from_date" type="text">
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">(Press if more than 1 day)</label>
                            </div>
                        </div>
                        <div class="form-group leave-to">
                            <label>To</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" name="to_date" id="to_date" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Leave Reason <span class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" name="leave_reason"></textarea>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
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
                    <form action="/form/leaves/update" method="POST">
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
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Leave Modal -->

    <!-- Delete Leave Modal -->
    <div class="modal custom-modal fade" id="delete_approve" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Leave</h3>
                        <p>Are you sure want to Cancel this leave?</p>
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

<script>
    var from_date = document.getElementById('from_date');
    var to_date = element.getAttribute('to_date');
    //define two date object variables with dates inside it
    date1 = new Date(from_date);
    date2 = new Date(to_date);

    //calculate time difference
    var time_difference = date2.getTime() - date1.getTime();

    //calculate days difference by dividing total milliseconds in a day
    var days_difference = time_difference / (1000 * 60 * 60 * 24);

    document.write("Number of days between dates <br>" +
        date1 + " and <br>" + date2 + " are: <br>" +
        days_difference + " days");
</script>
<script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
</script>
{{-- update js --}}
<script>
    $(document).on('click', '.leaveUpdate', function() {
        var _this = $(this).parents('tr');
        $('#e_id').val(_this.find('.id').text());
        $('#e_number_of_days').val(_this.find('.day').text());

        let dateObj = new Date();
        // let month = String(dateObj.getMonth() + 1).padStart(2, '0');
        // let day = String(dateObj.getDate()).padStart(2, '0');
        // let year = dateObj.getFullYear();
        // let output = day + '-' + month + '-' + year;
        // let today_date = new Date(output);
        let from_date_val = new Date(_this.find('.from_date').text());

        if (dateObj >= from_date_val) {
            $('#e_from_date').val(_this.find('.from_date').text());
            document.getElementById('e_from_date').readOnly = true;
        } else {
            $('#e_from_date').val(_this.find('.from_date').text());
        }
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


    //toggle leave to date box
    jQuery($ => {

        $(".leave-to").hide();

        $("#customSwitch1").on("input", function() {
            $(".leave-to").toggle();
        });

    });
</script>
@endsection