<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {


	// List all your items
	function get_all_data()
	{

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
}

/* End of file users.php */
/* Location: ./application/models/users.php */
