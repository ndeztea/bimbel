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
		$this->load->model('Mpelajaran');
		$this->load->helper('bimbel_helper');
		$this->load->model('Users');
		$this->load->model('Muser_wids');
	}


	function data_pertanyaan(){
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == "" OR $this->session->userdata('level') != "1"){
			redirect(base_url(),'refresh');
		}
		$data['pelajaran'] = $this->Mpelajaran->getdata();
		$this->load->view('pertanyaan/data_pertanyaan', $data);
	}

	function pertanyaan_list() {
   
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = $this->input->post('keyword');
		$mapel = $this->input->post('mapel');

		$total=$this->db->count_all_results("pelajaran_pertanyaan");

		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal']=$output['recordsFiltered']=$total;
		$output['data']=array();

		
		$query=$this->Mpertanyaan->get_pertanyaan($length, $start, $search, $mapel);


		if($search != ""){
			$jum = $this->Mpertanyaan->get_pertanyaan(NULL, NULL, $search);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}
		if($mapel != ""){
			$jum = $this->Mpertanyaan->get_pertanyaan(NULL, NULL, NULL, $mapel);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}
		if($mapel != "" AND $search != NULL){
			$jum = $this->Mpertanyaan->get_pertanyaan(NULL, NULL, $search, $mapel);
			$output['recordsTotal'] = $output['recordsFiltered']=$jum->num_rows();
		}


		$nomor_urut=$start+1;

		foreach ($query->result_array() as $r){
			$output['data'][]=array($nomor_urut,
									$r['nama_penanya'],
									$r['nama_pelajaran'],
									$r['wids_pertanyaan'],
									substr($r['pertanyaan'], 0, 100),
									$r['tingkat'],
									"<button class='btn btn-danger' onclick=confirmDelete(".$r['id_pertanyaan'].")><i class='fa fa-trash'></i></button>".
									"<button class='btn btn-info' onclick=location.href='".base_url()."detail_pertanyaan/".$r['id_pertanyaan']."'><i class='fa fa-eye'></i></button>"
									);
			$nomor_urut++;
		}

		echo json_encode($output);


	}

	function pertanyaan_saya(){
		$data['pertanyaan'] = $this->Mpertanyaan->get_pertanyaan_by_nisn($this->session->userdata('nisn'), 10, 0);
		$data['no'] = 1;
		$this->load->view('pertanyaan/data_pertanyaan_saya', $data);
	}



	

    function detail_pertanyaan(){
    	$pertanyaan = $this->Mpertanyaan->get_detail_pertanyaan($this->uri->rsegment(3));

	    	if($pertanyaan){
				$data['jumlah_pertanyaan']	= $this->Mpertanyaan->get_count_pertanyaan($this->session->userdata('id'))->row_array()['jumlah'];
				$data['jumlah_jawaban']	= $this->Mjawaban->get_count_jawaban($this->session->userdata('id'))->row_array()['jumlah'];
				$data['pertanyaan'] = $pertanyaan->row_array();
				$data['pelajaran'] 	  = $this->Mpelajaran->getdata()->result();
				$data['wids'] 		  = count_wids($this->session->userdata('wids'));
				$data['jawaban_pertanyaan'] = $this->Mjawaban->get_jawaban_pertanyaan($this->uri->rsegment(3),0);
				$data['jawaban_pertanyaan_correct'] = $this->Mjawaban->get_jawaban_pertanyaan($this->uri->rsegment(3),1);
				$data['wids_penanya'] = count_wids($data['pertanyaan']['wids_penanya']);
				$this->session->set_userdata('url_pertanyaan', base_url().'detail_pertanyaan/'.$this->uri->rsegment(3));
				$this->load->view('pertanyaan/detail_pertanyaan', $data);
			}else{
				$this->load->view('404');
			}
    }


    function pertanyaan_by_mapel(){
    	$data['pelajaran']		= $this->Mpelajaran->get_first_12();
		$data['pelajaran_more']	= $this->Mpelajaran->get_more();
		$data['pelajaran_detail'] = $this->Mpelajaran->get_by_id($this->uri->rsegment(3))->row_array();
		$data['pertanyaan']   	= $this->Mpertanyaan->get_pertanyaan_by_mapel($this->uri->rsegment(3) ,5, 0);
		$this->load->view('pertanyaan/mapel', $data);
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
			$config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
			$config['max_size']  = '1028';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);


			$wids = $this->Users->get_user_by_id($this->session->userdata('nisn'))->row_array();
			$wids_total = $wids['wids'] - 2;

			if($wids['wids'] >= 2){

				if($_FILES['gambar']['size'] == NULL){
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


				}
				else{
						if ( !$this->upload->do_upload('gambar')){
							$error = array('error' => $this->upload->display_errors());
							$this->session->set_flashdata('msg_error', $error['error']);
							redirect(base_url().'home','refresh');
						}
						else{
								$data = array('id_pelajaran' => $this->input->post('mata_pelajaran'),
											  'tingkat'  	 => $this->input->post('tingkat'),
											  'pertanyaan' 	 => $this->input->post('pertanyaan'),
											  'id_user' 	 => $this->session->userdata('id'),
											  'tgl_update'   => date("Y-m-d H:i:s"),
											  'photo'		 =>	$this->upload->data()['file_name']);

								$user = array('wids' => $wids_total);

								$user_wids = array('id_user' => $wids['id'],
												   'wids' => $wids_total,
												   'tgl_update' => date("Y-m-d H:i:s"),
												   'action' => 'kurang');

						}
				}
				

					$this->Mpertanyaan->add_pertanyaan($data);
					$this->Users->update($user, $this->session->userdata('nisn'));
					$this->Muser_wids->transaksi($user_wids);

					$this->session->set_userdata('wids', $wids_total);

					$this->session->set_flashdata('msg_success', 'Pertanyaan berhasil ditambahkan');
					redirect(base_url().'home','refresh');

			}
			else {
						$this->session->set_flashdata('msg_error', 'Maaf Wids kamu tidak cukup untuk melakukan pertanyaan, minimal harus nya 2 wids.');
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
    	
    	if($get){
    		if($get->row_array()['gambar'] != NULL)
    		{
				unlink(FCPATH."assets/images/question/".$get->row_array()['gambar']);
			}
			$id = $this->uri->rsegment(3);
	        $this->Mpertanyaan->delete_pertanyaan($id);
			$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
	        redirect($this->session->userdata('url_delete'),'refresh');
	    }else{
	    	redirect(base_url().'not_found','refresh');
	    }
    }


    function edit_pertanyaan_saya(){	
		$get = $this->Mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3));
		$this->session->set_userdata('url_edit_pertanyaan', base_url()."edit_pertanyaan_saya/".$this->uri->rsegment(3));

			if ($get){

	    		$this->form_validation->set_rules('pertanyaan', "Pertanyaan", "required|xss_clean");
				$this->form_validation->set_rules('tingkat', "tingkat", 'required|xss_clean');
				$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|xss_clean');

			
				if($this->form_validation->run() == FALSE){
					$data['pertanyaan_saya'] = $get->row_array();
					$data['pelajaran'] = $this->Mpelajaran->getdata();
					$this->load->view('pertanyaan/edit_pertanyaan_saya', $data);
				}
				else{
					if($_FILES['gambar']['size'] != NULL){
						$config['upload_path'] = 'assets/images/question';
						$config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
						$config['max_size']  = '5000';
						// $config['max_width']  = '1024';
						// $config['max_height']  = '768';
						
						$this->load->library('upload', $config);
						
							if ( !$this->upload->do_upload('gambar')){
								$error = array('error' => $this->upload->display_errors());
								$this->session->set_flashdata('msg_error', $error['error']);
								redirect($this->session->userdata('url_edit_pertanyaan'),'refresh');
							}
							else{
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
							}
					}
					else{
							$data = array('pertanyaan'		  => $this->input->post('pertanyaan'),
									  	  'tingkat'		  	  => $this->input->post('tingkat'),
									  	  'id_pelajaran'      => $this->input->post('mata_pelajaran'));
							$this->Mpertanyaan->edit_pertanyaan_saya($data, $get->row_array()['id_pertanyaan']);
							$this->session->set_flashdata('msg_success', 'Data berhasil di update');
							redirect($this->session->userdata('url_pertanyaan'),'refresh');
					}

				}
						
			}
			else{
        		redirect(base_url().'not_found','refresh');
			}
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

	function load_more(){
		$get = $this->Mpertanyaan->get_pertanyaan_by_mapel($this->input->post('id'), 5, $this->input->post('offset'));
		if($get->num_rows() >= 1){
			foreach ($get->result() as $r) {
				$terjawab = $r->terjawab==1?'<i class="fa fa-star list-answered"></i>':'';
				echo "<div class='box-comment'> 
		            			<img class='img-circle img-sm' src='".
		            			base_url('assets/images/avatar')."/".$r->avatar_penanya."'>
		            			<div class='comment-text'>
		            				<span class='username'>"
		            					.$r->nama_pelajaran."&middot;"
						         	 	.get_tingkat($r->tingkat)
						         	 	.$terjawab.
						         	 	'<span class="text-muted pull-right">'.lapse_time(strtotime($r->tgl_update)).'</span>'.
		            				"</span>
		            				<a href='".base_url()."detail_pertanyaan/".$r->id_pertanyaan."'>".$r->pertanyaan."</a>
	          						<button class='btn btn-success btn-xs pull-right' onclick=location.href='".base_url()."detail_pertanyaan/".$r->id_pertanyaan."'><i class='fa fa-share'></i> Jawab</button>
		            			</div>
						    </div>";
			}
		}
		else{
			echo "Tidak ada data lagi";
		}
	}

	public function answered($id){
		if($this->session->userdata('level')==1 || $this->session->userdata('level')==2){
			$this->Mpertanyaan->update_terjawab($id);

		}

		redirect(base_url().'detail_pertanyaan/'.$id,'refresh');
	}
}