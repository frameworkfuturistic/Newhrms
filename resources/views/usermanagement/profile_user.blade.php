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
            <buttonn type="button" onclick="myfunc()"> print</button>
        </div>
        {{-- message --}}
        {!! Toastr::message() !!}
        <div id="printArea">
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
                                                <h3 class="user-name m-t-0 mb-0">{{ $information->name }}</h3>
                                                <div class="staff-id">Employee ID : {{ $information->emp_id }}</div>
                                                <div class="staff-id">Role : {{ $information->role_name }}</div><br />
                                                <div class="small doj text-muted">Date of Join : {{date('d F, Y',strtotime($information->join_date)) }}</div>
                                                <small class="text-muted">Gender : {{ $information->gender }}</small><br />
                                                <small class="text-muted">Reporting Authority : {{ $reporting_auth_name[0]->name }}({{ $reporting_auth_name[0]->emp_id }})</small>
                                                <small class="text-muted">Category : {{ $information->category }}</small><br />
                                                <small class="text-muted">Designation : {{ $information->designation }}</small>
                                                <br>
                                                <small class="text-muted">Pay Slab : {{ $information->pay_slab }}</small>
                                                <br>
                                                <small class="text-muted">Attendance Type : {{ $information->attendance_type ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><a href="">{{ $information->email ?? 'N/A' }}</a></div>
                                                </li>

                                                <li>
                                                    <div class="title">Dept. Email:</div>
                                                    <div class="text">{{ $information->department_email ?? 'N/A' }}</div>
                                                </li>

                                                <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text">{{date('d F, Y',strtotime($information->dob)) ?? 'N/A' }}</div>
                                                </li>

                                                <li>
                                                    <div class="title">CUG No:</div>
                                                    <div class="text">{{ $information->cug_no ?? 'N/A' }}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Org Level:</div>
                                                    <div class="text">{{ $information->org_level ?? 'N/A' }}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Office Name:</div>
                                                    <div class="text">{{ $information->office_name ?? 'N/A' }}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Employee Name:</div>
                                                    <div class="text">{{ $information->emp_type ?? 'N/A' }}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Post Title:</div>
                                                    <div class="text">{{ $information->post_title ?? 'N/A' }}</div>
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
                                        <li>
                                            <div class="title">Personal Contact</div>
                                            <div class="text">{{$personalInfo->personal_contact ?? 'N/A'}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Alternative Contact</div>
                                            <div class="text">{{$personalInfo->alternative_contact ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Aadhar Number</div>
                                            <div class="text">{{$personalInfo->aadhar_no ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Pan Number</div>
                                            <div class="text">{{$personalInfo->pan_no ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">UAN Number</div>
                                            <div class="text">{{$personalInfo->uan_no_of_emp ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Blood Group</div>
                                            <div class="text">{{$personalInfo->blood_group ?? 'N/A'}}</div>
                                        </li>
                                    </ul>
                                    <hr>
                                    <h4 class="card-title">Emergency Contact Details : </h4>

                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Name</div>
                                            <div class="text">{{$personalInfo->emerg_con_per_name ?? 'N/A'}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Relationship</div>
                                            <div class="text">{{$personalInfo->emerg_con_per_rel ?? 'N/A'}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Address </div>
                                            <div class="text">{{$personalInfo->emerg_con_per_add ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">contact </div>
                                            <div class="text">{{$personalInfo->emergency_contact ?? 'N/A'}}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Contact Details :
                                    </h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Present State</div>
                                            <div class="text">{{$personalInfo->m_present_state ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Present City</div>
                                            <div class="text">{{$personalInfo->present_city ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Present Address</div>
                                            <div class="text">{{$personalInfo->present_address ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Present Pin</div>
                                            <div class="text">{{$personalInfo->present_pin ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Permanent States</div>
                                            <div class="text">{{$personalInfo->m_permanent_state ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Permanent City</div>
                                            <div class="text">{{$personalInfo->permanent_city ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Permanent Address</div>
                                            <div class="text">{{$personalInfo->permanent_address ?? 'N/A'}}</div>
                                        </li>


                                        <li>
                                            <div class="title">Permanent Pin</div>
                                            <div class="text">{{$personalInfo->permanent_pin ?? 'N/A'}}</div>
                                        </li>
                                        <hr>
                                    </ul>
                                    <hr>
                                    <h3 class="card-title">Bank information :</h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Bank name</div>
                                            <div class="text">{{$personalInfo->name_of_bank ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Bank Holder Name</div>
                                            <div class="text">{{$personalInfo->account_holder_name ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">IFSC Code</div>
                                            <div class="text">{{$personalInfo->bank_ifsc ?? 'N/A'}}</div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Education Information -->
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Education Information :
                                    </h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Course Name</div>
                                            <div class="text">{{$personalInfo->edu_qua_course_name ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Stream</div>
                                            <div class="text">{{$personalInfo->edu_qua_stream ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Board</div>
                                            <div class="text">{{$personalInfo->edu_qua_board ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Passing Year</div>
                                            <div class="text">{{$personalInfo->edu_qua_passing_year ?? 'N/A'}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Percentage/ GPA</div>
                                            <div class="text">{{$personalInfo->edu_qua_percentage ?? 'N/A'}}</div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h4 class="card-title">Professional Qualification Details : </h4>

                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Technical Skill</div>
                                            <div class="text">{{$personalInfo->tech_skill ?? 'N/A'}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Duration</div>
                                            <div class="text">{{$personalInfo->skill_duration ?? 'N/A'}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Organisation Name</div>
                                            <div class="text">{{$personalInfo->organ_name ?? 'N/A'}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Job Profile</div>
                                            <div class="text">{{$personalInfo->job_profile ?? 'N/A'}}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Family Informations -->
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Family Informations :
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
                                                @foreach($familyInfos as $familyInfo)
                                                <tr>
                                                    <td>
                                                        {{$familyInfo->name}}
                                                    </td>
                                                    <td>
                                                        {{$familyInfo->relation}}
                                                    </td>
                                                    <td>
                                                        {{$familyInfo->age}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Profile Info Tab -->
        </div>


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
    function myfunc() {
        // alert("Function is Working");
        var divContents = document.getElementById("printArea").innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html>');
        a.document.write('<body > <h1>Div contents are <br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>
@endsection