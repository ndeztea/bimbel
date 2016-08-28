<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mjawaban extends CI_Model {

	function get_jawaban_pertanyaan($id_pertanyaan,$correct=0){
		/*
		$this->db->select('	pelajaran_pertanyaan.id,
							penjawab.id AS id_penjawab,
							penjawab.nama AS nama_penjawab,
							penjawab.wids AS wids_penjawab,
							penjawab.nisn AS nisn_penjawab,
							penjawab.avatar AS avatar_penjawab,
							penjawab.level AS level_penjawab,
							pelajaran_jawaban.id,
							pelajaran_jawaban.photo as gambar_jawaban,
							pelajaran_jawaban.id_pertanyaan,
							pelajaran_jawaban.jawaban,
							pelajaran_jawaban.is_correct,
							pelajaran_jawaban.tgl_update,
							pelajaran_jawaban.jml_like,
							pelajaran_jawaban.jml_dislike,
							pelajaran_jawaban.tgl_update AS tanggal_jawab');

		$this->db->from('pelajaran_pertanyaan');
		$this->db->join('pelajaran_jawaban', 'pelajaran_jawaban.id_pertanyaan = pelajaran_pertanyaan.id');
		$this->db->join('users penjawab', 'pelajaran_jawaban.id_user = penjawab.id');
		$this->db->where('pelajaran_pertanyaan.id', $id_pertanyaan);
		$this->db->where('is_correct', "0");
	*/
		// muncul jawaban hanya untuk admin, yg buat pertanyaan dan yg menjawab
		$where = '';
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id');
		if($level==3 || $level==4){
			$where = "AND (`pelajaran_jawaban`.`id_user` = '$id_user' OR `pelajaran_pertanyaan`.`id_user` = '$id_user')";
			//$this->db->where('pelajaran_jawaban.id_user', $id_user);
			//$this->db->or_where('pelajaran_pertanyaan.id_user', $id_user);
		}
		$query = "SELECT `pelajaran_pertanyaan`.`id`, `penjawab`.`id` AS `id_penjawab`, `penjawab`.`nama` AS `nama_penjawab`, `penjawab`.`wids` AS `wids_penjawab`, `penjawab`.`nisn` AS `nisn_penjawab`, `penjawab`.`avatar` AS `avatar_penjawab`, `penjawab`.`level` AS `level_penjawab`, `pelajaran_jawaban`.`id`, `pelajaran_jawaban`.`photo` as `gambar_jawaban`, `pelajaran_jawaban`.`id_pertanyaan`, `pelajaran_jawaban`.`jawaban`, `pelajaran_jawaban`.`is_correct`, `pelajaran_jawaban`.`tgl_update`, `pelajaran_jawaban`.`jml_like`, `pelajaran_jawaban`.`jml_dislike`, `pelajaran_jawaban`.`tgl_update` AS `tanggal_jawab`,`penjawab`.`level` AS `level_penjawab`, `pelajaran_jawaban`.`wids` as `wids_jawaban`,`pelajaran_jawaban`.`user_set_correct`,`pelajaran_jawaban`.`level_set_correct` FROM `pelajaran_pertanyaan` JOIN `pelajaran_jawaban` ON `pelajaran_jawaban`.`id_pertanyaan` = `pelajaran_pertanyaan`.`id` JOIN `users` `penjawab` ON `pelajaran_jawaban`.`id_user` = `penjawab`.`id` WHERE `pelajaran_pertanyaan`.`id` = '$id_pertanyaan'  AND `is_correct` = '$correct' ".$where;
		$get = $this->db->query($query);

		return $get;
	}


	function get_correct_answer($id_pertanyaan){
		$this->db->select('	pelajaran_pertanyaan.id,
							penjawab.id AS id_penjawab,
							penjawab.nama AS nama_penjawab,
							penjawab.wids AS wids_penjawab,
							penjawab.nisn AS nisn_penjawab,
							penjawab.avatar AS avatar_penjawab,
							penjawab.level AS level_penjawab,
							pelajaran_jawaban.id,
							pelajaran_jawaban.wids as wids_jawaban,
							pelajaran_jawaban.user_set_correct,
							pelajaran_jawaban.level_set_correct,
							pelajaran_jawaban.photo as gambar_jawaban,
							pelajaran_jawaban.tgl_update,
							pelajaran_jawaban.id_pertanyaan,
							pelajaran_jawaban.jawaban,
							pelajaran_jawaban.is_correct,
							pelajaran_jawaban.jml_like,
							pelajaran_jawaban.jml_dislike,
							pelajaran_jawaban.tgl_update AS tanggal_jawab');

		$this->db->from('pelajaran_pertanyaan');
		$this->db->join('pelajaran_jawaban', 'pelajaran_jawaban.id_pertanyaan = pelajaran_pertanyaan.id');
		$this->db->join('users penjawab', 'pelajaran_jawaban.id_user = penjawab.id');
		$this->db->where('is_correct', "1");
		$this->db->where('pelajaran_pertanyaan.id', $id_pertanyaan);
		

		// muncul jawaban hanya untuk admin, yg buat pertanyaan dan yg menjawab
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id');
		if($level==3 || $level==4){
			$this->db->where('pelajaran_jawaban.id_user', $id_user);
			$this->db->or_where('pelajaran_pertanyaan.id_user', $id_user);
		}

		return $this->db->get();
	}

	function get_count_jawaban($id){
		$this->db->select('COUNT(id) as jumlah');
		$this->db->from('pelajaran_jawaban');
		$this->db->where('id_user', $id);

		return $this->db->get();
	}


    function insert_jawaban($data) {
        $this->db->insert('pelajaran_jawaban', $data);
    }


    function get_last_jawaban($id_pertanyaan) {
       $this->db->select('	pelajaran_pertanyaan.id,
							penjawab.id AS id_penjawab,
							penjawab.nama AS nama_penjawab,
							penjawab.wids AS wids_penjawab,
							penjawab.nisn AS nisn_penjawab,
							penjawab.avatar AS avatar_penjawab,
							pelajaran_jawaban.id,
							pelajaran_jawaban.id_pertanyaan,
							pelajaran_jawaban.jawaban,
							pelajaran_jawaban.jml_like,
							pelajaran_jawaban.jml_dislike,
							pelajaran_jawaban.tgl_update AS tanggal_jawab');

		$this->db->join('pelajaran_jawaban', 'pelajaran_jawaban.id_pertanyaan = pelajaran_pertanyaan.id');
		$this->db->join('users penjawab', 'pelajaran_jawaban.id_user = penjawab.id');
		$this->db->where('pelajaran_pertanyaan.id', $id_pertanyaan);
		$this->db->order_by('pelajaran_jawaban.tgl_update', 'desc');

		return $this->db->get('pelajaran_pertanyaan', 1, 0);
    }


	function get_jawaban_by_nisn($nisn){
		$query = $this->db->query("SELECT penanya.avatar AS avatar_penanya,
									      pelajaran.pelajaran AS nama_pelajaran,
									      penjawab.nisn AS nisn_penjawab,
									      pelajaran_pertanyaan.id AS id_pertanyaan,
									      pelajaran_pertanyaan.pertanyaan AS pertanyaan,
									      pelajaran_pertanyaan.tingkat,
									      pelajaran_pertanyaan.wids,
									      pelajaran_pertanyaan.tgl_update AS tanggal_tanya,
									      pelajaran_jawaban.tgl_update AS tanggal_jawab
									      
									FROM  users penanya
									JOIN  pelajaran_pertanyaan ON penanya.id = pelajaran_pertanyaan.id_user
									JOIN  pelajaran ON pelajaran_pertanyaan.id_pelajaran = pelajaran.id
									JOIN  pelajaran_jawaban ON pelajaran_jawaban.id_pertanyaan = pelajaran_pertanyaan.id
									JOIN  users penjawab ON pelajaran_jawaban.id_user = penjawab.id
									WHERE penjawab.nisn = '$nisn'
									GROUP BY id_pertanyaan");


		return $query;
	}

	function get_jawaban_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('pelajaran_jawaban');

		if($query){
			return $query;
		}
		else{
			return false;
		}
	}

	

	function hapus_jawaban($id){
		$this->db->where('id', $id);
		$this->db->delete('pelajaran_jawaban');
	}


	function edit_jawaban($data, $id){
		$this->db->where('id', $id);
		$this->db->update('pelajaran_jawaban', $data);
	}


    
 
}

/* End of file Mjawaban.php */
/* Location: ./application/models/Mjawaban.php */