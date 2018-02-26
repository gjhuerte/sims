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

             //  1
        	array(
        		'name' => 'Set',
                'abbreviation' => 'SET',
        		'description' => 'A set is a well-defined collection of distinct objects.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
        	),

            //  2
        	array(
        		'name' => 'Piece',
                'abbreviation' => 'PCS',
        		'description' => 'separate or limited portion or quantity of something',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
        	),

            //  3
            array(
                'name' => 'Cans',
                'abbreviation' => 'CANS',
                'description' => 'a cylindrical metal container',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  4
            array(
                'name' => 'Bottle',
                'abbreviation' => 'BTL',
                'description' => 'a container, typically made of glass or plastic and with a narrow neck, used for storing drinks or other liquids',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  5
        	array(
        		'name' => 'Bundle',
                'abbreviation' => 'BUNDLE',
        		'description' => 'a package offering related products or services at a single price',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
        	),

            //  6
            array(
                'name' => 'Meters',
                'abbreviation' => 'MTRS',
                'description' => 'base unit of length in the International System of Units',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  7
            array(
                'name' => 'Boxes',
                'abbreviation' => 'BXS',
                'description' => 'a container with a flat base and sides, typically square or rectangular and having a lid.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  8
            array(
                'name' => '',
                'abbreviation' => 'RLS',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  9
            array(
                'name' => 'Pad',
                'abbreviation' => 'PAD',
                'description' => 'a number of sheets of blank paper fastened together at one edge, used for writing or drawing on.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  10
            array(
                'name' => 'Reams',
                'abbreviation' => 'RMS',
                'description' => 'a number of sheets of blank paper fastened together at one edge, used for writing or drawing on.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  11
            array(
                'name' => 'Cart',
                'abbreviation' => 'CART',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  12
            array(
                'name' => 'Spool',
                'abbreviation' => 'SPOOL',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),

            //  13
            array(
                'name' => 'Pack',
                'abbreviation' => 'PACK',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ), 

            //  14
            array(
                'name' => 'Unit',
                'abbreviation' => 'UNIT',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ), 

            //  15
            array(
                'name' => 'N/A',
                'abbreviation' => 'NONE',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            //  16
            array(
                'name' => 'Rolls',
                'abbreviation' => 'ROLLS',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            //  17
            array(
                'name' => 'Tubes',
                'abbreviation' => 'TUBES',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
        ]);
    }
}
