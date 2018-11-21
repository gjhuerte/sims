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
			$table->char('abbreviation', 6)->nullable();
			$table->string('head_id')->nullable();

			$table->integer('parent_id')
					->unsigned()
					->nullable();

			$table->foreign('parent_id')
					->references('id')
					->on('offices')
					->onUpdate('cascade')
					->onDelete('cascade');

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
