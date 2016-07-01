<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}
		$this->load->model('users');
		$this->load->model('mpertanyaan');
		$this->load->model('mpelajaran');
		$this->load->model('mjawaban');
		$this->load->model('mwids');
		$this->load->helper('bimbel_helper');
	}


	function delete_jawaban(){
		$jawaban = $this->mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

		if($jawaban){
			if($jawaban->row_array()['photo'] != NULL)
    		{
				unlink(FCPATH."assets/images/answer/".$jawaban->row_array()['photo']);
			}
			$this->mjawaban->hapus_jawaban($this->uri->rsegment(3));
			$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
			redirect($this->session->userdata('url_pertanyaan'),'refresh');
		}
		else{
			redirect(base_url().'not_found','refresh');
		}
	}


	function insert_jawaban() {

		$pertanyaan = $this->mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3));
			if($pertanyaan){
				$this->form_validation->set_rules('jawaban', 'Jawaban', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('msg_error', validation_error());
					redirect($this->session->userdata('url_pertanyaan'),'refresh');
				} else {
					if($_FILES['gambar_jawaban']['size'] != NULL){
						$config['upload_path'] = 'assets/images/answer';
						$config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
						$config['max_size']  = '5000';
						$config['encrypt_name'] = true;


						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('gambar_jawaban')){
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('msg_error', $error['error']);
							redirect($this->session->userdata('url_pertanyaan'),'refresh');
						}
						else{
							$jawaban = array('jawaban' => $this->input->post('jawaban'),
											 'id_pertanyaan' => $this->uri->rsegment(3),
											 'id_user' => $this->session->userdata('id'),
											 'photo' => $this->upload->data()['file_name']);	
			    			$this->mjawaban->insert_jawaban($jawaban);
			    			$this->session->set_flashdata('msg_succes', 'Jawaban berhasil ditambahkan');
			    			redirect($this->session->userdata('url_pertanyaan'),'refresh');
						}
					}else{
						$jawaban = array('jawaban' => $this->input->post('jawaban'),
										 'id_pertanyaan' => $this->uri->rsegment(3),
										 'id_user' => $this->session->userdata('id'));	
			    			$this->mjawaban->insert_jawaban($jawaban);
			    			$this->session->set_flashdata('msg_succes', 'Jawaban berhasil ditambahkan');
			    			redirect($this->session->userdata('url_pertanyaan'),'refresh');
					}
				}
			}
			else{
				redirect(base_url().'not_found','refresh');
			}
    }


    function edit_jawaban(){
    	$get = $this->mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

			if ($get){
	    		$this->form_validation->set_rules('jawaban', "Jawaban", "required|xss_clean");
				if($this->form_validation->run() == FALSE){
					$data['edit_jawaban'] = $get->row_array();
					$this->load->view('jawaban/edit_jawaban', $data);
				}
				else{
					if($_FILES['gambar']['size'] == NULL){
						$data = array('jawaban' => $this->input->post('jawaban')
							  );
						$this->mjawaban->edit_jawaban($data, $get->row_array()['id']);
						$this->session->set_flashdata('msg_success', 'Data berhasil di update');
						redirect($this->session->userdata('url_pertanyaan'),'refresh');
					}else{
						$config['upload_path'] = 'assets/images/answer';
						$config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
						$config['max_size']  = '5000';
						$config['encrypt_name'] = true;
						
						$this->load->library('upload', $config);
						
						if ( !$this->upload->do_upload('gambar')){
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('msg_error', $error);
							redirect(base_url().'edit_jawaban/'.$this->uri->rsegment(3),'refresh');
						}
						else{
							if($get->row_array()['photo'] != NULL){
								unlink(FCPATH.'assets/images/answer/'.$get->row_array()['photo']);
							}
							$data = array('jawaban' => $this->input->post('jawaban'),
										  'photo' =>$this->upload->data()['file_name']
							  );
							$this->mjawaban->edit_jawaban($data, $get->row_array()['id']);
							$this->session->set_flashdata('msg_success', 'Data berhasil di update');
							redirect($this->session->userdata('url_pertanyaan'),'refresh');
							}
					}
				}
			}
			else{
        		redirect(base_url().'not_found','refresh');
			}
		}


	function betul(){
		$this->form_validation->set_rules('wids', 'Wids', 'numeric|xss_clean|required');

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('msg_error', validation_error());
			redirect($this->session->userdata('url_pertanyaan'),'refresh');
		}
		else{
			$user_wids = $this->users->get_user_by_id($this->input->post('id'));
			if($user_wids){
				$wids = $user_wids->row_array()['wids'] + $this->input->post('wids');

				$data = array("wids" => $wids,
							  "id_user" =>$user_wids->row_array()['id'],
							  "action" => "tambah",
							  "keterangan" => "Menjawab Pertanyaan");

				$user = array("id" => $user_wids->row_array()['id'],
							  "wids" => $wids);

				$jawaban = array("is_correct" => "1");

				$this->mjawaban->edit_jawaban($jawaban, $this->uri->rsegment(3));
				$this->users->update($user, $this->input->post('id'));
				$this->mwids->add_wids($data, $user);


				
				$this->session->set_flashdata('msg_success', 'Wids berhasil ditambahkan');
				redirect($this->session->userdata('url_pertanyaan'),'refresh');
			}
			else{
				redirect(base_url().'not_found','refresh');
			}
		}
	}

	function jawaban_saya(){
	    	$data['jawaban'] = $this->mjawaban->get_jawaban_by_nisn($this->session->userdata('nisn'));
	    	$this->load->view('jawaban/jawaban_saya', $data);
	}
}

/* End of file Jawaban.php */
/* Location: ./application/controllers/Jawaban.php */