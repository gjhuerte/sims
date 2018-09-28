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
                  'id' =>'2',
                  'head_office' => null, 
                  'name'=>'Office of the President',
                  'code' =>'OP',
                  'head' =>'Dr. Emanuel C. De Guzman ',
                  'head_title' =>'University President',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'18',
                  'head_office' => null, 
                  'name'=>'Office of the Executive Vice President',
                  'code' =>'OEVP',
                  'head' =>'Dr. Herminia E. Manimtim ',
                  'head_title' =>'Executive Vice President',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'27',
                  'head_office' => null, 
                  'name'=>'Office of the Vice President for Administration',
                  'code' =>'OVPA',
                  'head' =>'Prof. Alberto C. Guillo ',
                  'head_title' =>'VP for Administration',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'59',
                  'head_office' => null, 
                  'name'=>'Office of the Vice President for Finance',
                  'code' =>'OVPF',
                  'head' =>'Marisa J. Legaspi ',
                  'head_title' =>'VP for Finance',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'75',
                  'head_office' =>  null, 
                  'name'=>'Office of the Vice President for Student Affairs and Services',
                  'code' =>'OVPSAS',
                  'head' =>'Herminia E. Manimtim ',
                  'head_title' =>'VP for Student Affairs and Services',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'94',
                  'head_office' => null, 
                  'name'=>'Office of the Vice President for Research, Extension and Development',
                  'code' =>'OVPRED',
                  'head' =>'Joseph  Mercado ',
                  'head_title' =>'VP for Research, Extension and Development',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'120',
                  'head_office' => null, 
                  'name'=>'Office of the Vice President for Academic Affairs',
                  'code' =>'OVPAA',
                  'head' =>'Manuel M. Muhi ',
                  'head_title' =>'VP for Academic Affairs',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'226',
                  'head_office' => null, 
                  'name'=>'Office of the Vice President for Branches and Satellite Campuses',
                  'code' =>'OVPBSC',
                  'head' =>'Pascualito B. Gatan ',
                  'head_title' =>'VP for Branches and Satellite Campuses',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'1',
                  'head_office' =>'2', 
                  'name'=>'University Board Secretary',
                  'code' =>'UBS',
                  'head' =>'Gary C. Aure ',
                  'head_title' =>'University Board Secretary',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'3',
                  'head_office' =>'2', 
                  'name'=>'Communication Management Office',
                  'code' =>'CMO',
                  'head' =>'Kriztine  Viray ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'6',
                  'head_office' =>'2', 
                  'name'=>'University Legal Counsel Office',
                  'code' =>'ULCO',
                  'head' =>'Joanna Marie A. Liao ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'7',
                  'head_office' =>'2', 
                  'name'=>'Internal Audit Office',
                  'code' =>'IAO',
                  'head' =>'Realin C. Aranza ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'8',
                  'head_office' =>'18', 
                  'name'=>'Information and Communications Technology Office',
                  'code' =>'ICTO',
                  'head' =>'Marlon M. Lim ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'12',
                  'head_office' =>'2', 
                  'name'=>'Special Programs and Projects Office',
                  'code' =>'SPPO',
                  'head' =>'Malaya  Ygot ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'13',
                  'head_office' =>'18', 
                  'name'=>'Sports Development Program Office',
                  'code' =>'SDPO',
                  'head' =>'Lualhati A. Dela Cruz ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'14',
                  'head_office' =>'75', 
                  'name'=>'Alumni Relations and Career Development Office',
                  'code' =>'ARCDO',
                  'head' =>'Florinda H. Oquindo ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'19',
                  'head_office' =>'120', 
                  'name'=>'Open University System',
                  'code' =>'OUS',
                  'head' =>'Anna Ruby P. Gapasin ',
                  'head_title' =>'Executive Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'28',
                  'head_office' =>'27', 
                  'name'=>'Human Resource Management Department',
                  'code' =>'HRMD',
                  'head' =>'Adam V. Ramilo ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'33',
                  'head_office' =>'27', 
                  'name'=>'General Services Office',
                  'code' =>'GSO',
                  'head' =>'Antonio  Velasco ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'36',
                  'head_office' =>'27', 
                  'name'=>'Medical Services Department',
                  'code' =>'MSD',
                  'head' =>'Ma. Liza  Yanes ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'40',
                  'head_office' =>'33', 
                  'name'=>'Asset Management Office',
                  'code' =>'AMS',
                  'head' =>'Virgilio  Mauricio ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'42',
                  'head_office' =>'27', 
                  'name'=>'Physical Planning and Development Office',
                  'code' =>'PPDO',
                  'head' =>'Sherwin N. Nieva ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'44',
                  'head_office' =>'327', 
                  'name'=>'Central Records Section',
                  'code' =>'CRS',
                  'head' =>'Grace C. Udaundo ',
                  'head_title' =>'Acting Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'57',
                  'head_office' =>'27', 
                  'name'=>'M. H. Del Pilar Campus',
                  'code' =>'DelPilar',
                  'head' =>'Jean Paul G. Martirez ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'61',
                  'head_office' =>'59', 
                  'name'=>'Accounting Department',
                  'code' =>'AD',
                  'head' =>'Cristopher M. Cahayon ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'66',
                  'head_office' =>'59', 
                  'name'=>'Budget Services Office',
                  'code' =>'BSO',
                  'head' =>'Florenita E. Imperial ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'69',
                  'head_office' =>'59', 
                  'name'=>'Fund Management Office',
                  'code' =>'FMO',
                  'head' =>'Dindo Emmanuel A. Bautista ',
                  'head_title' =>'Cash Disbursement Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'72',
                  'head_office' =>'59', 
                  'name'=>'Resource Generation Office',
                  'code' =>'RGO',
                  'head' =>'Rolando M. Covero Jr.',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'76',
                  'head_office' =>'75', 
                  'name'=>'Office of the University Registrar',
                  'code' =>'OUR',
                  'head' =>'Zenaida R. Sarmiento ',
                  'head_title' =>'University Registrar',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'83',
                  'head_office' =>'75', 
                  'name'=>'Office of the Student Services',
                  'code' =>'OSS',
                  'head' =>'Jose M. Abat ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'88',
                  'head_office' =>'75', 
                  'name'=>'University Center for Culture and the Arts',
                  'code' =>'UCCA',
                  'head' =>'Bely R. Ygot ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'96',
                  'head_office' =>'94', 
                  'name'=>'Intellectual Property Management Office',
                  'code' =>'IPMO',
                  'head' =>'Jackie D. Urrutia ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'99',
                  'head_office' =>'94', 
                  'name'=>'Institute for Cultural and Language Studies',
                  'code' =>'ICLS',
                  'head' =>'Joseph Reylan B. Viray ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'103',
                  'head_office' =>'94', 
                  'name'=>'Institute for Science and Technology Research',
                  'code' =>' ISTR',
                  'head' =>'Armin S. Coronado ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'107',
                  'head_office' =>'94', 
                  'name'=>'Institutional Planning Office',
                  'code' =>'IPO',
                  'head' =>'Tomas O. Testor ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'110',
                  'head_office' =>'94', 
                  'name'=>'Institute for Data and Statistical Analysis',
                  'code' =>'IDSA',
                  'head' =>'Lincoln A. Bautista ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'112',
                  'head_office' =>'94', 
                  'name'=>'Publications Office',
                  'code' =>'PO',
                  'head' =>'Angelina E. Borican ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'114',
                  'head_office' =>'94', 
                  'name'=>'Institute for Social Sciences and Development',
                  'code' =>'ISSD',
                  'head' =>'Hilda F. San Gabriel ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'119',
                  'head_office' =>'94', 
                  'name'=>'Institute for Labor and Industrial Relations',
                  'code' =>'ILIR',
                  'head' =>'Rimando E. Felicia ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'121',
                  'head_office' =>'120', 
                  'name'=>'Quality Assurance Center',
                  'code' =>'QAC',
                  'head' =>'Adela Cristeta  Ruiz ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'122',
                  'head_office' =>'120', 
                  'name'=>'PASUC Evaluation Committee',
                  'code' =>'PASUC',
                  'head' =>'Ben B. Andres ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'123',
                  'head_office' =>'120', 
                  'name'=>'National Service Training Program Office',
                  'code' =>'NSTP',
                  'head' =>'Rovelina B. Jacolbia ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'127',
                  'head_office' =>'120', 
                  'name'=>'Library and Learning Resources Center',
                  'code' =>'LLRC',
                  'head' =>'Divina T. Pasumbal ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'137',
                  'head_office' =>'120', 
                  'name'=>'Graduate School',
                  'code' =>'GS',
                  'head' =>'Carmencita L. Castolo ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'140',
                  'head_office' =>'120', 
                  'name'=>'College of Law',
                  'code' =>'CoL',
                  'head' =>'Gemy Lito L. Festin ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'142',
                  'head_office' =>'120', 
                  'name'=>'College of Accountancy and Finance',
                  'code' =>'CAF',
                  'head' =>'Sylvia A. Sarmiento ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'148',
                  'head_office' =>'120', 
                  'name'=>'College of Architecture and Fine Arts',
                  'code' =>'CAFA',
                  'head' =>'Ted Villamor G. Inocencio ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'153',
                  'head_office' =>'120', 
                  'name'=>'College of Arts and Letters',
                  'code' =>'CAL',
                  'head' =>'Evangelina  Seril ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'159',
                  'head_office' =>'120', 
                  'name'=>'College of Business Administration',
                  'code' =>'CBA',
                  'head' =>'Raquel  Ramos ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'165',
                  'head_office' =>'120', 
                  'name'=>'College of Communication',
                  'code' =>'COC',
                  'head' =>'Edna T. Bernabe ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'171',
                  'head_office' =>'120', 
                  'name'=>'College of Computer and Information Sciences',
                  'code' =>'CCIS',
                  'head' =>'Gisela May A. Albano ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'176',
                  'head_office' =>'120', 
                  'name'=>'College of Education',
                  'code' =>'CoEd',
                  'head' =>'Ma. Junithesmer D. Rosales ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'181',
                  'head_office' =>'176', 
                  'name'=>'Laboratory High School',
                  'code' =>'LHS',
                  'head' =>'Cristalina R. Piers ',
                  'head_title' =>'Principal',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'185',
                  'head_office' =>'120', 
                  'name'=>'College of Engineering',
                  'code' =>'CE',
                  'head' =>'Guillermo O. Bernabe ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'196',
                  'head_office' =>'120', 
                  'name'=>'College of Human Kinetics',
                  'code' =>'CHK',
                  'head' =>'Maripres P. Pascua ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'200',
                  'head_office' =>'120', 
                  'name'=>'College of Political Science and Public Administration',
                  'code' =>'CPSPA',
                  'head' =>'Sanjay P. Claudio ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'204',
                  'head_office' =>'120', 
                  'name'=>'College of Science',
                  'code' =>'CS',
                  'head' =>'Lincoln A. Bautista ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'211',
                  'head_office' =>'120', 
                  'name'=>'College of Social Sciences and Development',
                  'code' =>'CSSD',
                  'head' =>'Nicolas T. Mallari ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'217',
                  'head_office' =>'120', 
                  'name'=>'College of Tourism, Hospitality and Transportation Management',
                  'code' =>'CTHTM',
                  'head' =>'Marietta D. Reyes ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'220',
                  'head_office' =>'120', 
                  'name'=>'Institute of Technology',
                  'code' =>'ITech',
                  'head' =>'Dante V. Gedaria ',
                  'head_title' =>'Dean',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'227',
                  'head_office' =>'226', 
                  'name'=>'PUP BIÑAN, LAGUNA CAMPUS',
                  'code' =>'BN',
                  'head' =>'Josefina B. Macarubbo ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'228',
                  'head_office' =>'226', 
                  'name'=>'PUP BANSUD, ORIENTAL MINDORO CAMPUS',
                  'code' =>'BS',
                  'head' =>'Artemus  Cruz ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'229',
                  'head_office' =>'226', 
                  'name'=>'PUP BATAAN BRANCH',
                  'code' =>'BT',
                  'head' =>'Leonila J. Generales ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'230',
                  'head_office' =>'226', 
                  'name'=>'PUP CABIAO, NUEVA ECIJA CAMPUS',
                  'code' =>'CB',
                  'head' =>'Fernando F. Estingor ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'231',
                  'head_office' =>'226', 
                  'name'=>'PUP CALAUAN, LAGUNA CAMPUS',
                  'code' =>'CL',
                  'head' =>'Arlene R. Queri ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'232',
                  'head_office' =>'226', 
                  'name'=>'PUP QUEZON CITY BRANCH',
                  'code' =>'CM',
                  'head' =>'Firmo A. Esguerra ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'233',
                  'head_office' =>'226', 
                  'name'=>'PUP LOPEZ, QUEZON BRANCH',
                  'code' =>'LQ',
                  'head' =>'Rufo N. Bueza ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'234',
                  'head_office' =>'226', 
                  'name'=>'PUP PULILAN, BULACAN CAMPUS',
                  'code' =>'PL',
                  'head' =>'Ma. Elena M. Maño ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'235',
                  'head_office' =>'226', 
                  'name'=>'PUP PARAÑAQUE CITY CAMPUS',
                  'code' =>'PQ',
                  'head' =>'Aaron Vito M. Baygan ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'236',
                  'head_office' =>'226', 
                  'name'=>'PUP RAGAY, CAMARINES SUR BRANCH',
                  'code' =>'RG',
                  'head' =>'Anastacio  Gabriel ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'237',
                  'head_office' =>'226', 
                  'name'=>'PUP SABLAYAN, OCCIDENTAL MINDORO CAMPUS',
                  'code' =>'SB',
                  'head' =>'Lorenza Elena S. Gimutao ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'238',
                  'head_office' =>'226', 
                  'name'=>'PUP SAN JUAN CITY CAMPUS',
                  'code' =>'SJ',
                  'head' =>'Jaime P. Gutierrez Jr.',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'239',
                  'head_office' =>'226', 
                  'name'=>'PUP STA. MARIA, BULACAN CAMPUS',
                  'code' =>'SM',
                  'head' =>'Ricardo F. Ramiscal ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'240',
                  'head_office' =>'226', 
                  'name'=>'PUP SAN PEDRO, LAGUNA CAMPUS',
                  'code' =>'SP',
                  'head' =>'Elmer G. De Jose ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'241',
                  'head_office' =>'226', 
                  'name'=>'PUP STA. ROSA, LAGUNA CAMPUS',
                  'code' =>'SR',
                  'head' =>'Charito A. Montemayor ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'242',
                  'head_office' =>'226', 
                  'name'=>'PUP STO. TOMAS, BATANGAS BRANCH',
                  'code' =>'ST',
                  'head' =>'Armando  Torres ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'243',
                  'head_office' =>'226', 
                  'name'=>'PUP TAGUIG CITY BRANCH',
                  'code' =>'TG',
                  'head' =>'Marissa B. Ferrer ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'244',
                  'head_office' =>'226', 
                  'name'=>'PUP MULANAY, QUEZON BRANCH',
                  'code' =>'ML',
                  'head' =>'Adelia R. Roadilla ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'245',
                  'head_office' =>'244', 
                  'name'=>'PUP GENERAL LUNA, QUEZON CAMPUS',
                  'code' =>'GL',
                  'head' =>'Adelia R. Roadilla ',
                  'head_title' =>'Acting Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'246',
                  'head_office' =>'226', 
                  'name'=>'PUP MARAGONDON, CAVITE BRANCH',
                  'code' =>'MG',
                  'head' =>'Denise A. Abril ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'247',
                  'head_office' =>'246', 
                  'name'=>'PUP ALFONSO, CAVITE CAMPUS',
                  'code' =>'AF',
                  'head' =>'Conrado L. Nati Jr.',
                  'head_title' =>'Assistant Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'248',
                  'head_office' =>'226', 
                  'name'=>'PUP UNISAN, QUEZON BRANCH',
                  'code' =>'UN',
                  'head' =>'Edwin  Malabuyoc ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'260',
                  'head_office' =>'120', 
                  'name'=>'Senior High School',
                  'code' =>'SHS',
                  'head' =>'Corazon C. Tahil ',
                  'head_title' =>'Principal',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'263',
                  'head_office' =>'94', 
                  'name'=>'Extension Management Office',
                  'code' =>'EMO',
                  'head' =>'Racidon P. Bernarte ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'268',
                  'head_office' =>'2', 
                  'name'=>'Safety and Security Office',
                  'code' =>'SSO',
                  'head' =>'Jimmy M. Fernando ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'271',
                  'head_office' =>'27', 
                  'name'=>'Procurement Management Office',
                  'code' =>'PMO',
                  'head' =>'Henry V. Pascua ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'274',
                  'head_office' =>'27', 
                  'name'=>'Facility Management Office',
                  'code' =>'FAMO',
                  'head' =>'Natan F. Gacute ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'285',
                  'head_office' =>'14', 
                  'name'=>'Alumni Relations Services',
                  'code' =>'ARCDO-ARS',
                  'head' =>'Mavel B. Besmonte ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'287',
                  'head_office' =>'75', 
                  'name'=>'Counseling and Psychological Services',
                  'code' =>'CPS',
                  'head' =>'Nenita F. Buan ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'288',
                  'head_office' =>'287', 
                  'name'=>'Guidance and Counseling Services',
                  'code' =>'CPS-GCS',
                  'head' =>'Barbara P. Camacho ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'290',
                  'head_office' =>'94', 
                  'name'=>'Research Management Office',
                  'code' =>'RMO',
                  'head' =>'Racidon P. Bernarte ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'304',
                  'head_office' =>'94', 
                  'name'=>'Printing Office',
                  'code' =>'PRINTING',
                  'head' =>'Renato C. Vibiesca ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'4',
                  'head_office' =>'3', 
                  'name'=>'Creative Media Services',
                  'code' =>'CMO-CMS',
                  'head' =>'Nelson S. Baun ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'9',
                  'head_office' =>'8', 
                  'name'=>'Information Systems Development Section',
                  'code' =>'ICTO-ISDS',
                  'head' =>'Severino L. Martinez ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'10',
                  'head_office' =>'8', 
                  'name'=>'Network and Systems Administration Section',
                  'code' =>'ICTO-NSAS',
                  'head' =>'Christian G. Ordanel ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'21',
                  'head_office' =>'19', 
                  'name'=>'OUS Registrar and Admission Office',
                  'code' =>'OUS-RAO',
                  'head' =>'Lina S. Felices ',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'22',
                  'head_office' =>'19', 
                  'name'=>'Learning Management Section',
                  'code' =>'OUS-LMS',
                  'head' =>'Pedrito M. Tenerife Jr.',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'29',
                  'head_office' =>'28', 
                  'name'=>'Recruitment Section',
                  'code' =>'HRMD-RS',
                  'head' =>'Eduardo Dc. Figura ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'30',
                  'head_office' =>'28', 
                  'name'=>'Personnel Welfare and Benefits Section',
                  'code' =>'HRMD-PWBS',
                  'head' =>'Joel M. Munsayac ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'31',
                  'head_office' =>'28', 
                  'name'=>'Records Management Section',
                  'code' =>'HRMD-RMS',
                  'head' =>'Ruperto D. Carpio Jr.',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'32',
                  'head_office' =>'28', 
                  'name'=>'Training Section',
                  'code' =>'HRMD-TS',
                  'head' =>'Ireneo C. Delas Armas Jr.',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'34',
                  'head_office' =>'33', 
                  'name'=>'Transportation and Motor Pool Section',
                  'code' =>'GSO-TMPS',
                  'head' =>'Sergie D. Quimpo ',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'35',
                  'head_office' =>'33', 
                  'name'=>'University Canteen Services Section',
                  'code' =>'GSO-UCSS',
                  'head' =>'Josephine N. Flores ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'37',
                  'head_office' =>'36', 
                  'name'=>'Medical Services Section',
                  'code' =>'MSD-MSS',
                  'head' =>'Mary Grace R. Roxas ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'38',
                  'head_office' =>'36', 
                  'name'=>'Dental Services Section',
                  'code' =>'MSD-DSS',
                  'head' =>'Maria Rachael B. Jamandre ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'48',
                  'head_office' =>'274', 
                  'name'=>'Electrical Maintenance Section',
                  'code' =>'FAMO-EMS',
                  'head' =>'Clint Michael F. Lacdang ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'63',
                  'head_office' =>'61', 
                  'name'=>'Student Records Section',
                  'code' =>'AD-SRS',
                  'head' =>'Diosdado L. Martinez ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'64',
                  'head_office' =>'61', 
                  'name'=>'Payroll Section',
                  'code' =>'AD-PS',
                  'head' =>'Teresita Dg. Halog ',
                  'head_title' =>'Acting Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'65',
                  'head_office' =>'61', 
                  'name'=>'Branch/Campus Accounting Section',
                  'code' =>'AD-BCAS',
                  'head' =>'Sandy A. Osorio ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'67',
                  'head_office' =>'66', 
                  'name'=>'Budget Technical Section',
                  'code' =>'BSO-BTS',
                  'head' =>'Maria Armi C. Roncal ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'68',
                  'head_office' =>'66', 
                  'name'=>'Budget Operations Section',
                  'code' =>'BSO-BOS',
                  'head' =>'Arturo F. Perez ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'70',
                  'head_office' =>'69', 
                  'name'=>'Cash Receipt Section',
                  'code' =>'FMO-CRS',
                  'head' =>'Merlita L. Palma ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'73',
                  'head_office' =>'72', 
                  'name'=>'Business Maintenance Section',
                  'code' =>'RGO-BMS',
                  'head' =>'Estefanie Lazo Cortez ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'74',
                  'head_office' =>'72', 
                  'name'=>'Business Development Section',
                  'code' =>'RGO-BDS',
                  'head' =>'Annabelle A. Gordonas ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'77',
                  'head_office' =>'76', 
                  'name'=>'Admission Services Section',
                  'code' =>'OUR-ADSS',
                  'head' =>'Adelio O. Sulit ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'80',
                  'head_office' =>'76', 
                  'name'=>'Student Records Services',
                  'code' =>'OUR-SRS',
                  'head' =>'Jaime Y. Gonzales ',
                  'head_title' =>'Officer-In-Charge',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'84',
                  'head_office' =>'83', 
                  'name'=>'Scholarship and Financial Assistance Services',
                  'code' =>'OSS-SFAS',
                  'head' =>'Lailanie G. Teves ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'86',
                  'head_office' =>'83', 
                  'name'=>'Career Development and Placement Services',
                  'code' =>'OSS-CDPS',
                  'head' =>'Jane  Pulma ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'87',
                  'head_office' =>'83', 
                  'name'=>'Student Affairs',
                  'code' =>'OSS-SA',
                  'head' =>'Romulo B. Hubbard ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'89',
                  'head_office' =>'88', 
                  'name'=>'Music Section',
                  'code' =>'UCCA-MS',
                  'head' =>'Leomar P. Requejo ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'90',
                  'head_office' =>'88', 
                  'name'=>'Visual Arts Section',
                  'code' =>'UCCA-VAS',
                  'head' =>'Jerielyn V. Reyes ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'91',
                  'head_office' =>'88', 
                  'name'=>'Drama and Performing Arts Section',
                  'code' =>'UCCA-DPAS',
                  'head' =>'Davidson G. Oliveros ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'100',
                  'head_office' =>'99', 
                  'name'=>'Center for Social History',
                  'code' =>'ICLS-CSH',
                  'head' =>'Romeo P. Peña ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'101',
                  'head_office' =>'99', 
                  'name'=>'Center for Creative Writing',
                  'code' =>'ICLS-CCW',
                  'head' =>'Merdeka Dc. Morales ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'105',
                  'head_office' =>'103', 
                  'name'=>'Center for Life Sciences Research',
                  'code' =>' ISTR-CLSR',
                  'head' =>'Gary Antonio C. Lirio ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'108',
                  'head_office' =>'107', 
                  'name'=>'Planning Section',
                  'code' =>'IPO-PS',
                  'head' =>'Criselda M. Ligon ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'109',
                  'head_office' =>'107', 
                  'name'=>'Evaluation and Monitoring Section',
                  'code' =>'IPO-EMS',
                  'head' =>'Anita H. Irinco ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'115',
                  'head_office' =>'114', 
                  'name'=>'Center for Human Rights and Gender Studies',
                  'code' =>'ISSD-CHRGS',
                  'head' =>'Hilda F. San Gabriel ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'116',
                  'head_office' =>'114', 
                  'name'=>'Center for Peace and Poverty Alleviation Studies',
                  'code' =>'ISSD-CPPAS',
                  'head' =>'Raul Roland R. Sebastian ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'117',
                  'head_office' =>'114', 
                  'name'=>'Center for Environmental Studies',
                  'code' =>'ISSD-CES',
                  'head' =>'Joey S. Pinalas ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'118',
                  'head_office' =>'114', 
                  'name'=>'Center for Public Administration and Governance Studies',
                  'code' =>'ISSD-CPAGS',
                  'head' =>'Antonius C. Umali ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'124',
                  'head_office' =>'123', 
                  'name'=>'Civic Welfare Training Services',
                  'code' =>'NSTP-CWTS',
                  'head' =>'Jennifor L. Aguilar ',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'132',
                  'head_office' =>'127', 
                  'name'=>'PUP-CLFI E-Learning Center',
                  'code' =>'LLRC-Elearning',
                  'head' =>'Mary Grace L. Ferrer ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'143',
                  'head_office' =>'142', 
                  'name'=>'Department of Basic Accounting',
                  'code' =>'CAF-DBA',
                  'head' =>'Lilian M. Litonjua ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'144',
                  'head_office' =>'142', 
                  'name'=>'Department of Higher Accounting',
                  'code' =>'CAF-DHA',
                  'head' =>'Gloria  Rante ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'145',
                  'head_office' =>'142', 
                  'name'=>'Department of Banking and Finance',
                  'code' =>'CAF-DBF',
                  'head' =>'Bernadette M. Panibio ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'147',
                  'head_office' =>'142', 
                  'name'=>'CAF Laboratory',
                  'code' =>'CAF-LAB',
                  'head' =>'Glenn A. Magadia ',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'149',
                  'head_office' =>'148', 
                  'name'=>'Department of Architecture',
                  'code' =>'CAFA-DA',
                  'head' =>'Jocelyn A. Rivera-Lutap ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'152',
                  'head_office' =>'148', 
                  'name'=>'CAFA Laboratory',
                  'code' =>'CAFA-LAB',
                  'head' =>'Gina G. Flandes ',
                  'head_title' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'154',
                  'head_office' =>'153', 
                  'name'=>'Department of Humanities and Philosophy',
                  'code' =>'CAL-DHP',
                  'head' =>'Joey S. Pinalas ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'155',
                  'head_office' =>'153', 
                  'name'=>'Department of English and Foreign Languages',
                  'code' =>'CAL-DEFL',
                  'head' =>'Carlos A. Garcia ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'156',
                  'head_office' =>'153', 
                  'name'=>'Kagawaran ng Filipinolohiya',
                  'code' =>'CAL-KF',
                  'head' =>'Marvin  Lai ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'157',
                  'head_office' =>'153', 
                  'name'=>'Department of Theater Arts',
                  'code' =>'CAL-DTA',
                  'head' =>'Davidson G. Oliveros ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'160',
                  'head_office' =>'159', 
                  'name'=>'Department of Entrepreneurial Management',
                  'code' =>'CBA-DEM',
                  'head' =>'Zenaida D. San Agustin ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'161',
                  'head_office' =>'159', 
                  'name'=>'Department of Management',
                  'code' =>'CBA-DMan',
                  'head' =>'Cindy F. Soliman ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'162',
                  'head_office' =>'159', 
                  'name'=>'Department of Marketing',
                  'code' =>'CBA-DMar',
                  'head' =>'Angelina  Goyenechea ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'163',
                  'head_office' =>'159', 
                  'name'=>'Department of Office Administration',
                  'code' =>'CBA-DOA',
                  'head' =>'Ma. Lolita V. Abecia ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'166',
                  'head_office' =>'165', 
                  'name'=>'Department of Journalism',
                  'code' =>'COC-DJ',
                  'head' =>'Hemmady S. Mora ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'167',
                  'head_office' =>'165', 
                  'name'=>'Department of Advertising and Public Relations',
                  'code' =>'COC-DAPR',
                  'head' =>'Reynaldo A. Guerzon ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'169',
                  'head_office' =>'165', 
                  'name'=>'Department of Broadcast Communication',
                  'code' =>'COC-DBC',
                  'head' =>'Ma. Lourdes Dp. Garcia ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'172',
                  'head_office' =>'171', 
                  'name'=>'Department of Computer Science',
                  'code' =>'CCIS-DCS',
                  'head' =>'Melvin C. Roxas ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'174',
                  'head_office' =>'171', 
                  'name'=>'Department of Information Technology',
                  'code' =>'CCIS-DIT',
                  'head' =>'Rachel A. Nayre ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'175',
                  'head_office' =>'171', 
                  'name'=>'CCIS Laboratory',
                  'code' =>'CCIS-LAB',
                  'head' =>'Carlo  Inovero ',
                  'head_title' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'177',
                  'head_office' =>'176', 
                  'name'=>'Department of Business Teacher Education',
                  'code' =>'CoEd-DBTE',
                  'head' =>'Dennis O. Dumrique ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'178',
                  'head_office' =>'176', 
                  'name'=>'Department of Elementary and Secondary Education',
                  'code' =>'CoEd-DESE',
                  'head' =>'Jennifor L. Aguilar ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'188',
                  'head_office' =>'185', 
                  'name'=>'Department of Engineering Sciences',
                  'code' =>'CE-DES',
                  'head' =>'Bernard C. Capellan ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'189',
                  'head_office' =>'185', 
                  'name'=>'Department of Civil Engineering',
                  'code' =>'CE-DCvE',
                  'head' =>'Ramir M. Cruz ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'190',
                  'head_office' =>'185', 
                  'name'=>'Department of Computer Engineering',
                  'code' =>'CE-DCoE',
                  'head' =>'Julius S. Cansino ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'191',
                  'head_office' =>'185', 
                  'name'=>'Department of Electrical Engineering',
                  'code' =>'CE-DElE',
                  'head' =>'Vilma C. Perez ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'192',
                  'head_office' =>'185', 
                  'name'=>'Department of Electronics Engineering',
                  'code' =>'CE-DEE',
                  'head' =>'Geoffrey T. Salvador ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'193',
                  'head_office' =>'185', 
                  'name'=>'Department of Industrial Engineering',
                  'code' =>'CE-DIE',
                  'head' =>'Christopher  Mira ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'194',
                  'head_office' =>'185', 
                  'name'=>'Department of Mechanical Engineering',
                  'code' =>'CE-DME',
                  'head' =>'Edwin  Esperanza ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'197',
                  'head_office' =>'196', 
                  'name'=>'Department of Professional Program',
                  'code' =>'CHK-DPP',
                  'head' =>'Celia M. Rilles ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'198',
                  'head_office' =>'196', 
                  'name'=>'Department of Sports Science',
                  'code' =>'CHK-DSS',
                  'head' =>'Antonio F. Enriquez Jr.',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'199',
                  'head_office' =>'196', 
                  'name'=>'Department of Service Physical Education',
                  'code' =>'CHK-DSPE',
                  'head' =>'Ma. Victoria Magno Caringal ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'201',
                  'head_office' =>'200', 
                  'name'=>'Department of Political Economy',
                  'code' =>'CPA-DPE',
                  'head' =>'Romeo  Bernardo ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'202',
                  'head_office' =>'200', 
                  'name'=>'Department of Political Science',
                  'code' =>'CPA-DPS',
                  'head' =>'Elmer M. Soriano ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'203',
                  'head_office' =>'200', 
                  'name'=>'Department of Public Administration',
                  'code' =>'CPA-DPA',
                  'head' =>'Fidel L. Esteban ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'205',
                  'head_office' =>'204', 
                  'name'=>'Department of Mathematics and Statistics',
                  'code' =>'CS-DMS',
                  'head' =>'Emelita A. Isaac ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'206',
                  'head_office' =>'204', 
                  'name'=>'Department of Physical Sciences',
                  'code' =>'CS-DPS',
                  'head' =>'Elizabeth P. Bisa ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'207',
                  'head_office' =>'204', 
                  'name'=>'Department of Food Technology',
                  'code' =>'CS-DFT',
                  'head' =>'Maria Susan P. Arevalo ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'208',
                  'head_office' =>'204', 
                  'name'=>'Department of Nutrition and Dietetics',
                  'code' =>'CS-DND',
                  'head' =>'Esperanza Sj Lorenzo ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'209',
                  'head_office' =>'204', 
                  'name'=>'Department of Biology',
                  'code' =>'CS-DB',
                  'head' =>'Lourdes V. Alvarez ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'210',
                  'head_office' =>'204', 
                  'name'=>'CS Laboratory',
                  'code' =>'CS-LAB',
                  'head' =>'Christian Jay  Cambiador ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'212',
                  'head_office' =>'211', 
                  'name'=>'Department of Cooperatives and Social Development',
                  'code' =>'CSSD-DCSD',
                  'head' =>'Rebecca E. Palma ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'213',
                  'head_office' =>'211', 
                  'name'=>'Department of Sociology',
                  'code' =>'CSSD-DS',
                  'head' =>'Mercedes Camille B. Ocampo ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'214',
                  'head_office' =>'211', 
                  'name'=>'Department of Economics',
                  'code' =>'CSSD-DE',
                  'head' =>'Norie M. Maniego ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'215',
                  'head_office' =>'211', 
                  'name'=>'Department of Psychology',
                  'code' =>'CSSD-DP',
                  'head' =>'John Mark S. Distor ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'216',
                  'head_office' =>'211', 
                  'name'=>'Department of History',
                  'code' =>'CSSD-DH',
                  'head' =>'Raul Roland R. Sebastian ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'218',
                  'head_office' =>'217', 
                  'name'=>'Department of Hospitality Management',
                  'code' =>'CTHTM-DHM',
                  'head' =>'Jesusa T. Castillo ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'219',
                  'head_office' =>'217', 
                  'name'=>'Department of Tourism and Transportation Management',
                  'code' =>'CTHTM-DTTM',
                  'head' =>'Lizbette  Vergara ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'223',
                  'head_office' =>'220', 
                  'name'=>'Department of Engineering Technology',
                  'code' =>'ITech-DET',
                  'head' =>'Raymond L. Alfonso ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'224',
                  'head_office' =>'220', 
                  'name'=>'Department of Computer and Office Management',
                  'code' =>'ITech-DCOM',
                  'head' =>'Josephine  Dela Isla ',
                  'head_title' =>'Chairperson',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'225',
                  'head_office' =>'220', 
                  'name'=>'ITech Laboratory',
                  'code' =>'ITech-LAB',
                  'head' =>'Remegio C. Rios ',
                  'head_title' =>'Laboratory Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'253',
                  'head_office' =>'137', 
                  'name'=>'GS Research, Extension and Accreditation',
                  'code' =>'GS-REA',
                  'head' =>'Marion  Cresencio ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'264',
                  'head_office' =>'8', 
                  'name'=>'Operations Section',
                  'code' =>'ICTO-OPS',
                  'head' =>'Sally C. Mua ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'265',
                  'head_office' =>'19', 
                  'name'=>'Instructional Materials Development Section',
                  'code' =>'OUS-IMD',
                  'head' =>'Anna Ruby P. Gapasin ',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'267',
                  'head_office' =>'28', 
                  'name'=>'Performance Monitoring and Evaluation Section',
                  'code' =>'HRMD-PMES',
                  'head' =>'Laura D. Galit ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'272',
                  'head_office' =>'271', 
                  'name'=>'Procurement Planning and Management Section',
                  'code' =>'PMO-PPMS',
                  'head' =>'Ma. Teresa M. Balasa ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'273',
                  'head_office' =>'27', 
                  'name'=>'Contract Management Section',
                  'code' =>'PMO-CMS',
                  'head' =>'Fidel L. Esteban ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'276',
                  'head_office' =>'274', 
                  'name'=>'Building Maintenance Section',
                  'code' =>'FAMO-BMS',
                  'head' =>'Ronald D. Fernando ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'279',
                  'head_office' =>'274', 
                  'name'=>'Air-Condition Maintenance and Metal Works Section',
                  'code' =>'FAMO-ACMMWS',
                  'head' =>'Arlheth P. Delos Angeles ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'281',
                  'head_office' =>'57', 
                  'name'=>'Hasmin Hostel',
                  'code' =>'DelPilar-Hasmin',
                  'head' =>'Roland  Viray ',
                  'head_title' =>'Manager',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'283',
                  'head_office' =>'33', 
                  'name'=>'Community Relations Development Center',
                  'code' =>'GSO-CRDC',
                  'head' =>'Glenda D. Salorsano ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'289',
                  'head_office' =>'287', 
                  'name'=>'Psychological and Wellness Services',
                  'code' =>'CPS-PWS',
                  'head' =>'Cielito B. Buhain ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'291',
                  'head_office' =>'290', 
                  'name'=>'Research Monitoring and Evaluation Center',
                  'code' =>'RMO-RMEC',
                  'head' =>'Iris Rowena  Bernardo ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'292',
                  'head_office' =>'290', 
                  'name'=>'Research Support Center',
                  'code' =>'RMO-RSC',
                  'head' =>'Silvia C. Ambag ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'293',
                  'head_office' =>'263', 
                  'name'=>'Extension Monitoring and Evaluation Center',
                  'code' =>'EMO-EMEC',
                  'head' =>'Randy D. Sagun ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'294',
                  'head_office' =>'263', 
                  'name'=>'Extension Support Center',
                  'code' =>'EMO-ESC',
                  'head' =>'Ester T. Dizon ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'295',
                  'head_office' =>'96', 
                  'name'=>'Innovation, Technology and Commercialization Office',
                  'code' =>'IPMO-ITCO',
                  'head' =>'Joselinda  Golpeo ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'296',
                  'head_office' =>'96', 
                  'name'=>'Center for Technology Transfer and Enterprise Development',
                  'code' =>'IPMO-CTTED',
                  'head' =>'Perla B. Patriarca ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'297',
                  'head_office' =>'100', 
                  'name'=>'Center for Language and Literary Studies',
                  'code' =>'ICLS-CLTS',
                  'head' =>'Renato C. Vibiesca ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'300',
                  'head_office' =>'110', 
                  'name'=>'Center for Statistical Studies',
                  'code' =>'IDSA-CSS',
                  'head' =>'Edcon B. Baccay ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'301',
                  'head_office' =>'110', 
                  'name'=>'Statistical Training Section',
                  'code' =>'IDSA-STS',
                  'head' =>'Aurea Z. Rosal ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'306',
                  'head_office' =>'119', 
                  'name'=>'Center for Labor Research and Publication',
                  'code' =>'ILIR-CLRP',
                  'head' =>'Jomar  Adaya ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'314',
                  'head_office' =>'159', 
                  'name'=>'CBA Graduate Program',
                  'code' =>'CBA-GRAD',
                  'head' =>'Guillermo  Bungato Jr.',
                  'head_title' =>'Chairperson, Doctor in Business Administration',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'317',
                  'head_office' =>'176', 
                  'name'=>'CoED Graduate Program',
                  'code' =>'CoED-GRAD',
                  'head' =>'Jennifor L. Aguilar ',
                  'head_title' =>'Chairperson, Master of Arts in Filipino Program',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'318',
                  'head_office' =>'176', 
                  'name'=>'CoED Research, Extension and Accreditation',
                  'code' =>'CoED-REA',
                  'head' =>'Silvia C. Ambag ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'323',
                  'head_office' =>'7', 
                  'name'=>'Management Inspection Unit',
                  'code' =>'IAO-MIU',
                  'head' =>'Audie B. Oliquino ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'324',
                  'head_office' =>'7', 
                  'name'=>'Operations Audit Section',
                  'code' =>'IAO-OAS',
                  'head' =>'Maria Theresa D. Bongulto ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'326',
                  'head_office' =>'325', 
                  'name'=>'Presidential Management Staff',
                  'code' =>'HEA-PMS',
                  'head' =>'Susan C. Luna ',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'328',
                  'head_office' =>'13', 
                  'name'=>'Administrative Sports Development and Wellness Services',
                  'code' =>'SDPO-ASDWS',
                  'head' =>'Rhene A. Camarador ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'329',
                  'head_office' =>'13', 
                  'name'=>'Students Sports Development Services',
                  'code' =>'SDPO-SSDS',
                  'head' =>'Maureen I. Torres ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'330',
                  'head_office' =>'42', 
                  'name'=>'Structural Design and Estimate Section',
                  'code' =>'PPDO-SDES',
                  'head' =>'Richmon B. Pangilinan ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'331',
                  'head_office' =>'42', 
                  'name'=>'Electrical Design and Estimate Section',
                  'code' =>'PPDO-EDES',
                  'head' =>'Clint Michael F. Lacdang ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'332',
                  'head_office' =>'19', 
                  'name'=>'Institute of Distance Education / Transnational Education',
                  'code' =>'OUS-IODET',
                  'head' =>'Carmencita L. Castolo ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'336',
                  'head_office' =>'19', 
                  'name'=>'Research, Extension and Accreditation Office',
                  'code' =>'OUS-REAO',
                  'head' =>'Andrew C. Hernandez ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'337',
                  'head_office' =>'19', 
                  'name'=>'Institute of Non-Traditional Studies and ETEEAP',
                  'code' =>'OUS-INE',
                  'head' =>'Remedios G. Ado ',
                  'head_title' =>'Director',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'340',
                  'head_office' =>'266', 
                  'name'=>'Training Section',
                  'code' =>'ICPD-TS',
                  'head' =>'Jessie  Quirrez ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'341',
                  'head_office' =>'266', 
                  'name'=>'Marketing and Promotions Section',
                  'code' =>'ICPD-MPS',
                  'head' =>'Raiza Francesca B. Culili ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'346',
                  'head_office' =>'83', 
                  'name'=>'Student Publications Section',
                  'code' =>'OSS-SPS',
                  'head' =>'Esther Soraya M. Ambion ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'347',
                  'head_office' =>'25', 
                  'name'=>'Exchange and Study Program Section',
                  'code' =>'OIA-ESPS',
                  'head' =>'Regina B. Zuñiga ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'348',
                  'head_office' =>'25', 
                  'name'=>'Parnership and Linkages Section',
                  'code' =>'OIA-PLS',
                  'head' =>'Ann Clarisse M. De Leon ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'349',
                  'head_office' =>'140', 
                  'name'=>'Legal Aide Section',
                  'code' =>'CL-LAS',
                  'head' =>'Maria Cristina R. Gimenez ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'350',
                  'head_office' =>'127', 
                  'name'=>'Library Operations',
                  'code' =>'LLRC-LOR',
                  'head' =>'Avelina N. Lupas ',
                  'head_title' =>'Chief',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'351',
                  'head_office' =>'19', 
                  'name'=>'E-Learning Portal',
                  'code' =>'OU-ELP',
                  'head' =>'Jerome P. Dumlao ',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'id' =>'352',
                  'head_office' =>'185', 
                  'name'=>'CoE Laboratory',
                  'code' =>'CE-LAB',
                  'head' =>'Rolito L. Mahaguay',
                  'head_title' =>'Head',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
      ]);
      }
}
