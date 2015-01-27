<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsRequireField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('camp_fields', function(Blueprint $table) {
            $table->boolean('is_required')->default(TRUE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('camp_fields', function(Blueprint $table) {
            $table->dropColumn('is_required');
        });
    }

}
