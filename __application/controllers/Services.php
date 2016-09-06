<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Services extends JINGGA_Controller {
	
	function __construct(){
		parent::__construct();
		
	}
	
	function tes_lib()
	{
		$this->load->library('lib');
		$url='http://localhost/homtel_server/index.php/jingga_api/user/id/1/format/json';//METHOD POST
		$data=array('method' => 'delete');//DATA UNTUK PUT
		$method='post';
		$balikan="json";
		$res=$this->lib->jingga_curl($url,$data,$method,$balikan);
		print_r($res);
	}
	
	
}
