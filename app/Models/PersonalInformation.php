<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'aadhar_card',
        'aadhar_no',
        'pan_no',
        'pan_card',
        'driving_licence',
        'passport',
        'voter_card',
        'uan_no',
        'uan_no_of_emp',
        'blood_group',
        'present_city',
        'present_state',
        'present_pin',
        'permanent_city',
        'permanent_state',
        'permanent_pin',
        'personal_contact',
        'alternative_contact',
        'emergency_contact',
        'emerg_con_per_name',
        'emerg_con_per_rel',
        'emerg_con_per_add',
        'edu_qua_course_name',
        'edu_qua_stream',
        'edu_qua_board',
        'edu_qua_passing_year',
        'edu_qua_percentage',
        'edu_qua_certi_upload',
        'pro_qua_university_name',
        'pro_qua_degree',
        'pro_qua_subject',
        'pro_qua_duration',
        'pro_qua_year',
        'pro_qua_ind_certi',
        'tech_skill',
        'skill_duration',
        'organ_name',
        'job_profile',
        'organ_type',
        'supp_doc_upload',
        'eff_from_date',
        'eff_to_date',
        'fam_relation',
        'full_name',
        'present_address',
        'permanent_address'
    ];
}
