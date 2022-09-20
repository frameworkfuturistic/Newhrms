@extends('layouts.master')

@section('css_cdn')
<style>
    /* Calender Style */

    @media print {

        *,
        *::before,
        *::after {
            text-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }

        a:not(.btn) {
            text-decoration: underline;
        }

        abbr[title]::after {
            content: " ("attr(title) ")";
        }

        pre {
            white-space: pre-wrap !important;
        }

        pre,
        blockquote {
            border: 1px solid #adb5bd;
            page-break-inside: avoid;
        }

        thead {
            display: table-header-group;
        }

        tr,
        img {
            page-break-inside: avoid;
        }

        p,
        h2,
        h3 {
            orphans: 3;
            widows: 3;
        }

        h2,
        h3 {
            page-break-after: avoid;
        }

        @page {
            size: a3;
        }

        body {
            min-width: 992px !important;
        }

        .container {
            min-width: 992px !important;
        }

        .navbar {
            display: none;
        }

        .badge {
            border: 1px solid #000;
        }

        .table {
            border-collapse: collapse !important;
        }

        .table td,
        .table th {
            background-color: #fff !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6 !important;
        }

        .table-dark {
            color: inherit;
        }

        .table-dark th,
        .table-dark td,
        .table-dark thead th,
        .table-dark tbody+tbody {
            border-color: #dee2e6;
        }

        .table .thead-dark th {
            color: inherit;
            border-color: #dee2e6;
        }
    }

    body {}

    a {
        -webkit-transition: 0.3s all ease;
        -o-transition: 0.3s all ease;
        transition: 0.3s all ease;
        color: #39cb75;
    }

    a:hover,
    a:focus {
        text-decoration: none !important;
        outline: none !important;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    .h1,
    .h2,
    .h3,
    .h4,
    .h5 {
        line-height: 1.5;
        font-weight: 400;
        font-family: "Lato", Arial, sans-serif;
        color: #000;
    }

    .bg-primary {
        background: #39cb75 !important;
    }

    .ftco-section {
        padding: 7em 0;
    }

    .ftco-no-pt {
        padding-top: 0;
    }

    .ftco-no-pb {
        padding-bottom: 0;
    }

    .heading-section {
        font-size: 28px;
        color: #000;
    }

    .img {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .elegant-calencar {
        max-width: 700px;
        text-align: center;
        position: relative;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 5px;
        -webkit-box-shadow: 0px 19px 27px -20px rgba(0, 0, 0, 0.16);
        -moz-box-shadow: 0px 19px 27px -20px rgba(0, 0, 0, 0.16);
        box-shadow: 0px 19px 27px -20px rgba(0, 0, 0, 0.16);
    }

    .wrap-header {
        position: relative;
        width: 45%;
        background: #39cb75;
    }

    @media (max-width: 767.98px) {
        .wrap-header {
            width: 100%;
            padding: 20px 0;
        }
    }

    #header {
        width: 100%;
        position: relative;
    }

    #header .pre-button,
    #header .next-button {
        cursor: pointer;
        width: 1em;
        height: 1em;
        line-height: 1em;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size: 18px;
    }

    #header .pre-button i,
    #header .next-button i {
        color: #fff;
    }

    .pre-button {
        left: 5px;
    }

    .next-button {
        right: 5px;
    }

    .head-day {
        font-size: 8em;
        line-height: 1;
        color: #fff;
    }

    .head-month {
        font-size: 2em;
        line-height: 1;
        color: #fff;
        font-size: 18px;
        text-transform: uppercase;
    }

    .calendar-wrap {
        width: 100%;
        background: #fff;
        padding: 40px 20px 20px 20px;
    }

    #calendar {
        width: 100%;
    }

    #calendar tr {
        height: 3em;
    }

    thead tr {
        color: #000;
        font-weight: 700;
    }

    tbody tr {
        color: #000;
    }

    tbody td {
        width: 14%;
        border-radius: 50%;
        cursor: pointer;
        -webkit-transition: all 0.2s ease-in;
        -o-transition: all 0.2s ease-in;
        transition: all 0.2s ease-in;
        position: relative;
        z-index: 0;
    }

    tbody td:after {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        bottom: 0;
        content: "";
        width: 44px;
        height: 44px;
        margin: 0 auto;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        border-radius: 50%;
        -webkit-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
        z-index: -1;
    }

    @media (prefers-reduced-motion: reduce) {
        tbody td:after {
            -webkit-transition: none;
            -o-transition: none;
            transition: none;
        }
    }

    tbody td:hover,
    .selected {
        color: #fff;
        border: none;
    }

    tbody td:hover:after,
    .selected:after {
        background: #2a3246;
    }

    tbody td:active {
        -webkit-transform: scale(0.7);
        -ms-transform: scale(0.7);
        transform: scale(0.7);
    }

    #today {
        color: #fff;
    }

    #today:after {
        background: #39cb75;
    }

    #disabled {
        cursor: default;
        background: #fff;
    }

    #disabled:hover {
        background: #fff;
        color: #c9c9c9;
    }

    #disabled:hover:after {
        background: transparent;
    }

    #reset {
        display: block;
        position: absolute;
        right: 0.5em;
        top: 0.5em;
        z-index: 999;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        padding: 0 0.5em;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 4px;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 11px;
    }

    #reset:hover {
        color: #fff;
        border-color: #fff;
    }

    #reset:active {
        -webkit-transform: scale(0.8);
        -ms-transform: scale(0.8);
        transform: scale(0.8);
    }
</style>
@endsection

@section('editemp_noti_dot')
noti-dot
@endsection

@section('take_att')
active
@endsection


@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-plus"></i> Take Attendance</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="elegant-calencar d-md-flex">
                                <div class="wrap-header d-flex align-items-center">
                                    <p id="reset">reset</p>
                                    <div id="header" class="p-0">
                                        <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                                        <div class="head-info">
                                            <div class="head-day"></div>
                                            <div class="head-month"></div>
                                        </div>
                                        <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="calendar-wrap">
                                    <table id="calendar">
                                        <thead>
                                            <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
    use Carbon\Carbon;
    $today_date = Carbon::today()->format('d-m-y');
    @endphp

    <!-- Attendance Modal -->
    <div class="modal custom-modal fade" id="attendance_info" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card punch-status">
                                <div class="card-body">
                                    <h5 class="card-title">Timesheet <small class="text-muted">{{ $today_date }}</small></h5>
                                    <div class="punch-det">
                                        <h6>Punch In at</h6>
                                        <p>Wed, 11th Mar 2019 10.00 AM</p>
                                    </div>
                                    <div class="punch-info">
                                        <div class="punch-hours">
                                            <span id="clock">123</span>
                                        </div>
                                    </div>
                                    <div class="punch-det">
                                        <h6>Punch Out at</h6>
                                        <p>Wed, 20th Feb 2019 9.00 PM</p>
                                    </div>
                                    <div class="statistics">
                                        <div class="row">
                                            <div class="col-md-6 col-6 text-center">
                                                <button type="submit" style="min-width: 160px;" class="btn btn-primary submit-btn">Save</button>
                                            </div>
                                            <div class="col-md-6 col-6 text-center">
                                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card recent-activity">
                                <div class="card-body">
                                    <h5 class="card-title">Employees</h5>
                                    <ul class="res-activity-list">
                                        <li>
                                            <p class="mb-0">Punch In at</p>
                                            <p class="res-activity-time">
                                                <i class="fa fa-clock-o"></i>
                                                10.00 AM.
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Attendance Modal -->
</div>
@endsection

@section('script')
<script src="js/main.js"></script>

<script>
    // Attendance Frontend Scripts


    setInterval(displayclock, 500);

    function displayclock() {
        var time = new Date();
        var hrs = time.getHours();
        var min = time.getMinutes();
        var sec = time.getSeconds();
        var en = 'AM';
        if (hrs > 12) {
            en = 'PM';
        }
        if (hrs > 12) {
            hrs = hrs - 12;
        }
        if (hrs == 0) {
            hrs = 12;
        }
        if (hrs < 10) {
            hrs = '0' + hrs;
        }
        if (min < 10) {
            min = '0' + min;
        }
        if (sec < 10) {
            sec = '0' + sec;
        }
        document.getElementById("clock").innerHTML = hrs + ':' + min + ':' + sec + ' ' + en;
    }
</script>
@endsection