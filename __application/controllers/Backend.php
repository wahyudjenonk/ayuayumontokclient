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
							$unit_size = $this->input->post('mii');
							$dataservices = $this->mbackend->getdata('services');
							
							$arrayservice = array();
							$arrayservice[0]['idserv'] = "1";
							$arrayservice[0]['serv'] = "Independent";
							$arrayservice[0]['icon'] = "gbr_indie.png";
							$arrayservice[1]['idserv'] = "2";
							$arrayservice[1]['serv'] = "Package";		
							$arrayservice[1]['icon'] = "gbr_paket.png";							
							
							$this->nsmarty->assign('unit_name', $unit_name);
							$this->nsmarty->assign('unit_size', $unit_size);
							$this->nsmarty->assign('id', $id);
							$this->nsmarty->assign('services', $arrayservice);
						break;
						case "detail_services":
							$temp = 'backend/modul/'.$p1.'/detailservices.html';
							$tpsr = $this->input->post('uuii');
							$id = $this->input->post('uuiid');
							
							if($tpsr == 1){
								$datadetailservice = $this->mbackend->getdata('detailservices', $tpsr);							
								$this->nsmarty->assign('typeform', 'formdetailservices');
								$this->nsmarty->assign('detailservices', $datadetailservice['data']);
							}elseif($tpsr == 2){
								$datapackageheader = $this->mbackend->getdata('servicepackageheader');								
								$dataservice = array();
								foreach($datapackageheader['data']['paket'] as $k => $v){
									$dataservice[$k]['id'] = $v['id'];
									$dataservice[$k]['tbl_services_id'] = $v['tbl_services_id'];
									$dataservice[$k]['package_name'] = $v['package_name'];
									$dataservice[$k]['package_desc'] = $v['package_desc'];
									$dataservice[$k]['total_package'] = $v['total_package'];
									$dataservice[$k]['detail'] = array();
									$datapackagedetail = $this->mbackend->getdata('servicepackagedetail', $v['id']);
									foreach($datapackagedetail['data']['detil'] as $j => $y){
										$dataservice[$k]['detail'][$j]['id'] = $y['id'];
										$dataservice[$k]['detail'][$j]['header'] = $y['header'];
										$dataservice[$k]['detail'][$j]['header2'] = $y['header2'];
										$dataservice[$k]['detail'][$j]['services_name'] = $y['services_name'];
										$dataservice[$k]['detail'][$j]['tbl_package_header_id'] = $y['tbl_package_header_id'];
										$dataservice[$k]['detail'][$j]['tbl_services_id'] = $y['tbl_services_id'];
										$dataservice[$k]['detail'][$j]['qty'] = $y['qty'];
										$dataservice[$k]['detail'][$j]['rate'] = $y['rate'];
										$dataservice[$k]['detail'][$j]['of_unit'] = $y['of_unit'];
										$dataservice[$k]['detail'][$j]['of_area_item'] = $y['of_area_item'];
										$dataservice[$k]['detail'][$j]['percen'] = $y['percen'];
									}
								}
								
								$this->nsmarty->assign('typeform', 'formdetailservicespackage');
								$this->nsmarty->assign('detailservices', $dataservice);
							}
							
							$this->nsmarty->assign('typeservice', $tpsr);
							$this->nsmarty->assign('id', $id);
						break;
						case "summary_services":
							$temp = 'backend/modul/'.$p1.'/detailservices.html';
							$tpsr = $this->input->post('arrsrv');
							$id = $this->input->post('ipma');
							$stslt = $this->input->post('stslt');
							$arraylist = $this->input->post('arrlist');
							$datasummaryservice = $this->mbackend->getdata('summaryservices', $tpsr);
							
							foreach($datasummaryservice['data'] as $k => $v){
								$datasummaryservice['data'][$k]['flaglisting'] = '';
								if($stslt == 'true'){
									foreach($arraylist as $t){
										if($v['id'] == $t){
											$datasummaryservice['data'][$k]['flaglisting'] = 'true';
										}
									}
								}
							}
							
							$this->nsmarty->assign('typeform', 'summary');
							$this->nsmarty->assign('id', $id);
							$this->nsmarty->assign('stslt', $stslt);
							$this->nsmarty->assign('summaryservices', $datasummaryservice['data']);							
						break;
						case "summary_services_package":
							$temp = 'backend/modul/'.$p1.'/detailservices.html';
							$id = $this->input->post('ipma');
							$paketpilihan = $this->input->post('ipman');
							
							$detailpaket = $this->mbackend->getdata('servicepackagedetail', $paketpilihan);
							
							$this->nsmarty->assign('typeform', 'summary_package');
							$this->nsmarty->assign('id', $id);
							$this->nsmarty->assign('paketpilihan', $paketpilihan);
							$this->nsmarty->assign('summaryservices', $detailpaket['data']);
						break;
						case "submit_services":
							$temp = 'backend/modul/'.$p1.'/invoiceservice.html';
							$post = array();
							foreach($_POST as $k=>$v){
								if($this->input->post($k)!=""){
									$post[$k] = $this->input->post($k);
								}else{
									$post[$k] = null;
								}
							}
							
							$countinput = (count($post['prc']) - 1);
							$insert = $this->mbackend->simpandata("submit_services", $post);
							
							//$this->lib->kirimemail('email_invoice', $this->auth['email_address'], $post, $countinput);
							
							$this->nsmarty->assign('type', "services_independent");
							$this->nsmarty->assign('jmlpost', $countinput);
							$this->nsmarty->assign('post', $post);
							$this->nsmarty->display($temp);
							exit;
						break;
						case "submit_services_package":
							$temp = 'backend/modul/'.$p1.'/invoiceservice.html';
							$post = array();
							foreach($_POST as $k=>$v){
								if($this->input->post($k)!=""){
									$post[$k] = $this->input->post($k);
								}else{
									$post[$k] = null;
								}
							}
							
							$detailpaket = $this->mbackend->getdata('servicepackagedetail', $post['ipman']);
							$insert = $this->mbackend->simpandata("submit_services_package", $post, $detailpaket['data']);
							
							//$this->lib->kirimemail('email_invoice_package', $this->auth['email_address'], $detailpaket['data']);
							
							$this->nsmarty->assign('type', "services_package");
							$this->nsmarty->assign('datapaket', $detailpaket['data']);
							$this->nsmarty->display($temp);
							exit;
						break;
					}
				break;
				case "transaction":
					switch($p2){
						case "independent":
							$datatransaction = $this->mbackend->getdata('trxindependent');
							$this->nsmarty->assign('datatransaction', $datatransaction);
						break;
						case "independent_detail":
							$idtrx = $this->input->post('ipma');
							$datatrxdetail = $this->mbackend->getdata('trxindependentdetail', $idtrx);
							
							$this->nsmarty->assign('datatrxdetail', $datatrxdetail);
						break;
						case "package":
							$datatransaction = $this->mbackend->getdata('trxpackage');
							$this->nsmarty->assign('datatransaction', $datatransaction);
						break;
						case "package_detail":
							$idtrx = $this->input->post('ipma');
							$datatrxdetail = $this->mbackend->getdata('trxpackagedetail', $idtrx);
							
							$this->nsmarty->assign('datatrxdetail', $datatrxdetail);
						break;
					}
				break;
				
				case "user":
					case "profile_setting":
						$dataprofile = $this->mbackend->getdata('dataprofile');
						if($dataprofile['data']['date_of_birth']){
							$tgl_lahir = explode('-', $dataprofile['data']['date_of_birth']);
							$tgl = $tgl_lahir[2];
							$bln = $tgl_lahir[1];
							$thn = $tgl_lahir[0];
						}else{
							$tgl = null;
							$bln = null;
							$thn = null;
						}
						
						$this->nsmarty->assign('tgl_lahir', $this->lib->fillcombo('tgl_register', 'return', $tgl) );
						$this->nsmarty->assign('bln_lahir', $this->lib->fillcombo('bln_register', 'return', $bln) );
						$this->nsmarty->assign('thn_lahir', $this->lib->fillcombo('thn_register', 'return', $thn) );
						
						$this->nsmarty->assign("ownsts", $this->lib->fillcombo('owner_status', 'return', (isset($dataprofile['data']['cl_owner_type_id']) ? $dataprofile['data']['cl_owner_type_id'] : null) ) );
						$this->nsmarty->assign("title", $this->lib->fillcombo('owner_title', 'return', (isset($dataprofile['data']['title']) ? $dataprofile['data']['title'] : null) ) );
						$this->nsmarty->assign("preved", $this->lib->fillcombo('prev_education', 'return', (isset($dataprofile['data']['previous_education']) ? $dataprofile['data']['previous_education'] : null) ) );
						
						$this->nsmarty->assign('dataprofile', $dataprofile['data']);
					break;
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
		
		echo $this->mbackend->simpandata($p1, $post, "", $editstatus);
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
	
	function test(){
		echo "<pre>";
		print_r($this->auth);exit;
		
	}
}
