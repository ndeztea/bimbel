<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

	function get_all_users($limit = NULL, $offset = NULL){

		return $this->db->get('users', $limit, $offset);

	}

	function get_user_by_id($id){
		$this->db->where('nisn', $id);
		$return = $this->db->get('users');

		if($return->num_rows() > 0 and $return->num_rows() == 1):
			return $return;
		else:
			return FALSE;
		endif;

	}

	// Add a new item
	function add($data)
	{
		$this->db->insert('users', $data);
	}

	//Update one item
	function update($data, $id)
	{
		$this->db->where('nisn', $id_user);
		$this->db->update('users', $data);
	}

	//Delete one item
	function delete($id)
	{

	}

	function count_user(){
		$this->db->select('COUNT(id) as id');
		$this->db->from('users');

		return $this->db->get();
	}
}

/* End of file Users.php */
/* Location: ./application/models/Users.php */