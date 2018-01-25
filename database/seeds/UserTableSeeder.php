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
				'status' =>'1',
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

			array(
				'username' => 'CCIS-LAB',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Carlo',
				'middlename' => '',
				'lastname' => 'Inovero',
				'email' => '',
				'status' =>'3',
				'office' => 'CCIS-LAB',
				'position' => 'Laboratory Head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'OVPF',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Marisa',
				'middlename' => 'J.',
				'lastname' => 'Legaspi',
				'email' => '',
				'status' =>'3',
				'office' => 'OVPF',
				'position' => 'Vice President for Finance',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'HEA-PMS',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Susan',
				'middlename' => '',
				'lastname' => 'Luna',
				'email' => '',
				'status' =>'3',
				'office' => 'HEA-PMS',
				'position' => 'Head',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'OVPSAS',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Edgardo',
				'middlename' => '',
				'lastname' => 'Latoza',
				'email' => '',
				'status' =>'3',
				'office' => 'OVPSAS',
				'position' => 'Assistant Vice President for Student Affairs and Services',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'OVPA',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Rosita',
				'middlename' => '',
				'lastname' => 'Canlas',
				'email' => '',
				'status' =>'3',
				'office' => 'OVPA',
				'position' => 'Assistant Vice President for Administration',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'HRMD',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Adam',
				'middlename' => '',
				'lastname' => 'Ramilo',
				'email' => '',
				'status' =>'3',
				'office' => 'HRMD',
				'position' => 'Director',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'AMO Office',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Virgilio',
				'middlename' => '',
				'lastname' => 'Mauricio',
				'email' => '',
				'status' =>'1',
				'office' => 'AMS',
				'position' => 'Chief',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'ACCOUNTING DEPT',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Christopher',
				'middlename' => '',
				'lastname' => 'Cahayon',
				'email' => '',
				'status' =>'3',
				'office' => 'AD',
				'position' => 'Director',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'PMO',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Henry',
				'middlename' => 'V.',
				'lastname' => 'Pascua',
				'email' => '',
				'status' =>'3',
				'office' => 'PMO',
				'position' => 'Director',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'CCIS',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Gisela May',
				'middlename' => 'A.',
				'lastname' => 'Albano',
				'email' => '',
				'status' =>'3',
				'office' => 'CCIS',
				'position' => 'Dean',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),	

			array(
				'username' => 'COLLEGE OF SCIENCE',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Lincoln',
				'middlename' => '',
				'lastname' => 'Bautista',
				'email' => '',
				'status' =>'3',
				'office' => 'CS',
				'position' => 'Dean',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'CCIS-DCS',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Melvin',
				'middlename' => '',
				'lastname' => 'Roxas',
				'email' => '',
				'status' =>'3',
				'office' => 'CCIS-DCS',
				'position' => 'Chairperson',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'ISTR Head',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Armin',
				'middlename' => '',
				'lastname' => 'Coronado',
				'email' => '',
				'status' =>'3',
				'office' => 'ISTR',
				'position' => 'Director',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

			array(
				'username' => 'ISTR',
				'password' => Hash::make('12345678'),
				'access' =>'3',
				'firstname' => 'Aleta',
				'middlename' => '',
				'lastname' => 'Fabregas',
				'email' => '',
				'status' =>'3',
				'office' => 'ISTR',
				'position' => 'Chief',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			),

		]);
	}



}
