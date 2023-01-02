@extends('layouts.master')

@section('editemp_noti_dot')
noti-dot
@endsection



@section('content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid" id="mydiv">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">

                <div class="col-sm-12">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
            <br>
            <buttonn type="button" oclick="myfunc('mydiv')"> print</button>
        </div>
        {{-- message --}}
        {!! Toastr::message() !!}
        <!-- /Page Header -->
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#">
                                        <img alt="" src="{{ URL::to('/assets/employee_image/'. Auth::user()->avatar) }}" alt="images/default.png">
                                    </a>
                                </div>
                                <div class="pro-edit"><a data-target="#profile_pic_change" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                            </div>

                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{ Auth::user()->name }}</h3>
                                            <div class="staff-id">Employee ID : {{ Auth::user()->emp_id }}</div><br />
                                            <div class="small doj text-muted">Date of Join : {{ Auth::user()->join_date }}</div>
                                            <small class="text-muted">Gender : {{ Auth::user()->gender }}</small><br />
                                            <small class="text-muted">Reporting Authority : {{ $reporting_auth_name[0]->name }}({{ $reporting_auth_name[0]->emp_id }})</small>

                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                @if(!empty($information->email))
                                                <div class="title">Email:</div>
                                                <div class="text"><a href="">{{ Auth::user()->email }}</a></div>
                                                @else
                                                <div class="title">Email:</div>
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>

                                            <li>
                                                @if(!empty($information->department_email))
                                                <div class="title">Dept. Email:</div>
                                                <div class="text">{{ $information->department_email }}</div>
                                                @else
                                                <div class="title">Dept. Email:</div>
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>

                                            <li>
                                                @if(!empty($information->dob))
                                                <div class="title">Birthday:</div>
                                                <div class="text">{{date('d F, Y',strtotime($information->dob)) }}</div>
                                                @else
                                                <div class="title">Birthday:</div>
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>

                                            <li>
                                                @if(!empty($information->cug_no))
                                                <div class="title">CUG No:</div>
                                                <div class="text">{{ $information->cug_no }}</div>
                                                @else
                                                <div class="title">CUG No:</div>
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-content">
            <!-- Profile Info Tab -->
            <div id="emp_profile" class="pro-overview tab-pane fade show active">
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Identification Details :
                                    <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a>
                                </h3>
                                <ul class="personal-info">
                                    @if(!empty($information))
                                    <li>
                                        @if(!empty($information->personal_contact))
                                        <div class="title">Personal Contact</div>
                                        <div class="text">{{ $information->personal_contact }}</div>
                                        @else
                                        <div class="title">Personal Contact</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->personal_contact))
                                        <div class="title">Alternative Contact</div>
                                        <div class="text">{{ $information->alternative_contact }}</div>
                                        @else
                                        <div class="title">Alternative Contact</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->aadhar_no))
                                        <div class="title">Aadhar Number</div>
                                        <div class="text">{{ $information->aadhar_no }}</div>
                                        @else
                                        <div class="title">Aadhar Number</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->pan_no))
                                        <div class="title">Pan Number</div>
                                        <div class="text">{{ $information->pan_no }}</div>
                                        @else
                                        <div class="title">Pan Number</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->uan_no_of_emp))
                                        <div class="title">UAN Number</div>
                                        <div class="text">{{ $information->uan_no_of_emp }}</div>
                                        @else
                                        <div class="title">UAN Number</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->blood_group))
                                        <div class="title">Blood Group</div>
                                        <div class="text">{{ $information->blood_group }}</div>
                                        @else
                                        <div class="title">Blood Group</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>



                                    @else
                                    <li>
                                        <div class="title">Personal Contact</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Alternative Contact</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Aadhar Number</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Pan Number</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">UAN Number</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Blood Group</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Contact Details :
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a> -->
                                </h3>
                                <ul class="personal-info">
                                    <li>
                                        @if(!empty($information->present_state))
                                        <div class="title">present State</div>
                                        <div class="text">{{ $information->present_state }}</div>
                                        @else
                                        <div class="title">Present State</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->present_city))
                                        <div class="title">present City</div>
                                        <div class="text">{{ $information->present_city }}</div>
                                        @else
                                        <div class="title">Present CIty</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->present_address))
                                        <div class="title">Present Address</div>
                                        <div class="text">{{ $information->present_address }}</div>
                                        @else
                                        <div class="title">Present Address</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->present_pin))
                                        <div class="title">Present Pin</div>
                                        <div class="text">{{ $information->present_pin }}</div>
                                        @else
                                        <div class="title">Present Pin</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->permanent_state))
                                        <div class="title">Present State</div>
                                        <div class="text">{{ $information->permanent_state }}</div>
                                        @else
                                        <div class="title">Present State</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->permanent_city))
                                        <div class="title">Permanent City</div>
                                        <div class="text">{{ $information->permanent_city }}</div>
                                        @else
                                        <div class="title">Permanent City</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->permanent_address))
                                        <div class="title">Permanent Address</div>
                                        <div class="text">{{ $information->present_address }}</div>
                                        @else
                                        <div class="title">Permanent Address</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>


                                    <li>
                                        @if(!empty($information->permanent_pin))
                                        <div class="title">Permanent Pin</div>
                                        <div class="text">{{ $information->permanent_pin }}</div>
                                        @else
                                        <div class="title">Permanent Pin</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                </ul>
                                <h4 class="card-title">Emergency Contact Details : </h4>

                                <ul class="personal-info">
                                    @if(!empty($information))
                                    <li>
                                        @if(!empty($information->emerg_con_per_name))
                                        <div class="title">Name</div>
                                        <div class="text">{{ $information->emerg_con_per_name }}</div>
                                        @else
                                        <div class="title">Name</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        @if(!empty($information->emerg_con_per_rel))
                                        <div class="title">Relationship</div>
                                        <div class="text">{{ $information->emerg_con_per_rel }}</div>
                                        @else
                                        <div class="title">Relationship</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        @if(!empty($information->emerg_con_per_add))
                                        <div class="title">Address </div>
                                        <div class="text">{{ $information->emerg_con_per_add }}</div>
                                        @else
                                        <div class="title">Address</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->emergency_contact))
                                        <div class="title">contact </div>
                                        <div class="text">{{ $information->emergency_contact }}</div>
                                        @else
                                        <div class="title">Contact</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    @else
                                    <li>
                                        <div class="title">Name</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Relationship</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Address </div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Contact </div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Present State </div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Present City </div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Present Pin</div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Present Address</div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Permanent State</div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Permanent city</div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Permanent Address</div>
                                        <div class="text">N/A</div>
                                    </li>

                                    <li>
                                        <div class="title">Permanent Pin</div>
                                        <div class="text">N/A</div>
                                    </li>

                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Bank information :</h3>
                                <ul class="personal-info">
                                    <li>
                                        @if(!empty($information->name_of_bank))
                                        <div class="title">Bank name</div>
                                        <div class="text">{{ $information->name_of_bank }}</div>
                                        @else
                                        <div class="title">Bank name</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->account_holder_name))
                                        <div class="title">Bank Holder Name</div>
                                        <div class="text">{{ $information->account_holder_name }}</div>
                                        @else
                                        <div class="title">Bank Holder Name</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->bank_ifsc))
                                        <div class="title">IFSC Code</div>
                                        <div class="text">{{ $information->bank_ifsc }}</div>
                                        @else
                                        <div class="title">IFSC Code</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Family Informations :
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a> -->
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Age</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if(!empty($information->full_name))
                                                    {{ $information->full_name }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($information->fam_relation))
                                                    {{ $information->fam_relation }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($information->fam_age))
                                                    {{ $information->fam_age }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Education Information :
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a> -->
                                </h3>
                                <ul class="personal-info">
                                    @if(!empty($information))
                                    <li>
                                        @if(!empty($information->edu_qua_course_name))
                                        <div class="title">Course Name</div>
                                        <div class="text">{{ $information->edu_qua_course_name }}</div>
                                        @else
                                        <div class="title">Course Name</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->edu_qua_stream))
                                        <div class="title">Stream</div>
                                        <div class="text">{{ $information->edu_qua_stream }}</div>
                                        @else
                                        <div class="title">Stream</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->edu_qua_board))
                                        <div class="title">Board</div>
                                        <div class="text">{{ $information->edu_qua_board }}</div>
                                        @else
                                        <div class="title">Board</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->edu_qua_passing_year))
                                        <div class="title">Passing Year</div>
                                        <div class="text">{{ $information->edu_qua_passing_year }}</div>
                                        @else
                                        <div class="title">Passing Year</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    <li>
                                        @if(!empty($information->edu_qua_percentage))
                                        <div class="title">Percentage/ GPA</div>
                                        <div class="text">{{ $information->edu_qua_percentage }}</div>
                                        @else
                                        <div class="title">Percentage/ GPA</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>

                                    @else
                                    <li>
                                        <div class="title">Course Name</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Stream</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Board</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Passing Year</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Percentage/ GPA
                                        </div>
                                        <div class="text">N/A</div>
                                    </li>
                                    @endif
                                </ul>
                                <h4 class="card-title">Professional Qualification Details : </h4>

                                <ul class="personal-info">
                                    @if(!empty($information))
                                    <li>
                                        @if(!empty($information->pro_qua_university_name))
                                        <div class="title">Institution/ University Name</div>
                                        <div class="text">{{ $information->pro_qua_university_name }}</div>
                                        @else
                                        <div class="title">Institution/ University Name</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        @if(!empty($information->pro_qua_degree))
                                        <div class="title">Degree/ Diploma</div>
                                        <div class="text">{{ $information->pro_qua_degree }}</div>
                                        @else
                                        <div class="title">Degree/ Diploma</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        @if(!empty($information->pro_qua_subject))
                                        <div class="title">Subject/ Courses</div>
                                        <div class="text">{{ $information->pro_qua_subject }}</div>
                                        @else
                                        <div class="title">Subject/ Courses</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    @else
                                    <li>
                                        <div class="title">Institution/ University Name</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Degree/ Diploma</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Experience :
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a> -->
                                </h3>
                                <ul class="personal-info">
                                    @if(!empty($information))
                                    <li>
                                        @if(!empty($information->organ_name))
                                        <div class="title">Organisation Name</div>
                                        <div class="text">{{ $information->organ_name }}</div>
                                        @else
                                        <div class="title">Organisation Name</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        @if(!empty($information->job_profile))
                                        <div class="title">Job Profile</div>
                                        <div class="text">{{ $information->job_profile }}</div>
                                        @else
                                        <div class="title">Job profile</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        @if(!empty($information->organ_type))
                                        <div class="title">Organisation Type</div>
                                        <div class="text">{{ $information->organ_type }}</div>
                                        @else
                                        <div class="title">Organisation Type</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    @else
                                    <li>
                                        <div class="title">Organisation Name</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">job profile</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Organisation Type</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    @endif
                                </ul>
                                <h4 class="card-title">Technical Skills :</h4>
                                <ul class="personal-info">
                                    @if(!empty($information))
                                    <li>
                                        @if(!empty($information->pro_qua_university_name))
                                        <div class="title">Institution/ University Name</div>
                                        <div class="text">{{ $information->pro_qua_university_name }}</div>
                                        @else
                                        <div class="title">Institution/ University Name</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        @if(!empty($information->pro_qua_duration))
                                        <div class="title">Duration</div>
                                        <div class="text">{{ $information->pro_qua_duration }}</div>
                                        @else
                                        <div class="title">Duration</div>
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    @else
                                    <li>
                                        <div class="title">Course Name</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    <li>
                                        <div class="title">Duration</div>
                                        <div class="text">N/A</div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Info Tab -->

    </div>
</div>
<!-- Change Profile Pic Modal -->
<div id="profile_pic_change" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Profile Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/profile/change-pic" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-img-wrap edit-img">
                                <img class="inline-block" src="{{ URL::to('/assets/employee_image/'. Auth::user()->avatar) }}" alt="images/default.png">
                                <div class="fileupload btn">
                                    <span class="btn-text">edit</span>
                                    <input class="upload" type="file" id="upload" name="upload">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div hidden class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ Auth::user()->id }}">
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
<!-- /Change Profile Pic Modal -->
<!-- /Page Content -->
</div>

<script type="text/javascript">
    function myfunc(paravalue) {
        var backup = document.body.innerHTML;
        var divcontent = document.getElementByid(paravalue).innerHTML;
        document.body.innerHTML = divcontent;
        javascript: window.print();

    }
</script>
@endsection