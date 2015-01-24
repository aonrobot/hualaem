<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampFields extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('camp_fields', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('camp_id')->unsigned();
            $table->string('name', 250);
            $table->enum('type', ['text', 'textarea', 'file']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('camp_fields');
    }

}
