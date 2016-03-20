<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vote_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('questionaire_id');
			$table->string('ip', 255);
			$table->timestamps();

			$table->unique(['questionaire_id', 'ip'], 'unique_ip');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vote_history');
	}

}
