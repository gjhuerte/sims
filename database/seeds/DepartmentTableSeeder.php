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
                  'head' =>'Gary Antonio C. Lirio',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'1', 
                  'name'=>'Branch/Campus Accounting Section',
                  'abbreviation' =>'AD-BCAS',
                  'head' =>'Sandy A. Osorio',
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
                  'head' =>'Teresita Dg. Halog',
                  'designation' =>'Acting Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'1', 
                  'name'=>'Student Records Section',
                  'abbreviation' =>'AD-SRS',
                  'head' =>'Diosdado L. Martinez',
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
                  'head' =>'Mavel B. Besmonte',
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
                  'head' =>'Arturo F. Perez',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'5', 
                  'name'=>'Budget Technical Section',
                  'abbreviation' =>'BSO-BTS',
                  'head' =>'Maria Armi C. Roncal',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'7', 
                  'name'=>'Department of Architecture',
                  'abbreviation' =>'CAFA-DA',
                  'head' =>'Jocelyn A. Rivera-Lutap',
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
                  'head' =>'Gina G. Flandes',
                  'designation' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'6', 
                  'name'=>'Department of Basic Accounting',
                  'abbreviation' =>'CAF-DBA',
                  'head' =>'Lilian M. Litonjua',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'6', 
                  'name'=>'Department of Banking and Finance',
                  'abbreviation' =>'CAF-DBF',
                  'head' =>'Bernadette M. Panibio',
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
                  'head' =>'Gloria 0 Rante',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'6', 
                  'name'=>'CAF Laboratory',
                  'abbreviation' =>'CAF-LAB',
                  'head' =>'Glenn A. Magadia',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'8', 
                  'name'=>'Department of English and Foreign Languages',
                  'abbreviation' =>'CAL-DEFL',
                  'head' =>'Carlos A. Garcia',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'8', 
                  'name'=>'Department of Humanities and Philosophy',
                  'abbreviation' =>'CAL-DHP',
                  'head' =>'Joey S. Pinalas',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'8', 
                  'name'=>'Department of Theater Arts',
                  'abbreviation' =>'CAL-DTA',
                  'head' =>'Davidson G. Oliveros',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'8', 
                  'name'=>'Kagawaran ng Filipinolohiya',
                  'abbreviation' =>'CAL-KF',
                  'head' =>'Marvin 0 Lai',
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
                  'head' =>'Zenaida D. San Agustin',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'9', 
                  'name'=>'Department of Management',
                  'abbreviation' =>'CBA-DMan',
                  'head' =>'Cindy F. Soliman',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'9', 
                  'name'=>'Department of Marketing',
                  'abbreviation' =>'CBA-DMar',
                  'head' =>'Angelina 0 Goyenechea',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'9', 
                  'name'=>'Department of Office Administration',
                  'abbreviation' =>'CBA-DOA',
                  'head' =>'Ma. Lolita V. Abecia',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'9', 
                  'name'=>'CBA Graduate Program',
                  'abbreviation' =>'CBA-GRAD',
                  'head' =>'Guillermo 0 Bungato',
                  'designation' =>'Chairperson, Doctor in Business Administration',
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
                  'head' =>'Melvin C. Roxas',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'11', 
                  'name'=>'Department of Information Technology',
                  'abbreviation' =>'CCIS-DIT',
                  'head' =>'Rachel A. Nayre',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'11', 
                  'name'=>'CCIS Laboratory',
                  'abbreviation' =>'CCIS-LAB',
                  'head' =>'Carlo 0 Inovero',
                  'designation' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'Department of Computer Engineering',
                  'abbreviation' =>'CE-DCoE',
                  'head' =>'Julius S. Cansino',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'Department of Civil Engineering',
                  'abbreviation' =>'CE-DCvE',
                  'head' =>'Ramir M. Cruz',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'Department of Electronics Engineering',
                  'abbreviation' =>'CE-DEE',
                  'head' =>'Geoffrey T. Salvador',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'Department of Electrical Engineering',
                  'abbreviation' =>'CE-DElE',
                  'head' =>'Vilma C. Perez',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'Department of Engineering Sciences',
                  'abbreviation' =>'CE-DES',
                  'head' =>'Bernard C. Capellan',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'Department of Industrial Engineering',
                  'abbreviation' =>'CE-DIE',
                  'head' =>'Christopher 0 Mira',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'Department of Mechanical Engineering',
                  'abbreviation' =>'CE-DME',
                  'head' =>'Edwin 0 Esperanza',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'CE Laboratory',
                  'abbreviation' =>'CE-LAB-CE',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'CoE Laboratory',
                  'abbreviation' =>'CE-LAB-CoE',
                  'head' =>'Rolito L. Mahaguay',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'ECE Laboratory',
                  'abbreviation' =>'CE-LAB-ECE',
                  'head' =>'Ana Liza R. Publico',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'EE Laboratory',
                  'abbreviation' =>'CE-LAB-EE',
                  'head' =>'Jayson Bryan 0 Mutuc',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'IE Laboratory',
                  'abbreviation' =>'CE-LAB-IE',
                  'head' =>'Arvin Jay D.R. Austria',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'13', 
                  'name'=>'ME Laboratory',
                  'abbreviation' =>'CE-LAB-ME',
                  'head' =>'Jesus 0 Callanta',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'14', 
                  'name'=>'Department of Professional Program',
                  'abbreviation' =>'CHK-DPP',
                  'head' =>'Celia M. Rilles',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'14', 
                  'name'=>'Department of Service Physical Education',
                  'abbreviation' =>'CHK-DSPE',
                  'head' =>'Ma. Victoria Magno Caringal',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'14', 
                  'name'=>'Department of Sports Science',
                  'abbreviation' =>'CHK-DSS',
                  'head' =>'Antonio F. Enriquez',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'15', 
                  'name'=>'Legal Aide Section',
                  'abbreviation' =>'CL-LAS',
                  'head' =>'Maria Cristina R. Gimenez',
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
                  'head' =>'Nelson S. Baun',
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
                  'head' =>'Reynaldo A. Guerzon',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'10', 
                  'name'=>'Department of Broadcast Communication',
                  'abbreviation' =>'COC-DBC',
                  'head' =>'Ma. Lourdes Dp. Garcia',
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
                  'head' =>'Hemmady S. Mora',
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
                  'head' =>'Dennis O. Dumrique',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'12', 
                  'name'=>'Department of Elementary and Secondary Education',
                  'abbreviation' =>'CoEd-DESE',
                  'head' =>'Jennifor L. Aguilar',
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
                  'head' =>'Jennifor L. Aguilar',
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
                  'head' =>'Silvia C. Ambag',
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
                  'head' =>'Barbara P. Camacho',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'22', 
                  'name'=>'Psychological and Wellness Services',
                  'abbreviation' =>'CPS-PWS',
                  'head' =>'Cielito B. Buhain',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'17', 
                  'name'=>'Department of Biology',
                  'abbreviation' =>'CS-DB',
                  'head' =>'Lourdes V. Alvarez',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'17', 
                  'name'=>'Department of Food Technology',
                  'abbreviation' =>'CS-DFT',
                  'head' =>'Maria Susan P. Arevalo',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'17', 
                  'name'=>'Department of Mathematics and Statistics',
                  'abbreviation' =>'CS-DMS',
                  'head' =>'Emelita A. Isaac',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'17', 
                  'name'=>'Department of Nutrition and Dietetics',
                  'abbreviation' =>'CS-DND',
                  'head' =>'Esperanza Sj Lorenzo',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'17', 
                  'name'=>'Department of Physical Sciences',
                  'abbreviation' =>'CS-DPS',
                  'head' =>'Elizabeth P. Bisa',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'17', 
                  'name'=>'CS Laboratory',
                  'abbreviation' =>'CS-LAB',
                  'head' =>'Christian Jay 0 Cambiador',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'18', 
                  'name'=>'Department of Cooperatives and Social Development',
                  'abbreviation' =>'CSSD-DCSD',
                  'head' =>'Rebecca E. Palma',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'18', 
                  'name'=>'Department of Economics',
                  'abbreviation' =>'CSSD-DE',
                  'head' =>'Norie M. Maniego',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'18', 
                  'name'=>'Department of History',
                  'abbreviation' =>'CSSD-DH',
                  'head' =>'Raul Roland R. Sebastian',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'18', 
                  'name'=>'Department of Psychology',
                  'abbreviation' =>'CSSD-DP',
                  'head' =>'John Mark S. Distor',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'18', 
                  'name'=>'Department of Sociology',
                  'abbreviation' =>'CSSD-DS',
                  'head' =>'Mercedes Camille B. Ocampo',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'19', 
                  'name'=>'Department of Hospitality Management',
                  'abbreviation' =>'CTHTM-DHM',
                  'head' =>'Jesusa T. Castillo',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'19', 
                  'name'=>'Department of Tourism and Transportation Management',
                  'abbreviation' =>'CTHTM-DTTM',
                  'head' =>'Lizbette 0 Vergara',
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
                  'head' =>'Roland 0 Viray',
                  'designation' =>'Manager',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'23', 
                  'name'=>'Extension Monitoring and Evaluation Center',
                  'abbreviation' =>'EMO-EMEC',
                  'head' =>'Randy D. Sagun',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'23', 
                  'name'=>'Extension Support Center',
                  'abbreviation' =>'EMO-ESC',
                  'head' =>'Ester T. Dizon',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'24', 
                  'name'=>'Air-Condition Maintenance and Metal Works Section',
                  'abbreviation' =>'FAMO-ACMMWS',
                  'head' =>'Arlheth P. Delos Angeles',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'24', 
                  'name'=>'Building Maintenance Section',
                  'abbreviation' =>'FAMO-BMS',
                  'head' =>'Ronald D. Fernando',
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
                  'head' =>'Clint Michael F. Lacdang',
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
                  'head' =>'Merlita L. Palma',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'28', 
                  'name'=>'Graduate Program Chairs',
                  'abbreviation' =>'GS-GPC',
                  'head' =>'Ben B. Andres',
                  'designation' =>'Chairperson, Master in Industrial and Engineering Management Program',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'27', 
                  'name'=>'Community Relations Development Center',
                  'abbreviation' =>'GSO-CRDC',
                  'head' =>'Glenda D. Salorsano',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'27', 
                  'name'=>'Transportation and Motor Pool Section',
                  'abbreviation' =>'GSO-TMPS',
                  'head' =>'Sergie D. Quimpo',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'27', 
                  'name'=>'University Canteen Services Section',
                  'abbreviation' =>'GSO-UCSS',
                  'head' =>'Josephine N. Flores',
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
                  'head' =>'Marion 0 Cresencio',
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
                  'head' =>'Laura D. Galit',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'29', 
                  'name'=>'Personnel Welfare and Benefits Section',
                  'abbreviation' =>'HRMD-PWBS',
                  'head' =>'Joel M. Munsayac',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'29', 
                  'name'=>'Records Management Section',
                  'abbreviation' =>'HRMD-RMS',
                  'head' =>'Ruperto D. Carpio',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'29', 
                  'name'=>'Recruitment Section',
                  'abbreviation' =>'HRMD-RS',
                  'head' =>'Eduardo Dc. Figura',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'29', 
                  'name'=>'Training Section',
                  'abbreviation' =>'HRMD-TS',
                  'head' =>'Ireneo C. Delas Armas',
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
                  'head' =>'Audie B. Oliquino',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'39', 
                  'name'=>'Operations Audit Section',
                  'abbreviation' =>'IAO-OAS',
                  'head' =>'Maria Theresa D. Bongulto',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'31', 
                  'name'=>'Center for Creative Writing',
                  'abbreviation' =>'ICLS-CCW',
                  'head' =>'Merdeka Dc. Morales',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'31', 
                  'name'=>'Center for Language and Literary Studies',
                  'abbreviation' =>'ICLS-CLTS',
                  'head' =>'Renato C. Vibiesca',
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
                  'head' =>'Romeo P. Peña',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'30', 
                  'name'=>'Information Systems Development Section',
                  'abbreviation' =>'ICTO-ISDS',
                  'head' =>'Severino L. Martinez',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'30', 
                  'name'=>'Network and Systems Administration Section',
                  'abbreviation' =>'ICTO-NSAS',
                  'head' =>'Christian G. Ordanel',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'30', 
                  'name'=>'Operations Section',
                  'abbreviation' =>'ICTO-OPS',
                  'head' =>'Sally C. Mua',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'32', 
                  'name'=>'Center for Statistical Studies',
                  'abbreviation' =>'IDSA-CSS',
                  'head' =>'Edcon B. Baccay',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'32', 
                  'name'=>'Statistical Training Section',
                  'abbreviation' =>'IDSA-STS',
                  'head' =>'Aurea Z. Rosal',
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
                  'head' =>'Jomar 0 Adaya',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'38', 
                  'name'=>'Center for Technology Transfer and Enterprise Development',
                  'abbreviation' =>'IPMO-CTTED',
                  'head' =>'Perla B. Patriarca',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'38', 
                  'name'=>'Innovation, Technology and Commercialization Office',
                  'abbreviation' =>'IPMO-ITCO',
                  'head' =>'Joselinda 0 Golpeo',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'37', 
                  'name'=>'Evaluation and Monitoring Section',
                  'abbreviation' =>'IPO-EMS',
                  'head' =>'Anita H. Irinco',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'37', 
                  'name'=>'Planning Section',
                  'abbreviation' =>'IPO-PS',
                  'head' =>'Criselda M. Ligon',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'35', 
                  'name'=>'Center for Environmental Studies',
                  'abbreviation' =>'ISSD-CES',
                  'head' =>'Joey S. Pinalas',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'35', 
                  'name'=>'Center for Human Rights and Gender Studies',
                  'abbreviation' =>'ISSD-CHRGS',
                  'head' =>'Hilda F. San Gabriel',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'35', 
                  'name'=>'Center for Public Administration and Governance Studies',
                  'abbreviation' =>'ISSD-CPAGS',
                  'head' =>'Antonius C. Umali',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'35', 
                  'name'=>'Center for Peace and Poverty Alleviation Studies',
                  'abbreviation' =>'ISSD-CPPAS',
                  'head' =>'Raul Roland R. Sebastian',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'34', 
                  'name'=>'Center for Engineering and Technology Research',
                  'abbreviation' =>'ISTR-CETR',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'34', 
                  'name'=>'Center for Mathematics, Computing and Information Research',
                  'abbreviation' =>'ISTR-CMCIR',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'34', 
                  'name'=>'Center for Physical Sciences Research',
                  'abbreviation' =>'ISTR-CPSR',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'36', 
                  'name'=>'Department of Computer and Office Management',
                  'abbreviation' =>'ITech-DCOM',
                  'head' =>'Josephine 0 Dela Isla',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'36', 
                  'name'=>'Department of Engineering Technology',
                  'abbreviation' =>'ITech-DET',
                  'head' =>'Raymond L. Alfonso',
                  'designation' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'36', 
                  'name'=>'ITech Laboratory',
                  'abbreviation' =>'ITech-LAB',
                  'head' =>'Remegio C. Rios',
                  'designation' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'36', 
                  'name'=>'ITech Registrar and Admissions Office',
                  'abbreviation' =>'ITech-ROA',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'41', 
                  'name'=>'LHS Dental Clinic',
                  'abbreviation' =>'LHS-DC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'41', 
                  'name'=>'LHS Medical Clinic',
                  'abbreviation' =>'LHS-MC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'41', 
                  'name'=>'Office of the LHS Registrar',
                  'abbreviation' =>'LHS-R',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Administration Section',
                  'abbreviation' =>'LLRC-AdS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Archives Section',
                  'abbreviation' =>'LLRC-ArS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Computer Room Section',
                  'abbreviation' =>'LLRC-CRS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Circulation Section',
                  'abbreviation' =>'LLRC-CS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'PUP-CLFI E-Learning Center',
                  'abbreviation' =>'LLRC-Elearning',
                  'head' =>'Mary Grace L. Ferrer',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Filipiniana Section',
                  'abbreviation' =>'LLRC-FS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Library Operations',
                  'abbreviation' =>'LLRC-LOR',
                  'head' =>'Avelina N. Lupas',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Periodicals Section',
                  'abbreviation' =>'LLRC-PS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Reference Section',
                  'abbreviation' =>'LLRC-RS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'42', 
                  'name'=>'Technical Services Section',
                  'abbreviation' =>'LLRC-TSS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'44', 
                  'name'=>'Dental Services Section',
                  'abbreviation' =>'MSD-DSS',
                  'head' =>'Maria Rachael B. Jamandre',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'44', 
                  'name'=>'Medical Services Section',
                  'abbreviation' =>'MSD-MSS',
                  'head' =>'Mary Grace R. Roxas',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'44', 
                  'name'=>'Nurses',
                  'abbreviation' =>'MSD-NURSES',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'45', 
                  'name'=>'Civic Welfare Training Services',
                  'abbreviation' =>'NSTP-CWTS',
                  'head' =>'Jennifor L. Aguilar',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'45', 
                  'name'=>'Literacy Training Services',
                  'abbreviation' =>'NSTP-LTS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'45', 
                  'name'=>'Reserved Officers Training Course',
                  'abbreviation' =>'NSTP-ROTC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'46', 
                  'name'=>'Exchange and Study Program Section',
                  'abbreviation' =>'OIA-ESPS',
                  'head' =>'Regina B. Zuñiga',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'46', 
                  'name'=>'Parnership and Linkages Section',
                  'abbreviation' =>'OIA-PLS',
                  'head' =>'Ann Clarisse M. De Leon',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'48', 
                  'name'=>'Head Executive Assistant',
                  'abbreviation' =>'OP-HEA',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'49', 
                  'name'=>'Student Affairs',
                  'abbreviation' =>'OSS-SA',
                  'head' =>'Romulo B. Hubbard',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'49', 
                  'name'=>'Scholarship and Financial Assistance Services',
                  'abbreviation' =>'OSS-SFAS',
                  'head' =>'Lailanie G. Teves',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'49', 
                  'name'=>'Student Publications Section',
                  'abbreviation' =>'OSS-SPS',
                  'head' =>'Esther Soraya M. Ambion',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'E-Learning Portal',
                  'abbreviation' =>'OUS-ELP',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'50', 
                  'name'=>'Admission Services Section',
                  'abbreviation' =>'OUR-ADSS',
                  'head' =>'Adelio O. Sulit',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'50', 
                  'name'=>'Student Records Services',
                  'abbreviation' =>'OUR-SRS',
                  'head' =>'Jaime Y. Gonzales',
                  'designation' =>'Officer-In-Charge',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'OUS Academic Program Head',
                  'abbreviation' =>'OUS-APH',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'Institute for Continuing Professional Development',
                  'abbreviation' =>'OUS-ICPD',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'Instructional Materials Development Section',
                  'abbreviation' =>'OUS-IMD',
                  'head' =>'Anna Ruby P. Gapasin',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'Institute of Non-Traditional Studies and ETEEAP',
                  'abbreviation' =>'OUS-INE',
                  'head' =>'Remedios G. Ado',
                  'designation' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'Institute of Distance Education / Transnational Education',
                  'abbreviation' =>'OUS-IODET',
                  'head' =>'Carmencita L. Castolo',
                  'designation' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'Learning Management Section',
                  'abbreviation' =>'OUS-LMS',
                  'head' =>'Pedrito M. Tenerife',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'OUS Registrar and Admission Office',
                  'abbreviation' =>'OUS-RAO',
                  'head' =>'Lina S. Felices',
                  'designation' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'Research, Extension and Accreditation Office',
                  'abbreviation' =>'OUS-REAO',
                  'head' =>'Andrew C. Hernandez',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'57', 
                  'name'=>'OUS Secretary',
                  'abbreviation' =>'OUS-SEC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'52', 
                  'name'=>'Office of the Assistant to the VP for Administration',
                  'abbreviation' =>'OVPA-OAVPA',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'61', 
                  'name'=>'Bids and Awards Committee Secretariat',
                  'abbreviation' =>'PMO-BACSEC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'61', 
                  'name'=>'Contract Management Section',
                  'abbreviation' =>'PMO-CMS',
                  'head' =>'Fidel L. Esteban',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'61', 
                  'name'=>'Procurement Planning and Management Section',
                  'abbreviation' =>'PMO-PPMS',
                  'head' =>'Ma. Teresa M. Balasa',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'63', 
                  'name'=>'Editorial Section',
                  'abbreviation' =>'PO-ES',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'63', 
                  'name'=>'Layout and Design Section',
                  'abbreviation' =>'PO-LDS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'59', 
                  'name'=>'Electrical Design and Estimate Section',
                  'abbreviation' =>'PPDO-EDES',
                  'head' =>'Clint Michael F. Lacdang',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'59', 
                  'name'=>'Structural Design and Estimate Section',
                  'abbreviation' =>'PPDO-SDES',
                  'head' =>'Richmon B. Pangilinan',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'90', 
                  'name'=>'Accreditation Section for Branches and  Campus',
                  'abbreviation' =>'QAC-ASBC',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'90', 
                  'name'=>'Accreditation Section for Main',
                  'abbreviation' =>'QAC-ASM',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'90', 
                  'name'=>'Curriculum Planning and Development Section',
                  'abbreviation' =>'QAC-CPDS',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'92', 
                  'name'=>'Business Development Section',
                  'abbreviation' =>'RGO-BDS',
                  'head' =>'Annabelle A. Gordonas',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'92', 
                  'name'=>'Business Maintenance Section',
                  'abbreviation' =>'RGO-BMS',
                  'head' =>'Estefanie Lazo Cortez',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'91', 
                  'name'=>'Research Monitoring and Evaluation Center',
                  'abbreviation' =>'RMO-RMEC',
                  'head' =>'Iris Rowena 0 Bernardo',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'91', 
                  'name'=>'Research Support Center',
                  'abbreviation' =>'RMO-RSC',
                  'head' =>'Silvia C. Ambag',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'96', 
                  'name'=>'Administrative Sports Development and Wellness Services',
                  'abbreviation' =>'SDPO-ASDWS',
                  'head' =>'Rhene A. Camarador',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'96', 
                  'name'=>'Students Sports Development Services',
                  'abbreviation' =>'SDPO-SSDS',
                  'head' =>'Maureen I. Torres',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'94', 
                  'name'=>'SHS Registrar and Admission',
                  'abbreviation' =>'SHS-RA',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'93', 
                  'name'=>'Information and Investigation Unit',
                  'abbreviation' =>'SSO-IIU',
                  'head' =>'',
                  'designation' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'93', 
                  'name'=>'Main, Branches and Campuses Security Section',
                  'abbreviation' =>'SSO-MBCS',
                  'head' =>'Valentin P. Espina',
                  'designation' =>'Chief of Security for Main Campus',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'99', 
                  'name'=>'Drama and Performing Arts Section',
                  'abbreviation' =>'UCCA-DPAS',
                  'head' =>'Davidson G. Oliveros',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'99', 
                  'name'=>'Music Section',
                  'abbreviation' =>'UCCA-MS',
                  'head' =>'Leomar P. Requejo',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'office_id' =>'99', 
                  'name'=>'Visual Arts Section',
                  'abbreviation' =>'UCCA-VAS',
                  'head' =>'Jerielyn V. Reyes',
                  'designation' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
      ]);
      }
}

