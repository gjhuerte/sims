<?php

use App\Office;
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
            App\Office::delete();
            App\Office::insert([
                  array(
                  'code' => 'OP', 'name'=> 'Office of the President'
                  ),
                  array(
                  'code' => 'OEVP', 'name'=>  'Office of the Executive Vice President'
                  ),
                  array(
                   'code' => 'OVPAA', 'name'=> 'Office of the Vice President for Academic Affairs'
                  ),
                  array(
                   'code' => 'OVPA', 'name'=>  'Office of the Vice President for Administration'
                  ),
                  array(
                   'code' => 'OVPSAS', 'name'=>  'Office of the Vice President for Student Affairs and Services'
                  ),
                  array(
                   'code' => 'OVPRED', 'name'=>  'Office of the Vice President for Research, Extension and Development'
                  ),
                  array(
                   'code' => 'OVPBC', 'name'=> 'Office of the Vice President for Branches and Campuses'
                  ),
                  array(
                   'code' => 'UBS', 'name'=> 'Office of the University Board Secretary'
                  ),
                  array(
                   'code' => 'ULCO', 'name'=>  'University Legal Counsel Office'
                  ),
                  array(
                   'code' => 'ICTO', 'name'=>  'Information and Communications Technology Office'
                  ),
                  array(
                   'code' => 'GS', 'name'=>  'Graduate School'
                  ),
                  array(
                   'code' => 'OU', 'name'=>  'Open University'
                  ),
                  array(
                   'code' => 'CL', 'name'=>  'College of Law'
                  ),
                  array(
                   'code' => 'CAF', 'name'=> 'College of Accountancy and Finance'
                  ),
                  array(
                   'code' => 'CAFA', 'name'=>  'College of Architecture and Fine Arts'
                  ),
                  array(
                   'code' => 'CAL', 'name'=> 'College of Arts and Letters'
                  ),
                  array(
                   'code' => 'CBA', 'name'=> 'College of Business Administration'
                  ),
                  array(
                   'code' => 'COC', 'name'=> 'College of Communication'
                  ),
                  array(
                   'code' => 'CCIS', 'name'=>  'College of Computer and Information Sciences'
                  ),
                  array(
                   'code' => 'COED', 'name'=>  'College of Education'
                  ),
                  array(
                   'code' => 'COE', 'name'=> 'College of Engineering'
                  ),
                  array(
                   'code' => 'CHK', 'name'=> 'College of Human Kinetics'
                  ),
                  array(
                   'code' => 'CPSPA', 'name'=> 'College of Political Science and Public Administration'
                  ),
                  array(
                   'code' => 'CS', 'name'=>  'College of Science'
                  ),
                  array(
                   'code' => 'CSSD', 'name'=>  'College of Social Sciences and Development'
                  ),
                  array(
                   'code' => 'CTHTM', 'name'=> 'College of Tourism, Hospitality and Transportation Management'
                  ),
                  array(
                   'code' => 'ITECH', 'name'=> 'Institute of Technology'
                  ),
                  array(
                   'code' => 'LHS', 'name'=> 'Laboratory High School'
                  ),
                  array(
                   'code' => 'FAMO', 'name'=>  'Facilities Management Office'
                  ),
                  array(
                   'code' => 'HRMD', 'name'=>  'Human Resources Management Department'
                  ),
                  array(
                   'code' => 'MDS', 'name'=> 'Medical Services Department'
                  ),
                  array(
                   'code' => 'BAC', 'name'=> 'Bids and Awards Committee'
                  ),
                  array(
                   'code' => 'GSO', 'name'=> 'General Services Office'
                  ),
                  array(
                   'code' => 'ACC', 'name'=> 'Accounting Office'
                  ),
                  array(
                   'code' => 'AMO', 'name'=> 'Assets Management Office'
                  )
            ]);
      }
}
