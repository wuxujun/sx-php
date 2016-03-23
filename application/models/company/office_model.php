<?php
class Office_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getBrandCodes(){
		$sql="SELECT id as code,brandName as title FROM `T_brand` WHERE status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getOffices(){
		$sql="SELECT * FROM `T_company_office` WHERE status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMOffices($content){
		$sql="SELECT a.id,a.name,a.address,a.workCity,a.rate,a.prop,a.week,a.companyId,b.name AS companyName,b.address AS companyAddr,b.category AS companyCate,b.scale,b.logo FROM `T_company_office` a,`T_company` b WHERE a.companyId=b.id AND a.status<3 ";
		
		$sql=$sql." ORDER BY a.id DESC  limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMOfficesForNums($content){
		$sql="SELECT count(1) as num  FROM `T_company_office` a,`T_company` b WHERE a.companyId=b.id AND a.status<3  ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}	
	}

	function getOfficeForId($content){
		$sql="select * from `T_company_office` where id=".$content->officeId;
		$query=$this->db->query($sql);
		return $query;
	}

	function getOfficeForCompany($content){
		$sql="SELECT a.id,a.name,a.address,a.workCity,a.rate,a.prop,a.week,a.companyId,b.name AS companyName,b.address AS companyAddr,b.category AS companyCate,b.scale,b.logo FROM `T_company_office` a,`T_company` b WHERE a.companyId=b.id AND a.status<3 ";
		$sql=$sql." AND a.companyId=".$content->companyId."  AND a.id<>".$content->officeId;

		$query=$this->db->query($sql);
		return $query;
	}

	function getOffice($id){
		$sql="select * from `T_company_office` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function addOffice($company,$category,$name,$dept,$posts,$prop,$week,$rate,$city,$address,$email,$edu,$exp,$ratained,$content,$remark,$bDate,$eDate)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('companyId' => $company,
			'category'=>$category,
			'name'=>$name,
			'dept'=>$dept,
			'posts'=>$posts,
			'prop'=>$prop,
			'week'=>$week,
			'rate'=>$rate,
			'workCity'=>$city,
			'address'=>$address,
			'email'=>$email,
			'edu'=>$edu,
			'workExp'=>$exp,
			'ratained'=>$ratained,
			'content'=>$content,
			'remark'=>$remark,
			'beginDate'=>$bDate,
			'endDate'=>$eDate,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('company_office',$arrayName);
	}

	function modifyOffice($id,$company,$category,$name,$dept,$posts,$prop,$week,$rate,$city,$address,$email,$edu,$exp,$ratained,$content,$remark,$bDate,$eDate)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('companyId' => $company,
			'category'=>$category,
			'name'=>$name,
			'dept'=>$dept,
			'posts'=>$posts,
			'prop'=>$prop,
			'week'=>$week,
			'rate'=>$rate,
			'workCity'=>$city,
			'address'=>$address,
			'email'=>$email,
			'edu'=>$edu,
			'workExp'=>$exp,
			'ratained'=>$ratained,
			'content'=>$content,
			'remark'=>$remark,
			'beginDate'=>$bDate,
			'endDate'=>$eDate,
			'changetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('company_office',$arrayName);
	}
	

	function modifyOfficeTop($id,$code)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('tops' => $code
		 );
		$this->db->where('id',$id);
		$this->db->update('company_office',$arrayName);
	}

	function getConfigTops(){
		$sql="SELECT * FROM `T_config_top` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMyOfficeReq($content){
		$sql="SELECT a.id,a.name,a.address,a.workCity,a.rate,a.prop,a.week,a.companyId,c.status,b.name AS companyName,b.address AS companyAddr,b.category AS companyCate,b.scale,b.logo  FROM `T_office_req` as c,`T_company_office` as a,`T_company` AS b WHERE a.companyId=b.id AND c.officeId=a.id and c.mid='".$content->mid."' limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMyOfficeReqForNums($content){
		$sql="select count(1) as num  from `T_office_req` where mid='".$content->mid."' ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}	
	}

	function getMyOffice($content){
		$sql="SELECT a.id,a.name,a.address,a.workCity,a.rate,a.prop,a.week,a.companyId,c.status,b.name AS companyName,b.address AS companyAddr,b.category AS companyCate,b.scale,b.logo  FROM `T_office_req` as c,`T_company_office` as a,`T_company` AS b WHERE a.companyId=b.id AND c.officeId=a.id and c.mid='".$content->mid."' and c.status=2 limit ".$content->start.",".$content->end." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMyOfficeForNums($content){
		$sql="select count(1) as num  from `T_office_req` where mid='".$content->mid."' and status=2 ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}	
	}

	function getOfficeReqs(){
		$sql="SELECT a.rid,a.mid,a.reqTime,b.companyId,b.name as officeName,a.status FROM `T_office_req` as a,`T_company_office` as b  where a.officeId=b.id   ";
		$query=$this->db->query($sql);
		return $query;
	}

	//查询是否存在
	function getOfficeReq($content){
		$sql="SELECT * FROM `T_office_req`  where officeId=".$content->officeId." and mid=".$content->mid."  ";
		$query=$this->db->query($sql);
		return $query;
	}

	//申请职位
	function addOfficeReq($content)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('officeId' => $content->officeId,
			'mid'=>$content->mid,
			'umengToken'=>$content->umeng_token,
			'reqtime'=>date('Y-m-d H:i:s')
		 );
		if ($this->db->insert('office_req', $arrayName)) {
			return $this->db->insert_id();
		}
		return 0;
	}

	function notifyOfficeReq($id)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('status' => '1'
		 );
		$this->db->where('rid',$id);
		$this->db->update('office_req',$arrayName);
	}

	function agreeOfficeReq($id)
	{
		$timezonestimeagreestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('status' => '2'
		 );
		$this->db->where('rid',$id);
		$this->db->update('office_req',$arrayName);
	}

	function search($content){
		$sql="SELECT * FROM `T_company_office` WHERE name like '%".$content->keyword."%' and status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

}

