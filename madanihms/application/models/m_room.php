<?php
class M_Room extends CI_Model 
{
	function get_type($type_id=0,$limit=0,$offset=0,$filter="")
	{
		if($type_id>0) $this->db->where('type_id',$type_id);
		elseif($limit>0) $this->db->limit($limit,$offset);

		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');

		$q = $this->db->get($this->prefix.'room_type');

		if($type_id==0)
			return ($q->num_rows()>0)?$q->result():null;
		else
			return ($q->num_rows()>0)?$q->row():null;
	}

	function get_total_type($filter="")
	{
		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');
		$q = $this->db->get($this->prefix.'room_type');
		return $q->num_rows();
	}

	function delete_type($type_id=0)
	{
		$this->db->where('type_id',$type_id);
		$this->db->update($this->prefix.'room_type',array('status'=>'deleted'));
	}

	function update_type($type_id,$type)
	{
		$this->db->where('type_id',$type_id);
		$this->db->update($this->prefix.'room_type',$type);
	}

	function add_type($type)
	{
		$this->db->insert($this->prefix.'room_type',$type);
	}

	function get_room($room_id=0,$limit=10,$offset=0,$filter="")
	{
		$this->db->select('r.*,rt.type_name,rc.capacity_name,f.floor');
		$this->db->where('r.status != ','deleted');

		if($room_id>0) $this->db->where('room_id',$room_id);
		else{
			$this->db->limit($limit,$offset);
		}
		$this->db->join($this->prefix.'room_type rt','r.room_type_id=rt.type_id');
		$this->db->join($this->prefix.'room_capacity rc','r.room_capacity_id=rc.capacity_id');
		$this->db->join($this->prefix.'floor f','f.floor_id=r.room_floor');
		

		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				if($key=="status") $key="r.status";
				$this->db->like($key,$value,'both');
			}
		}	
		$q = $this->db->get($this->prefix.'room r');	

		// echo $this->db->last_query();

		if($room_id==0)
			return ($q->num_rows()>0)?$q->result():null;
		else
			return ($q->num_rows()>0)?$q->row():null;
	}

	function get_total_all($filter="")
	{
		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');

		$q = $this->db->get($this->prefix.'room');

		// echo $this->db->last_query();

		return $q->num_rows();
	}

	function delete_room($room_id=0)
	{
		$this->db->where('room_id',$room_id);
		$this->db->update($this->prefix.'room',array('status'=>'deleted'));
	}

	function update_room($room_id,$room)
	{
		$this->db->where('room_id',$room_id);
		$this->db->update($this->prefix.'room',$room);
	}

	function add_room($room)
	{
		$this->db->insert($this->prefix.'room',$room);
	}

	function get_capacity($capacity_id=0,$limit=0,$offset=0,$filter="")
	{
		if($capacity_id>0) $this->db->where('capacity_id',$capacity_id);
		elseif($limit>0) $this->db->limit($limit,$offset);

		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');

		$q = $this->db->get($this->prefix.'room_capacity');

		if($capacity_id==0)
			return ($q->num_rows()>0)?$q->result():null;
		else
			return ($q->num_rows()>0)?$q->row():null;
	}

	function get_total_capacity($filter="")
	{
		if(!empty($filter)){
			foreach ($filter as $key => $value) {
				$this->db->like($key,$value,'both');
			}
		}
		$this->db->where('status != ','deleted');
		$q = $this->db->get($this->prefix.'room_capacity');
		return $q->num_rows();
	}

	function delete_capacity($capacity_id=0)
	{
		$this->db->where('capacity_id',$capacity_id);
		$this->db->update($this->prefix.'room_capacity',array('status'=>'deleted'));
	}

	function update_capacity($capacity_id,$capacity)
	{
		$this->db->where('capacity_id',$capacity_id);
		$this->db->update($this->prefix.'room_capacity',$capacity);
	}

	function add_capacity($capacity)
	{
		$this->db->insert($this->prefix.'room_capacity',$capacity);
	}

}
/* End of file m_article.php */
/* Location: ./application/models/m_article.php */
