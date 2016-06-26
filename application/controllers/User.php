<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('nisn') == NULL OR $this->session->userdata('nisn') == "" AND $this->session->userdata('level') != "1"){
			redirect(base_url(),'refresh');
		}
		$this->load->model('users');
		
	}

	function data_user()
	{
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'users';
		$config['total_rows'] = $this->users->count_user()->row_array()['id'];

		$config['per_page'] = 10;
		$config['uri_segment'] = 2;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<div>';
		$config['next_tag_close'] = '</div>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<div>';
		$config['prev_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config);
		$page = ($this->uri->rsegment(3)) ? $this->uri->rsegment(3) : 0;


		$data['pagination'] = $this->pagination->create_links();
		$data['users'] = $this->users->get_all_users($config['per_page'], $page);
		$data['no'] = 1;

		$this->load->view('user/data_user', $data);
	}

	function delete_user(){
		$id = $this->uri->rsegment(3);
        $this->users->delete_user($id);
		$this->session->set_flashdata('msg_success', 'Data berhasil dihapus');
        redirect(base_url().'user/data_user','refresh');
    }



    function set_active(){
			$get = $this->users->get_user_by_id($this->uri->rsegment(3));

			if ($get):
				$status = $get->row_array()['is_active'];

				if ($status == 0) {
					$data = array('is_active' => 1);
					$this->session->set_flashdata('msg_success', 'User berhasil diaktifkan');
				}
				else{
					$data = array('is_active' => 0);
					$this->session->set_flashdata('msg_success', 'User berhasil dinon-aktifkan');
				}

				$this->users->update($data, $get->row_array()['nisn']);
				redirect(base_url().'user/data_user','refresh');

			else:
        		redirect(base_url().'not_found','refresh');
			endif;
	}


	function edit_user(){
		$users = $this->users->get_user_by_id($this->uri->rsegment(3));
		

		if($users):

			if($this->input->post('email') != $users->row_array()['email']) {
			   $is_unique =  '|is_unique[users.email]';
			} else {
			   $is_unique =  '';
			}

			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|xss_clean');
			$this->form_validation->set_rules('jkel', 'Jenis Kelamin', 'required|xss_clean');
			$this->form_validation->set_rules('pendidikan', 'Tingkatan Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('kelas', 'Kelas', 'required|xss_clean');
			$this->form_validation->set_rules('sekolah', 'Nama Sekolah', 'required|xss_clean');
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|xss_clean');
			$this->form_validation->set_rules('email', 'E-Mail', 'required|xss_clean|valid_email'.$is_unique);
			$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'xss_clean|numeric');

			if ($this->form_validation->run() == FALSE) {
				$data['users'] = $users->row_array();
				$this->load->view('user/edit_user', $data);
			} else {
				$users = array('nama' 			=> $this->input->post('nama'),
							   'gender' 		=> $this->input->post('jkel'),
							   'tingkat_sekolah'=> $this->input->post('pendidikan'),
							   'kelas' 			=> $this->input->post('kelas'),
							   'nama_sekolah' 	=> $this->input->post('sekolah'),
							   'hp' 			=> $this->input->post('no_hp'),
							   'email' 			=> $this->input->post('email'),
							   'rekening_bank' 	=> $this->input->post('no_rek'));

				$this->users->update($users, $this->session->userdata('nisn'));
				$this->session->set_flashdata('msg_success', 'Profil Berhasil Diubah');
				$this->session->set_userdata($this->input->post('nama'));
				redirect(base_url().'user/data_user','refresh');
			}
			
		else:
			redirect(base_url().'404_override','refresh');
		endif;
	}

	function upload_avatar(){
		$this->session->set_userdata('url_users', base_url()."edit_user/".$this->uri->rsegment(3));
		$users = $this->users->get_user_by_id($this->uri->rsegment(3))->row_array();

		if($users):

			$config['upload_path'] = 'assets/images/avatar';
	        $config['allowed_types'] = 'jpg|png';
	        $config['encrypt_name'] = TRUE;

	        $this->load->library('upload', $config);

	        if (!$this->upload->do_upload('avatar')):
	            $this->session->set_flashdata('msg_error', $this->upload->display_errors());
	            redirect(base_url().'profil', 'refresh');
	        else:
	            $this->session->set_userdata('error', "");
	            $this->session->set_flashdata('msg_success', 'Photo profil berhasil diubah');
		            if( $users['avatar'] != "default.jpg"){
		                unlink(FCPATH."assets/images/avatar/".$users['avatar']);
		            }
		        $data = array('avatar' => $this->upload->data()['file_name']);
	            $this->users->update($data, $users['nisn']);
	            redirect($this->session->userdata('url_users'), 'refresh');
	        endif;
	  	else:
	  		redirect(base_url()."not_found",'refresh');
	  	endif;
	}


}

/* End of file User.php */
/* Location: ./application/controllers/User.php */