@extends('layouts.master')

@section('masters_noti')
noti-dot
@endsection

@section('state_active')
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
                    <h3 class="page-title">State Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Tables</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_state"><i class="fa fa-plus"></i> Add More</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>State Name</th>
                                <th>State Code</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($state_datas as $state_data )
                            <tr>
                                <td class="email">{{ $state_data->state_name }}</td>
                                <td class="position">{{ $state_data->state_code }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item stateUpdate" data-toggle="modal" data-id="'.$state_data->state_id.'" data-target="#edit_state"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item stateDelete" href="#" data-toggle="modal" ata-id="'.$state_data->state_id.'" data-target="#delete_state"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add state Modal -->
    <div id="add_state" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New State</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masters/stateMaster/add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State Name<span class="required">*</span></label>
                                    <input class="form-control @error('state_name') is-invalid @enderror" type="text" id="" name="state_name" value="{{ old('state_name') }}" placeholder="Enter State Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State Code<span class="required">*</span></label>
                                    <input class="form-control @error('state_code') is-invalid @enderror" type="text" id="" name="state_code" value="{{ old('state_code') }}" placeholder="Enter State Code">
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
    <!-- /Add Designation Modal -->
</div>
<!-- /Page Wrapper -->

@endsection