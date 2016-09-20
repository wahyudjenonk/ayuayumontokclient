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
	
	function modul($p1,$p2,$p3=""){
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
							$roomtype = $this->mbackend->getdata('roomtype');
							$generalfacility = $this->mbackend->getdata('generalfacility');
							$compulsary = $this->mbackend->getdata('compulsary');
							
							if($editstatus == 'edit'){
								$id = $this->input->post('ixd');
								$data = $this->mbackend->getdata('property_detail', $id);
								
								if($data['data']['room_type']){
									foreach($roomtype['data'] as $k => $v){
										$roomtype['data'][$k]['flagcheck'] = '';
										foreach($data['data']['room_type'] as $t => $y){
											if($y['cl_room_type_id'] == $v['id']){
												$roomtype['data'][$k]['flagcheck'] = 'checked';
											}
										}
									}
								}
								
								if($data['data']['compulsary']){
									foreach($compulsary['data'] as $kk => $vv){
										$compulsary['data'][$kk]['flagcheck'] = '';
										foreach($data['data']['compulsary'] as $tt => $yy){
											if($yy['cl_compulsary_periodic_payment_id'] == $vv['id']){
												$compulsary['data'][$kk]['flagcheck'] = 'checked';
											}
										}
									}
								}
								
								if($data['data']['facility']){
									foreach($generalfacility['data'] as $z => $x){
										$generalfacility['data'][$z]['qty'] = '';
										foreach($data['data']['facility'] as $u => $b){
											if($b['cl_facility_unit_id'] == $x['id']){
												$generalfacility['data'][$z]['qty'] = $b['qty'];
											}
										}
									}
								}
								
								$this->nsmarty->assign('data', $data['data']['properti']);
								$this->nsmarty->assign('foto', $data['data']['photo']);
							}
							
							$this->nsmarty->assign('roomtype', $roomtype);
							$this->nsmarty->assign('generalfacility', $generalfacility);
							$this->nsmarty->assign('compulsary', $compulsary);
							$this->nsmarty->assign('editstatus', $editstatus);
						break;
						case "request_services":
							$temp = 'backend/modul/'.$p1.'/formservices.html';
							$id = $this->input->post('uuii');
							$unit_name = $this->input->post('nmii');
							$dataservices = $this->mbackend->getdata('services');
							
							
							$arrayservice = array();
							$arrayservice[0]['idserv'] = "1";
							$arrayservice[0]['serv'] = "Independent";
							$arrayservice[1]['idserv'] = "2";
							$arrayservice[1]['serv'] = "Package";						
							
							$this->nsmarty->assign('unit_name', $unit_name);
							$this->nsmarty->assign('services', $arrayservice);
						break;
						case "detail_services":
							$temp = 'backend/modul/'.$p1.'/detailservices.html';
							$tpsr = $this->input->post('uuii');
							$datadetailservice = $this->mbackend->getdata('detailservices', $tpsr);
							
							/*
							echo "<pre>";
							print_r($datadetailservice);
							*/
							
							$this->nsmarty->assign('type_service', $tpsr);
							$this->nsmarty->assign('detailservices', $datadetailservice['data']);
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
		//if($this->input->post('mod'))$p1=$this->input->post('mod');
		
		$post = array();
        foreach($_POST as $k=>$v){
			if($this->input->post($k)!=""){
				$post[$k] = $this->input->post($k);
			}else{
				$post[$k] = null;
			}
		}
				
		if(isset($post['editstatus'])){
			$editstatus = $post['editstatus'];unset($post['editstatus']);
		}else{ 
			$editstatus = $p2; 
		}
		
		echo $this->mbackend->simpandata($p1, $post, $editstatus);
	}
	
	function upload(){
		//print_r($_FILES);exit;
		//echo microtime();exit;
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
		$mod=$this->input->post('mod');
		switch($mod){
			case "property":				
				$upload_path='__repository/property/';
				$object='file_nya';
				if(isset($_FILES['file_nya'])){
					$file=$_FILES['file_nya']['name'];
					$nameFile =$d->format("YmdHisu");// $this->string_sanitize(pathinfo($file, PATHINFO_FILENAME));
					$upload=$this->lib->uploadnong($upload_path, $object, $nameFile);
					if($upload){
						echo 1;
					}else{
						echo 2;
					}
				}
			break;
			
		}
		//echo $upload;
	}	
	
	function test($p1){
		$data = $this->mbackend->getdata('property_detail', $p1);
		$roomtype = $this->mbackend->getdata('roomtype');
		$generalfacility = $this->mbackend->getdata('generalfacility');
		$compulsary = $this->mbackend->getdata('compulsary');
		
		if($data['data']['room_type']){
			foreach($roomtype['data'] as $k => $v){
				$roomtype['data'][$k]['flagcheck'] = 'false';
				foreach($data['data']['room_type'] as $t => $y){
					if($y['cl_room_type_id'] == $v['id']){
						$roomtype['data'][$k]['flagcheck'] = 'true';
					}
				}
			}
		}
		
		if($data['data']['compulsary']){
			foreach($compulsary['data'] as $kk => $vv){
				$compulsary['data'][$kk]['flagcheck'] = 'false';
				foreach($data['data']['compulsary'] as $tt => $yy){
					if($yy['cl_compulsary_periodic_payment_id'] == $vv['id']){
						$compulsary['data'][$kk]['flagcheck'] = 'true';
					}
				}
			}
		}
		
		if($data['data']['facility']){
			foreach($generalfacility['data'] as $z => $x){
				$generalfacility['data'][$z]['qty'] = '';
				foreach($data['data']['facility'] as $u => $b){
					if($b['cl_facility_unit_id'] == $x['id']){
						$generalfacility['data'][$z]['qty'] = $b['qty'];
					}
				}
			}
		}
		
		echo "<pre>";
		print_r($generalfacility);exit;
		
	}
}
