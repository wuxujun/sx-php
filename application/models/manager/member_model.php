<?php
class Member_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getMemberList(){
		$sql="select * from `T_member` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMembers(){
		$sql="select mobile from `T_member` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMember($mobile){
		$sql="select *  from `T_member` where mobile=".$mobile;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	//获取第三方用户
	function getThirdMember($content){
		$sql="select *  from `T_member` where userType=".$content->userType." and userNick='".$content->userNick."' ";
		if ($content->userType=='1'||$content->userType=='3') {
			$sql=$sql." and openid='".$content->openid."' ";
		}
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getThirdMemberForId($uid){
		$sql="select *  from `T_member` where id='".$uid."' ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function updateThirdMobile($content){
		$this->db->where("id",$content->uid);
		$arrayName = array('mobile'=>$content->mobile,
			'imei'=>$content->imei
		 );
		$this->db->update("member",$arrayName);		
	}

	function addThirdMember($content){
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mobile' => $content->mobile,
			'password'=>'123456',
			'userType'=>$content->userType,
			'openid'=>$content->openid,
			'userNick'=>$content->userNick,
			'userAvatar'=>$content->avatar,
			'imei'=>$content->imei,
			'umeng_token'=>$content->umengToken,
			'addtime'=>date('Y-m-d H:i:s'),
			'lastlogintime'=>date('Y-m-d H:i:s')
		 );
		if ($this->db->insert('member', $arrayName)) {
			return $this->db->insert_id();
		}
		return 0;
	}


	function getMemberInfo($id)
	{
		$sql="SELECT * FROM T_member_info  WHERE member_id =".$id;
		$query=$this->db->query($sql);
		return $query;
	}

	function getMemberForID($id)
	{
		$sql="select *  from `T_member` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getMemberInfoForID($id)
	{
		$sql="select *  from `T_member_info` where memberid=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getPushMembers()
	{
		$sql="select mobile from T_member where imei in (select imei from push_uid ) ";
		$query=$this->db->query($sql);
		return $query;
	}

	//页面新增
	function saveMember($mobile,$pass)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mobile' => $mobile,
			'password'=>$pass,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('member',$arrayName);
	}
	function saveMemberInfo($id,$name,$sex,$cardno,$email,$phone,$address,$postcode,$systemno,$cardvalid,$drivingdate,$category)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('memberid'=>$id,'name' => $name,
			'sex'=>$sex,
			'card_no'=>$cardno,
			'email'=>$email,
			'phone'=>$phone,
			'address'=>$address,
			'post_code'=>$postcode,
			'system_card_no'=>$systemno,
			'card_validtime'=>$cardvalid,
			'driving_yearly_verify_date'=>$drivingdate,
			'system_category'=>$category,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('member_info',$arrayName);

	}

	function addLocation($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mid' => $content->uid,
			'uuid'=>$content->uuid,
			'imei'=>$content->imei,
			'longitude'=>$content->longitude,
			'latitude'=>$content->latitude,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('member_loc',$arrayName);
	}

	//手机端注册
	function addMember($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('mobile' => $content->mobile,
			'email'=>$content->email,
			'password'=>$content->password,
			'imei'=>$content->imei,
			'addtime'=>date('Y-m-d H:i:s'),
			'lastlogintime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('member',$arrayName);
	}


	function changeLogin($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$this->db->where("mobile",$content->mobile);
		$arrayName = array('imei' =>$content->imei,'lastlogintime'=>date('Y-m-d H:i:s'));
		$this->db->update("member",$arrayName);
	}

	function changePassword($content)
	{
		$this->db->where("mobile",$content->username);
		$arrayName = array('password' =>$content->password);
		$this->db->update("member",$arrayName);
	}

	//我的申请
	function addMemberOffice($reqid,$content){
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		//$password="123";
		$arrayName = array('mid' => $content->mid,
			'officeId'=>$content->officeId,
			'reqId'=>$reqid,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('member_app',$arrayName);
	}

	function getMyCollects($content){
		$sql="select * from `v_my_collect`  where mid=".$content->mid." limit ".$content->start.",".$content->end." ";
		return $query=$this->db->query($sql);
	}

	function getMyCollectForNums($content){
		$sql="select count(1) as num from `v_my_collect` where mid='".$content->mid."' ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}	
	}

	function getMemberCollect($type,$mid,$dataId){
		$sql="select count(1) as num  from `T_member_collect` where mid=".$mid." and dataType=".$type." and dataId=".$dataId;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
		return 0;
	}

	//职位收藏 公司关注
	function addMemberCollect($type,$dataId,$content){
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		//$password="123";
		$arrayName = array('mid' => $content->mid,
			'dataType'=>$type,
			'dataId'=>$dataId,
			'umengToken'=>$content->umeng_token,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('member_collect',$arrayName);
	}

	function getMemberUUID($mobile)
	{
		$sql="select * from push_uid where imei in (select imei from member where mobile='".$mobile."') ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getPushID($uuid){
		$sql="select * from T_push_uid where uuid='".$uuid."'";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function updatePushID($uuid,$imei,$platform)
	{
		$this->db->where("uuid",$uuid);
		$arrayName = array('imei' =>$imei,'platform'=>$platform);
		$this->db->update("push_uid",$arrayName);
	}
	
	function addPushID($uuid,$imei,$platform){
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		//$password="123";
		$arrayName = array('uuid' => $uuid,
			'imei'=>$imei,
			'platform'=>$platform,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('push_uid',$arrayName);
	}

	function getMemberNotify($content)
	{
		$sql="select *  from `T_member_notify` where mobile='".$content->mobile."'  and notify_type='".$content->type."' ";
		$sql=$sql."  order by addtime desc ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}
	function getMemberNotifys($content)
	{
		$sql="select *  from `T_member_notify` where mobile='".$content->mobile."' ";
		$query=$this->db->query($sql);
		return $query;
	}



	function addNotify($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('mobile' => $content->mobile,
			'notify_type'=>$content->type,
			'state'=>$content->state,
			'imei'=>$content->imei,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('member_notify',$arrayName);
	}

	function updateMember($content,$imgFile)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array(
			'userNick'=>$content->userNick,
			'cityName'=>$content->cityName,
			'image'=>$imgFile
		 );
		$this->db->where("id",$content->uid);
		$this->db->update('member',$arrayName);	
	}

}

