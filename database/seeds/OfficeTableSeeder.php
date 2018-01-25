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
                  'code' => 'IODET-APC', 
                  'name'=>'Academic Program Chairs',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'INE-APC', 
                  'name'=>'Academic Program Coordinator',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AD', 
                  'name'=>'Accounting Department',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'QAC-ASBC', 
                  'name'=>'Accreditation Section for Branches and  Campus',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'QAC-ASM', 
                  'name'=>'Accreditation Section for Main',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-AdS', 
                  'name'=>'Administration Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SDPO-ASDWS', 
                  'name'=>'Administrative Sports Development and Wellness Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUR-ADSS', 
                  'name'=>'Admission Services Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ABG', 
                  'name'=>'Agency Blue Guard',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO-ACMMWS', 
                  'name'=>'Air-Condition Maintenance and Metal Works Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ARCDO', 
                  'name'=>'Alumni Relations and Career Development Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ARCDO-ARS', 
                  'name'=>'Alumni Relations Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-ArS', 
                  'name'=>'Archives Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'INE-A', 
                  'name'=>'Assessors',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AMS', 
                  'name'=>'Asset Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PMO-BACSEC', 
                  'name'=>'Bids and Awards Committee Secretariat',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AD-BCAS', 
                  'name'=>'Branch/Campus Accounting Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BSO-BOS', 
                  'name'=>'Budget Operations Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BSO', 
                  'name'=>'Budget Services Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BSO-BTS', 
                  'name'=>'Budget Technical Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'DelPilar-BGMS', 
                  'name'=>'Building and Grounds Maintenance Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO-BMS', 
                  'name'=>'Building Maintenance Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RGO-BDS', 
                  'name'=>'Business Development Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RGO-BMS', 
                  'name'=>'Business Maintenance Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF-LAB', 
                  'name'=>'CAF Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAFA-LAB', 
                  'name'=>'CAFA Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL-LAB', 
                  'name'=>'CAL Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ARCDO-CDPS', 
                  'name'=>'Career Development and Placement Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FMO-CDS', 
                  'name'=>'Cash Disbursement Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FMO-CRS', 
                  'name'=>'Cash Receipt Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-GRAD', 
                  'name'=>'CBA Graduate Program',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-LAB', 
                  'name'=>'CBA Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-R', 
                  'name'=>'CBA Registrar',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-SEC', 
                  'name'=>'CBA Secretary',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CCIS-LAB', 
                  'name'=>'CCIS Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICLS-CCW', 
                  'name'=>'Center for Creative Writing',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ILIR-CET', 
                  'name'=>'Center for Education and Trainings',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISTR-CETR', 
                  'name'=>'Center for Engineering and Technology Research',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISSD-CES', 
                  'name'=>'Center for Environmental Studies',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISSD-CHRGS', 
                  'name'=>'Center for Human Rights and Gender Studies',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ILIR-CLRP', 
                  'name'=>'Center for Labor Research and Publication',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICLS-CLTS', 
                  'name'=>'Center for Language and Literary Studies',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISTR-CLSR', 
                  'name'=>'Center for Life Sciences Research',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISTR-CMCIR', 
                  'name'=>'Center for Mathematics, Computing and Information Research',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISSD-CPPAS', 
                  'name'=>'Center for Peace and Poverty Alleviation Studies',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICLS-CPH', 
                  'name'=>'Center for Philosophy and Humanities',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISTR-CPSR', 
                  'name'=>'Center for Physical Sciences Research',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISSD-CPAGS', 
                  'name'=>'Center for Public Administration and Governance Studies',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICLS-CSH', 
                  'name'=>'Center for Social History',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IDSA-CSS', 
                  'name'=>'Center for Statistical Studies',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPMO-CTTED', 
                  'name'=>'Center for Technology Transfer and Enterprise Development',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AVPA-CRS', 
                  'name'=>'Central Records Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-CS', 
                  'name'=>'Circulation Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'NSTP-CWTS', 
                  'name'=>'Civic Welfare Training Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CL-R', 
                  'name'=>'CL Registrar',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CL-SEC', 
                  'name'=>'CL Secretary',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC-LAB', 
                  'name'=>'COC Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-LAB', 
                  'name'=>'CoE Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoED-GRAD', 
                  'name'=>'CoED Graduate Program',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoEd-LAB', 
                  'name'=>'CoED Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoED-R', 
                  'name'=>'CoED Registrar',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoED-REA', 
                  'name'=>'CoED Research, Extension and Accreditation',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoED-SEC', 
                  'name'=>'CoED Secretary',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF', 
                  'name'=>'College of Accountancy and Finance',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAFA', 
                  'name'=>'College of Architecture and Fine Arts',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL', 
                  'name'=>'College of Arts and Letters',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA', 
                  'name'=>'College of Business Administration',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC', 
                  'name'=>'College of Communication',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CCIS', 
                  'name'=>'College of Computer and Information Sciences',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoEd', 
                  'name'=>'College of Education',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE', 
                  'name'=>'College of Engineering',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CHK', 
                  'name'=>'College of Human Kinetics',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CL', 
                  'name'=>'College of Law',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPSPA', 
                  'name'=>'College of Political Science and Public Administration',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS', 
                  'name'=>'College of Science',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD', 
                  'name'=>'College of Social Sciences and Development',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CTHTM', 
                  'name'=>'College of Tourism, Hospitality and Transportation Management',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoA', 
                  'name'=>'Commission on Audit',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CMO', 
                  'name'=>'Communication Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GSO-CRDC', 
                  'name'=>'Community Relations Development Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-CRS', 
                  'name'=>'Computer Room Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO-CITBA', 
                  'name'=>'Condotel and ITech Building Administration Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PMO-CMS', 
                  'name'=>'Contract Management Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPS', 
                  'name'=>'Counseling and Psychological Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPA-GRAD', 
                  'name'=>'CPA Graduate Program',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPA-R', 
                  'name'=>'CPA Registrar',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPA-SEC', 
                  'name'=>'CPA Secretary',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CMO-CMS', 
                  'name'=>'Creative Media Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS-LAB', 
                  'name'=>'CS Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'QAC-CPDS', 
                  'name'=>'Curriculum Planning and Development Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MSD-DSS', 
                  'name'=>'Dental Services Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC-DAPR', 
                  'name'=>'Department of Advertising and Public Relations',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAFA-DA', 
                  'name'=>'Department of Architecture',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF-DBF', 
                  'name'=>'Department of Banking and Finance',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF-DBA', 
                  'name'=>'Department of Basic Accounting',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS-DB', 
                  'name'=>'Department of Biology',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC-DBC', 
                  'name'=>'Department of Broadcast Communication',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF-DBL', 
                  'name'=>'Department of Business Law',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoEd-DBTE', 
                  'name'=>'Department of Business Teacher Education',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-DCvE', 
                  'name'=>'Department of Civil Engineering',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC-DCR', 
                  'name'=>'Department of Communication Research',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITech-DCOM', 
                  'name'=>'Department of Computer and Office Management',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-DCoE', 
                  'name'=>'Department of Computer Engineering',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CCIS-DCS', 
                  'name'=>'Department of Computer Science',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD-DCSD', 
                  'name'=>'Department of Cooperatives and Social Development',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD-DE', 
                  'name'=>'Department of Economics',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-DElE', 
                  'name'=>'Department of Electrical Engineering',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-DEE', 
                  'name'=>'Department of Electronics Engineering',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoEd-DESE', 
                  'name'=>'Department of Elementary and Secondary Education',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-DES', 
                  'name'=>'Department of Engineering Sciences',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITech-DET', 
                  'name'=>'Department of Engineering Technology',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL-DEFL', 
                  'name'=>'Department of English and Foreign Languages',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-DEM', 
                  'name'=>'Department of Entrepreneurial Management',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAFA-DFA', 
                  'name'=>'Department of Fine Arts',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS-DFT', 
                  'name'=>'Department of Food Technology',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF-DHA', 
                  'name'=>'Department of Higher Accounting',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD-DH', 
                  'name'=>'Department of History',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CTHTM-DHM', 
                  'name'=>'Department of Hospitality Management',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL-DHP', 
                  'name'=>'Department of Humanities and Philosophy',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-DIE', 
                  'name'=>'Department of Industrial Engineering',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CCIS-DIT', 
                  'name'=>'Department of Information Technology',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC-DJ', 
                  'name'=>'Department of Journalism',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoEd-DLS', 
                  'name'=>'Department of Library Science',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-DMan', 
                  'name'=>'Department of Management',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-DMar', 
                  'name'=>'Department of Marketing',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS-DMS', 
                  'name'=>'Department of Mathematics and Statistics',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE-DME', 
                  'name'=>'Department of Mechanical Engineering',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS-DND', 
                  'name'=>'Department of Nutrition and Dietetics',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA-DOA', 
                  'name'=>'Department of Office Administration',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS-DPS', 
                  'name'=>'Department of Physical Sciences',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPA-DPE', 
                  'name'=>'Department of Political Economy',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPA-DPS', 
                  'name'=>'Department of Political Science',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CHK-DPP', 
                  'name'=>'Department of Professional Program',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD-DP', 
                  'name'=>'Department of Psychology',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPA-DPA', 
                  'name'=>'Department of Public Administration',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CHK-DSPE', 
                  'name'=>'Department of Service Physical Education',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD-DS', 
                  'name'=>'Department of Sociology',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CHK-DSS', 
                  'name'=>'Department of Sports Science',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL-DTA', 
                  'name'=>'Department of Theater Arts',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CTHTM-DTTM', 
                  'name'=>'Department of Tourism and Transportation Management',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UCCA-DPAS', 
                  'name'=>'Drama and Performing Arts Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PO-ES', 
                  'name'=>'Editorial Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OU-ELP', 
                  'name'=>'E-Learning Portal',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PPDO-EDES', 
                  'name'=>'Electrical Design and Estimate Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO-EMS', 
                  'name'=>'Electrical Maintenance Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPO-EMS', 
                  'name'=>'Evaluation and Monitoring Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OIA-ESPS', 
                  'name'=>'Exchange and Study Program Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'EMO', 
                  'name'=>'Extension Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'EMO-EMEC', 
                  'name'=>'Extension Monitoring and Evaluation Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'EMO-ESC', 
                  'name'=>'Extension Support Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO', 
                  'name'=>'Facility Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PUPFFAI', 
                  'name'=>'Federation of Faculty Association',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-FS', 
                  'name'=>'Filipiniana Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FMO', 
                  'name'=>'Fund Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AD-GAS', 
                  'name'=>'General Accounting Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GSO', 
                  'name'=>'General Services Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS-GPC', 
                  'name'=>'Graduate Program Chairs',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS', 
                  'name'=>'Graduate School',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO-GMS', 
                  'name'=>'Grounds Maintenance Section ',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS-R', 
                  'name'=>'GS Registrar',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS-REA', 
                  'name'=>'GS Research, Extension and Accreditation',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS-SEC', 
                  'name'=>'GS Secretary',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPS-GCS', 
                  'name'=>'Guidance and Counseling Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'DelPilar-Hasmin', 
                  'name'=>'Hasmin Hostel',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OP-HEA', 
                  'name'=>'Head Executive Assistant',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD', 
                  'name'=>'Human Resource Management Department',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICTO', 
                  'name'=>'Information and Communications Technology Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SSO-IIU', 
                  'name'=>'Information and Investigation Unit',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICTO-ISDS', 
                  'name'=>'Information Systems Development Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPMO-ITCO', 
                  'name'=>'Innovation, Technology and Commercialization Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-ICPD', 
                  'name'=>'Institute for Continuing Professional Development',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICLS', 
                  'name'=>'Institute for Cultural and Language Studies',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IDSA', 
                  'name'=>'Institute for Data and Statistical Analysis',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ILIR', 
                  'name'=>'Institute for Labor and Industrial Relations',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISTR', 
                  'name'=> 'Institute for Science and Technology Research',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISSD', 
                  'name'=>'Institute for Social Sciences and Development',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-IODET', 
                  'name'=>'Institute of Distance Education / Transnational Education',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-INE', 
                  'name'=>'Institute of Non-Traditional Studies and ETEEAP',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITech', 
                  'name'=>'Institute of Technology',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPO', 
                  'name'=>'Institutional Planning Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-IMD', 
                  'name'=>'Instructional Materials Development Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPMO', 
                  'name'=>'Intellectual Property Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IAO', 
                  'name'=>'Internal Audit Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITech-LAB', 
                  'name'=>'ITech Laboratory',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITech-ROA', 
                  'name'=>'ITech Registrar and Admissions Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'JS', 
                  'name'=>'Janitorial Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL-KF', 
                  'name'=>'Kagawaran ng Filipinolohiya',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LHS', 
                  'name'=>'Laboratory High School',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PO-LDS', 
                  'name'=>'Layout and Design Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-LMS', 
                  'name'=>'Learning Management Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CL-LAS', 
                  'name'=>'Legal Aide Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LHS-DC', 
                  'name'=>'LHS Dental Clinic',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LHS-MC', 
                  'name'=>'LHS Medical Clinic',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC', 
                  'name'=>'Library and Learning Resources Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-LOR', 
                  'name'=>'Library Operations',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO-LSMS', 
                  'name'=>'Lights and Sounds Maintenance Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'NSTP-LTS', 
                  'name'=>'Literacy Training Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'DelPilar', 
                  'name'=>'M. H. Del Pilar Campus',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SSO-MBCS', 
                  'name'=>'Main, Branches and Campuses Security Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IAO-MFA', 
                  'name'=>'Management and Financial Audit',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IAO-MIU', 
                  'name'=>'Management Inspection Unit',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICPD-MPS', 
                  'name'=>'Marketing and Promotions Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CMO-MRS', 
                  'name'=>'Media Relations Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MSD', 
                  'name'=>'Medical Services Department',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MSD-MSS', 
                  'name'=>'Medical Services Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UCCA-MS', 
                  'name'=>'Music Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'NSTP', 
                  'name'=>'National Service Training Program Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO-NDCCAS', 
                  'name'=>'NDC Campus Administration Section Chief (CEA, COC Buildings and Grounds)',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICTO-NSAS', 
                  'name'=>'Network and Systems Administration Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MSD-NURSES', 
                  'name'=>'Nurses',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OIA', 
                  'name'=>'Office of International Affairs',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPA-OAVPA', 
                  'name'=>'Office of the Assistant to the VP for Administration',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OEVP', 
                  'name'=>'Office of the Executive Vice President',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LHS-R', 
                  'name'=>'Office of the LHS Registrar',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OP', 
                  'name'=>'Office of the President',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OSS', 
                  'name'=>'Office of the Student Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUR', 
                  'name'=>'Office of the University Registrar',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPAA', 
                  'name'=>'Office of the Vice President for Academic Affairs',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPA', 
                  'name'=>'Office of the Vice President for Administration',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPBSC', 
                  'name'=>'Office of the Vice President for Branches and Satellite Campuses',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPF', 
                  'name'=>'Office of the Vice President for Finance',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPRED', 
                  'name'=>'Office of the Vice President for Research, Extension and Development',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPSAS', 
                  'name'=>'Office of the Vice President for Student Affairs and Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS', 
                  'name'=>'Open University System',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IAO-OAS', 
                  'name'=>'Operations Audit Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICTO-OPS', 
                  'name'=>'Operations Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-APH', 
                  'name'=>'OUS Academic Program Head',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-RAO', 
                  'name'=>'OUS Registrar and Admission Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-SEC', 
                  'name'=>'OUS Secretary',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IODET-PBC', 
                  'name'=>'Pamantasang Bayan Coordinators',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OIA-PLS', 
                  'name'=>'Parnership and Linkages Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PASUC', 
                  'name'=>'PASUC Evaluation Committee',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AD-PS', 
                  'name'=>'Payroll Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD-PMES', 
                  'name'=>'Performance Monitoring and Evaluation Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-PS', 
                  'name'=>'Periodicals Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD-PWBS', 
                  'name'=>'Personnel Welfare and Benefits Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PPDO', 
                  'name'=>'Physical Planning and Development Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPO-PS', 
                  'name'=>'Planning Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HEA-PMS', 
                  'name'=>'Presidential Management Staff',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PRINTING', 
                  'name'=>'Printing Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PMO', 
                  'name'=>'Procurement Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PMO-PPMS', 
                  'name'=>'Procurement Planning and Management Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AMS-POE', 
                  'name'=>'Property Office Extension',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PFO', 
                  'name'=>'Provident Fund Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPS-PWS', 
                  'name'=>'Psychological and Wellness Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PO', 
                  'name'=>'Publications Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PUP Acad', 
                  'name'=>'PUP Academic',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PUP Admin', 
                  'name'=>'PUP Administrative',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AF', 
                  'name'=>'PUP ALFONSO, CAVITE CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FEDAAPI', 
                  'name'=>'PUP Alumni Association',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BS', 
                  'name'=>'PUP BANSUD, ORIENTAL MINDORO CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BT', 
                  'name'=>'PUP BATAAN BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BN', 
                  'name'=>'PUP BIÑAN, LAGUNA CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BPO', 
                  'name'=>'PUP BPO Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CB', 
                  'name'=>'PUP CABIAO, NUEVA ECIJA CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CLN', 
                  'name'=>'PUP CALAUAN, LAGUNA CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GL', 
                  'name'=>'PUP GENERAL LUNA, QUEZON CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LQ', 
                  'name'=>'PUP LOPEZ, QUEZON BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MG', 
                  'name'=>'PUP MARAGONDON, CAVITE BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ML', 
                  'name'=>'PUP MULANAY, QUEZON BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PQ', 
                  'name'=>'PUP PARAÑAQUE CITY CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PL', 
                  'name'=>'PUP PULILAN, BULACAN CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CM', 
                  'name'=>'PUP QUEZON CITY BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RG', 
                  'name'=>'PUP RAGAY, CAMARINES SUR BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SB', 
                  'name'=>'PUP SABLAYAN, OCCIDENTAL MINDORO CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SJ', 
                  'name'=>'PUP SAN JUAN CITY CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SP', 
                  'name'=>'PUP SAN PEDRO, LAGUNA CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SM', 
                  'name'=>'PUP STA. MARIA, BULACAN CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SR', 
                  'name'=>'PUP STA. ROSA, LAGUNA CAMPUS',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ST', 
                  'name'=>'PUP STO. TOMAS, BATANGAS BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'TG', 
                  'name'=>'PUP TAGUIG CITY BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UN', 
                  'name'=>'PUP UNISAN, QUEZON BRANCH',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-Elearning', 
                  'name'=>'PUP-CLFI E-Learning Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'QAC', 
                  'name'=>'Quality Assurance Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD-RMS', 
                  'name'=>'Records Management Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD-RS', 
                  'name'=>'Recruitment Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-RS', 
                  'name'=>'Reference Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RMO', 
                  'name'=>'Research Management Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RMO-RMEC', 
                  'name'=>'Research Monitoring and Evaluation Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RMO-RSC', 
                  'name'=>'Research Support Center',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS-REAO', 
                  'name'=>'Research, Extension and Accreditation Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'NSTP-ROTC', 
                  'name'=>'Reserved Officers Training Course',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RGO', 
                  'name'=>'Resource Generation Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SSO', 
                  'name'=>'Safety and Security Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OSS-SFAS', 
                  'name'=>'Scholarship and Financial Assistance Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SHS', 
                  'name'=>'Senior High School',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SHS-RA', 
                  'name'=>'SHS Registrar and Admission',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SPPO', 
                  'name'=>'Special Programs and Projects Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SDPO', 
                  'name'=>'Sports Development Program Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IDSA-STS', 
                  'name'=>'Statistical Training Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PPDO-SDES', 
                  'name'=>'Structural Design and Estimate Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OSS-SA', 
                  'name'=>'Student Affairs',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OSS-SPS', 
                  'name'=>'Student Publications Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AD-SRS', 
                  'name'=>'Student Records Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUR-SRS', 
                  'name'=>'Student Records Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SA', 
                  'name'=>'Students',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SDPO-SSDS', 
                  'name'=>'Students Sports Development Services',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC-TSS', 
                  'name'=>'Technical Services Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD-TS', 
                  'name'=>'Training Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICPD-TS', 
                  'name'=>'Training Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GSO-TMPS', 
                  'name'=>'Transportation and Motor Pool Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UBS', 
                  'name'=>'University Board Secretary',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GSO-UCSS', 
                  'name'=>'University Canteen Services Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UCCA', 
                  'name'=>'University Center for Culture and the Arts',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ULCO', 
                  'name'=>'University Legal Counsel Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UCCA-VAS', 
                  'name'=>'Visual Arts Section',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            ]);
      }
}
