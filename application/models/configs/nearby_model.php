<?php
class Nearby_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getNearbys(){
		$sql="select * from `T_params_nearby` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getNearbyForPage($content){
		$sql="select id,province,cityId,type,pId,code,title,state from `T_params_nearby` limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getNearbyForNums($content){
		$sql="select count(1) as num  from `T_params_nearby` ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getNearby($id){
		$sql="select * from `T_params_nearby` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getNearbyCodes(){
		$sql="select code , title from T_params_nearby ";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function isUnique($code){
		$sql="select *  from `T_params_nearby` where code='".$code."' ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}
	function isUniqueForId($id,$code){
		$sql="select *  from `T_params_nearby` where id=".$id." and code='".$code."' ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function addNearby($province,$cityId,$type,$pid,$code,$name)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $cityId,
			'province'=>$province,
			'type'=>$type,
			'pId'=>$pId,
			'code'=>$code,
			'title'=>$name,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('params_nearby',$arrayName);
	}

	function modifyNearby($id,$province,$cityId,$type,$pId,$name)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $cityId,
			'province'=>$province,
			'type'=>$type,
			'pId'=>$pId,
			'title'=>$name,
			'updatetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('params_nearby',$arrayName);
	}
	
	function delete($id)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array(
			'state'=>'3'
		 );
		$this->db->where("id",$id);
		$this->db->update('params_nearby',$arrayName);	
	}
}

