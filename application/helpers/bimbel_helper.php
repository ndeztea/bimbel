<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function count_wids($wids){

		if($wids < 20){
			$result = "Pemula";
		}
		elseif($wids >= 20 AND $wids < 40){
			$result = "Pertama";
		}
		elseif ($wids >= 40 AND $wids < 60) {
			$result = "Ambis";
		}
		elseif ($wids >= 60 AND $wids < 100) {
			$result = "Prestisius";
		}
		elseif ($wids >= 100 AND $wids < 200) {
			$result = "Ahli";
		}
		elseif ($wids >= 200 AND $wids < 500) {
			$result = "Sangat Ahli";
		}
		elseif ($wids >= 500 AND $wids < 1000) {
			$result = "Jenius";
		}
		elseif ($wids >= 1000) {
			$result = "Super Jenius";
		}

		return $result;
	}


function get_tingkat($id){
	$tingkat = $id;


	switch ($tingkat) {
		case 'SMK':
				$sekolah = "Sekolah Menengah Kejuruan";
			break;
		case 'SMA':
				$sekolah = "Sekolah Menengah Atas";
			break;
		case 'SMP':
				$sekolah = "Sekolah Menengah Pertama";
			break;
		case 'SD':
				$sekolah = "Sekolah Dasar";
			break;
		
		default:
				$sekolah = "Sekolah Dasar";
			break;
	}

	return $sekolah;
}

function thumb_avatar($file,$gender){
	$file_avatar = 'assets/images/avatar/'.$file;

	if(is_file($file_avatar)){
		return base_url($file_avatar);
	}else{
		$file_gender = $gender=='l'?'default-male.png':'default-female.png';
		return base_url('assets/images/avatar/'.$file_gender);
	}
}

function update_session($data_session){
	$CI = & get_instance(); 
	foreach ($data_session as $key => $value) {
		$CI->session->set_userdata($key, $value);
	}
}

function level($level){
	switch ($level) {
		case 1:
			$nama_level = "SuperAdmin";
			break;
		case 2:
			$nama_level = "Administrator";
			break;
		case 3:
			$nama_level = "Reseller";
			break;
		default:
			$nama_level = "";
			break;

	}
	return $nama_level;
}
