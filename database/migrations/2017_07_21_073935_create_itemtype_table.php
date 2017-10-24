<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemtypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('itemtype', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('itemtype',150)->unique();//e.g.(ballpen)
			$table->string('description',450)->nullable();//aggragated with itemtype column
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('itemtype');
	}

}
