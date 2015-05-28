<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnrollStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        DB::transaction(function(){
            Schema::table('enrolls', function(Blueprint $table) {
                $table->enum('status_new', ['PENDING', 'DOCUMENT_RECIEVED','APPROVED','NOT_APPROVED'])->default('PENDING')->after('camp_id');
            });

            DB::table('enrolls')->update([
                'status_new'=>DB::raw('`status`')
            ]);

            Schema::table('enrolls', function(Blueprint $table) {
                $table->dropColumn('status');
            });

            Schema::table('enrolls', function(Blueprint $table) {
                $table->enum('status', ['PENDING', 'DOCUMENT_RECIEVED','APPROVED','NOT_APPROVED'])->default('PENDING')->after('camp_id');
            });

            DB::table('enrolls')->update([
                'status'=>DB::raw('`status_new`')
            ]);

            Schema::table('enrolls', function(Blueprint $table) {
                $table->dropColumn('status_new');
            });
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::transaction(function(){
            Schema::table('enrolls', function(Blueprint $table) {
                $table->enum('status_new', ['PENDING', 'DOCUMENT_RECIEVED','APPROVED'])->default('PENDING')->after('camp_id');
            });

            Enroll::where('status_old','NOT_APPROVED')->delete();

            DB::table('enrolls')->update([
                'status_new'=>DB::raw('`status`')
            ]);

            Schema::table('enrolls', function(Blueprint $table) {
                $table->dropColumn('status');
            });

            Schema::table('enrolls', function(Blueprint $table) {
                $table->enum('status', ['PENDING', 'DOCUMENT_RECIEVED','APPROVED'])->default('PENDING')->after('camp_id');
            });

            DB::table('enrolls')->update([
                'status'=>DB::raw('`status_new`')
            ]);

            Schema::table('enrolls', function(Blueprint $table) {
                $table->dropColumn('status_new');
            });
        });

	}

}
