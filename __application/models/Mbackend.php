<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Mbackend extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->auth = unserialize(base64_decode($this->session->userdata('mLandkli333n')));
	}
	
	function getdata($type="", $balikan="", $p1="", $p2="",$p3="",$p4=""){
		$where = " WHERE 1=1 ";
		if($this->input->post('key')){
				$where .=" AND ".$this->input->post('kat')." like '%".$this->db->escape_str($this->input->post('key'))."%'";
		}
		switch($type){
			case "data_login":
				$sql = "
					SELECT *
					FROM tbl_user 
					WHERE nama_user = '".$p1."'
				";
			break;
		}
		
		if($balikan == 'json'){
			return $this->lib->json_grid($sql);
		}elseif($balikan == 'row_array'){
			return $this->db->query($sql)->row_array();
		}elseif($balikan == 'result'){
			return $this->db->query($sql)->result();
		}elseif($balikan == 'result_array'){
			return $this->db->query($sql)->result_array();
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
