@extends('layouts.master')

@section('masters_noti')
noti-dot
@endsection

@section('block_active')
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
                    <h3 class="page-title">Block Master</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Tables</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_more_block"><i class="fa fa-plus"></i> Add More</a>
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
                                <th>Block Name</th>
                                <th>Block Code</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($block_datas as $block_data )
                            <tr>
                                <td class="block_name">{{ $block_data->block_name }}</td>
                                <td class="block_code">{{ $block_data->block_code }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item blockUpdate" data-toggle="modal" data-target="#edit_block"><i class=" fa fa-pencil m-r-5"></i> Edit</a>
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

    <!-- Add Block Modal -->
    <div id="add_more_block" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Block</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masters/blockMaster/add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Block Name<span class="required">*</span></label>
                                    <input class="form-control @error('block_name') is-invalid @enderror" type="text" id="" name="block_name" value="{{ old('block_name') }}" placeholder="Enter Block Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Block Code<span class="required">*</span></label>
                                    <input class="form-control @error('block_code') is-invalid @enderror" type="text" id="" name="block_code" value="{{ old('block_code') }}" placeholder="Enter Block Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State Name<span class="required">*</span></label>
                                    <select class="select form-control" name="state_idd" id="state_id">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($state_datas['sd'] as $state_data )
                                        <option value="{{ $state_data->state_id }}">{{ $state_data->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>District Name<span class="required">*</span></label>
                                    <select class="select form-control" name="district_id" id="district_id">
                                        <option selected disabled> --Select --</option>
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
    <!-- /Add Block Modal -->

    <!-- Edit Block Modal -->
    <div id="edit_block" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Block</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-body">
                    <form action="{{ route('masters/blockMaster/update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Block Name<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="block_name" id="block_name_edit" value="" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Block Code<span class="required">*</span></label>
                                <input class="form-control" type="text" name="block_code" id="block_code_edit" value="" />
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
    <!-- /Edit Block Modal -->


</div>
<!-- /Page Wrapper -->

@section('script')
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
    // This function is for Selecting state and according to state show all district name  

    $(document).ready(function() {

        // state Change
        $('#state_id').change(function() {

            // state id
            var st_id = $(this).val();

            // Empty the dropdown
            $('#district_id').find('option').not(':first').remove();

            // AJAX request 
            $.ajax({
                url: 'getDistrictLists/' + st_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {

                    var len = 0;
                    if (response['sd'] != null) {
                        len = response['sd'].length;
                    }

                    if (len > 0) {
                        // Read data and create <option >
                        for (var i = 0; i < len; i++) {

                            var district_id = response['sd'][i].district_id;
                            var district_name = response['sd'][i].district_name;

                            var option = "<option class='select' value='" + district_id + "'>" + district_name + "</option>";

                            $("#district_id").append(option);
                        }
                    }

                }
            });
        });
    });
</script>
@endsection

@endsection