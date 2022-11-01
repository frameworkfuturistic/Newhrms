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

        <!-- Search Filter -->
        <form action="{{ route('search/user/list') }}" method="POST">
            @csrf
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="name" name="name">
                        <label class="focus-label">User Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="name" name="role_name">
                        <label class="focus-label">Role Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="name" name="status">
                        <label class="focus-label">Status</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>
        <!-- /Search Filter -->
        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Employee ID</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>Phone</th>
                                <th>Join Date</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $key=>$user )
                            <tr>
                                <td>
                                    <span hidden class="image">{{ $user->avatar}}</span>
                                    <h2 class="table-avatar">
                                        <a href="{{ url('employee/profile/'.$user->rec_id) }}" class="avatar"><img src="{{ URL::to('/assets/employee_image/'. $user->avatar) }}" alt="{{ $user->avatar }}"></a>
                                        <a href="{{ url('employee/profile/'.$user->rec_id) }}" class="name">{{ $user->name }}</span></a>
                                    </h2>
                                </td>
                                <td hidden class="ids">{{ $user->id }}</td>
                                <td hidden class="dobs">{{ $user->dob }}</td>
                                <td hidden class="d_email">{{ $user->department_email }}</td>
                                <td class="id">{{ $user->rec_id }}</td>
                                <td class="email">{{ $user->email }}</td>
                                <td class="position">
                                    
                                </td>
                                <td class="phone_number">{{ $user->cug_no }}</td>
                                <td>{{ $user->join_date }}</td>
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
                                            @elseif ($user->status=='Disable')
                                            <i class="fa fa-dot-circle-o text-danger"></i>Disable
                                            @elseif ($user->status=='')
                                            <i class="fa fa-dot-circle-o text-dark"></i>N/A
                                            @endif
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item activeSubmit" href="#" data-toggle="modal" data-id="'.$user->id.'" data-target="#active_modal">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                            <a class="dropdown-item inactiveSubmit" href="#" data-toggle="modal" data-id="'.$user->id.'" data-target="#inactive_modal">
                                                <i class="fa fa-dot-circle-o text-warning"></i> Inactive
                                            </a>
                                            <a class="dropdown-item disableSubmit" href="#" data-toggle="modal" data-id="'.$user->id.'" data-target="#disable_modal">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Disable
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item userUpdate" data-toggle="modal" data-id="'.$user->id.'" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item userDelete" href="#" data-toggle="modal" ata-id="'.$user->id.'" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                                    <label>Last Name<span class="required">*</span></label>
                                    <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Your Last Name" required />
                                    <div class="alert-danger">@error('last_name'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date Of Birth<span class="required">*</span></label>
                                    <input class="form-control" type="date" id="" name="dob" placeholder="Enter Your date of birth" required />
                                    <div class="alert-danger">@error('dob'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Profile Photo<span class="required">*</span></label>
                                    <input class="form-control" type="file" id="image" name="image" required />
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Department Email<span class="required">*</span></label>
                                    <input class="form-control" type="email" id="" name="department_email" placeholder="Enter Your Department Email" required />
                                    <div class="alert-danger">@error('department_email'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Office Name<span class="required">*</span></label>
                                    <select class="select form-control" name="office_name" id="office_name">
                                        <option selected disabled> --Select --</option>
                                    </select>
                                    <div class="alert-danger">@error('office_name'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Designation<span class="required">*</span></label>
                                    <select class="select form-control" name="designation" id="designation">
                                        <option selected disabled> --Select --</option>
                                    </select>
                                    <div class="alert-danger">@error('designation'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Reporting Authority's Designation</label>
                                    <select class="select form-control" id="ra_designation">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>CUG Number<span class="required">*</span></label>
                                    <input class="form-control @error('cug_no') is-invalid @enderror" type="text" id="" name="cug_no" value="{{ old('cug_no') }}" placeholder="Enter CUG Number">
                                    <div class="alert-danger">@error('cug_no'){{ $message }}@enderror</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Role Type<span class="required">*</span></label>
                                    <select class="select form-control" name="role_name" id="">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($role_type as $rt )
                                        <option value="{{ $rt->role_type }}">{{ $rt->role_type }}</option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">@error('role_name'){{ $message }}@enderror</div>
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
    <div id="edit_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-body">
                    <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="rec_id" id="e_id" value="">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" id="e_name" value="" placeholder="Enter name" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>CUG Number</label>
                                    <input class="form-control" type="text" id="cug_no" name="cug_no" placeholder="Enter Phone">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date of birth</label>
                                    <input class="form-control" type="date" name="dob" id="dob" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Personal E-mail</label>
                                    <input class="form-control" type="email" name="email" id="email" value="" placeholder="Enter Your Personal Email" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Department E-mail</label>
                                    <input class="form-control" type="email" name="d_email" id="d_email" value="" placeholder="Enter Your department Email" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Role Name</label>
                                    <select class="select form-control" name="role_name" id="e_role_name">
                                        <option disabled selected value="">----Select----</option>
                                        @foreach ($role_name as $role )
                                        <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Employee Type</label>
                                    <select class="select form-control" name="emp_type" id="emp_type">
                                        <option disabled selected value="">----Select----</option>
                                        @foreach ($employee_types as $et )
                                        <option value="{{ $et->emp_type_id }}">{{ $et->emp_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Organization Level</label>
                                    <select class="select form-control" name="organ_level" id="org_level">
                                        <option disabled selected value="">----Select----</option>
                                        @foreach ($organisation['data'] as $org )
                                        <option value="{{ $org->org_id }}">{{ $org->org_level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Office</label>
                                    <select class="select form-control" name="office_name" id="office_name">
                                        <option disabled selected value="">----Select----</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Post</label>
                                    <select class="select form-control" name="position" id="positions">
                                        <option disabled selected value="">----Select----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select class="select form-control" name="designation" id="designation">
                                        <option disabled selected value="">----Select----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Pay Slab</label>
                                    <select class="select form-control" name="pay_slab" id="pay_slab">
                                        <option disabled selected value="">----Select----</option>
                                        <option value="Slab 1">Slab 1</option>
                                        <option value="Slab 2">Slab 2</option>
                                        <option value="Slab 3">Slab 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Attendance Type</label>
                                    <select class="select form-control" name="attend_type" id="attend_type">
                                        <option disabled selected value="">----Select----</option>
                                        @foreach ($attendance_type as $at )
                                        <option value="{{ $at->attendance_type_id }}">{{ $at->attendance_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Reporting Authority</label>
                                    <select class="select form-control" name="report_auth" id="report_auth">
                                        <option disabled selected value="">----Select----</option>
                                        @foreach($result as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Reporting Authority's Designation</label>
                                    <select class="select form-control" id="ra_designation">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Salary Modal -->

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
    <div class="modal custom-modal fade" id="disable_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Change Status</h3>
                        <p>Are you sure want to disable the status?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="/userManagement/status" method="POST">
                            @csrf
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="status" class="status" value="Disable">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn">Disable</button>
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
{{-- update js --}}
<script>
    $(document).on('click', '.userUpdate', function() {
        var _this = $(this).parents('tr');
        $('#e_id').val(_this.find('.id').text());
        $('#e_name').val(_this.find('.name').text());
        $('#email').val(_this.find('.email').text());
        $('#cug_no').val(_this.find('.phone_number').text());
        $('#dob').val(_this.find('.dobs').text());
        $('#d_email').val(_this.find('.d_email').text());

        var name_role = (_this.find(".role_name").text());
        var _option = '<option selected value="' + name_role + '">' + _this.find('.role_name').text() + '</option>'
        $(_option).appendTo("#e_role_name");

        var position = (_this.find(".position").text());
        var _option = '<option selected value="' + position + '">' + _this.find('.position').text() + '</option>'
        $(_option).appendTo("#e_position");

        var department = (_this.find(".department").text());
        var _option = '<option selected value="' + department + '">' + _this.find('.department').text() + '</option>'
        $(_option).appendTo("#e_department");

        var statuss = (_this.find(".statuss").text());
        var _option = '<option selected value="' + statuss + '">' + _this.find('.statuss').text() + '</option>'
        $(_option).appendTo("#e_status");

    });
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

    $(document).on('click', '.disableSubmit', function() {
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
            url: 'getOfficeLists/' + org_idd,
            type: 'get',
            dataType: 'json',
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

            }
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
        $('.js-example-basic-single').select2();
    });
</script>

@endsection


@endsection