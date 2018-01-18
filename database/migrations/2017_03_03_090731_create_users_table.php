<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username',50)->unique();
			$table->string('password',254);
			$table->string('firstname',100);
			$table->string('middlename',50)->nullable();
			$table->string('lastname',50);
			$table->string('email',100)->nullable();
			$table->string('contact')->nullable();
			$table->integer('access');
			$table->string('office')->nullable();
			$table->string('department')->nullable();
			$table->string('position')->nullable();
			$table->boolean('status');
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
		Schema::drop('users');
	}

}
