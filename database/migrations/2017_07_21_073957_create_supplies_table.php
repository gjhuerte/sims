<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplies', function(Blueprint $table)
		{
			$table->string('stocknumber',50);
			$table->primary('stocknumber');
			$table->string('entityname',200);
            $table->string('details');		
            $table->string('unit',100)->nullable();
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
