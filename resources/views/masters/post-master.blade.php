@extends('layouts.master')

@section('masters_noti')
noti-dot
@endsection

@section('post_active')
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
                    <h3 class="page-title">Post Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Tables</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_more_post"><i class="fa fa-plus"></i> Add More</a>
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
                                <th hidden>ID</th>
                                <th>S.No.</th>
                                <th>Post Title</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post_data as $key=>$post_dt )
                            <tr>
                                <td hidden class="post_id">{{ $post_dt->post_id }}</td>
                                <td>{{ ++$key }}</td>
                                <td class="post_title">{{ $post_dt->post_title }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item postUpdate" data-toggle="modal" data-id="'.$post_dt->post_id.'" data-target="#edit_post"><i class=" fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item postDelete" data-toggle="modal" data-target="#delete_post"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    <!-- Add Post Modal -->
    <div id="add_more_post" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masters/postMaster/add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Post Name<span class="required">*</span></label>
                                    <input class="form-control @error('post_title') is-invalid @enderror" type="text" id="" name="post_title" value="{{ old('post_title') }}" placeholder="Enter Post Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Organisation Name<span class="required">*</span></label>
                                    <select class="select form-control" name="org_id" id="">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($org_data as $og_data )
                                        <option value="{{ $og_data->org_id }}">{{ $og_data->org_level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Employee Type<span class="required">*</span></label>
                                    <select class="select form-control" name="emp_type_id" id="">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($emp_type_data as $emp_data )
                                        <option value="{{ $emp_data->emp_type_id }}">{{ $emp_data->emp_type }}</option>
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
    <!-- /Add Post Modal -->

    <!-- Edit Post Modal -->
    <div id="edit_post" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-body">
                    <form action="{{ route('masters/postMaster/update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <input type="hidden" name="post_id" id="post_idd" value="">
                                <div class="form-group">
                                    <label>Post Name<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="post_title" id="post_title_edit" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Organisation Name<span class="required">*</span></label>
                                    <select class="select form-control" name="org_id" id="org_id_edit">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($org_data as $og_data )
                                        <option value="{{ $og_data->org_id }}">{{ $og_data->org_level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Employee Type<span class="required">*</span></label>
                                    <select class="select form-control" name="emp_type_id" id="emp_type_id_edit">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($emp_type_data as $emp_data )
                                        <option value="{{ $emp_data->emp_type_id }}">{{ $emp_data->emp_type }}</option>
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
    <!-- /Edit Post Modal -->
    <!-- Delete Allowance Modal -->
    <div class="modal custom-modal fade" id="delete_post" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Post</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('masters/postMaster/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" class="post_id" value="">
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
<!-- /Page Wrapper -->
@section('script')
{{-- update js --}}
<script>
    $(document).on('click', '.postUpdate', function() {
        var _this = $(this).parents('tr');
        $('#post_idd').val(_this.find('.post_id').text());
        $('#post_title_edit').val(_this.find('.post_title').text());
        $('#org_id_edit').val(_this.find('.org_id').select());
        $('#emp_type_id_edit').val(_this.find('.emp_type_id').select());
    });
</script>
{{-- delete model --}}
<script>
    $(document).on('click', '.postDelete', function() {
        var _this = $(this).parents('tr');
        $('.post_id').val(_this.find('.post_id').text());
    });
</script>
@endsection

@endsection