<?php
use App\PurchaseOrder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class POTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('purchaseorder')->delete();
		//insert some dummy records
		DB::table('purchaseorder')->insert([
			array( 'purchaseorderno' => 'P.O #16-12-0153 12/28/16', 'date' => '2017-01-24'),
			array( 'purchaseorderno' => 'P.O #16-12-0149 12/28/16', 'date' => '2017-01-25'),
			array( 'purchaseorderno' => 'P.O #16-12-0151 12/28/16', 'date' => '2017-02-10'),
			array( 'purchaseorderno' => 'P.O #16-12-0152 12/28/16', 'date' => '2017-02-23'),
			array( 'purchaseorderno' => 'P.O #17-04-0018 4/4/17', 'date' => '2017-04-18'),
			array( 'purchaseorderno' => 'P.O #17-04-0019 4/4/17', 'date' => '2017-04-17'),
			array( 'purchaseorderno' => 'P.O #17-04-0020 4/4/17', 'date' => '2017-04-19'),
			array( 'purchaseorderno' => 'P.O #17-04-0021 4/7/17', 'date' => '2017-04-24'),
			array( 'purchaseorderno' => 'P.O #16-12-0150 12/28/17', 'date' => '2017-06-22'),
			array( 'purchaseorderno' => 'P.O #17-04-0022 04/10/17', 'date' => '2017-04-10'),
			array( 'purchaseorderno' => 'APR PS17-00151', 'date' => '2017-01-11'),
			array( 'purchaseorderno' => 'APR PS17-00150', 'date' => '2017-01-11'),
			array( 'purchaseorderno' => 'APR PS17-02763', 'date' => '2017-04-24'),
			array( 'purchaseorderno' => 'APR PS17-02764', 'date' => '2017-04-24'),
			array( 'purchaseorderno' => 'APR PS17-0151', 'date' => '2017-01-11')
		]);


	}



}
