<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser_wids extends CI_Model {

	
	function transaksi($data){
		$this->db->insert('users_wids', $data);
	}	

}

/* End of file Muser_wids.php */
/* Location: ./application/models/Muser_wids.php */