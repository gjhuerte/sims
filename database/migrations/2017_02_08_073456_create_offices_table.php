<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code',20)->unique();
			$table->string('name');	
			$table->string('description')->nullable();
			$table->string('head')->nullable();
			$table->string('status')
				->nullable()
				->default('In Service');
			$table->timestamps();
			$table->softDeletes();		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('offices');
	}

}
