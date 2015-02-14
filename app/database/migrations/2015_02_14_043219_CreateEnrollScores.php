<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollScores extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enroll_scores', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('enroll_id')->unsigned()->index();
            $table->integer('camp_test_id')->unsigned()->index();
            $table->integer('score')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('enroll_scores');
    }

}
