@extends('layouts.master')

@section('editemp_noti_dot')
noti-dot
@endsection

@section('add_user_active')
active
@endsection

<!-- @section('css_cdn')

@endsection -->

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


                <div class="row align-items-center">
                    <div class="col-12">
                        <div id="basicwizard">
                            <ul class="nav nav-tabs nav-justified mb-3">
                                <li class="nav-item" data-target-form="#personalDetailForm">
                                    <a href="#personalDetail" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn active">
                                        <i class="bx bxs-contact me-1"></i>
                                        <span class="d-none d-sm-inline">Personal Information</span>
                                    </a>
                                </li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#identificationDetailForm">
                                    <a href="#identificationDetail" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn">
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
                                <li class="nav-item">
                                    <a href="#finish" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn">
                                        <i class="bx bxs-check-circle me-1"></i>
                                        <span class="d-none d-sm-inline">Family Information</span>
                                    </a>
                                </li>
                                <!-- end nav item -->
                            </ul>
                            <!-- nav pills -->

                            <div class="tab-content mb-0 pt-0">
                                <!-- START: Define your progress bar here -->
                                <div id="bar" class="progress mb-3" style="height: 7px;">
                                    <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                </div>
                                <!-- END: Define your progress bar here -->


                                <!-- START: Define your tab pans here -->

                                <div class="tab-pane show active" id="personalDetail">

                                    <form action="{{ route('user/add/save') }}" id="personalForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>First Name<span class="required">*</span></label>
                                                    <input class="form-control @error('first_name') is-invalid @enderror" type="text" id="" name="first_name" value="{{ old('first_name') }}" placeholder="Enter Your First Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input class="form-control @error('last_name') is-invalid @enderror" type="text" id="" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Date Of Birth</label>
                                                <input class="form-control" type="date" id="" name="dob" placeholder="Enter date of birth">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Profile Photo</label>
                                                <input class="form-control" type="file" id="image" name="image">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Personal Email</label>
                                                <input class="form-control" type="email" id="" name="personal_email" placeholder="Enter Personal Email">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Department Email</label>
                                                <input class="form-control" type="email" id="" name="department_email" placeholder="Enter Department Email">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Date Of Joining</label>
                                                <input class="form-control" type="date" id="" name="date_of_joining" placeholder="Enter Date Of Joining">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Organization Level</label>
                                                <select class="select" name="org_level" id="org_level">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Office Name</label>
                                                    <input class="form-control @error('office_name') is-invalid @enderror" type="text" id="" name="office_name" value="{{ old('office_name') }}" placeholder="Enter office Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Employee Type</label>
                                                <select class="select" name="emp_type" id="emp_type">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Post</label>
                                                <select class="select" name="post" id="post">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Designation</label>
                                                <select class="select" name="designation" id="designation">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Pay Slab</label>
                                                <select class="select" name="pay_slab" id="pay_slab">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Attendance Type</label>
                                                <select class="select" name="attend_type" id="attend_type">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Reporting Authority</label>
                                                <select class="select" name="report_auth" id="report_auth">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>CUG Number</label>
                                                    <input class="form-control @error('cug_no') is-invalid @enderror" type="text" id="cug_no" name="cug_no" value="{{ old('cug_no') }}" placeholder="Enter CUG Number">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                                <!-- end personal detail tab pane -->
                                <div class="tab-pane" id="identificationDetail">
                                    <form action="{{ route('user/add/save') }}" id="identificationForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Aadhar Card</label>
                                                    <input class="form-control @error('ad_card') is-invalid @enderror" type="file" id="" name="ad_card" value="{{ old('ad_card') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Aadhar No.</label>
                                                    <input class="form-control @error('aadhar_no') is-invalid @enderror" type="text" id="" name="aadhar_no" value="{{ old('aadhar_no') }}" placeholder="Enter Aadhar Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PAN Card</label>
                                                    <input class="form-control @error('pan_card') is-invalid @enderror" type="file" id="" name="pan_card">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PAN No.</label>
                                                    <input class="form-control @error('pan_no') is-invalid @enderror" type="text" id="" name="pan_no" value="{{ old('pan_no') }}" placeholder="Enter PAN Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Driving License</label>
                                                <input class="form-control" type="file" id="" name="dl" placeholder="Enter Driving License">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Passport</label>
                                                <input class="form-control" type="file" id="" name="passport" placeholder="Enter Passport Number">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Voter ID Card</label>
                                                <input class="form-control" type="file" id="" name="voter_id" placeholder="Enter Voter ID">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>UAN No.</label>
                                                <input class="form-control" type="file" id="" name="uan" placeholder="Enter UAN No.">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end identification detail tab pane -->
                                <div class="tab-pane" id="contactDetail">
                                    <form action="{{ route('user/add/save') }}" id="contactForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <h4 class="mb-3 mt-0"><u>Present Address</u></h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>City</label>
                                                <select class="select" name="present_city" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>State</label>
                                                <select class="select" name="present_state" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>PIN Code</label>
                                                <select class="select" name="present_pin" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Country</label>
                                                <select class="select" name="present_country" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="mb-3 mt-0"><u>Permanent Address</u></h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>City</label>
                                                <select class="select" name="permanent_city" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>State</label>
                                                <select class="select" name="permanent_state" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>PIN Code</label>
                                                <select class="select" name="permanent_pin" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Country</label>
                                                <select class="select" name="permanent_country" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Personal Contact Number</div>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" id="" name="personal_contact" placeholder="Enter Personal Contact Number">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Alternative Contact Number</div>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" id="" name="alternative_contact" placeholder="Enter Alternative Contact Number">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Number</div>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" id="" name="emergency_contact" placeholder="Enter Emergency Contact Number">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Name</div>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" id="" name="emerg_con_per_name" placeholder="Enter Emergency Contact Person Name">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Relation</div>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" id="" name="emerg_con_per_rel" placeholder="Enter Emergency Contact Person Relation">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Address</div>
                                            </div>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" id="" name="emerg_con_per_add" placeholder="Enter Emergency Contact Person Address">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end contact detail tab pane -->
                                <div class="tab-pane" id="experienceDetail">
                                    <form action="{{ route('user/add/save') }}" id="experienceForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <h4 class="mb-3 mt-0"><u>Education Qualification Details</u></h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Course Name</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_course_name" placeholder="Enter Course Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Stream</label>
                                                <input class="form-control" type="text" id="stream" name="edu_qua_stream" placeholder="Enter Stream">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Board</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_board" placeholder="Enter Board Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Passing Year</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_passing_year" placeholder="Enter Passing Year">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Percentage/ GPA</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_percentage" placeholder="Enter Percentage/ GPA">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Certificate Upload</label>
                                                <input class="form-control" type="file" id="" name="edu_qua_certi_upload" placeholder="Enter Percentage/ GPA">
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Professional Qualification Details</u></h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Institution/ University Name</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_university_name" placeholder="Enter University Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Degree/ Diploma</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_degree" placeholder="Enter degree/ Diploma">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Subject/ Courses</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_subject" placeholder="Enter Subject/ Courses">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Duration</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_duration" placeholder="Enter Course Duration">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>City</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_city" placeholder="Enter Subject/ Courses">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Year Of Passing</label>
                                                <input class="form-control" type="month" id="" name="pro_qua_year" placeholder="Enter Year Of Passing">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Industry Certification</label>
                                                <input class="form-control" type="file" id="" name="pro_qua_ind_certi" />
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Technical Skills</u></h4>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Skill Name</label>
                                                <input class="form-control" type="text" id="" name="skill_name" placeholder="Enter Skills Name" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Duration</label>
                                                <input class="form-control" type="text" id="" name="skill_duration" placeholder="Enter Duration" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Certificate</label>
                                                <input class="form-control" type="file" id="" name="skill_certi" />
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Experience Details</u></h4>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Organisation Name</label>
                                                <input class="form-control" type="text" id="" name="organ_name" placeholder="Enter Organisation Name" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Job Profile</label>
                                                <input class="form-control" type="file" id="" name="job_profile" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Organisation Type</label>
                                                <select class="select" name="organ_type" id="">
                                                    <option selected disabled> --Select --</option>
                                                    <option value="Government">Government</option>
                                                    <option value="private">Private</option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Industry Type</label>
                                                <select class="select" name="ind_type" id="">
                                                    <option selected disabled> --Select --</option>

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Effective From Date</label>
                                                <input class="form-control" type="date" id="" name="eff_from_date" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Effective To Date</label>
                                                <input class="form-control" type="date" id="" name="eff_to_date" />
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Supporting Document Upload</label>
                                                <input class="form-control" type="file" id="" name="supp_doc_upload" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end experience detail tab pane -->
                                <div class="tab-pane" id="finish">
                                    <form action="{{ route('user/add/save') }}" id="experienceForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <h4 class="mb-3 mt-0"><u>Family Information</u></h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Relation</label>
                                                <input class="form-control" type="text" id="" name="fam_relation" placeholder="Enter relation">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Full Name</label>
                                                <input class="form-control" type="text" id="" name="full_name" placeholder="Enter Full Name">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Gender</label>
                                                <select class="select" name="fam_gender" id="">
                                                    <option selected disabled> --Select --</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="others">Others</option>

                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Aadhar Number</label>
                                                <input class="form-control" type="text" id="" name="aadhar_no" placeholder="Enter Aadhar No.">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Date Of Birth</label>
                                                <input class="form-control" type="date" id="" name="fam_dob" placeholder="Enter Date Of Birth">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Dependent</label>
                                                <select class="select" name="dependent" id="">
                                                    <option selected disabled> --Select --</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                        </div>
                                    </form>
                                    <!-- end row -->
                                </div>

                                <!-- END: Define your tab pans here -->

                                <!-- START: Define your controller buttons here-->
                                <div class="d-flex wizard justify-content-between mt-3">
                                    <div class="first">
                                        <a href="javascript:void(0);" class="btn btn-primary">
                                            First
                                        </a>
                                    </div>
                                    <div class="d-flex">
                                        <div class="previous me-2">
                                            <a href="javascript:void(0);" class="btn icon-btn btn-primary">
                                                <i class="bx bx-left-arrow-alt me-2"></i>Back To Previous
                                            </a>
                                        </div>
                                        <div class="next">
                                            <a href="javascript:void(0);" class="btn icon-btn btn-primary mt-3 mt-md-0">
                                                Next Step<i class="bx bx-right-arrow-alt ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="last">
                                        <a href="javascript:void(0);" class="btn btn-primary mt-3 mt-md-0">
                                            Finish
                                        </a>
                                    </div>
                                </div>
                                <!-- END: Define your controller buttons here-->

                            </div>
                            <!-- end tab content-->
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