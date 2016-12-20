<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends JINGGA_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){				
		$this->load->library('Recaptcha');		
		$this->nsmarty->assign('html_captcha', $this->recaptcha->render());
		//$this->nsmarty->assign('html_captcha2', $this->recaptcha->render());
		$this->nsmarty->assign('tgl_lahir', $this->lib->fillcombo('tgl_register', 'return') );
		$this->nsmarty->assign('bln_lahir', $this->lib->fillcombo('bln_register', 'return') );
		$this->nsmarty->assign('thn_lahir', $this->lib->fillcombo('thn_register', 'return') );
		$this->nsmarty->display( 'frontend/main-index.html');		
	}
	
	function logtemp(){
		$this->nsmarty->display( 'frontend/main-login.html');		
	}
	
	function registrasiuser2($p1=""){
		$form_number = "FRMREG-".strtoupper($this->lib->randomString(8));
		$registration_date = date('Y-m-d');
		$registration_date2 = date('d-m-Y');
		$decoding_word = $this->lib->base64url_decode($p1);
		$decoding 	= explode('|', $decoding_word);
				
		$firstname 	= $decoding[0];
		$lastname 	= $decoding[1];
		$emailaddr 	= $decoding[2];
		$phone 		= $decoding[3];
		/*
		$datebirth 	= $decoding[2];
		$date = explode('-', $datebirth);
		$datebirth2 = $date[2].'-'.$date[1].'-'.$date[0];
		*/

		$encoding_email = $this->lib->base64url_encode($emailaddr);
		
		$this->nsmarty->assign("ownsts", $this->lib->fillcombo('owner_status', 'return') );
		$this->nsmarty->assign("title", $this->lib->fillcombo('owner_title', 'return') );
		$this->nsmarty->assign("preved", $this->lib->fillcombo('prev_education', 'return') );
		$this->nsmarty->assign("formnumber", $form_number);
		$this->nsmarty->assign("registrationdate", $registration_date);
		$this->nsmarty->assign("registration_date2", $registration_date2);
		$this->nsmarty->assign("firstname", $firstname);
		$this->nsmarty->assign("lastname", $lastname);
		//$this->nsmarty->assign("datebirth", $datebirth);
		//$this->nsmarty->assign("datebirth2", $datebirth2);
		$this->nsmarty->assign("emailaddr", $emailaddr);
		$this->nsmarty->assign("encoding_email", $encoding_email);
		$this->nsmarty->assign("phone", $phone);
		
		$this->nsmarty->display('frontend/main-register-2.html');
	}
	
	function registrasiuser3($email=""){
		if($email){
			$decoding_email = $this->lib->base64url_decode($email);
			$this->nsmarty->assign('email', $decoding_email);
		}
		$this->nsmarty->display('frontend/main-register-3.html');
	}	
	
	function getdisplay($type="", $p1="", $p2="", $p3=""){
		switch($type){
			case "main_page":								
				$this->nsmarty->display( 'frontend/main-index.html');
			break;
			default:
				$this->nsmarty->display( 'frontend/'.$type.'.html');
			break;
		}
	}
		
}
