<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Mbackend extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->auth = unserialize(base64_decode($this->session->userdata('mLandkli333n')));
	}
	
	function getdata($type="", $p1="", $p2="",$p3="",$p4=""){
		$method = 'post';
		$balikan = "json";
		$url = $this->config->item('service_url');
		$data = array();
		
		switch($type){
			case "data_login":
				$data['method'] = 'read';
				$data['modul'] = 'login';
				$data['submodul'] = '';
				$data['member_user'] = '';
				$data['email_address'] = $p1;
				$data['pwd'] = $p2;
			break;
			case "property":
				$data['method'] = 'read';
				$data['modul'] = 'property';
				$data['submodul'] = '';
			break;
			case "roomtype":
				$data['method'] = 'read';
				$data['modul'] = 'combo_all';
				$data['submodul'] = 'cl_compulsary_periodic_payment';
				$data['id'] = 2;
			break;
		}
		
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		return $res;
	}
	
	function get_combo($type="", $p1="", $p2=""){
		
	}
	
	function simpandata($table,$data,$sts_crud){ //$sts_crud --> STATUS NYEE INSERT, UPDATE, DELETE
		
	}
	
}
