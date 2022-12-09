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
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('category')->nullable();
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('rec_id')->nullable();
            $table->string('email')->unique();
            $table->string('department_email')->unique()->nullable();
            $table->string('join_date')->nullable();
            $table->string('org_id')->nullable();
            $table->string('office_id')->nullable();
            $table->string('emp_type_id')->nullable();
            $table->string('status')->default('Active');
            $table->string('role_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('pay_slab')->nullable();
            $table->string('attendance_type')->nullable();
            $table->string('reporting_authority')->nullable();
            $table->string('cug_no')->nullable();
            $table->string('avatar')->nullable();
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
