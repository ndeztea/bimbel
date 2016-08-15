<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreseller extends CI_Model {


	function get_all()
	{
		return $this->db->get('reseller');
	}

	function get_by_id($id)
	{
		$this->db->where('id', $id);
		$return = $this->db->get('reseller');

		if($return->num_rows() == "1"){
			return $return;
		}
		else{
			return FALSE;
		}
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
