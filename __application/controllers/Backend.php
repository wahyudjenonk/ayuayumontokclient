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
							
							$contoharray = array();
							$contoharray[0]['idserv'] = "1";
							$contoharray[0]['nmparentserv'] = "Services House Keeping";
							$contoharray[0]['detail'] = array();
							$contoharray[0]['detail'][0]['idchildserv'] = '1.1';
							$contoharray[0]['detail'][0]['nmchildserv'] = 'House Keeping 1 Area';
							$contoharray[0]['detail'][0]['pricechildserv'] = 'Rp. 8.000,-';
							$contoharray[0]['detail'][1]['idchildserv'] = '1.2';
							$contoharray[0]['detail'][1]['nmchildserv'] = 'House Keeping 2 Area';
							$contoharray[0]['detail'][1]['pricechildserv'] = 'Rp. 9.000,-';
							$contoharray[0]['detail'][1]['idchildserv'] = '1.3';
							$contoharray[0]['detail'][1]['nmchildserv'] = 'House Keeping 3 Area';
							$contoharray[0]['detail'][1]['pricechildserv'] = 'Rp. 10.000,-';
							$contoharray[1]['idserv'] = "2";
							$contoharray[1]['nmparentserv'] = "Services Linen";
							$contoharray[1]['detail'] = array();
							$contoharray[1]['detail'][0]['idchildserv'] = '2.1';
							$contoharray[1]['detail'][0]['nmchildserv'] = 'Towel';
							$contoharray[1]['detail'][0]['pricechildserv'] = 'Rp. 8.000,-';
							$contoharray[1]['detail'][1]['idchildserv'] = '2.2';
							$contoharray[1]['detail'][1]['nmchildserv'] = 'Bed Cover';
							$contoharray[1]['detail'][1]['pricechildserv'] = 'Rp. 9.000,-';
							$contoharray[1]['detail'][1]['idchildserv'] = '2.3';
							$contoharray[1]['detail'][1]['nmchildserv'] = 'Duck Pillow';
							$contoharray[1]['detail'][1]['pricechildserv'] = 'Rp. 10.000,-';
							
							$this->nsmarty->assign('unit_name', $unit_name);
							$this->nsmarty->assign('arrayservices', $contoharray);
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
