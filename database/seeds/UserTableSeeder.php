<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		App\User::truncate();
		App\User::insert([
			array(
				'username' => 'ADMIN',
				'password' => Hash::make('12345678'),
				'access' =>'0',
				'firstname' => 'Severino',
				'middlename' => '',
				'lastname' => 'Martinez',
				'email' => '',
				'status' => '1',
				'office' => 'ICTO',
				'position' => 'Head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'AMO',
				'password' => Hash::make('12345678'),
				'access' =>'1',
				'firstname' => 'Lerma',
				'middlename' => '',
				'lastname' => 'Malzan',
				'email' => '',
				'status' =>'1',
				'office' => 'AMS',
				'position' => 'Head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'ACCOUNTING',
				'password' => Hash::make('12345678'),
				'access' =>'2',
				'firstname' => 'Lemy',
				'middlename' => '',
				'lastname' => 'Medina',
				'email' => '',
				'status' =>'1',
				'office' => 'AD',
				'position' => 'Head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),
		]);
	}



}
