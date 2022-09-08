<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('rec_id')->nullable();
            $table->string('email')->unique();
            $table->string('department_email')->unique()->nullable();
            $table->string('join_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('org_id')->nullable();
            $table->string('office_id')->nullable();
            $table->string('emp_type_id')->nullable();
            $table->string('status')->nullable();
            $table->string('role_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('pay_slab')->nullable();
            $table->string('attendance_type')->nullable();
            $table->string('reporting_authority')->nullable();
            $table->string('cug_no')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('driving_licence')->nullable();
            $table->string('passport')->nullable();
            $table->string('voter_card')->nullable();
            $table->string('uan_no')->nullable();
            $table->string('present_city')->nullable();
            $table->string('present_state')->nullable();
            $table->string('present_pin')->nullable();
            $table->string('present_country')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_pin')->nullable();
            $table->string('permanent_country')->nullable();
            $table->string('personal_contact')->nullable();
            $table->string('alternative_contact')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emerg_con_per_name')->nullable();
            $table->string('emerg_con_per_rel')->nullable();
            $table->string('emerg_con_per_add')->nullable();
            $table->string('avatar')->nullable();
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
            $table->string('pro_qua_city')->nullable();
            $table->string('pro_qua_year')->nullable();
            $table->string('pro_qua_ind_certi')->nullable();
            $table->string('tech_skill')->nullable();
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
