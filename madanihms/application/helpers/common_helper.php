<?php
	if (!defined('BASEPATH'))
		exit('No direct script access allowed');
	
	if (!function_exists('make_encrypt_password')) {
		function make_encrypt_password($key) {
			$total = strlen($key);
			$tengah = round($total/2);

			$value  = substr($key, $tengah, $total-$tengah).substr($key, 0, $tengah);
			$value  = sha1(md5($value));
			return $value;
		}
	}

	if (!function_exists('get_setting')) {
		function get_setting($key) {
			$CI = & get_instance();
			$CI->load->model('m_setting');
			$value = $CI->m_setting->get_setting($key);
			return $value;
		}
	}

	if (!function_exists('get_color_themes')) {
		function get_color_themes() {
			$CI = & get_instance();
			$CI->load->model('m_setting');
			$value = $CI->m_setting->get_color_themes();
			return $value;
		}
	}

	if (!function_exists('get_menus')) {
		function get_menus($menu_parent=0) {
			$CI = & get_instance();
			$CI->load->model('m_setting');
			$value = $CI->m_setting->get_menus($menu_parent);
			return $value;
		}
	}

	if (!function_exists('get_menu_icon')) {
		function get_menu_icon($menu_display="") {
			$CI = & get_instance();
			$CI->load->model('m_setting');
			$value = $CI->m_setting->get_menu_icon($menu_display);
			if(!empty($value)) $value=$value->menu_icon;
			return $value;
		}
	}

	if (!function_exists('format_date')) {
		function format_date($format,$time) {
			$value  = date($format,strtotime($time));
			return $value;
		}
	}


	if (!function_exists('get_floor')) {
		function get_floor() {
			$CI = & get_instance();
			$CI->load->model('m_setting');
			$value = $CI->m_setting->get_floor();
			return $value;
		}
	}

	if (!function_exists('get_room_types')) {
		function get_room_types() {
			$CI = & get_instance();
			$CI->load->model('m_room');
			$value = $CI->m_room->get_type();
			return $value;
		}
	}

	if (!function_exists('get_room_capacities')) {
		function get_room_capacities() {
			$CI = & get_instance();
			$CI->load->model('m_room');
			$value = $CI->m_room->get_capacity();
			return $value;
		}
	}

	if (!function_exists('set_noty')) {
	    function set_noty($type="info",$message="") {
	    	$CI = & get_instance();
	        $CI->session->set_flashdata('notification', true);
	        $CI->session->set_flashdata('notif_type', $type);
	        $CI->session->set_flashdata('notif_message', $message);
	    }
	}

	if (!function_exists('print_notification')) {
	    function print_notification() {
	    	$alerts = array("success"=>"success","info"=>"info","error"=>"danger","warning"=>"warning");
	    	$icons = array("success"=>"ok","info"=>"info","error"=>"remove","warning"=>"warning");
	        $CI = & get_instance();
	        $hasil = '';
	        if ($CI->session->flashdata('notification')) {
	        	$hasil ='<div id="myNotif" class="alert alert-'.$alerts[$CI->session->flashdata('notif_type')].' alert-dismissable" style="border-radius:0px;position: fixed;top: 10px;z-index: 99999;left: 18%;width: 65%;">
                      	<a class="close" data-dismiss="alert" href="#">×</a>
                      	<h4><i class="glyphicon glyphicon-'.$icons[$CI->session->flashdata('notif_type')].'-sign"></i> '.ucwords($CI->session->flashdata('notif_type')).'</h4>'.$CI->session->flashdata('notif_message').'
                    </div>';
	        }

	        return $hasil;
	    }
	}

	if (!function_exists('print_css')) {
	    function print_css($css_files="") {
	        if (!empty($css_files)) {
	        	foreach ($css_files as $key => $value) {
	        		print('<link rel="stylesheet" href="'.base_url().$value.'">');
	        	}
	        }
	    }
	}

	if (!function_exists('print_pagination')) {
		function print_pagination($total_rows,$limit,$offset,$no)
		{
			if($no>0){
              	$total_page = ceil($total_rows/$limit);
              	$page = max(1,floor($offset/$limit)+1);
              	echo '<div class="row">
              			<div class="col-lg-6">
			                <div class="dataTables_filter">
			                  Show '.($offset+1).' to '.$no.' from '.$total_rows.'
			                </div>
              			</div>
			            <div class="col-lg-6">
			                <div class="dataTables_paginate paging_bootstrap">
			                  <ul class="pagination">
			                    <li class="prev '.(($page==1)?'disabled':'').'">
			                      <button '.(($page==1)?'disabled':'').' class="btn btn-sm btn-default" 
			                      	onclick="pagination(\'formSearch\','.($page-1).')">
			                      	<i class="glyphicon glyphicon-arrow-left"></i> Previous
			                      </button>
			                    </li>';
			                      for($i=1;$i<=$total_page;$i++){
			                        echo '<li '.(($i==$page)?'class="active"':'').'>
			                          		<button '.(($i==$page)?'disabled':'').' 
			                          		class="btn btn-sm btn-'.(($i==$page)?'primary':'default').'"  
			                          		onclick="pagination(\'formSearch\','.$i.')">'.$i.'</button>
			                          	</li>';
			                      }
			                    echo '<li class="next '.(($page==$total_page)?'disabled':'').'">
			                      		<button '.(($page==$total_page)?'disabled':'').' class="btn btn-sm btn-default" 
			                      			onclick="pagination(\'formSearch\','.($page+1).')">Next 
			                      			<i class="glyphicon glyphicon-arrow-right"></i> 
			                      		</button>
			                    	</li>
			                  </ul>
			                </div>
			            </div>
			        </div>';
	        }
		}
	}

?>
