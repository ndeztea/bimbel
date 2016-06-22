<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mpertanyaan');
		$this->load->model('Mjawaban');
		$this->load->model('mpelajaran');
		$this->load->helper('bimbel_helper');
	}


	function data_pertanyaan(){
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
								"<button class='btn btn-danger' onclick=location.href='".base_url()."delete_pertanyaan/".$r['id_pertanyaan']."'><i class='fa fa-trash'></i></button>".
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
				$data['jawaban_pertanyaan'] = $this->Mjawaban->get_jawaban_pertanyaan($this->uri->rsegment(3));
				$data['wids_penanya'] = count_wids($data['pertanyaan']['wids_penanya']);
				$this->session->set_userdata('url_pertanyaan', base_url().'detail_pertanyaan/'.$this->uri->rsegment(3));
				$this->load->view('Pertanyaan/detail_pertanyaan', $data);
			else:
				$this->load->view('404');
			endif;

    }


    function delete_pertanyaan_saya(){
		$id = $this->uri->rsegment(3);
        $this->Mpertanyaan->delete_pertanyaan($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'my_question','refresh');
    }

    function delete_pertanyaan(){
		$id = $this->uri->rsegment(3);
        $this->Mpertanyaan->delete_pertanyaan($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'data_pertanyaan','refresh');
    }


    function edit_pertanyaan_saya(){	
		$get = $this->Mpertanyaan->get_pertanyaan_by_id($this->uri->rsegment(3));

			if ($get):

	    		$this->form_validation->set_rules('pertanyaan', "Pertanyaan", "required|xss_clean");
				$this->form_validation->set_rules('tingkat', "tingkat", 'required|xss_clean');
				$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|xss_clean');
				$this->form_validation->set_rules('wids', 'Wids', 'required|xss_clean');

			
				if($this->form_validation->run() == FALSE){
					$data['pertanyaan_saya'] = $get->row_array();
					$data['pelajaran'] = $this->mpelajaran->getdata();
					$this->load->view('pertanyaan/edit_pertanyaan_saya', $data);
				}
				else{
					$data = array('pertanyaan'		  => $this->input->post('pertanyaan'),
						  		  'tingkat'		  	  => $this->input->post('tingkat'),
						  		  'id_pelajaran'    => $this->input->post('mata_pelajaran'),
						  		  'wids'   			  => $this->input->post('wids')
						  );
					$this->Mpertanyaan->edit_pertanyaan_saya($data, $get->row_array()['id_pertanyaan']);
					$this->session->set_flashdata('msg_success', 'Data berhasil di update');
					redirect(base_url().'my_question','refresh');
				}
			else:
        		redirect(base_url().'not_found','refresh');
			endif;
		}
}