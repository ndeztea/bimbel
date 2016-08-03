<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreseller extends CI_Model {


	function get_all()
	{
		return $this->db->get('reseller');
	}	


	function add($data)
	{
		$this->db->insert('reseller', $data);
	}


	function update( $id, $data )
	{
		$this->db->where('id', $id);
		$this->db->update('reseller', $data);
	}


	function delete( $id )
	{
		$this->db->where('id', $id);
		$this->db->delete('reseller');
	}
}

/* End of file MReseller.php */
/* Location: ./application/models/MReseller.php */
