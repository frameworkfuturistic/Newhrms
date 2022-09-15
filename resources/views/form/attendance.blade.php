@extends('layouts.master')
@section('editemp_noti_dot')
noti-dot
@endsection

@section('att_ad')
active
@endsection


@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating">
                    <label class="focus-label">Employee Name</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option>-</option>
                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sep</option>
                        <option>Oct</option>
                        <option>Nov</option>
                        <option>Dec</option>
                    </select>
                    <label class="focus-label">Select Month</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option>-</option>
                        <option>2019</option>
                        <option>2018</option>
                        <option>2017</option>
                        <option>2016</option>
                        <option>2015</option>
                    </select>
                    <label class="focus-label">Select Year</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <!-- /Search Filter -->

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                                <th>16</th>
                                <th>17</th>
                                <th>18</th>
                                <th>19</th>
                                <th>20</th>
                                <th>22</th>
                                <th>23</th>
                                <th>24</th>
                                <th>25</th>
                                <th>26</th>
                                <th>27</th>
                                <th>28</th>
                                <th>29</th>
                                <th>30</th>
                                <th>31</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar avatar-xs" href="profile.html"><img alt="" src="{{ URL::to('assets/img/profiles/avatar-09.png') }}"></a>
                                        <a href="profile.html">Ajay Singh</a>
                                    </h2>
                                </td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td>
                                    <div class="half-day">
                                        <span class="first-off"><i class="fa fa-check text-success"></i></span>
                                        <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                                    </div>
                                </td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-close text-danger"></i> </td>
                                <td><i class="fa fa-close text-danger"></i> </td>
                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td>
                                    <div class="half-day">
                                        <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                                        <span class="first-off"><i class="fa fa-check text-success"></i></span>
                                    </div>
                                </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                            </tr>
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar avatar-xs" href="profile.html"><img alt="" src="{{ URL::to('assets/img/profiles/avatar-09.png') }}"></a>
                                        <a href="profile.html">Rohit Kumar</a>
                                    </h2>
                                </td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>recycle
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td><i class="fa fa-close text-danger"></i> </td>
                                <td><i class="fa fa-close text-danger"></i> </td>
                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                                <td><i class="fa fa-close text-danger"></i> </td>

                                <td><i class="fa fa-check text-success"></i></td>
                                <td><i class="fa fa-check text-success"></i></td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->


</div>
<!-- Page Wrapper -->
@endsection