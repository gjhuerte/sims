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
                  'head' => 'Cristopher M. Cahayon',
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
                  'head' => 'Florinda H. Oquindo',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'AMS', 
                  'name'=>'Asset Management Office',
                  'head' => 'Virgilio  Mauricio',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BSO', 
                  'name'=>'Budget Services Office',
                  'head' => 'Florenita E. Imperial',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAF', 
                  'name'=>'College of Accountancy and Finance',
                  'head' => 'Sylvia A. Sarmiento',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAFA', 
                  'name'=>'College of Architecture and Fine Arts',
                  'head' => 'Ted Villamor G. Inocencio',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CAL', 
                  'name'=>'College of Arts and Letters',
                  'head' => 'Evangelina  Seril',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CBA', 
                  'name'=>'College of Business Administration',
                  'head' => 'Raquel  Ramos',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'COC', 
                  'name'=>'College of Communication',
                  'head' => 'Edna T. Bernabe',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CCIS', 
                  'name'=>'College of Computer and Information Sciences',
                  'head' => 'Gisela May A. Albano',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CoEd', 
                  'name'=>'College of Education',
                  'head' => 'Ma. Junithesmer  Rosales',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CE', 
                  'name'=>'College of Engineering',
                  'head' => 'Guillermo O. Bernabe',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CHK', 
                  'name'=>'College of Human Kinetics',
                  'head' => 'Maripres P. Pascua',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CL', 
                  'name'=>'College of Law',
                  'head' => 'Arlene R. Queri',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPSPA', 
                  'name'=>'College of Political Science and Public Administration',
                  'head' => 'Sanjay P. Claudio',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CS', 
                  'name'=>'College of Science',
                  'head' => 'Lincoln A. Bautista',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CSSD', 
                  'name'=>'College of Social Sciences and Development',
                  'head' => 'Nicolas T. Mallari',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CTHTM', 
                  'name'=>'College of Tourism, Hospitality and Transportation Management',
                  'head' => 'Marietta D. Reyes',
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
                  'head' => 'Kriztine  Viray',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CPS', 
                  'name'=>'Counseling and Psychological Services',
                  'head' => 'Nenita F. Buan',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'EMO', 
                  'name'=>'Extension Management Office',
                  'head' => 'Racidon P. Bernarte',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'FAMO', 
                  'name'=>'Facility Management Office',
                  'head' => 'Natan F. Gacute',
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
                  'head' => 'Catherine C. Oposa',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GSO', 
                  'name'=>'General Services Office',
                  'head' => 'Antonio 0 Velasco',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GS', 
                  'name'=>'Graduate School',
                  'head' => 'Carmencita L. Castolo',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'HRMD', 
                  'name'=>'Human Resource Management Department',
                  'head' => 'Adam V. Ramilo',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICTO', 
                  'name'=>'Information and Communications Technology Office',
                  'head' => 'Marlon M. Lim',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ICLS', 
                  'name'=>'Institute for Cultural and Language Studies',
                  'head' => 'Joseph Reylan B. Viray',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IDSA', 
                  'name'=>'Institute for Data and Statistical Analysis',
                  'head' => 'Lincoln A. Bautista',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ILIR', 
                  'name'=>'Institute for Labor and Industrial Relations',
                  'head' => 'Rimando E. Felicia',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISTR', 
                  'name'=>'Institute for Science and Technology Research',
                  'head' => 'Armin S. Coronado',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ISSD', 
                  'name'=>'Institute for Social Sciences and Development',
                  'head' => 'Hilda F. San Gabriel',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ITech', 
                  'name'=>'Institute of Technology',
                  'head' => 'Dante V. Gedaria',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPO', 
                  'name'=>'Institutional Planning Office',
                  'head' => 'Tomas O. Testor',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IPMO', 
                  'name'=>'Intellectual Property Management Office',
                  'head' => 'Jackie D. Urrutia',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'IAO', 
                  'name'=>'Internal Audit Office',
                  'head' => 'Realin C. Aranza',
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
                  'head' => 'Cristalina R. Piers',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LLRC', 
                  'name'=>'Library and Learning Resources Center',
                  'head' => 'Divina T. Pasumbal',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'DelPilar', 
                  'name'=>'M. H. Del Pilar Campus',
                  'head' => 'Jean Paul  Martirez',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MSD', 
                  'name'=>'Medical Services Department',
                  'head' => 'Ma. Liza  Yanes',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'NSTP', 
                  'name'=>'National Service Training Program Office',
                  'head' => 'Rovelina B. Jacolbia',
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
                  'head' => 'Herminia E. Manimtim',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OP', 
                  'name'=>'Office of the President',
                  'head' => 'Emanuel C. De Guzman',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OSS', 
                  'name'=>'Office of the Student Services',
                  'head' => 'Jose M. Abat',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUR', 
                  'name'=>'Office of the University Registrar',
                  'head' => 'Zenaida R. Sarmiento',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPAA', 
                  'name'=>'Office of the Vice President for Academic Affairs',
                  'head' => 'Manuel M. Muhi',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPA', 
                  'name'=>'Office of the Vice President for Administration',
                  'head' => 'Alberto C. Guillo',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPBSC', 
                  'name'=>'Office of the Vice President for Branches and Satellite Campuses',
                  'head' => 'Pascualito  Gatan',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPF', 
                  'name'=>'Office of the Vice President for Finance',
                  'head' => 'Marisa J. Legaspi',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPRED', 
                  'name'=>'Office of the Vice President for Research, Extension and Development',
                  'head' => 'Joseph 0 Mercado',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OVPSAS', 
                  'name'=>'Office of the Vice President for Student Affairs and Services',
                  'head' => 'Herminia E. Manimtim',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'OUS', 
                  'name'=>'Open University System',
                  'head' => 'Anna Ruby  Gapasin',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PASUC', 
                  'name'=>'PASUC Evaluation Committee',
                  'head' => 'Ben B. Andres',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PPDO', 
                  'name'=>'Physical Planning and Development Office',
                  'head' => 'Sherwin N. Nieva',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PRINTING', 
                  'name'=>'Printing Office',
                  'head' => 'Renato C. Vibiesca',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PMO', 
                  'name'=>'Procurement Management Office',
                  'head' => 'Henry V. Pascua',
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
                  'head' => 'Angelina E. Borican',
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
                  'head' => 'Conrado L. Nati',
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
                  'head' => 'Artemus  Cruz',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BT', 
                  'name'=>'PUP BATAAN BRANCH',
                  'head' => 'Leonila J. Generales',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'BN', 
                  'name'=>'PUP BIÑAN, LAGUNA CAMPUS',
                  'head' => 'Josefina B. Macarubbo',
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
                  'head' => 'Fernando F. Estingor',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'GL', 
                  'name'=>'PUP CALAUAN, LAGUNA CAMPUS',
                  'head' => 'Adelia R. Roadilla',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'LQ', 
                  'name'=>'PUP GENERAL LUNA, QUEZON CAMPUS',
                  'head' => 'Rufo  Bueza',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'MG', 
                  'name'=>'PUP LOPEZ, QUEZON BRANCH',
                  'head' => 'Denise A. Abril',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ML', 
                  'name'=>'PUP MARAGONDON, CAVITE BRANCH',
                  'head' => 'Adelia R. Roadilla',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PQ', 
                  'name'=>'PUP MULANAY, QUEZON BRANCH',
                  'head' => 'Aaron Vito M. Baygan',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'PL', 
                  'name'=>'PUP PARAÑAQUE CITY CAMPUS',
                  'head' => 'Ma. Elena M. Maño',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'CM', 
                  'name'=>'PUP PULILAN, BULACAN CAMPUS',
                  'head' => 'Firmo A. Esguerra',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RG', 
                  'name'=>'PUP QUEZON CITY BRANCH',
                  'head' => 'Anastacio 0 Gabriel',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SB', 
                  'name'=>'PUP RAGAY, CAMARINES SUR BRANCH',
                  'head' => 'Lorenza Elena S. Gimutao',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SJ', 
                  'name'=>'PUP SABLAYAN, OCCIDENTAL MINDORO CAMPUS',
                  'head' => 'Jaime P. Gutierrez',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SP', 
                  'name'=>'PUP SAN JUAN CITY CAMPUS',
                  'head' => 'Elmer  De Jose',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SM', 
                  'name'=>'PUP SAN PEDRO, LAGUNA CAMPUS',
                  'head' => 'Ricardo F. Ramiscal',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SR', 
                  'name'=>'PUP STA. MARIA, BULACAN CAMPUS',
                  'head' => 'Charito A. Montemayor',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ST', 
                  'name'=>'PUP STA. ROSA, LAGUNA CAMPUS',
                  'head' => 'Armando  Torres',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'TG', 
                  'name'=>'PUP STO. TOMAS, BATANGAS BRANCH',
                  'head' => 'Marissa B. Ferrer',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UN', 
                  'name'=>'PUP TAGUIG CITY BRANCH',
                  'head' => 'Edwin  Malabuyoc',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'QAC', 
                  'name'=>'PUP UNISAN, QUEZON BRANCH',
                  'head' => 'Adela Cristeta 0 Ruiz',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RMO', 
                  'name'=>'Quality Assurance Center',
                  'head' => 'Racidon  Bernarte',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'RGO', 
                  'name'=>'Research Management Office',
                  'head' => 'Rolando M. Covero',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SSO', 
                  'name'=>'Resource Generation Office',
                  'head' => 'Jimmy M. Fernando',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SHS', 
                  'name'=>'Safety and Security Office',
                  'head' => 'Corazon C. Tahil',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SPPO', 
                  'name'=>'Senior High School',
                  'head' => 'Malaya  Ygot',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SDPO', 
                  'name'=>'Special Programs and Projects Office',
                  'head' => 'Lualhati A. Dela Cruz',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'SA', 
                  'name'=>'Sports Development Program Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UBS', 
                  'name'=>'Students',
                  'head' => 'Gary C. Aure',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'UCCA', 
                  'name'=>'University Board Secretary',
                  'head' => 'Bely R. Ygot',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => 'ULCO', 
                  'name'=>'University Center for Culture and the Arts',
                  'head' => 'Joanna Marie A. Liao',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                  'code' => '', 
                  'name'=>'University Legal Counsel Office',
                  'head' => '',
                  'created_at' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
            ),
            ]);
      }
}
