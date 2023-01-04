<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
        ];
    }
}
