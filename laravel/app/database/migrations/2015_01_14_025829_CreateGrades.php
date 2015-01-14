<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrades extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('grades', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('semester_id')->unsigned();
            $table->string('subject',50);
            $table->double('grade',3,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('grades');
    }

}
