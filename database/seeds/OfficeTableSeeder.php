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
            //delete users table records
            DB::table('office')->delete();
            //insert some dummy records
            DB::table('office')->insert([
                  array(
                  'deptcode' => 'OP', 'deptname'=> 'Office of the President'
                  ),
                  array(
                  'deptcode' => 'OEVP', 'deptname'=>  'Office of the Executive Vice President'
                  ),
                  array(
                   'deptcode' => 'OVPAA', 'deptname'=> 'Office of the Vice President for Academic Affairs'
                  ),
                  array(
                   'deptcode' => 'OVPA', 'deptname'=>  'Office of the Vice President for Administration'
                  ),
                  array(
                   'deptcode' => 'OVPSAS', 'deptname'=>  'Office of the Vice President for Student Affairs and Services'
                  ),
                  array(
                   'deptcode' => 'OVPRED', 'deptname'=>  'Office of the Vice President for Research, Extension and Development'
                  ),
                  array(
                   'deptcode' => 'OVPBC', 'deptname'=> 'Office of the Vice President for Branches and Campuses'
                  ),
                  array(
                   'deptcode' => 'UBS', 'deptname'=> 'Office of the University Board Secretary'
                  ),
                  array(
                   'deptcode' => 'ULCO', 'deptname'=>  'University Legal Counsel Office'
                  ),
                  array(
                   'deptcode' => 'ICTO', 'deptname'=>  'Information and Communications Technology Office'
                  ),
                  array(
                   'deptcode' => 'GS', 'deptname'=>  'Graduate School'
                  ),
                  array(
                   'deptcode' => 'OU', 'deptname'=>  'Open University'
                  ),
                  array(
                   'deptcode' => 'CL', 'deptname'=>  'College of Law'
                  ),
                  array(
                   'deptcode' => 'CAF', 'deptname'=> 'College of Accountancy and Finance'
                  ),
                  array(
                   'deptcode' => 'CAFA', 'deptname'=>  'College of Architecture and Fine Arts'
                  ),
                  array(
                   'deptcode' => 'CAL', 'deptname'=> 'College of Arts and Letters'
                  ),
                  array(
                   'deptcode' => 'CBA', 'deptname'=> 'College of Business Administration'
                  ),
                  array(
                   'deptcode' => 'COC', 'deptname'=> 'College of Communication'
                  ),
                  array(
                   'deptcode' => 'CCIS', 'deptname'=>  'College of Computer and Information Sciences'
                  ),
                  array(
                   'deptcode' => 'COED', 'deptname'=>  'College of Education'
                  ),
                  array(
                   'deptcode' => 'COE', 'deptname'=> 'College of Engineering'
                  ),
                  array(
                   'deptcode' => 'CHK', 'deptname'=> 'College of Human Kinetics'
                  ),
                  array(
                   'deptcode' => 'CPSPA', 'deptname'=> 'College of Political Science and Public Administration'
                  ),
                  array(
                   'deptcode' => 'CS', 'deptname'=>  'College of Science'
                  ),
                  array(
                   'deptcode' => 'CSSD', 'deptname'=>  'College of Social Sciences and Development'
                  ),
                  array(
                   'deptcode' => 'CTHTM', 'deptname'=> 'College of Tourism, Hospitality and Transportation Management'
                  ),
                  array(
                   'deptcode' => 'ITECH', 'deptname'=> 'Institute of Technology'
                  ),
                  array(
                   'deptcode' => 'LHS', 'deptname'=> 'Laboratory High School'
                  ),
                  array(
                   'deptcode' => 'FAMO', 'deptname'=>  'Facilities Management Office'
                  ),
                  array(
                   'deptcode' => 'HRMD', 'deptname'=>  'Human Resources Management Department'
                  ),
                  array(
                   'deptcode' => 'MDS', 'deptname'=> 'Medical Services Department'
                  ),
                  array(
                   'deptcode' => 'BAC', 'deptname'=> 'Bids and Awards Committee'
                  ),
                  array(
                   'deptcode' => 'GSO', 'deptname'=> 'General Services Office'
                  ),
                  array(
                   'deptcode' => 'ACC', 'deptname'=> 'Accounting Office'
                  ),
                  array(
                   'deptcode' => 'AMO', 'deptname'=> 'Assets Management Office'
                  )
            ]);
      }
}
