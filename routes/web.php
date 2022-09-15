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

// Route::get('php-info', function () {
//     return phpinfo();
// });

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
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

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
    Route::post('profile/information/save', 'profileInformation')->name('profile/information/save');

    // ----------------------------- user userManagement -----------------------//
    Route::get('userManagement', 'index')->middleware('auth')->name('userManagement');
    Route::get('/getOfficeLists/{org_idd}', 'getOfficeLists');
    Route::get('/getPosts/{org_idd}', 'getPost');
    Route::get('/getDesignations/{po_id}', 'getDesignation');
    Route::get('userManagement/add-user', 'addUserForm')->middleware('auth')->name('userManagement/addUser');

    Route::post('userManagement/user-profile/save', 'saveProfileData')->middleware('auth');
    Route::get('/officeLists/{org_idd}', 'officeList');
    Route::post('user/add/save', 'addNewUserSave')->name('user/add/save');
    Route::post('search/user/list', 'searchUser')->name('search/user/list');
    Route::post('update', 'update')->name('update');
    Route::post('user/delete', 'delete')->middleware('auth')->name('user/delete');
    Route::get('activity/log', 'activityLog')->middleware('auth')->name('activity/log');
    Route::get('activity/login/logout', 'activityLogInLogOut')->middleware('auth')->name('activity/login/logout');

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
    Route::get('form/holidays/new', 'holiday')->middleware('auth')->name('form/holidays/new');
    Route::post('form/holidays/save', 'saveRecord')->middleware('auth')->name('form/holidays/save');
    Route::post('form/holidays/update', 'updateRecord')->middleware('auth')->name('form/holidays/update');
});

// ----------------------------- form leaves ------------------------------//


Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leaves/new', 'leaves')->middleware('auth')->name('form/leaves/new');
    Route::get('form/leavesemployee/new', 'leavesEmployee')->middleware('auth')->name('form/leavesemployee/new');
    Route::post('form/leaves/save', 'saveRecord')->middleware('auth')->name('form/leaves/save');
    Route::post('form/leaves/edit', 'editRecordLeave')->middleware('auth')->name('form/leaves/edit');
    Route::post('form/leaves/edit/delete', 'deleteLeave')->middleware('auth')->name('form/leaves/edit/delete');
});

// ----------------------------- form attendance  ------------------------------//

Route::controller(LeavesController::class)->group(function () {
    Route::get('form/leavesettings/page', 'leaveSettings')->middleware('auth')->name('form/leavesettings/page');
    Route::get('attendance/page', 'attendanceIndex')->middleware('auth')->name('attendance/page');
    Route::get('attendance/employee/page', 'AttendanceEmployee')->middleware('auth')->name('attendance/employee/page');
});


// ----------------------------- form payroll  ------------------------------//

Route::controller(PayrollController::class)->group(function () {
    Route::get('form/salary/page', 'salary')->middleware('auth')->name('form/salary/page');
    Route::post('form/salary/save', 'saveRecord')->middleware('auth')->name('form/salary/save');
    Route::post('form/salary/update', 'updateRecord')->middleware('auth')->name('form/salary/update');
    Route::post('form/salary/delete', 'deleteRecord')->middleware('auth')->name('form/salary/delete');
    Route::get('form/salary/view/{rec_id}', 'salaryView')->middleware('auth');
    Route::get('form/payroll/items', 'payrollItems')->middleware('auth')->name('form/payroll/items');
});

// ----------------------------- reports  ------------------------------//


Route::controller(ExpenseReportsController::class)->group(function () {
    Route::get('form/expense/reports/page', 'index')->middleware('auth')->name('form/expense/reports/page');
    Route::get('form/invoice/reports/page', 'invoiceReports')->middleware('auth')->name('form/invoice/reports/page');
    Route::get('form/daily/reports/page', 'dailyReport')->middleware('auth')->name('form/daily/reports/page');
    Route::get('form/leave/reports/page', 'leaveReport')->middleware('auth')->name('form/leave/reports/page');
});


// -----------------------------Allowance master tables  ------------------------------//


Route::controller(AllowanceMaster::class)->group(function () {
    Route::get('masters/allowanceMaster', 'allowanceMasterFunc')->middleware('auth')->name('masters/allowanceMaster');
    Route::post('masters/allowanceMaster/add', 'addAllowanceMaster')->middleware('auth')->name('masters/allowanceMaster/add');
    Route::post('masters/allowanceMaster/update', 'updateAllowanceMaster')->middleware('auth')->name('masters/allowanceMaster/update');
    Route::post('masters/allowanceMaster/delete', 'deleteAllowanceMaster')->middleware('auth')->name('masters/allowanceMaster/delete');
});

// -----------------------------Designation master tables  ------------------------------//


Route::controller(DesignationMaster::class)->group(function () {
    Route::get('masters/designationMaster', 'DesignationMasterFunc')->middleware('auth')->name('masters/designationMaster');
    Route::post('masters/designationMaster/add', 'addDesignationMaster')->middleware('auth')->name('masters/designationMaster/add');
    Route::post('masters/designationMaster/update', 'updateDesignationMaster')->middleware('auth')->name('masters/designationMaster/update');
    Route::post('masters/designationMaster/delete', 'deleteDesignationMaster')->middleware('auth')->name('masters/designationMaster/delete');
});

// -----------------------------State master tables  ------------------------------//

Route::controller(StateController::class)->group(function () {
    Route::get('masters/stateMaster', 'stateMasterFunc')->middleware('auth')->name('masters/stateMaster');
    Route::post('masters/stateMaster/add', 'addStateMaster')->middleware('auth')->name('masters/stateMaster/add');
    Route::post('masters/stateMaster/update', 'updateStateMaster')->middleware('auth')->name('masters/stateMaster/update');
    Route::post('masters/stateMaster/delete', 'deleteStateMaster')->middleware('auth')->name('masters/stateMaster/delete');
});

// -----------------------------Block master tables  ------------------------------//

Route::controller(BlockController::class)->group(function () {
    Route::get('masters/blockMaster', 'blockMasterFunc')->middleware('auth')->name('masters/blockMaster');
    Route::get('/searchDistrictLists/{st_idd}', 'searchDistrictList')->middleware('auth');
    Route::get('/getDistrictLists/{st_idd}', 'getDistrictList')->middleware('auth');
    Route::post('masters/blockMaster/add', 'addBlockMaster')->middleware('auth')->name('masters/blockMaster/add');
    Route::get('/editDistrictLists/{st_idd}', 'editDistrictList')->middleware('auth');
    Route::post('masters/blockMaster/update', 'updateBlockMaster')->middleware('auth')->name('masters/blockMaster/update');
    Route::post('masters/blockMaster/delete', 'deleteBlockMaster')->middleware('auth')->name('masters/blockMaster/delete');
});

// -----------------------------Post master tables  ------------------------------//

Route::controller(PostController::class)->group(function () {
    Route::get('/masters/postMaster', 'postMasterFunc')->middleware('auth')->name('masters/postMaster');
    Route::post('/masters/postMaster/add', 'addPostMaster')->middleware('auth')->name('masters/postMaster/add');
    Route::post('/masters/postMaster/update', 'updatePostMaster')->middleware('auth')->name('masters/postMaster/update');
    Route::post('/masters/postMaster/delete', 'deletePostMaster')->middleware('auth')->name('masters/postMaster/delete');
});
