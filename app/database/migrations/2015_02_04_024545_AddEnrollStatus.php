<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnrollStatus extends Migration {

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
            $table->enum('role', ['STUDENT', 'STAFF'])->default('STUDENT')->after('camp_id');
            $table->enum('status', ['PENDING', 'DOCUMENT_RECIEVED','APPROVED'])->default('PENDING')->after('camp_id');
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
            $table->dropColumn('status');
        });
        Schema::table('enrolls', function(Blueprint $table) {
            $table->enum('role', ['PENDING', 'STUDENT', 'STAFF'])->after('camp_id');
        });
    }

}
