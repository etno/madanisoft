<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{	
	public function __construct()
    {
        parent::__construct();
        $this->prefix = $this->config->item('company').'_'.$this->config->item('project').'_';
        $this->load->helper('common_helper');
        $this->load->library(array('login','pagination'));
        //$this->login->check_logged_in();
    }
    
	public function index()
	{
        $css_files = array('assets/lib/bootstrap/css/bootstrap.min.css',
                            'assets/lib/Font-Awesome/css/font-awesome.min.css',
                            'assets/css/main.css',
                            'assets/css/theme.css',
                            'assets/lib/fullcalendar-1.6.2/fullcalendar/fullcalendar.css');
        $data['css_files'] = $css_files;
        $data['page_title'] = "Dashboard";
		$data['content'] = "admin/dashboard";
		$this->load->view('admin/index',$data);
	}

	public function room_list($offset=0)
	{
		$limit = 20;
		$this->load->model('m_room');
		$this->load->library('pagination');
		$config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap" style="float: right;margin-top: -20px;"><ul id="pagerku" class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'first';
        $config['last_link'] = 'last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&larr;Previous';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['base_url'] = site_url('admin/home/room_list');
        $config['total_rows'] = $this->m_room->get_total_all();
        $config['per_page'] = $limit;
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

		$data['room_lists'] = $this->m_room->get_room(0,$limit,$offset);
		$data['content'] = "admin/room_list";
		$this->load->view('admin/page',$data);
	}

	public function set_color($color)
	{
		$this->load->model('m_setting');
		$this->m_setting->set_setting('theme',$color);
        notif("Color Themes has been change","success");
		redirect('admin/home');
	}

	
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
