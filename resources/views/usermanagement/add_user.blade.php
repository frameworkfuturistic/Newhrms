@extends('layouts.master')

@section('editemp_noti_dot')
noti-dot
@endsection

@section('add_user_active')
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
                    <h3 class="page-title">Complete Profile</h3>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Complete Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <section class="review-section information">
            <div class="review-header text-center" style="text-align: initial !important;">
                {{-- message --}}
                {!! Toastr::message() !!}

                <div class="row align-items-center">
                    <div class="col-12">
                        <div id="basicwizard">
                            <ul class="nav nav-tabs nav-justified mb-3">
                                <li class="nav-item" data-target-form="#identificationDetailForm">
                                    <a href="#identificationDetail" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn active">
                                        <i class="bx bxs-building me-1"></i>
                                        <span class="d-none d-sm-inline">Identification Details</span>
                                    </a>
                                </li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#contactDetailForm">
                                    <a href="#contactDetail" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn">
                                        <i class="bx bxs-book me-1"></i>
                                        <span class="d-none d-sm-inline">Contact Details</span>
                                    </a>
                                </li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#experienceDetailForm">
                                    <a href="#experienceDetail" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn">
                                        <i class="bx bxs-book me-1"></i>
                                        <span class="d-none d-sm-inline">Experience & Qualification</span>
                                    </a>
                                </li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#familyinformation">
                                    <a href="#family-information" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn">
                                        <i class="bx bxs-check-circle me-1"></i>
                                        <span class="d-none d-sm-inline">Family Information</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#finish" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn">
                                        <i class="bx bxs-check-circle me-1"></i>
                                        <span class="d-none d-sm-inline">Bank Details</span>
                                    </a>
                                </li>
                                <!-- end nav item -->
                            </ul>
                            <!-- nav pills -->

                            <form action="user-profile/save" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf

                                <div class="tab-content mb-0 pt-0">
                                    <!-- START: Define your progress bar here -->
                                    <div id="bar" class="progress mb-3" style="height: 7px;">
                                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                    </div>
                                    <!-- END: Define your progress bar here -->

                                    <!-- START: Define your tab pans here -->
                                    <div class="tab-pane show active" id="identificationDetail">
                                        <div class="row">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Aadhar No.</label>
                                                    <input class="form-control" type="text" id="" name="aadhar_no" @if($personal_info->aadhar_no) value="{{ $personal_info->aadhar_no }}" @else value="{{ old('aadhar_no') }}" @endif placeholder="Enter Aadhar Number">
                                                </div>
                                                <div class="alert-danger">@error('aadhar_no'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Aadhar Card</label>
                                                    <input class="form-control @error('aadhar_card') is-invalid @enderror" type="file" id="" name="aadhar_card" @if($personal_info->aadhar_card) value="{{ $personal_info->aadhar_card }}" @else value="{{ old('aadhar_card') }}" @endif >
                                                </div>
                                                <div class="alert-danger">@error('aadhar_card'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PAN No.</label>

                                                    <input class="form-control" type="text" id="" name="pan_no" @if($personal_info->pan_no) value="{{ $personal_info->pan_no }}" @else value="{{ old('pan_no') }}" @endif placeholder="Enter PAN Number">

                                                </div>
                                                <div class="alert-danger">@error('pan_no'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PAN Card</label>
                                                    <input class="form-control @error('pan_card') is-invalid @enderror" type="file" id="" name="pan_card">
                                                </div>
                                                <div class="alert-danger">@error('pan_card'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Driving License</label>
                                                <input class="form-control" type="file" id="" name="dl">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Passport</label>
                                                <input class="form-control" type="file" id="" name="passport">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Voter ID Card</label>
                                                <input class="form-control" type="file" id="" name="voter_id">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>UAN Document</label>
                                                <input class="form-control" type="file" id="" name="uan_no">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>UAN No.</label>
                                                    <input class="form-control" type="text" id="" name="uan_no_of_emp" @if($personal_info->uan_no_of_emp) value="{{ $personal_info->uan_no_of_emp }}" @else value="{{ old('uan_no_of_emp') }}" @endif placeholder="Enter UAN Number">
                                                </div>
                                                <div class="alert-danger">@error('uan_no_of_emp'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Blood Group</label>
                                                <select class="select" name="blood_group" id="blood_group">
                                                    <option selected disabled> --Select --</option>
                                                    <option value="A-">A-</option>
                                                    <option value="A+">A+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end identification detail tab pane -->
                                    <div class="tab-pane" id="contactDetail">
                                        <h4 class="mb-3 mt-0"><u>Present Address</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>State</label>
                                                <select class="select" name="present_state" id="present_state">
                                                    <option selected disabled> --Select --</option>
                                                    @foreach($state['data'] as $st)
                                                    <option value="{{ $st->state_id }}">{{ $st->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="alert-danger">@error('present_state'){{ $message }}@enderror</div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label>City</label>
                                                <input class="form-control @error('present_city') is-invalid @enderror" type="text" id="present_city" name="present_city" @if($personal_info->present_city) value="{{ $personal_info->present_city }}" @else value="{{ old('present_city') }}" @endif value="{{ old('present_city') }}" placeholder="Enter City" />
                                                <div class="alert-danger">@error('present_city'){{ $message }}@enderror</div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label>PIN Code</label>
                                                <input class="form-control @error('present_pin') is-invalid @enderror" type="text" id="present_pin" name="present_pin" @if($personal_info->present_pin) value="{{ $personal_info->present_pin }}" @else value="{{ old('present_pin') }}" @endif value="{{ old('present_pin') }}" placeholder="Enter Pin" />
                                                <div class="alert-danger">@error('present_pin'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Present Address</label>
                                                <input class="form-control @error('present_pin') is-invalid @enderror" type="text" id="present_address" name="present_address" @if($personal_info->present_address) value="{{ $personal_info->present_address }}" @else value="{{ old('present_address') }}" @endif value="{{ old('present_address')}}" placeholder="Enter present address" />
                                            </div>
                                        </div>
                                        <br />
                                        <input type="checkbox" id="same" name="same" onchange="addressFunction()" />
                                        <label for="same">
                                            If address are same select this box.
                                        </label>

                                        <br />

                                        <h4 class="mb-3 mt-0"><u>Permanent Address</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>State</label>
                                                <select class="select" name="permanent_state" id="permanent_state">
                                                    <option selected disabled> --Select --</option>
                                                    @foreach($state['data'] as $st)
                                                    <option value="{{ $st->state_id }}">{{ $st->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="alert-danger">@error('permanent_state'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>City</label>
                                                <input class="form-control @error('permanent_city') is-invalid @enderror" type="text" id="permanent_city" name="permanent_city" @if($personal_info->permanent_city) value="{{ $personal_info->permanent_city }}" @else value="{{ old('permanent_city') }}" @endif value="{{ old('permanent_city') }}" placeholder="Enter City" />
                                                <div class="alert-danger">@error('permanent_city'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>PIN Code</label>
                                                <input class="form-control @error('permanent_pin') is-invalid @enderror" type="text" id="permanent_pin" name="permanent_pin" @if($personal_info->permanent_pin) value="{{ $personal_info->permanent_pin }}" @else value="{{ old('permanent_pin') }}" @endif value="{{ old('permanent_pin') }}" placeholder="Enter Pin" />
                                                <div class="alert-danger">@error('permanent_pin'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Permanent Address</label>
                                                <input class="form-control @error('present_pin') is-invalid @enderror" type="text" id="permanent_address" name="permanent_address" @if($personal_info->permanent_address) value="{{ $personal_info->permanent_address }}" @else value="{{ old('permanent_address') }}" @endif value="{{ old('permanent_address') }}" placeholder="Enter permanent address" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Personal Contact Number</label>
                                                <input class="form-control" type="text" id="personal_contact" name="personal_contact" @if($personal_info->personal_contact) value="{{ $personal_info->personal_contact }}" @else value="{{ old('personal_contact') }}" @endif placeholder="Enter Personal Contact Number">
                                                <div class="alert-danger">@error('personal_contact'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Alternative Contact Number</label>
                                                <input class="form-control" type="text" id="" name="alternative_contact" @if($personal_info->alternative_contact) value="{{ $personal_info->alternative_contact }}" @else value="{{ old('alternative_contact') }}" @endif placeholder="Enter Alternative Contact Number">
                                                <div class="alert-danger">@error('alternative_contact'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Emergency Contact Details</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Number</div>
                                                <input class="form-control" type="text" id="" name="emergency_contact" @if($personal_info->alternative_contact) value="{{ $personal_info->alternative_contact }}" @else value="{{ old('alternative_contact') }}" @endif placeholder="Enter Emergency Contact Number">
                                                <div class="alert-danger">@error('emergency_contact'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Name</div>
                                                <input class="form-control" type="text" id="" name="emerg_con_per_name" @if($personal_info->emerg_con_per_name) value="{{ $personal_info->emerg_con_per_name }}" @else value="{{ old('emerg_con_per_name') }}" @endif placeholder="Enter Emergency Contact Person Name">
                                                <div class="alert-danger">@error('emerg_con_per_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Relation</div>
                                                <input class="form-control" type="text" id="" name="emerg_con_per_rel" @if($personal_info->emerg_con_per_rel) value="{{ $personal_info->emerg_con_per_rel }}" @else value="{{ old('emerg_con_per_rel') }}" @endif placeholder="Enter Emergency Contact Person Relation">
                                                <div class="alert-danger">@error('emerg_con_per_rel'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Address</div>
                                                <input class="form-control" type="text" id="" name="emerg_con_per_add" @if($personal_info->emerg_con_per_add) value="{{ $personal_info->emerg_con_per_add }}" @else value="{{ old('emerg_con_per_add') }}" @endif placeholder="Enter Emergency Contact Person Address">
                                                <div class="alert-danger">@error('emerg_con_per_add'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end contact detail tab pane -->
                                    <div class="tab-pane" id="experienceDetail">
                                        <h4 class="mb-3 mt-0"><u>Education Qualification Details</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Course Name</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_course_name" @if($personal_info->edu_qua_course_name) value="{{ $personal_info->edu_qua_course_name }}" @else value="{{ old('edu_qua_course_name') }}" @endif placeholder="Enter Course Name">
                                                <div class="alert-danger">@error('edu_qua_course_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Stream</label>
                                                <input class="form-control" type="text" id="stream" name="edu_qua_stream" @if($personal_info->edu_qua_stream) value="{{ $personal_info->edu_qua_stream }}" @else value="{{ old('edu_qua_stream') }}" @endif placeholder="Enter Stream">
                                                <div class="alert-danger">@error('edu_qua_stream'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Board</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_board" @if($personal_info->edu_qua_board) value="{{ $personal_info->edu_qua_board }}" @else value="{{ old('edu_qua_board') }}" @endif placeholder="Enter Board Name">
                                                <div class="alert-danger">@error('edu_qua_board'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Passing Year</label>
                                                <input class="form-control" type="number" id="" name="edu_qua_passing_year" @if($personal_info->edu_qua_passing_year) value="{{ $personal_info->edu_qua_passing_year }}" @else value="{{ old('edu_qua_passing_year') }}" @endif placeholder="YYYY" min="1940" max="2060">
                                                <div class="alert-danger">@error('edu_qua_passing_year'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Percentage/ GPA</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_percentage" @if($personal_info->edu_qua_percentage) value="{{ $personal_info->edu_qua_percentage }}" @else value="{{ old('edu_qua_percentage') }}" @endif placeholder="Enter Percentage/ GPA">
                                                <div class="alert-danger">@error('edu_qua_percentage'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Certificate Upload</label>
                                                <input class="form-control" type="file" id="" name="edu_qua_certi_upload" placeholder="Enter Percentage/ GPA">
                                                <div class="alert-danger">@error('edu_qua_certi_upload'){{ $message }}@enderror</div>
                                            </div>
                                        </div>


                                        <br />
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Professional Qualification Details</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Institution/ University Name</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_university_name" @if($personal_info->pro_qua_university_name) value="{{ $personal_info->pro_qua_university_name }}" @else value="{{ old('pro_qua_university_name') }}" @endif placeholder="Enter University Name">
                                                <div class="alert-danger">@error('pro_qua_university_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Degree/ Diploma</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_degree" @if($personal_info->pro_qua_degree) value="{{ $personal_info->pro_qua_degree }}" @else value="{{ old('pro_qua_degree') }}" @endif placeholder="Enter degree/ Diploma">
                                                <div class="alert-danger">@error('pro_qua_degree'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Subject/ Courses</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_subject" @if($personal_info->pro_qua_subject) value="{{ $personal_info->pro_qua_subject }}" @else value="{{ old('pro_qua_subject') }}" @endif placeholder="Enter Subject/ Courses">
                                                <div class="alert-danger">@error('pro_qua_subject'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label>Duration</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_duration" @if($personal_info->pro_qua_duration) value="{{ $personal_info->pro_qua_duration }}" @else value="{{ old('pro_qua_duration') }}" @endif placeholder="Enter Course Duration">
                                                <div class="alert-danger">@error('pro_qua_duration'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Industry Certification</label>
                                                <input class="form-control" type="file" id="" name="pro_qua_ind_certi" />
                                                <div class="alert-danger">@error('pro_qua_ind_certi'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Year Of Passing</label>
                                                <input class="form-control" type="number" id="" name="pro_qua_year" @if($personal_info->pro_qua_year) value="{{ $personal_info->pro_qua_year }}" @else value="{{ old('pro_qua_year') }}" @endif placeholder="YYYY" min="1940" max="2060">
                                                <div class="alert-danger">@error('pro_qua_year'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Technical Skills</u></h4>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Skill Name</label>
                                                <input class="form-control" type="text" id="" name="skill_name" @if($personal_info->pro_qua_subject) value="{{ $personal_info->pro_qua_subject }}" @else value="{{ old('pro_qua_subject') }}" @endif placeholder="Enter Skills Name" />
                                                <div class="alert-danger">@error('skill_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Duration</label>
                                                <input class="form-control" type="text" id="" name="skill_duration" @if($personal_info->skill_duration) value="{{ $personal_info->skill_duration }}" @else value="{{ old('skill_duration') }}" @endif placeholder="Enter Duration" />
                                                <div class="alert-danger">@error('skill_duration'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Experience Details</u></h4>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Organisation Name</label>
                                                <input class="form-control" type="text" id="" name="organ_name" @if($personal_info->organ_name) value="{{ $personal_info->organ_name }}" @else value="{{ old('organ_name') }}" @endif placeholder="Enter Organisation Name" />
                                                <div class="alert-danger">@error('organ_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Job Profile</label>
                                                <input class="form-control" type="file" id="" name="job_profile" />
                                                <div class="alert-danger">@error('job_profile'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Organisation Type</label>
                                                <select class="select" id="" name="organ_type" @if($personal_info->organ_type) value="{{ $personal_info->organ_type }}" @else value="{{ old('organ_type') }}" @endif >
                                                    <option selected disabled> --Select --</option>
                                                    <option value="Government">Government</option>
                                                    <option value="private">Private</option>
                                                </select>
                                                <div class="alert-danger">@error('organ_type'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Supporting Document Upload</label>
                                                <input class="form-control" type="file" id="" name="supp_doc_upload" />
                                                <div class="alert-danger">@error('supp_doc_upload'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Effective From Date</label>
                                                <input class="form-control" type="date" id="" name="eff_from_date" @if($personal_info->eff_from_date) value="{{ $personal_info->eff_from_date }}" @else value="{{ old('eff_from_date') }}" @endif />
                                                <div class="alert-danger">@error('eff_from_date'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Effective To Date</label>
                                                <input class="form-control" type="date" id="" name="eff_to_date" @if($personal_info->eff_to_date) value="{{ $personal_info->eff_to_date }}" @else value="{{ old('eff_to_date') }}" @endif />
                                                <div class="alert-danger">@error('eff_to_date'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                    </div>
                                    <!-- end experience detail tab pane -->
                                    <div class="tab-pane" id="family-information">
                                        <h4 class="mb-3 mt-0"><u>Family Information</u></h4>
                                        <!-- <div class="row">
                                            <div class="col-sm-4">
                                                <label>Relation</label>
                                                <input class="form-control" type="text" id="" name="fam_relation" placeholder="Enter relation">
                                                <div class="alert-danger">@error('fam_relation'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Full Name</label>
                                                <input class="form-control" type="text" id="" name="full_name" placeholder="Enter Full Name">
                                                <div class="alert-danger">@error('full_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Age</label>
                                                <input class="form-control" type="text" id="" name="fam_age" placeholder="Enter your Age">
                                                <div class="alert-danger">@error('fam_age'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">     
                                            <div class="col-sm-4">
                                                <span>
                                                    <button type="button" class="btn btn-success add_item_btn " onclick="add()">Add More</button>
                                                </span>
                                                <span>
                                                    <button type="button" class="btn btn-success add_item_btn " onclick="remove()">Remove</button> 
                                                </span> 
                                            </div>                                        
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-review review-table mb-0" id="table_achievements">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:30px;">#</th>
                                                                <th>Relation</th>
                                                                <th>Full Name</th>
                                                                <th>Age</th>

                                                                <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="fa fa-plus"></i></button></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_achievements_tbody">
                                                            <tr>
                                                                <td>1</td>
                                                                <td><input type="text" class="form-control" name="fam_relation[]" @if($personal_info->fam_relation) value="{{ $personal_info->fam_relation }}" @else value="{{ old('fam_relation') }}" @endif ></td>
                                                                <td><input type="text" class="form-control" name="full_name[]" @if($personal_info->full_name) value="{{ $personal_info->full_name }}" @else value="{{ old('full_name') }}" @endif ></td>
                                                                <td><input type="text" class="form-control" name="fam_age[]" @if($personal_info->fam_age) value="{{ $personal_info->fam_age }}" @else value="{{ old('fam_age') }}" @endif ></td>
                                                                <td></td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                    </div>

                                    <div class="tab-pane" id="finish">
                                        <h4 class="mb-3 mt-0"><u>Bank Details</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Account Holder Name</label>
                                                <input class="form-control" type="text" id="" name="account_holder_name" @if($personal_info->account_holder_name) value="{{ $personal_info->account_holder_name }}" @else value="{{ old('account_holder_name') }}" @endif placeholder=" Enter Account Holder Name">
                                                <div class="alert-danger">@error('account_holder_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Acount Number </label>
                                                <input class="form-control" type="text" id="" name="account_number" @if($personal_info->account_number) value="{{ $personal_info->account_number }}" @else value="{{ old('account_number') }}" @endif placeholder="Enter Account Number">
                                                <div class="alert-danger">@error('account_type'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>IFSC</label>
                                                <input class="form-control" type="text" id="" name="bank_ifsc" @if($personal_info->bank_ifsc) value="{{ $personal_info->bank_ifsc }}" @else value="{{ old('bank_ifsc') }}" @endif placeholder="Enter your IFSC">
                                                <div class="alert-danger">@error('bank_ifsc'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Name of Bank </label>
                                                <input class="form-control" type="text" id="" name="name_of_bank" @if($personal_info->name_of_bank) value="{{ $personal_info->name_of_bank }}" @else value="{{ old('name_of_bank') }}" @endif placeholder="Enter your Bank Name">
                                                <div class="alert-danger">@error('name_of_bank '){{ $message }}@enderror</div>
                                            </div>
                                            <br />
                                        </div>

                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                        </div>
                                        <!-- end row -->
                                    </div>

                                    <!-- END: Define your tab pans here -->

                                    <!-- START: Define your controller buttons here-->
                                    <div class="d-flex wizard justify-content-between mt-3">
                                        <div class="first">
                                            <a href="javascript:void(0);" class="btn btn-primary mt-3 mt-md-0">
                                                First
                                            </a>
                                        </div>&nbsp;
                                        <div class="d-flex">
                                            <span class="previous me-2">
                                                <a href="javascript:void(0);" class="btn icon-btn btn-primary mt-3 mt-md-0">
                                                    <i class="bx bx-left-arrow-alt me-2"></i>Back To Previous
                                                </a>
                                            </span>
                                            &nbsp;&nbsp;
                                            <span class="next">
                                                <a href="javascript:void(0);" class="btn icon-btn btn-primary mt-3 mt-md-0">
                                                    Next Step<i class="bx bx-right-arrow-alt ms-2"></i>
                                                </a>
                                            </span>
                                        </div>&nbsp;
                                        <div class="last">
                                            <a href="javascript:void(0);" class="btn btn-primary mt-3 mt-md-0">
                                                Finish
                                            </a>
                                        </div>
                                    </div>
                                    <!-- END: Define your controller buttons here-->

                                </div>
                                <!-- end tab content-->
                            </form>
                        </div>
                        <!-- end basicwizard -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /Page Content -->
</div>

<!-- You need add bootstrap  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- <script>
    function add() {
        $("#family-information").append('<br><div class="row add_more">'+
            '<div class="col-sm-4">'+
            '<label>Relation</label>'+
            '<input class="form-control" type="text" id="" name="am_relation[]" placeholder="Enter relation">'+
            ' </div>'+
            '<div class="col-sm-4">'+
                '<label>Full Name</label>'+
                '<input class="form-control" type="text" id="" name="full_name[]" placeholder="Enter Full Name">'+
            '</div>'+
            '<div class="col-sm-4">'+
                '<label>Age</label>'+
                '<input class="form-control" type="text" id="" name="fam_age[]" placeholder="Enter your Age">'+
            '</div>'+
            '<div>'
        );
    }
    function remove(){
      $(document).ready(function(){
        $("button").click(function(){
            $("div").remove(".add_more");
        });
      });

     
    }

</script> -->

<script>
    $(function() {
        $(document).on("click", '.btn-add-row', function() {
            var id = $(this).closest("table.table-review").attr('id'); // Id of particular table
            console.log(id);
            var div = $("<tr />");
            div.html(GetDynamicTextBox(id));
            $("#" + id + "_tbody").append(div);
        });
        $(document).on("click", "#comments_remove", function() {
            $(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
            $(this).closest("tr").remove();
        });

        function GetDynamicTextBox(table_id) {
            $('#comments_remove').remove();
            var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length + 1;
            return '<td>' + rowsLength + '</td>' +
                '<td><input type="text" name = "fam_relation[]" class="form-control" value = "" ></td>' +
                '<td><input type="text" name = "full_name[]" class="form-control" value = "" ></td>' +
                '<td><input type="text" name = "fam_age[]" class="form-control" value = "" ></td>' +
                '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
        }
    });

    function addressFunction() {
        if (document.getElementById("same").checked) {
            document.getElementById("permanent_state").value = document.getElementById("present_state").value;

            document.getElementById("permanent_city").value = document.getElementById("present_city").value;

            document.getElementById("permanent_pin").value = document.getElementById("present_pin").value;

            document.getElementById("permanent_address").value = document.getElementById("present_address").value;
        } else {
            document.getElementById("permanent_state").value = '';

            document.getElementById("permanent_city").value = '';

            document.getElementById("permanent_pin").value = '';

            document.getElementById("permanent_address").value = '';
        }
    }
</script>

<!--Import vanilla wizard here-->
<script src="https://cdn.jsdelivr.net/npm/vanilla-wizard@0.0.5">
</script>

<!--Initializing a wizard with no configuration -->
<script>
    new Wizard("#basicwizard", {
        progress: true
    });
</script>

@endsection