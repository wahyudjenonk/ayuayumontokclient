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
			
			case "dashboard_atas":
				$data['method'] = 'read';
				$data['modul'] = 'dashboard_atas';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "dashboard_bawah":
				$data['method'] = 'read';
				$data['modul'] = 'dashboard_bawah';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "property":
				$data['method'] = 'read';
				$data['modul'] = 'property_all';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "property_detail":
				$data['method'] = 'read';
				$data['modul'] = 'property';
				$data['submodul'] = 'detil';
				$data['id'] = $p1;
				$data['tbl_member_user'] = $this->auth['member_user'];
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
			
			case "services":
				$data['method'] = 'read';
				$data['modul'] = 'services';
				$data['submodul'] = '';
			break;
			case "detailservices":
				$data['method'] = 'read';
				$data['modul'] = 'services';
				$data['submodul'] = '';
				$data['type_services'] = $p1;
			break;
			case "servicepaket":
				$data['method'] = 'read';
				$data['modul'] = 'services';
				$data['submodul'] = '';
				$data['type_services'] = 2;
			break;
			case "servicepackageheader":
				$data['method'] = 'read';
				$data['modul'] = 'package';
				$data['submodul'] = '';
				$data['services_id'] = $p1;
			break;
			case "servicepackagedetail":
				$data['method'] = 'read';
				$data['modul'] = 'package';
				$data['submodul'] = 'detil';
				$data['id'] = $p1;
			break;
			case "summaryservices":
				$data['method'] = 'read';
				$data['modul'] = 'pricing_pilih';
				$data['submodul'] = '';
				$data['tbl_services_id'] = $p1;
			break;
			
			case "trxindependent":
				$data['method'] = 'read';
				$data['modul'] = 'invoice';
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "trxindependentdetail":
				$data['method'] = 'read';
				$data['modul'] = 'invoice';
				$data['submodul'] = 'detil';
				$data['id'] = $p1;
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "trxpackage":
				$data['method'] = 'read';
				$data['modul'] = 'invoice_package';
			break;
			case "trxpackagedetail":
				$data['method'] = 'read';
				$data['modul'] = 'invoice_package';
				$data['submodul'] = 'detil';
				$data['id'] = $p1;
			break;
			case "dataprofile":
				$data['method'] = 'read';
				$data['modul'] = 'profile';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
			break;
			
			case "dataproperty_listingmanagement":
				$data['method'] = 'read';
				$data['modul'] = 'listing_property';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "datareservation":
				$data['method'] = 'read';
				$data['modul'] = 'listing_reservation';
				$data['submodul'] = '';
				$data['id_transaction'] = $p1;
			break;
			case "detailreservation":
				$data['method'] = 'read';
				$data['modul'] = 'reservation';
				$data['submodul'] = '';
				$data['id_reservasi'] = $p1;
			break;
			
			case "propertyonservice":
				$data['method'] = 'read';
				$data['modul'] = 'property_service';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "propertyready":
				$data['method'] = 'read';
				$data['modul'] = 'property_ready';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
			break;
			
			case "planningindependent":
				$data['method'] = 'read';
				$data['modul'] = 'planning_independent';
				$data['submodul'] = '';
				$data['id_transaction'] = $p1;
			break;
			
			case "getokupansi":
				$data['method'] = 'read';
				$data['modul'] = 'okupansi';
				$data['submodul'] = '';
				$data['tbl_unit_member_id'] = $p1;
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "getconfirmasireservation":
				$data['method'] = 'read';
				$data['modul'] = 'confirm_data';
				$data['submodul'] = '';
				$data['tbl_unit_member_id'] = $p1;
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "latestreservation":
				$data['method'] = 'read';
				$data['modul'] = 'list_reservasi_unit';
				$data['submodul'] = '';
				$data['tbl_unit_member_id'] = $p1;
				$data['member_user'] = $this->auth['member_user'];
			break;
			case "harga_kamar":
				$data['method'] = 'read';
				$data['modul'] = 'get_harga_kamar';
				$data['submodul'] = '';
				$data['id_transaction'] = $p1;
			break;
			
			case "datasetting":
				$data['method'] = 'read';
				$data['modul'] = 'data_on_off';
				$data['submodul'] = '';
				$data['tbl_unit_member_id'] = $p1;
				$data['member_user'] = $this->auth['member_user'];
			break;
			
			
		}
		
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		return $res;
	}
	
	function get_combo($type="", $p1="", $p2=""){
		
	}
	
	function simpandata($table,$post,$post2="",$sts_crud=""){ //$sts_crud --> STATUS NYEE INSERT, UPDATE, DELETE
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
				
				$arrayphotounit = array();
				if(isset($post['uplfileold'])){
					$countphotoold = (count($post['uplfileold']) - 1);
					$idx = 0;
					for($q=0; $q <= $countphotoold; $q++){
						if(isset($post['uplfileold'][$q])){
							$arrayphotounit[$idx] = $post['uplfileold'][$q];
						}
						$idx++;
					}
				}
				if($_FILES['uplfile']){
					$path = '__repository/property/';
					$countphoto = (count($_FILES['uplfile']['name']) - 1);					
					if(isset($idx)){
						$idx2 = $idx;
					}else{
						$idx2 = 0;
					}
					for($o=0; $o <= $countphoto; $o++){
						$t = microtime(true);
						$micro = sprintf("%06d",($t - floor($t)) * 1000000);
						$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
						
						if($_FILES['uplfile']['name'][$o] != ''){
							$apart_name = str_replace(" ","", $post['apartnm']);
							$file_p = $d->format("YmdHisu")."-".strtolower($apart_name);
							$filename_p =  $this->lib->uploadmultiplenong($path, 'uplfile', $file_p, $o); 
							$arrayphotounit[$idx2] = $filename_p;
						}						
						$idx2++;
					}
				}
				
				//echo "<pre>";print_r($arrayphotounit);exit;
				$string = $post['apartnm'];
				$expstr = explode(" ", $string);
				$tag = "";
				foreach($expstr as $k){
					$stringnya = $k;
					$tag .= $stringnya[0];
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
				$data['tag'] = $tag;
				$data['ipl'] = str_replace('.','',$post['untipl']);
				$data['flag'] = 'P';
				$data['cl_room_type_id'] = $arraycountroomtype;
				$data['cl_facility_unit_id'] = $arraycountfacilityunit;
				$data['qty'] = $arraycountfacilityqty;
				$data['cl_compulsary_periodic_payment_id'] = $arraycompultype;
				$data['photo_unit'] = $arrayphotounit;
				
				//echo "<pre>";
				//print_r($data);
				//exit;				
			break;
			case "property_delete":
				$data['method'] = 'delete';
				$data['modul'] = 'property';
				$data['submodul'] = '';
				$data['id'] = $post['uui'];
			break;
			case "submit_services":
				$arraypricingid = array();
				$arrayqty = array();
				$arraytot = array();
				$arrayflag = array();
				
				$arraylistingid = array();
				$arraylistingmanagement = array();
				
				if(isset($post['prc'])){
					$countinput = (count($post['prc']) - 1);
					for($i=0; $i <= $countinput; $i++){
						if(isset($post['ii'][$i])){
							$arraypricingid[] = $post['ii'][$i];
						}
						
						if(isset($post['qty'][$i])){
							$arrayqty[] = $post['qty'][$i];
						}
						
						if(isset($post['subtot'][$i])){
							$arraytot[] = $post['subtot'][$i];
						}
						
						if(isset($post['period'][$i])){
							$arrayflag[] = $post['period'][$i];
						}
					}
				}
					
				if(isset($post['idsrvlist'])){
					$countlist = (count($post['idsrvlist']) - 1);
					for($j=0; $j <= $countlist; $j++){
						if(isset($post['idsrvlist'][$j])){
							$arraylistingid[] = $post['idsrvlist'][$j];
						}
					}
					
					$arraylistingmanagement['start_date'] = $post['datefirst'];
					$arraylistingmanagement['end_date'] = $post['datelast'];
					$arraylistingmanagement['rental_price'] = $post['pricelisting'];
					$arraylistingmanagement['price_services_id'] = $arraylistingid;
				}
			
				$data['method'] = 'create';
				$data['modul'] = 'transaction';
				$data['submodul'] = '';
				$data['tbl_member_user'] = $this->auth['member_user'];
				$data['cl_method_payment_id'] = 1;
				$data['grand_total'] = $post['grandtot'];
				$data['tbl_unit_member_id'] = $post['ip'];
				$data['flag'] = 'P';
				if($post['ext'] == 'extra_order'){
					$data['kode'] = "EXT";
				}				
				$data['tbl_pricing_services_id'] = $arraypricingid;
				$data['qty'] = $arrayqty;
				$data['total'] = $arraytot;
				$data['flag_transaction'] = $arrayflag;
				$data['listing_management'] = $arraylistingmanagement;
				
				//echo "<pre>";
				//print_r($data);exit;
			break;
			case "submit_services_package":
				$date = explode(' - ', $post['daterange']);
				$start_date = date_format(date_create_from_format(' m/d/Y', $date[0]), 'Y-m-d');
				$end_date = date_format(date_create_from_format(' m/d/Y', $date[1]), 'Y-m-d');
				
				$data['method'] = 'create';
				$data['modul'] = 'invoice_package';
				$data['submodul'] = '';
				$data['tbl_member_user'] = $this->auth['member_user'];
				$data['tbl_unit_member_id'] = $post['ip'];
				$data['cl_method_payment_id'] = 1;
				$data['tbl_package_header_id'] = $post2['detil'][0]['tbl_package_header_id'];
				$data['flag'] = 'P';
				$data['total'] = $post2['paket'][0]['total_package'];
				$data['rental_price'] = str_replace('.', '', $post['dailyprice']);
				$data['rental_price_monthly'] = str_replace('.', '', $post['monthlyprice']);
				$data['start_date'] = $start_date;
				$data['end_date'] = $end_date;
			break;
			case "submit_change_password":
				$data['method'] = 'update';
				$data['modul'] = 'update_pwd';
				$data['submodul'] = '';
				$data['member_user'] = $this->auth['member_user'];
				$data['pwd_old'] = $post['oldpass'];
				$data['pwd_new'] = $post['newpass'];
			break;
			case "submit_update_profile":
				$datalawas = $this->getdata('dataprofile');
				$data['method'] = 'update';
				$data['modul'] = 'profil';
				$data['submodul'] = '';
				$data['id'] = $datalawas['data']['id'];
				$data['cl_owner_type_id'] = $post['typown'];
				$data['title'] = $post['titown'];
				$data['owner_name_first'] = $post['fname'];
				$data['owner_name_last'] = $post['lname'];
				$data['place_of_birth'] = $post['plofbirth'];
				$data['date_of_birth'] = $post['thbirth']."-".$post['blbirth']."-".$post['tgbirth'];
				$data['previous_education'] = $post['edown'];
				$data['current_occupation'] = $post['jobown'];
				$data['city'] = $post['citown'];
				$data['state'] = $post['sttown'];
				$data['zip_code'] = $post['zpown'];
				$data['address'] = $post['addrown'];
				$data['phone_home'] = $post['phhmown'];
				$data['phone_mobile'] = $post['phmbown'];
				$data['id_number'] = $post['idcrdown'];
				
				$path = "__repository/";
				$t = microtime(true);
				$micro = sprintf("%06d",($t - floor($t)) * 1000000);
				$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
				
				if($_FILES['idcrdfile']['name'] != ''){
					$scanktp = str_replace(" ","", $post['fname']);
					$file_scanktp = $d->format("YmdHisu")."_scanidcard_".strtolower($scanktp);
					$filename_scanktp =  $this->lib->uploadnong($path."scanktp/", 'idcrdfile', $file_scanktp); 
					if($filename_scanktp){
						if($datalawas['data']['photo_id_number']){
							unlink($path."scanktp/".$datalawas['data']['photo_id_number']);
						}
					}
					$data['photo_id_number'] = $filename_scanktp;
				}
				
				if($_FILES['photoprofile']['name'] != ''){
					$profile = str_replace(" ","", $post['fname']);
					$file_profile = $d->format("YmdHisu")."_profile_".strtolower($profile);
					$filename_profile =  $this->lib->uploadnong($path."profile/", 'photoprofile', $file_profile); 
					if($filename_profile){
						if($datalawas['data']['photo_profile']){
							unlink($path."profile/".$datalawas['data']['photo_profile']);
						}
					}
					$data['photo_profile'] = $filename_profile;
				}
				
			break;
			case "submit_verification_profile":
				if($post['reg_code'] == $this->auth['registration_code']){
					$datalawas = $this->getdata('dataprofile');
					$data['method'] = 'update';
					$data['modul'] = 'profil';
					$data['submodul'] = '';
					$data['id'] = $datalawas['data']['id'];
					$data['cl_owner_type_id'] = $post['typown'];
					$data['title'] = $post['titown'];
					$data['owner_name_first'] = $post['fname'];
					$data['owner_name_last'] = $post['lname'];
					$data['place_of_birth'] = $post['plofbirth'];
					$data['date_of_birth'] = $post['thbirth']."-".$post['blbirth']."-".$post['tgbirth'];
					$data['previous_education'] = $post['edown'];
					$data['current_occupation'] = $post['jobown'];
					$data['city'] = $post['citown'];
					$data['state'] = $post['sttown'];
					$data['zip_code'] = $post['zpown'];
					$data['address'] = $post['addrown'];
					$data['phone_home'] = $post['phhmown'];
					$data['phone_mobile'] = $post['phmbown'];
					$data['id_number'] = $post['idcrdown'];
					
					$path = "__repository/";
					$t = microtime(true);
					$micro = sprintf("%06d",($t - floor($t)) * 1000000);
					$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
					
					if($_FILES['idcrdfile']['name'] != ''){
						$scanktp = str_replace(" ","", $post['fname']);
						$file_scanktp = $d->format("YmdHisu")."_scanidcard_".strtolower($scanktp);
						$filename_scanktp =  $this->lib->uploadnong($path."scanktp/", 'idcrdfile', $file_scanktp); 
						if($filename_scanktp){
							if($datalawas['data']['photo_id_number']){
								unlink($path."scanktp/".$datalawas['data']['photo_id_number']);
							}
						}
						$data['photo_id_number'] = $filename_scanktp;
					}
					
					if($_FILES['photoprofile']['name'] != ''){
						$profile = str_replace(" ","", $post['fname']);
						$file_profile = $d->format("YmdHisu")."_profile_".strtolower($profile);
						$filename_profile =  $this->lib->uploadnong($path."profile/", 'photoprofile', $file_profile); 
						if($filename_profile){
							if($datalawas['data']['photo_profile']){
								unlink($path."profile/".$datalawas['data']['photo_profile']);
							}
						}
						$data['photo_profile'] = $filename_profile;
					}
					
					echo "<pre>";
					print_r($data);exit;
					//$uid = array("flag_complete_reg" => "1", "flag_ver_sms" => "1");
					//$this->session->set_userdata($uid);
				}else{
					return 3; //verification salah
					exit;
				}
			break;
			
			case "submit_confirmation":
				$data['method'] = 'create';
				$data['modul'] = 'konfirmasi';
				$data['submodul'] = '';
				$data['no_invoice'] = $post['nkonf'];
				$data['total_pay'] = (int)str_replace('.','',$post['total_trf']);
				$data['bank_name'] = $post['bank_name'];
				$data['sending_name'] = $post['bank_account'];
				$data['date_transfer'] = date_format(date_create_from_format('d/m/Y', $post['date_trf']), 'Y-m-d');
				$data['bank_name_receipt'] = 'BCA';
				
				/*
				echo "<pre>";
				print_r($data);
				exit;
				//*/
			break;
			
			case "settingkalendar":
				$data['method'] = 'create';
				$data['modul'] = 'seting_reservasi';
				$data['tbl_transaction_package_id'] = $post['idtrx'];
				$data['start_date'] = $post['date'];
				$data['end_date'] = $post['date'];
				$data['flag'] = 'of';
				$data['create_by'] = $this->auth['name'];
			break;
			case "removesettingkalendar":
				$data['method'] = 'delete';
				$data['modul'] = 'seting_reservasi';
				$data['id'] = $post['idxw'];			
			break;
		}
		
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		if($res['msg'] == 'sukses'){
			return 1;
		}else{
			if($table == 'submit_change_password'){
				return $res['pesan'];
			}else{
				//return $res['pesan'];
				return 0;
				//return $res;
			}
		}
	}
	
}
