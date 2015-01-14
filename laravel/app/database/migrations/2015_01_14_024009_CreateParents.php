<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParents extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('parents', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('prefix_th', 10)->default('');
            $table->string('firstname_th', 50)->default('');
            $table->string('lastname_th', 50)->default('');
            $table->string('mobile', 10)->default('');
            $table->string('email', 25)->default('');
            $table->string('job', 50)->default('');
            $table->string('job_title', 50)->default('');
            $table->string('job_type', 50)->default('');
            
            $table->string('relation', 50)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('parents');
    }

}
