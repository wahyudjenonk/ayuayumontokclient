<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Services extends JINGGA_Controller {
	
	function __construct(){
		parent::__construct();
		
	}
	
	function tes_registrasi()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
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
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
		//echo $res['msg'];
	}
	function tes_aktivasi_user()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'update',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'registrasi',
					'sub_modul'=>'',
					'member_user'=>'AB384X',
					//'email'=>'goyz837@gmail.com',
					'email_address'=>'goyz837@gmail.com',
					'pwd'=>'12345'
		);
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	function tes_login()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',
					'modul'=>'login',
					'sub_modul'=>'',
					'member_user'=>'',
					'email_address'=>'triwahyunugroho11@gmail.com',
					'pwd'=>'D36CE6'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	
	function tes_forgot(){
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',
					'modul'=>'forgot_pwd',
					'sub_modul'=>'',
					'email_address'=>'triwahyunugroho11@gmail.com',
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	
}
