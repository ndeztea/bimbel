<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function count_wids($wids){

		if($wids < 10){
			$result = "Pemula";
		}
		elseif($wids >= 10 AND $wids < 30){
			$result = "Ambis";
		}
		elseif ($wids >= 30 AND $wids < 50) {
			$result = "Prestisius";
		}
		elseif ($wids >= 50 AND $wids < 100) {
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
		$file_gender = $gender=='l'?'default-female.png':'default-male.png';
		return base_url('assets/images/avatar/'.$file_gender);
	}
}