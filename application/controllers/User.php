<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
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
					$this->session->set_flashdata('msg_success', 'Pelajaran berhasil diaktifkan');
				}
				else{
					$data = array('is_active' => 0);
					$this->session->set_flashdata('msg_success', 'Pelajaran berhasil dinon-aktifkan');
				}

				$this->users->update($data, $get->row_array()['nisn']);
				redirect(base_url().'user/data_user','refresh');

			else:
        		redirect(base_url().'not_found','refresh');
			endif;
	}


}

/* End of file User.php */
/* Location: ./application/controllers/User.php */