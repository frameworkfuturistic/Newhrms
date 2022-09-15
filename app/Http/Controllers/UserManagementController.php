<?php

namespace App\Http\Controllers;

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
use App\Models\MasterDesignation;
use App\Models\MasterEmployeeType;
use App\Models\MasterOfficeList;
use App\Models\MasterPost;
use App\Models\MasterStates;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name == 'Admin') {
            $result      = DB::table('users')->get();
            $role_name   = DB::table('role_type_users')->get();
            $position    = DB::table('position_types')->get();
            $department  = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            $employee_types = DB::table('master_employee_types')->get();
            $post = DB::table('master_posts')->get();
            $role_type = DB::table('role_type_users')->get();
            $attendance_type = DB::table('master_attendance_types')->get();
            $organisation['data'] = Master_organisation::orderby("org_id", "asc")->select('org_id', 'org_level')->get();
            $post['pd'] = MasterPost::orderby("org_id", "asc")->select('org_id', 'post_title')->get();
            $designation['de'] = MasterDesignation::orderby("designation_id", "asc")->select('designation_id', 'designation_code', 'post_id')->get();

            return view('usermanagement.user_control', compact('result', 'role_name', 'position', 'department', 'status_user', 'organisation', 'employee_types', 'designation', 'post', 'attendance_type', 'role_type'));
        } else {
            return redirect()->route('home');
        }
    }

    // Fetch office list through Ajax
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
        return view('usermanagement.add_user', compact('state'));
    }

    public function saveProfileData(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'aadhar_no' => 'required|unique:users',
            'aadhar_card' => 'required',
            'pan_no' => 'required',
            'pan_card' => 'required',
            'dl' => 'nullable',
            'passport' => 'nullable',
            'voter_id' => 'nullable',
            'uan' => 'nullable',
            'present_state' => 'required',
            'present_city' => 'required',
            'present_pin' => 'required',
            'permanent_state' => 'required',
            'permanent_city' => 'required',
            'permanent_pin' => 'required',
            'personal_contact' => 'required',
            'alternative_contact' => 'required',
            'emergency_contact' => 'required',
            'emerg_con_per_name' => 'required',
            'emerg_con_per_rel' => 'required',
            'emerg_con_per_add' => 'required',
            'edu_qua_course_name' => 'required',
            'edu_qua_stream' => 'required',
            'edu_qua_board' => 'required',
            'edu_qua_passing_year' => 'required',
            'edu_qua_percentage' => 'required',
            'edu_qua_certi_upload' => 'required',
            'pro_qua_university_name' => 'required',
            'pro_qua_degree' => 'required',
            'pro_qua_subject' => 'required',
            'pro_qua_duration' => 'required',
            'pro_qua_ind_certi' => 'required',
            'pro_qua_year' => 'required',
            'skill_name' => 'required',
            'skill_duration' => 'required',
            'skill_certi' => 'required',
            'organ_name' => 'required',
            'job_profile' => 'required',
            'organ_type' => 'required',
            'supp_doc_upload' => 'required',
            'eff_from_date' => 'required',
            'eff_to_date' => 'required',
            'fam_relation' => 'required',
            'full_name' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $id           = $request->user_id;

            $aadhar_no = $request->aadhar_no;
            $aadhar_card_image = $request->aadhar_no . '.' . $request->aadhar_card->extension();
            $request->aadhar_card->move(public_path('assets/User_aadhar_card'), $aadhar_card_image);

            $pan_no = $request->pan_no;
            $pan_card_image = $request->pan_no . '.' . $request->pan_card->extension();
            $request->pan_card->move(public_path('assets/User_pan_card'), $pan_card_image);

            if ($request->dl != null) {
                $driving_licence_image = $id . '.' . $request->dl->extension();
                $request->dl->move(public_path('assets/User_driving_licence'), $driving_licence_image);
            }

            if ($request->passport != null) {
                $passport_image = $id . '.' . $request->passport->extension();
                $request->passport->move(public_path('assets/User_passport'), $passport_image);
            }

            if ($request->voter_id != null) {
                $voter_id_image = $id . '.' . $request->voter_id->extension();
                $request->voter_id->move(public_path('assets/User_voter_id'), $voter_id_image);
            }

            if ($request->uan != null) {
                $uan_image = $id . '.' . $request->uan->extension();
                $request->uan->move(public_path('assets/User_uan'), $uan_image);
            }

            $present_state = $request->present_state;
            $present_city = $request->present_city;
            $present_pin = $request->present_pin;
            $permanent_state = $request->permanent_state;
            $permanent_city = $request->permanent_city;
            $permanent_pin = $request->permanent_pin;
            $personal_contact = $request->personal_contact;
            $alternative_contact = $request->alternative_contact;
            $emergency_contact = $request->emergency_contact;
            $emerg_con_per_name = $request->emerg_con_per_name;
            $emerg_con_per_rel = $request->emerg_con_per_rel;
            $emerg_con_per_add = $request->emerg_con_per_add;
            $edu_qua_course_name = $request->edu_qua_course_name;
            $edu_qua_stream = $request->edu_qua_stream;
            $edu_qua_board = $request->edu_qua_board;
            $edu_qua_passing_year = $request->edu_qua_passing_year;
            $edu_qua_percentage = $request->edu_qua_percentage;

            $edu_qua_certi_image = $id . '.' . $request->edu_qua_certi_upload->extension();
            $request->edu_qua_certi_upload->move(public_path('assets/User_edu_qua_certi'), $edu_qua_certi_image);

            $pro_qua_university_name = $request->pro_qua_university_name;
            $pro_qua_degree = $request->pro_qua_degree;
            $pro_qua_subject = $request->pro_qua_subject;
            $pro_qua_duration = $request->pro_qua_duration;

            $pro_qua_ind_certi_image = $id . '.' . $request->pro_qua_ind_certi->extension();
            $request->pro_qua_ind_certi->move(public_path('assets/User_pro_qua_ind'), $pro_qua_ind_certi_image);

            $pro_qua_year = $request->pro_qua_year;
            $skill_name = $request->skill_name;
            $skill_duration = $request->skill_duration;

            $skill_certi_image = $id . '.' . $request->skill_certi->extension();
            $request->skill_certi->move(public_path('assets/User_skill_certi'), $skill_certi_image);

            $organ_name = $request->organ_name;

            $job_profile_image = $id . '.' . $request->job_profile->extension();
            $request->job_profile->move(public_path('assets/User_job_profile'), $job_profile_image);

            $organ_type = $request->organ_type;

            $supp_doc_image = $id . '.' . $request->supp_doc_upload->extension();
            $request->supp_doc_upload->move(public_path('assets/User_supp_doc'), $supp_doc_image);

            $eff_from_date = $request->eff_from_date;
            $eff_to_date = $request->eff_to_date;
            $fam_relation = $request->fam_relation;
            $full_name = $request->full_name;

            if ($request->dl != null) {
                $update_dl = ['driving_licence' => $driving_licence_image];
                User::where('id', $id)->update($update_dl);
            } elseif ($request->passport != null) {
                $update_pass = ['passport' => $passport_image];
                User::where('id', $id)->update($update_pass);
            } elseif ($request->voter_id != null) {
                $update_voter_card = ['voter_card' => $voter_id_image];
                User::where('id', $id)->update($update_voter_card);
            } elseif ($request->uan != null) {
                $update_uan = ['uan_no' => $uan_image];
                User::where('id', $id)->update($update_uan);
            }

            $update = [
                'aadhar_no' => $aadhar_no,
                'aadhar_card' => $aadhar_card_image,
                'pan_no' => $pan_no,
                'pan_card' => $pan_card_image,
                'present_state' => $present_state,
                'present_city' => $present_city,
                'present_pin' => $present_pin,
                'permanent_state' => $permanent_state,
                'permanent_city' => $permanent_city,
                'permanent_pin' => $permanent_pin,
                'personal_contact' => $personal_contact,
                'alternative_contact' => $alternative_contact,
                'emergency_contact' => $emergency_contact,
                'emerg_con_per_name' => $emerg_con_per_name,
                'emerg_con_per_rel' => $emerg_con_per_rel,
                'emerg_con_per_add' => $emerg_con_per_add,
                'edu_qua_course_name' => $edu_qua_course_name,
                'edu_qua_stream' => $edu_qua_stream,
                'edu_qua_board' => $edu_qua_board,
                'edu_qua_passing_year' => $edu_qua_passing_year,
                'edu_qua_percentage' => $edu_qua_percentage,
                'edu_qua_certi_upload' => $edu_qua_certi_image,
                'pro_qua_university_name' => $pro_qua_university_name,
                'pro_qua_degree' => $pro_qua_degree,
                'pro_qua_subject' => $pro_qua_subject,
                'pro_qua_duration' => $pro_qua_duration,
                'pro_qua_ind_certi' => $pro_qua_ind_certi_image,
                'pro_qua_year' => $pro_qua_year,
                'tech_skill' => $skill_name,
                'skill_duration' => $skill_duration,
                'organ_name' => $organ_name,
                'job_profile' => $job_profile_image,
                'organ_type' => $organ_type,
                'supp_doc_upload' => $supp_doc_image,
                'eff_from_date' => $eff_from_date,
                'eff_to_date' => $eff_to_date,
                'fam_relation' => $fam_relation,
                'full_name' => $full_name

            ];

            User::where('id', $id)->update($update);
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

    // search user
    public function searchUser(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {
            $users      = DB::table('users')->get();
            $result     = DB::table('users')->get();
            $role_name  = DB::table('role_type_users')->get();
            $position   = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            $employee_types = DB::table('master_employee_types')->get();
            $designation = DB::table('master_designations')->get();
            $post = DB::table('master_posts')->get();
            $role_type = DB::table('role_type_users')->get();
            $attendance_type = DB::table('master_attendance_types')->get();
            $organisation['data'] = Master_organisation::orderby("org_id", "asc")->select('org_id', 'org_level')->get();

            // search by name
            if ($request->name) {
                $result = User::where('name', 'LIKE', '%' . $request->name . '%')->get();
            }

            // search by role name
            if ($request->role_name) {
                $result = User::where('role_name', 'LIKE', '%' . $request->role_name . '%')->get();
            }

            // search by status
            if ($request->status) {
                $result = User::where('status', 'LIKE', '%' . $request->status . '%')->get();
            }

            // search by name and role name
            if ($request->name && $request->role_name) {
                $result = User::where('name', 'LIKE', '%' . $request->name . '%')
                    ->where('role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->get();
            }

            // search by role name and status
            if ($request->role_name && $request->status) {
                $result = User::where('role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->where('status', 'LIKE', '%' . $request->status . '%')
                    ->get();
            }

            // search by name and status
            if ($request->name && $request->status) {
                $result = User::where('name', 'LIKE', '%' . $request->name . '%')
                    ->where('status', 'LIKE', '%' . $request->status . '%')
                    ->get();
            }

            // search by name and role name and status
            if ($request->name && $request->role_name && $request->status) {
                $result = User::where('name', 'LIKE', '%' . $request->name . '%')
                    ->where('role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->where('status', 'LIKE', '%' . $request->status . '%')
                    ->get();
            }

            return view('usermanagement.user_control', compact('users', 'role_name', 'position', 'department', 'status_user', 'result', 'employee_types', 'designation', 'post', 'role_type', 'attendance_type', 'organisation'));
        } else {
            return redirect()->route('home');
        }
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
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');
        $profile = $user->id;

        $user = DB::table('users')->get();
        $employees = DB::table('users')->where('id', $profile)->first();
        $design_name = DB::select("SELECT m.designation_name as design_name
        FROM users u 
        LEFT JOIN master_designations m ON m.designation_id = u.designation
        WHERE rec_id = 'KHM_0000000003' ");
        $state_name = DB::select("SELECT s.state_name FROM users u 
        LEFT JOIN master_states s ON s.state_id = u.present_state
        WHERE rec_id = 'KHM_0000000003' ");

        if (empty($employees)) {
            $information = DB::table('users')->where('id', $profile)->first();
            return view('usermanagement.profile_user', compact('information', 'user', 'design_name', 'state_name'));
        } else {
            $id = $employees->id;
            if ($id == $profile) {
                $information = DB::table('users')->where('id', $profile)->first();
                return view('usermanagement.profile_user', compact('information', 'user', 'design_name', 'state_name'));
            } else {
                $information = User::all();
                return view('usermanagement.profile_user', compact('information', 'user', 'design_name', 'state_name'));
            }
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

    // save new user
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'dob'      => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'department_email' => 'required|string|email|max:255|unique:users',
            'organ_level' => 'required',
            'office_name' => 'required',
            'emp_type' => 'required',
            'pay_slab' => 'required',
            'attend_type' => 'required',
            'report_auth' => 'required',
            'cug_no' => 'required',
            'join_date' => 'required',
            'role_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'image'     => 'required|image'
        ]);
        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->first_name . ' ' . $request->last_name;

            $password = $request->first_name . $request->last_name;
            $image = $user->name . $user->org_id . '.' . $request->image->extension();
            $request->image->move(public_path('assets/employee_image'), $image);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
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
            $user->role_name    = $request->role_name;
            $user->position     = $request->position;
            $user->avatar       = $image;
            $user->designation       = $request->designation;
            $user->cug_no       = $request->cug_no;
            $password = Str::random(6);
            $user->password     = Hash::make($password);
            $user->save();
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
                Toastr::error('Something went wrong :)', 'Error');
            }
            return redirect()->route('userManagement');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User add new account fail :)', 'Error');
            return redirect()->back();
        }
    }

    // update
    public function update(Request $request)
    {
        DB::beginTransaction();
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
        Toastr::success('User change successfully :)', 'Success');
        return redirect()->intended('home');
    }
}
