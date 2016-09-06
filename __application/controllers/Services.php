<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Services extends JINGGA_Controller {
	
	function __construct(){
		parent::__construct();
		
	}
	
	function tes_registrasi()
	{
		$this->load->library('lib');
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'create',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'registrasi',
					'sub_modul'=>'',
					'cl_owner_type_id'=>1,
					'owner_name_last'=>'Goyzzz',
					'owner_name_first'=>'Cuyzz',
					'title'=>'Mr.',
					'id_number'=>'20031299091200',
					'email'=>'goyz837@gmail.com'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	function tes_aktivasi_user()
	{
		$this->load->library('lib');
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'update',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'registrasi',
					'sub_modul'=>'',
					'email_address'=>'goyz87@gmail.com',
					'pwd'=>'12345'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	function tes_login()
	{
		$this->load->library('lib');
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',
					'modul'=>'login',
					'sub_modul'=>'',
					'member_user'=>'',
					'email_address'=>'goyz87@gmail.com',
					'pwd'=>'12345'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	
}
