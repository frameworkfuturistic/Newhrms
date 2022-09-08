<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_districts', function (Blueprint $table) {
            $table->increments('district_id');
            $table->string('org_id');
            $table->string('state_id');
            $table->string('district_code')->unique();
            $table->string('district_name');
            $table->boolean('discontinued')->nullable();
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
        Schema::dropIfExists('master_districts');
    }
}
