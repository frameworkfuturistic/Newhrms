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

        <!-- Search Filter -->
        <form action="" method="POST">
            @csrf
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>State Name<span class="required">*</span></label>
                        <select class="select form-control" name="state_search" id="state_search">
                            <option selected disabled> --Select --</option>
                            @foreach ($state_datas['sd'] as $state_data )
                            <option value="{{ $state_data->state_id }}">{{ $state_data->state_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label>District Name<span class="required">*</span></label>
                        <select class="select form-control" name="district_search" id="district_search">
                            <option selected disabled> --Select --</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <label></label>
                    <button type="submit" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>
        <!-- /Search Filter -->
        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Block No.</th>
                                <th>Block Name</th>
                                <th>Block Code</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($block_datas as $block_data )
                            <tr>
                                <td class="block_id">{{ $block_data->block_id }}</td>
                                <td class="block_name">{{ $block_data->block_name }}</td>
                                <td class="block_code">{{ $block_data->block_code }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item blockUpdate" data-toggle="modal" data-id="'.$block_data->block_id.'" data-target="#edit_block"><i class=" fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item blockDelete" href="#" data-toggle="modal" data-target="#delete_block"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                                    <label>State Name<span class="required">*</span></label>
                                    <select class="select form-control" name="state_id" id="state_id">
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
                                <input type="hidden" name="block_id" id="block_id" value="">
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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State Name<span class="required">*</span></label>
                                    <select class="select form-control" name="state_id" id="state_id_edit">
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
                                    <select class="select form-control" name="district_id" id="district_id_edit">
                                        <option selected disabled> --Select --</option>
                                    </select>
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
    <!-- /Edit Block Modal -->
    <!-- Delete Block Modal -->
    <div class="modal custom-modal fade" id="delete_block" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Block</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('masters/blockMaster/delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="block_id" class="block_id" value="">
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
    <!-- /Delete Block Modal -->

</div>
<!-- /Page Wrapper -->

@section('script')
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type='text/javascript'>
    // This function for Selecting State and according to State show all District name  

    // State Change
    $('#state_search').change(function() {
        // State id
        var st_idd = $(this).val();
        var mUrl = "/searchDistrictLists/" + st_idd;

        $.ajax({
            url: mUrl,
            type: "GET",
            cache: false,
            contentType: "application/json;charset=utf-8",
            datatype: "json",
            success: function(result) {
                if (result == false) {
                    alert("District Not Found");
                } else {
                    $select = $("#district_search");
                    $select.find("option").remove();
                    $select.append(
                        $("<option>").html("-- Select District --")
                    );
                    Object.keys(result).forEach(function(key) {
                        $a = result[key].district_id;
                        $b = result[key].district_name;
                        $select.append(
                            "<option data-myid=" +
                            $b +
                            " value=" +
                            $a +
                            ">" +
                            $b +
                            "</option>"
                        );
                    });
                }
            },
        });

    });

    // This function is used to Selecting State and according to State show all District name in Add User Model.

    $('#state_id').change(function() {
        // State id
        var st_idd = $(this).val();
        var mUrl = "/getDistrictLists/" + st_idd;

        $.ajax({
            url: mUrl,
            type: "GET",
            cache: false,
            contentType: "application/json;charset=utf-8",
            datatype: "json",
            success: function(result) {
                if (result == false) {
                    alert("District Not Found");
                } else {
                    $select = $("#district_id");
                    $select.find("option").remove();
                    $select.append(
                        $("<option>").html("-- Select District --")
                    );
                    Object.keys(result).forEach(function(key) {
                        $a = result[key].district_id;
                        $b = result[key].district_name;
                        $select.append(
                            "<option data-myid=" +
                            $b +
                            " value=" +
                            $a +
                            ">" +
                            $b +
                            "</option>"
                        );
                    });
                }
            },
        });

    });

    // This function is used to Selecting State and according to State show all District name in Edit User Model.

    $('#state_id_edit').change(function() {
        // State id
        var st_idd = $(this).val();
        var mUrl = "/editDistrictLists/" + st_idd;

        $.ajax({
            url: mUrl,
            type: "GET",
            cache: false,
            contentType: "application/json;charset=utf-8",
            datatype: "json",
            success: function(result) {
                if (result == false) {
                    alert("District Not Found");
                } else {
                    $select = $("#district_id_edit");
                    $select.find("option").remove();
                    $select.append(
                        $("<option>").html("-- Select District --")
                    );
                    Object.keys(result).forEach(function(key) {
                        $a = result[key].district_id;
                        $b = result[key].district_name;
                        $select.append(
                            "<option data-myid=" +
                            $b +
                            " value=" +
                            $a +
                            ">" +
                            $b +
                            "</option>"
                        );
                    });
                }
            },
        });

    });
</script>

{{-- update js --}}
<script>
    $(document).on('click', '.blockUpdate', function() {
        var _this = $(this).parents('tr');
        $('#block_id').val(_this.find('.block_id').text());
        $('#block_name_edit').val(_this.find('.block_name').text());
        $('#block_code_edit').val(_this.find('.block_code').text());
        $('#state_id_edit').val(_this.find('.state_id').text());
        $('#district_id_edit').val(_this.find('.district_id').text());
    });
</script>
{{-- delete model --}}
<script>
    $(document).on('click', '.blockDelete', function() {
        var _this = $(this).parents('tr');
        $('.block_id').val(_this.find('.block_id').text());
    });
</script>



@endsection

@endsection