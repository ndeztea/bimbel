<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// load Model
		$this->load->model('users');

		//set error delimiter untuk form validation
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}

	function index()
	{
		$this->load->view('login');
	}

	function daftar(){
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|xss_clean');
		$this->form_validation->set_rules('NISN', 'NISN', 'required|xss_clean');
		$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|xss_clean|matches[password]');
		$this->form_validation->set_rules('pendidikan', 'Tingkatan Sekolah', 'required|xss_clean');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|xss_clean');
		$this->form_validation->set_rules('email', 'E-Mail', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'xss_clean|numeric');


		if ($this->form_validation->run() == FALSE){
 			$this->load->view('login');
 		}
		else{
			$users = array('nisn' 			=> $this->input->post('NISN'),
						   'nama' 			=> $this->input->post('nama_lengkap'),
						   'gender' 		=> $this->input->post('jkel'),
						   'password' 		=> sha1(md5(strrev($this->input->post('password')))),
						   'tingkat_sekolah'=> $this->input->post('pendidikan'),
						   'kelas' 			=> $this->input->post('kelas'),
						   'hp' 			=> $this->input->post('no_hp'),
						   'email' 			=> $this->input->post('email'),
						   'rekening_bank' 	=> $this->input->post('no_rek'),
						   'wids' 			=> '0',
						   'is_active' 		=> '1');


			$this->users->add($users);
			$this->session->set_flashdata('msg', 'Anda berhasil mendaftar, Silakan login untuk mengakses menu selanjutnya ');
			redirect(base_url(),'refresh');

		}

	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */