<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {


	// List all your items
	function get_all_data()
	{

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

	}

	//Delete one item
	function delete($id)
	{

	}


	function upload_avatar($filename, $id_user){
		$users = array('avatar' => $filename);

		$this->db->where('nisn', $id_user);
		$this->db->update('users', $users);
	}
}

/* End of file users.php */
/* Location: ./application/models/users.php */
