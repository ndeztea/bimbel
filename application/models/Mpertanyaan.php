<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpertanyaan extends CI_Model {

	function get_pertanyaan(){
		$query = $this->db->query("SELECT penanya.nama AS nama_penanya,
										  penanya.wids AS wids_penanya,
										  penanya.avatar AS avatar_penanya,
									      pelajaran.pelajaran AS nama_pelajaran,
									      pelajaran_pertanyaan.id AS id_pertanyaan,
									      pelajaran_pertanyaan.pertanyaan AS pertanyaan,
									      pelajaran_pertanyaan.tingkat,
									      pelajaran_pertanyaan.wids as wids_pertanyaan
									FROM  users penanya
									JOIN  pelajaran_pertanyaan ON penanya.id = pelajaran_pertanyaan.id_user
									JOIN  pelajaran ON pelajaran_pertanyaan.id_pelajaran = pelajaran.id");
		return $query;
	}

	function get_pertanyaan_by_nisn($nisn, $limit, $offset){
		$query = $this->db->query("SELECT penanya.nama AS nama_penanya,
										  penanya.nisn AS nisn_penanya,
										  penanya.avatar AS avatar_penanya,
									      pelajaran.pelajaran AS nama_pelajaran,
									      pelajaran_pertanyaan.id AS id_pertanyaan,
									      pelajaran_pertanyaan.pertanyaan AS pertanyaan,
									      pelajaran_pertanyaan.tingkat,
									      pelajaran_pertanyaan.wids as wids_pertanyaan
									FROM  users penanya
									JOIN  pelajaran_pertanyaan ON penanya.id = pelajaran_pertanyaan.id_user
									JOIN  pelajaran ON pelajaran_pertanyaan.id_pelajaran = pelajaran.id
									WHERE penanya.nisn = $nisn
									LIMIT $limit OFFSET $offset");
		return $query;
	}


	function get_detail_pertanyaan($id){
		$query = $this->db->query("SELECT penanya.id AS id_penanya,
										  penanya.nama AS nama_penanya,
										  penanya.wids AS wids_penanya,
										  penanya.avatar AS avatar_penanya,
									      pelajaran.pelajaran AS nama_pelajaran,
									      pelajaran_pertanyaan.id AS id_pertanyaan,
									      pelajaran_pertanyaan.pertanyaan AS pertanyaan,
									      pelajaran_pertanyaan.tingkat,
									      pelajaran_pertanyaan.wids as wids_pertanyaan
									FROM  users penanya
									JOIN  pelajaran_pertanyaan ON penanya.id = pelajaran_pertanyaan.id_user
									JOIN  pelajaran ON pelajaran_pertanyaan.id_pelajaran = pelajaran.id
									WHERE pelajaran_pertanyaan.id = $id");


		if($query->num_rows() == 1):
			return $query;
		else:
			return False;
		endif;
	}

	function add_pertanyaan($data){	
        $this->db->insert('pelajaran_pertanyaan',$data);
	}


	function getdata(){
     return $this->db->get("pelajaran_pertanyaan");
	}


	function delete_pertanyaan($id){
		$this->db->where('id',$id);
		$this->db->delete('pelajaran_pertanyaan');
	}

	function edit_pertanyaan_saya($data, $id){
		$this->db->where('id',$id);
		$this->db->update('pelajaran_pertanyaan', $data);
	}

}