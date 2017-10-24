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
		$this->call('SupplyTableSeeder');
		$this->call('OfficeTableSeeder');
		$this->call('POTableSeeder');
		$this->call('POSupplyTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('LanguageTableSeeder');
		$this->call('SettingsTableSeeder');

	}

}
