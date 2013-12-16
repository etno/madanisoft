<?php
class M_User extends CI_Model 
{
	function get_data($arrValue=array())
	{
		$this->db->join($this->prefix.'people p','u.people_id=p.people_id');
		$this->db->join($this->prefix.'group_user g','u.gid=g.gid');
		$q = $this->db->get_where($this->prefix.'user u',$arrValue);
		return ($q->num_rows()>0)?$q->row():null;
	}

	function get_job_level($level_id=0,$limit=0,$offset=0,$filter="")
	{
		if($level_id>0) $this->db->where('level_id',$level_id);
		elseif($limit>0) $this->db->limit($limit,$offset);

		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');

		$q = $this->db->get($this->prefix.'level');

		if($level_id==0)
			return ($q->num_rows()>0)?$q->result():null;
		else
			return ($q->num_rows()>0)?$q->row():null;
	}

	function get_total_job_level($filter="")
	{
		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');
		$q = $this->db->get($this->prefix.'level');
		return $q->num_rows();
	}

	function delete_job_level($level_id=0)
	{
		$this->db->where('level_id',$level_id);
		$this->db->update($this->prefix.'level',array('status'=>'deleted'));
	}

	function update_job_level($level_id,$job_level)
	{
		$this->db->where('level_id',$level_id);
		$this->db->update($this->prefix.'level',$job_level);
	}

	function add_job_level($job_level)
	{
		$this->db->insert($this->prefix.'level',$job_level);
	}

	function get_group_list($gid=0,$limit=0,$offset=0,$filter="")
	{
		if($gid>0) $this->db->where('gid',$gid);
		elseif($limit>0) $this->db->limit($limit,$offset);

		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');

		$q = $this->db->get($this->prefix.'group_user');

		if($gid==0)
			return ($q->num_rows()>0)?$q->result():null;
		else
			return ($q->num_rows()>0)?$q->row():null;
	}

	function get_total_group_list($filter="")
	{
		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');
		$q = $this->db->get($this->prefix.'group_user');
		return $q->num_rows();
	}

	function delete_group_list($gid=0)
	{
		$this->db->where('gid',$gid);
		$this->db->update($this->prefix.'group_user',array('status'=>'deleted'));
	}

	function update_group_list($gid,$group_list)
	{
		$this->db->where('gid',$gid);
		$this->db->update($this->prefix.'group_user',$group_list);
	}

	function add_group_list($group_list)
	{
		$this->db->insert($this->prefix.'group_user',$group_list);
	}


}
/* End of file m_article.php */
/* Location: ./application/models/m_article.php */
