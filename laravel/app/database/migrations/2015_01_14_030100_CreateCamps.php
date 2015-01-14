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
            $table->date('camp_start');
            $table->date('camp_end')->nullable();
            $table->string('place',200);
            $table->integer('province_id')->unsigned();
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
