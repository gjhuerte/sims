<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Supplier::truncate();
        App\Supplier::insert([
        	array(
        		'name' => 'Department of Budget and Management',
        		'address' => 'Boncodin Hall, General Solano St., San Miguel, Manila',
        		'contact' => '(02) 657-3300',
        		'website' => 'www.dbm.gov.ph '
        	),
        ]);
    }
}
