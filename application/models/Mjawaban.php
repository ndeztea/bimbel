<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mjawaban extends CI_Model {

	function get_jawaban_by_nisn($nisn){
		$query = $this->db->query("SELECT penanya.nama AS nama_penanya,
										  penanya.wids AS wids_penanya,
										  penanya.avatar AS avatar_penanya,
									      pelajaran.pelajaran AS nama_pelajaran,
									      penjawab.nisn AS nisn_penjawab,
									      pelajaran_pertanyaan.id AS pertanyaan,
									      pelajaran_pertanyaan.tingkat,
									      pelajaran_pertanyaan.tgl_update AS tanggal_tanya,
									      pelajaran_jawaban.tgl_update AS tanggal_jawab
									FROM  users penanya
									JOIN  pelajaran_pertanyaan ON penanya.id = pelajaran_pertanyaan.id_user
									JOIN  pelajaran ON pelajaran_pertanyaan.id_pelajaran = pelajaran.id
									JOIN  pelajaran_jawaban ON pelajaran_jawaban.id_pertanyaan = pelajaran_pertanyaan.id
									JOIN  users penjawab ON pelajaran_jawaban.id_user = penjawab.id

									WHERE penjawab.nisn = '$nisn'");


		return $query;
	}


}

/* End of file Mjawaban.php */
/* Location: ./application/models/Mjawaban.php */