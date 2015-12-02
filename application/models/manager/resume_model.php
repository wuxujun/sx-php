<?php
class Resume_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	//添加照片
	function addPhoto($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mid'=>$content->mid,
			'photoName' => $content->photoName,
			'imageName'=>$content->imageName,
			'isSync'=>'1',
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('resume_photo',$arrayName);
	}

	function getPhoto($content){
		$sql="select *  from `T_resume_photo`  where mid = '".$content->mid."' ";
		$sql=$sql."  order by pid desc ";
		$query=$this->db->query($sql);
		return $query;
	}

	function deletePhoto($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));

		$this->db->where("id",$content->pid);
		$arrayName = array('status' =>'3',
			'updatetime'=>date('Y-m-d H:i:s')
		);
		$this->db->update("resume_photo",$arrayName);
	}

	
	function addMemberResume($content){
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mid' => $content->mid,
			'name'=>$content->name,
			'sex'=>$content->sex,
			'srcPlace'=>$content->srcPlace,
			'brithday'=>$content->brithday,
			'school'=>$content->school,
			'schoolName'=>$content->schoolName,
			'specialty'=>$content->specialty,
			'specialtyName'=>$content->specialtyName,
			'graduation'=>$content->graduation,
			'eduBackground'=>$content->eduBackground,
			'gradePoint'=>$content->gradePoint,
			'mobile'=>$content->mobile,
			'email'=>$content->email,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('resume_info',$arrayName);	
	}

	function changeMemberResume($content,$rid){
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$this->db->where("rid",$rid);
		$arrayName = array(
			'name'=>$content->name,
			'sex'=>$content->sex,
			'srcPlace'=>$content->srcPlace,
			'brithday'=>$content->brithday,
			'school'=>$content->school,
			'schoolName'=>$content->schoolName,
			'specialty'=>$content->specialty,
			'specialtyName'=>$content->specialtyName,
			'graduation'=>$content->graduation,
			'eduBackground'=>$content->eduBackground,
			'gradePoint'=>$content->gradePoint,
			'mobile'=>$content->mobile,
			'email'=>$content->email,
			'updatetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->update('resume_info',$arrayName);	
	}

	function getResumeForMid($mid){
		$sql="select *  from `T_resume_info` where mid=".$mid;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getMemberResume($content){
		$sql="select *  from `T_resume_info`  where mid = '".$content->mid."' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function addMemberWork($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('mid' => $content->mid,
			'companyName'=>$content->companyName,
			'officeName'=>$content->officeName,
			'beginTime'=>$content->beginTime,
			'endTime'=>$content->endTime,
			'addtime'=>date('Y-m-d H:i:s')
		);
		if ($this->db->insert('resume_work', $arrayName)) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function addMemberWorkInfo($wid,$mid,$msg)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('wid' => $wid,
			'mid'=>$mid,
			'content'=>$msg,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('resume_work_info',$arrayName);
	}


	function getMemberWork($content)
	{
		$sql="select *  from `T_resume_work`  where mid = '".$content->mid."' ";
		$sql=$sql."  order by wid desc ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMemberWorkInfo($wid,$mid)
	{
		$sql="select *  from `T_resume_work_info`  where wid = '".$wid."' and mid ='".$mid."' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function addMemberLife($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('mid' => $content->mid,
			'orgName'=>$content->companyName,
			'officeName'=>$content->officeName,
			'beginTime'=>$content->beginTime,
			'endTime'=>$content->endTime,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		if ($this->db->insert('resume_life', $arrayName)) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function addMemberLifeInfo($lid,$mid,$msg)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('lid' => $lid,
			'mid'=>$mid,
			'content'=>$msg,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('resume_info',$arrayName);
	}

	function getMemberLife($content)
	{
		$sql="select *  from `T_resume_life`  where mid = '".$content->mid."' ";
		$sql=$sql."  order by lid desc ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMemberLifeInfo($lid,$mid)
	{
		$sql="select *  from `T_resume_life_info`  where lid = '".$lid."' and mid ='".$mid."' ";
		$query=$this->db->query($sql);
		return $query;
	}

	function addMemberHonor($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('mid' => $content->mid,
			'title'=>$content->title,
			'content'=>$content->msg,
			'beginTime'=>$content->beginTime,
			'endTime'=>$content->endTime,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('resume_honor',$arrayName);
	}

	function getMemberHonor($content)
	{
		$sql="select *  from `T_resume_honor`  where mid = '".$content->mid."' ";
		$sql=$sql."  order by hid desc ";
		$query=$this->db->query($sql);
		return $query;
	}

}

