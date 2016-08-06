<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

	function login(){
		$username = $this->input->post('username');
		$password = sha1(md5(strrev($this->input->post('password'))));



		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('nisn', $username);
		$this->db->or_where('email', $username);
		$this->db->where('password', $password);

		$return = $this->db->get();

		if($return->num_rows() > 0 AND $return->num_rows() == 1){
			return $return;
		}
		else{
			return FALSE;
		}
	}	


	function cek_nisn($nisn){
		$this->db->select('nisn');
		$this->db->from('users');
		$this->db->where('nisn', $nisn);
		$return = $this->db->get();

		if($return->num_rows() > 0 AND $return->num_rows() == 1){
			return $return;
		}
		else{
			return FALSE;
		}
	}

	function cek_email($email){
		$this->db->select('email, nisn, nama');
		$this->db->from('users');
		$this->db->where('email', $email);
		$return = $this->db->get();

		if($return->num_rows() > 0){
			return $return;
		}
		else {
			return false;
		}
	}
}

/* End of file login.php */
/* Location: ./application/models/login.php */