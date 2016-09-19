<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Users');
		$this->load->model('Mpertanyaan');
		$this->load->model('Mpelajaran');
		$this->load->model('Mjawaban');
		$this->load->helper('bimbel_helper');
		

	}

	function panduan(){
		$this->load->view('panduan_member');
	}

	function tentang(){
		$this->load->view('tentang_bimbel');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */