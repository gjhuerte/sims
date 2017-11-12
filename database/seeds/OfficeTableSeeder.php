<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class OfficeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            App\Office::truncate();
            App\Office::insert([
            array(
                  'code' => 'OP', 
                  'name'=> 'Office of the President',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OEVP', 
                  'name'=>  'Office of the Executive Vice President',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPAA', 
                  'name'=> 'Office of the Vice President for Academic Affairs',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPA', 
                  'name'=>  'Office of the Vice President for Administration',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPSAS', 
                  'name'=>  'Office of the Vice President for Student Affairs and Services',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPRED', 
                  'name'=>  'Office of the Vice President for Research, Extension and Development',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPBC', 
                  'name'=> 'Office of the Vice President for Branches and Campuses',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UBS', 
                  'name'=> 'Office of the University Board Secretary',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ULCO', 
                  'name'=>  'University Legal Counsel Office',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICTO', 
                  'name'=>  'Information and Communications Technology Office',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS', 
                  'name'=>  'Graduate School',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OU', 
                  'name'=>  'Open University',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CL', 
                  'name'=>  'College of Law',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF', 
                  'name'=> 'College of Accountancy and Finance',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAFA', 
                  'name'=>  'College of Architecture and Fine Arts',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL', 
                  'name'=> 'College of Arts and Letters',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA', 
                  'name'=> 'College of Business Administration',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC', 
                  'name'=> 'College of Communication',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CCIS', 
                  'name'=>  'College of Computer and Information Sciences',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COED', 
                  'name'=>  'College of Education',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COE', 
                  'name'=> 'College of Engineering',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CHK', 
                  'name'=> 'College of Human Kinetics',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPSPA', 
                  'name'=> 'College of Political Science and Public Administration',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS', 
                  'name'=>  'College of Science',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD', 
                  'name'=>  'College of Social Sciences and Development',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CTHTM', 
                  'name'=> 'College of Tourism, Hospitality and Transportation Management',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITECH', 
                  'name'=> 'Institute of Technology',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LHS', 
                  'name'=> 'Laboratory High School',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO', 
                  'name'=>  'Facilities Management Office',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD',
                  'name'=>  'Human Resources Management Department',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MDS', 
                  'name'=> 'Medical Services Department',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BAC', 
                  'name'=> 'Bids and Awards Committee',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GSO', 
                  'name'=> 'General Services Office',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ACC', 
                  'name'=> 'Accounting Office',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AMO', 
                  'name'=> 'Assets Management Office',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            )
            ]);
      }
}
