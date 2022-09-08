<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_blocks', function (Blueprint $table) {
            $table->increments('block_id');
            $table->string('org_id');
            $table->integer('state_id');
            $table->string('district_id');
            $table->string('block_code')->unique();
            $table->string('block_name');
            $table->string('discontinued')->nullable();
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
        Schema::dropIfExists('master_blocks');
    }
}
