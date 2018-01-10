<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('stocknumber')->unique();
			$table->string('entity_name',200)->default('Polytechnic University of the Philippines');
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')
					->references('id')
					->on('categories')
					->onUpdate('cascade')
					->onDelete('cascade');
            $table->string('details');		
            $table->integer('unit_id')->unsigned()->nullable();
            $table->foreign('unit_id')
            		->references('id')
            		->on('units')
            		->onUpdate('cascade')
            		->onDelete('cascade');
            $table->integer('reorderpoint')->nullable();
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
		Schema::drop('supplies');
	}

}
