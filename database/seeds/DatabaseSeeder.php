<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		//disable foreign key check for this connection before running seeders
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->call('UnitTableSeeder');
		$this->call('SupplyTableSeeder');
		$this->call('SupplierTableSeeder');
		$this->call('OfficeTableSeeder');
		$this->call('UserTableSeeder');
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	}

}
