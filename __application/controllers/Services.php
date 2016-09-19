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
					'submodul'=>'',
					'cl_owner_type_id'=>1,
					'owner_name_last'=>'Goyzzz',
					'owner_name_first'=>'Cuyzz',
					'title'=>'Mr.',
					'id_number'=>'20031299091200',
					'email'=>'goyz834ssa4ssaaa7@gmail.com'
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
					'submodul'=>'',
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
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',
					'modul'=>'login',
					'submodul'=>'',
					'member_user'=>'',
					'email_address'=>'triwahyunugroho11@gmail.com',
					'pwd'=>'839608'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	function tes_forgot_pwd()
	{
		$this->load->library('lib');
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',
					'modul'=>'forgot_pwd',
					'submodul'=>'',
					//'member_user'=>'',
					'email_address'=>'goyz87@gmail.com',
					//'pwd'=>'D36CE6'
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
					'submodul'=>'',
					'email_address'=>'triwahyunugroho11@gmail.com',
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";print_r($res);
	}
	
	function tes_property_insert()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		
		$data_compulsary_unit=array(1,3);//ISI CEKLIST FORM DARI LOOKUP CL_COMPULSARY...
		$data_facility_unit=array(2,6,3);//ISI CEKLIST FORM DARI LOOKUP CL_FACILITY... MESTI DIPOST AMA QTY
		$data_qty=array(20,65,380);//DATA QTY DAN FACLITIY TABLE tbl_unit_facility_member
		$data_room_type=array(1,3,4);//ISI CEKLIST FORM DARI LOOKUP CL_ROOM TYPE
		$data_photo=array('Xxx.JPG','YY.jpg');//ISI FOTO NYA
		$data=array('method' => 'create',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property',
					'submodul'=>'',
					'tbl_member_user'=>'99B009',
					'unit_number'=>100,
					'unit_size_nett'=>200,
					'unit_size_gross'=>1000,
					'flag'=>'P',
					'cl_compulsary_periodic_payment_id'=>$data_compulsary_unit,
					'cl_facility_unit_id'=>$data_facility_unit,
					'qty'=>$data_qty,
					'cl_room_type_id'=>$data_room_type,
					'photo_unit'=>$data_photo
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
		//echo $res['msg'];
	}
	function tes_property_edit()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		
		$data_compulsary_unit=array(1,3);//ISI CEKLIST FORM DARI LOOKUP CL_COMPULSARY...
		$data_facility_unit=array(20,60,30);//ISI CEKLIST FORM DARI LOOKUP CL_FACILITY... MESTI DIPOST AMA QTY
		$data_qty=array(200,650,3800);//DATA QTY DAN FACLITIY TABLE tbl_unit_facility_member
		$data_room_type=array(1,3,4);//ISI CEKLIST FORM DARI LOOKUP CL_ROOM TYPE
		$data_photo=array('x.JPG','Y.jpg');//ISI FOTO NYA
		$data=array('method' => 'update',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property',
					'submodul'=>'',
					'id'=>4,
					'unit_number'=>5000,
					'unit_size_nett'=>200,
					'unit_size_gross'=>1000,
					'flag'=>'P',
					'cl_compulsary_periodic_payment_id'=>$data_compulsary_unit,
					'cl_facility_unit_id'=>$data_facility_unit,
					'qty'=>$data_qty,
					'cl_room_type_id'=>$data_room_type,
					'photo_unit'=>$data_photo
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
		//echo $res['msg'];
	}
	function tes_property_delete()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'delete',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property',
					'submodul'=>'',
					'id'=>4
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_property()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property',
					'submodul'=>'',
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_property_detil()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property',
					'submodul'=>'detil',
					'id'=>7,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_combo()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'combo_all',
					'submodul'=>'cl_room_type',
					'id'=>2,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
}
