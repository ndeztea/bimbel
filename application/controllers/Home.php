<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}

		$this->load->model('users');
	}

	function index()
	{
		$this->load->view('home');
	}


	function profil(){

		$users = $this->users->get_user_by_id($this->session->userdata('nisn'));

		if($users):
			$data['users'] = $users->row_array();
			$this->load->view('user/profil', $data);
		else:
			redirect(base_url().'404_override','refresh');
		endif; 

	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */