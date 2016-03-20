<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionairesVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questionaires_votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('questionaire_id');
			$table->integer('question_id');
			$table->integer('answer_id');
			$table->enum('status', array('deleted', 'active'))->default('active');
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
		Schema::drop('votes');
	}

}
