<?php
class Category_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getCategorys(){
		$sql="select * from `T_category` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getDeptCodes(){
		$sql="select code,category as title from `T_category` where parent_code='2010' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getOfficeCateCodes(){
		$sql="select code,category as title from `T_category` where parent_code='2020' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCategoryForPage($content){
		$sql="select * from `T_category` limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCategoryForNums($content){
		$sql="select count(1) as num from `T_category` ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getCateCodes($cateid)
	{
		$sql="select code,category as title from `T_category` where parent_code='".$cateid."' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getParentCodes()
	{
		$sql="select code,category as title from `T_category` where parent_code='30' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCates(){
		$sql="select code,category as title from `T_category` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCategory($id){
		$sql="select * from `T_category` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}
	
	function isUnique($code){
		$sql="select *  from `T_category` where code=".$code;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function addCategory($code,$name,$parentCode)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('code' => $code,
			'category'=>$name,
			'parent_code'=>$parentCode,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('category',$arrayName);
	}
	
	function modifyCategory($id,$code,$name,$parentCode)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('code' => $code,
			'category'=>$name,
			'parent_code'=>$parentCode,
			'changetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('category',$arrayName);
	}

	function getMallCates($content){
		$sql="select * from `T_category` ";
		$query=$this->db->query($sql);
		return $query;
	}
}

