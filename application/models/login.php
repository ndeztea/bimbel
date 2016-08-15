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

	function cek_kode_daftar($kode_daftar){
		$this->db->select('nisn');
		$this->db->from('users');
		$this->db->where('kode_daftar', $kode_daftar);
		$return = $this->db->get();

		if($return->num_rows() > 0 AND $return->num_rows() == 1){
			return true;
		}
		else{
			return false;
		}
	}

	function get_kode_daftar($kode_daftar){
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('kode_daftar', $kode_daftar);
		$return = $this->db->get()->row_array();

		return $return;
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

	function reset_password($nisn, $password){
		$new_password = array('password' => sha1(md5(strrev($password))));

		$this->db->where('nisn', $nisn);
		$this->db->update('users', $new_password);
	}
}

/* End of file login.php */
/* Location: ./application/models/login.php */