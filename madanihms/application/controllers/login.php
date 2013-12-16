<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{	
	public function __construct()
    {
        parent::__construct();
        $this->prefix = $this->config->item('company').'_'.$this->config->item('project').'_';
        $this->load->helper('common_helper');
    }
    
	public function index()
	{
		if($_POST){
			$this->load->model('m_user');

			//get input data
			$usernameemail = $this->input->post("usernameemail");
			$userpassword = $this->input->post("userpassword");

			$filter = array();
			if(strpos($usernameemail, "@")>0){
				$filter['email'] = $usernameemail;
			}else{
				$filter['username'] = $usernameemail;
			}
			$filter['password'] = make_encrypt_password($userpassword);
			$data = $this->m_user->get_data($filter);

			if(!empty($data)){
				$last_login = date("Y-m-d H:i:s");
				$sessiondata = array(
                    'uid'       => $data->uid,
                    'gid'       => $data->gid,
                    'username'   => $data->username,
                    'photo'   => $data->people_photo,
                    'first_name'   => $data->people_first_name,
                    'last_name'   => $data->people_last_name,
                    'group_name'   => $data->group_name,
                    'last_login' => $last_login
                    );
                $this->session->set_userdata('logged_in', $sessiondata);

                $data_update_lastlogin = array(
                    'last_login' => $last_login
                );

                $this->db->where('uid', $data->uid);
                $this->db->update($this->prefix.'user', $data_update_lastlogin);

				set_noty('success','Welcome to Madani Soft Hotel Management System');
        		redirect("admin/home");
			}else{
				set_noty('error','Invalid user or password');
        		redirect("login");
			}
		}else{
			$css_files = array('assets/lib/bootstrap/css/bootstrap.css',
	                        'assets/css/main.css',
	                        'assets/lib/magic/magic.css',
	                        'assets/css/light-theme.css');
	        $data['css_files'] = $css_files;
			$data['page_title'] = "Login Page";
			$this->load->view('login',$data);
		}
	}	

	function logout()
	{
		$this->session->unset_userdata("logged_in");
		redirect("login");
	}
}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
