<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('mjawaban');
	}


	function delete_jawaban(){
		$jawaban = $this->mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

		if($jawaban):
			$this->mjawaban->hapus_jawaban($this->uri->rsegment(3));
			$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
			redirect($this->session->userdata('url_pertanyaan'),'refresh');
		else:
			redirect(base_url().'not_found','refresh');
		endif;
	}


	function insert_jawaban() {
 
       	$jawaban = array('jawaban' => $this->input->post('jawaban'),
       					 'id_pertanyaan' => $this->input->post('id_pertanyaan'),
       					 'id_user' => $this->session->userdata('id'),
       					  );
 	
        $this->mjawaban->insert_jawaban($jawaban);

        $content = $this->mjawaban->get_last_jawaban($jawaban['id_pertanyaan']);
        echo json_encode($content->row_array());
    }

}

/* End of file Jawaban.php */
/* Location: ./application/controllers/Jawaban.php */