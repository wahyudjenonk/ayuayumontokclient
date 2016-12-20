<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Services extends JINGGA_Controller {
	
	function __construct(){
		parent::__construct();
		
	}
	/*
	Terima kasih [nama], Anda telah registrasi di Homtel, berikut kode SMS verifikasi [kode] .
	Infomasi hub tlp/wa +6281285558861 www.homtel.id
	*/
	function tes_registrasi()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'create',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'registrasi',
					'submodul'=>'',
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
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'update',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'registrasi',
					'submodul'=>'',
					'email_address'=>'triwahyunugroho11@gmail.com',
					'kode_registration'=>123456
					//'pwd'=>'12345'
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
		$this->load->library('encrypt');
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
		//echo $this->encrypt->decode($res['data']['pwd']);
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
					'tbl_member_user'=>'0032',
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
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
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
	function tes_get_data_services()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'services',
					'submodul'=>'',
					'type_services'=>1,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_services_header()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'services_header',
					'submodul'=>'',
					//'id'=>2,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_services_detil()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'services_detil',
					'submodul'=>'',
					'id'=>2,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_transaction_insert()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		
		$tbl_pricing_services_id=array(15,12,13,69,71);//ISI CEKLIST FORM DARI TBL_PRICING_SERVICES DIAMBIL tbl_services_id nyaaaa...
		$listing_management=array('start_date'=>'2016-01-01',
								  'end_date'=>'2016-04-01',
								  'rental_price'=>250000,
								  'rental_price_monthly'=>1500,
								  'price_services_id'=>array(69,71)
		);// DATA KALO ADA SERVICES LISTING MANAGEMENT
		$data_qty=array(1,1,1,3,8);//DATA QTY ATAU JUMLAH BERAPA KALI
		$total=array(202000,211000,211000,0,0);//TOTAL DARI PENJUMLAHAN ANTARA HARGA SERVICES DIKALI QTY
		$flag_transaction=array('H','H','H','-','-');//FLAG TRANSACTION DIISI NILAI JIKA HARIAN H, MINGGUAN M, BULANAN B
		$data=array('method' => 'create',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'transaction',
					'submodul'=>'',
					'tbl_member_user'=>'99B009',
					'cl_method_payment_id'=>1,
					'grand_total'=>200000,
					'flag'=>'P',
					'tbl_pricing_services_id'=>$tbl_pricing_services_id,
					'qty'=>$data_qty,
					'total'=>$total,
					'tbl_unit_member_id'=>2,
					'tbl_member_user'=>'99B009',
					'flag_transaction'=>$flag_transaction,
					'listing_management'=>$listing_management
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_services_pilih()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$tbl_pricing_services_id=array(1,9,14,17,18);
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'pricing_pilih',
					'submodul'=>'',
					'tbl_services_id'=>$tbl_pricing_services_id,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_invoice_package()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'invoice_package',
					'submodul'=>'',
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_invoice_package_detil()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'invoice_package',
					'submodul'=>'detil',
					'id'=>1
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_invoice()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'invoice',
					'submodul'=>'',
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_invoice_detil()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'invoice',
					'submodul'=>'detil',
					'id'=>2
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_transaksi_package()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		//$listing_list=array(1,3,4,6=>'Tessss');//ISI CEKLIST FORM DARI LOOKUP CL LISTING LIST
		//$listing_affiliation=array('cl_listing_third_party_affiliation_id'=>1,'other'=>'');//ISI CL_AFFILATION
		/*$data_listing=array(
			'listing_platform'=>'Xxxxx',
			'listing_user'=>'TOSSSS',
			'listing_pwd'=>'123',
			'pictures_taking'=>'Personal',//ISI NYE LIAT EXCEL
			'unit_management'=>'Belooo',//ISI NYE LIAT EXCEL
			'management_contact_name'=>'Goyz',
			'management_contact_number'=>'09829129',
			'management_contact_relation'=>'Kacung',
			'daily_price_min'=>1000,
			'daily_price_max'=>10000,
			'monthly_price_min'=>10000,
			'monthly_price_max'=>100000,
			'weekly_price_min'=>200,
			'weekly_price_max'=>400,
			'yearly_price_min'=>500,
			'yearly_price_max'=>500
		);//POST FORM DATA TBl LISTING MEMBER ADA TEMPLATE NYA DI EXCELLLLL CUNG
		*/
		$data=array('method' => 'create',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'invoice_package',
					'submodul'=>'',
					'tbl_member_user'=>'99B009',
					'tbl_unit_member_id'=>2,
					'cl_method_payment_id'=>2,
					'tbl_package_header_id'=>2,//KHUSUS UNTUK TYPE SERVICEES NYE 2 CUNG yaitu Yang Package
					'flag'=>'P',
					'total'=>15000,
					'rental_price'=>25000,
					'rental_price_monthly'=>115000,
					'start_date'=>'2016-10-31',
					'end_date'=>'2016-11-30'
					//'listing_data'=>$data_listing,
					//'listing_affiliation'=>$listing_affiliation,
					//'listing_list'=>$listing_list
					
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo '<pre>';
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_paket()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'package',
					'submodul'=>'',
					'services_id'=>4
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_paket_detil()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'package',
					'submodul'=>'detil',
					'id'=>1,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_ubah_password()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'update',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'update_pwd',
					'submodul'=>'',
					'member_user'=>'005232',
					'pwd_old'=>'123456',
					'pwd_new'=>'12345'
		);
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	function tes_get_data_profil()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'profile',
					'submodul'=>'',
					'member_user'=>'005232'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_profil_edit()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		
		
		$data=array('method' => 'update',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'profil',
					'submodul'=>'',
					'id'=>6,//ID get data dari profil
					'owner_name_last'=>'xxx',
					'owner_name_first'=>'yyyy',
					'title'=>'Mr.',
					'id_number'=>'20031299091200',
					'place_of_birth'=>'Bangka',
					'date_of_birth'=>date('Y-m-d'),
					'address'=>'20031299091200'// DAN LAIN2 ITEM DARI PROFILLLLLL
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_listing_property()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'listing_property',
					'submodul'=>'',
					'member_user'=>'996E13'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_listing_reservation()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'listing_reservation',
					'submodul'=>'',
					'id_transaction'=>5 //DIDAPET DARI GET DATA  tes_get_data_listing_property BRAYYYY
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	
	function tes_konfirmasi_insert()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'create',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'konfirmasi',
					'submodul'=>'',
					'no_invoice'=>'INV-005232-00003',
					'total_pay'=>100000,
					'bank_name'=>'Mandiri',
					'sending_name'=>'Xxxxxxxxx',
					'date_transfer'=>'2016-10-10',
					'bank_name_receipt'=>'BCA',
					
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_reservation_detil()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'reservation',
					'submodul'=>'',
					'id_reservasi'=>1,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_services_paket()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'services',
					'submodul'=>'',
					'type_services'=>2,
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_seting_reservasi_insert()
	{
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		
		$data=array('method' => 'create',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'seting_reservasi',
					'submodul'=>'',
					'tbl_transaction_package_id'=>1,
					'tbl_package_header_id'=>1,
					'tbl_package_detil_id'=>9,
					'start_date'=>'2016-11-11',//KHUSUS UNTUK TYPE SERVICEES NYE 2 CUNG yaitu Yang Package
					'end_date'=>'2016-11-12',
					'flag'=>'off',
					'create_by'=>'Goyz',
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo '<pre>';
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_property_all()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property_all',
					'submodul'=>'',
					'member_user'=>'996E13'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	
	function tes_get_data_property_detil_trans()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property_all',
					'submodul'=>'',
					'member_user'=>'996E13'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_property_service()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property_service',
					'submodul'=>'',
					'member_user'=>'996E13'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_dashboard_atas()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'dashboard_atas',
					'submodul'=>'',
					'member_user'=>'996E13'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_dashboard_bawah()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'dashboard_bawah',
					'submodul'=>'',
					'member_user'=>'996E13'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	function tes_get_data_property_ready()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read', //ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'property_ready',
					'submodul'=>'',
					'member_user'=>'996E13'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	
	function tes_get_data_planning_independent()
	{
		$this->load->library('lib');
		$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		//$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'planning_independent',
					'submodul'=>'',
					'id_transaction'=>1
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
		//echo $res['msg'];
	}
	
	function get_okupansi(){
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'okupansi',
					'submodul'=>'',
					'tbl_unit_member_id'=>3,
					'member_user'=>'99B009'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
	}
	function get_confirm_data(){
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'confirm_data',
					'submodul'=>'',
					'tbl_unit_member_id'=>3,
					'member_user'=>'99B009'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
	}
	function get_reservasi_unit(){
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'list_reservasi_unit',
					'submodul'=>'',
					'tbl_unit_member_id'=>3,
					'member_user'=>'99B009'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
	}
	function get_data_on_off(){
		$this->load->library('lib');
		//$url='http://localhost:81/public_codeigniter/margahayu_backend/index.php/jingga_api/jingga';//METHOD POST
		$url='http://localhost/homtel_server/index.php/jingga_api/jingga';//METHOD POST
		$data=array('method' => 'read',//ISI METHOD NYA CRUD YE CUNG.. CREATE READ UPDATE DELETE
					'modul'=>'data_on_off',
					'submodul'=>'',
					'tbl_unit_member_id'=>3,
					'member_user'=>'99B009'
		);//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		echo "<pre>";
		print_r($res);
	}
	
}
