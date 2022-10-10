@extends('layouts.master')

@section('masters_noti')
noti-dot
@endsection

@section('designation_active')
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
                    <h3 class="page-title">Designation Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Tables</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_designation"><i class="fa fa-plus"></i> Add More</a>
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
                                <th>S No.</th>
                                <th>Designation Name</th>
                                <th>Designation Code</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($designation_datas as $key=>$design_datas )
                            <tr>
                                <td hidden class="designation_id">{{ $design_datas->designation_id }}</td>
                                <td>{{ ++$key }}</td>
                                <td class="designation_name">{{ $design_datas->designation_name }}</td>
                                <td class="designation_code">{{ $design_datas->designation_code }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item designationUpdate" data-toggle="modal" data-id="'.$design_datas->designation_id.'" data-target="#edit_designation"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item designationDelete" href="#" data-toggle="modal" data-target="#delete_designation"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    <!-- Add Designation Modal -->
    <div id="add_designation" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Designation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masters/designationMaster/add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Designation Name<span class="required">*</span></label>
                                    <input class="form-control @error('designation_name') is-invalid @enderror" type="text" id="" name="designation_name" value="{{ old('designation_name') }}" placeholder="Enter Designation Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Designation Code<span class="required">*</span></label>
                                    <input class="form-control @error('designation_code') is-invalid @enderror" type="text" id="" name="designation_code" value="{{ old('designation_code') }}" placeholder="Enter Designation Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Post<span class="required">*</span></label>
                                    <select class="select form-control @error('post_name') is-invalid @enderror" name="post_name" id="">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($posts as $post )
                                        <option value="{{ $post->post_id }}">{{ $post->post_title }}</option>
                                        @endforeach
                                    </select>
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

    <!-- Edit Designation Modal -->
    <div id="edit_designation" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Designation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-body">
                    <form action="{{ route('masters/designationMaster/update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="hidden" name="designation_id" id="designation_id" value="">
                                    <div class="form-group">
                                        <label>Designation Name<span class="required">*</span></label>
                                        <input class="form-control" type="text" name="designation_name" id="designation_name_edit" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Designation Code<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="designation_code" id="designation_code_edit" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Post<span class="required">*</span></label>
                                    <select class="select form-control" name="post_id" id="post_id_edit">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($posts as $post )
                                        <option value="{{ $post->post_id }}">{{ $post->post_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Designation Modal -->

    <!-- Delete Designation Modal -->
    <div class="modal custom-modal fade" id="delete_designation" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Designation</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('masters/designationMaster/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="designation_id" class="designation_id" value="">
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
        <!-- /Delete Designation Modal -->
    </div>
    <!-- /Delete Designation Modal -->
</div>
<!-- /Page Wrapper -->

@endsection


@section('script')
{{-- update js --}}
<script>
    $(document).on('click', '.designationUpdate', function() {
        var _this = $(this).parents('tr');
        $('#designation_id').val(_this.find('.designation_id').text());
        $('#designation_name_edit').val(_this.find('.designation_name').text());
        $('#designation_code_edit').val(_this.find('.designation_code').text());
    });
</script>
{{-- delete model --}}
<script>
    $(document).on('click', '.designationDelete', function() {
        var _this = $(this).parents('tr');
        $('.designation_id').val(_this.find('.designation_id').text());
    });
</script>
@endsection
