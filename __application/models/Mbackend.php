<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Mbackend extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->auth = unserialize(base64_decode($this->session->userdata('mLandkli333n')));
	}
	
	function getdata($type="", $p1="", $p2="",$p3="",$p4=""){
		
		switch($type){
			case "data_login":
				$data = array();
				$data['method'] = 'read';
				$data['modul'] = 'login';
				$data['submodul'] = '';
				$data['email_address'] = $p1;
				$data['pwd'] = $p2;

				$method = 'post';
				$balikan = "json";
				$url = $this->config->item('service_url');
				$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
				
				return $res;
			break;
		}
		
	}
	
	function get_combo($type="", $p1="", $p2=""){
	
	}
	
	function simpandata($table,$data,$sts_crud){ //$sts_crud --> STATUS NYEE INSERT, UPDATE, DELETE
		$this->db->trans_begin();
		if(isset($data['id'])){
			$id = $data['id'];
			unset($data['id']);
		}
		
		switch($table){
			case "admin":
				//print_r($data);exit;
				if($sts_crud=='add')$data['password']=$this->encrypt->encode($data['password']);
				if(!isset($data['status'])){$data['status']=0;}
			break;
		}
		
		switch ($sts_crud){
			case "add":
				$data['create_date'] = date('Y-m-d H:i:s');
				$data['create_by'] = $this->auth['nama_lengkap'];
				$this->db->insert($table,$data);
			break;
			case "edit":
				$this->db->update($table, $data, array('id' => $id) );
			break;
			case "delete":
				$this->db->delete($table, array('id' => $id));
			break;
		}
		
		if($this->db->trans_status() == false){
			$this->db->trans_rollback();
			return 0;
		}else{
			return $this->db->trans_commit();
		}
	
	}
	
}
