<?php
class Edu_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getEdus(){
		$sql="select id,cityId,type,pId,eduCode,eduName,eduAddress,eduTel,state,if(type=0,'学校','下属分院') as typeName from `T_params_edu` where state=0 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getEduForPage($content){
		$sql="select id,province,cityId,type,pId,eduCode,eduName,eduAddress,eduTel,eduContact,state from `T_params_edu` limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getEduForNums($content){
		$sql="select count(1) as num  from `T_params_edu` ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getEdu($id){
		$sql="select * from `T_params_edu` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getEduCodes(){
		$sql="select eduCode as code ,eduName as title from T_params_edu ";
		$query=$this->db->query($sql);
		return $query;
	}
	
	function isUnique($code){
		$sql="select *  from `T_params_edu` where eduCode='".$code."' ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}
	function isUniqueForId($id,$code){
		$sql="select *  from `T_params_edu` where id=".$id." and eduCode='".$code."' ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function addEdu($cityId,$province,$type,$eid,$code,$name,$addr,$tel)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $cityId,
			'province'=>$province,
			'type'=>$type,
			'pId'=>$eid,
			'eduCode'=>$code,
			'eduName'=>$name,
			'eduAddress'=>$addr,
			'eduTel'=>$tel,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('params_edu',$arrayName);
	}

	function modifyEdu($id,$cityId,$province,$type,$eid,$name,$addr,$tel)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $cityId,
			'province'=>$province,
			'type'=>$type,
			'pId'=>$eid,
			'eduName'=>$name,
			'eduAddress'=>$addr,
			'eduTel'=>$tel,
			'updatetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('params_edu',$arrayName);
	}
	
	function delete($id)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array(
			'state'=>'3'
		 );
		$this->db->where("id",$id);
		$this->db->update('params_edu',$arrayName);	
	}

	function getEduForCity($cid){
		$sql="select eduCode as code,eduName as title from `T_params_edu` where type=0 and cityId='".$cid."' ";
		$query=$this->db->query($sql);
		return $query;
	}
}

