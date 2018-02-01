<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DepartmentTableSeeder extends Seeder {

	/** 
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            App\Department::truncate();
            App\Department::insert([
			array(
                  'office_id' =>'34', 
                  'name'=>'Center for Life Sciences Research',
                  'abbreviation' =>'ISTR-CLSR',
                  'head' =>'GARY ANTONIO C. LIRIO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'1', 
                  'name'=>'Branch/Campus Accounting Section',
                  'abbreviation' =>'AD-BCAS',
                  'head' =>'SANDY A. OSORIO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'1', 
                  'name'=>'General Accounting Section',
                  'abbreviation' =>'AD-GAS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'1', 
                  'name'=>'Payroll Section',
                  'abbreviation' =>'AD-PS',
                  'head' =>'LUDIVINO L. APANAY',
                  'designation' =>'Head of the Systems Development and Maintenance for Payroll Services',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'1', 
                  'name'=>'Student Records Section',
                  'abbreviation' =>'AD-SRS',
                  'head' =>'DIOSDADO L. MARTINEZ',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'4', 
                  'name'=>'Property Office Extension',
                  'abbreviation' =>'AMS-POE',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'3', 
                  'name'=>'Alumni Relations Services',
                  'abbreviation' =>'ARCDO-ARS',
                  'head' =>'MAVEL B. BESMONTE',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'3', 
                  'name'=>'Career Development and Placement Services',
                  'abbreviation' =>'ARCDO-CDPS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'5', 
                  'name'=>'Budget Operations Section',
                  'abbreviation' =>'BSO-BOS',
                  'head' =>'ARTURO F. PEREZ',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'5', 
                  'name'=>'Budget Technical Section',
                  'abbreviation' =>'BSO-BTS',
                  'head' =>'MARIA ARMI C. RONCAL',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'7', 
                  'name'=>'Department of Architecture',
                  'abbreviation' =>'CAFA-DA',
                  'head' =>'JOCELYN A. RIVERA-LUTAP',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'7', 
                  'name'=>'Department of Fine Arts',
                  'abbreviation' =>'CAFA-DFA',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'7', 
                  'name'=>'CAFA Laboratory',
                  'abbreviation' =>'CAFA-LAB',
                  'head' =>'GINA G. FLANDES',
                  'designation' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'6', 
                  'name'=>'Department of Basic Accounting',
                  'abbreviation' =>'CAF-DBA',
                  'head' =>'LILIAN M. LITONJUA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'6', 
                  'name'=>'Department of Banking and Finance',
                  'abbreviation' =>'CAF-DBF',
                  'head' =>'BERNADETTE M. PANIBIO',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'6', 
                  'name'=>'Department of Business Law',
                  'abbreviation' =>'CAF-DBL',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'6', 
                  'name'=>'Department of Higher Accounting',
                  'abbreviation' =>'CAF-DHA',
                  'head' =>'GLORIA 0 RANTE',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'6', 
                  'name'=>'CAF Laboratory',
                  'abbreviation' =>'CAF-LAB',
                  'head' =>'GLENN A. MAGADIA',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'8', 
                  'name'=>'Department of English and Foreign Languages',
                  'abbreviation' =>'CAL-DEFL',
                  'head' =>'CARLOS A. GARCIA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'8', 
                  'name'=>'Department of Humanities and Philosophy',
                  'abbreviation' =>'CAL-DHP',
                  'head' =>'JOEY S. PINALAS',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'8', 
                  'name'=>'Department of Theater Arts',
                  'abbreviation' =>'CAL-DTA',
                  'head' =>'DAVIDSON G. OLIVEROS',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'8', 
                  'name'=>'Kagawaran ng Filipinolohiya',
                  'abbreviation' =>'CAL-KF',
                  'head' =>'MARVIN 0 LAI',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'8', 
                  'name'=>'CAL Laboratory',
                  'abbreviation' =>'CAL-LAB',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'Department of Entrepreneurial Management',
                  'abbreviation' =>'CBA-DEM',
                  'head' =>'ZENAIDA D. SAN AGUSTIN',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'Department of Management',
                  'abbreviation' =>'CBA-DMan',
                  'head' =>'CINDY F. SOLIMAN',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'Department of Marketing',
                  'abbreviation' =>'CBA-DMar',
                  'head' =>'ANGELINA 0 GOYENECHEA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'Department of Office Administration',
                  'abbreviation' =>'CBA-DOA',
                  'head' =>'MA. LOLITA V. ABECIA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'CBA Graduate Program',
                  'abbreviation' =>'CBA-GRAD',
                  'head' =>'GUILLERMO 0 BUNGATO',
                  'designation' =>'Chairperson, Master in Business Administration Program',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'CBA Laboratory',
                  'abbreviation' =>'CBA-LAB',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'CBA Registrar',
                  'abbreviation' =>'CBA-R',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'9', 
                  'name'=>'CBA Secretary',
                  'abbreviation' =>'CBA-SEC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'11', 
                  'name'=>'Department of Computer Science',
                  'abbreviation' =>'CCIS-DCS',
                  'head' =>'MELVIN C. ROXAS',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'11', 
                  'name'=>'Department of Information Technology',
                  'abbreviation' =>'CCIS-DIT',
                  'head' =>'RACHEL A. NAYRE',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'11', 
                  'name'=>'CCIS Laboratory',
                  'abbreviation' =>'CCIS-LAB',
                  'head' =>'CARLO 0 INOVERO',
                  'designation' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'Department of Computer Engineering',
                  'abbreviation' =>'CE-DCoE',
                  'head' =>'JULIUS S. CANSINO',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'Department of Civil Engineering',
                  'abbreviation' =>'CE-DCvE',
                  'head' =>'RAMIR M. CRUZ',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'Department of Electronics Engineering',
                  'abbreviation' =>'CE-DEE',
                  'head' =>'GEOFFREY T. SALVADOR',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'Department of Electrical Engineering',
                  'abbreviation' =>'CE-DElE',
                  'head' =>'VILMA C. PEREZ',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'Department of Engineering Sciences',
                  'abbreviation' =>'CE-DES',
                  'head' =>'BERNARD C. CAPELLAN',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'Department of Industrial Engineering',
                  'abbreviation' =>'CE-DIE',
                  'head' =>'CHRISTOPHER 0 MIRA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'Department of Mechanical Engineering',
                  'abbreviation' =>'CE-DME',
                  'head' =>'EDWIN 0 ESPERANZA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'CE Laboratory',
                  'abbreviation' =>'CE-LAB',
                  'head' =>'ARVIN JAY D.R. AUSTRIA',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'CoE Laboratory',
                  'abbreviation' =>'CE-LAB',
                  'head' =>'ARVIN JAY D.R. AUSTRIA',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'ECE Laboratory',
                  'abbreviation' =>'CE-LAB',
                  'head' =>'ARVIN JAY D.R. AUSTRIA',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'EE Laboratory',
                  'abbreviation' =>'CE-LAB',
                  'head' =>'ARVIN JAY D.R. AUSTRIA',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'IE Laboratory',
                  'abbreviation' =>'CE-LAB',
                  'head' =>'ARVIN JAY D.R. AUSTRIA',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'13', 
                  'name'=>'ME Laboratory',
                  'abbreviation' =>'CE-LAB',
                  'head' =>'ARVIN JAY D.R. AUSTRIA',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'14', 
                  'name'=>'Department of Professional Program',
                  'abbreviation' =>'CHK-DPP',
                  'head' =>'CELIA M. RILLES',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'14', 
                  'name'=>'Department of Service Physical Education',
                  'abbreviation' =>'CHK-DSPE',
                  'head' =>'MA. VICTORIA MAGNO CARINGAL',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'14', 
                  'name'=>'Department of Sports Science',
                  'abbreviation' =>'CHK-DSS',
                  'head' =>'ANTONIO F. ENRIQUEZ',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'15', 
                  'name'=>'Legal Aide Section',
                  'abbreviation' =>'CL-LAS',
                  'head' =>'MARIA CRISTINA R. GIMENEZ',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'15', 
                  'name'=>'CL Registrar',
                  'abbreviation' =>'CL-R',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'15', 
                  'name'=>'CL Secretary',
                  'abbreviation' =>'CL-SEC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'21', 
                  'name'=>'Creative Media Services',
                  'abbreviation' =>'CMO-CMS',
                  'head' =>'NELSON S. BAUN',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'21', 
                  'name'=>'Media Relations Services',
                  'abbreviation' =>'CMO-MRS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'10', 
                  'name'=>'Department of Advertising and Public Relations',
                  'abbreviation' =>'COC-DAPR',
                  'head' =>'REYNALDO A. GUERZON',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'10', 
                  'name'=>'Department of Broadcast Communication',
                  'abbreviation' =>'COC-DBC',
                  'head' =>'MA. LOURDES DP. GARCIA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'10', 
                  'name'=>'Department of Communication Research',
                  'abbreviation' =>'COC-DCR',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'10', 
                  'name'=>'Department of Journalism',
                  'abbreviation' =>'COC-DJ',
                  'head' =>'HEMMADY S. MORA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'10', 
                  'name'=>'COC Laboratory',
                  'abbreviation' =>'COC-LAB',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'Department of Business Teacher Education',
                  'abbreviation' =>'CoEd-DBTE',
                  'head' =>'DENNIS O. DUMRIQUE',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'Department of Elementary and Secondary Education',
                  'abbreviation' =>'CoEd-DESE',
                  'head' =>'JENNIFOR L. AGUILAR',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'Department of Library Science',
                  'abbreviation' =>'CoEd-DLS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'CoED Graduate Program',
                  'abbreviation' =>'CoED-GRAD',
                  'head' =>'JENNIFOR L. AGUILAR',
                  'designation' =>'Chairperson, Master of Arts in Filipino Program',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'CoED Laboratory',
                  'abbreviation' =>'CoEd-LAB',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'CoED Registrar',
                  'abbreviation' =>'CoED-R',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'CoED Research, Extension and Accreditation',
                  'abbreviation' =>'CoED-REA',
                  'head' =>'SILVIA C. AMBAG',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'12', 
                  'name'=>'CoED Secretary',
                  'abbreviation' =>'CoED-SEC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'22', 
                  'name'=>'Guidance and Counseling Services',
                  'abbreviation' =>'CPS-GCS',
                  'head' =>'BARBARA P. CAMACHO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'22', 
                  'name'=>'Psychological and Wellness Services',
                  'abbreviation' =>'CPS-PWS',
                  'head' =>'CIELITO B. BUHAIN',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'17', 
                  'name'=>'Department of Biology',
                  'abbreviation' =>'CS-DB',
                  'head' =>'LOURDES V. ALVAREZ',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'17', 
                  'name'=>'Department of Food Technology',
                  'abbreviation' =>'CS-DFT',
                  'head' =>'MARIA SUSAN P. AREVALO',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'17', 
                  'name'=>'Department of Mathematics and Statistics',
                  'abbreviation' =>'CS-DMS',
                  'head' =>'EMELITA A. ISAAC',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'17', 
                  'name'=>'Department of Nutrition and Dietetics',
                  'abbreviation' =>'CS-DND',
                  'head' =>'ESPERANZA SJ LORENZO',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'17', 
                  'name'=>'Department of Physical Sciences',
                  'abbreviation' =>'CS-DPS',
                  'head' =>'ELIZABETH P. BISA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'17', 
                  'name'=>'CS Laboratory',
                  'abbreviation' =>'CS-LAB',
                  'head' =>'ZENAIDA A. AGCAOILI',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'18', 
                  'name'=>'Department of Cooperatives and Social Development',
                  'abbreviation' =>'CSSD-DCSD',
                  'head' =>'REBECCA E. PALMA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'18', 
                  'name'=>'Department of Economics',
                  'abbreviation' =>'CSSD-DE',
                  'head' =>'NORIE M. MANIEGO',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'18', 
                  'name'=>'Department of History',
                  'abbreviation' =>'CSSD-DH',
                  'head' =>'RAUL ROLAND R. SEBASTIAN',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'18', 
                  'name'=>'Department of Psychology',
                  'abbreviation' =>'CSSD-DP',
                  'head' =>'JOHN MARK S. DISTOR',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'18', 
                  'name'=>'Department of Sociology',
                  'abbreviation' =>'CSSD-DS',
                  'head' =>'MERCEDES CAMILLE B. OCAMPO',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'19', 
                  'name'=>'Department of Hospitality Management',
                  'abbreviation' =>'CTHTM-DHM',
                  'head' =>'JESUSA T. CASTILLO',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'19', 
                  'name'=>'Department of Tourism and Transportation Management',
                  'abbreviation' =>'CTHTM-DTTM',
                  'head' =>'LIZBETTE 0 VERGARA',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'43', 
                  'name'=>'Building and Grounds Maintenance Section',
                  'abbreviation' =>'DelPilar-BGMS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'43', 
                  'name'=>'Hasmin Hostel',
                  'abbreviation' =>'DelPilar-Hasmin',
                  'head' =>'AMY MENDO MONTEZON',
                  'designation' =>'Assistant Manager',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'23', 
                  'name'=>'Extension Monitoring and Evaluation Center',
                  'abbreviation' =>'EMO-EMEC',
                  'head' =>'RANDY D. SAGUN',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'23', 
                  'name'=>'Extension Support Center',
                  'abbreviation' =>'EMO-ESC',
                  'head' =>'ESTER T. DIZON',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'24', 
                  'name'=>'Air-Condition Maintenance and Metal Works Section',
                  'abbreviation' =>'FAMO-ACMMWS',
                  'head' =>'ARLHETH P. DELOS ANGELES',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'24', 
                  'name'=>'Building Maintenance Section',
                  'abbreviation' =>'FAMO-BMS',
                  'head' =>'RONALD D. FERNANDO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'24', 
                  'name'=>'Condotel and ITech Building Administration Section',
                  'abbreviation' =>'FAMO-CITBA',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'24', 
                  'name'=>'Electrical Maintenance Section',
                  'abbreviation' =>'FAMO-EMS',
                  'head' =>'CLINT MICHAEL F. LACDANG',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'24', 
                  'name'=>'Grounds Maintenance Section ',
                  'abbreviation' =>'FAMO-GMS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'24', 
                  'name'=>'Lights and Sounds Maintenance Section',
                  'abbreviation' =>'FAMO-LSMS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'24', 
                  'name'=>'NDC Campus Administration Section Chief (CEA, COC Buildings and Grounds)',
                  'abbreviation' =>'FAMO-NDCCAS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'26', 
                  'name'=>'Cash Disbursement Section',
                  'abbreviation' =>'FMO-CDS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'26', 
                  'name'=>'Cash Receipt Section',
                  'abbreviation' =>'FMO-CRS',
                  'head' =>'MERLITA L. PALMA',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'28', 
                  'name'=>'Graduate Program Chairs',
                  'abbreviation' =>'GS-GPC',
                  'head' =>'BEN B. ANDRES',
                  'designation' =>'Chairperson, Master in Industrial and Engineering Management Program',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'27', 
                  'name'=>'Community Relations Development Center',
                  'abbreviation' =>'GSO-CRDC',
                  'head' =>'GLENDA D. SALORSANO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'27', 
                  'name'=>'Transportation and Motor Pool Section',
                  'abbreviation' =>'GSO-TMPS',
                  'head' =>'SERGIE D. QUIMPO',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'27', 
                  'name'=>'University Canteen Services Section',
                  'abbreviation' =>'GSO-UCSS',
                  'head' =>'JOSEPHINE N. FLORES',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'28', 
                  'name'=>'GS Registrar',
                  'abbreviation' =>'GS-R',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'28', 
                  'name'=>'GS Research, Extension and Accreditation',
                  'abbreviation' =>'GS-REA',
                  'head' =>'MARION 0 CRESENCIO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'28', 
                  'name'=>'GS Secretary',
                  'abbreviation' =>'GS-SEC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'29', 
                  'name'=>'Performance Monitoring and Evaluation Section',
                  'abbreviation' =>'HRMD-PMES',
                  'head' =>'LAURA D. GALIT',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'29', 
                  'name'=>'Personnel Welfare and Benefits Section',
                  'abbreviation' =>'HRMD-PWBS',
                  'head' =>'JOEL M. MUNSAYAC',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'29', 
                  'name'=>'Records Management Section',
                  'abbreviation' =>'HRMD-RMS',
                  'head' =>'RUPERTO D. CARPIO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'29', 
                  'name'=>'Recruitment Section',
                  'abbreviation' =>'HRMD-RS',
                  'head' =>'EDUARDO DC. FIGURA',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'29', 
                  'name'=>'Training Section',
                  'abbreviation' =>'HRMD-TS',
                  'head' =>'IRENEO C. DELAS ARMAS',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'39', 
                  'name'=>'Management and Financial Audit',
                  'abbreviation' =>'IAO-MFA',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'39', 
                  'name'=>'Management Inspection Unit',
                  'abbreviation' =>'IAO-MIU',
                  'head' =>'AUDIE B. OLIQUINO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'39', 
                  'name'=>'Operations Audit Section',
                  'abbreviation' =>'IAO-OAS',
                  'head' =>'MARIA THERESA D. BONGULTO',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'31', 
                  'name'=>'Center for Creative Writing',
                  'abbreviation' =>'ICLS-CCW',
                  'head' =>'MERDEKA DC. MORALES',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'31', 
                  'name'=>'Center for Language and Literary Studies',
                  'abbreviation' =>'ICLS-CLTS',
                  'head' =>'RENATO C. VIBIESCA',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'31', 
                  'name'=>'Center for Philosophy and Humanities',
                  'abbreviation' =>'ICLS-CPH',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'31', 
                  'name'=>'Center for Social History',
                  'abbreviation' =>'ICLS-CSH',
                  'head' =>'ROMEO P. PEÑA',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'30', 
                  'name'=>'Information Systems Development Section',
                  'abbreviation' =>'ICTO-ISDS',
                  'head' =>'SEVERINO L. MARTINEZ',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'30', 
                  'name'=>'Network and Systems Administration Section',
                  'abbreviation' =>'ICTO-NSAS',
                  'head' =>'CHRISTIAN G. ORDANEL',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'30', 
                  'name'=>'Operations Section',
                  'abbreviation' =>'ICTO-OPS',
                  'head' =>'SALLY C. MUA',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'32', 
                  'name'=>'Center for Statistical Studies',
                  'abbreviation' =>'IDSA-CSS',
                  'head' =>'EDCON B. BACCAY',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'32', 
                  'name'=>'Statistical Training Section',
                  'abbreviation' =>'IDSA-STS',
                  'head' =>'AUREA Z. ROSAL',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'33', 
                  'name'=>'Center for Education and Trainings',
                  'abbreviation' =>'ILIR-CET',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
			array(
                  'office_id' =>'33', 
                  'name'=>'Center for Labor Research and Publication',
                  'abbreviation' =>'ILIR-CLRP',
                  'head' =>'JOMAR 0 ADAYA',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),

      ]);
      }
}

