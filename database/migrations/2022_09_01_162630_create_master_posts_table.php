<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->string('post_title');
            $table->string('org_level')->nullable();
            $table->integer('org_id');
            $table->string('emp_type')->nullable();
            $table->integer('emp_type_id');
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
        Schema::dropIfExists('master_posts');
    }
}
