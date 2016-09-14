<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Backend extends JINGGA_Controller {
	
	function __construct(){
		parent::__construct();
		if(!$this->auth){
			$this->nsmarty->display('backend/main-login.html');
			exit;
		}
		$this->nsmarty->assign('acak', md5(date('H:i:s')) );
		$this->temp="backend/";
		$this->load->model('mbackend');
		$this->load->library(array('encrypt','lib'));
	}
	
	function index(){
		if($this->auth){
			$this->nsmarty->display( 'backend/main-backend.html');
		}else{
			$this->nsmarty->display( 'backend/main-login.html');
		}
	}
	
	function modul($p1,$p2){
		if($this->auth){
			$temp = 'backend/modul/'.$p1.'/'.$p2.'.html';
			
			switch($p1){
				case "dashboard":
					
				break;
				case "property":
					switch($p2){
						case "main":
							$dataproperty = $this->mbackend->getdata('property');
							$this->nsmarty->assign('dataproperty', $dataproperty);
						break;
						case "form":
							$editstatus = $this->input->post('eds');
							$temp = 'backend/modul/'.$p1.'/formproperty.html';
							if($editstatus == 'edit'){
								
							}elseif($editstatus == 'add'){
								$roomtype = $this->mbackend->getdata('roomtype');
								
								$this->nsmarty->assign('roomtype', $roomtype);
							}
							

						break;
					}
				break;
			}
			
			
			$this->nsmarty->assign("main", $p1);
			$this->nsmarty->assign("mod", $p2);
			if(!file_exists($this->config->item('appl').APPPATH.'views/'.$temp)){
				$page = $this->nsmarty->fetch('konstruksi.html');}
			else{
				$page = $this->nsmarty->fetch($temp);
			}
			
			$array_page = array(
				'loadbalancedt' => md5('Ymd'),
				'loadbalancetm' => md5('H:i:s'),
				'loadtmr' => md5('YmdHis'),
				'page' => $page
			);
			
			echo json_encode($array_page);
			//*/
		}
	}	
		
	function get_grid($mod){
		$temp = 'backend/modul/grid_config.html';
		$this->nsmarty->assign('mod',$mod);
		if(!file_exists($this->config->item('appl').APPPATH.'views/'.$temp)){$this->nsmarty->display('konstruksi.html');}
		else{$this->nsmarty->display($temp);}
	}
	
	
	function getdisplay($type="", $p1="", $p2=""){
		$display = false;
		switch($type){
			case "get-form":
			
			break;
		}
		
		if($display == true){
			$this->nsmarty->display($temp);
		}
	}	
	
	function getdata($p1,$p2="",$p3=""){
		echo $this->mbackend->getdata($p1,'json',$p3);
	}
	
	function simpandata($p1="",$p2=""){
		if($this->input->post('mod'))$p1=$this->input->post('mod');
		$post = array();
        foreach($_POST as $k=>$v){
			if($this->input->post($k)!=""){
				$post[$k] = $this->input->post($k);
			}
		}
		if(isset($post['editstatus'])){$editstatus = $post['editstatus'];unset($post['editstatus']);}
		else $editstatus = $p2;
		
		echo $this->mbackend->simpandata($p1, $post, $editstatus);
	}
	
	function test(){
		$roomtype = $this->mbackend->getdata('roomtype');
		print_r($roomtype);
	}
}
