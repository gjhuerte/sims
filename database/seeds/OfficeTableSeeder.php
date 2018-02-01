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
                  'code' => 'AD', 
                  'name'=>'Accounting Department',
                  'head' => 'CRISTOPHER M. CAHAYON',
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
                  'code' => 'ARCDO', 
                  'name'=>'Alumni Relations and Career Development Office',
                  'head' => 'FLORINDA H. OQUINDO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AMS', 
                  'name'=>'Asset Management Office',
                  'head' => 'VIRGILIO  MAURICIO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BSO', 
                  'name'=>'Budget Services Office',
                  'head' => 'FLORENITA E. IMPERIAL',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF', 
                  'name'=>'College of Accountancy and Finance',
                  'head' => 'SYLVIA A. SARMIENTO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAFA', 
                  'name'=>'College of Architecture and Fine Arts',
                  'head' => 'TED VILLAMOR G. INOCENCIO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL', 
                  'name'=>'College of Arts and Letters',
                  'head' => 'EVANGELINA  SERIL',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA', 
                  'name'=>'College of Business Administration',
                  'head' => 'RAQUEL  RAMOS',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC', 
                  'name'=>'College of Communication',
                  'head' => 'EDNA T. BERNABE',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CCIS', 
                  'name'=>'College of Computer and Information Sciences',
                  'head' => 'GISELA MAY A. ALBANO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoEd', 
                  'name'=>'College of Education',
                  'head' => 'TERESA  MOBILLA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE', 
                  'name'=>'College of Engineering',
                  'head' => 'GUILLERMO O. BERNABE',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CHK', 
                  'name'=>'College of Human Kinetics',
                  'head' => 'MARIPRES P. PASCUA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoL', 
                  'name'=>'College of Law',
                  'head' => 'GEMY LITO L. FESTIN',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPSPA', 
                  'name'=>'College of Political Science and Public Administration',
                  'head' => 'SANJAY P. CLAUDIO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS', 
                  'name'=>'College of Science',
                  'head' => 'LINCOLN A. BAUTISTA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD', 
                  'name'=>'College of Social Sciences and Development',
                  'head' => 'NICOLAS T. MALLARI',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CTHTM', 
                  'name'=>'College of Tourism, Hospitality and Transportation Management',
                  'head' => 'ROCHELLE MAY E. GARCIA',
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
                  'head' => 'KRIZTINE  VIRAY',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPS', 
                  'name'=>'Counseling and Psychological Services',
                  'head' => 'NENITA F. BUAN',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'EMO', 
                  'name'=>'Extension Management Office',
                  'head' => 'RACIDON P. BERNARTE',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO', 
                  'name'=>'Facility Management Office',
                  'head' => 'NATAN F. GACUTE',
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
                  'code' => 'FMO', 
                  'name'=>'Fund Management Office',
                  'head' => 'JOCELLE ANNE C. AVANZADO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GSO', 
                  'name'=>'General Services Office',
                  'head' => 'MAYLUCK A. MALAGA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS', 
                  'name'=>'Graduate School',
                  'head' => 'CARMENCITA L. CASTOLO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD', 
                  'name'=>'Human Resource Management Department',
                  'head' => 'ADAM V. RAMILO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICTO', 
                  'name'=>'Information and Communications Technology Office',
                  'head' => 'MARLON M. LIM',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICLS', 
                  'name'=>'Institute for Cultural and Language Studies',
                  'head' => 'JOSEPH REYLAN B. VIRAY',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IDSA', 
                  'name'=>'Institute for Data and Statistical Analysis',
                  'head' => 'LINCOLN A. BAUTISTA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ILIR', 
                  'name'=>'Institute for Labor and Industrial Relations',
                  'head' => 'RIMANDO E. FELICIA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISTR', 
                  'name'=>'Institute for Science and Technology Research',
                  'head' => 'ARMIN S. CORONADO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISSD', 
                  'name'=>'Institute for Social Sciences and Development',
                  'head' => 'HILDA F. SAN GABRIEL',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITech', 
                  'name'=>'Institute of Technology',
                  'head' => 'NIMFA M. DEL ROSARIO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPO', 
                  'name'=>'Institutional Planning Office',
                  'head' => 'TOMAS O. TESTOR',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPMO', 
                  'name'=>'Intellectual Property Management Office',
                  'head' => 'JACKIE D. URRUTIA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IAO', 
                  'name'=>'Internal Audit Office',
                  'head' => 'REALIN C. ARANZA',
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
                  'code' => 'LHS', 
                  'name'=>'Laboratory High School',
                  'head' => 'CRISTALINA R. PIERS',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC', 
                  'name'=>'Library and Learning Resources Center',
                  'head' => 'DIVINA T. PASUMBAL',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'DelPilar', 
                  'name'=>'M. H. Del Pilar Campus',
                  'head' => 'CHRISTOPHER  CRISTE',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MSD', 
                  'name'=>'Medical Services Department',
                  'head' => 'MA. LIZA  YANES',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'NSTP', 
                  'name'=>'National Service Training Program Office',
                  'head' => 'ROVELINA B. JACOLBIA',
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
                  'code' => 'OEVP', 
                  'name'=>'Office of the Executive Vice President',
                  'head' => 'LUALHATI A. DELA CRUZ',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OP', 
                  'name'=>'Office of the President',
                  'head' => 'EMANUEL C. DE GUZMAN',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OSS', 
                  'name'=>'Office of the Student Services',
                  'head' => 'JOSE M. ABAT',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUR', 
                  'name'=>'Office of the University Registrar',
                  'head' => 'FLORDELIZA E. ALVENDIA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPAA', 
                  'name'=>'Office of the Vice President for Academic Affairs',
                  'head' => 'RAQUEL G. JAVIER',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPA', 
                  'name'=>'Office of the Vice President for Administration',
                  'head' => 'ROSITA E. CANLAS',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPBSC', 
                  'name'=>'Office of the Vice President for Branches and Satellite Campuses',
                  'head' => 'NORBERTO  CATURAY',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPF', 
                  'name'=>'Office of the Vice President for Finance',
                  'head' => 'SHARON JOY F. PELAYO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPRED', 
                  'name'=>'Office of the Vice President for Research, Extension and Development',
                  'head' => 'RACIDON P. BERNARTE',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPSAS', 
                  'name'=>'Office of the Vice President for Student Affairs and Services',
                  'head' => 'EDGARDO A. LATOZA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS', 
                  'name'=>'Open University System',
                  'head' => 'ROSEMARIEBETH  DIZON',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PASUC', 
                  'name'=>'PASUC Evaluation Committee',
                  'head' => 'BEN B. ANDRES',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PPDO', 
                  'name'=>'Physical Planning and Development Office',
                  'head' => 'SHERWIN N. NIEVA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PRINTING', 
                  'name'=>'Printing Office',
                  'head' => 'RENATO C. VIBIESCA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PMO', 
                  'name'=>'Procurement Management Office',
                  'head' => 'HENRY V. PASCUA',
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
                  'code' => 'PO', 
                  'name'=>'Publications Office',
                  'head' => 'ANGELINA E. BORICAN',
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
                  'head' => 'CHERRY E. ANGELES',
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
                  'head' => 'ARTEMUS  CRUZ',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BT', 
                  'name'=>'PUP BATAAN BRANCH',
                  'head' => 'LEONILA J. GENERALES',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BN', 
                  'name'=>'PUP BIÑAN, LAGUNA CAMPUS',
                  'head' => 'JOSEFINA B. MACARUBBO',
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
                  'head' => 'FERNANDO F. ESTINGOR',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CL', 
                  'name'=>'PUP CALAUAN, LAGUNA CAMPUS',
                  'head' => 'GEMY LITO L. FESTIN',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GL', 
                  'name'=>'PUP GENERAL LUNA, QUEZON CAMPUS',
                  'head' => 'ADELIA R. ROADILLA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LQ', 
                  'name'=>'PUP LOPEZ, QUEZON BRANCH',
                  'head' => 'LOURDES  AVILA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MG', 
                  'name'=>'PUP MARAGONDON, CAVITE BRANCH',
                  'head' => 'DENISE A. ABRIL',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ML', 
                  'name'=>'PUP MULANAY, QUEZON BRANCH',
                  'head' => 'ADELIA R. ROADILLA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PQ', 
                  'name'=>'PUP PARAÑAQUE CITY CAMPUS',
                  'head' => 'AARON VITO M. BAYGAN',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PL', 
                  'name'=>'PUP PULILAN, BULACAN CAMPUS',
                  'head' => 'MARVIN M. ESPIRITU',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CM', 
                  'name'=>'PUP QUEZON CITY BRANCH',
                  'head' => 'EDGARDO S. DELMO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RG', 
                  'name'=>'PUP RAGAY, CAMARINES SUR BRANCH',
                  'head' => 'GLENDA A. BIEN',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SB', 
                  'name'=>'PUP SABLAYAN, OCCIDENTAL MINDORO CAMPUS',
                  'head' => 'LORENZA ELENA S. GIMUTAO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SJ', 
                  'name'=>'PUP SAN JUAN CITY CAMPUS',
                  'head' => 'JAIME P. GUTIERREZ',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SP', 
                  'name'=>'PUP SAN PEDRO, LAGUNA CAMPUS',
                  'head' => 'JOANNE  ANTONIO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SM', 
                  'name'=>'PUP STA. MARIA, BULACAN CAMPUS',
                  'head' => 'RICARDO F. RAMISCAL',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SR', 
                  'name'=>'PUP STA. ROSA, LAGUNA CAMPUS',
                  'head' => 'EMY LOU G. ALINSOD',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ST', 
                  'name'=>'PUP STO. TOMAS, BATANGAS BRANCH',
                  'head' => 'MICHAEL  CALABIG',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'TG', 
                  'name'=>'PUP TAGUIG CITY BRANCH',
                  'head' => 'MARIAN G. ARADA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UN', 
                  'name'=>'PUP UNISAN, QUEZON BRANCH',
                  'head' => 'EDWIN  MALABUYOC',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'QAC', 
                  'name'=>'Quality Assurance Center',
                  'head' => 'MARY JOY A. CASTILLO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RMO', 
                  'name'=>'Research Management Office',
                  'head' => 'RENATO  APA-AP',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RGO', 
                  'name'=>'Resource Generation Office',
                  'head' => 'ROLANDO M. COVERO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SSO', 
                  'name'=>'Safety and Security Office',
                  'head' => 'JIMMY M. FERNANDO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SHS', 
                  'name'=>'Senior High School',
                  'head' => 'ARCIBEL B. BAUTISTA',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SPPO', 
                  'name'=>'Special Programs and Projects Office',
                  'head' => 'MALAYA  YGOT',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SDPO', 
                  'name'=>'Sports Development Program Office',
                  'head' => 'LUALHATI A. DELA CRUZ',
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
                  'code' => 'UBS', 
                  'name'=>'University Board Secretary',
                  'head' => 'LIZYL R. REBUSQUILLO',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UCCA', 
                  'name'=>'University Center for Culture and the Arts',
                  'head' => 'BELY R. YGOT',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ULCO', 
                  'name'=>'University Legal Counsel Office',
                  'head' => 'JOVIT S. PONON',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            ]);
      }
}
