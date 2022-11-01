<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ExpenseReportsController;
use App\Http\Controllers\PerformanceController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AllowanceMaster;
use App\Http\Controllers\DesignationMaster;
use App\Http\Controllers\StateController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('php-info', function () {
    return phpinfo();
});

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    // return 'Hii';
    Route::get('home', function () {
        $category = auth()->user()->role_name;
        if ($category == 'Employee') {
            return view('dashboard.emdashboard');
        } elseif ($category == 'Admin') {
            return view('dashboard.dashboard');
        }
    })->name('home');
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::get('em/dashboard', [App\Http\Controllers\HomeController::class, 'emDashboard'])->name('em/dashboard');

// -----------------------------settings----------------------------------------//

Route::get('roles/permissions/page', [App\Http\Controllers\SettingController::class, 'rolesPermissions'])->middleware('auth')->name('roles/permissions/page');
Route::post('roles/permissions/save', [App\Http\Controllers\SettingController::class, 'addRecord'])->middleware('auth')->name('roles/permissions/save');
Route::post('roles/permissions/update', [App\Http\Controllers\SettingController::class, 'editRolesPermissions'])->middleware('auth')->name('roles/permissions/update');
Route::post('roles/permissions/delete', [App\Http\Controllers\SettingController::class, 'deleteRolesPermissions'])->middleware('auth')->name('roles/permissions/delete');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

// ----------------------------- lock screen --------------------------------//
Route::get('lock_screen', [App\Http\Controllers\LockScreen::class, 'lockScreen'])->middleware('auth')->name('lock_screen');
Route::post('unlock', [App\Http\Controllers\LockScreen::class, 'unlock'])->name('unlock');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('registerData');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-passwordd', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-passwordd');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);



Route::controller(UserManagementController::class)->group(function () {

    // ----------------------------- user profile ------------------------------//
    Route::get('profile_user', 'profile')->middleware('auth')->name('profile_user');
    Route::post('profile/change-pic', 'changeProfilePic');
    Route::post('profile/information/save', 'profileInformation')->name('profile/information/save');

    // ----------------------------- user userManagement -----------------------//
    Route::get('userManagement', 'index')->middleware('can:isAdmin')->name('userManagement');
    Route::get('/getOfficeLists/{org_idd}', 'getOfficeLists');
    Route::get('/getUserDesigns/{ur_id}', 'getDesignationName');
    Route::get('/getPosts/{org_idd}', 'getPost');
    Route::get('/getDesignations/{po_id}', 'getDesignation');
    Route::get('userManagement/add-user', 'addUserForm')->middleware('auth')->name('userManagement/addUser');

    Route::post('userManagement/user-profile/save', 'saveProfileData')->middleware('auth');
    Route::get('/officeLists/{org_idd}', 'officeList');
    Route::post('user/add/save', 'addNewUserSave')->name('user/add/save');
    Route::post('search/user/list', 'searchUser')->name('search/user/list');
    Route::post('update', 'update')->name('update');
    Route::post('user/delete', 'delete')->middleware('auth')->name('user/delete');
    Route::get('activity/log', 'activityLog')->middleware('can:isAdmin')->name('activity/log');
    Route::get('activity/login/logout', 'activityLogInLogOut')->middleware('can:isAdmin')->name('activity/login/logout');
    Route::post('userManagement/status', 'updateStatus')->middleware('auth');

    // ----------------------------- search user management ------------------------------//
    Route::post('search/user/list', 'searchUser')->name('search/user/list');

    // ----------------------------- form change password ------------------------------//
    Route::get('change/password', 'changePasswordView')->middleware('auth')->name('change/password');
    Route::post('change/password/db', 'changePasswordDB')->name('change/password/db');
});


Route::controller(EmployeeController::class)->group(function () {

    // ----------------------------- form employee ------------------------------//
    Route::get('all/employee/view/edit/{employee_id}', 'viewRecord')->middleware('auth');
    Route::post('all/employee/update', 'updateRecord')->middleware('auth')->name('all/employee/update');
    Route::get('all/employee/delete/{employee_id}', 'deleteRecord')->middleware('auth');
    Route::post('all/employee/search', 'employeeSearch')->middleware('auth')->name('all/employee/search');

    // ----------------------------- profile employee ------------------------------//
    Route::get('employee/profile/{rec_id}', 'profileEmployee')->middleware('auth');
});


// ----------------------------- form holiday ------------------------------//


Route::controller(HolidayController::class)->group(function () {
    Route::get('form/holidays/new', 'holiday')->middleware('can:isAdmin')->name('form/holidays/new');
    Route::post('form/holidays/save', 'saveRecord')->middleware('auth')->name('form/holidays/save');
    Route::post('form/holidays/update', 'updateRecord')->middleware('auth')->name('form/holidays/update');
    Route::post('form/holidays/delete', 'deleteRecord')->middleware('auth');
});

// ----------------------------- form leaves ------------------------------//


Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leaves/new', 'leaves')->middleware('can:isAdmin')->name('form/leaves/new');
    Route::get('form/leavesemployee/new', 'leavesEmployee')->middleware('auth')->name('form/leavesemployee/new');
    Route::post('form/leaves/save', 'saveRecord')->middleware('auth')->name('form/leaves/save');
    Route::post('form/leaves/edit', 'editRecordLeave')->middleware('auth')->name('form/leaves/edit');
    Route::post('form/leaves/edit/delete', 'deleteLeave')->middleware('auth')->name('form/leaves/edit/delete');
    Route::post('form/leaves/apply-leave', 'saveRecord')->middleware('auth');
    Route::post('form/leaves/status', 'updateStatus')->middleware('auth');
});

// ----------------------------- form attendance  ------------------------------//

Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leavesettings/page', 'leaveSettings')->middleware('can:isAdmin')->name('form/leavesettings/page');
    Route::get('attendance/page', 'attendanceIndex')->middleware('can:isAdmin')->name('attendance/page');
    Route::get('/search-attendance-data', 'attendanceRecordSearch')->middleware('auth');
    Route::get('attendance/employee/page', 'AttendanceEmployee')->middleware('auth')->name('attendance/employee/page');
    Route::get('take-attendance', 'showAttendance')->middleware('auth');
    Route::post('/insert-attendance-detail', 'insertAttendDetail')->middleware('auth');
});


// ----------------------------- form payroll  ------------------------------//

Route::controller(PayrollController::class)->group(function () {
    Route::get('form/salary/page', 'salary')->middleware('can:isAdmin')->name('form/salary/page');
    Route::post('form/salary/save', 'saveRecord')->middleware('auth')->name('form/salary/save');
    Route::post('form/salary/update', 'updateRecord')->middleware('auth')->name('form/salary/update');
    Route::post('form/salary/delete', 'deleteRecord')->middleware('auth')->name('form/salary/delete');
    Route::get('form/salary/view/{rec_id}', 'salaryView')->middleware('auth');
    Route::get('form/payroll/items', 'payrollItems')->middleware('can:isAdmin')->name('form/payroll/items');
});

// ----------------------------- reports  ------------------------------//


Route::controller(ExpenseReportsController::class)->group(function () {
    Route::get('form/expense/reports/page', 'index')->middleware('can:isAdmin')->name('form/expense/reports/page');
    Route::get('form/invoice/reports/page', 'invoiceReports')->middleware('can:isAdmin')->name('form/invoice/reports/page');
    Route::get('form/daily/reports/page', 'dailyReport')->middleware('can:isAdmin')->name('form/daily/reports/page');
    Route::get('form/leave/reports/page', 'leaveReport')->middleware('can:isAdmin')->name('form/leave/reports/page');
});


// -----------------------------Allowance master tables  ------------------------------//


Route::controller(AllowanceMaster::class)->group(function () {
    Route::get('masters/allowanceMaster', 'allowanceMasterFunc')->middleware('can:isAdmin')->name('masters/allowanceMaster');
    Route::post('masters/allowanceMaster/add', 'addAllowanceMaster')->middleware('can:isAdmin')->name('masters/allowanceMaster/add');
    Route::post('masters/allowanceMaster/update', 'updateAllowanceMaster')->middleware('can:isAdmin')->name('masters/allowanceMaster/update');
    Route::post('masters/allowanceMaster/delete', 'deleteAllowanceMaster')->middleware('can:isAdmin')->name('masters/allowanceMaster/delete');
});

// -----------------------------Designation master tables  ------------------------------//


Route::controller(DesignationMaster::class)->group(function () {
    Route::get('masters/designationMaster', 'DesignationMasterFunc')->middleware('can:isAdmin')->name('masters/designationMaster');
    Route::post('masters/designationMaster/add', 'addDesignationMaster')->middleware('can:isAdmin')->name('masters/designationMaster/add');
    Route::post('masters/designationMaster/update', 'updateDesignationMaster')->middleware('can:isAdmin')->name('masters/designationMaster/update');
    Route::post('masters/designationMaster/delete', 'deleteDesignationMaster')->middleware('can:isAdmin')->name('masters/designationMaster/delete');
});

// -----------------------------State master tables  ------------------------------//

Route::controller(StateController::class)->group(function () {
    Route::get('masters/stateMaster', 'stateMasterFunc')->middleware('can:isAdmin')->name('masters/stateMaster');
    Route::post('masters/stateMaster/add', 'addStateMaster')->middleware('can:isAdmin')->name('masters/stateMaster/add');
    Route::post('masters/stateMaster/update', 'updateStateMaster')->middleware('can:isAdmin')->name('masters/stateMaster/update');
    Route::post('masters/stateMaster/delete', 'deleteStateMaster')->middleware('can:isAdmin')->name('masters/stateMaster/delete');
});

// -----------------------------Block master tables  ------------------------------//

Route::controller(BlockController::class)->group(function () {
    Route::get('masters/blockMaster', 'blockMasterFunc')->middleware('can:isAdmin')->name('masters/blockMaster');
    Route::get('/searchDistrictLists/{st_idd}', 'searchDistrictList')->middleware('can:isAdmin');
    Route::get('/getDistrictLists/{st_idd}', 'getDistrictList')->middleware('can:isAdmin');
    Route::post('masters/blockMaster/add', 'addBlockMaster')->middleware('can:isAdmin')->name('masters/blockMaster/add');
    Route::get('/editDistrictLists/{st_idd}', 'editDistrictList')->middleware('can:isAdmin');
    Route::post('masters/blockMaster/update', 'updateBlockMaster')->middleware('can:isAdmin')->name('masters/blockMaster/update');
    Route::post('masters/blockMaster/delete', 'deleteBlockMaster')->middleware('can:isAdmin')->name('masters/blockMaster/delete');
});

// -----------------------------Post master tables  ------------------------------//

Route::controller(PostController::class)->group(function () {
    Route::get('/masters/postMaster', 'postMasterFunc')->middleware('can:isAdmin')->name('masters/postMaster');
    Route::post('/masters/postMaster/add', 'addPostMaster')->middleware('can:isAdmin')->name('masters/postMaster/add');
    Route::post('/masters/postMaster/update', 'updatePostMaster')->middleware('can:isAdmin')->name('masters/postMaster/update');
    Route::post('/masters/postMaster/delete', 'deletePostMaster')->middleware('can:isAdmin')->name('masters/postMaster/delete');
});
