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
			$table->string('description')->nullable()->default(null);
			$table->char('abbreviation', 6)->nullable()->default(null);
			$table->string('head')->nullable();
			$table->string('head_title')->nullable()->default(null);
			$table->string('status')
				->nullable()
				->default('In Service');
			$table->integer('head_office')->unsigned()->nullable()->default(null);
			$table->foreign('head_office')
					->references('id')
					->on('offices')
					->onUpdate('cascade')
					->onDelete('cascade');
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
