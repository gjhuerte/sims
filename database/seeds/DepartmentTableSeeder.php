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
            App\Office::insert([
		array(
                  'head_office' =>'34', 
                  'name'=>'Center for Life Sciences Research',
                  'code' =>'ISTR-CLSR',
                  'head' =>'Gary Antonio C. Lirio',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'1', 
                  'name'=>'Branch/Campus Accounting Section',
                  'code' =>'AD-BCAS',
                  'head' =>'Sandy A. Osorio',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'1', 
                  'name'=>'General Accounting Section',
                  'code' =>'AD-GAS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'1', 
                  'name'=>'Payroll Section',
                  'code' =>'AD-PS',
                  'head' =>'Teresita Dg. Halog',
                  'head_title' =>'Acting Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'1', 
                  'name'=>'Student Records Section',
                  'code' =>'AD-SRS',
                  'head' =>'Diosdado L. Martinez',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'4', 
                  'name'=>'Property Office Extension',
                  'code' =>'AMS-POE',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'3', 
                  'name'=>'Alumni Relations Services',
                  'code' =>'ARCDO-ARS',
                  'head' =>'Mavel B. Besmonte',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'3', 
                  'name'=>'Career Development and Placement Services',
                  'code' =>'ARCDO-CDPS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'5', 
                  'name'=>'Budget Operations Section',
                  'code' =>'BSO-BOS',
                  'head' =>'Arturo F. Perez',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'5', 
                  'name'=>'Budget Technical Section',
                  'code' =>'BSO-BTS',
                  'head' =>'Maria Armi C. Roncal',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'7', 
                  'name'=>'Department of Architecture',
                  'code' =>'CAFA-DA',
                  'head' =>'Jocelyn A. Rivera-Lutap',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'7', 
                  'name'=>'Department of Fine Arts',
                  'code' =>'CAFA-DFA',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'7', 
                  'name'=>'CAFA Laboratory',
                  'code' =>'CAFA-LAB',
                  'head' =>'Gina G. Flandes',
                  'head_title' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'6', 
                  'name'=>'Department of Basic Accounting',
                  'code' =>'CAF-DBA',
                  'head' =>'Lilian M. Litonjua',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'6', 
                  'name'=>'Department of Banking and Finance',
                  'code' =>'CAF-DBF',
                  'head' =>'Bernadette M. Panibio',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'6', 
                  'name'=>'Department of Business Law',
                  'code' =>'CAF-DBL',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'6', 
                  'name'=>'Department of Higher Accounting',
                  'code' =>'CAF-DHA',
                  'head' =>'Gloria 0 Rante',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'6', 
                  'name'=>'CAF Laboratory',
                  'code' =>'CAF-LAB',
                  'head' =>'Glenn A. Magadia',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'8', 
                  'name'=>'Department of English and Foreign Languages',
                  'code' =>'CAL-DEFL',
                  'head' =>'Carlos A. Garcia',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'8', 
                  'name'=>'Department of Humanities and Philosophy',
                  'code' =>'CAL-DHP',
                  'head' =>'Joey S. Pinalas',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'8', 
                  'name'=>'Department of Theater Arts',
                  'code' =>'CAL-DTA',
                  'head' =>'Davidson G. Oliveros',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'8', 
                  'name'=>'Kagawaran ng Filipinolohiya',
                  'code' =>'CAL-KF',
                  'head' =>'Marvin 0 Lai',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'8', 
                  'name'=>'CAL Laboratory',
                  'code' =>'CAL-LAB',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'Department of Entrepreneurial Management',
                  'code' =>'CBA-DEM',
                  'head' =>'Zenaida D. San Agustin',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'Department of Management',
                  'code' =>'CBA-DMan',
                  'head' =>'Cindy F. Soliman',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'Department of Marketing',
                  'code' =>'CBA-DMar',
                  'head' =>'Angelina 0 Goyenechea',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'Department of Office Administration',
                  'code' =>'CBA-DOA',
                  'head' =>'Ma. Lolita V. Abecia',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'CBA Graduate Program',
                  'code' =>'CBA-GRAD',
                  'head' =>'Guillermo 0 Bungato',
                  'head_title' =>'Chairperson, Doctor in Business Administration',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'CBA Laboratory',
                  'code' =>'CBA-LAB',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'CBA Registrar',
                  'code' =>'CBA-R',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'9', 
                  'name'=>'CBA Secretary',
                  'code' =>'CBA-SEC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'11', 
                  'name'=>'Department of Computer Science',
                  'code' =>'CCIS-DCS',
                  'head' =>'Melvin C. Roxas',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'11', 
                  'name'=>'Department of Information Technology',
                  'code' =>'CCIS-DIT',
                  'head' =>'Rachel A. Nayre',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'11', 
                  'name'=>'CCIS Laboratory',
                  'code' =>'CCIS-LAB',
                  'head' =>'Carlo 0 Inovero',
                  'head_title' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'Department of Computer Engineering',
                  'code' =>'CE-DCoE',
                  'head' =>'Julius S. Cansino',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'Department of Civil Engineering',
                  'code' =>'CE-DCvE',
                  'head' =>'Ramir M. Cruz',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'Department of Electronics Engineering',
                  'code' =>'CE-DEE',
                  'head' =>'Geoffrey T. Salvador',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'Department of Electrical Engineering',
                  'code' =>'CE-DElE',
                  'head' =>'Vilma C. Perez',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'Department of Engineering Sciences',
                  'code' =>'CE-DES',
                  'head' =>'Bernard C. Capellan',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'Department of Industrial Engineering',
                  'code' =>'CE-DIE',
                  'head' =>'Christopher 0 Mira',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'Department of Mechanical Engineering',
                  'code' =>'CE-DME',
                  'head' =>'Edwin 0 Esperanza',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'CE Laboratory',
                  'code' =>'CE-LAB-CE',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'CoE Laboratory',
                  'code' =>'CE-LAB-CoE',
                  'head' =>'Rolito L. Mahaguay',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'ECE Laboratory',
                  'code' =>'CE-LAB-ECE',
                  'head' =>'Ana Liza R. Publico',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'EE Laboratory',
                  'code' =>'CE-LAB-EE',
                  'head' =>'Jayson Bryan 0 Mutuc',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'IE Laboratory',
                  'code' =>'CE-LAB-IE',
                  'head' =>'Arvin Jay D.R. Austria',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'13', 
                  'name'=>'ME Laboratory',
                  'code' =>'CE-LAB-ME',
                  'head' =>'Jesus 0 Callanta',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'14', 
                  'name'=>'Department of Professional Program',
                  'code' =>'CHK-DPP',
                  'head' =>'Celia M. Rilles',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'14', 
                  'name'=>'Department of Service Physical Education',
                  'code' =>'CHK-DSPE',
                  'head' =>'Ma. Victoria Magno Caringal',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'14', 
                  'name'=>'Department of Sports Science',
                  'code' =>'CHK-DSS',
                  'head' =>'Antonio F. Enriquez',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'15', 
                  'name'=>'Legal Aide Section',
                  'code' =>'CL-LAS',
                  'head' =>'Maria Cristina R. Gimenez',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'15', 
                  'name'=>'CL Registrar',
                  'code' =>'CL-R',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'15', 
                  'name'=>'CL Secretary',
                  'code' =>'CL-SEC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'21', 
                  'name'=>'Creative Media Services',
                  'code' =>'CMO-CMS',
                  'head' =>'Nelson S. Baun',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'21', 
                  'name'=>'Media Relations Services',
                  'code' =>'CMO-MRS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'10', 
                  'name'=>'Department of Advertising and Public Relations',
                  'code' =>'COC-DAPR',
                  'head' =>'Reynaldo A. Guerzon',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'10', 
                  'name'=>'Department of Broadcast Communication',
                  'code' =>'COC-DBC',
                  'head' =>'Ma. Lourdes Dp. Garcia',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'10', 
                  'name'=>'Department of Communication Research',
                  'code' =>'COC-DCR',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'10', 
                  'name'=>'Department of Journalism',
                  'code' =>'COC-DJ',
                  'head' =>'Hemmady S. Mora',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'10', 
                  'name'=>'COC Laboratory',
                  'code' =>'COC-LAB',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'Department of Business Teacher Education',
                  'code' =>'CoEd-DBTE',
                  'head' =>'Dennis O. Dumrique',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'Department of Elementary and Secondary Education',
                  'code' =>'CoEd-DESE',
                  'head' =>'Jennifor L. Aguilar',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'Department of Library Science',
                  'code' =>'CoEd-DLS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'CoED Graduate Program',
                  'code' =>'CoED-GRAD',
                  'head' =>'Jennifor L. Aguilar',
                  'head_title' =>'Chairperson, Master of Arts in Filipino Program',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'CoED Laboratory',
                  'code' =>'CoEd-LAB',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'CoED Registrar',
                  'code' =>'CoED-R',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'CoED Research, Extension and Accreditation',
                  'code' =>'CoED-REA',
                  'head' =>'Silvia C. Ambag',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'12', 
                  'name'=>'CoED Secretary',
                  'code' =>'CoED-SEC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'22', 
                  'name'=>'Guidance and Counseling Services',
                  'code' =>'CPS-GCS',
                  'head' =>'Barbara P. Camacho',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'22', 
                  'name'=>'Psychological and Wellness Services',
                  'code' =>'CPS-PWS',
                  'head' =>'Cielito B. Buhain',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'17', 
                  'name'=>'Department of Biology',
                  'code' =>'CS-DB',
                  'head' =>'Lourdes V. Alvarez',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'17', 
                  'name'=>'Department of Food Technology',
                  'code' =>'CS-DFT',
                  'head' =>'Maria Susan P. Arevalo',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'17', 
                  'name'=>'Department of Mathematics and Statistics',
                  'code' =>'CS-DMS',
                  'head' =>'Emelita A. Isaac',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'17', 
                  'name'=>'Department of Nutrition and Dietetics',
                  'code' =>'CS-DND',
                  'head' =>'Esperanza Sj Lorenzo',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'17', 
                  'name'=>'Department of Physical Sciences',
                  'code' =>'CS-DPS',
                  'head' =>'Elizabeth P. Bisa',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'17', 
                  'name'=>'CS Laboratory',
                  'code' =>'CS-LAB',
                  'head' =>'Christian Jay 0 Cambiador',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'18', 
                  'name'=>'Department of Cooperatives and Social Development',
                  'code' =>'CSSD-DCSD',
                  'head' =>'Rebecca E. Palma',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'18', 
                  'name'=>'Department of Economics',
                  'code' =>'CSSD-DE',
                  'head' =>'Norie M. Maniego',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'18', 
                  'name'=>'Department of History',
                  'code' =>'CSSD-DH',
                  'head' =>'Raul Roland R. Sebastian',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'18', 
                  'name'=>'Department of Psychology',
                  'code' =>'CSSD-DP',
                  'head' =>'John Mark S. Distor',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'18', 
                  'name'=>'Department of Sociology',
                  'code' =>'CSSD-DS',
                  'head' =>'Mercedes Camille B. Ocampo',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'19', 
                  'name'=>'Department of Hospitality Management',
                  'code' =>'CTHTM-DHM',
                  'head' =>'Jesusa T. Castillo',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'19', 
                  'name'=>'Department of Tourism and Transportation Management',
                  'code' =>'CTHTM-DTTM',
                  'head' =>'Lizbette 0 Vergara',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'43', 
                  'name'=>'Building and Grounds Maintenance Section',
                  'code' =>'DelPilar-BGMS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'43', 
                  'name'=>'Hasmin Hostel',
                  'code' =>'DelPilar-Hasmin',
                  'head' =>'Roland 0 Viray',
                  'head_title' =>'Manager',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'23', 
                  'name'=>'Extension Monitoring and Evaluation Center',
                  'code' =>'EMO-EMEC',
                  'head' =>'Randy D. Sagun',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'23', 
                  'name'=>'Extension Support Center',
                  'code' =>'EMO-ESC',
                  'head' =>'Ester T. Dizon',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'24', 
                  'name'=>'Air-Condition Maintenance and Metal Works Section',
                  'code' =>'FAMO-ACMMWS',
                  'head' =>'Arlheth P. Delos Angeles',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'24', 
                  'name'=>'Building Maintenance Section',
                  'code' =>'FAMO-BMS',
                  'head' =>'Ronald D. Fernando',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'24', 
                  'name'=>'Condotel and ITech Building Administration Section',
                  'code' =>'FAMO-CITBA',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'24', 
                  'name'=>'Electrical Maintenance Section',
                  'code' =>'FAMO-EMS',
                  'head' =>'Clint Michael F. Lacdang',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'24', 
                  'name'=>'Grounds Maintenance Section ',
                  'code' =>'FAMO-GMS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'24', 
                  'name'=>'Lights and Sounds Maintenance Section',
                  'code' =>'FAMO-LSMS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'24', 
                  'name'=>'NDC Campus Administration Section Chief (CEA, COC Buildings and Grounds)',
                  'code' =>'FAMO-NDCCAS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'26', 
                  'name'=>'Cash Disbursement Section',
                  'code' =>'FMO-CDS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'26', 
                  'name'=>'Cash Receipt Section',
                  'code' =>'FMO-CRS',
                  'head' =>'Merlita L. Palma',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'28', 
                  'name'=>'Graduate Program Chairs',
                  'code' =>'GS-GPC',
                  'head' =>'Ben B. Andres',
                  'head_title' =>'Chairperson, Master in Industrial and Engineering Management Program',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'27', 
                  'name'=>'Community Relations Development Center',
                  'code' =>'GSO-CRDC',
                  'head' =>'Glenda D. Salorsano',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'27', 
                  'name'=>'Transportation and Motor Pool Section',
                  'code' =>'GSO-TMPS',
                  'head' =>'Sergie D. Quimpo',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'27', 
                  'name'=>'University Canteen Services Section',
                  'code' =>'GSO-UCSS',
                  'head' =>'Josephine N. Flores',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'28', 
                  'name'=>'GS Registrar',
                  'code' =>'GS-R',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'28', 
                  'name'=>'GS Research, Extension and Accreditation',
                  'code' =>'GS-REA',
                  'head' =>'Marion 0 Cresencio',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'28', 
                  'name'=>'GS Secretary',
                  'code' =>'GS-SEC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'29', 
                  'name'=>'Performance Monitoring and Evaluation Section',
                  'code' =>'HRMD-PMES',
                  'head' =>'Laura D. Galit',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'29', 
                  'name'=>'Personnel Welfare and Benefits Section',
                  'code' =>'HRMD-PWBS',
                  'head' =>'Joel M. Munsayac',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'29', 
                  'name'=>'Records Management Section',
                  'code' =>'HRMD-RMS',
                  'head' =>'Ruperto D. Carpio',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'29', 
                  'name'=>'Recruitment Section',
                  'code' =>'HRMD-RS',
                  'head' =>'Eduardo Dc. Figura',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'29', 
                  'name'=>'Training Section',
                  'code' =>'HRMD-TS',
                  'head' =>'Ireneo C. Delas Armas',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'39', 
                  'name'=>'Management and Financial Audit',
                  'code' =>'IAO-MFA',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'39', 
                  'name'=>'Management Inspection Unit',
                  'code' =>'IAO-MIU',
                  'head' =>'Audie B. Oliquino',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'39', 
                  'name'=>'Operations Audit Section',
                  'code' =>'IAO-OAS',
                  'head' =>'Maria Theresa D. Bongulto',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'31', 
                  'name'=>'Center for Creative Writing',
                  'code' =>'ICLS-CCW',
                  'head' =>'Merdeka Dc. Morales',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'31', 
                  'name'=>'Center for Language and Literary Studies',
                  'code' =>'ICLS-CLTS',
                  'head' =>'Renato C. Vibiesca',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'31', 
                  'name'=>'Center for Philosophy and Humanities',
                  'code' =>'ICLS-CPH',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'31', 
                  'name'=>'Center for Social History',
                  'code' =>'ICLS-CSH',
                  'head' =>'Romeo P. Peña',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'30', 
                  'name'=>'Information Systems Development Section',
                  'code' =>'ICTO-ISDS',
                  'head' =>'Severino L. Martinez',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'30', 
                  'name'=>'Network and Systems Administration Section',
                  'code' =>'ICTO-NSAS',
                  'head' =>'Christian G. Ordanel',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'30', 
                  'name'=>'Operations Section',
                  'code' =>'ICTO-OPS',
                  'head' =>'Sally C. Mua',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'32', 
                  'name'=>'Center for Statistical Studies',
                  'code' =>'IDSA-CSS',
                  'head' =>'Edcon B. Baccay',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'32', 
                  'name'=>'Statistical Training Section',
                  'code' =>'IDSA-STS',
                  'head' =>'Aurea Z. Rosal',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'33', 
                  'name'=>'Center for Education and Trainings',
                  'code' =>'ILIR-CET',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'33', 
                  'name'=>'Center for Labor Research and Publication',
                  'code' =>'ILIR-CLRP',
                  'head' =>'Jomar 0 Adaya',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'38', 
                  'name'=>'Center for Technology Transfer and Enterprise Development',
                  'code' =>'IPMO-CTTED',
                  'head' =>'Perla B. Patriarca',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'38', 
                  'name'=>'Innovation, Technology and Commercialization Office',
                  'code' =>'IPMO-ITCO',
                  'head' =>'Joselinda 0 Golpeo',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'37', 
                  'name'=>'Evaluation and Monitoring Section',
                  'code' =>'IPO-EMS',
                  'head' =>'Anita H. Irinco',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'37', 
                  'name'=>'Planning Section',
                  'code' =>'IPO-PS',
                  'head' =>'Criselda M. Ligon',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'35', 
                  'name'=>'Center for Environmental Studies',
                  'code' =>'ISSD-CES',
                  'head' =>'Joey S. Pinalas',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'35', 
                  'name'=>'Center for Human Rights and Gender Studies',
                  'code' =>'ISSD-CHRGS',
                  'head' =>'Hilda F. San Gabriel',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'35', 
                  'name'=>'Center for Public Administration and Governance Studies',
                  'code' =>'ISSD-CPAGS',
                  'head' =>'Antonius C. Umali',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'35', 
                  'name'=>'Center for Peace and Poverty Alleviation Studies',
                  'code' =>'ISSD-CPPAS',
                  'head' =>'Raul Roland R. Sebastian',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'34', 
                  'name'=>'Center for Engineering and Technology Research',
                  'code' =>'ISTR-CETR',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'34', 
                  'name'=>'Center for Mathematics, Computing and Information Research',
                  'code' =>'ISTR-CMCIR',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'34', 
                  'name'=>'Center for Physical Sciences Research',
                  'code' =>'ISTR-CPSR',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'36', 
                  'name'=>'Department of Computer and Office Management',
                  'code' =>'ITech-DCOM',
                  'head' =>'Josephine 0 Dela Isla',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'36', 
                  'name'=>'Department of Engineering Technology',
                  'code' =>'ITech-DET',
                  'head' =>'Raymond L. Alfonso',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'36', 
                  'name'=>'ITech Laboratory',
                  'code' =>'ITech-LAB',
                  'head' =>'Remegio C. Rios',
                  'head_title' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'36', 
                  'name'=>'ITech Registrar and Admissions Office',
                  'code' =>'ITech-ROA',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'41', 
                  'name'=>'LHS Dental Clinic',
                  'code' =>'LHS-DC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'41', 
                  'name'=>'LHS Medical Clinic',
                  'code' =>'LHS-MC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'41', 
                  'name'=>'Office of the LHS Registrar',
                  'code' =>'LHS-R',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Administration Section',
                  'code' =>'LLRC-AdS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Archives Section',
                  'code' =>'LLRC-ArS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Computer Room Section',
                  'code' =>'LLRC-CRS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Circulation Section',
                  'code' =>'LLRC-CS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'PUP-CLFI E-Learning Center',
                  'code' =>'LLRC-Elearning',
                  'head' =>'Mary Grace L. Ferrer',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Filipiniana Section',
                  'code' =>'LLRC-FS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Library Operations',
                  'code' =>'LLRC-LOR',
                  'head' =>'Avelina N. Lupas',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Periodicals Section',
                  'code' =>'LLRC-PS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Reference Section',
                  'code' =>'LLRC-RS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'42', 
                  'name'=>'Technical Services Section',
                  'code' =>'LLRC-TSS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'44', 
                  'name'=>'Dental Services Section',
                  'code' =>'MSD-DSS',
                  'head' =>'Maria Rachael B. Jamandre',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'44', 
                  'name'=>'Medical Services Section',
                  'code' =>'MSD-MSS',
                  'head' =>'Mary Grace R. Roxas',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'44', 
                  'name'=>'Nurses',
                  'code' =>'MSD-NURSES',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'45', 
                  'name'=>'Civic Welfare Training Services',
                  'code' =>'NSTP-CWTS',
                  'head' =>'Jennifor L. Aguilar',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'45', 
                  'name'=>'Literacy Training Services',
                  'code' =>'NSTP-LTS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'45', 
                  'name'=>'Reserved Officers Training Course',
                  'code' =>'NSTP-ROTC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'46', 
                  'name'=>'Exchange and Study Program Section',
                  'code' =>'OIA-ESPS',
                  'head' =>'Regina B. Zuñiga',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'46', 
                  'name'=>'Parnership and Linkages Section',
                  'code' =>'OIA-PLS',
                  'head' =>'Ann Clarisse M. De Leon',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'48', 
                  'name'=>'Head Executive Assistant',
                  'code' =>'OP-HEA',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'49', 
                  'name'=>'Student Affairs',
                  'code' =>'OSS-SA',
                  'head' =>'Romulo B. Hubbard',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'49', 
                  'name'=>'Scholarship and Financial Assistance Services',
                  'code' =>'OSS-SFAS',
                  'head' =>'Lailanie G. Teves',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'49', 
                  'name'=>'Student Publications Section',
                  'code' =>'OSS-SPS',
                  'head' =>'Esther Soraya M. Ambion',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'E-Learning Portal',
                  'code' =>'OUS-ELP',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'50', 
                  'name'=>'Admission Services Section',
                  'code' =>'OUR-ADSS',
                  'head' =>'Adelio O. Sulit',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'50', 
                  'name'=>'Student Records Services',
                  'code' =>'OUR-SRS',
                  'head' =>'Jaime Y. Gonzales',
                  'head_title' =>'Officer-In-Charge',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'OUS Academic Program Head',
                  'code' =>'OUS-APH',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'Institute for Continuing Professional Development',
                  'code' =>'OUS-ICPD',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'Instructional Materials Development Section',
                  'code' =>'OUS-IMD',
                  'head' =>'Anna Ruby P. Gapasin',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'Institute of Non-Traditional Studies and ETEEAP',
                  'code' =>'OUS-INE',
                  'head' =>'Remedios G. Ado',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'Institute of Distance Education / Transnational Education',
                  'code' =>'OUS-IODET',
                  'head' =>'Carmencita L. Castolo',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'Learning Management Section',
                  'code' =>'OUS-LMS',
                  'head' =>'Pedrito M. Tenerife',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'OUS Registrar and Admission Office',
                  'code' =>'OUS-RAO',
                  'head' =>'Lina S. Felices',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'Research, Extension and Accreditation Office',
                  'code' =>'OUS-REAO',
                  'head' =>'Andrew C. Hernandez',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'57', 
                  'name'=>'OUS Secretary',
                  'code' =>'OUS-SEC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'52', 
                  'name'=>'Office of the Assistant to the VP for Administration',
                  'code' =>'OVPA-OAVPA',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'61', 
                  'name'=>'Bids and Awards Committee Secretariat',
                  'code' =>'PMO-BACSEC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'61', 
                  'name'=>'Contract Management Section',
                  'code' =>'PMO-CMS',
                  'head' =>'Fidel L. Esteban',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'61', 
                  'name'=>'Procurement Planning and Management Section',
                  'code' =>'PMO-PPMS',
                  'head' =>'Ma. Teresa M. Balasa',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'63', 
                  'name'=>'Editorial Section',
                  'code' =>'PO-ES',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'63', 
                  'name'=>'Layout and Design Section',
                  'code' =>'PO-LDS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'59', 
                  'name'=>'Electrical Design and Estimate Section',
                  'code' =>'PPDO-EDES',
                  'head' =>'Clint Michael F. Lacdang',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'59', 
                  'name'=>'Structural Design and Estimate Section',
                  'code' =>'PPDO-SDES',
                  'head' =>'Richmon B. Pangilinan',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'90', 
                  'name'=>'Accreditation Section for Branches and  Campus',
                  'code' =>'QAC-ASBC',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'90', 
                  'name'=>'Accreditation Section for Main',
                  'code' =>'QAC-ASM',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'90', 
                  'name'=>'Curriculum Planning and Development Section',
                  'code' =>'QAC-CPDS',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'92', 
                  'name'=>'Business Development Section',
                  'code' =>'RGO-BDS',
                  'head' =>'Annabelle A. Gordonas',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'92', 
                  'name'=>'Business Maintenance Section',
                  'code' =>'RGO-BMS',
                  'head' =>'Estefanie Lazo Cortez',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'91', 
                  'name'=>'Research Monitoring and Evaluation Center',
                  'code' =>'RMO-RMEC',
                  'head' =>'Iris Rowena 0 Bernardo',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'91', 
                  'name'=>'Research Support Center',
                  'code' =>'RMO-RSC',
                  'head' =>'Silvia C. Ambag',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'96', 
                  'name'=>'Administrative Sports Development and Wellness Services',
                  'code' =>'SDPO-ASDWS',
                  'head' =>'Rhene A. Camarador',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'96', 
                  'name'=>'Students Sports Development Services',
                  'code' =>'SDPO-SSDS',
                  'head' =>'Maureen I. Torres',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'94', 
                  'name'=>'SHS Registrar and Admission',
                  'code' =>'SHS-RA',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'93', 
                  'name'=>'Information and Investigation Unit',
                  'code' =>'SSO-IIU',
                  'head' =>'',
                  'head_title' =>'',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'93', 
                  'name'=>'Main, Branches and Campuses Security Section',
                  'code' =>'SSO-MBCS',
                  'head' =>'Valentin P. Espina',
                  'head_title' =>'Chief of Security for Main Campus',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'99', 
                  'name'=>'Drama and Performing Arts Section',
                  'code' =>'UCCA-DPAS',
                  'head' =>'Davidson G. Oliveros',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'99', 
                  'name'=>'Music Section',
                  'code' =>'UCCA-MS',
                  'head' =>'Leomar P. Requejo',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'head_office' =>'99', 
                  'name'=>'Visual Arts Section',
                  'code' =>'UCCA-VAS',
                  'head' =>'Jerielyn V. Reyes',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
      ]);
      }
}

