@extends('layouts.master')

@section('emp_noti')
noti-dot
@endsection

@section('log_active')
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
                    <h3 class="page-title">Employee Activity Log</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Activity Log</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- /Search Filter -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee_ID</th>
                                <th>Deleted Employee</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Role Name</th>
                                <th>Modify</th>
                                <th>Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activityLog as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->role_name }}</td>
                                <td>{{ $item->modify_user }}</td>
                                <td>{{ $item->date_time }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
</div>

@endsection