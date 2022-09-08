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
                    <h3 class="page-title">User Management</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
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
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Join Date</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Departement</th>
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
                                <td class="id">{{ $user->rec_id }}</td>
                                <td class="email">{{ $user->email }}</td>
                                <td class="position">{{ $user->position }}</td>
                                <td class="phone_number">{{ $user->phone_number }}</td>
                                <td>{{ $user->join_date }}</td>
                                <td>
                                    @if ($user->role_name=='Admin')
                                    <span class="badge bg-inverse-danger role_name">{{ $user->role_name }}</span>
                                    @elseif ($user->role_name=='Super Admin')
                                    <span class="badge bg-inverse-warning role_name">{{ $user->role_name }}</span>
                                    @elseif ($user->role_name=='Normal User')
                                    <span class="badge bg-inverse-info role_name">{{ $user->role_name }}</span>
                                    @elseif ($user->role_name=='Client')
                                    <span class="badge bg-inverse-success role_name">{{ $user->role_name }}</span>
                                    @elseif ($user->role_name=='Employee')
                                    <span class="badge bg-inverse-dark role_name">{{ $user->role_name }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown action-label">
                                        @if ($user->status=='Active')
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-success"></i>
                                            <span class="statuss">{{ $user->status }}</span>
                                        </a>
                                        @elseif ($user->status=='Inactive')
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-info"></i>
                                            <span class="statuss">{{ $user->status }}</span>
                                        </a>
                                        @elseif ($user->status=='Disable')
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-danger"></i>
                                            <span class="statuss">{{ $user->status }}</span>
                                        </a>
                                        @elseif ($user->status=='')
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-dark"></i>
                                            <span class="statuss">N/A</span>
                                        </a>
                                        @endif

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">
                                                <i class="fa fa-dot-circle-o text-success"></i> Active
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa fa-dot-circle-o text-warning"></i> Inactive
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Disable
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="department">{{ $user->department }}</td>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name<span class="required">*</span></label>
                                    <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="" name="first_name" value="{{ old('first_name') }}" placeholder="Enter Your First Name" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name<span class="required">*</span></label>
                                    <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Your Last Name" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Date Of Birth<span class="required">*</span></label>
                                <input class="form-control" type="date" id="" name="dob" placeholder="Enter Your date of birth" required />
                            </div>
                            <div class="col-sm-6">
                                <label>Profile Photo<span class="required">*</span></label>
                                <input class="form-control" type="file" id="image" name="image" required />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Personal Email<span class="required">*</span></label>
                                <input class="form-control" type="email" id="" name="email" placeholder="Enter Your Personal Email" required />
                            </div>
                            <div class="col-sm-6">
                                <label>Department Email<span class="required">*</span></label>
                                <input class="form-control" type="email" id="" name="department_email" placeholder="Enter Your Department Email" required />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Date Of Joining<span class="required">*</span></label>
                                <input class="form-control" type="date" id="" name="join_date" placeholder="Enter Date Of Joining" required />
                            </div>
                            <div class="col-sm-6">
                                <label>Organization Level<span class="required">*</span></label>
                                <select class="select form-control" name="organ_level" id="org_level">
                                    <option selected disabled> --Select --</option>
                                    @foreach ($organisation['data'] as $org )
                                    <option value="{{ $org->org_id }}">{{ $org->org_level }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office Name<span class="required">*</span></label>
                                    <select class="select form-control" name="office_name" id="office_name">
                                        <option selected disabled> --Select --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Employee Type<span class="required">*</span></label>
                                <select class="select form-control" name="emp_type" id="">
                                    <option selected disabled> --Select --</option>
                                    @foreach ($employee_types as $et )
                                    <option value="{{ $et->emp_type_id }}">{{ $et->emp_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Post<span class="required">*</span></label>
                                <select class="select form-control" name="position" id="positions">
                                    <option selected disabled> --Select --</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Designation<span class="required">*</span></label>
                                <select class="select form-control" name="designation" id="designation">
                                    <option selected disabled> --Select --</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Pay Slab<span class="required">*</span></label>
                                <select class="select form-control" name="pay_slab" id="">
                                    <option selected disabled> --Select --</option>
                                    <option value="Slab 1">Slab 1</option>
                                    <option value="Slab 2">Slab 2</option>
                                    <option value="Slab 3">Slab 3</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Attendance Type<span class="required">*</span></label>
                                <select class="select form-control" name="attend_type" id="">
                                    <option selected disabled> --Select --</option>
                                    @foreach ($attendance_type as $at )
                                    <option value="{{ $at->attendance_type_id }}">{{ $at->attendance_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Reporting Authority<span class="required">*</span></label>
                                <select class="select form-control js-example-basic-single" name="report_auth" id="">
                                    <option selected disabled> --Select --</option>
                                    @foreach($result as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>CUG Number<span class="required">*</span></label>
                                    <input class="form-control @error('cug_no') is-invalid @enderror" type="text" id="" name="cug_no" value="{{ old('cug_no') }}" placeholder="Enter CUG Number">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Role Type<span class="required">*</span></label>
                                <select class="select form-control" name="role_name" id="">
                                    <option selected disabled> --Select --</option>
                                    @foreach ($role_type as $rt )
                                    <option value="{{ $rt->role_type }}">{{ $rt->role_type }}</option>
                                    @endforeach
                                </select>
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
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" id="e_name" value="" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" id="e_email" value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Role Name</label>
                                <select class="select" name="role_name" id="e_role_name">
                                    @foreach ($role_name as $role )
                                    <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Position</label>
                                <select class="select" name="position" id="e_position">
                                    @foreach ($position as $positions )
                                    <option value="{{ $positions->position }}">{{ $positions->position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" id="e_phone_number" name="phone" placeholder="Enter Phone">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Department</label>
                                <select class="select" name="department" id="e_department">
                                    @foreach ($department as $departments )
                                    <option value="{{ $departments->department }}">{{ $departments->department }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Status</label>
                                <select class="select" name="status" id="e_status">
                                    @foreach ($status_user as $status )
                                    <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Photo</label>
                                <input class="form-control" type="file" id="image" name="images">
                                <input type="hidden" name="hidden_image" id="e_image" value="">
                            </div>
                        </div>
                        <br>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Salary Modal -->

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
        $('#e_email').val(_this.find('.email').text());
        $('#e_phone_number').val(_this.find('.phone_number').text());
        $('#e_image').val(_this.find('.image').text());

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
</script>


<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
    // This function for Selecting organisation level and according to organisation level show all office name  

    $(document).ready(function() {

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
    });

    //  This function is for Selecting organisation level according to organisation level show all office name  

    $(document).ready(function() {

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
    });

    //  This function is for Selecting designation according to post id show all designation name  

    $(document).ready(function() {

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
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection

@endsection