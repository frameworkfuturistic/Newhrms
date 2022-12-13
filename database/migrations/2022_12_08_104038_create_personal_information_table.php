<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('driving_licence')->nullable();
            $table->string('passport')->nullable();
            $table->string('voter_card')->nullable();
            $table->string('uan_no')->nullable();
            $table->string('uan_no_of_emp')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('present_city')->nullable();
            $table->string('present_state')->nullable();
            $table->string('present_pin')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_pin')->nullable();
            $table->string('personal_contact')->nullable();
            $table->string('alternative_contact')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emerg_con_per_name')->nullable();
            $table->string('emerg_con_per_rel')->nullable();
            $table->string('emerg_con_per_add')->nullable();
            $table->string('edu_qua_course_name')->nullable();
            $table->string('edu_qua_stream')->nullable();
            $table->string('edu_qua_board')->nullable();
            $table->string('edu_qua_passing_year')->nullable();
            $table->string('edu_qua_percentage')->nullable();
            $table->string('edu_qua_certi_upload')->nullable();
            $table->string('pro_qua_university_name')->nullable();
            $table->string('pro_qua_degree')->nullable();
            $table->string('pro_qua_subject')->nullable();
            $table->string('pro_qua_duration')->nullable();
            $table->string('pro_qua_year')->nullable();
            $table->string('pro_qua_ind_certi')->nullable();
            $table->string('tech_skill')->nullable();
            $table->string('skill_duration')->nullable();
            $table->string('organ_name')->nullable();
            $table->string('job_profile')->nullable();
            $table->string('organ_type')->nullable();

            $table->string('supp_doc_upload')->nullable();
            $table->string('eff_from_date')->nullable();
            $table->string('eff_to_date')->nullable();
            $table->string('fam_relation')->nullable();
            $table->string('full_name')->nullable();
            $table->string('present_address_one')->nullable();
            $table->string('present_address_two')->nullable();
            $table->string('permanent_address_one')->nullable();
            $table->string('permanent_address_two')->nullable();
            $table->string('fam_age')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('account_type')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->string('name_of_bank')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_information');
    }
}
