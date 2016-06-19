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