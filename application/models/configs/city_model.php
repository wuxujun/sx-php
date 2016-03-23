<?php
class City_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getCitys(){
		$sql="select * from `T_city` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCityForPage($content){
		$sql="select id,type,cityId,cityName,pId,top from `T_city` limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCityForNums($content){
		$sql="select count(1) as num  from `T_city` ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getCity($id){
		$sql="select * from `T_city` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getCityCodes(){
		$sql="select cityId as code ,cityName as title from T_city ";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function isUnique($code){
		$sql="select *  from `T_city` where cityId=".$code;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}
	function isUniqueForId($id,$code){
		$sql="select *  from `T_city` where id=".$id." and cityId=".$code;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function addCity($code,$name)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $code,
			'cityName'=>$name,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('city',$arrayName);
	}

	function modifyCity($id,$code,$name)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $code,
			'cityName'=>$name,
			'changetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('city',$arrayName);
	}
	
	function deletecar($id)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array(
			'state'=>'3'
		 );
		$this->db->where("id",$id);
		$this->db->update('member_car',$arrayName);	
	}

	function getProvince(){
		$sql="select cityId as code ,cityName as title from T_city  where cityId like '%0000' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getProvinceForCity($cid){
		$sql="select cityId as code ,cityName as title from T_city  where pId ='".$cid."' ";
		$query=$this->db->query($sql);
		return $query;
	}
}

