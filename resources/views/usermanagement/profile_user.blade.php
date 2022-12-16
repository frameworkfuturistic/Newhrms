@extends('layouts.master')

@section('editemp_noti_dot')
noti-dot
@endsection



@section('content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
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
                            <!-- <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                        <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li>
                        <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li>
                    </ul>
                </div>
            </div>
        </div> -->

        <div class="tab-content">
            <!-- Profile Info Tab -->
            <div id="emp_profile" class="pro-overview tab-pane fade show active">
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">
                                    Personal Informations
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a> -->
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
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Emergency Contact
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a> -->
                                </h3>
                                <h5 class="section-title">Primary</h5>
                                <hr>
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
                                <h3 class="card-title">Bank information</h3>
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
                                    <li>
                                        @if(!empty($information->pan_no))
                                        <div class="title">PAN No</div>
                                        <div class="text">{{ $information->pan_no }}</div>
                                        @else
                                        <div class="title">PAN No</div>
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
                                <h3 class="card-title">Family Informations
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
                                <h3 class="card-title">Education Information
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a> -->
                                </h3>
                                <div class="experience-box">
                                    <ul class="experience-list">
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">
                                                    @if(!empty($information->edu_qua_board))
                                                    {{ $information->edu_qua_board }}
                                                    @else
                                                    N/A
                                                    @endif
                                                    </a>
                                                    <div>
                                                        <br />
                                                    @if(!empty($information->edu_qua_stream))
                                                    {{ $information->edu_qua_stream }}
                                                    @else
                                                    N/A
                                                    @endif
                                                    @if(!empty($information->edu_qua_course_name))
                                                    {{ $information->edu_qua_course_name }}
                                                    @else
                                                    N/A
                                                    @endif
                                                    <br />
                                                </div>
                                                <br />
                                                    <span class="time">
                                                        
                                                    @if(!empty($information->edu_qua_passing_year))
                                                    {{ $information->edu_qua_passing_year }}
                                                    @else
                                                    N/A
                                                    @endif</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Experience
                                    <!-- <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a> -->
                                </h3>
                                <div class="experience-box">
                                    <ul class="experience-list">
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">
                                                        @if(!empty($information->tech_skill))
                                                    {{ $information->tech_skill }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </a>
                                                    <span class="time">
                                                        @if(!empty($information->organ_name))
                                                    {{ $information->organ_name }}
                                                    @else
                                                    N/A
                                                    @endif - 
                                                    @if(!empty($information->skill_duration))
                                                    {{ $information->skill_duration }}
                                                    @else
                                                    N/A
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                        </li>
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

kk
    <!-- /Page Content -->
</div>
@endsection