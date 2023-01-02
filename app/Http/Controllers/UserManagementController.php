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
use App\Models\PersonalInformation;
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
            $result      = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->get();
            $role_name   = DB::table('role_type_users')->get();
            $position    = DB::table('position_types')->get();
            $department  = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            $employee_types = DB::table('master_employee_types')->get();
            $post = DB::table('master_posts')->get();
            $attendance_type = DB::table('master_attendance_types')->get();
            $organisation['data'] = Master_organisation::orderby("org_id", "asc")->select('org_id', 'org_level')->get();
            $post['pd'] = MasterPost::orderby("org_id", "asc")->select('org_id', 'post_title')->get();
            $designation['de'] = MasterDesignation::orderby("designation_id", "asc")->select('designation_id', 'designation_code', 'post_id')->get();



            return view('usermanagement.user_control', compact('result', 'role_name', 'position', 'department', 'status_user', 'organisation', 'employee_types', 'designation', 'post', 'attendance_type'));
        } else {
            return redirect()->route('home');
        }
    }

    // search user
    public function searchUser(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {
            // $result     = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->get();
            $position   = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();
            $employee_types = DB::table('master_employee_types')->get();
            $designation = DB::table('master_designations')->get();
            $post = DB::table('master_posts')->get();
            $role_name = DB::table('role_type_users')->get();
            $attendance_type = DB::table('master_attendance_types')->get();
            $organisation['data'] = Master_organisation::orderby("org_id", "asc")->select('org_id', 'org_level')->get();
            $post['pd'] = MasterPost::orderby("org_id", "asc")->select('org_id', 'post_title')->get();
            $designation['de'] = MasterDesignation::orderby("designation_id", "asc")->select('designation_id', 'designation_code', 'post_id')->get();

            // search by name
            if ($request->name) {
                $result = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->where('u.name', 'LIKE', '%' . $request->name . '%')->get();
            }

            // search by role name
            if ($request->role_name) {
                $result = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->where('u.role_name', 'LIKE', '%' . $request->role_name . '%')->get();
            }

            // search by status
            if ($request->status) {
                $result = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->where('u.status', 'LIKE', '%' . $request->status . '%')->get();
            }

            // search by name and role name
            if ($request->name && $request->role_name) {
                $result = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->where('u.name', 'LIKE', '%' . $request->name . '%')
                    ->where('u.role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->get();
            }

            // search by role name and status
            if ($request->role_name && $request->status) {
                $result = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->where('u.role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->where('u.status', 'LIKE', '%' . $request->status . '%')
                    ->get();
            }

            // search by name and status
            if ($request->name && $request->status) {
                $result = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->where('u.name', 'LIKE', '%' . $request->name . '%')
                    ->where('u.status', 'LIKE', '%' . $request->status . '%')
                    ->get();
            }

            // search by name and role name and status
            if ($request->name && $request->role_name && $request->status) {
                $result = DB::table('users as u')->select('u.*', 'mp.post_title')->leftJoin('master_posts as mp', 'mp.post_id', '=', 'u.position')->where('u.name', 'LIKE', '%' . $request->name . '%')
                    ->where('u.role_name', 'LIKE', '%' . $request->role_name . '%')
                    ->where('u.status', 'LIKE', '%' . $request->status . '%')
                    ->get();
            }

            return view('usermanagement.user_control', compact('result', 'role_name', 'position', 'department', 'status_user', 'employee_types', 'designation', 'post', 'attendance_type', 'organisation'));
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
        $personal_info = PersonalInformation::where("user_id", Auth::user()->id)->first();
        return view('usermanagement.add_user', compact('state', 'personal_info'));
    }

    // Fetch designation name through Ajax
    public function getDesignationName($ur_id = 0)
    {
        // Fetch office name by organisation level
        $design_name['dn'] = DB::table('users as u')
            ->leftjoin('master_designations as md', 'md.designation_id', '=', 'u.designation')
            ->select('md.designation_code')
            ->where('u.id', $ur_id)
            ->first();

        return response()->json($design_name);
    }

    public function saveProfileData(Request $request)
    {
        $request->validate([
            'aadhar_no' => 'nullable',
            'aadhar_card' => 'nullable',
            'pan_no' => 'nullable',
            'pan_card' => 'nullable',
            'dl' => 'nullable',
            'passport' => 'nullable',
            'voter_id' => 'nullable',
            'uan_no' => 'nullable',
            'uan_no_of_emp' => 'nullable|numeric',
            'blood_group' => 'nullable',
            'present_state' => 'nullable',
            'present_city' => 'nullable',
            'present_pin' => 'nullable',
            'present_address' => 'nullable',
            'permanent_state' => 'nullable',
            'permanent_city' => 'nullable',
            'permanent_pin' => 'nullable',
            'permanent_address' => 'nullable',
            'personal_contact' => 'nullable',
            'alternative_contact' => 'nullable',
            'emergency_contact' => 'nullable',
            'emerg_con_per_name' => 'nullable',
            'emerg_con_per_rel' => 'nullable',
            'emerg_con_per_add' => 'nullable',
            'edu_qua_course_name' => 'nullable',
            'edu_qua_stream' => 'nullable',
            'edu_qua_board' => 'nullable',
            'edu_qua_passing_year' => 'nullable',
            'edu_qua_percentage' => 'nullable',
            'edu_qua_certi_upload' => 'nullable',
            'pro_qua_university_name' => 'nullable',
            'pro_qua_degree' => 'nullable',
            'pro_qua_subject' => 'nullable',
            'pro_qua_duration' => 'nullable',
            'pro_qua_ind_certi' => 'nullable',
            'pro_qua_year' => 'nullable',
            'skill_name' => 'nullable',
            'skill_duration' => 'nullable',
            'organ_name' => 'nullable',
            'job_profile' => 'nullable',
            'organ_type' => 'nullable',
            'supp_doc_upload' => 'nullable',
            'eff_from_date' => 'nullable',
            'eff_to_date' => 'nullable',
            'fam_relation' => 'nullable',
            'full_name' => 'nullable',
            'fam_age ' => 'nullable',
            'account_holder_name' => 'nullable',
            'account_number' => 'nullable',
            'bank_ifsc' => 'nullable',
            'name_of_bank' => 'nullable'
        ]);

        DB::beginTransaction();
        try {
            $personal_info = new PersonalInformation;

            $personal_information = PersonalInformation::where("user_id", Auth::user()->id)->first();

            $id = $request->user_id;

            $aadhar_no = $request->aadhar_no;

            if ($request->aadhar_card) {
                $aadhar_card_img = $id . '.' . $request->aadhar_card->extension();
                $request->aadhar_card->move(public_path('assets/User_aadhar_card'), $aadhar_card_img);
            } else
                $aadhar_card_img = null;

            $pan_no = $request->pan_no;

            if ($request->pan_card) {
                $pan_card_img = $id . '.' . $request->pan_card->extension();
                $request->pan_card->move(public_path('assets/User_pan_card'), $pan_card_img);
            } else
                $pan_card_img = null;

            if ($request->dl) {
                $driving_licence_img = $id . '.' . $request->dl->extension();
                $request->dl->move(public_path('assets/User_driving_licence'), $driving_licence_img);
            } else
                $driving_licence_img = null;

            if ($request->passport) {
                $passport_img = $id . '.' . $request->passport->extension();
                $request->passport->move(public_path('assets/User_passport'), $passport_img);
            } else
                $passport_img = null;

            if ($request->voter_id) {
                $voter_id_img = $id . '.' . $request->voter_id->extension();
                $request->voter_id->move(public_path('assets/User_voter_id'), $voter_id_img);
            } else
                $voter_id_img = null;

            if ($request->uan_no) {
                $uan_img = $id . '.' . $request->uan_no->extension();
                $request->uan_no->move(public_path('assets/User_uan'), $uan_img);
            } else
                $uan_img = null;

            $uan_no_of_emp = $request->uan_no_of_emp;

            $blood_group = $request->blood_group;

            $present_state = $request->present_state;

            $present_city = $request->present_city;

            $present_pin = $request->present_pin;

            $present_address = $request->present_address;

            $permanent_state = $request->permanent_state;

            $permanent_city = $request->permanent_city;

            $permanent_pin = $request->permanent_pin;

            $permanent_address = $request->permanent_address;

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


            if ($request->edu_qua_certi_upload) {
                $edu_qua_certi_img = $id . '.' . $request->edu_qua_certi_upload->extension();
                $request->edu_qua_certi_upload->move(public_path('assets/User_edu_qua_certi'), $edu_qua_certi_img);
            } else
                $edu_qua_certi_img = null;

            $pro_qua_university_name = $request->pro_qua_university_name;

            $pro_qua_degree = $request->pro_qua_degree;

            $pro_qua_subject = $request->pro_qua_subject;

            $pro_qua_duration = $request->pro_qua_duration;

            if ($request->pro_qua_ind_certi) {
                $pro_qua_ind_certi_img = $id . '.' . $request->pro_qua_ind_certi->extension();
                $request->pro_qua_ind_certi->move(public_path('assets/User_pro_qua_ind'), $pro_qua_ind_certi_img);
            } else
                $pro_qua_ind_certi_img = null;

            $pro_qua_year = $request->pro_qua_year;

            $skill_name = $request->skill_name;

            $skill_duration = $request->skill_duration;

            $organ_name = $request->organ_name;

            if ($request->job_profile) {
                $job_profile_img = $id . '.' . $request->job_profile->extension();
                $request->job_profile->move(public_path('assets/User_job_profile'), $job_profile_img);
            } else
                $job_profile_img = null;

            $organ_type = $request->organ_type;

            if ($request->supp_doc_upload) {
                $supp_doc_img = $id . '.' . $request->supp_doc_upload->extension();
                $request->supp_doc_upload->move(public_path('assets/User_supp_doc'), $supp_doc_img);
            } else
                $supp_doc_img = null;

            $eff_from_date = $request->eff_from_date;

            $eff_to_date = $request->eff_to_date;

            $fam_relation = $request->fam_relation;

            $full_name = $request->full_name;

            $fam_age = $request->fam_age;

            $account_holder_name = $request->account_holder_name;

            $account_number = $request->account_number;

            $bank_ifsc = $request->bank_ifsc;

            $name_of_bank = $request->name_of_bank;


            $personal_information = PersonalInformation::where('user_id', auth()->user()->id)->first();

            if ($personal_information != null) {

                if (!is_null($aadhar_no)) {
                    $personal_information->aadhar_no = $aadhar_no;
                }

                if (!is_null($aadhar_card_img)) {
                    $personal_information->aadhar_card = $aadhar_card_img;
                }

                if (!is_null($pan_no)) {
                    $personal_information->pan_no = $pan_no;
                }

                if (!is_null($pan_card_img)) {
                    $personal_information->pan_card = $pan_card_img;
                }

                if (!is_null($driving_licence_img)) {
                    $personal_information->driving_licence = $driving_licence_img;
                }

                if (!is_null($passport_img)) {
                    $personal_information->passport = $passport_img;
                }

                if (!is_null($voter_id_img)) {
                    $personal_information->voter_card = $voter_id_img;
                }

                if (!is_null($uan_img)) {
                    $personal_information->uan_no = $uan_img;
                }

                if (!is_null($uan_no_of_emp)) {
                    $personal_information->uan_no_of_emp = $uan_no_of_emp;
                }

                if (!is_null($blood_group)) {
                    $personal_information->blood_group = $blood_group;
                }

                if (!is_null($present_state)) {
                    $personal_information->present_state = $present_state;
                }

                if (!is_null($present_city)) {
                    $personal_information->present_city = $present_city;
                }

                if (!is_null($present_pin)) {
                    $personal_information->present_pin = $present_pin;
                }

                if (!is_null($present_address)) {
                    $personal_information->present_address = $present_address;
                }

                if (!is_null($permanent_state)) {
                    $personal_information->permanent_state = $permanent_state;
                }

                if (!is_null($permanent_city)) {
                    $personal_information->permanent_city = $permanent_city;
                }

                if (!is_null($permanent_pin)) {
                    $personal_information->permanent_pin = $permanent_pin;
                }

                if (!is_null($permanent_address)) {
                    $personal_information->permanent_address = $permanent_address;
                }

                if (!is_null($personal_contact)) {
                    $personal_information->personal_contact = $personal_contact;
                }

                if (!is_null($alternative_contact)) {
                    $personal_information->alternative_contact = $alternative_contact;
                }

                if (!is_null($emergency_contact)) {
                    $personal_information->emergency_contact = $emergency_contact;
                }

                if (!is_null($emerg_con_per_name)) {
                    $personal_information->emerg_con_per_name = $emerg_con_per_name;
                }

                if (!is_null($emerg_con_per_rel)) {
                    $personal_information->emerg_con_per_rel = $emerg_con_per_rel;
                }

                if (!is_null($emerg_con_per_add)) {
                    $personal_information->emerg_con_per_add = $emerg_con_per_add;
                }

                if (!is_null($edu_qua_course_name)) {
                    $personal_information->edu_qua_course_name = $edu_qua_course_name;
                }

                if (!is_null($edu_qua_stream)) {
                    $personal_information->edu_qua_stream = $edu_qua_stream;
                }

                if (!is_null($edu_qua_board)) {
                    $personal_information->edu_qua_board = $edu_qua_board;
                }

                if (!is_null($edu_qua_passing_year)) {
                    $personal_information->edu_qua_passing_year = $edu_qua_passing_year;
                }

                if (!is_null($edu_qua_percentage)) {
                    $personal_information->edu_qua_percentage = $edu_qua_percentage;
                }

                if (!is_null($edu_qua_certi_img)) {
                    $personal_information->edu_qua_certi_upload = $edu_qua_certi_img;
                }

                if (!is_null($pro_qua_university_name)) {
                    $personal_information->pro_qua_university_name = $pro_qua_university_name;
                }

                if (!is_null($pro_qua_degree)) {
                    $personal_information->pro_qua_degree = $pro_qua_degree;
                }

                if (!is_null($pro_qua_subject)) {
                    $personal_information->pro_qua_subject = $pro_qua_subject;
                }

                if (!is_null($pro_qua_duration)) {
                    $personal_information->pro_qua_duration = $pro_qua_duration;
                }

                if (!is_null($pro_qua_ind_certi_img)) {
                    $personal_information->pro_qua_ind_certi = $pro_qua_ind_certi_img;
                }

                if (!is_null($pro_qua_year)) {
                    $personal_information->pro_qua_year = $pro_qua_year;
                }

                if (!is_null($skill_name)) {
                    $personal_information->tech_skill = $skill_name;
                }

                if (!is_null($skill_duration)) {
                    $personal_information->skill_duration = $skill_duration;
                }

                if (!is_null($organ_name)) {
                    $personal_information->organ_name = $organ_name;
                }

                if (!is_null($job_profile_img)) {
                    $personal_information->job_profile = $job_profile_img;
                }

                if (!is_null($organ_type)) {
                    $personal_information->organ_type = $organ_type;
                }

                if (!is_null($supp_doc_img)) {
                    $personal_information->supp_doc_upload = $supp_doc_img;
                }

                if (!is_null($eff_from_date)) {
                    $personal_information->eff_from_date = $eff_from_date;
                }

                if (!is_null($eff_to_date)) {
                    $personal_information->eff_to_date = $eff_to_date;
                }

                if (!is_null($fam_relation)) {
                    $personal_information->fam_relation = $fam_relation;
                }

                if (!is_null($full_name)) {
                    $personal_information->full_name = $full_name;
                }

                if (!is_null($fam_age)) {
                    $personal_information->fam_age = $fam_age;
                }

                if (!is_null($account_holder_name)) {
                    $personal_information->account_holder_name = $account_holder_name;
                }

                if (!is_null($account_number)) {
                    $personal_information->account_number = $account_number;
                }

                if (!is_null($bank_ifsc)) {
                    $personal_information->bank_ifsc = $bank_ifsc;
                }

                if (!is_null($name_of_bank)) {
                    $personal_information->name_of_bank = $name_of_bank;
                }

                $personal_information->save();
            } else {
                $user = PersonalInformation::create([
                    'user_id' => $id,
                    'aadhar_no' => $aadhar_no,
                    'aadhar_card' => $aadhar_card_img,
                    'pan_no' => $pan_no,
                    'pan_card' => $pan_card_img,
                    'driving_licence' => $driving_licence_img,
                    'passport' => $passport_img,
                    'voter_card' => $voter_id_img,
                    'uan_no' => $uan_img,
                    'uan_no_of_emp' => $uan_no_of_emp,
                    'blood_group' => $blood_group,
                    'present_state' => $present_state,
                    'present_city' => $present_city,
                    'present_pin' => $present_pin,
                    'present_address' => $present_address,
                    'permanent_state' => $permanent_state,
                    'permanent_city' => $permanent_city,
                    'permanent_pin' => $permanent_pin,
                    'permanent_address' => $permanent_address,
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

                    'edu_qua_certi_upload' => $edu_qua_certi_img,
                    'pro_qua_university_name' => $pro_qua_university_name,
                    'pro_qua_degree' => $pro_qua_degree,
                    'pro_qua_subject' => $pro_qua_subject,
                    'pro_qua_duration' => $pro_qua_duration,
                    'pro_qua_ind_certi' => $pro_qua_ind_certi_img,
                    'pro_qua_year' => $pro_qua_year,
                    'tech_skill' => $skill_name,
                    'skill_duration' => $skill_duration,
                    'organ_name' => $organ_name,
                    'job_profile' => $job_profile_img,
                    'organ_type' => $organ_type,
                    'supp_doc_upload' => $supp_doc_img,
                    'eff_from_date' => $eff_from_date,
                    'eff_to_date' => $eff_to_date,
                    'fam_relation' => $fam_relation,
                    'full_name' => $full_name,
                    'fam_age' => $fam_age,
                    'account_holder_name' => $account_holder_name,
                    'account_number' => $account_number,
                    'bank_ifsc' => $bank_ifsc,
                    'name_of_bank' => $name_of_bank
                ]);
            }

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
        // return 'Hii';
        $profile = Auth::User()->id;
        $reporting_auth = Auth::user()->reporting_authority;
        $reporting_auth_name = User::select('name', 'emp_id')->where('id', $reporting_auth)->get();


        $information = DB::table('users')
            ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
            ->where('users.id', $profile)->first();

        // return $reporting_auth_name;

        return view('usermanagement.profile_user', compact('information', 'reporting_auth_name'));
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

    // save new user
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:255',
            'middle_name'   => 'nullable|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'gender'      => 'required|string|max:255',
            'category'      => 'nullable|string|max:255',
            'dob'      => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'department_email' => 'nullable|string|email|max:255|unique:users',
            'organ_level' => 'required',
            'office_name' => 'required',
            'emp_type' => 'required',
            'pay_slab' => 'required',
            'attend_type' => 'required',
            'report_auth' => 'required',
            'cug_no' => 'required|unique:users',
            'join_date' => 'required',
            'designation' => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'image'     => 'nullable|image',
            'emp_id'    => 'nullable|unique:users'
        ]);
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
}
