<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Not_found extends CI_Controller {

	function index()
	{
		$this->load->view('404');
	}

}

/* End of file not_found.php */
/* Location: ./application/controllers/not_found.php */