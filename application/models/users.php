<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

	function get_all_users($limit = NULL, $offset = NULL){

		return $this->db->get('users', $limit, $offset);

	}

	function get_user_by_id($id){
		$this->db->where('nisn', $id);
		$return = $this->db->get('users');

		if($return->num_rows() > 0 and $return->num_rows() == 1){
			return $return;
		}
		else{
			return FALSE;
		}

	}

	// Add a new item
	function add($data)
	{
		$this->db->insert('users', $data);
	}

	//Update one item
	function update($data, $id)
	{
		$this->db->where('nisn', $id);
		$this->db->update('users', $data);
	}

	//Delete one item
	function delete_user($id)
	{
		$this->db->where('nisn',$id);
		$this->db->delete('users');
	}

	function count_user(){
		$this->db->select('COUNT(id) as id');
		$this->db->from('users');

		return $this->db->get();
	}

	function cek_password($nisn, $password){
		$this->db->select('nisn, password');
		$this->db->from('users');
		$this->db->where('nisn', $nisn);
		$this->db->where('password', $password);

		$return = $this->db->get();

		if($return->num_rows() > 0):
			return $return;
		else:
			return false;
		endif;
	}


}

/* End of file Users.php */
/* Location: ./application/models/Users.php */