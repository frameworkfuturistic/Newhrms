<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->increments('attend_rec_id');
            $table->string('user_id');
            $table->date('attend_date');
            $table->boolean('status');
            $table->string('inserted_by_time_in_id')->nullable();
            $table->string('inserted_by_time_out_id')->nullable();
            $table->string('updated_by_time_in_id')->nullable();
            $table->string('updated_by_time_out_id')->nullable();
            $table->timestamp('time_in')->nullable();
            $table->timestamp('time_out')->nullable();
            $table->timestamp('inserted_on_time_in')->nullable();
            $table->timestamp('inserted_on_time_out')->nullable();
            $table->timestamp('updated_on_time_in')->nullable();
            $table->timestamp('updated_on_time_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_records');
    }
}
