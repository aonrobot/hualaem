<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('camps', function(Blueprint $table)
		{
			$table->boolean('is_judge')->default(false)->after('camp_end');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('camps', function(Blueprint $table)
		{
            $table->dropColumn('is_judge');
		});
	}

}
