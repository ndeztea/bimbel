<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpertanyaan extends CI_Model {


	function ajukan_pertanyaan($data){	
        $this->db->insert('pelajaran_pertanyaan',$data);
	}
}