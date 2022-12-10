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
                                <li class="nav-item">
                                    <a href="#finish" data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn">
                                        <i class="bx bxs-check-circle me-1"></i>
                                        <span class="d-none d-sm-inline">Family Information</span>
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
                                                    <input class="form-control @error('aadhar_no') is-invalid @enderror" type="text" id="" name="aadhar_no" value="{{ old('aadhar_no') }}" placeholder="Enter Aadhar Number">
                                                </div>
                                                <div class="alert-danger">@error('aadhar_no'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Aadhar Card</label>
                                                    <input class="form-control @error('aadhar_card') is-invalid @enderror" type="file" id="" name="aadhar_card" value="{{ old('aadhar_card') }}">
                                                </div>
                                                <div class="alert-danger">@error('aadhar_card'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PAN No.</label>
                                                    <input class="form-control @error('pan_no') is-invalid @enderror" type="text" id="" name="pan_no" value="{{ old('pan_no') }}" placeholder="Enter PAN Number">
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
                                                <input class="form-control" type="file" id="" name="uan">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>UAN No.</label>
                                                <input class="form-control" type="text" id="" name="uan_no_of_emp" value="{{ old('uan_no_of_emp') }}" placeholder="Enter UAN Number">
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
                                                <input class="form-control @error('present_city') is-invalid @enderror" type="text" id="" name="present_city" value="{{ old('present_city') }}" placeholder="Enter City" />
                                                <div class="alert-danger">@error('present_city'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>PIN Code</label>
                                                <input class="form-control @error('present_pin') is-invalid @enderror" type="text" id="" name="present_pin" value="{{ old('present_pin') }}" placeholder="Enter Pin" />
                                                <div class="alert-danger">@error('present_pin'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="mb-3 mt-0"><u>Permanent Address</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>State</label>
                                                <select class="select" name="permanent_state" id="">
                                                    <option selected disabled> --Select --</option>
                                                    @foreach($state['data'] as $st)
                                                    <option value="{{ $st->state_id }}">{{ $st->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="alert-danger">@error('permanent_state'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>City</label>
                                                <input class="form-control @error('permanent_city') is-invalid @enderror" type="text" id="" name="permanent_city" value="{{ old('permanent_city') }}" placeholder="Enter City" />
                                                <div class="alert-danger">@error('permanent_city'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>PIN Code</label>
                                                <input class="form-control @error('permanent_pin') is-invalid @enderror" type="text" id="" name="permanent_pin" value="{{ old('permanent_pin') }}" placeholder="Enter Pin" />
                                                <div class="alert-danger">@error('permanent_pin'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Personal Contact Number</div>
                                                <input class="form-control" type="text" id="" name="personal_contact" placeholder="Enter Personal Contact Number">
                                                <div class="alert-danger">@error('personal_contact'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>Alternative Contact Number</div>
                                                <input class="form-control" type="text" id="" name="alternative_contact" placeholder="Enter Alternative Contact Number">
                                                <div class="alert-danger">@error('alternative_contact'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Number</div>
                                                <input class="form-control" type="text" id="" name="emergency_contact" placeholder="Enter Emergency Contact Number">
                                                <div class="alert-danger">@error('emergency_contact'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Name</div>
                                                <input class="form-control" type="text" id="" name="emerg_con_per_name" placeholder="Enter Emergency Contact Person Name">
                                                <div class="alert-danger">@error('emerg_con_per_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Relation</div>
                                                <input class="form-control" type="text" id="" name="emerg_con_per_rel" placeholder="Enter Emergency Contact Person Relation">
                                                <div class="alert-danger">@error('emerg_con_per_rel'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>Emergency Contact Person Address</div>
                                                <input class="form-control" type="text" id="" name="emerg_con_per_add" placeholder="Enter Emergency Contact Person Address">
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
                                                <input class="form-control" type="text" id="" name="edu_qua_course_name" placeholder="Enter Course Name">
                                                <div class="alert-danger">@error('edu_qua_course_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Stream</label>
                                                <input class="form-control" type="text" id="stream" name="edu_qua_stream" placeholder="Enter Stream">
                                                <div class="alert-danger">@error('edu_qua_stream'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Board</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_board" placeholder="Enter Board Name">
                                                <div class="alert-danger">@error('edu_qua_board'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Passing Year</label>
                                                <input class="form-control" type="number" id="" name="edu_qua_passing_year" placeholder="YYYY" min="1940" max="2060">
                                                <div class="alert-danger">@error('edu_qua_passing_year'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Percentage/ GPA</label>
                                                <input class="form-control" type="text" id="" name="edu_qua_percentage" placeholder="Enter Percentage/ GPA">
                                                <div class="alert-danger">@error('edu_qua_percentage'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Certificate Upload</label>
                                                <input class="form-control" type="file" id="" name="edu_qua_certi_upload" placeholder="Enter Percentage/ GPA">
                                                <div class="alert-danger">@error('edu_qua_certi_upload'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Professional Qualification Details</u></h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Institution/ University Name</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_university_name" placeholder="Enter University Name">
                                                <div class="alert-danger">@error('pro_qua_university_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Degree/ Diploma</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_degree" placeholder="Enter degree/ Diploma">
                                                <div class="alert-danger">@error('pro_qua_degree'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Subject/ Courses</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_subject" placeholder="Enter Subject/ Courses">
                                                <div class="alert-danger">@error('pro_qua_subject'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label>Duration</label>
                                                <input class="form-control" type="text" id="" name="pro_qua_duration" placeholder="Enter Course Duration">
                                                <div class="alert-danger">@error('pro_qua_duration'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Industry Certification</label>
                                                <input class="form-control" type="file" id="" name="pro_qua_ind_certi" />
                                                <div class="alert-danger">@error('pro_qua_ind_certi'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Year Of Passing</label>
                                                <input class="form-control" type="number" id="" name="pro_qua_year" placeholder="YYYY" min="1940" max="2060">
                                                <div class="alert-danger">@error('pro_qua_year'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Technical Skills</u></h4>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Skill Name</label>
                                                <input class="form-control" type="text" id="" name="skill_name" placeholder="Enter Skills Name" />
                                                <div class="alert-danger">@error('skill_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Duration</label>
                                                <input class="form-control" type="text" id="" name="skill_duration" placeholder="Enter Duration" />
                                                <div class="alert-danger">@error('skill_duration'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                        <h4 class="mb-3 mt-0"><u>Experience Details</u></h4>
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Organisation Name</label>
                                                <input class="form-control" type="text" id="" name="organ_name" placeholder="Enter Organisation Name" />
                                                <div class="alert-danger">@error('organ_name'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Job Profile</label>
                                                <input class="form-control" type="file" id="" name="job_profile" />
                                                <div class="alert-danger">@error('job_profile'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Organisation Type</label>
                                                <select class="select" name="organ_type" id="">
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
                                                <input class="form-control" type="date" id="" name="eff_from_date" />
                                                <div class="alert-danger">@error('eff_from_date'){{ $message }}@enderror</div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Effective To Date</label>
                                                <input class="form-control" type="date" id="" name="eff_to_date" />
                                                <div class="alert-danger">@error('eff_to_date'){{ $message }}@enderror</div>
                                            </div>
                                        </div>
                                        <br />
                                    </div>
                                    <!-- end experience detail tab pane -->
                                    <div class="tab-pane" id="finish">
                                        <h4 class="mb-3 mt-0"><u>Family Information</u></h4>
                                        <div class="row">
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
                                        </div>
                                        <br />
                                        <div class="submit-section">
                                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                        </div>
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