<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function metaReqs($req)
    {
        $metaReqs = [
            'user_id' => $req->user_id,
            'aadhar_no' => $req->aadhar_no,
            'aadhar_card' => $req->aadhar_card_img,
            'pan_no' => $req->pan_no,
            'pan_card' => $req->pan_card_img,
            'driving_licence' => $req->driving_licence_img,
            'passport' => $req->passport_img,
            'voter_card' => $req->voter_id_img,
            'uan_no' => $req->uan_img,
            'uan_no_of_emp' => $req->uan_no_of_emp,
            'blood_group' => $req->blood_group,
            'present_state' => $req->present_state,
            'present_city' => $req->present_city,
            'present_pin' => $req->present_pin,
            'present_address' => $req->present_address,
            'permanent_state' => $req->permanent_state,
            'permanent_city' => $req->permanent_city,
            'permanent_pin' => $req->permanent_pin,
            'permanent_address' => $req->permanent_address,
            'personal_contact' => $req->personal_contact,
            'alternative_contact' => $req->alternative_contact,
            'emergency_contact' => $req->emergency_contact,
            'emerg_con_per_name' => $req->emerg_con_per_name,
            'emerg_con_per_rel' => $req->emerg_con_per_rel,
            'emerg_con_per_add' => $req->emerg_con_per_add,
            'edu_qua_course_name' => $req->edu_qua_course_name,
            'edu_qua_stream' => $req->edu_qua_stream,
            'edu_qua_board' => $req->edu_qua_board,
            'edu_qua_passing_year' => $req->edu_qua_passing_year,
            'edu_qua_percentage' => $req->edu_qua_percentage,

            'edu_qua_certi_upload' => $req->edu_qua_certi_img,
            'pro_qua_university_name' => $req->pro_qua_university_name,
            'pro_qua_degree' => $req->pro_qua_degree,
            'pro_qua_subject' => $req->pro_qua_subject,
            'pro_qua_duration' => $req->pro_qua_duration,
            'pro_qua_ind_certi' => $req->pro_qua_ind_certi_img,
            'pro_qua_year' => $req->pro_qua_year,
            'tech_skill' => $req->skill_name,
            'skill_duration' => $req->skill_duration,
            'organ_name' => $req->organ_name,
            'job_profile' => $req->job_profile_img,
            'organ_type' => $req->organ_type,
            'supp_doc_upload' => $req->supp_doc_img,
            'eff_from_date' => $req->eff_from_date,
            'eff_to_date' => $req->eff_to_date,
            'fam_relation' => $req->fam_relation,
            'full_name' => $req->full_name,
            'fam_age' => $req->fam_age,
            'account_holder_name' => $req->account_holder_name,
            'account_number' => $req->account_number,
            'bank_ifsc' => $req->bank_ifsc,
            'name_of_bank' => $req->name_of_bank
        ];
        return $metaReqs;
    }


    public function store($req)
    {
        $metaReqs = $this->metaReqs($req);
        PersonalInformation::create($metaReqs);
    }

    public function edit($request)
    {
        $metaReqs = [
            'aadhar_no' => $request->aadhar_no,
            'pan_no' => $request->pan_no,
            'uan_no_of_emp' => $request->uan_no_of_emp,
            'blood_group' => $request->blood_group,
            'present_state' => $request->present_state,
            'present_city' => $request->present_city,
            'present_pin' => $request->present_pin,
            'present_address' => $request->present_address,
            'permanent_state' => $request->permanent_state,
            'permanent_city' => $request->permanent_city,
            'permanent_pin' => $request->permanent_pin,
            'permanent_address' => $request->permanent_address,
            'personal_contact' => $request->personal_contact,
            'alternative_contact' => $request->alternative_contact,
            'emergency_contact' => $request->emergency_contact,
            'emerg_con_per_name' => $request->emerg_con_per_name,
            'emerg_con_per_rel' => $request->emerg_con_per_rel,
            'emerg_con_per_add' => $request->emerg_con_per_add,
            'edu_qua_course_name' => $request->edu_qua_course_name,
            'edu_qua_stream' => $request->edu_qua_stream,
            'edu_qua_board' => $request->edu_qua_board,
            'edu_qua_passing_year' => $request->edu_qua_passing_year,
            'edu_qua_percentage' => $request->edu_qua_percentage,
            'pro_qua_university_name' => $request->pro_qua_university_name,
            'pro_qua_degree' => $request->pro_qua_degree,
            'pro_qua_subject' => $request->pro_qua_subject,
            'pro_qua_year' => $request->pro_qua_year,
            'tech_skill' => $request->skill_name,
            'skill_duration' => $request->skill_duration,
            'organ_name' => $request->organ_name,
            'organ_type' => $request->organ_type,
            'eff_from_date' => $request->eff_from_date,
            'eff_to_date' => $request->eff_to_date,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'bank_ifsc' => $request->bank_ifsc,
            'name_of_bank' => $request->name_of_bank
        ];

        $info = PersonalInformation::where('user_id', $request->user_id)
            ->first();
        $metaReqs = $this->documentUpload($request, $metaReqs);
        $info->update($metaReqs);
    }

    /**
     * | Document Upload
     */
    public function documentUpload($req, $metaReqs)
    {
        if ($req->aadhar_card) {
            $fileName = '/uploads/' . time() . '.' . $req->aadhar_card->extension();
            $req->aadhar_card->move(public_path('uploads'), $fileName);
            $a = array_merge($metaReqs, ['aadhar_card' => $fileName]);
        }

        if ($req->pan_card) {
            $fileName = '/uploads/' . time() . '.' . $req->pan_card->extension();
            $req->pan_card->move(public_path('uploads'), $fileName);
            $a = array_merge($metaReqs, ['pan_card' => $fileName]);
        }

        return $a;
    }
}
