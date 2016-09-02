<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpertanyaan extends CI_Model {

	private $pertanyaan = 'pelajaran_pertanyaan';

	function getdata(){
     return $this->db->get("pelajaran_pertanyaan");
	}

	function get_pertanyaan($limit = NULL, $offset = NULL, $search = NULL, $mapel = NULL){
		$this->db->select('penanya.nama AS nama_penanya,
						   penanya.wids AS wids_penanya,
						   penanya.avatar AS avatar_penanya,
					       pelajaran.pelajaran AS nama_pelajaran,
					       pelajaran_pertanyaan.id AS id_pertanyaan,
					       pelajaran_pertanyaan.pertanyaan AS pertanyaan,
					       pelajaran_pertanyaan.tingkat,
					       pelajaran_pertanyaan.wids as wids_pertanyaan,
					       pelajaran_pertanyaan.tgl_update');

		$this->db->from('users penanya');  
	    $this->db->join('pelajaran_pertanyaan', 'penanya.id = pelajaran_pertanyaan.id_user');
		$this->db->join('pelajaran', 'pelajaran_pertanyaan.id_pelajaran = pelajaran.id');

		if($search != NULL){
			$this->db->like("pertanyaan", $search);
		}
		if($mapel != NULL){
			$this->db->where('pelajaran_pertanyaan.id_pelajaran', $mapel);
		}

		$this->db->limit($limit, $offset);
		$this->db->order_by('pelajaran_pertanyaan.id','DESC');
		return $this->db->get();
	}
 
	function get_pertanyaan_by_id($id){
		$query = $this->db->query("SELECT penanya.id as id_penanya,
										  penanya.nama AS nama_penanya,
										  penanya.wids AS wids_penanya,
										  penanya.avatar AS avatar_penanya,
									      pelajaran.pelajaran AS nama_pelajaran,
									      pelajaran.id AS id_pelajaran,
									      pelajaran_pertanyaan.id AS id_pertanyaan,
									      pelajaran_pertanyaan.pertanyaan AS pertanyaan,
									      pelajaran_pertanyaan.tingkat,
									      pelajaran_pertanyaan.wids as wids_pertanyaan,
									      pelajaran_pertanyaan.photo as gambar
									FROM  users penanya
									JOIN  pelajaran_pertanyaan ON penanya.id = pelajaran_pertanyaan.id_user
									JOIN  pelajaran ON pelajaran_pertanyaan.id_pelajaran = pelajaran.id
									WHERE pelajaran_pertanyaan.id = $id");
		return $query;
	}

	function get_pertanyaan_by_mapel($mapel ,$limit, $offset){
		$this->db->select('penanya.nama AS nama_penanya,
						   penanya.wids AS wids_penanya,
						   penanya.avatar AS avatar_penanya,
					       pelajaran.pelajaran AS nama_pelajaran,
					       pelajaran_pertanyaan.id AS id_pertanyaan,
					       pelajaran_pertanyaan.pertanyaan AS pertanyaan,
					       pelajaran_pertanyaan.tingkat,
					       pelajaran_pertanyaan.wids as wids_pertanyaan');

		$this->db->join('pelajaran_pertanyaan', 'penanya.id = pelajaran_pertanyaan.id_user');
		$this->db->join('pelajaran', 'pelajaran_pertanyaan.id_pelajaran = pelajaran.id');
		$this->db->where('pelajaran_pertanyaan.id_pelajaran', $mapel);
		$this->db->order_by('pelajaran_pertanyaan.tgl_update', 'desc');

		
		return $this->db->get('users penanya', $limit, $offset);
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
									WHERE penanya.nisn = '$nisn'
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
									      pelajaran_pertanyaan.wids as wids_pertanyaan,
									      pelajaran_pertanyaan.tgl_update as tgl_update,
									      pelajaran_pertanyaan.photo as gambar
									FROM  users penanya
									JOIN  pelajaran_pertanyaan ON penanya.id = pelajaran_pertanyaan.id_user
									JOIN  pelajaran ON pelajaran_pertanyaan.id_pelajaran = pelajaran.id
									WHERE pelajaran_pertanyaan.id = '$id'");


		if($query->num_rows() == 1){
			return $query;
		}
		else{
			return False;
		}
	}


	function get_pertanyaan_id($query){
		$this->db->select('id, pertanyaan');
		$this->db->like('pertanyaan', $query);
		$this->db->from('pelajaran_pertanyaan');

		return $this->db->get();
	}

	
	function get_count_pertanyaan($id){
		$this->db->select('COUNT(id) as jumlah');
		$this->db->from('pelajaran_pertanyaan');
		$this->db->where('id_user', $id);

		return $this->db->get();
	}

	function add_pertanyaan($data){	
        $this->db->insert('pelajaran_pertanyaan',$data);
	}


	function delete_pertanyaan($id){
		$this->db->where('id',$id);
		$this->db->delete('pelajaran_pertanyaan');

		$this->db->where('id_pertanyaan', $id);
		$this->db->delete('pelajaran_jawaban', $id);
	}

	function edit_pertanyaan_saya($data, $id){
		$this->db->where('id',$id);
		$this->db->update('pelajaran_pertanyaan', $data);
	}

}