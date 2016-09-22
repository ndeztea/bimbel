<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jawaban extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}
		$this->load->model('Users');
		$this->load->model('Mpertanyaan');
		$this->load->model('Mpelajaran');
		$this->load->model('Mjawaban');
		$this->load->model('Mwids');
		$this->load->helper('bimbel_helper');
	}


	function delete_jawaban(){
		$jawaban = $this->Mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

		if($jawaban){
			if($jawaban->row_array()['photo'] != NULL)
			{
				unlink(FCPATH."assets/images/answer/".$jawaban->row_array()['photo']);
			}
			$this->Mjawaban->hapus_jawaban($this->uri->rsegment(3));
			$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
			redirect($this->session->userdata('url_pertanyaan'),'refresh');
		}
		else{
			redirect(base_url().'not_found','refresh');
		}
	}


	function insert_jawaban() {
		$pertanyaan = $this->Mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3));
		$betul = "0";
		if(($this->session->userdata('level') == "1" || $this->session->userdata('level') == "2") && $pertanyaan->row_array()['terjawab']!=1){
			$betul = "1";
		}

		if($pertanyaan){
			$this->form_validation->set_rules('jawaban', 'Jawaban', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg_error', 'Jawaban tidak boleh kosong, mohon di isi');
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
							'tgl_update'	=> date('Y-m-d H:i:s'),
							'photo' => $this->upload->data()['file_name'],
							'is_correct' => $betul);	
					}
				}else{
					$jawaban = array('jawaban' => $this->input->post('jawaban'),
						'id_pertanyaan' => $this->uri->rsegment(3),
						'tgl_update'	=>  date('Y-m-d H:i:s'),
						'id_user' => $this->session->userdata('id'),
						'is_correct' => $betul);	

				}
				$this->Mjawaban->insert_jawaban($jawaban);
				$this->session->set_flashdata('msg_succes', 'Jawaban berhasil ditambahkan');

				if($betul==1){
					$this->Mpertanyaan->update_terjawab($this->uri->rsegment(3));
				}

									// ------------- BEGIN EMAIL -------------
				$this->db->select('email, nama');
				$this->db->from('users');
				$this->db->where('users.id', $pertanyaan->row_array()['id_penanya']);
				$get_data =  $this->db->get();


				$email = $get_data->row_array()['email'];


				$data['nama'] = $get_data->row_array()['nama'];

				$data['link'] = base_url()."detail_pertanyaan/".$this->uri->rsegment(3);

				$data['email'] = $get_data->row_array()['email'];

				$message = $this->load->view('email/notifikasi_jawab_pertanyaan',$data,TRUE);


				$this->load->library('email');
				$config['mailtype'] = "html";

				$this->email->initialize($config);

							//masukkan email pengirim disini 
				$this->email->from(EMAIL_SENDER, 'BMBimbel Notification System');

				$this->email->to($email);
				$this->email->cc('');
				$this->email->bcc('');

				$this->email->subject('Seseorang menjawab pertanyaanmu !');
				$this->email->message($message);

				$this->email->send();

				if($this->session->userdata('level') == "2"){
								// send email ke super admin
					$detailWebAdmin = $this->Users->get_user_by_id2($this->session->userdata('id'))->row_array();


					$dataWebAdmin['nama'] = $detailWebAdmin['nama'];
					$dataWebAdmin['link'] = base_url()."detail_pertanyaan/".$this->session->userdata('id_pertanyaan');
					$message2 = $this->load->view('email/notifikasi_jawaban_betul_web_admin',$dataWebAdmin,TRUE);
					$this->email->from(EMAIL_SENDER, 'BMBimbel Notification System');

					$this->email->to($email);

					$this->email->subject('Web-Admin set betul pertanyaan !');
					$this->email->message($message2);

					$this->email->send();

					// tambah wids untuk web admin
					$checkWids = $this->Mwids->cek_wids_pertanyaan($this->session->userdata('id'),$this->uri->rsegment(3));
					if($checkWids==false){
						$wids = $detailWebAdmin['wids'] + 2;

						$data = array("wids" => 2,
							"id_user" =>$this->session->userdata('id'),
							"action" => "tambah",
							"keterangan" => "Menjawab Pertanyaan Langsung ID#".$this->uri->rsegment(3),
							"id_pertanyaan" => $this->uri->rsegment(3));

						$user = array("id"	=> $this->session->userdata('id'),
							"wids" => $wids);

						$this->Users->update($user, $this->input->post('id'));
						$this->Mwids->add_wids($data, $user);
					}
					
				}




			  // ------------- END EMAIL -------------

				redirect($this->session->userdata('url_pertanyaan'),'refresh');

			}
		}
		else{
			redirect(base_url().'not_found','refresh');
		}
	}


	function edit_jawaban(){
		$get = $this->Mjawaban->get_jawaban_by_id($this->uri->rsegment(3));

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
					$this->Mjawaban->edit_jawaban($data, $get->row_array()['id']);
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
						$this->Mjawaban->edit_jawaban($data, $get->row_array()['id']);
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

	function salah(){
		if($this->session->userdata('level') == "1" || $this->session->userdata('level') == "2"){
			// set salah
			$jawaban = array("wids" => 0,
				"is_correct" => "2",
				"user_set_correct" => $this->session->userdata('id'),
				"level_set_correct" => $this->session->userdata('level'));

			$this->Mjawaban->edit_jawaban($jawaban, $this->uri->rsegment(3));
			$this->session->set_flashdata('msg_success', 'Jawaban sudah di set salah');

			// ------------- BEGIN EMAIL -------------
			$detail_pertanyaan = $this->Mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3))->row_array();

			$this->db->select('email, nama');
			$this->db->from('users');
			$this->db->where('users.id', $detail_pertanyaan['id_penanya']);
			$get_data =  $this->db->get();


			$email = $get_data->row_array()['email'];


			$data['nama'] = $get_data->row_array()['nama'];

			$data['link'] = base_url()."detail_pertanyaan/".$this->session->userdata('id_pertanyaan');

			$data['email'] = $get_data->row_array()['email'];

			$message = $this->load->view('email/notifikasi_jawaban_salah',$data,TRUE);

			
			$this->load->library('email');
			$config['mailtype'] = "html";

			$this->email->initialize($config);

			//masukkan email pengirim disini 
			$this->email->from(EMAIL_SENDER, 'BMBimbel Notification System');

			$this->email->to($email);
			$this->email->cc('');
			$this->email->bcc('');

			$this->email->subject('Jawaban kamu salah !');
			$this->email->message($message);

			$this->email->send();


			  // ------------- END EMAIL -------------

			redirect($this->session->userdata('url_pertanyaan'),'refresh');

		}	
		else{
			redirect(base_url().'not_found','refresh');
		}
	}

	function betul(){

		if($this->session->userdata('level') == "1"){
			$this->form_validation->set_rules('wids', 'Wids', 'numeric|xss_clean|required');

			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('msg_error', validation_errors());
				redirect($this->session->userdata('url_pertanyaan'),'refresh');
			}
			else{
				$user_wids = $this->Users->get_user_by_id($this->input->post('id'));

				if($user_wids){
					$user_downliner = $user_wids->row_array();

					$user_upliner = $this->Users->get_user_by_id2($user_downliner['user_parent']);

					if($user_upliner){
						$wids_upliner = $user_upliner->row_array()['wids'];
						$persentase = ((int) $this->input->post('wids') / 100) * 10;
						$wids_for_upliner = round($persentase, 0, PHP_ROUND_HALF_UP);
						$bonus_upliner = (int) $wids_upliner + $wids_for_upliner;
						$user = array("wids" => $bonus_upliner);
						$this->Users->update($user, $user_upliner->row_array()['nisn']);
					}

					$wids = (int) $user_downliner['wids'] + (int) $this->input->post('wids');

					$data = array("wids" => $this->input->post('wids'),
						"id_user" =>$user_downliner['id'],
						"action" => "tambah",
						"keterangan" => "Menjawab Pertanyaan");

					$user = array("id"	=> $user_downliner['id'],
						"wids" => $wids);

					$jawaban = array("wids" => $this->input->post('wids'),
						"is_correct" => "1",
						"user_set_correct" => $this->session->userdata('id'),
						"level_set_correct" => $this->session->userdata('level'));

					$this->Mjawaban->edit_jawaban($jawaban, $this->uri->rsegment(3));
					$this->Users->update($user, $this->input->post('id'));
					$this->Mwids->add_wids($data, $user);

					// set sudah terjawab
					$detailJawaban = $this->Mjawaban->get_jawaban_by_id($this->uri->rsegment(3))->row_array();
					$this->Mpertanyaan->update_terjawab($detailJawaban['id_pertanyaan']);

					// ------------- BEGIN EMAIL -------------
					$this->db->select('email, nama');
					$this->db->from('users');
					$this->db->where('users.id', $user_downliner['id']);
					$get_data =  $this->db->get();


					$email = $get_data->row_array()['email'];


					$data['nama'] = $get_data->row_array()['nama'];

					$data['link'] = base_url()."detail_pertanyaan/".$this->session->userdata('id_pertanyaan');

					$data['email'] = $get_data->row_array()['email'];

					$message = $this->load->view('email/notifikasi_jawaban_betul',$data,TRUE);

					
					$this->load->library('email');
					$config['mailtype'] = "html";

					$this->email->initialize($config);

					//masukkan email pengirim disini 
					$this->email->from(EMAIL_SENDER, 'BMBimbel Notification System');

					$this->email->to($email);
					$this->email->cc('');
					$this->email->bcc('');

					$this->email->subject('Jawaban kamu benar !');
					$this->email->message($message);

					$this->email->send();



			  // ------------- END EMAIL -------------
					
					$this->session->set_flashdata('msg_success', 'Wids berhasil ditambahkan');
					redirect($this->session->userdata('url_pertanyaan'),'refresh');
				}
				else{
					redirect(base_url().'not_found','refresh');
				}
			}
		}
		elseif ($this->session->userdata('level') == 2 || $this->session->userdata('level') == 3){
			$jawaban = array("wids" => 0,
				"is_correct" => "1", 
				"user_set_correct" => $this->session->userdata('id'),
				"level_set_correct" => $this->session->userdata('level'));

			$this->Mjawaban->edit_jawaban($jawaban, $this->uri->rsegment(3));

			// set sudah terjawab
			$detailJawaban = $this->Mjawaban->get_jawaban_by_id($this->uri->rsegment(3))->row_array();
			$this->Mpertanyaan->update_terjawab($detailJawaban['id_pertanyaan']);

					// ------------- BEGIN EMAIL -------------
			$this->db->select('id_user');
			$this->db->from('pelajaran_jawaban');
			$this->db->where('id', $this->uri->rsegment(3));
			$id_user = $this->db->get();


			$this->db->select('email, nama');
			$this->db->from('users');
			$this->db->where('users.id', $id_user->row_array()['id_user']);
			$get_data =  $this->db->get();


			$email = $get_data->row_array()['email'];


			$data['nama'] = $get_data->row_array()['nama'];

			$data['link'] = base_url()."detail_pertanyaan/".$this->session->userdata('id_pertanyaan');

			$data['email'] = $get_data->row_array()['email'];

			$message = $this->load->view('email/notifikasi_jawaban_betul',$data,TRUE);


			$this->load->library('email');
			$config['mailtype'] = "html";

			$this->email->initialize($config);

					//masukkan email pengirim disini 
			$this->email->from(EMAIL_SENDER, 'BMBimbel Notification System');

			$adminList = $this->Users->get_admin_list();
			$emails = array();
			foreach ($adminList->result() as $row) {
				$emails[] = $row->email;
			}
			$emails = implode($emails, ',');
			$this->email->to($emails);

			$this->email->subject('Jawaban kamu benar !');
			$this->email->message($message);

			$this->email->send();

					// send email ke super admin
			$detailWebAdmin = $this->Users->get_user_by_id2($this->session->userdata('id'))->row_array();
			$dataWebAdmin['nama'] = $detailWebAdmin['nama'];
			$dataWebAdmin['link'] = base_url()."detail_pertanyaan/".$this->session->userdata('id_pertanyaan');
			$message2 = $this->load->view('email/notifikasi_jawaban_betul_web_admin',$dataWebAdmin,TRUE);
			$this->email->from(EMAIL_SENDER, 'BMBimbel Notification System');

			$this->email->to($email);

			$this->email->subject('Web-Admin set betul pertanyaan !');
			$this->email->message($message2);

			$this->email->send();

			$wids = (int) $detailWebAdmin['wids'] + 1;
			$data = array("wids" => 1,
				"id_user" =>$this->session->userdata('id'),
				"action" => "tambah",
				"keterangan" => "Set betul jawaban");

			$user = array("id"	=> $this->session->userdata('id'),
				"wids" => $wids);

			$this->Users->update($user, $this->input->post('id'));
			$this->Mwids->add_wids($data, $user);



			  // ------------- END EMAIL -------------

			$this->session->set_flashdata('msg_success', 'Jawaban berhasil di set betul');
			redirect($this->session->userdata('url_pertanyaan'),'refresh');
		}
		else{
			redirect(base_url().'not_found','refresh');
		}
	}




	function update_wids_betul(){
		if($this->session->userdata('level') == "1"){
			$this->form_validation->set_rules('wids', 'Wids', 'numeric|xss_clean|required');

			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('msg_error', validation_errors());
				redirect($this->session->userdata('url_pertanyaan'),'refresh');
			}
			else{


				$user_wids = $this->Users->get_user_by_id($this->input->post('id'));
				if($user_wids){
					$user_downliner = $user_wids->row_array();

					$user_upliner = $this->Users->get_user_by_id($user_downliner['user_parent']);

					$wids_jawaban = $this->Mjawaban->get_jawaban_by_id($this->uri->rsegment(3))->row_array()['wids'];

					$wids_update = $this->input->post('wids');

					$selisih_wids = abs($wids_jawaban - $wids_update);

					$wids_downliner = $user_downliner['wids'];

					if($user_upliner){
						$wids_upliner = $user_upliner->row_array()['wids'];
					}
					else {
						$wids_upliner = 0;
					}


					$wids_for_downliner = 0;
					if($wids_update > $wids_jawaban){
						$wids_baru = (int) $wids_jawaban + (int) $selisih_wids;
						$wids_for_downliner = (int) $wids_downliner + (int) $selisih_wids;
						$persentase = ($selisih_wids / 100) * 10;
						$wids_for_upliner = round($persentase, 0, PHP_ROUND_HALF_UP);
						$bonus_upliner = (int) $wids_upliner + $wids_for_upliner;
						$action = "tambah";
					}
					elseif($wids_update < $wids_jawaban){
						$wids_baru = (int) $wids_jawaban - (int) $selisih_wids;
						$wids_for_downliner = (int) $wids_downliner - (int) $selisih_wids;
						$persentase = ($selisih_wids / 100) * 10;
						$wids_for_upliner = round($persentase, 0, PHP_ROUND_HALF_UP);
						$bonus_upliner = (int) $wids_upliner - $wids_for_upliner;
						$action = "kurang";
					}
					else {
						$wids_baru = (int) $wids_jawaban;
						$wids_for_downliner = $wids_downliner;
						$bonus_upliner = $wids_upliner;
						$action = "";
					}


					$log_wids = array("wids" => $wids_baru,
						"id_user" =>$user_downliner['id'],
						"action" => $action,
						"keterangan" => "Update Wids Jawaban");

					if($wids_for_downliner!=0){
						$user_downliner = array("id"	=> $user_downliner['id'],
							"wids" => $wids_for_downliner);
					}
					

					$wids_jawab = array("wids" => $this->input->post('wids'));

					$this->Mjawaban->edit_jawaban($wids_jawab, $this->uri->rsegment(3));
					$this->Users->update($user_downliner, $this->input->post('id'));
					$this->Mwids->add_wids($log_wids, $user_downliner);


					if($user_upliner){
						$user = array("wids" => $bonus_upliner);
						$this->Users->update($user, $user_upliner->row_array()['nisn']);
					}


					// ------------- BEGIN EMAIL -------------
	    // 			$this->db->select('email, nama');
	    // 			$this->db->from('users');
	    // 			$this->db->where('users.id', $user_downliner['id']);
	    // 			$get_data =  $this->db->get();


	    // 			$email = $get_data->row_array()['email'];


					// $data['nama'] = $get_data->row_array()['nama'];

					// $data['link'] = base_url()."detail_pertanyaan/".$this->session->userdata('id_pertanyaan');

					// $data['email'] = $get_data->row_array()['email'];

					// $message = $this->load->view('email/notifikasi_jawaban_betul',$data,TRUE);

					
					// $this->load->library('email');
					// $config['mailtype'] = "html";

					// $this->email->initialize($config);


					// $this->email->from(EMAIL_SENDER, 'BMBimbel Notification System');

					// $this->email->to($email);
					// $this->email->cc('');
					// $this->email->bcc('');

					// $this->email->subject('Jawaban kamu benar !');
					// $this->email->message($message);

					// $this->email->send();


			  // ------------- END EMAIL -------------
					
					$this->session->set_flashdata('msg_success', 'Wids berhasil diupdate');
					redirect($this->session->userdata('url_pertanyaan'),'refresh');
				}
				else{
					redirect(base_url().'not_found','refresh');
				}
			}
		}
	}

	function jawaban_saya(){
		$data['jawaban'] = $this->Mjawaban->get_jawaban_by_nisn($this->session->userdata('nisn'));
		$this->load->view('jawaban/jawaban_saya', $data);
	}
}

/* End of file Jawaban.php */
/* Location: ./application/controllers/Jawaban.php */