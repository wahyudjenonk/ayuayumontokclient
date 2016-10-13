<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends JINGGA_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library(array('encrypt','lib'));
	}
	
	public function index(){
		//$user = $this->db->escape_str($this->input->post('user'));
		//$pass = $this->db->escape_str($this->input->post('pwd'));
		//echo $user;exit;
		//echo $this->encrypt->encode($pass);exit; D36CE6
		
		$error=false;
		$user = $this->input->post('user');
		$pass = $this->input->post('pwd');
		if($user && $pass){
			$cek_user = $this->mbackend->getdata('data_login', $user, $pass);
			//print_r($cek_user);exit;
			
			if($cek_user['msg'] == 'sukses'){
				$this->session->set_userdata('mLandkli333n', base64_encode(serialize($cek_user['data'])));
			}else{
				$error=true;
				$this->session->set_flashdata('error', $cek_user['pesan']);
			}
		}else{
			$error=true;
			$this->session->set_flashdata('error', 'Please Fill Username & Password');
		}
		header("Location: " . $this->host ."property");
	
		
	}
	
	function logout(){
		$this->session->unset_userdata('mLandkli333n', 'limit');
		$this->session->sess_destroy();
		header("Location: " . $this->host ."property");
	}
	
	function registrasiuser(){
		$this->load->library('Recaptcha');		
		$this->nsmarty->assign('html_captcha', $this->recaptcha->render());
		$this->nsmarty->assign('tgl_lahir', $this->lib->fillcombo('tgl_register', 'return') );
		$this->nsmarty->assign('bln_lahir', $this->lib->fillcombo('bln_register', 'return') );
		$this->nsmarty->assign('thn_lahir', $this->lib->fillcombo('thn_register', 'return') );
		$this->nsmarty->display('backend/main-register-1.html');
	}
	
	function registrasiuser2($p1=""){
		
		$form_number = "FRMREG-".strtoupper($this->lib->randomString(8));
		$registration_date = date('Y-m-d');
		$registration_date2 = date('d-m-Y');
		$decoding_word = $this->lib->base64url_decode($p1);
		$decoding 	= explode('|', $decoding_word);
				
		$firstname 	= $decoding[0];
		$lastname 	= $decoding[1];
		$emailaddr 	= $decoding[3];
		$phone 		= $decoding[4];
		$datebirth 	= $decoding[2];
		
		$encoding_email = $this->lib->base64url_encode($emailaddr);
		$date = explode('-', $datebirth);
		$datebirth2 = $date[2].'-'.$date[1].'-'.$date[0];
		
		$this->nsmarty->assign("ownsts", $this->lib->fillcombo('owner_status', 'return') );
		$this->nsmarty->assign("title", $this->lib->fillcombo('owner_title', 'return') );
		$this->nsmarty->assign("preved", $this->lib->fillcombo('prev_education', 'return') );
		$this->nsmarty->assign("formnumber", $form_number);
		$this->nsmarty->assign("registrationdate", $registration_date);
		$this->nsmarty->assign("registration_date2", $registration_date2);
		$this->nsmarty->assign("firstname", $firstname);
		$this->nsmarty->assign("lastname", $lastname);
		$this->nsmarty->assign("datebirth", $datebirth);
		$this->nsmarty->assign("datebirth2", $datebirth2);
		$this->nsmarty->assign("emailaddr", $emailaddr);
		$this->nsmarty->assign("encoding_email", $encoding_email);
		$this->nsmarty->assign("phone", $phone);
		
		$this->nsmarty->display('backend/main-register-2.html');
	}
	
	function registrasiuser3($email=""){
		if($email){
			$decoding_email = $this->lib->base64url_decode($email);
			$this->nsmarty->assign('email', $decoding_email);
		}
		
		$this->nsmarty->display('backend/main-register-3.html');
	}
	
	function forgotpasssss(){
		$this->nsmarty->display('backend/main-forgotpassword.html');
	}
	
	function messagesubmit(){
		$status = $this->input->post('stsn');
		$type = $this->input->post('tp');
		$this->nsmarty->assign('type', $type);	
		$this->nsmarty->assign('status', $status);	
		echo $this->nsmarty->display('backend/main-registersts.html');	
	}	
	
	function submitforgotpass(){
		$this->load->library('encrypt');
		$method = 'post';
		$balikan = "json";
		$url = $this->config->item('service_url');
		$data = array();
		$data['method'] = 'read';
		$data['modul'] = 'forgot_pwd';
		$data['submodul'] = '';
		$data['email_address'] = $this->input->post('mail');
		
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		if($res['msg'] == 'sukses'){
			$res['data']['pwd'] = $this->encrypt->decode($res['data']['pwd']);
			$this->lib->kirimemail('email_forgot', $this->input->post('mail'), $res);
		}
		
		$this->nsmarty->assign('type', 'forgot-password');
		$this->nsmarty->assign('res', $res);
		$this->nsmarty->display('backend/main-registersts.html');
	}
	
	function submitregistrasi(){
		$post = array();
		foreach($_POST as $k=>$v){
			if($this->input->post($k)!=""){
				$post[$k] = $this->input->post($k);
			}else{
				$post[$k] = null;
			}
		}
		
		$method = 'post';
		$balikan = "json";
		$url = $this->config->item('service_url');
		$page = array();
		$data = array();
		if($post['step'] == 'step-1-registration'){
			$this->load->library('Recaptcha');
			$captcha_answer = $this->input->post('g-recaptcha-response');
			$responseRecapcai = $this->recaptcha->verifyResponse($captcha_answer);
			
			if($responseRecapcai['success']) {
				$data['method'] = 'read';
				$data['modul'] = 'forgot_pwd';
				$data['submodul'] = '';
				$data['email_address'] = $post['emadd'];
				$data['phone_mobile'] = $post['phmob'];
				
				$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
				if($res['data'] == ''){
					$this->lib->kirimemail('email_register_step1', $post['emadd'], $post, $this->host);
					$status = 1;
				}else{
					$status = 2;
				}
			}else{
				$status = 0;
			}
			
			echo $status;
		}elseif($post['step'] == 'step-2-registration'){
			$data['method'] = 'create';
			$data['modul'] = 'registrasi';
			$data['submodul'] = '';
			
			if(!empty($_FILES['fileidnumb']['name'])){
				$path = '__repository/scanktp/';
				$nm = str_replace(' ', '', $post['frstnm']);
				$file = date('YmdHis')."_".strtolower($nm);
				$filename =  $this->lib->uploadnong($path, 'fileidnumb', $file);
				$data['photo_id_number'] = $filename;
			}
			
			$data['form_number'] = $post['formnu'];
			$data['registration_date'] = $post['regdate'];
			$data['cl_owner_type_id'] = $post['owntype'];
			$data['owner_name_last'] = $post['lstnm'];
			$data['owner_name_first'] = $post['frstnm'];
			$data['title'] = $post['ttl'];
			$data['id_number'] = $post['idnmb'];
			$data['place_of_birth'] = $post['plcbirth'];
			$data['date_of_birth'] = $post['brtdate'];
			$data['address'] = $post['addr'];
			$data['city'] = $post['cty'];
			$data['state'] = $post['stt'];
			$data['zip_code'] = $post['zpco'];
			$data['phone_home'] = $post['phhom'];
			$data['phone_mobile'] = $post['phmob'];
			$data['email'] = $post['emadd'];
			$data['current_occupation'] = $post['curroccu'];
			$data['previous_education'] = $post['preved'];
			$data['name_ceo'] = $post['ceopart'];
			$data['company_name'] = $post['compname'];
			$data['company_address'] = $post['compaddr'];
			$data['company_phone'] = $post['comphone'];
			
			$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
			if($res['msg'] == 'sukses'){
				//$this->nsmarty->assign('email', $post['emadd']);
				//$this->nsmarty->display('backend/main-register-3.html');
				echo 1;
			}else{
				//$this->nsmarty->assign('type', 'registrasi-step2');
				//$this->nsmarty->assign('res', $res);
				//$this->nsmarty->display('backend/main-registersts.html');
				echo 0;
			}
			
		}elseif($post['step'] == 'step-3-finishing'){
			$data['method'] = 'update';
			$data['modul'] = 'registrasi';
			$data['submodul'] = '';
			$data['email_address'] = $post['mail'];
			$data['kode_registration'] = $post['reqcode'];
			$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
			
			if($res['msg'] == 'sukses'){
				$this->lib->kirimemail('email_register_step2', $post['mail'], $res, $this->host);
				echo 1;
			}else{
				echo 0;
			}
			
			/*
			$this->nsmarty->assign('type', 'aktivasi');
			$this->nsmarty->assign('res', $res);
			$this->nsmarty->display('backend/main-registersts.html');
			*/
		}			
			
	}
	
	function aktivasiuser($p1, $p2, $p3){
		$data = array();
		$data['method'] = 'update';
		$data['modul'] = 'registrasi';
		$data['submodul'] = '';
		$data['email_address'] = base64_decode($p1);
		$data['pwd'] = base64_decode($p2);
		$data['member_user'] = base64_decode($p3);
		
		$method = 'post';
		$balikan = "json";
		$url = $this->config->item('service_url');
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		
		$this->nsmarty->assign('type', 'aktivasi');
		$this->nsmarty->assign('res', $res);
		$this->nsmarty->display('backend/main-registersts.html');
		
		/*
			http://localhost:81/public_codeigniter/margahayu_client/activate/dHJpd2FoeXVudWdyb2hvMTFAZ21haWwuY29t/RDM2Q0U2/QUIzNzRF
		*/
	}
	
	function testmail(){
		$email = 'triwahyunugroho11@gmail.com';
		$res = array(
			'data' => array(
				'email_address' => 'triwahyunugroho11@gmail.com',
				'pwd' => 'xx789'
			),
			'msg' => 'sukses'
		);
		
		echo $this->lib->kirimemail('email_register', $email, $res, $this->host);
	}
	
	function tester(){
 		//$encoding1  = base64_encode('triwahyunugroho11@gmail.com');
 		//$encoding2  = urlencode(base64_encode('30E563'));
		//$this->load->library('encrypt');
		//$word = "triwahyunugroho11@gmail.com";
		//echo $this->encrypt->encode($word);
		
		//$encoding1 = $this->lib->base64url_encode('triwahyunugroho11@gmail.com');
		//$decoding1 = $this->lib->base64url_decode($encoding1);
		//echo $encoding1." - ".$decoding1;
		
		$this->nsmarty->display('tester.html');
	}
	
}
