<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mwids extends CI_Model {

	
	function get_wids($id){
			$this->db->select('users_wids.* , users.id');
			$this->db->from('users_wids');
			$this->db->join('users', 'users_wids.id_user = users.id');
			$this->db->where('users.nisn', $id);
			return $this->db->get();
	}


	function get_jawaban_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('users_wids');

		if($query):
			return $query;
		else:
			return false;
		endif;
	}


}

/* End of file Mwids.php */
/* Location: ./application/models/Mwids.php */