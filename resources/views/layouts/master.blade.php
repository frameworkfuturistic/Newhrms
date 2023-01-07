<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="SoengSouy Admin Template">
	<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="SoengSouy Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Dashboard - HRMS</title>
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/logo.png') }}">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/jquery.dataTables.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/plugins/morris/morris.css') }}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
	<!-- icons css  -->
	<link rel="apple-touch-icon" sizes="60x60" href="admin_dash/app-assets/images/ico/apple-icon-60.png">
	<link rel="apple-touch-icon" sizes="76x76" href="admin_dash/app-assets/images/ico/apple-icon-76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="admin_dash/app-assets/images/ico/apple-icon-120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="admin_dash/app-assets/images/ico/apple-icon-152.png">
	<!-- datatable cdn -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<!--datatable css  -->
	<link rel="stylesheet" type="text/css" href="css/dataTables.min.css">
	<!-- font icons -->
	<link rel="stylesheet" type="text/css" href="admin_dash/app-assets/fonts/icomoon.css">
	<link rel="stylesheet" type="text/css" href="admin_dash/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
	<link rel="stylesheet" type="text/css" href="admin_dash/app-assets/vendors/css/extensions/pace.css">

	@yield('css_cdn')

	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
	<style>
		.invalid-feedback {
			font-size: 14px;
		}

		.iframe-container {
			padding-bottom: 60%;
			padding-top: 30px;
			height: 0;
			overflow: hidden;
		}

		.iframe-container iframe,
		.iframe-container object,
		.iframe-container embed {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
	</style>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">
			<!-- Logo -->
			<div class="header-left">
				<a href="{{ route('home') }}" class="logo">
					<img src="{{ URL::to('assets/img/logo.png') }}" width="40" height="40" alt="">
				</a>
				<span style="color:azure;  font-size: 25px; font-weight: 900;">HRMS</span>
			</div>
			<!-- /Logo -->
			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon"><span></span><span></span><span></span></span>
			</a>
			<!-- Header Title -->
			<div class="page-title-box">
				<h3>{{ Auth::user()->name }}</h3>
			</div>
			<!-- /Header Title -->
			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
			<!-- Header Menu -->
			<ul class="nav user-menu">
				<li class="nav-item dropdown">
					<div class="float-right mt-200">
						<a href="#" class="btn add-btn" data-toggle="modal" data-target="#view_levelwise"><i class="fa fa-eye"></i> View Levelwise</a>
					</div>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<form action="/change-levelwise-data" method="POST">
							@csrf
							<button type="submit" class="dropdown-item" name="level_type" value="1">All Level</button>
						</form>
					</div>
				</li>
				<!-- Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span> </a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="activities.html">
										<div class="media"> <span class="avatar">
												<img alt="images/default.png" src="{{ URL::to('assets/img/profiles/avatar-02.jpg') }}">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Amit Singh</span> added new task <span class="noti-title">Apply</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="activities.html">View all Notifications</a> </div>
					</div>
				</li>
				<!-- /Notifications -->
				<!-- Message Notifications -->
				<!-- <li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span> </a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header"> <span class="notification-title">Messages</span> <a href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left"> <span class="avatar">
													<img alt="images/default.png" src="{{ URL::to('assets/img/profiles/avatar-09.jpg') }}">
												</span> </div>
											<div class="list-body"> <span class="message-author">Rakesh Kumar </span> <span class="message-time">12:28 AM</span>
												<div class="clearfix"></div> <span class="message-content">Nothing Special</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="chat.html">View all Messages</a> </div>
					</div>
				</li> -->
				<!-- /Message Notifications -->
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
							<img src="{{ URL::to('/assets/employee_image/'. Auth::user()->avatar) }}" alt="images/default.png">
							<span class="status online"></span></span>
						<!-- <span>{{ Auth::user()->name }}</span> -->
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
						<a class="dropdown-item" href="{{ route('change/password') }}">Settings</a>
						<a class="dropdown-item" href="/logout">Logout</a>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->
			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
					<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
				</div>
			</div>
			<!-- /Mobile Menu -->
		</div>
		<!-- /Header -->
		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="menu-title"><span>Main</span></li>
						<li class="submenu">
							<a href="#" class="@yield('dashboard_dot_class')">
								<i class="la la-dashboard"></i>
								<span> Dashboard</span>
								<span class="menu-arrow"></span>
							</a>
							<ul style="display: none;">
								@if (Auth::user()->role_name=='Admin')
								<li><a class="@yield('dashboard_active')" href="{{ route('home') }}">Admin Dashboard</a></li>
								@endif
								@if (Auth::user()->role_name=='Employee')
								<li><a class="@yield('emp_dashboard_active')" href="{{ route('em/dashboard') }}">Employee Dashboard</a></li>
								@endif
							</ul>

						</li>
						@can('isAdmin')
						<li class="menu-title"> <span>Authentication</span> </li>
						<li class="submenu">
							<a href="#" class="@yield('emp_noti')">
								<i class="la la-user-secret"></i> <span>Employee Control</span> <span class="menu-arrow"></span>
							</a>
							<ul style="display: none;">
								<li><a class="@yield('all_user_active')" href="{{ route('userManagement') }}">All Employee</a></li>
								<li><a class="@yield('log_active')" href="{{ route('activity/log') }}">Activity Log</a></li>
								<li><a class="@yield('act_active')" href="{{ route('activity/login/logout') }}">Employee Activity</a></li>
							</ul>
						</li>
						@endcan
						<li class="menu-title">
							<span>Employees Section</span>
						</li>
						<li class="submenu">
							<a href="#" class="@yield('editemp_noti_dot')">
								<i class="la la-user"></i>
								<span> Employees</span>
								<span class="menu-arrow"></span>
							</a>
							<ul style="display: none;">
								<li><a class="@yield('add_user_active')" href="{{ route('userManagement/addUser') }}">Complete Profile</a></li>
								@can('isAdmin')
								<li><a class="@yield('holiday_active')" href="{{ route('form/holidays/new') }}">Holidays</a></li>
								@endcan
								<li><a class="@yield('take_att')" href="/take-attendance">Attendance</a></li>
								@can('isAdmin')
								<li><a class="@yield('att_ad')" href="{{ route('attendance/page') }}">Attendance (Admin)</a></li>
								@endcan
								@if (Auth::user()->role_name=='Employee')
								<li><a class="@yield('att_admin_active')" href="{{ route('attendance/employee/page') }}">Attendance (Employee)</a></li>
								@endif
							</ul>
						</li>
						<li class="submenu">
							<a href="#" class="@yield('editle_noti_dot')">
								<i class="la la-calendar" aria-hidden="true"></i>
								<span> Leave</span>
								<span class="menu-arrow"></span>
							</a>
							<ul style="display: none;">
								@can('isAdmin')
								<li><a class="@yield('leave_ad_active')" href="{{ route('form/leaves/new') }}">Leaves authority
										<span class="badge badge-pill bg-primary float-right">1</span></a>
								</li>
								@endcan
								<li><a class="@yield('leave_emp_active')" href="{{route('form/leavesemployee/new')}}">Apply Leaves</a></li>
								@can('isAdmin')
								<!-- <li><a class="@yield('leave_setting_active')" href="{{ route('form/leavesettings/page') }}">Leave Settings</a></li> -->
								@endcan
							</ul>
						</li>
						@can('isAdmin')
						<li class="menu-title"> <span>HR</span> </li>
						<li class="submenu"> <a href="#" class="@yield('pay_noti')"><i class="la la-money"></i>
								<span> Payroll </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="@yield('emp_sal_active')" href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
								<!-- <li><a class="@yield('pay_item_active')" href="{{ route('form/payroll/items') }}"> Payroll Items </a></li> -->
							</ul>
						</li>

						<li class="submenu"> <a href="#" class="@yield('report_noti')"><i class="la la-pie-chart"></i>
								<span> Reports </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<!-- <li><a class="@yield('ex_active')" href="{{ route('form/expense/reports/page') }}"> Expense Report </a></li> -->
								<!-- <li><a class="@yield('invoice_active')" href="{{ route('form/invoice/reports/page') }}"> Invoice Report </a></li> -->

								<li><a class="@yield('leave_active')" href="{{ route('form/leave/reports/page') }}"> Leave Report </a></li>
								<li><a class="@yield('daily_active')" href="{{ route('form/daily/reports/page') }}"> Daily Report </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#" class="@yield('masters_noti')"><i class="la la-table"></i>
								<span> Master Tables </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="@yield('allowance_active')" href="{{ route('masters/allowanceMaster') }}"> Allowance Master </a></li>
								<li><a class="@yield('designation_active')" href="{{ route('masters/designationMaster') }}"> Designation Master </a></li>
								<li><a class="@yield('state_active')" href="{{ route('masters/stateMaster') }}"> State Master </a></li>
								<li><a class="@yield('block_active')" href="{{ route('masters/blockMaster') }}"> Block Master </a></li>
								<li><a class="@yield('post_active')" href="{{ route('masters/postMaster') }}"> Post Master </a></li>
							</ul>
						</li>
						@endcan
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->
		<!-- /Sidebar -->
		<!-- Page Wrapper -->


		@yield('content')
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->


</body>
<!-- jQuery -->
<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
<!-- Bootstrap Core JS -->
<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ URL::to('assets/js/chart.js') }}"></script>
<!-- Slimscroll JS -->
<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
<!-- Select2 JS -->
<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
<!-- Datetimepicker JS -->
<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- Datatable JS -->
<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
<!-- <script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script> -->
<!-- Multiselect JS -->
<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ URL::to('assets/js/app.js') }}"></script>
@yield('script')

<script>
	$(document).ready(function() {
		$('#datatable').DataTable();
	});
</script>

</html>