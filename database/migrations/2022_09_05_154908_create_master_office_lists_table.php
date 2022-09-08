<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterOfficeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_office_lists', function (Blueprint $table) {
            $table->increments('office_id');
            $table->string('office_name');
            $table->string('address');
            $table->string('org_level');
            $table->string('org_id');
            $table->string('location');
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
        Schema::dropIfExists('master_office_lists');
    }
}
