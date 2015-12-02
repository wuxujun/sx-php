<?php
class Configs_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getConfigss(){
		$sql="select * from `T_params` ";
		$query=$this->db->query($sql);
		return $query;
	}
	function getConfigs($id){
		$sql="select * from `T_params` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getConfigForPage($content){
		$sql="select * from `T_params` limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getConfigForNums($content){
		$sql="select count(1) as num  from `T_params` ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getConfigsForType($type){
		$sql="select code,name as title from `T_params` where type=".$type;
		$query=$this->db->query($sql);
		return $query;
	}

	function getConfigsCodes(){
		$sql="select code ,name as title from T_params ";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function isUnique($type,$code){
		$sql="select *  from `T_params` where type=".$type." and code=".$code;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}
	function isUniqueForId($id,$code){
		$sql="select *  from `T_params` where id=".$id." and code=".$code;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function addConfigs($type,$code,$name)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('code' => $code,
			'name'=>$name,
			'type'=>$type,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('params',$arrayName);
	}

	function modifyConfigs($id,$type,$code,$name)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('code' => $code,
			'name'=>$name,
			'type'=>$type,
			'changetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('params',$arrayName);
	}
}

