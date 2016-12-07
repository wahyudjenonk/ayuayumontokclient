<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	LIBRARY CIPTAAN JINGGA LINTAS IMAJI
	KONTEN LIBRARY :
	- Upload File
	- Upload File Multiple
	- RandomString
	- CutString
	- Kirim Email
	- Konversi Bulan
	- Fillcombo
	- Json Datagrid
	
*/
class lib {
	public function __construct(){
		
	}
	
	//class Upload File Version 1.0 - Beta
	function uploadnong($upload_path="", $object="", $file=""){
		//$upload_path = "./__repository/".$folder."/";
		
		$ext = explode('.',$_FILES[$object]['name']);
		$exttemp = sizeof($ext) - 1;
		$extension = $ext[$exttemp];
		
		$filename =  $file.'.'.$extension;
		
		$files = $_FILES[$object]['name'];
		$tmp  = $_FILES[$object]['tmp_name'];
		if(file_exists($upload_path.$filename)){
			unlink($upload_path.$filename);
			$uploadfile = $upload_path.$filename;
		}else{
			$uploadfile = $upload_path.$filename;
		} 
		
		move_uploaded_file($tmp, $uploadfile);
		if (!chmod($uploadfile, 0775)) {
			echo "Gagal mengupload file";
			exit;
		}
		
		return $filename;
	}
	// end class Upload File
	
	//class Upload File Multiple Version 1.0 - Beta
	function uploadmultiplenong($upload_path="", $object="", $file="", $idx=""){
		$ext = explode('.',$_FILES[$object]['name'][$idx]);
		$exttemp = sizeof($ext) - 1;
		$extension = $ext[$exttemp];
		
		$filename =  $file.'.'.$extension;
		
		$files = $_FILES[$object]['name'][$idx];
		$tmp  = $_FILES[$object]['tmp_name'][$idx];
		if(file_exists($upload_path.$filename)){
			unlink($upload_path.$filename);
			$uploadfile = $upload_path.$filename;
		}else{
			$uploadfile = $upload_path.$filename;
		} 
		
		move_uploaded_file($tmp, $uploadfile);
		if (!chmod($uploadfile, 0775)) {
			echo "Gagal mengupload file";
			exit;
		}
		
		return $filename;
	}
	//end Class Upload File
	
	//class Random String Version 1.0
	function randomString($length,$parameter="") {
        $str = "";
		$rangehuruf = range('A','Z');
		$rangeangka = range('0','9');
		if($parameter == 'angka'){
			$characters = array_merge($rangeangka);
		}elseif($parameter == 'huruf'){
			$characters = array_merge($rangehuruf);
		}else{
			$characters = array_merge($rangehuruf, $rangeangka);
		}
         $max = count($characters) - 1;
         for ($i = 0; $i < $length; $i++) {
              $rand = mt_rand(0, $max);
              $str .= $characters[$rand];
         }
         return $str;
    }
	//end Class Random String
	
	//Class CutString
	function cutstring($text, $length) {
		//$isi_teks = htmlentities(strip_tags($text));
		$isi = substr($text, 0,$length);
		//$isi = substr($isi_teks, 0,strrpos($isi," "));
		$isi = $isi.' ...';
		return $isi;
	}
	//end Class CutString
	
	//Class Kirim Email
	function kirimemail($type="", $email="", $p1="", $p2="", $p3=""){
		$ci =& get_instance();
		
		$ci->load->library('email');
		$html = "";
		$subject = "";
		switch($type){
			case "email_register_step1":				
				$firstname = trim($p1['frstnm']);
				$lastname = trim($p1['lstnm']);
				//$datebirth = $p1['thn']."-".$p1['bln']."-".$p1['tgl'];
				$emails = trim($p1['emadd']);
				$phone = trim($p1['phmob']);
				$encoding_word = $firstname."|".$lastname."|".$emails."|".$phone;
				$encoding = $this->base64url_encode($encoding_word);
				$link = $p2."register-step2/".$encoding;
				
				$ci->nsmarty->assign('type', "email-step1");
				$ci->nsmarty->assign('link', $link);
				$html = $ci->nsmarty->fetch('backend/email-register.html');
				$subject = "Register Step 1 - Homtel Services";
			break;
			case "email_register_step2":				
				$emails = $this->base64url_encode($p1['data']['email_address']);
				$pwd = $this->base64url_encode($p1['data']['pwd']);
				$member_user = $this->base64url_encode($p1['data']['member_user']);
				//$link = $p2.'activate/'.$emails.'/'.$pwd.'/'.$member_user;
				
				$ci->nsmarty->assign('datax', $p1);
				$ci->nsmarty->assign('type', "email-step2");
				//$ci->nsmarty->assign('link', $link);
				$html = $ci->nsmarty->fetch('backend/email-register.html');
				$subject = "Register Successfull - Homtel Services";
			break;
			case "email_forgot":
				$ci->nsmarty->assign('datax', $p1);
				$ci->nsmarty->assign('type', "email-forgot");
				$html = $ci->nsmarty->fetch('backend/email-register.html');
				$subject = "Request Forgot Password - Homtel Services";
			break;
			
			case "email_invoice":
				$ci->nsmarty->assign('type', "services_independent");
				$ci->nsmarty->assign('post', $p1);
				$ci->nsmarty->assign('jmlpost', $p2);
				$html = $ci->nsmarty->fetch('backend/modul/property/email_invoice.html');
				$subject = "Invoice Request Services - Homtel Services";
			break;
			case "email_invoice_package":
				$ci->nsmarty->assign('type', "services_package");
				$ci->nsmarty->assign('data', $p1);
				$html = $ci->nsmarty->fetch('backend/modul/property/email_invoice.html');
				$subject = "Invoice Request Services - Homtel Services";
			break;
		}
				
		$config = array(
			"protocol"	=>"smtp"
			,"mailtype" => "html"
			,"smtp_host" => "ssl://smtp.gmail.com"
			,"smtp_user" => "triwahyunugros@gmail.com"
			,"smtp_pass" => "ms6713saa"
			,"smtp_port" => "465",
			'charset' => 'utf-8',
            'wordwrap' => TRUE,
		);
		
		
		$ci->email->initialize($config);
		$ci->email->from("triwahyunugros@gmail.com", "Homtel Notifikasi");
		$ci->email->to($email);
		$ci->email->subject($subject);
		$ci->email->message($html);
		$ci->email->set_newline("\r\n");
		if($ci->email->send())
			//echo "<h3> SUKSES EMAIL ke $email </h3>";
			return 1;
		else
			//echo $this->email->print_debugger();
			return $ci->email->print_debugger();
	}	
	//End Class KirimEmail
	
	//Class Konversi Bulan
	function konversi_bulan($bln,$type=""){
		if($type == 'fullbulan'){
			switch($bln){
				case 1:$bulan='Januari';break;
				case 2:$bulan='Februari';break;
				case 3:$bulan='Maret';break;
				case 4:$bulan='April';break;
				case 5:$bulan='Mei';break;
				case 6:$bulan='Juni';break;
				case 7:$bulan='Juli';break;
				case 8:$bulan='Agustus';break;
				case 9:$bulan='September';break;
				case 10:$bulan='Oktober';break;
				case 11:$bulan='November';break;
				case 12:$bulan='Desember';break;
			}
		}else{
			switch($bln){
				case 1:$bulan='Jan';break;
				case 2:$bulan='Feb';break;
				case 3:$bulan='Mar';break;
				case 4:$bulan='Apr';break;
				case 5:$bulan='Mei';break;
				case 6:$bulan='Jun';break;
				case 7:$bulan='Jul';break;
				case 8:$bulan='Agst';break;
				case 9:$bulan='Sept';break;
				case 10:$bulan='Okt';break;
				case 11:$bulan='Nov';break;
				case 12:$bulan='Des';break;
			}
		}
		return $bulan;
	}
	//End Class Konversi Bulan
	
	//Class Konversi Tanggal
	function konversi_tgl($date){
		$ci =& get_instance();
		$ci->load->helper('terbilang');
		$data=array();
		$timestamp = strtotime($date);
		$day = date('D', $timestamp);
		$day_angka = (int)date('d', $timestamp);
		$month = date('m', $timestamp);
		$years = date('Y', $timestamp);
		switch($day){
			case "Mon":$data['hari']='Senin';break;
			case "Tue":$data['hari']='Selasa';break;
			case "Wed":$data['hari']='Rabu';break;
			case "Thu":$data['hari']='Kamis';break;
			case "Fri":$data['hari']='Jumat';break;
			case "Sat":$data['hari']='Sabtu';break;
			case "Sun":$data['hari']='Minggu';break;
		}
		switch($month){
			case "01":$data['bulan']='Januari';break;	
			case "02":$data['bulan']='Februari';break;	
			case "03":$data['bulan']='Maret';break;	
			case "04":$data['bulan']='April';break;	
			case "05":$data['bulan']='Mei';break;	
			case "06":$data['bulan']='Juni';break;	
			case "07":$data['bulan']='Juli';break;	
			case "08":$data['bulan']='Agustus';break;	
			case "09":$data['bulan']='September';break;	
			case "10":$data['bulan']='Oktober';break;	
			case "11":$data['bulan']='November';break;	
			case "12":$data['bulan']='Desember';break;	
		}
		$data['tahun']=ucwords(number_to_words($years));
		$data['tgl_text']=ucwords(number_to_words($day_angka));
		return $data;
	}
	//End Class Konversi Tanggal
	
	//Class Fillcombo
	function fillcombo($type="", $balikan="", $p1="", $p2="", $p3=""){
		$ci =& get_instance();
		$ci->load->model('mbackend');
		
		$v = $ci->input->post('v');
		if($v != ""){
			$selTxt = $v;
		}else{
			$selTxt = $p1;
		}
		
		$optTemp = '<option value=""> -- Choose -- </option>';
		switch($type){
			case "owner_status":
				$data = array(
					'0' => array('id'=>'1','txt'=>'Individual'),
					'1' => array('id'=>'2','txt'=>'Corporate / Partnership'),
				);
			break;
			case "owner_title":
				$data = array(
					'0' => array('id'=>'Mr.','txt'=>'Mr.'),
					'1' => array('id'=>'Mrs.','txt'=>'Mrs.'),
					'2' => array('id'=>'Ms.','txt'=>'Ms.'),
				);
			break;
			case "prev_education":
				$data = array(
					'0' => array('id'=>'highschool','txt'=>'Highschool'),
					'1' => array('id'=>'s1','txt'=>'S1'),
					'2' => array('id'=>'s2','txt'=>'S2'),
					'3' => array('id'=>'s3','txt'=>'S3'),
					'4' => array('id'=>'d3','txt'=>'D1/D3'),
					'5' => array('id'=>'other','txt'=>'Other'),
				);
			break;
			case "tgl_register":
				$optTemp = '<option value="">Date</option>';
				$data = array(
					'0' => array('id'=>'01','txt'=>'1'),
					'1' => array('id'=>'02','txt'=>'2'),
					'2' => array('id'=>'03','txt'=>'3'),
					'3' => array('id'=>'04','txt'=>'4'),
					'4' => array('id'=>'05','txt'=>'5'),
					'5' => array('id'=>'06','txt'=>'6'),
					'6' => array('id'=>'07','txt'=>'7'),
					'7' => array('id'=>'08','txt'=>'8'),
					'8' => array('id'=>'09','txt'=>'9'),
					'9' => array('id'=>'10','txt'=>'10'),
					'10' => array('id'=>'11','txt'=>'11'),
					'11' => array('id'=>'12','txt'=>'12'),
					'12' => array('id'=>'13','txt'=>'13'),
					'13' => array('id'=>'14','txt'=>'14'),
					'14' => array('id'=>'15','txt'=>'15'),
					'15' => array('id'=>'16','txt'=>'16'),
					'16' => array('id'=>'17','txt'=>'17'),
					'17' => array('id'=>'18','txt'=>'18'),
					'18' => array('id'=>'19','txt'=>'19'),
					'19' => array('id'=>'20','txt'=>'20'),
					'20' => array('id'=>'21','txt'=>'21'),
					'21' => array('id'=>'22','txt'=>'22'),
					'22' => array('id'=>'23','txt'=>'23'),
					'23' => array('id'=>'24','txt'=>'24'),
					'24' => array('id'=>'25','txt'=>'25'),
					'25' => array('id'=>'26','txt'=>'26'),
					'26' => array('id'=>'27','txt'=>'27'),
					'27' => array('id'=>'28','txt'=>'28'),
					'28' => array('id'=>'29','txt'=>'29'),
					'29' => array('id'=>'30','txt'=>'30'),
					'30' => array('id'=>'31','txt'=>'31'),
				);
			break;
			case "bln_register":
				$optTemp = '<option value="">Month</option>';
				$data = array(
					'0' => array('id'=>'01','txt'=>'January'),
					'1' => array('id'=>'02','txt'=>'February'),
					'2' => array('id'=>'03','txt'=>'Maret'),
					'3' => array('id'=>'04','txt'=>'April'),
					'4' => array('id'=>'05','txt'=>'May'),
					'5' => array('id'=>'06','txt'=>'June'),
					'6' => array('id'=>'07','txt'=>'July'),
					'7' => array('id'=>'08','txt'=>'August'),
					'8' => array('id'=>'09','txt'=>'September'),
					'9' => array('id'=>'10','txt'=>'October'),
					'10' => array('id'=>'11','txt'=>'November'),
					'11' => array('id'=>'12','txt'=>'December'),
				);
			break;
			case "thn_register":
				$optTemp = '<option value="">Year</option>';
				$data = array();
				$year = date('Y');
				$year_kurang = ($year-17);
				$no = 0;
				while($year_kurang >= 1960 ){
					array_push($data, array('id' => $year_kurang, 'txt'=>$year_kurang));
					$year_kurang--;
				}
			break;
			default:
				$data = $ci->mbackend->get_combo($type, $p1, $p2);
			break;
		}
		
		if($data){
			foreach($data as $k=>$v){
				if($selTxt == $v['id']){
					$optTemp .= '<option selected value="'.$v['id'].'">'.$v['txt'].'</option>';
				}else{ 
					$optTemp .= '<option value="'.$v['id'].'">'.$v['txt'].'</option>';	
				}
			}
		}
		
		if($balikan == 'return'){
			return $optTemp;
		}elseif($balikan == 'echo'){
			echo $optTemp;
		}
		
	}
	//End Class Fillcombo
	
	//Function Json Grid
	function json_grid($sql,$type="",$table=""){
		$ci =& get_instance();
		$ci->load->database();
		
		$page = (integer) (($ci->input->post('page')) ? $ci->input->post('page') : "1");
		$limit = (integer) (($ci->input->post('rows')) ? $ci->input->post('rows') : "10");
		$count = $ci->db->query($sql)->num_rows();
		
		if( $count >0 ) { $total_pages = ceil($count/$limit); } else { $total_pages = 0; } 
		if ($page > $total_pages) $page=$total_pages; 
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
		if($start<0) $start=0;
		 		
		$sql = $sql . " LIMIT $start,$limit";
					
		$data = $ci->db->query($sql)->result_array();  
				
		if($data){
		   $responce = new stdClass();
		   $responce->rows= $data;
		   $responce->total =$count;
		   return json_encode($responce);
		}else{ 
		   $responce = new stdClass();
		   $responce->rows = 0;
		   $responce->total = 0;
		   return json_encode($responce);
		} 
	}
	//end Json Grid
	
	//Generate Form Via Field Table
	function generateform($table){
		$ci =& get_instance();
		$ci->load->database();
		
		$field = $ci->db->list_fields($table);
		$arrayform = array();
		$i = 0;
		foreach($field as $k => $v){							
			if($v == 'create_date' || $v == 'create_by'){
				continue;
			}
			
			$label = str_replace('_', ' ', $v);
			$label = strtoupper($label);
			
			if($v == 'id'){
				$arrayform[$k]['tipe'] = "hidden";
			}else{	
				if(strpos($v, 'cl_') !== false){
					$label = str_replace("CL ", "", $label);
					$label = str_replace(" ID", "", $label);
					
					$arrayform[$k]['tipe'] = "combo";
					$arrayform[$k]['ukuran_class'] = "span4";
					$arrayform[$k]['isi_combo'] =  $ci->lib->fillcombo($v, 'return', ($sts_crud == 'edit' ? $data[$y] : "") );
				}elseif(strpos($v, 'tipe_') !== false){
					$arrayform[$k]['tipe'] = "combo";
					$arrayform[$k]['ukuran_class'] = "span4";
					$arrayform[$k]['isi_combo'] =  $ci->lib->fillcombo($v, 'return', ($sts_crud == 'edit' ? $data[$y] : "") );
				}elseif(strpos($v, 'tgl_') !== false){
					$label = str_replace("TGL", "TANGGAL", $label);
					
					$arrayform[$k]['tipe'] = "text";
					$arrayform[$k]['ukuran_class'] = "span2";
				}elseif(strpos($v, 'isi_') !== false){
					$arrayform[$k]['tipe'] = "textarea";
					$arrayform[$k]['ukuran_class'] = "span8";
				}elseif(strpos($v, 'gambar_') !== false){
					$arrayform[$k]['tipe'] = "file";
					$arrayform[$k]['ukuran_class'] = "span8";	
				}else{
					$arrayform[$k]['tipe'] = "text";
					$arrayform[$k]['ukuran_class'] = "span8";
				}
			}
										
			$arrayform[$k]['name'] = $v;
			$arrayform[$k]['label'] = $label;
			$i++;
		}
		
		return $arrayform;
	}
	function jingga_curl($url,$data,$method,$balikan){
		$username = 'jingga_api';
		$password = 'Plokiju_123';
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		if($method=='post'){
			//curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
			curl_setopt($curl_handle, CURLOPT_POST, 1);
			//curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, urldecode(http_build_query($data)));
			
		}
		if($method=='put'){
			curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS,http_build_query($data));
		}
		if($method=='delete'){
			curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "delete");
			
		}
		curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
		 
		$kirim = curl_exec($curl_handle);
		curl_close($curl_handle);
		if($balikan=='json'){
			$result = json_decode($kirim, true);
		}
		else if($balikan=='xml'){
			$result = json_decode($kirim, true);
		}else{
			$result=$kirim;
		}
		return $result;
		
	}
	
	function searchForId($id, $array) {
	   foreach ($array as $key => $val) {
		   if ($val['id'] === $id) {
			   return $key;
		   }
	   }
	   return null;
	}
	
	//End Generate Form Via Field Table
	/*
	//Function Encoding Decoding
	function base62encode($data) {
		$outstring = '';
		$l = strlen($data);
		for ($i = 0; $i < $l; $i += 8) {
			$chunk = substr($data, $i, 8);
			$outlen = ceil((strlen($chunk) * 8)/6); //8bit/char in, 6bits/char out, round up
			$x = bin2hex($chunk);  //gmp won't convert from binary, so go via hex
			$w = gmp_strval(gmp_init(ltrim($x, '0'), 16), 62); //gmp doesn't like leading 0s
			$pad = str_pad($w, $outlen, '0', STR_PAD_LEFT);
			$outstring .= $pad;
		}
		return $outstring;
	}

	function base62decode($data) {
		$outstring = '';
		$l = strlen($data);
		for ($i = 0; $i < $l; $i += 11) {
			$chunk = substr($data, $i, 11);
			$outlen = floor((strlen($chunk) * 6)/8); //6bit/char in, 8bits/char out, round down
			$y = gmp_strval(gmp_init(ltrim($chunk, '0'), 62), 16); //gmp doesn't like leading 0s
			$pad = str_pad($y, $outlen * 2, '0', STR_PAD_LEFT); //double output length as as we're going via hex (4bits/char)
			$outstring .= pack('H*', $pad); //same as hex2bin
		}
		return $outstring;
	}
	*/
	
	function base64url_encode($data) { 
	  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
	} 

	function base64url_decode($data) { 
	  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
	} 	
	//End Function Encoding Decoding
}