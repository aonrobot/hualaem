<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnrolStatus extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('enrolls', function(Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::table('enrolls', function(Blueprint $table) {
            $table->enum('role', ['PENDING', 'STUDENT', 'STAFF'])->default('PENDING')->after('camp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('enrolls', function(Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::table('enrolls', function(Blueprint $table) {
            $table->enum('role', ['STUDENT', 'STAFF'])->after('camp_id');
        });
    }

}
