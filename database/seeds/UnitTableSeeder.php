<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		App\Unit::truncate();
        App\Unit::insert([
        	array(
        		'name' => 'Set',
                'abbreviation' => 'SET',
        		'description' => 'A set is a well-defined collection of distinct objects.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
        	),

        	array(
        		'name' => 'Piece',
                'abbreviation' => 'PCS',
        		'description' => 'separate or limited portion or quantity of something',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
        	),

        	array(
        		'name' => 'Bundle',
                'abbreviation' => 'BUNDLE',
        		'description' => 'a package offering related products or services at a single price',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
        	),

            array(
                'name' => 'Meters',
                'abbreviation' => 'MTRS',
                'description' => 'base unit of length in the International System of Units',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            )
        ]);
    }
}
