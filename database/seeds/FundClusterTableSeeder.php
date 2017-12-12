<?php

use Illuminate\Database\Seeder;

class FundClusterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FundCluster::insert([
        	array(
        		'code' => '101'
        	),
        	array(
        		'code' => '102'
        	),
        ]);
    }
}
