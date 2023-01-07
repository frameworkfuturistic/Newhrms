@extends('layouts.master')


@section('emp_noti')
noti-dot
@endsection
@section('all_user_active')
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
                    <h3 class="page-title">Employee Management</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee</li>
                    </ul>
                </div>

                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add Employee</a>
                </div>
            </div>
        </div>

        <!-- /Page Header -->
        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-md-12">
                <!-- <div class=" row ">
                    <div class="col-md-12">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            View Levelwise
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="/change-levelwise-data" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item" name="level_type" value="1">All Level</button>
                                <button type="submit" class="dropdown-item" name="level_type" value="2">SPRC</button>
                                <button type="submit" class="dropdown-item" name="level_type" value="3">DPRC</button>
                                <button type="submit" class="dropdown-item" name="level_type" value="4">Block Level</button>
                            </form>
                        </div>
                    </div>

                </div>
                <br> -->
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="datatable">
                        <thead>
                            <tr>
                                <th class="text-right">Action</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>CUG</th>
                                <th>Join Date</th>
                                <th>Organisation level </th>
                                <th>Role</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $key=>$user )
                            <tr>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- <a class="dropdown-item userUpdate" data-toggle="modal" data-id="'.$user->id.'" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                            <a class="dropdown-item userUpdate" href="edit-user/{{$user->id}}" target="_blank"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item userDelete" href="#" data-toggle="modal" ata-id="'.$user->id.'" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <!-- <span hidden class="image">{{ $user->avatar}}</span> -->
                                    <h2 class="table-avatar">
                                        <a href="{{ url('employee/profile/'.$user->rec_id) }}" class="avatar"><img src="{{ URL::to('/assets/employee_image/'. $user->avatar) }}" alt="images/default.png"></a>
                                        <a href="{{ url('employee/profile/'.$user->rec_id) }}" class="name">{{ $user->name }}</span></a>
                                    </h2>
                                </td>
                                <!-- <td hidden class="ids">{{ $user->id }}</td>
                                <td hidden class="dobs">{{ $user->dob }}</td>
                                <td hidden class="join_date">{{ $user->join_date }}</td>
                                <td hidden class="d_email">{{ $user->department_email }}</td>
                                <td hidden class="id">{{ $user->rec_id }}</td> -->
                                <td class="email">{{ $user->email }}</td>
                                <td class="position">
                                    {{ $user->post_title }}
                                </td>
                                <td class="CUG">{{ $user->cug_no }}</td>
                                <td>{{ $user->join_date }}</td>
                                <td>{{$user->org_id}}</td>
                                <td>
                                    @if ($user->role_name=='Admin')
                                    <span class="badge bg-inverse-danger role_name">{{ $user->role_name }}</span>
                                    @elseif ($user->role_name=='Employee')
                                    <span class="badge bg-inverse-dark role_name">{{ $user->role_name }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            @if ($user->status=='Active')
                                            <i class="fa fa-dot-circle-o text-success"></i>Active
                                            @elseif ($user->status=='Inactive')
                                            <i class="fa fa-dot-circle-o text-info"></i>Inactive
                                            @elseif ($user->status=='Resign')
                                            <i class="fa fa-dot-circle-o text-danger"></i>Resign
                                            @elseif ($user->status=='')
                                            <i class="fa fa-dot-circle-o text-dark"></i>N/A
                                            @endif
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item activeSubmit" href="#" data-toggle="modal" data-id="
                                              {{ $user->id }}" data-target="#active_modal">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                            <a class="dropdown-item inactiveSubmit" href="#" data-toggle="modal" data-id="'.$user->id.'" data-target="#inactive_modal">
                                                <i class="fa fa-dot-circle-o text-warning"></i> Inactive
                                            </a>
                                            <a class="dropdown-item ResignSubmit" href="#" data-toggle="modal" data-id="'.$user->id.'" data-target="#resign_modal">
                                                <i class="fa fa-dot-circle-o 
                                                text-danger"></i> Resign
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


    <!-- Add User Modal -->
    <div id="add_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user/add/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>First Name<span class="required">*</span></label>
                                    <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="" name="first_name" value="{{ old('first_name') }}" placeholder="Enter Your First Name" required />
                                    <div class="alert-danger">@error('first_name'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input class="form-control @error('middle_name') is-invalid @enderror" type="text" id="" name="middle_name" value="{{ old('middle_name') }}" placeholder="Enter Your Middle Name" />
                                    <div class="alert-danger">@error('middle_name'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Your Last Name" />
                                    <div class="alert-danger">@error('last_name'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Employee ID<span class="required">*</span></label>
                                    <input class="form-control @error('emp_id') is-invalid @enderror" type="text" id="" name="emp_id" value="{{ old('emp_id') }}" placeholder="Enter Employee ID">
                                    <div class="alert-danger">@error('emp_id'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Gender<span class="required">*</span></label>
                                    <select class="select form-control" name="gender" id="gender">
                                        <option selected disabled> --Select --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <div class="alert-danger">@error('gender'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select form-control" name="category" id="category">
                                        <option selected disabled> --Select --</option>
                                        <option value="General">General</option>
                                        <option value="OBC">OBC</option>
                                        <option value="ST">ST</option>
                                        <option value="SC">SC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date Of Birth<span class="required">*</span></label>
                                    <input class="form-control" type="date" id="" name="dob" placeholder="Enter Your date of birth" required />
                                    <div class="alert-danger">@error('dob'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Profile Photo</label>
                                    <input class="form-control" type="file" id="image" name="image" />
                                    <div class="alert-danger">@error('image'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Personal E-mail<span class="required">*</span></label>
                                    <input class="form-control" type="email" id="" name="email" placeholder="Enter Your Personal Email" required />
                                    <div class="alert-danger">@error('email'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Department Email</label>
                                    <input class="form-control" type="email" id="" name="department_email" placeholder="Enter Your Department Email" />
                                    <div class="alert-danger">@error('department_email'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date Of Joining<span class="required">*</span></label>
                                    <input class="form-control" type="date" id="" name="join_date" placeholder="Enter Date Of Joining" required />
                                    <div class="alert-danger">@error('join_date'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Organization Level<span class="required">*</span></label>
                                    <select class="select form-control" name="organ_level" id="org_level">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($organisation['data'] as $org )
                                        <option value="{{ $org->org_id }}">{{ $org->org_level }}</option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">@error('organ_level'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Office Name<span class="required">*</span></label>
                                    <select class="select form-control" name="office_name" id="office_name">
                                        <option selected disabled> --Select --</option>
                                    </select>
                                    <div class="alert-danger">@error('office_name'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Employee Type<span class="required">*</span></label>
                                    <select class="select form-control" name="emp_type" id="">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($employee_types as $et )
                                        <option value="{{ $et->emp_type_id }}">{{ $et->emp_type }}</option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">@error('emp_type'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Post<span class="required">*</span></label>
                                    <select class="select form-control" name="position" id="positions">
                                        <option selected disabled> --Select --</option>
                                    </select>
                                    <div class="alert-danger">@error('position'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Designation<span class="required">*</span></label>
                                    <select class="select form-control" name="designation" id="designation">
                                        <option selected disabled> --Select --</option>
                                    </select>
                                    <div class="alert-danger">@error('designation'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Pay Slab<span class="required">*</span></label>
                                    <select class="select form-control" name="pay_slab" id="">
                                        <option selected disabled> --Select --</option>
                                        <option value="Slab 1">Slab 1</option>
                                        <option value="Slab 2">Slab 2</option>
                                        <option value="Slab 3">Slab 3</option>
                                    </select>
                                    <div class="alert-danger">@error('pay_slab'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Attendance Type<span class="required">*</span></label>
                                    <select class="select form-control" name="attend_type" id="">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($attendance_type as $at )
                                        <option value="{{ $at->attendance_type_id }}">{{ $at->attendance_type }}</option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">@error('attend_type'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Reporting Authority<span class="required">*</span></label>
                                    <select class="select form-control js-example-basic-single" name="report_auth" id="report_auth">
                                        <option selected disabled> --Select --</option>
                                        @foreach($result as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">@error('report_auth'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Reporting Authority's Level</label>
                                    <select class="select form-control" id="ra_designation">
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>CUG Number<span class="required">*</span></label>
                                    <input class="form-control @error('cug_no') is-invalid @enderror" type="text" id="" name="cug_no" value="{{ old('cug_no') }}" placeholder="Enter CUG Number">
                                    <div class="alert-danger">@error('cug_no'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add User Modal -->

    <!-- Edit User Modal -->

    <!-- /Edit User Modal -->

    <!-- Active Modal -->
    <div class="modal custom-modal fade" id="active_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Change Status</h3>
                        <p>Are you sure want to active the status?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="/userManagement/status" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="status" class="status" value="Active">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Active</button>
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
    <!-- /Active Modal -->

    <!-- Inactive Modal -->
    <div class="modal custom-modal fade" id="inactive_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Change Status</h3>
                        <p>Are you sure want to inactive the status?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="/userManagement/status" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="status" class="status" value="Inactive">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Inactive</button>
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
    <!-- /Inactive Modal -->

    <!-- Disable Modal -->
    <div class="modal custom-modal fade" id="resign_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Change Status</h3>
                        <p>Are you sure want to Resign the status?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="/userManagement/status" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="status" class="status" value="Resign">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Resign</button>
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
    <!-- /Disable Modal -->

    <!-- Delete User Modal -->
    <div class="modal custom-modal fade" id="delete_user" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete User</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('user/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="id" value="">
                            <input type="hidden" name="avatar" class="e_avatar" value="">
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
    <!-- /Delete User Modal -->
</div>
<!-- /Page Wrapper -->
@section('script')
<script src="custom_js/user_control.js"></script>
{{-- update js --}}
<script>
    // $(document).on('click', '.userUpdate', function() {
    //     var _this = $(this).parents('tr');
    //     $('#e_id').val(_this.find('.id').text());
    //     $('#e_name').val(_this.find('.name').text());
    //     $('#email').val(_this.find('.email').text());
    //     $('#d_email').val(_this.find('.d_email').text());
    //     $('#cug_no').val(_this.find('.phone_number').text());
    //     $('#dob').val(_this.find('.dob').text());
    //     $('#d_email').val(_this.find('.d_email').text());
    //     $('#join_date').val(_this.find('.join_date').text());

    //     var name_role = (_this.find(".role_name").text());
    //     // var _option = '<option selected value="' + name_role + '">' + _this.find('.role_name').text() + '</option>'
    //     // $(_option).appendTo("#e_role_name");
    //     document.getElementById("#e_role_name").value = e_name_role;


    //     var position = (_this.find(".position").text());
    //     var _option = '<option selected value="' + position + '">' + _this.find('.position').text() + '</option>'
    //     $(_option).appendTo("#position_upd");

    //     var department = (_this.find(".department").text());
    //     var _option = '<option selected value="' + department + '">' + _this.find('.department').text() + '</option>'
    //     $(_option).appendTo("#e_department");

    // });
</script>
{{-- delete js --}}
<script>
    $(document).on('click', '.userDelete', function() {
        var _this = $(this).parents('tr');
        $('.id').val(_this.find('.ids').text());
        $('.e_avatar').val(_this.find('.image').text());
    });

    $(document).on('click', '.activeSubmit', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.ids').text());
    });

    $(document).on('click', '.inactiveSubmit', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.ids').text());
    });

    $(document).on('click', '.ResignSubmit', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.ids').text());
    });
</script>


<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
    // This function for Selecting organisation level and according to organisation level show all office name  


    // Organization Change
    $('#org_level').change(function() {
        // Organization Level
        var org_idd = $(this).val();

        // Empty the dropdown
        $('#office_name').find('option').not(':first').remove();

        // AJAX request 
        $.ajax({
            type: 'GET',
            url: 'getOfficeLists/' + org_idd,
            cache: false,
            contentType: "application/json;",
            datatype: 'json',
            success: function(response) {
                var len = 0;
                if (response['data'] != null) {
                    len = response['data'].length;
                }

                if (len > 0) {
                    // Read data and create <option >
                    for (var i = 0; i < len; i++) {

                        var office_id = response['data'][i].office_id;
                        var office_name = response['data'][i].office_name;

                        var option = "<option class='select' value='" + office_id + "'>" + office_name + "</option>";

                        $("#office_name").append(option);
                    }
                }

            },
            error: function(error) {
                alert(error);
            },
        });
    });

    //  This function is for Selecting organisation level according to organisation level show all office name  


    // Organization Change
    $('#org_level').change(function() {

        // Organization Level
        var org_idd = $(this).val();

        // Empty the dropdown
        $('#positions').find('option').not(':first').remove();

        // AJAX request 
        $.ajax({
            url: 'getPosts/' + org_idd,
            type: 'get',
            dataType: 'json',
            success: function(response) {

                var len = 0;
                if (response['pd'] != null) {
                    len = response['pd'].length;
                }

                if (len > 0) {
                    // Read data and create <option >
                    for (var i = 0; i < len; i++) {

                        var post_id = response['pd'][i].post_id;
                        var post_title = response['pd'][i].post_title;

                        var option = "<option class='select' value='" + post_id + "'>" + post_title + "</option>";

                        $("#positions").append(option);
                    }
                }

            }
        });
    });
    //  This function is for Selecting designation according to post id show all designation name  



    // Post Change
    $('#positions').change(function() {

        // Post Level
        var po_id = $(this).val();

        // Empty the dropdown
        $('#designation').find('option').not(':first').remove();

        // AJAX request 
        $.ajax({
            url: 'getDesignations/' + po_id,
            type: 'get',
            dataType: 'json',
            success: function(response) {

                var len = 0;
                if (response['de'] != null) {
                    len = response['de'].length;
                }

                if (len > 0) {
                    // Read data and create <option >
                    for (var i = 0; i < len; i++) {

                        var designation_id = response['de'][i].designation_id;
                        var designation_code = response['de'][i].designation_code;

                        var option = "<option class='select' value='" + designation_id + "'>" + designation_code + "</option>";

                        $("#designation").append(option);
                    }
                }

            }
        });
    });

    // On Reporting Authority Change
    $('#report_auth').change(function() {
        // State id
        var ur_id = $(this).val();
        var mUrl = "/getUserDesigns/" + ur_id;

        $.ajax({
            url: mUrl,
            type: "GET",
            cache: false,
            contentType: "application/json;charset=utf-8",
            datatype: "json",
            success: function(result) {
                if (result == false) {
                    alert("Not Found");
                } else {
                    $select = $("#ra_designation");
                    $select.find("option").remove();
                    $select.append(
                        $("<option>").html("-- Select --")
                    );
                    Object.keys(result).forEach(function(key) {
                        $a = result[key].designation_code;
                        $select.append(
                            "<option selected disabled data-myid=" +
                            $a +
                            " value=" +
                            $a +
                            ">" +
                            $a +
                            "</option>"
                        );
                    });
                }
            },
            error: function(xhr, status, errorThrown) {
                //Here the status code can be retrieved like;
                xhr.status;
                alert(status);


                //The message added to Response object in Controller can be retrieved as following.
                xhr.responseText;
            }
        });

    });

    $(document).ready(function() {
        $('#datatable').DataTable({
            searchable: 'false',
            dom: 'Bftrip',
            buttons: {
                buttons: [{
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6]
                        },
                        text: '<i class="icon-android-print"></i> Export PDF',
                        className: 'pdfButton btn-padding'
                    },
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6]
                        },
                        text: '<i class="icon-android-print"></i> copy',
                        className: 'cpyButton btn-padding'
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6]
                        },
                        text: '<i class ="icon-android-print"></i> CSV',
                        className: 'csvButton btn-padding'


                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6]
                        },
                        text: '<i class="icon-document-text"></i> Excel',
                        className: 'excelButton btn-padding'
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 6]
                        },
                        text: '<i class="icon-android-print"></i> Print',
                        className: 'printButton btn-padding'
                    }

                ]
            }
        });
        $('.js-example-basic-single').select2();
    });
</script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script src="js/datatable_buttons/dataTables.buttons.min.js"></script>
<script src="js/datatable_buttons/jszip.min.js"></script>
<script src="js/datatable_buttons/pdfmake.min.js"></script>
<script src="js/datatable_buttons/vfs_fonts.js"></script>
<script src="js/datatable_buttons/buttons.html5.min.js"></script>
<script src="js/datatable_buttons/buttons.print.min.js"></script>

@endsection


@endsection