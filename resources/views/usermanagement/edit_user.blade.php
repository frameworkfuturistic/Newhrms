@extends('layouts.master')


@section('emp_noti')
noti-dot
@endsection
@section('all_user_active')
active
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="col-md-12">

            <form action="/update-User/{{$user->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="" name="first_name" value="{{$user->first_name}}" placeholder="Enter Your First Name" required />
                            <div class="alert-danger">@error('first_name'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input class="form-control @error('middle_name') is-invalid @enderror" type="text" id="" name="middle_name" value="{{ $user->middle_name}}" placeholder="Enter Your Middle Name" />
                            <div class="alert-danger">@error('middle_name'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="" name="last_name" value="{{ $user->last_name }}" placeholder="Enter Your Last Name" />
                            <div class="alert-danger">@error('last_name'){{ $message }}@enderror</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control @error('emp_id') is-invalid @enderror" type="text" id="" name="emp_id" value="{{ $user->emp_id }}" placeholder="Enter Employee ID">
                            <div class="alert-danger">@error('emp_id'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Gender<span>*</span></label>
                            <select class="select form-control" name="gender" id="gender" value="{{ $user->gender }}">
                                <option value="{{ $user->gender }}" selected>{{ $user->gender }}</option>
                                <option disabled> --Select --</option>
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
                            <select class="select form-control" name="category" id="category" value="{{ $user->category }}">
                                <option value="{{ $user->category }}" selected>{{ $user->category }}</option>
                                <option disabled> --Select --</option>
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
                            <label>Date Of Birth</label>
                            <input class="form-control" type="date" id="" name="dob" placeholder="Enter Your date of birth" value="{{ $user->dob}}" required />
                            <div class="alert-danger">@error('dob'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Personal E-mail</label>
                            <input class="form-control" type="email" id="" name="email" placeholder="Enter Your Personal Email" value="{{ $user->email}}" />
                            <div class="alert-danger">@error('email'){{ $message }}@enderror</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Department Email</label>
                            <input class="form-control" type="email" id="" name="department_email" value="{{ $user->department_email}}" placeholder="Enter Your Department Email" />
                            <div class="alert-danger">@error('department_email'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Date Of Joining</label>
                            <input class="form-control" type="date" id="" name="join_date" placeholder="Enter Date Of Joining" value="{{date('Y-m-d',strtotime($user->join_date))}}" />
                            <div class="alert-danger">@error('join_date'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class=" col-sm-4">
                        <div class="form-group">
                            <label>Organization Level</label>
                            <select class="select form-control" name="organ_level" id="org_level">
                                <option value="">Select</option>
                                @foreach($organLevels as $key=>$organLevel)
                                <option value="{{$organLevel->org_id}}" @if($organLevel->org_id==$user->org_id) selected @endif>{{$organLevel->org_level}}</option>
                                @endforeach
                            </select>
                            <div class="alert-danger">@error('organ_level'){{ $message }}@enderror</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Office Name</label>
                            <select class="select form-control" name="office_name" id="office_name">
                                <option selected value="{{$user->office_id}}">{{$user->office_name}}</option>
                                <option disabled> --Select --</option>
                            </select>
                            <div class="alert-danger">@error('office_name'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Employee Type</label>
                            <select class="select form-control" name="emp_type" id="emp_type">
                                <option disabled> --Select --</option>
                                @foreach($employeeTypes as $employeeType)
                                <option value="{{$employeeType->emp_type_id}}" @if($user->emp_type_id==$employeeType->emp_type_id) selected @endif>{{$employeeType->emp_type}}</option>
                                @endforeach
                            </select>
                            <div class="alert-danger">@error('emp_type'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Post</label>
                            <select class="select form-control" name="position" id="positions">
                                <option selected value="{{$user->position}}">{{$user->post_title}}</option>
                                <option disabled> --Select --</option>
                            </select>
                            <div class="alert-danger">@error('position'){{ $message }}@enderror</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Designation</label>
                            <select class="select form-control" name="designation" id="designation">
                                <option selected value="{{$user->designation}}">{{$user->designation}}</option>
                                <option disabled> --Select --</option>
                            </select>
                            <div class="alert-danger">@error('designation'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pay Slab</label>
                            <select class="select form-control" name="pay_slab" id="">
                                <option selected value="{{$user->pay_slab}}">{{$user->pay_slab}}</option>
                                <option disabled> --Select --</option>
                                <option value="Slab 1">Slab 1</option>
                                <option value="Slab 2">Slab 2</option>
                                <option value="Slab 3">Slab 3</option>
                            </select>
                            <div class="alert-danger">@error('pay_slab'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Attendance Type</label>
                            <select class="select form-control" name="attend_type" id="">
                                <option disabled> --Select --</option>
                                @foreach($attendanceTypes as $attendanceType)
                                <option @if($user->attendance_type==$attendanceType->attendance_type_id) selected @endif value="{{$attendanceType->attendance_type_id}}">{{$attendanceType->attendance_type}}</option>
                                @endforeach
                            </select>
                            <div class="alert-danger">@error('attend_type'){{ $message }}@enderror</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Reporting Authority</label>
                            <select class="select form-control js-example-basic-single" name="report_auth" id="report_auth">
                                <option selected disabled> --Select --</option>
                                @foreach($repoAuthorities as $repoAuthority)
                                <option @if($user->reporting_authority==$repoAuthority->id) selected @endif value="{{$repoAuthority->id}}">{{$repoAuthority->name}}</option>
                                @endforeach
                            </select>
                            <div class="alert-danger">@error('report_auth'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>CUG Number</label>
                            <input class="form-control @error('cug_no') is-invalid @enderror" type="text" id="" name="cug_no" value="{{ $user->cug_no}}" placeholder="Enter CUG Number">
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
@endsection

@section('script')
<script>
    // Organization Change
    $('#org_level').change(function() {
        // Organization Level
        var org_idd = $(this).val();

        // Empty the dropdown
        $('#office_name').find('option').not(':first').remove();

        // AJAX request 
        $.ajax({
            type: 'GET',
            url: '/getOfficeLists/' + org_idd,
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
            url: '/getPosts/' + org_idd,
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
            url: '/getDesignations/' + po_id,
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

            },
            error: function(error) {
                alert(error);
            },
        });
    });
</script>
@endsection