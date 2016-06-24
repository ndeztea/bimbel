<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_user extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function login(){
		$this->load->view('admin_login');
	}

}

/* End of file Master_user.php */
/* Location: ./application/controllers/Master_user.php */