<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login {

    function check_logged_in() {
        $CI = & get_instance();
        $CI->load->library('session');
        $CI->load->library('router');
        if ($CI->session->userdata('logged_in')) {
            $session_data = $CI->session->userdata('logged_in');
            $redirect = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'';
            //redirect($redirect);
        } else {
            redirect('login', 'refresh');
        }
    }
    
}
