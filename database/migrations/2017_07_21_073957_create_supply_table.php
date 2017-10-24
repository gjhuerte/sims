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
		Schema::create('supply', function(Blueprint $table)
		{
			$table->string('stocknumber',50);
			$table->primary('stocknumber');
			$table->string('entityname',200);
			/*$table->string('fundcluster')->nullable();	*/
            $table->string('supplytype');		
            $table->string('unit',100)->nullable();
            /*$table->decimal('unitprice')->nullable();*/
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
		Schema::drop('supply');
	}

}
