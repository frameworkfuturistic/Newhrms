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
                                            <small class="text-muted">{{ $design_name[0]->design_name }}</small>
                                            <div class="staff-id">Employee ID : {{ Auth::user()->emp_id }}</div><br />
                                            <div class="small doj text-muted">Date of Join : {{ Auth::user()->join_date }}</div>
                                            <small class="text-muted">Gender : {{ Auth::user()->gender }}</small><br />
                                            <small class="text-muted">Reporting Authority : {{ $reporting_auth_name[0]->name }}({{ $reporting_auth_name[0]->emp_id }})</small>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection