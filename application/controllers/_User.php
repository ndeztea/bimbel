<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->helper('query_string_helper');

	}


	function data_user(){
		$data['no'] 				= 1;
		$data['title'] 				= "Data User";
		$data['page_name']          = 'Data User';
        $data['page_sub_name']      = '';

        $keyword = $this->input->get('q');
        

        $data['keyword'] = NULL;
        if ($keyword) {
            $data['keyword'] = $keyword;
        }

        ///// START Setting Filter /////
        // STEP. 1 : Array nama alias dan syntax db
        $keyword_by = array(
            array(
                'alias'=>'semua',
                'parameter'=> array
	                        (   
	                            'nisn'      => $keyword,
	                            'nama' 	  => $keyword,
	                            'nama_sekolah'   => $keyword,
	                            'email'   => $keyword,
	                        ),
                ),
            array(
                'alias'     =>'NISN',
                'parameter' =>'nisn',
                ),
            array(
                'alias'     =>'Nama',
                'parameter' =>'nama',
                ),
            array(
                'alias'     =>'Nama_Sekolah',
                'parameter' =>'nama_sekolah',
                ),
            array(
                'alias'     =>'Email',
                'parameter' =>'email',
                ),
        );


        $sort = array(
            array(
                'alias'     =>'NISN',
                'parameter' =>'nisn',
                ),
             array(
                'alias'     =>'Nama',
                'parameter' =>'nama',
                ),
             array(
                'alias'     =>'Sekolah',
                'parameter' =>'nama_sekolah',
                ),
             array(
                'alias'     =>'Email',
                'parameter' =>'email',
                ),
            );


        $sort_order = array(
            array(
                'alias'     =>'z-a',
                'parameter' =>'desc',
                ),
            array(
                'alias'     =>'a-z',
                'parameter' =>'asc',
                ),
        );

        // STEP. 2 : Masukan Array Filter ke Array Data

        $data['keyword_by'] = $keyword_by;
        $data['sort']       = $sort;
        $data['sort_order'] = $sort_order;

        
        // Filter


        // STEP. 3 : Proses Parsing array Alias dan parameter        

        $def_param_keyword_by = $keyword_by[0]['parameter'];
        $param_keyword_by   = strtolower($this->input->get('keyword_by'));
        $data['param_keyword_by'] = 'semua';
        if (isset($param_keyword_by)) {
            $data['param_keyword_by'] = $param_keyword_by;
            $key = array_search($param_keyword_by, array_column($keyword_by,'alias'));
            if ($key) {
                $param_keyword_by = $keyword_by[$key]['parameter'];
                $data['param_keyword_by'] = $keyword_by[$key]['alias'];
            } else{
                $param_keyword_by = $def_param_keyword_by;
            }
        }else{
            $param_keyword_by = $def_param_keyword_by;
        }
        

        $def_param_sort = 'nisn';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'NISN';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }


        $def_param_sort = 'nama';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'Nama';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }

        $def_param_sort = 'nama_sekolah';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'Sekolah';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }

        $def_param_sort = 'email';
        $param_sort         = strtolower($this->input->get('sort'));
        $data['param_sort'] = 'email';
        if (isset($param_sort)) {
            $data['param_sort'] = $param_sort;
            $key = array_search($param_sort, array_column($sort,'alias'));
            if ($key) {
                $param_sort = $sort[$key]['parameter'];
                $data['param_sort'] = $sort[$key]['alias'];
            } else{
                $param_sort = $def_param_sort;
            }
        }else{
            $param_sort = $def_param_sort;
        }

        $def_param_sort_order = 'desc';
        $param_sort_order   = strtolower($this->input->get('sort_order'));
        $data['param_sort_order'] = 'z-a';
        if (isset($param_sort_order)) {
            $data['param_sort_order'] = $param_sort_order;
            $key = array_search($param_sort_order,array_column($sort_order,'alias'));
            if ($key) {
                $param_sort_order = $sort_order[$key]['parameter'];
                $data['param_sort_order'] = $sort_order[$key]['alias'];
            } else{
                $param_sort_order = $def_param_sort_order;
            }
        }else{
            $param_sort_order = $def_param_sort_order;
        }

        // STEP. 4 : Simpan hasil sbg parameter utk query di database 

        $param_query['keyword_by'] = $param_keyword_by;
        $param_query['sort']       = $param_sort;
        $param_query['sort_order'] = $param_sort_order;
        
        ///// END Setting Filter /////


        //Setting Pagination
        $this->load->library('pagination');
        $config['base_url']             = base_url('users');
        $config['reuse_query_string']   = TRUE;
        $config['use_page_numbers']     = FALSE;
        
        $config['per_page']     = 25; 
        $config['num_links']    = 10;
        $config['uri_segment']  = 2;

        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";

        $limit = $config['per_page'];
        $offset = $this->uri->rsegment(3);

        //Load Data from Database
        $datadb = $this->users->get_all_users($keyword,$limit,$offset,$param_query);
        $data['datadb'] = NULL;
        if ($datadb['count']!=0) {
            $data['datadb'] = $datadb['data'];
        }

        
        $config['total_rows']   = $datadb['count_all'];
        $this->pagination->initialize($config); 
        $data['pagination'] = $this->pagination->create_links();

        $data['is_content_header']  = TRUE;
		$this->load->view('user/data_user', $data);
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */