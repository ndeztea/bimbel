<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// load Model
		$this->load->model('users');
		$this->load->model('login');

		//set error delimiter untuk form validation
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');
	}

	function index()
	{

		if($this->session->userdata('nisn')!= NULL OR $this->session->userdata('nisn') != ""):
			redirect(base_url().'home','refresh');
		else:
			$this->load->view('login');
		endif;
	}

	function daftar(){
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|xss_clean');
		$this->form_validation->set_rules('NISN', 'NISN', 'required|xss_clean|callback_cek_nisn');
		$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|xss_clean|matches[password]');
		$this->form_validation->set_rules('pendidikan', 'Tingkatan Sekolah', 'required|xss_clean');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|xss_clean');
		$this->form_validation->set_rules('email', 'E-Mail', 'required|xss_clean|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'xss_clean|numeric');


		if ($this->form_validation->run() == FALSE):
 			$this->load->view('login');
		else:
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
			$this->session->set_flashdata('msg', 'Kamu berhasil mendaftar, Silakan login untuk mengakses menu selanjutnya ');
			redirect(base_url(),'refresh');
		endif;
	}


	function authentication(){

		$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
 			$this->load->view('login');
		} 
		else {

			$login = $this->login->login();

			if($login):
				$data = $login->row_array();

				$this->session->set_userdata('id', 			$data['id']);
				$this->session->set_userdata('nisn', 		$data['nisn']);
				$this->session->set_userdata('nisn', 		$data['nisn']);
				$this->session->set_userdata('nama', 		$data['nama']);
				$this->session->set_userdata('avatar', 		$data['avatar']);
				$this->session->set_userdata('pendidikan', 	$data['tingkat_sekolah']);
				$this->session->set_userdata('kelas',		$data['kelas']);
				$this->session->set_userdata('wids', 		$data['wids']);
				$this->session->set_userdata('level', 		$data['level']);

				redirect(base_url().'home','refresh');

			else:
				$this->session->set_flashdata('msg_error', 'Maaf NISN atau Password yang kamu masukan salah, silakan cek kembali');
				redirect(base_url(),'refresh');

			endif;
		}
		
	}


	function cek_nisn(){
		$nisn = $this->input->post('NISN');

		$cek_nisn = $this->login->cek_nisn($nisn);

		if($cek_nisn):
			$this->form_validation->set_message('cek_nisn', 'NISN yang kamu masukkan sudah terdaftar, silakan cek kembali NISN kamu.');
			return FALSE;
		else:
			return TRUE;
		endif;

	}



	function logout(){
	    $this->session->sess_destroy();
	    $data = array('nisn',
	    			  'nama',
				      'avatar',
				      'pendidikan',
				      'kelas',
				   	  'wids');
	    $this->session->unset_userdata($data);
	    redirect(base_url());
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */