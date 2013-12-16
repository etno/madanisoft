<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller 
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
		redirect("admin/room/room_list");
	}

	public function room_list($action="view",$room_id=0,$offset=0)
	{
		$this->load->model('m_room');
		if($action=="delete"){
			$filter['room_id'] = $room_id;
			$total_rows = $this->m_room->get_total_all($filter);
			if($total_rows>0){
				$this->m_room->delete_room($room_id);	
				set_noty('success',"Room has been deleted");
			}else{
				set_noty('warning',"Invalid room to be delete");
			}
			redirect("admin/room/room_list");
		}elseif($action=="add"){
			$error = "";
			$room['room_number'] = $this->input->post('room_number');
			if(empty($room['room_number'])) $error.="Room number is empty<br>";
			$room['room_type_id'] = $this->input->post('room_type');
			if(empty($room['room_type_id'])) $error.="Room type is not selected<br>";
			$room['room_capacity_id'] = $this->input->post('room_capacity');
			if(empty($room['room_capacity_id'])) $error.="Room capacity is not selected<br>";
			$room['room_floor'] = $this->input->post('room_floor');
			if(empty($room['room_floor'])) $error.="Room floor is not selected<br>";

			if(empty($error)){
				$room['status'] = "avalaible";
				$this->m_room->add_room($room);	
				set_noty('success',"Room has been added");
			}else{
				set_noty('error',$error);
			}
        	redirect("admin/room/room_list");
		}elseif($action=="update"){
			$filter['room_id'] = $room_id;
			$total_rows = $this->m_room->get_total_all($filter);
			if($total_rows>0){
				$error = "";
				$room['room_number'] = $this->input->post('room_number');
				if(empty($room['room_number'])) $error.="Room number is empty<br>";
				$room['room_type_id'] = $this->input->post('room_type');
				if(empty($room['room_type_id'])) $error.="Room type is not selected<br>";
				$room['room_capacity_id'] = $this->input->post('room_capacity');
				if(empty($room['room_capacity_id'])) $error.="Room capacity is not selected<br>";
				$room['room_floor'] = $this->input->post('room_floor');
				if(empty($room['room_floor'])) $error.="Room floor is not selected<br>";
				$room['status'] = $this->input->post('status');
				if(empty($room['status'])) $error.="Room status is not selected<br>";

				if(empty($error)){
					$this->m_room->update_room($room_id,$room);	
					set_noty('success',"Room has been updated");
				}else{
					set_noty('error',$error);
				}
			}else{
				set_noty('warning',"Invalid room to be update");
			}
			redirect("admin/room/room_list");
		}elseif ($action=="edit") {
			$data['room_lists'] = $this->m_room->get_room($room_id);
			echo(json_encode($data));
		}else{
			$filter = $this->session->userdata("room_filter");

			if($_POST){
				$filter['room_number'] = $this->input->post('room_number');
				$filter['room_type_id'] = $this->input->post('room_type');
				$filter['room_capacity_id'] = $this->input->post('room_capacity');
				$filter['status'] = $this->input->post('status');
				$filter['room_floor'] = $this->input->post('room_floor');
				$this->session->set_userdata("room_filter",$filter);
			}

			$page = $this->input->get("page");

			if(empty($page)) $page=1;
			$limit = 15;
			$data['total_rows'] = $this->m_room->get_total_all($filter);
			$offset = ($page-1)*$limit;
			$data['room_lists'] = $this->m_room->get_room('0',$limit,$offset,$filter);

			$data['limit'] = $limit;


			$data['offset'] = $offset;


			$data['content'] = "admin/room_lists";
			$data['page_title'] = "Room Lists";

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

	
	public function room_type($action="view",$type_id=0)
	{
		$this->load->model('m_room');
		if($action=="delete"){
			$filter['type_id'] = $type_id;
			$total_rows = $this->m_room->get_total_type($filter);
			if($total_rows>0){
				$this->m_room->delete_type($type_id);	
				set_noty('success',"Room type has been deleted");
			}else{
				set_noty('warning',"Invalid type to be delete");
			}
			redirect("admin/room/room_type");
		}elseif($action=="add"){
			$error = "";
			$type['type_name'] = $this->input->post('type_name');
			if(empty($type['type_name'])) $error.="Room type name is empty<br>";
			
			if(empty($error)){
				$type['status'] = "active";
				$this->m_room->add_type($type);	
				set_noty('success',"Room type has been added");
			}else{
				set_noty('error',$error);
			}
        	redirect("admin/room/room_type");
		}elseif($action=="update"){
			$filter['type_id'] = $type_id;
			$total_rows = $this->m_room->get_total_type($filter);
			if($total_rows>0){
				$error = "";
				$type['type_name'] = $this->input->post('type_name');
				if(empty($type['type_name'])) $error.="Room type name is empty<br>";
				$type['status'] = $this->input->post('status');
				if(empty($type['status'])) $error.="Status is not selected<br>";
				
				if(empty($error)){
					$this->m_room->update_type($type_id,$type);	
					set_noty('success',"Room type has been updated");
				}else{
					set_noty('error',$error);
				}	
			}else{
				set_noty('warning',"Invalid type to be update");
			}
        	redirect("admin/room/room_type");
		}elseif ($action=="edit") {
			$data['room_types'] = $this->m_room->get_type($type_id);
			echo(json_encode($data));
		}else{
			$filter = $this->session->userdata("type_filter");

			if($_POST){
				$filter['type_name'] = $this->input->post('room_type');
				$filter['status'] = $this->input->post('status');
				$this->session->set_userdata("type_filter",$filter);
			}

			$page = $this->input->get("page");

			if(empty($page)) $page=1;
			$limit = 15;
			$data['total_rows'] = $this->m_room->get_total_type($filter);
			$offset = ($page-1)*$limit;
			$data['room_lists'] = $this->m_room->get_type('0',$limit,$offset,$filter);
			$data['limit'] = $limit;
			$data['offset'] = $offset;
			$data['content'] = "admin/room_type";
			$data['page_title'] = "Room Types";

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

	
	public function room_capacity($action="view",$capacity_id=0)
	{
		$this->load->model('m_room');
		if($action=="delete"){
			$filter['capacity_id'] = $capacity_id;
			$total_rows = $this->m_room->get_total_capacity($filter);
			if($total_rows>0){
				$this->m_room->delete_capacity($capacity_id);	
				set_noty('success',"Room capacity has been deleted");
			}else{
				set_noty('warning',"Invalid capacity to be delete");
			}
			redirect("admin/room/room_capacity");
		}elseif($action=="add"){
			$error = "";
			$capacity['capacity_name'] = $this->input->post('capacity_name');
			if(empty($capacity['capacity_name'])) $error.="Room capacity name is empty<br>";
			$capacity['total_adult'] = $this->input->post('total_adult');
			if(empty($capacity['total_adult'])) $error.="Room total_adult is empty<br>";
			
			if(empty($error)){
				$capacity['status'] = "active";
				$this->m_room->add_capacity($capacity);	
				set_noty('success',"Room capacity has been added");
			}else{
				set_noty('error',$error);
			}
        	redirect("admin/room/room_capacity");
		}elseif($action=="update"){
			$filter['capacity_id'] = $capacity_id;
			$total_rows = $this->m_room->get_total_capacity($filter);
			if($total_rows>0){
				$error = "";
				$capacity['capacity_name'] = $this->input->post('capacity_name');
				if(empty($capacity['capacity_name'])) $error.="Room capacity name is empty<br>";
				$capacity['status'] = $this->input->post('status');
				if(empty($capacity['status'])) $error.="Status is not selected<br>";
				$capacity['total_adult'] = $this->input->post('total_adult');
				if(empty($capacity['total_adult'])) $error.="Room total_adult is empty<br>";
				
				if(empty($error)){
					$this->m_room->update_capacity($capacity_id,$capacity);	
					set_noty('success',"Room capacity has been updated");
				}else{
					set_noty('error',$error);
				}	
			}else{
				set_noty('warning',"Invalid capacity to be update");
			}
        	redirect("admin/room/room_capacity");
		}elseif ($action=="edit") {
			$data['room_capacities'] = $this->m_room->get_capacity($capacity_id);
			echo(json_encode($data));
		}else{
			$filter = $this->session->userdata("capacity_filter");

			if($_POST){
				$filter['capacity_name'] = $this->input->post('room_capacity');
				$filter['status'] = $this->input->post('status');
				$filter['total_adult'] = $this->input->post('total_adult');
				$this->session->set_userdata("capacity_filter",$filter);
			}

			$page = $this->input->get("page");

			if(empty($page)) $page=1;
			$limit = 15;
			$data['total_rows'] = $this->m_room->get_total_capacity($filter);
			$offset = ($page-1)*$limit;
			$data['room_lists'] = $this->m_room->get_capacity('0',$limit,$offset,$filter);
			$data['limit'] = $limit;
			$data['offset'] = $offset;
			$data['content'] = "admin/room_capacity";
			$data['page_title'] = "Room Capacities";

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

}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
