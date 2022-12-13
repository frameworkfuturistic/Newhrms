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
            'aadhar_no' => 'nullable|unique:personal_information',
            'aadhar_card' => 'nullable',
            'pan_no' => 'nullable',
            'pan_card' => 'nullable',
            'dl' => 'nullable',
            'passport' => 'nullable',
            'voter_id' => 'nullable',
            'uan' => 'nullable',
            'uan_no_of_emp' => 'nullable|numeric',
            'blood_group' => 'nullable',
            'present_state' => 'nullable',
            'present_city' => 'nullable',
            'present_pin' => 'nullable',
            'permanent_state' => 'nullable',
            'permanent_city' => 'nullable',
            'permanent_pin' => 'nullable',
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
            'present_address_one' => 'nullable',
            'present_address_two' => 'nullable',
            'permanent_address_two' => 'nullable',
            ' permanent_address_one' => 'nullable',
            'account_holder_name' => 'nullable',
            'account_type' => 'nullable',
            'bank_ifsc' => 'nullable',
            'name_of_bank' => 'nullable'


        ]);

        DB::beginTransaction();
        try {
            $personal_info = new PersonalInformation;

            $id = $request->user_id;

            // if ($request->dl != null) {
            //     $update_dl = ['driving_licence' => $driving_licence_image];
            //     User::where('id', $id)->update($update_dl);
            // } elseif ($request->passport != null) {
            //     $update_pass = ['passport' => $passport_image];
            //     User::where('id', $id)->update($update_pass);
            // } elseif ($request->voter_id != null) {
            //     $update_voter_card = ['voter_card' => $voter_id_image];
            //     User::where('id', $id)->update($update_voter_card);
            // } elseif ($request->uan != null) {
            //     $update_uan = ['uan_no' => $uan_image];
            //     User::where('id', $id)->update($update_uan);
            // }

            $personal_information = PersonalInformation::where("user_id", Auth::user()->id)->first();

            if ($request->aadhar_no != null && $personal_information->aadhar_no == null)
                $aadhar_no = $request->aadhar_no;
            else if ($request->aadhar_no != null && $personal_information->aadhar_no != null)
                $aadhar_no = $request->aadhar_no;


            if ($request->aadhar_card) {
                $aadhar_card_img = $id . '.' . $request->aadhar_card->extension();
                $request->aadhar_card->move(public_path('assets/User_aadhar_card'), $aadhar_card_img);
            } else
                $aadhar_card_img = null;

            if ($request->aadhar_card != null && $personal_information->aadhar_card == null)
                $aadhar_card_image = $aadhar_card_img;
            else if ($request->aadhar_card != null && $personal_information->aadhar_card != null)
                $aadhar_card_image = $aadhar_card_img;

            if ($request->pan_no != null && $personal_information->pan_no == null)
                $pan_no = $request->pan_no;
            else if ($request->pan_no != null && $personal_information->pan_no != null)
                $pan_no = $request->pan_no;


            if ($request->pan_card) {
                $pan_card_img = $id . '.' . $request->pan_card->extension();
                $request->pan_card->move(public_path('assets/User_pan_card'), $pan_card_img);
            } else
                $pan_card_img = null;


            if ($request->pan_card != null && $personal_information->pan_card == null)
                $pan_card_image = $pan_card_img;
            else if ($request->pan_card != null && $personal_information->pan_card != null)
                $pan_card_image = $pan_card_img;

            if ($request->dl != null) {
                $driving_licence_img = $id . '.' . $request->dl->extension();
                $request->dl->move(public_path('assets/User_driving_licence'), $driving_licence_img);
            } else
                $driving_licence_img = null;

            if ($request->dl != null && $personal_information->driving_licence == null)
                $driving_licence_image = $driving_licence_img;
            else if ($request->dl != null && $personal_information->driving_licence != null)
                $driving_licence_image = $driving_licence_img;


            if ($request->passport != null) {
                $passport_img = $id . '.' . $request->passport->extension();
                $request->passport->move(public_path('assets/User_passport'), $passport_img);
            } else
                $passport_img = null;

            if ($request->passport != null && $personal_information->passport == null)
                $passport_image = $passport_img;
            else if ($request->passport != null && $personal_information->passport != null)
                $passport_image = $passport_img;

            if ($request->voter_id != null) {
                $voter_id_img = $id . '.' . $request->voter_id->extension();
                $request->voter_id->move(public_path('assets/User_voter_id'), $voter_id_img);
            } else
                $voter_id_img = null;

            if ($request->voter_id != null && $personal_information->voter_card == null)
                $voter_id_image = $voter_id_img;
            else if ($request->voter_id != null && $personal_information->voter_card != null)
                $voter_id_image = $voter_id_img;


            if ($request->uan != null) {
                $uan_img = $id . '.' . $request->uan->extension();
                $request->uan->move(public_path('assets/User_uan'), $uan_img);
            } else
                $uan_img = null;

            if ($request->uan != null && $personal_information->uan_no == null)
                $uan_image = $uan_img;
            else if ($request->uan != null && $personal_information->uan_no != null)
                $uan_image = $uan_img;


            if ($request->uan_no_of_emp != null && $personal_information->uan_no_of_emp == null)
                $uan_no_of_emp = $request->uan_no_of_emp;
            else if ($request->uan_no_of_emp != null && $personal_information->uan_no_of_emp != null)
                $uan_no_of_emp = $request->uan_no_of_emp;

            if ($request->blood_group != null && $personal_information->blood_group == null)
                $blood_group = $request->blood_group;
            else if ($request->blood_group != null && $personal_information->blood_group != null)
                $blood_group = $request->blood_group;

            if ($request->present_city != null && $personal_information->present_city == null)
                $present_city = $request->present_city;
            else if ($request->present_city != null && $personal_information->present_city != null)
                $present_city = $request->present_city;


            if ($request->present_state != null && $personal_information->present_state == null)
                $present_state = $request->present_state;
            else if ($request->present_state != null && $personal_information->present_state != null)
                $present_state = $request->present_state;

            if ($request->present_pin != null && $personal_information->present_pin == null)
                $present_pin = $request->present_pin;
            else if ($request->present_pin != null && $personal_information->present_pin != null)
                $present_pin = $request->present_pin;

            if ($request->permanent_city != null && $personal_information->permanent_city == null)
                $permanent_city = $request->permanent_city;
            else if ($request->permanent_city != null && $personal_information->permanent_city != null)
                $permanent_city = $request->permanent_city;

            if ($request->permanent_state != null && $personal_information->permanent_state == null)
                $permanent_state = $request->permanent_state;
            else if ($request->permanent_state != null && $personal_information->permanent_state != null)
                $permanent_state = $request->permanent_state;

            if ($request->permanent_pin != null && $personal_information->permanent_pin == null)
                $permanent_pin = $request->permanent_pin;
            else if ($request->permanent_pin != null && $personal_information->permanent_pin != null)
                $permanent_pin = $request->permanent_pin;

            if ($request->personal_contact != null && $personal_information->personal_contact == null)
                $personal_contact = $request->personal_contact;
            else if ($request->personal_contact != null && $personal_information->personal_contact != null)
                $personal_contact = $request->personal_contact;

            if ($request->alternative_contact != null && $personal_information->alternative_contact == null)
                $alternative_contact = $request->alternative_contact;
            else if ($request->alternative_contact != null && $personal_information->alternative_contact != null)
                $alternative_contact = $request->alternative_contact;

            if ($request->emergency_contact != null && $personal_information->emergency_contact == null)
                $emergency_contact = $request->emergency_contact;
            else if ($request->emergency_contact != null && $personal_information->emergency_contact != null)
                $emergency_contact = $request->emergency_contact;

            if ($request->emerg_con_per_name != null && $personal_information->emerg_con_per_name == null)
                $emerg_con_per_name = $request->emerg_con_per_name;
            else if ($request->emerg_con_per_name != null && $personal_information->emerg_con_per_name != null)
                $emerg_con_per_name = $request->emerg_con_per_name;

            if ($request->emerg_con_per_rel != null && $personal_information->emerg_con_per_rel == null)
                $emerg_con_per_rel = $request->emerg_con_per_rel;
            else if ($request->emerg_con_per_rel != null && $personal_information->emerg_con_per_rel != null)
                $emerg_con_per_rel = $request->emerg_con_per_rel;

            if ($request->emerg_con_per_add != null && $personal_information->emerg_con_per_add == null)
                $emerg_con_per_add = $request->emerg_con_per_add;
            else if ($request->emerg_con_per_add != null && $personal_information->emerg_con_per_add != null)
                $emerg_con_per_add = $request->emerg_con_per_add;

            if ($request->edu_qua_course_name != null && $personal_information->edu_qua_course_name == null)
                $edu_qua_course_name = $request->edu_qua_course_name;
            else if ($request->edu_qua_course_name != null && $personal_information->edu_qua_course_name != null)
                $edu_qua_course_name = $request->edu_qua_course_name;

            if ($request->edu_qua_stream != null && $personal_information->edu_qua_stream == null)
                $edu_qua_stream = $request->edu_qua_stream;
            else if ($request->edu_qua_stream != null && $personal_information->edu_qua_stream != null)
                $edu_qua_stream = $request->edu_qua_stream;

            if ($request->edu_qua_board != null && $personal_information->edu_qua_board == null)
                $edu_qua_board = $request->edu_qua_board;
            else if ($request->edu_qua_board != null && $personal_information->edu_qua_board != null)
                $edu_qua_board = $request->edu_qua_board;

            if ($request->edu_qua_passing_year != null && $personal_information->edu_qua_passing_year == null)
                $edu_qua_passing_year = $request->edu_qua_passing_year;
            else if ($request->edu_qua_passing_year != null && $personal_information->edu_qua_passing_year != null)
                $edu_qua_passing_year = $request->edu_qua_passing_year;

            if ($request->edu_qua_percentage != null && $personal_information->edu_qua_percentage == null)
                $edu_qua_percentage = $request->edu_qua_percentage;
            else if ($request->edu_qua_percentage != null && $personal_information->edu_qua_percentage != null)
                $edu_qua_percentage = $request->edu_qua_percentage;


            if ($request->edu_qua_certi_upload != null) {
                $edu_qua_certi_img = $id . '.' . $request->edu_qua_certi_upload->extension();
                $request->edu_qua_certi_upload->move(public_path('assets/User_edu_qua_certi'), $edu_qua_certi_img);
            } else
                $edu_qua_certi_img = null;


            if ($request->edu_qua_certi_upload != null && $personal_information->edu_qua_certi_upload == null)
                $edu_qua_certi_image = $edu_qua_certi_img;
            else if ($request->edu_qua_certi_upload != null && $personal_information->edu_qua_certi_upload != null)
                $edu_qua_certi_image = $edu_qua_certi_img;


            if ($request->pro_qua_university_name != null && $personal_information->pro_qua_university_name == null)
                $pro_qua_university_name = $request->pro_qua_university_name;
            else if ($request->pro_qua_university_name != null && $personal_information->pro_qua_university_name != null)
                $pro_qua_university_name = $request->pro_qua_university_name;

            if ($request->pro_qua_degree != null && $personal_information->pro_qua_degree == null)
                $pro_qua_degree = $request->pro_qua_degree;
            else if ($request->pro_qua_degree != null && $personal_information->pro_qua_degree != null)
                $pro_qua_degree = $request->pro_qua_degree;

            if ($request->pro_qua_subject != null && $personal_information->pro_qua_subject == null)
                $pro_qua_subject = $request->pro_qua_subject;
            else if ($request->pro_qua_subject != null && $personal_information->pro_qua_subject != null)
                $pro_qua_subject = $request->pro_qua_subject;

            if ($request->pro_qua_duration != null && $personal_information->pro_qua_duration == null)
                $pro_qua_duration = $request->pro_qua_duration;
            else if ($request->pro_qua_duration != null && $personal_information->pro_qua_duration != null)
                $pro_qua_duration = $request->pro_qua_duration;

            if ($request->pro_qua_year != null && $personal_information->pro_qua_year == null)
                $pro_qua_year = $request->pro_qua_year;
            else if ($request->pro_qua_year != null && $personal_information->pro_qua_year == null)
                $pro_qua_year = $request->pro_qua_year;

            if ($request->pro_qua_ind_certi != null) {
                $pro_qua_ind_certi_img = $id . '.' . $request->pro_qua_ind_certi->extension();
                $request->pro_qua_ind_certi->move(public_path('assets/User_pro_qua_ind'), $pro_qua_ind_certi_img);
            } else
                $pro_qua_ind_certi_img = null;

            if ($request->pro_qua_ind_certi != null && $personal_information->pro_qua_ind_certi == null)
                $pro_qua_ind_certi_image = $pro_qua_ind_certi_img;
            else if ($request->pro_qua_ind_certi != null && $personal_information->pro_qua_ind_certi != null)
                $pro_qua_ind_certi_image = $pro_qua_ind_certi_img;

            if ($request->skill_name != null && $personal_information->tech_skill == null)
                $skill_name = $request->skill_name;
            else if ($request->skill_name != null && $personal_information->tech_skill != null)
                $skill_name = $request->skill_name;

            if ($request->skill_duration != null && $personal_information->skill_duration == null)
                $skill_duration = $request->skill_duration;
            else if ($request->skill_duration != null && $personal_information->skill_duration != null)
                $skill_duration = $request->skill_duration;

            if ($request->organ_name != null && $personal_information->organ_name == null)
                $organ_name = $request->organ_name;
            else if ($request->organ_name != null && $personal_information->organ_name != null)
                $organ_name = $request->organ_name;

            if ($request->job_profile != null) {
                $job_profile_img = $id . '.' . $request->job_profile->extension();
                $request->job_profile->move(public_path('assets/User_job_profile'), $job_profile_img);
            } else
                $job_profile_img = null;

            if ($request->job_profile != null && $personal_information->job_profile == null)
                $job_profile_image = $job_profile_img;
            else if ($request->job_profile != null && $personal_information->job_profile != null)
                $job_profile_image = $job_profile_img;

            if ($request->organ_type != null && $personal_information->organ_type == null)
                $organ_type = $request->organ_type;
            else if ($request->organ_type != null && $personal_information->organ_type == null)
                $organ_type = $request->organ_type;

            if ($request->supp_doc_upload != null) {
                $supp_doc_img = $id . '.' . $request->supp_doc_upload->extension();
                $request->supp_doc_upload->move(public_path('assets/User_supp_doc'), $supp_doc_img);
            } else
                $supp_doc_img = null;

            if ($request->supp_doc_upload != null && $personal_information->supp_doc_upload == null)
                $supp_doc_image = $supp_doc_img;
            else if ($request->supp_doc_upload != null && $personal_information->supp_doc_upload != null)
                $supp_doc_image = $supp_doc_img;

            if ($request->eff_from_date != null && $personal_information->eff_from_date == null)
                $eff_from_date = $request->eff_from_date;
            else if ($request->eff_from_date != null && $personal_information->eff_from_date != null)
                $eff_from_date = $request->eff_from_date;

            if ($request->eff_to_date != null && $personal_information->eff_to_date == null)
                $eff_to_date = $request->eff_to_date;
            else if ($request->eff_to_date != null && $personal_information->eff_to_date != null)
                $eff_to_date = $request->eff_to_date;

            if ($request->fam_relation != null && $personal_information->fam_relation == null)
                $fam_relation = $request->fam_relation;
            else if ($request->fam_relation != null && $personal_information->fam_relation != null)
                $fam_relation = $request->fam_relation;

            if ($request->full_name != null && $personal_information->full_name == null)
                $full_name = $request->full_name;
            else if ($request->full_name != null && $personal_information->full_name != null)
                $full_name = $request->full_name;

            $personal_information = PersonalInformation::where('user_id', request('user_id'))->first();
            if ($personal_information !== null) {
                $personal_information->update([
                    'aadhar_card' => $aadhar_card_image,
                    'aadhar_no' => $aadhar_no,
                    'pan_no' => $pan_no,
                    'pan_card' => $pan_card_image,
                    'driving_licence' => $driving_licence_image,
                    'passport' => $passport_image,
                    'voter_card' => $voter_id_image,
                    'uan_no' => $uan_image,
                    'uan_no_of_emp' => $uan_no_of_emp,
                    'blood_group' => $blood_group,
                    'present_city' => $present_city,
                    'present_state' => $present_state,
                    'present_pin' => $present_pin,
                    'permanent_city' => $permanent_city,
                    'permanent_state' => $permanent_state,
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
                    'pro_qua_year' => $pro_qua_year,
                    'pro_qua_ind_certi' => $pro_qua_ind_certi_image,
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
                ]);
            } else {
                $user = PersonalInformation::create([
                    'user_id' => request('user_id'),
                    'aadhar_card' => $aadhar_card_image,
                    'aadhar_no' => $aadhar_no,
                    'pan_no' => $pan_no,
                    'pan_card' => $pan_card_image,
                    'driving_licence' => $driving_licence_image,
                    'passport' => $passport_image,
                    'voter_card' => $voter_id_image,
                    'uan_no' => $uan_image,
                    'uan_no_of_emp' => $uan_no_of_emp,
                    'blood_group' => $blood_group,
                    'present_city' => $present_city,
                    'present_state' => $present_state,
                    'present_pin' => $present_pin,
                    'permanent_city' => $permanent_city,
                    'permanent_state' => $permanent_state,
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
                    'pro_qua_year' => $pro_qua_year,
                    'pro_qua_ind_certi' => $pro_qua_ind_certi_image,
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
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');
        $profile = $user->id;
        $reporting_auth = Auth::user()->reporting_authority;
        $reporting_auth_name = User::select('name', 'emp_id')->where('id', $reporting_auth)->get();

        $user = DB::table('users')
            ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
            ->get();

        $employees = DB::table('users')
            ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
            ->where('users.id', $profile)->first();

        $design_name = DB::select(
            "SELECT m.designation_name as design_name FROM users u 
                                    LEFT JOIN master_designations m ON m.designation_id = u.designation
                                    WHERE u.id = $profile "
        );

        $state_name = DB::select(
            "SELECT s.state_name FROM users u 
                                    LEFT JOIN personal_information p ON p.user_id = u.id 
                                    LEFT JOIN master_states s ON s.state_id = p.present_state
                                    WHERE u.id = $profile "
        );

        if (empty($employees)) {

            $information = DB::table('users')
                ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
                ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
                ->where('users.id', $profile)->first();

            return view('usermanagement.profile_user', compact('information', 'reporting_auth_name', 'user', 'design_name', 'state_name'));
        } else {
            $id = $employees->id;

            if ($id == $profile) {

                $information = DB::table('users')
                    ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
                    ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
                    ->where('users.id', $profile)->first();

                return view('usermanagement.profile_user', compact('information', 'reporting_auth_name', 'user', 'design_name', 'state_name'));
            } else {

                $information = DB::table('users')
                    ->leftJoin('personal_information', 'personal_information.user_id', '=', 'users.id')
                    ->leftJoin('master_employee_types as e', 'e.emp_type_id', '=', 'users.emp_type_id')
                    ->where('users.id', $profile)->first();

                return view('usermanagement.profile_user', compact('information', 'reporting_auth_name', 'user', 'design_name', 'state_name'));
            }
        }
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
            'role_name' => 'required|string|max:255',
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
