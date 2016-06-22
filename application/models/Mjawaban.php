<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mjawaban extends CI_Model {

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

									WHERE penjawab.nisn = '$nisn'");


		return $query;
	}

	function get_jawaban_pertanyaan($id_pertanyaan){
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

		$this->db->from('pelajaran_pertanyaan');
		$this->db->join('pelajaran_jawaban', 'pelajaran_jawaban.id_pertanyaan = pelajaran_pertanyaan.id');
		$this->db->join('users penjawab', 'pelajaran_jawaban.id_user = penjawab.id');
		$this->db->where('pelajaran_pertanyaan.id', $id_pertanyaan);

		return $this->db->get();
	}

}

/* End of file Mjawaban.php */
/* Location: ./application/models/Mjawaban.php */