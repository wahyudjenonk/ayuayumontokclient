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
			case "property_detail":
				$data['method'] = 'read';
				$data['modul'] = 'property';
				$data['submodul'] = 'detil';
				$data['id'] = $p1;
			break;
			case "roomtype":
				$data['method'] = 'read';
				$data['modul'] = 'combo_all';
				$data['submodul'] = 'cl_room_type';
				$data['id'] = 2;
			break;
			case "generalfacility":
				$data['method'] = 'read';
				$data['modul'] = 'combo_all';
				$data['submodul'] = 'cl_facility_unit';
				$data['id'] = 2;
			break;
			case "compulsary":
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
	
	function simpandata($table,$post,$sts_crud){ //$sts_crud --> STATUS NYEE INSERT, UPDATE, DELETE
		$method = 'post';
		$balikan = "json";
		$url = $this->config->item('service_url');
		$data = array();
		
		switch($table){
			case "property":
				if($sts_crud == 'add'){
					$data['method'] = 'create';
				}elseif($sts_crud == 'edit'){
					$data['method'] = 'update';
					$data['id'] = $post['ifdx'];
				}
				
				$arraycountroomtype = array();
				if(isset($post['rmtype'])){
					$countroomtype = (count($post['rmtype']) - 1);					
					for($i=0; $i <= $countroomtype; $i++){
						if(isset($post['rmtype'][$i])){
							$arraycountroomtype[] = $post['rmtype'][$i];
						}
					}
				}
				
				$arraycountfacilityunit = array();
				$arraycountfacilityqty = array();
				if(isset($post['facility_unit_qty'])){
					$countfacility = (count($post['facility_unit_qty']) - 1);
					for($j=0; $j <= $countfacility; $j++){
						if($post['facility_unit_qty'][$j] != ''){
							$arraycountfacilityunit[] = $post['idxfacun'][$j];
							$arraycountfacilityqty[] = $post['facility_unit_qty'][$j];
						}
					}
				}
				
				$arraycompultype = array();
				if(isset($post['compultype'])){
					$countcompulsary = (count($post['compultype']) - 1);
					for($k=0; $k <= $countcompulsary; $k++){
						if(isset($post['compultype'][$k])){
							$arraycompultype[] = $post['compultype'][$k];
						}
					}
				}
				
				$data['modul'] = 'property';
				$data['submodul'] = '';
				$data['tbl_member_user'] = $this->auth['member_user'];
				$data['unit_number'] = $post['untmem'];
				$data['unit_size_nett'] = $post['untsizenett'];
				$data['unit_size_gross'] = $post['untsizegros'];
				$data['unit_type'] = $post['unttyp'];
				$data['number_of_room'] = $post['numroom'];
				$data['floor_number'] = $post['flrnum'];
				$data['view'] = $post['untviw'];
				$data['apartment_name'] = $post['apartnm'];
				$data['apartment_developer'] = $post['apartdevnm'];
				$data['apartment_address'] = $post['apartaddr'];
				$data['cl_room_type_id'] = $arraycountroomtype;
				$data['cl_facility_unit_id'] = $arraycountfacilityunit;
				$data['qty'] = $arraycountfacilityqty;
				$data['cl_compulsary_periodic_payment_id'] = $arraycompultype;
				
				//echo "<pre>";
				//print_r($arraycountroomtype);
				//exit;				
			break;
		}
		
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		if($res['msg'] == 'sukses'){
			return 1;
		}else{
			return 0;
		}
	}
	
}
