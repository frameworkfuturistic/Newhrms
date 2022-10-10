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
    {{-- message --}}
    {!! Toastr::message() !!}
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
                    <table class="table table-striped custom-table" id="datatable">
                        <thead>
                            <tr>
                                <th hidden></th>
                                <th>State No.</th>
                                <th>State Name</th>
                                <th>State Code</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($state_datas as $key=>$state_data )
                            <tr>
                                <td hidden class="state_id">{{ $state_data->state_id }}</td>
                                <td>{{ ++$key }}</td>
                                <td class="state_name">{{ $state_data->state_name }}</td>
                                <td class="state_code">{{ $state_data->state_code }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item stateUpdate" data-toggle="modal" data-id="'.$state_data->state_id.'" data-target="#edit_state"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item stateDelete" href="#" data-toggle="modal" data-target="#delete_state"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>State Name<span class="required">*</span></label>
                                    <input class="form-control @error('state_name') is-invalid @enderror" type="text" id="" name="state_name" value="{{ old('state_name') }}" placeholder="Enter State Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
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
    <!-- /Add state Modal -->

    <!-- Edit state Modal -->
    <div id="edit_state" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit State</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-body">
                    <form action="{{ route('masters/stateMaster/update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <input type="hidden" name="state_id" id="state_id" value="">
                                <div class="form-group">
                                    <label>State Name<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="state_name" id="state_name_edit" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>State Code<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="state_code" id="state_code_edit" value="" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit State Modal -->

    <!-- Delete State Modal -->
    <div class="modal custom-modal fade" id="delete_state" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete State</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('masters/stateMaster/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="state_id" class="state_id" value="">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Allowance Modal -->

</div>
@endsection
<!-- /Page Wrapper -->
@section('script')
{{-- update js --}}

<script>
    $(document).on('click', '.stateUpdate', function() {
        var _this = $(this).parents('tr');
        $('#state_id').val(_this.find('.state_id').text());
        $('#state_name_edit').val(_this.find('.state_name').text());
        $('#state_code_edit').val(_this.find('.state_code').text());
    });
</script>
{{-- delete model --}}
<script>
    $(document).on('click', '.stateDelete', function() {
        var _this = $(this).parents('tr');
        $('.state_id').val(_this.find('.state_id').text());
    });
</script>
@endsection