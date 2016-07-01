<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mwids extends CI_Model {

	
	function get_wids($id){
			$this->db->select('users_wids.* , users.id, users.nama');
			$this->db->from('users_wids');
			$this->db->join('users', 'users_wids.id_user = users.id');
			$this->db->where('users.nisn', $id);
			$this->db->order_by('tgl_update', 'desc');
			return $this->db->get();
	}


	function get_jawaban_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('users_wids');

		if($query){
			return $query;
		}
		else{
			return false;
		}
	}

	function add_wids($data, $user){
		$this->db->where('id', $user['id']);
		$this->db->update('users', $user);
		$this->db->insert('users_wids', $data);
	}
}

/* End of file Mwids.php */
/* Location: ./application/models/Mwids.php */