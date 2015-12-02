<?php
class Floor_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getFloors(){
		$sql="SELECT a.id,a.mid,a.floorName,a.remark,a.status,a.addtime,a.changetime,b.mallName FROM `T_mall_floor` as a,`T_mall` as b  WHERE a.mid=b.id ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getFloor($id){
		$sql="select * from `T_mall_floor` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getFloorCodes($mid){
		$sql="select id as code,floorName as title from `T_mall_floor` where mid=".$mid;
		$query=$this->db->query($sql);
		return $query;
	}

	function addFloor($mid,$name,$image,$content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mid' => $mid,
			'floorName'=>$name,
			'image'=>$image,
			'remark'=>$content,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('mall_floor',$arrayName);
	}

	function modifyFloor($id,$mid,$name,$image,$content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mid' => $mid,
			'floorName'=>$name,
			'image'=>$image,
			'remark'=>$content,
			'changetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('mall_floor',$arrayName);
	}
	
	function delete($id)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array(
			'status'=>'3'
		 );
		$this->db->where("id",$id);
		$this->db->update('mall_floor',$arrayName);	
	}
}

