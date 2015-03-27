<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateMessageData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('private_message_datas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsinged()->index();
            $table->integer('sender_id')->unsinged();
            $table->text('message');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('private_message_datas');
	}

}
