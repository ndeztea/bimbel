<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wids extends CI_Controller {


	function __construct()
	{
		
		parent::__construct();
		$this->load->model('Mwids');
	}


	function data_wids()	{
		$data['wids'] = $this->Mwids->get_wids($this->uri->rsegment(3));
		$this->load->view('wids/data_wids', $data);	
	}



}

/* End of file Wids.php */
/* Location: ./application/controllers/Wids.php */
