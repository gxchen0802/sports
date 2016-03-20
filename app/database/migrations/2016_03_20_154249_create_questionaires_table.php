<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionairesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questionaires', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->dateTime('start_time');
			$table->dateTime('end_time');
			$table->enum('type', array('single', 'multiple'))->default('single');
			$table->enum('status', array('deleted', 'hide', 'active'))->default('active');
			$table->text('description')->nullable();
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
		Schema::drop('questionaires');
	}

}
