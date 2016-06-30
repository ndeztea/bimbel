<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpelajaran extends CI_Model {

	function get_by_id($id){
			$this->db->where('id', $id);
			$return = $this->db->get('pelajaran');

			if($return->num_rows() > 0){
				return $return;
			}
			else {
				return FALSE;
			}
		}


	function getdata(){
     return $this->db->get("pelajaran");
	}

	function get_first_12(){
     	return $this->db->get("pelajaran", 11, 0);
	}

	function get_more(){
		$limit = $this->getdata()->num_rows();
     	return $this->db->get("pelajaran", $limit, 11);
	}
	

	function add_pelajaran($data){	
        $this->db->insert('pelajaran',$data);
	}


	function delete_pelajaran($id){
		$this->db->where('id',$id);
		$this->db->delete('pelajaran');
	}

	function edit_pelajaran($data, $id){
		$this->db->where('id', $id);
		$this->db->update('pelajaran', $data);
	}
}

/* End of file Pelajaran.php */
/* Location: ./application/models/Pelajaran.php */