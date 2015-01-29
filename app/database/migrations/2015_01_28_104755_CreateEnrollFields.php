<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollFields extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enroll_fields', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('enroll_id')->unsigned()->index();
            $table->integer('camp_field_id')->unsigned()->index();
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('enroll_fields');
    }

}
