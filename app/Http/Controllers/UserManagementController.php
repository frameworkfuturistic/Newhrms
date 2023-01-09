<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProfile;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Employee;
use App\Models\Form;
use App\Models\ProfileInformation;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailService;
use App\Models\Master_organisation;
use App\Models\MasterAttendanceType;
use App\Models\MasterDesignation;
use App\Models\MasterEmployeeType;
use App\Models\MasterOfficeList;
use App\Models\MasterPost;
use App\Models\MasterStates;
use App\Models\PersonalInformation;
use App\Models\Users\FamilyInfo;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    public function view()
    {
        return view('usermanagement.profile_user');
    }
    public function index()
    {

        if (Auth::user()->role_name == 'Admin') {
            $masterOrganisation = new Master_organisation();
            $mEmployeeTypes = new MasterEmployeeType();
            $result      = DB::table('users as u')
                ->select(
                    'u.*',
                    'mp.post_title',
                    'o.org_level'
                )
                ->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')
                ->leftJoin('master_organisations as o', 'o.org_id', '=', 'u.org_id')
                ->get();

            $role_name   = DB::table('role_type_users')->get();
            $position    = DB::table('position_types')->get();
            $department  = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            $employee_types = $mEmployeeTypes->getAllEmployeeTypes();
            $post = DB::table('master_posts')->get();
            $attendance_type = DB::table('master_attendance_types')->get();

            $organisation['data'] = $masterOrganisation->show();

            $post['pd'] = MasterPost::orderby("org_id", "asc")
                ->select('org_id', 'post_title')
                ->get();

            $designation['de'] = MasterDesignation::orderby("designation_id", "asc")
                ->select(
                    'designation_id',
                    'designation_code',
                    'post_id'
                )
                ->get();

            return view('usermanagement.user_control', compact(
                'result',
                'role_name',
                'position',
                'department',
                'status_user',
                'organisation',
                'employee_types',
                'designation',
                'post',
                'attendance_type'
            ));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * | Get Office Lists
     */
    public function getOfficeLists($org_idd = 0)
    {
        // Fetch office name by organisation level
        $officeListData['data'] = MasterOfficeList::orderby("office_id", "asc")
            ->select('office_id', 'office_name')
            ->where('org_id', $org_idd)
            ->get();

        return response()->json($officeListData);
    }

    // Fetch post list through Ajax
    public function getPost($org_idd = 0)
    {

        // Fetch post title by organisation level
        $postData['pd'] = MasterPost::orderby("post_id", "asc")
            ->select('post_id', 'post_title')
            ->where('org_id', $org_idd)
            ->get();

        return response()->json($postData);
    }

    // Fetch designation code through Ajax
    public function getDesignation($po_id = 0)
    {

        // Fetch post title by organisation level
        $postData['de'] = MasterDesignation::orderby("designation_id", "asc")
            ->select('designation_id', 'designation_code')
            ->where('post_id', $po_id)
            ->get();

        return response()->json($postData);
    }

    //add user
    public function addUserForm()
    {
        $state['data'] = MasterStates::orderby("state_id", "asc")->select('state_id', 'state_name')->get();
        $personal_info = PersonalInformation::where("user_id", Auth::user()->id)->first();
        $familyInfos = FamilyInfo::where('user_id', Auth::user()->id)
            ->get();
        return view('usermanagement.add_user', compact('state', 'personal_info', 'familyInfos'));
    }

    public function saveProfileData(SaveProfile $request)
    {
        DB::beginTransaction();
        try {
            $personalInfo = new PersonalInformation();
            $familyInfo = new FamilyInfo();
            $personalInfo->edit($request);
            $familyInfo->edit($request);
            DB::commit();
            return back()->with(Toastr::success('Profile Information Saved successfully :)', 'Success'));
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Profile Information fail :)', 'Error');
            return redirect()->back();
        }
    }

    // Fetch office list through Ajax for add-user page
    public function officeList($org_idd = 0)
    {
        $orgData['data'] = MasterOfficeList::orderby("office_id", "asc")
            ->select('office_id', 'office_name')
            ->where('org_id', $org_idd)
            ->get();

        return response()->json($orgData);
    }

    // use activity log
    public function activityLog()
    {
        $activityLog = DB::table('user_activity_logs')->get();
        return view('usermanagement.user_activity_log', compact('activityLog'));
    }
    // activity log
    public function activityLogInLogOut()
    {
        $activityLog = DB::table('activity_logs')->get();
        return view('usermanagement.activity_log', compact('activityLog'));
    }

    // profile user

    public function profile()
    {
        $userId = Auth::User()->id;
        $information = DB::table('users')
            ->select(
                'users.*',
                'o.org_level',
                'ol.office_name',
                'et.emp_type',
                'at.attendance_type',
                'p.post_title'
            )
            ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
            ->leftJoin('master_organisations as o', 'o.org_id', '=', 'users.org_id')
            ->leftJoin('master_office_lists as ol', 'ol.office_id', '=', 'users.office_id')
            ->leftJoin('master_employee_types as et', 'et.emp_type_id', '=', 'users.emp_type_id')
            ->leftJoin('master_attendance_types as at', 'at.attendance_type_id', '=', 'users.attendance_type')
            ->leftJoin('master_posts as p', 'p.post_id', '=', 'users.position')
            ->where('users.id', $userId)
            ->first();
        $reporting_auth_name = User::select(
            'name',
            'emp_id'
        )->where('id', $information->reporting_authority)->get();

        $personalInfo = DB::table('personal_information')
            ->select(
                'personal_information.*',
                'ps.state_name as m_present_state',
                'ps2.state_name as m_permanent_state'
            )
            ->leftJoin('master_states as ps', 'ps.state_id', '=', 'personal_information.present_state')
            ->leftJoin('master_states as ps2', 'ps2.state_id', '=', 'personal_information.permanent_state')
            ->where('user_id', $userId)
            ->first();

        $familyInfos = DB::table('family_infos')
            ->where('user_id', $userId)
            ->get();
        // return $reporting_auth_name;

        return view('usermanagement.profile_user', compact(
            'information',
            'reporting_auth_name',
            'personalInfo',
            'familyInfos'
        ));
    }

    // Get Profile By ID
    public function profileById($userId)
    {
        $reporting_auth = Auth::user()->reporting_authority;
        $reporting_auth_name = User::select(
            'name',
            'emp_id'
        )->where('id', $reporting_auth)->get();

        $information = DB::table('users')
            ->select(
                'users.*',
                'o.org_level',
                'ol.office_name',
                'et.emp_type',
                'at.attendance_type',
                'p.post_title'
            )
            ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
            ->leftJoin('master_organisations as o', 'o.org_id', '=', 'users.org_id')
            ->leftJoin('master_office_lists as ol', 'ol.office_id', '=', 'users.office_id')
            ->leftJoin('master_employee_types as et', 'et.emp_type_id', '=', 'users.emp_type_id')
            ->leftJoin('master_attendance_types as at', 'at.attendance_type_id', '=', 'users.attendance_type')
            ->leftJoin('master_posts as p', 'p.post_id', '=', 'users.position')
            ->where('users.id', $userId)
            ->first();

        $personalInfo = DB::table('personal_information')
            ->select(
                'personal_information.*',
                'ps.state_name as m_present_state',
                'ps2.state_name as m_permanent_state'
            )
            ->leftJoin('master_states as ps', 'ps.state_id', '=', 'personal_information.present_state')
            ->leftJoin('master_states as ps2', 'ps2.state_id', '=', 'personal_information.permanent_state')
            ->where('user_id', $userId)
            ->first();

        $familyInfos = DB::table('family_infos')
            ->where('user_id', $userId)
            ->get();
        // return $reporting_auth_name;

        return view('usermanagement.profile_user', compact(
            'information',
            'reporting_auth_name',
            'personalInfo',
            'familyInfos'
        ));
    }

    // save profile information
    public function changeProfilePic(Request $request)
    {
        try {
            if (!empty($request->upload)) {

                $image = $request->id . '.' . $request->upload->extension();
                $request->upload->move(public_path('assets/employee_image'), $image);
                $update = [
                    'avatar' => $image,
                ];
                User::where('id', $request->id)->update($update);
                $result = DB::commit();
                Toastr::success('Profile pic updated successfully :)', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Updation failed :)', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Updation failed :)', 'Error');
            return redirect()->back();
        }
    }

    // save profile information
    public function profileInformation(Request $request)
    {
        try {
            if (!empty($request->images)) {
                $image_name = $request->hidden_image;
                $image = $request->file('images');
                if ($image_name == 'photo_defaults.jpg') {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/employee_image/'), $image_name);
                    }
                } else {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/employee_image/'), $image_name);
                    }
                }
                $update = [
                    'id' => $request->id,
                    'name'   => $request->name,
                    'avatar' => $image_name,
                ];
                User::where('id', $request->id)->update($update);
            }

            $information = User::updateOrCreate(['id' => $request->id]);
            $information->name = $request->name;
            $information->email = $request->email;
            $information->dob   = $request->dob;
            $information->present_city = $request->present_city;
            $information->present_state = $request->present_state;
            $information->present_country = $request->present_country;
            $information->present_pin = $request->present_pin;
            $information->phone_number = $request->phone_number;
            $information->department = $request->department;
            $information->designation = $request->designation;
            $information->save();

            DB::commit();
            Toastr::success('Profile Information successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Profile Information fail :)', 'Error');
            return redirect()->back();
        }
    }

    // save new user form modal 
    public function addNewUserSave(Request $request)
    {
        // $request->validate([
        //     'first_name'      => 'required|string|max:255',
        //     'middle_name'   => 'nullable|string|max:255',
        //     'last_name'      => 'nullable|string|max:255',
        //     'gender'      => 'required|string|max:255',
        //     'category'      => 'nullable|string|max:255',
        //     'dob'      => 'required|date',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'department_email' => 'nullable|string|email|max:255|unique:users',
        //     'organ_level' => 'required',
        //     'office_name' => 'required',
        //     'emp_type' => 'required',
        //     'pay_slab' => 'required',
        //     'attend_type' => 'required',
        //     'report_auth' => 'required',
        //     'cug_no' => 'required|unique:users',
        //     'join_date' => 'required',
        //     'designation' => 'required|string|max:255',
        //     'position'  => 'required|string|max:255',
        //     'image'     => 'nullable|image',
        //     'emp_id'    => 'nullable|unique:users'
        // ]);
        DB::beginTransaction();
        try {
            $user = new User;
            if ($request->middle_name != null && $request->last_name != null)
                $user->name = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;

            if ($request->middle_name != null && $request->last_name == null)
                $user->name = $request->first_name . ' ' . $request->middle_name;

            if ($request->middle_name == null && $request->last_name != null)
                $user->name = $request->first_name . ' ' . $request->last_name;

            if ($request->middle_name == null && $request->last_name == null)
                $user->name = $request->first_name;

            if ($request->image != null) {
                $image = $request->cug_no . '.' . $request->image->extension();
                $request->image->move(public_path('assets/employee_image'), $image);
            } else {
                if ($request->gender == 'Male')
                    $image = 'boy.png';
                else
                    $image = 'girl.png';
            }


            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->emp_id = $request->emp_id;
            $user->gender = $request->gender;
            $user->category = $request->category;
            $user->dob = $request->dob;
            $user->email = $request->email;
            $user->department_email = $request->department_email;
            $user->org_id    = $request->organ_level;
            $user->office_id    = $request->office_name;
            $user->emp_type_id    = $request->emp_type;
            $user->pay_slab    = $request->pay_slab;
            $user->attendance_type    = $request->attend_type;
            $user->join_date    = $request->join_date;
            $user->reporting_authority = $request->report_auth;
            $user->role_name    = 'Employee';
            $user->position     = $request->position;
            $user->avatar       = $image;
            $user->designation       = $request->designation;
            $user->cug_no       = $request->cug_no;
            $password = Str::random(6);
            $user->password     = Hash::make($password);
            $user->save();

            $personalInfo = new PersonalInformation();
            $personalInfo->user_id = $user->id;
            $personalInfo->save();

            DB::commit();
            $data = [
                'email' => $request->email,
                'subject' => "HRMS",
                'body' => "This message is sent from Framework Futuristic. We're sending your credentials. Your login Id is " . $request->email . " and your password is " . $password . ". This password is temporary,so please change your password."
            ];
            try {
                Mail::to($request->email)->send(new MailService($data));
                Toastr::success('Login Id is created. Email Sent successfully to ' . $request->first_name . ' ' . $request->last_name . ' :)', 'Success');
            } catch (Exception $e) {
                Toastr::error($e->getMessage(), 'Error');
            }
            return redirect()->route('userManagement');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    // update
    public function update(Request $request)
    {
        try {
            $rec_id       = $request->rec_id;
            $name         = $request->name;
            $email        = $request->email;
            $role_name    = $request->role_name;

            $position     = $request->position;
            $phone        = $request->phone;
            $department   = $request->department;
            $status       = $request->status;

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $image_name = $request->hidden_image;
            $image = $request->file('images');
            if ($image_name == 'photo_defaults.jpg') {
                if ($image != '') {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            } else {

                if ($image != '') {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }

            $update = [

                'rec_id'       => $rec_id,
                'name'         => $name,
                'role_name'    => $role_name,
                'email'        => $email,
                'position'     => $position,
                'phone_number' => $phone,
                'department'   => $department,
                'status'       => $status,
                'avatar'       => $image_name,
            ];

            $activityLog = [
                'user_name'    => $name,
                'email'        => $email,
                'phone_number' => $phone,
                'status'       => $status,
                'role_name'    => $role_name,
                'modify_user'  => 'Update',
                'date_time'    => $todayDate,
            ];
            DB::beginTransaction();
            DB::table('user_activity_logs')->insert($activityLog);
            User::where('rec_id', $request->rec_id)->update($update);
            DB::commit();
            Toastr::success('User updated successfully :)', 'Success');
            return redirect()->route('userManagement');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User update fail :)', 'Error');
            return redirect()->back();
        }
    }
    // delete
    public function delete(Request $request)
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');
        $deleted = User::select('email', 'cug_no')->where('id', $request->id)->first();
        DB::beginTransaction();
        try {
            $email        = $user->email;
            $status       = $user->status;
            $role_name    = $user->role_name;

            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $activityLog = [

                'user_name'    => $email,
                'email'        => $deleted->email,
                'status'       => $status,
                'role_name'    => $role_name,
                'phone_number' => $deleted->cug_no,
                'modify_user'  => 'Delete',
                'date_time'    => $todayDate,
            ];

            DB::table('user_activity_logs')->insert($activityLog);

            if ($request->avatar != null) {
                User::destroy($request->id);
            } else {
                User::destroy($request->id);
                unlink('assets/images/' . $request->avatar);
            }
            DB::commit();
            Toastr::success('User deleted successfully :)', 'Success');
            return redirect()->route('userManagement');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User deleted fail :)', 'Error');
            return redirect()->back();
        }
    }

    // view change password
    public function changePasswordView()
    {
        return view('settings.changepassword');
    }

    // change password in db
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('Password changed successfully :)', 'Success');
        return redirect()->intended('home');
    }

    //Update status of user that would be active, inactive or disable.

    public function updateStatus(Request $req)
    {
        DB::beginTransaction();
        try {

            $id     = $req->id;
            $status = $req->status;

            $update = [
                'status' => $status
            ];

            User::where('id', $id)->update($update);
            DB::commit();
            Toastr::success('User Status ' . $status . ' :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something is wrong :)', 'Error');
            return redirect()->back();
        }
    }



    // Fetch office name by organisation level
    public function searchOfficeName($org_idd = 0)
    {

        // Fetch district name by state id
        $officeListData = MasterOfficeList::orderby("office_id", "asc")
            ->select('office_id', 'office_name')
            ->where('org_id', $org_idd)
            ->get();

        return response()->json($officeListData);
    }

    public function editUser($id)
    {
        $user = new User();
        $masterOrganisation = new Master_organisation();
        $mEmployeeTypes = new MasterEmployeeType();
        $mAttendanceTypes = new MasterAttendanceType();
        $details = $user->getDetailsById($id);
        $organisationLevel = $masterOrganisation->show();
        $employeeTypes = $mEmployeeTypes->getAllEmployeeTypes();
        $attendanceTypes = $mAttendanceTypes->getAttendanceTypes();
        $reportingAuthorities = $user->reportingAuthorities();

        return view('usermanagement.edit_user', [
            'user' => $details,
            'organLevels' => $organisationLevel,
            'employeeTypes' => $employeeTypes,
            'attendanceTypes' => $attendanceTypes,
            'repoAuthorities' => $reportingAuthorities
        ]);
    }

    public function updateUser(Request $req, $id)
    {
        $user = User::find($id);
        $metaReqs = [
            'first_name' => $req->first_name,
            'middle_name' => $req->middle_name,
            'last_name' => $req->last_name,
            'emp_id' => $req->emp_id,
            'gender' => $req->gender,
            'category' => $req->category,
            'dob' => $req->dob,
            'email' => $req->email,
            'department_email' => $req->department_email,
            'org_id'    => $req->organ_level,
            'office_id'    => $req->office_name,
            'emp_type_id'    => $req->emp_type,
            'pay_slab'    => $req->pay_slab,
            'attendance_type' => $req->attend_type,
            'join_date'    => $req->join_date,
            'reporting_authority' => $req->report_auth,
            'position'     => $req->position,
            'designation'       => $req->designation,
            'cug_no'       => $req->cug_no
        ];
        $user->update($metaReqs);
        return back();
    }
}
