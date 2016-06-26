<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == ""){
			redirect(base_url(),'refresh');
		}
		$this->load->model('Mpertanyaan');
		$this->load->model('Mjawaban');
		$this->load->model('mpelajaran');
		$this->load->helper('bimbel_helper');
		$this->load->model('users');
		$this->load->model('Muser_wids');
	}


	function data_pertanyaan(){
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == "" OR $this->session->userdata('level') != "1"){
			redirect(base_url(),'refresh');
		}
		$this->load->view('Pertanyaan/data_pertanyaan', NULL);
	}

	function pertanyaan_list() {
        /*Menagkap semua data yang dikirimkan oleh client*/

		/*Sebagai token yang yang dikrimkan oleh client, dan nantinya akan
		server kirimkan balik. Gunanya untuk memastikan bahwa user mengklik paging
		sesuai dengan urutan yang sebenarnya */
		$draw = $_REQUEST['draw'];

		/*Jumlah baris yang akan ditampilkan pada setiap page*/
		$length = $_REQUEST['length'];

		/*Offset yang akan digunakan untuk memberitahu database
		dari baris mana data yang harus ditampilkan untuk masing masing page
		*/
		$start = $_REQUEST['start'];

		/*Keyword yang diketikan oleh user pada field pencarian*/
		$search = $_REQUEST['search']["value"];


		/*Menghitung total desa didalam database*/
		$total=$this->db->count_all_results("pelajaran_pertanyaan");

		/*Mempersiapkan array tempat kita akan menampung semua data
		yang nantinya akan server kirimkan ke client*/
		$output = array();

		/*Token yang dikrimkan client, akan dikirim balik ke client*/
		$output['draw'] = $draw;

		/*
		$output['recordsTotal'] adalah total data sebelum difilter
		$output['recordsFiltered'] adalah total data ketika difilter
		Biasanya kedua duanya bernilai sama, maka kita assignment 
		keduaduanya dengan nilai dari $total
		*/
		$output['recordsTotal']=$output['recordsFiltered']=$total;

		/*disini nantinya akan memuat data yang akan kita tampilkan 
		pada table client*/
		$output['data']=array();


		/*Jika $search mengandung nilai, berarti user sedang telah 
		memasukan keyword didalam filed pencarian*/
		if($search != ""){
			$this->db->like("pertanyaan", $search);
		}
		$this->db->select('penanya.nama AS nama_penanya,
						   penanya.wids AS wids_penanya,
						   penanya.avatar AS avatar_penanya,
					       pelajaran.pelajaran AS nama_pelajaran,
					       pelajaran_pertanyaan.id AS id_pertanyaan,
					       pelajaran_pertanyaan.pertanyaan AS pertanyaan,
					       pelajaran_pertanyaan.tingkat,
					       pelajaran_pertanyaan.wids as wids_pertanyaan'); 
		$this->db->from('users penanya');  
	    $this->db->join('pelajaran_pertanyaan', 'penanya.id = pelajaran_pertanyaan.id_user');
		$this->db->join('pelajaran', 'pelajaran_pertanyaan.id_pelajaran = pelajaran.id');

		$this->db->limit($length, $start);
		$this->db->order_by('pertanyaan','DESC');
		$query=$this->db->get();


		/*Ketika dalam mode pencarian, berarti kita harus mengatur kembali nilai 
		dari 'recordsTotal' dan 'recordsFiltered' sesuai dengan jumlah baris
		yang mengandung keyword tertentu
		*/
		if($search != ""){
			$this->db->from('users penanya');  
	    	$this->db->join('pelajaran_pertanyaan', 'penanya.id = pelajaran_pertanyaan.id_user');
			$this->db->join('pelajaran', 'pelajaran_pertanyaan.id_pelajaran = pelajaran.id');
			$this->db->like("pertanyaan", $search);
			$jum=$this->db->get();
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r):
		$output['data'][]=array($nomor_urut,
								$r['nama_penanya'],
								$r['nama_pelajaran'],
								$r['wids_pertanyaan'],
								substr($r['pertanyaan'], 0, 100),
								$r['tingkat'],
								"<button class='btn btn-danger' onclick=confirmDelete(".$r['id_pertanyaan'].")><i class='fa fa-trash'></i></button>".
								"  <button class='btn btn-info' onclick=location.href='".base_url()."detail_pertanyaan/".$r['id_pertanyaan']."'><i class='fa fa-eye'></i></button>"
								);
		$nomor_urut++;
		endforeach;

		echo json_encode($output);


	}

	function pertanyaan_saya(){
		$data['pertanyaan'] = $this->Mpertanyaan->get_pertanyaan_by_nisn($this->session->userdata('nisn'), 10, 0);
		$data['no'] = 1;
		$this->load->view('pertanyaan/data_pertanyaan_saya', $data);
	}



	

    function detail_pertanyaan(){
    	$pertanyaan = $this->Mpertanyaan->get_detail_pertanyaan($this->uri->rsegment(3));

	    	if($pertanyaan):

				$data['pertanyaan'] = $pertanyaan->row_array();
				$data['pelajaran'] 	  = $this->mpelajaran->getdata()->result();
				$data['wids'] 		  = count_wids($this->session->userdata('wids'));
				$data['jawaban_pertanyaan'] = $this->Mjawaban->get_jawaban_pertanyaan($this->uri->rsegment(3));
				$data['wids_penanya'] = count_wids($data['pertanyaan']['wids_penanya']);
				$this->session->set_userdata('url_pertanyaan', base_url().'detail_pertanyaan/'.$this->uri->rsegment(3));
				$this->load->view('Pertanyaan/detail_pertanyaan', $data);
			else:
				$this->load->view('404');
			endif;

    }

    function add_pertanyaan(){
		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|xss_clean');
		$this->form_validation->set_rules('tingkat', 'Tingkat', 'required|xss_clean');
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|xss_clean');



		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg_error', validation_errors());
			$this->load->view('home');
			
		} else {

			$config['upload_path'] = 'assets/images/question';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '1028';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);


			$wids = $this->users->get_user_by_id($this->session->userdata('nisn'))->row_array();
			$wids_total = $wids['wids'] - 2;

			if($wids['wids'] > 2){
				if($_FILES['gambar']['size'] == NULL):
					$data = array('id_pelajaran' => $this->input->post('mata_pelajaran'),
								  'tingkat'  	 => $this->input->post('tingkat'),
								  'pertanyaan' 	 => $this->input->post('pertanyaan'),
								  'id_user' 	 => $this->session->userdata('id'),
								  'tgl_update'   => date("Y-m-d H:i:s"));


					$user = array('wids' => $wids_total);

					$user_wids = array('id_user' => $wids['id'],
									   'wids' => $wids_total,
									   'tgl_update' => date("Y-m-d H:i:s"),
									   'action' => 'kurang',
									   'keterangan' => "Bertanya");


					$this->Mpertanyaan->add_pertanyaan($data);
					$this->users->update($user, $this->session->userdata('nisn'));
					$this->Muser_wids->transaksi($user_wids);

					$this->session->set_userdata('wids', $wids_total);

					$this->session->set_flashdata('msg_success', 'Pertanyaan berhasil ditambahkan');
					redirect(base_url().'home','refresh');


				else:
						if ( !$this->upload->do_upload('gambar')):
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('msg_error', $error['error']);
							redirect(base_url().'home','refresh');
						else:
							$data = array('id_pelajaran' => $this->input->post('mata_pelajaran'),
										  'tingkat'  	 => $this->input->post('tingkat'),
										  'pertanyaan' 	 => $this->input->post('pertanyaan'),
										  'id_user' 	 => $this->session->userdata('id'),
										  'tgl_update'   => date("Y-m-d H:i:s"),
										  'photo'		 =>	$this->upload->data()['file_name']);
						$this->Mpertanyaan->add_pertanyaan($data);

						$user = array('wids' => $wids_total);

						$user_wids = array('id_user' => $wids['id'],
										   'wids' => $wids_total,
										   'tgl_update' => date("Y-m-d H:i:s"),
										   'action' => 'kurang');


						$this->Mpertanyaan->add_pertanyaan($data);
						$this->users->update($user, $this->session->userdata('nisn'));
						$this->Muser_wids->transaksi($user_wids);


						$this->session->set_userdata('wids', $wids_total);
						$this->session->set_flashdata('msg_success', 'Pertanyaan berhasil ditambahkan');
						redirect(base_url().'home','refresh');
						endif;
				endif;
			}
			else {
						$this->session->set_flashdata('msg_error', 'Maaf Wids kamu tidak cukup untuk melakukan pertanyaan');
						redirect(base_url().'home','refresh');

			}
			
		}
	}


    function delete_pertanyaan_saya(){
		$id = $this->uri->rsegment(3);
        $this->Mpertanyaan->delete_pertanyaan($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'my_question','refresh');
    }

    function delete_pertanyaan(){
		$get = $this->Mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3));
    	
    	if($get):
    		if($get->row_array()['gambar'] != NULL)
    		{
				unlink(FCPATH."assets/images/question/".$get->row_array()['gambar']);
			}
			$id = $this->uri->rsegment(3);
	        $this->Mpertanyaan->delete_pertanyaan($id);
			$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
	        redirect(base_url().'home','refresh');
	    else:
	    	redirect(base_url().'not_found','refresh');
	   	endif;
    }


    function edit_pertanyaan_saya(){	
		$get = $this->Mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3));
		$this->session->set_userdata('url_edit_pertanyaan', base_url()."edit_pertanyaan_saya/".$this->uri->rsegment(3));

			if ($get):

	    		$this->form_validation->set_rules('pertanyaan', "Pertanyaan", "required|xss_clean");
				$this->form_validation->set_rules('tingkat', "tingkat", 'required|xss_clean');
				$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|xss_clean');

			
				if($this->form_validation->run() == FALSE){
					$data['pertanyaan_saya'] = $get->row_array();
					$data['pelajaran'] = $this->mpelajaran->getdata();
					$this->load->view('pertanyaan/edit_pertanyaan_saya', $data);
				}
				else{
					if($_FILES['gambar']['size'] != NULL):
						$config['upload_path'] = 'assets/images/question';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']  = '1024';
						// $config['max_width']  = '1024';
						// $config['max_height']  = '768';
						
						$this->load->library('upload', $config);
						
							if ( !$this->upload->do_upload('gambar')):
								$error = array('error' => $this->upload->display_errors());
								$this->session->set_flashdata('msg_error', $error['error']);
								redirect($this->session->userdata('url_edit_pertanyaan'),'refresh');
							else:
								if($get->row_array()['gambar'] != NULL){
									unlink(FCPATH."assets/images/question/".$get->row_array()['gambar']);
								}
								$data = array('pertanyaan'		  => $this->input->post('pertanyaan'),
									  		  'tingkat'		  	  => $this->input->post('tingkat'),
									  		  'id_pelajaran'      => $this->input->post('mata_pelajaran'),
									  		  'photo'			  => $this->upload->data()['file_name'],
								  );
								$this->Mpertanyaan->edit_pertanyaan_saya($data, $get->row_array()['id_pertanyaan']);
								$this->session->set_flashdata('msg_success', 'Data berhasil di update');
								redirect($this->session->userdata('url_pertanyaan'),'refresh');
							endif;
					else:
							$data = array('pertanyaan'		  => $this->input->post('pertanyaan'),
									  		  'tingkat'		  	  => $this->input->post('tingkat'),
									  		  'id_pelajaran'      => $this->input->post('mata_pelajaran')
								  );
								$this->Mpertanyaan->edit_pertanyaan_saya($data, $get->row_array()['id_pertanyaan']);
								$this->session->set_flashdata('msg_success', 'Data berhasil di update');
								redirect($this->session->userdata('url_pertanyaan'),'refresh');
					endif;

					}
						
			else:
        		redirect(base_url().'not_found','refresh');
			endif;
		}

	function cari_pertanyaan(){
		 $search = strip_tags(trim($this->input->get('q')));
	     $query = $this->Mpertanyaan->get_pertanyaan_id($search);

	      if($query->num_rows() > 0){
	        foreach ($query->result() as $r) {
	            $data[] = array('id' => $r->id,
	                          	'text' =>strip_tags($r->pertanyaan));   
	        }
	      }
	      else {
	        $data[] = array('id' => '0',
	                      	'text'=>'Pertanyaan Tidak Ditemukan');
	      }
	      echo json_encode($data);
	}
}