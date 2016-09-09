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
			
			if(count($cek_user)>0){
				if($pass == $this->encrypt->decode($cek_user['data']['pwd'])){
					$this->session->set_userdata('mLandkli333n', base64_encode(serialize($cek_user['data'])));
				}else{
					$error=true;
					$this->session->set_flashdata('error', 'Invalid Password');
				}
			}else{
				$error=true;
				$this->session->set_flashdata('error', 'User not Registered');
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
		$form_number = "FRMREG-".strtoupper($this->lib->randomString(8));
		$registration_date = date('Y-m-d');
		
		$this->nsmarty->assign("ownsts", $this->lib->fillcombo('owner_status', 'return') );
		$this->nsmarty->assign("title", $this->lib->fillcombo('owner_title', 'return') );
		$this->nsmarty->assign("preved", $this->lib->fillcombo('prev_education', 'return') );
		$this->nsmarty->assign("frmnu", $form_number);
		$this->nsmarty->assign("regdate", $registration_date);
		$this->nsmarty->display('backend/main-register.html');
	}
	
	function forgotpasssss(){
		$this->nsmarty->display('backend/main-forgotpassword.html');
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
		//print_r($post);exit;
		
		$data = array();
		$data['method'] = 'create';
		$data['modul'] = 'registrasi';
		$data['submodul'] = '';
		$data['form_number'] = $post['formnu'];
		$data['registration_date'] = $post['regdate'];
		$data['cl_owner_type_id'] = $post['owntype'];
		$data['owner_name_last'] = $post['frstnm'];
		$data['owner_name_first'] = $post['lstnm'];
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
		
		$method = 'post';
		$balikan = "json";
		$url = $this->config->item('service_url');
		$res = $this->lib->jingga_curl($url,$data,$method,$balikan);
		//echo "<pre>";
		//print_r($res);exit;
		
		if($res['msg'] == 'sukses'){
			$this->lib->kirimemail('email_register', $res['data']['email_address'], $res, $this->host);
		}
		
		$this->nsmarty->assign('type', 'registrasi');
		$this->nsmarty->assign('res', $res);
		$this->nsmarty->display('backend/main-registersts.html');
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
	
	function testencode(){
 		$encoding1  = urlencode(base64_encode('triwahyunugroho11@gmail.com'));
 		$encoding2  = urlencode(base64_encode('30E563'));
		
		
		echo $encoding1."-".$encoding2;
	}
	
}
