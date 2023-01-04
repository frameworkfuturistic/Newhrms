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
                            <input class="form-control" type="date" id="" name="join_date" placeholder="Enter Date Of Joining" value="{{$user->join_date}}" />
                            <div class="alert-danger">@error('join_date'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Organization Level</label>
                            <select class="select form-control" name="organ_level" id="org_level">
                                <option selected disabled> --Select --</option>

                                <option value="General">State level staff</option>
                                <option value="OBC">District level staff</option>
                                <option value="ST">Block level staff</option>

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
                                <option selected disabled> --Select --</option>
                            </select>
                            <div class="alert-danger">@error('office_name'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Employee Type</label>
                            <select class="select form-control" name="emp_type" id="">
                                <option selected disabled> --Select --</option>
                            </select>
                            <div class="alert-danger">@error('emp_type'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Post</label>
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
                            <label>Designation</label>
                            <select class="select form-control" name="designation" id="designation">
                                <option selected disabled> --Select --</option>
                            </select>
                            <div class="alert-danger">@error('designation'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pay Slab</label>
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
                            <label>Attendance Type</label>
                            <select class="select form-control" name="attend_type" id="">
                                <option selected disabled> --Select --</option>
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
                            </select>
                            <div class="alert-danger">@error('report_auth'){{ $message }}@enderror</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Reporting Authority's Designation</label>
                            <select class="select form-control" id="ra_designation">
                            </select>
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
<script>
    // $(document).on('click','.first_name',function(){var _this = $(this).parents('tr');})
    // $('#first_name').val(_this.find('.first_name'))
    // 
</script>
@endsection