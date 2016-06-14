<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}
	}

	function index()
	{
		$this->load->view('home');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */