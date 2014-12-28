<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username', 60);
            $table->string('password', 60);
            $table->enum('role', ['UNVERIFY', 'VERIFIED', 'ADMIN']);

            $table->string('prefix_th', 10)->nullable();
            $table->string('firstname_th', 50)->nullable();
            $table->string('lastname_th', 50)->nullable();

            $table->string('prefix_en', 10)->nullable();
            $table->string('firstname_en', 50)->nullable();
            $table->string('lastname_en', 50)->nullable();

            $table->string('mobile_no', 10)->nullable();
            $table->string('email', 25)->nullable();
            $table->string('nickname', 25)->nullable();
            $table->date('birthdate')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
