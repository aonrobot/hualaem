<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamps extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('camps', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->string('type',200);
            $table->string('level',50);
            $table->date('register_start');
            $table->date('register_end')->nullable();
            $table->date('camp_start')->nullable();
            $table->date('camp_end')->nullable();
            $table->string('image_path');
            $table->string('place',200);
            $table->integer('province_id')->unsigned();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('camps');
    }

}
