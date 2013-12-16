<?php
class M_Setting extends CI_Model 
{
	function get_setting($key)
	{
		$q = $this->db->get_where($this->prefix.'setting',array('key_name'=>$key));
		return ($q->num_rows()>0)?$q->row()->key_value:null;
	}

	function set_setting($key,$value)
	{
		$this->db->update($this->prefix.'setting',array('key_value'=>$value),array('key_name'=>$key));
	}

	function get_color_themes()
	{
		$q = $this->db->get($this->prefix.'color_themes');
		return ($q->num_rows()>0)?$q->result():null;
	}

	function get_menus($menu_parent='0')
	{
		$this->db->order_by('menu_order');
		$q = $this->db->get_where($this->prefix.'menus',array('menu_parent'=>$menu_parent));
		return ($q->num_rows()>0)?$q->result():null;
	}

	function get_menu_icon($menu_display='')
	{
		$q = $this->db->get_where($this->prefix.'menus',array('menu_display'=>$menu_display));
		return ($q->num_rows()>0)?$q->row():null;
	}

	function get_floor()
	{
		$q = $this->db->get($this->prefix.'floor');
		return ($q->num_rows()>0)?$q->result():null;
	}

	
}
/* End of file m_article.php */
/* Location: ./application/models/m_article.php */
