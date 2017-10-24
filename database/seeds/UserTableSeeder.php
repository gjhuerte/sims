<?php

use App\User;
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
		//delete users table records
		DB::table('user')->delete();
		//insert some dummy records

		DB::table('user')->insert([
			array(
				'username' => 'admin',
				'password' => Hash::make('12345678'),
				'accesslevel' =>'0',
				'firstname' => 'Elliot',
				'middlename' => '',
				'lastname' => 'Alderson',
				'email' => 'elliotalderson@yahoo.com',
				'status' =>'1',
				'office' => 'ICTO'
			),

			array(
				'username' => 'amo',
				'password' => Hash::make('12345678'),
				'accesslevel' =>'1',
				'firstname' => 'Tyrion',
				'middlename' => '',
				'lastname' => 'Lannister',
				'email' => 'tyrionlannister@yahoo.com',
				'status' =>'1',
				'office' => 'AMO'
			),

			array(
				'username' => 'accounting',
				'password' => Hash::make('12345678'),
				'accesslevel' =>'2',
				'firstname' => 'Skyler',
				'middlename' => '',
				'lastname' => 'White',
				'email' => 'skylerwhite@yahoo.com',
				'status' =>'1',
				'office' => 'ACC'
			),

			array(
				'username' => 'ccis',
				'password' => Hash::make('12345678'),
				'accesslevel' =>'3',
				'firstname' => 'Carlo',
				'middlename' => '',
				'lastname' => 'Inovero',
				'email' => 'pup.ccis.server@gmail.com',
				'status' =>'3',
				'office' => 'CCIS'
			)
		]);
	}



}
