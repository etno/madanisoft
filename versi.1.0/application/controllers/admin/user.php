<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{	
	public function __construct()
    {
        parent::__construct();
        $this->prefix = $this->config->item('company').'_'.$this->config->item('project').'_';
        $this->load->helper('common_helper');
        $this->load->library(array('login','pagination'));
        $this->login->check_logged_in();
    }
    
	public function index()
	{
		redirect("admin/user/user_list");
	}

	public function job_level($action="view",$level_id=0)
	{
		$this->load->model('m_user');
		if($action=="delete"){
			$filter['level_id'] = $level_id;
			$total_rows = $this->m_user->get_total_job_level($filter);
			if($total_rows>0){
				$this->m_user->delete_job_level($level_id);	
				set_noty('success',"User job level has been deleted");
			}else{
				set_noty('warning',"Invalid job level to be delete");
			}
			redirect("admin/user/job_level");
		}elseif($action=="add"){
			$error = "";
			$job_level['level'] = $this->input->post('level');
			if(empty($job_level['level'])) $error.="Level is empty<br>";
			$job_level['initial'] = $this->input->post('initial');
			if(empty($job_level['initial'])) $error.="Initial is empty<br>";
			
			if(empty($error)){
				$job_level['level_status'] = "active";
				$this->m_user->add_job_level($job_level);	
				set_noty('success',"User job level has been added");
			}else{
				set_noty('error',$error);
			}
        	redirect("admin/user/job_level");
		}elseif($action=="update"){
			$filter['level_id'] = $level_id;
			$total_rows = $this->m_user->get_total_job_level($filter);
			if($total_rows>0){
				$error = "";
				$job_level['level'] = $this->input->post('level');
				if(empty($job_level['level'])) $error.="level is empty<br>";
				$job_level['level_status'] = $this->input->post('status');
				if(empty($job_level['level_status'])) $error.="Status is not selected<br>";
				$job_level['initial'] = $this->input->post('initial');
				if(empty($job_level['initial'])) $error.="initial is empty<br>";
				
				if(empty($error)){
					$this->m_user->update_job_level($level_id,$job_level);	
					set_noty('success',"User job level has been updated");
				}else{
					set_noty('error',$error);
				}	
			}else{
				set_noty('warning',"Invalid job level to be update");
			}
        	redirect("admin/user/job_level");
		}elseif ($action=="edit") {
			$data['room_capacities'] = $this->m_user->get_job_level($level_id);
			echo(json_encode($data));
		}else{
			$filter = $this->session->userdata("job_level_filter");

			if($_POST){
				$filter['level_status'] = $this->input->post('level');
				$filter['status'] = $this->input->post('status');
				$filter['initial'] = $this->input->post('initial');
				$this->session->set_userdata("job_level_filter",$filter);
			}

			$page = $this->input->get("page");

			if(empty($page)) $page=1;

			
			$limit = 15;
			$data['total_rows'] = $this->m_user->get_total_job_level($filter);
			$offset = ($page-1)*$limit;
			$data['job_levels'] = $this->m_user->get_job_level('0',$limit,$offset,$filter);
			$data['limit'] = $limit;
			$data['offset'] = $offset;
			$data['content'] = "admin/user_job_level";
			$data['page_title'] = "Job Level";

		    $css_files = array('assets/lib/bootstrap/css/bootstrap.min.css',
		                            'assets/lib/Font-Awesome/css/font-awesome.min.css',
		                            'assets/css/main.css',
		                            'assets/css/theme.css',
		                            'assets/lib/datatables/css/demo_page.css',
		                            'assets/lib/datatables/css/DT_bootstrap.css',
		                            'assets/lib/validationengine/css/validationEngine.jquery.css',
		                            'assets/lib/uniform/themes/default/css/uniform.default.css');


	        $data['css_files'] = $css_files;
			$this->load->view('admin/index',$data);
		}
	}

	public function group_list($action="view",$gid=0)
	{
		$this->load->model('m_user');
		if($action=="delete"){
			$filter['gid'] = $gid;
			$total_rows = $this->m_user->get_total_group_list($filter);
			if($total_rows>0){
				$this->m_user->delete_group_list($gid);	
				set_noty('success',"User group has been deleted");
			}else{
				set_noty('warning',"Invalid user group to be delete");
			}
			redirect("admin/user/group_list");
		}elseif($action=="add"){
			$error = "";
			$group_list['group_name'] = $this->input->post('group_name');
			if(empty($group_list['group_name'])) $error.="Level is empty<br>";
			
			if(empty($error)){
				$group_list['group_status'] = "active";
				$this->m_user->add_group_list($group_list);	
				set_noty('success',"User group has been added");
			}else{
				set_noty('error',$error);
			}
        	redirect("admin/user/group_list");
		}elseif($action=="update"){
			$filter['gid'] = $gid;
			$total_rows = $this->m_user->get_total_group_list($filter);
			if($total_rows>0){
				$error = "";
				$group_list['group_name'] = $this->input->post('group_name');
				if(empty($group_list['group_name'])) $error.="group_name is empty<br>";
				$group_list['group_status'] = $this->input->post('status');
				if(empty($group_list['group_status'])) $error.="Status is not selected<br>";
				
				if(empty($error)){
					$this->m_user->update_group_list($gid,$group_list);	
					set_noty('success',"User group has been updated");
				}else{
					set_noty('error',$error);
				}	
			}else{
				set_noty('warning',"Invalid user group to be update");
			}
        	redirect("admin/user/group_list");
		}elseif ($action=="edit") {
			$data['group_lists'] = $this->m_user->get_group_list($gid);
			echo(json_encode($data));
		}else{
			$filter = $this->session->userdata("group_list_filter");

			if($_POST){
				$filter['group_name'] = $this->input->post('group_name');
				$filter['group_status'] = $this->input->post('status');
				$this->session->set_userdata("group_list_filter",$filter);
			}

			$page = $this->input->get("page");

			if(empty($page)) $page=1;

			
			$limit = 15;
			$data['total_rows'] = $this->m_user->get_total_group_list($filter);
			$offset = ($page-1)*$limit;
			$data['group_lists'] = $this->m_user->get_group_list('0',$limit,$offset,$filter);
			$data['limit'] = $limit;
			$data['offset'] = $offset;
			$data['content'] = "admin/user_group_list";
			$data['page_title'] = "Group List";

		    $css_files = array('assets/lib/bootstrap/css/bootstrap.min.css',
		                            'assets/lib/Font-Awesome/css/font-awesome.min.css',
		                            'assets/css/main.css',
		                            'assets/css/theme.css',
		                            'assets/lib/datatables/css/demo_page.css',
		                            'assets/lib/datatables/css/DT_bootstrap.css',
		                            'assets/lib/validationengine/css/validationEngine.jquery.css',
		                            'assets/lib/uniform/themes/default/css/uniform.default.css');
	        $data['css_files'] = $css_files;
			$this->load->view('admin/index',$data);
		}
	}

	public function user_list($action="view",$uid=0)
	{
		$this->load->model('m_user');
		if($action=="delete"){
			$filter['uid'] = $uid;
			$total_rows = $this->m_user->get_total_user_list($filter);
			if($total_rows>0){
				$this->m_user->delete_user_list($uid);	
				set_noty('success',"User group has been deleted");
			}else{
				set_noty('warning',"Invalid user group to be delete");
			}
			redirect("admin/user/user_list");
		}elseif($action=="add"){
			$error = "";
			$user_list['group_name'] = $this->input->post('group_name');
			if(empty($user_list['group_name'])) $error.="Level is empty<br>";
			
			if(empty($error)){
				$user_list['status'] = "active";
				$this->m_user->add_user_list($user_list);	
				set_noty('success',"User group has been added");
			}else{
				set_noty('error',$error);
			}
        	redirect("admin/user/user_list");
		}elseif($action=="update"){
			$filter['uid'] = $uid;
			$total_rows = $this->m_user->get_total_user_list($filter);
			if($total_rows>0){
				$error = "";
				$user_list['group_name'] = $this->input->post('group_name');
				if(empty($user_list['group_name'])) $error.="group_name is empty<br>";
				$user_list['status'] = $this->input->post('status');
				if(empty($user_list['status'])) $error.="Status is not selected<br>";
				
				if(empty($error)){
					$this->m_user->update_user_list($uid,$user_list);	
					set_noty('success',"User group has been updated");
				}else{
					set_noty('error',$error);
				}	
			}else{
				set_noty('warning',"Invalid user group to be update");
			}
        	redirect("admin/user/user_list");
		}elseif ($action=="edit") {
			$data['user_lists'] = $this->m_user->get_user_list($uid);
			echo(json_encode($data));
		}else{
			$filter = $this->session->userdata("user_list_filter");

			if($_POST){
				$filter['group_name'] = $this->input->post('group_name');
				$filter['status'] = $this->input->post('status');
				$this->session->set_userdata("user_list_filter",$filter);
			}

			$page = $this->input->get("page");
			if(empty($page)) $page=1;

			$limit = 15;
			$data['total_rows'] = $this->m_user->get_total_user_list($filter);
			$offset = ($page-1)*$limit;
			$data['user_lists'] = $this->m_user->get_user_list('0',$limit,$offset,$filter);
			$data['limit'] = $limit;
			$data['offset'] = $offset;
			$data['content'] = "admin/user_list";
			$data['page_title'] = "User List";

		    $css_files = array('assets/lib/bootstrap/css/bootstrap.min.css',
		                            'assets/lib/Font-Awesome/css/font-awesome.min.css',
		                            'assets/css/main.css',
		                            'assets/css/theme.css',
		                            'assets/lib/datatables/css/demo_page.css',
		                            'assets/lib/datatables/css/DT_bootstrap.css',
		                            'assets/lib/validationengine/css/validationEngine.jquery.css',
		                            'assets/lib/uniform/themes/default/css/uniform.default.css',
		                            "assets/lib/inputlimiter/jquery.inputlimiter.1.0.css",
		                            "assets/lib/chosen/chosen.min.css",
		                            "assets/lib/colorpicker/css/colorpicker.css",
		                            "assets/lib/tagsinput/jquery.tagsinput.css",
		                            "assets/lib/daterangepicker/daterangepicker-bs3.css",
		                            "assets/lib/datepicker/css/datepicker.css",
		                            "assets/lib/timepicker/css/bootstrap-timepicker.min.css",
		                            "assets/lib/switch/static/stylesheets/bootstrap-switch.css",
		                            "assets/lib/jasny/css/jasny-bootstrap.min.css");
	        $data['css_files'] = $css_files;
			$this->load->view('admin/index',$data);
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
