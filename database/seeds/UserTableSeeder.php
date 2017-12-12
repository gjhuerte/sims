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
				'username' => 'admin',
				'password' => Hash::make('12345678'),
				'access' =>'0',
				'firstname' => 'Elliot',
				'middlename' => '',
				'lastname' => 'Alderson',
				'email' => 'elliotalderson@yahoo.com',
				'status' =>'1',
				'office' => 'ICTO',
				'position' => 'head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'amo',
				'password' => Hash::make('12345678'),
				'access' =>'1',
				'firstname' => 'Tyrion',
				'middlename' => '',
				'lastname' => 'Lannister',
				'email' => 'tyrionlannister@yahoo.com',
				'status' =>'1',
				'office' => 'AMO',
				'position' => 'head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'accounting',
				'password' => Hash::make('12345678'),
				'access' =>'2',
				'firstname' => 'Skyler',
				'middlename' => '',
				'lastname' => 'White',
				'email' => 'skylerwhite@yahoo.com',
				'status' =>'1',
				'office' => 'ACC',
				'position' => 'head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'ccis',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Carlo',
				'middlename' => '',
				'lastname' => 'Inovero',
				'email' => 'pup.ccis.server@gmail.com',
				'status' =>'3',
				'office' => 'CCIS',
				'position' => 'head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			)
		]);
	}



}
