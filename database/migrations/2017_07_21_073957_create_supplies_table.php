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
			$table->string('entityname',200);
			$table->string('category_name')->nullable();
			$table->foreign('category_name')
					->references('name')
					->on('categories')
					->onUpdate('cascade')
					->onDelete('cascade');
            $table->string('details');		
            $table->string('unit')->nullable();
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
