@extends('layouts.master')

@section('masters_noti')
noti-dot
@endsection

@section('allowance_active')
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
                    <h3 class="page-title">Allowance Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Tables</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_more_allowance"><i class="fa fa-plus"></i> Add More</a>
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
                                <th>Allowance ID</th>
                                <th>Allowance Name</th>
                                <th>Allowance Desc</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allowance_datas as $allow_data )
                            <tr>
                                <td class="allowance_id">{{ $allow_data->allowance_id }}</td>
                                <td class="allowance_name">{{ $allow_data->allowance_name }}</td>
                                <td class="allowance_desc">{{ $allow_data->allowance_desc }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item allowanceUpdate" data-toggle="modal" data-id="'.$allow_data->allowance_id.'" data-target="#edit_allowance"><i class=" fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item allowanceDelete" data-toggle="modal" data-id="'.$allow_data->allowance_id.'" data-target="#delete_allowance"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    <!-- Add Allowance Modal -->
    <div id="add_more_allowance" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Allowance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masters/allowanceMaster/add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Allowance Name<span class="required">*</span></label>
                                    <input class="form-control @error('allowance_name') is-invalid @enderror" type="text" id="" name="allowance_name" value="{{ old('allowance_name') }}" placeholder="Enter Allowance Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Allowance Description<span class="required">*</span></label>
                                    <input class="form-control @error('allowance_desc') is-invalid @enderror" type="text" id="" name="allowance_desc" value="{{ old('allowance_desc') }}" placeholder="Enter Allowance Description">
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
    <!-- /Add Allowance Modal -->

    <!-- Edit Allowance Modal -->
    <div id="edit_allowance" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Allowance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-body">
                    <form action="{{ route('masters/allowanceMaster/update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="hidden" name="allowance_id" id="allowance_id" value="">
                                <div class="form-group">
                                    <label>Allowance Name<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="allowance_name" id="allowance_name_edit" value="" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Allowance Description<span class="required">*</span></label>
                                <input class="form-control" type="text" name="allowance_desc" id="allowance_desc_edit" value="" />
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
    <!-- /Edit Allowance Modal -->

    <!-- Delete Allowance Modal -->
    <div class="modal custom-modal fade" id="delete_allowance" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('masters/allowanceMaster/delete') }}" method="POST">
                        @csrf
                        <div class="form-header">
                            <h3>Delete Allowance</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <input type="hidden" name="allowance_id" id="allowance_id" value="">
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary submit-btn">Delete</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Allowance Modal -->

</div>
<!-- /Page Wrapper -->
@section('script')
{{-- update js --}}
<script>
    $(document).on('click', '.allowanceUpdate', function() {
        var _this = $(this).parents('tr');
        $('#allowance_id').val(_this.find('.allowance_id').text());
        $('#allowance_name_edit').val(_this.find('.allowance_name').text());
        $('#allowance_desc_edit').val(_this.find('.allowance_desc').text());
    });

    $(document).on('click', '.allowanceDelete', function() {
        var _this = $(this).parents('tr');
        $('#allowance_id').val(_this.find('.allowance_id').text());
    });
</script>
@endsection

@endsection