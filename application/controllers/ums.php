<?php
/**
 * Cobub Razor
 *
 * An open source analytics for mobile applications
 *
 * @package		Cobub Razor
 * @author		WBTECH Dev Team
 * @copyright	Copyright (c) 2011 - 2012, NanJing Western Bridge Co.,Ltd.
 * @license		http://www.cobub.com/products/cobub-razor/license
 * @link		http://www.cobub.com/products/cobub-razor/
 * @since		Version 1.0
 * @filesource
 */
class Ums extends CI_Controller {
	function Ums() {
		parent::__construct ();
		
		$isRedisEnabled = $this->config->item('redis');
		if($isRedisEnabled)
		{
			$servicePrefix = "redis_service";
		}
		else
		{
			$servicePrefix = "service";
		}
		$this->load->model ( $servicePrefix.'/utility', 'utility' );
		$this->load->model ( $servicePrefix.'/event', 'event' );
		$this->load->model ( $servicePrefix.'/userlog', 'userlog' );
		$this->load->model ( $servicePrefix.'/update', 'update' );
		$this->load->model ( $servicePrefix.'/clientdata', 'clientdata' );
		$this->load->model ( $servicePrefix.'/activitylog', 'activitylog' );
		$this->load->model ( $servicePrefix.'/onlineconfig', 'onlineconfig' );
		$this->load->model ( $servicePrefix.'/uploadlog', 'uploadlog' );

		$this->load->helper('url');
		$this->load->model('manager/member_model');
		$this->load->model('manager/version_model');
		$this->load->model('manager/feedback_model');
		$this->load->model('manager/photo_model');
		$this->load->model('company/company_model');
		$this->load->model('company/category_model');
		$this->load->model('company/office_model');
		$this->load->model('configs/city_model');
		$this->load->model('configs/configs_model');
		$this->load->model('manager/resume_model');
		$this->load->model('configs/edu_model');
		$this->load->model('configs/nearby_model');

	}

	function uploadImage(){
		try{
			$encoded_content=$_POST['content'];
			$content=json_decode($encoded_content);
			$pId="0";
			if (isset($content)) {
				$pId=$content->pId;
			}
			$filename=$this->photo_model->doUpload('file');
			$imgfiles=explode('.', $filename);
			$imgfile="0";
			if (count($imgfiles)>1) {
				$imgfile=$filename;
			}
			$ret=array('success' =>1 ,'errorCode'=>0 ,'errorMsg'=>'OK','msg'=>$filename,'filename'=>$imgfile,'pId'=>$pId);
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function addPhoto(){
		// $body=@file_get_contents('php://input');
		// if(!isset($body)){
		// 	$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
		// 	echo json_encode($ret);
		// 	return;
		// }
		// $encoded_content=$body;
		// $content=json_decode($encoded_content);
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);

		$this->resume_model->addPhoto($content);
		$data['dataType']="addPhoto";
		$data['success']="1";
		$data['errorCode']="0";
		echo json_encode($data);
	}

	/**添加uid*/
	function uuid(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$imei="1234";
		if (isset($content->imei)) {
			$imei=$content->imei;
		}
		try{
			$query=$this->member_model->getPushID($content->uuid);
			if ($query!=null) {
				$this->member_model->updatePushID($content->uuid,$imei,$content->platform);
				$ret = array('success' =>1 ,'errorCode'=>1,'errorMsg'=>'已存在');
			}else{
				$this->member_model->addPushID($content->uuid,$imei,$content->platform);
				$ret = array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'OK');
			}
		}catch(Exception $ex){
			$ret = array('success' =>0,'errorCode'=>-1,'errorMsg'=>'DB Error');
		}
		log_message('debug',json_encode($ret));
		echo json_encode($ret);
	}

	function location(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$this->member_model->addLocation($content);
			$ret = array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'OK');
		}catch(Exception $ex){
			$ret = array('success' =>0,'errorCode'=>-1,'errorMsg'=>'DB Error');
		}
		log_message('debug',json_encode($ret));
		echo json_encode($ret);
	}

	function resetpass(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);

		$user=$this->member_model->getMember($content->username);
		if (isset($user)) {
			$this->member_model->changePassword($content);
			$data['data']=$user;
			$data['isExist']="1";
		}else{
			$data['isExist']="0";
		}
		$data['dataType']="upass";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function upass(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);

		$user=$this->member_model->getMember($content->username);
		if (isset($user)&&$user->password==$content->old_password) {
			# code...
			$this->member_model->changePassword($content);
			$data['data']=$user;
			$data['isExist']="1";
		}else{
			$data['isExist']="0";
		}
		$data['dataType']="upass";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function checkUser(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$user=$this->member_model->getMember($content->mobile);
		if (isset($user)) {
			$data['errorMsg']="手机号已经注册过.";
			$data['isExist']="1";
		}else{
			$data['errorMsg']="";
			$data['isExist']="0";
		}
		$data['dataType']="checkUser";
		$data['success']="1";
		$data['errorCode']="0";
		echo json_encode($data);
	}

	/**
	*用户注册
	*/
	function register(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);

		$user=$this->member_model->getMember($content->mobile);
		if (isset($user)) {
			$data['errorMsg']="手机号已经注册过.";
			$data['isExist']="1";
			$data['data']=$user;
		}else{
			$this->member_model->addMember($content);
			$use=$this->member_model->getMember($content->mobile);
			$data['data']=$use;
			$data['isExist']="0";
		}
		$data['dataType']="register";
		$data['success']="1";
		$data['errorCode']="0";
		echo json_encode($data);
	}

	function thridLogin()
	{
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);

		$user=$this->member_model->getThirdMember($content);
		if (isset($user)) {
			$data['errorMsg']="用户已存在";
			$data['isExist']=$user->id;
			$data['user']=$user;
		}else{
			$uid=$this->member_model->addThirdMember($content);
			$user=$this->member_model->getThirdMemberForId($uid);
			$data['isExist']=$uid;
			$data['user']=$user;
		}
		$data['dataType']="thirdLogin";
		$data['success']="1";
		$data['errorCode']="0";
		echo json_encode($data);
	}

	function login()
	{
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);

		$user=$this->member_model->getMember($content->mobile);
		if (!empty($user)) {
			$this->member_model->changeLogin($content);
			$data['data']=$user;
		}else{
			$user=$this->member_model->getMemberForEmail($content->mobile);
			if (!empty($user)) {
				$this->member_model->changeLoginForEmail($content);
				$data['data']=$user;
			}else{
				$data['data']="";
			}	
		}
		$data['dataType']="login";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function search(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}

		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->office_model->search($content);
			$root=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function home(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->company_model->getHome($content);
			$root=array();
			foreach($query->result() as $row)
			{
				$images=$this->mall_model->getImages(0,$row->mallid)->result();
				$image=$row->image;
				$id=$row->id;
				$mallLogo=$row->mallLogo;
				$mallName=$row->mallName;
				$mid=$row->mallid;
				$title=$row->title;
				$bid=$row->bid;
				$type=$row->type;
				// $content=$row->content;
				$rs=compact("id","image","mallLogo","mallName","mid","title","bid","type","images");
				array_push($root, $rs);
			}
			// $query=$this->mall_model->getHomeList($content);
			$query=$this->mall_model->getSales($content);
			$searchKey=$this->mall_model->getSearchKey($content);
			$list=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"homeList"=>$list,"searchKey"=>$searchKey->result(),'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function company(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->company_model->getCompanyList($content);
			$root=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function offices(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$start=0;
		if (isset($content->start)) {
			$start=$content->start;
		}
		$end=20;
		if (isset($content->end)) {
			$end=$content->end;
		}
		try{
			$query=$this->office_model->getMOffices($content);
			$root=$query->result();
			$nums=$this->office_model->getMOfficesForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$start,'end'=>$end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function officeDetail(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->office_model->getOfficeForId($content);
			$root=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"data"=>$root[0],'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function companyDetail(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->company_model->getCompanyForId($content);
			$root=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"data"=>$root[0],'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function companyOffice(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->office_model->getOfficeForCompany($content);
			$root=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function officeAction(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			if ($content->actionType=='1') {
				$query=$this->office_model->getOfficeReq($content);
				if ($query!=null&&$query->num_rows()>0) {
					$ret=array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'已投递过该职位');
				}else{
					$reqid=$this->office_model->addOfficeReq($content);
					$this->member_model->addMemberOffice($reqid,$content);
					$ret=array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'投递成功');
				}
			}else if($content->actionType=='2'){
				$query=$this->member_model->getMemberCollect('1',$content->mid,$content->officeId);
				if ($query->num!='0') {
					$ret=array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'已收藏过该职位','rs'=>$query);
				}else{
					$this->member_model->addMemberCollect('1',$content->officeId,$content);
					$ret=array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'收藏成功');
				}
			}else{
				$query=$this->member_model->getMemberCollect('2',$content->mid,$content->companyId);
				if ($query->num!='0') {
					$ret=array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'已关注过该公司');
				}else{
					$this->member_model->addMemberCollect('2',$content->companyId,$content);	
					$ret=array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'关注成功');
				}
			}
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'操作失败');
		}
		echo json_encode($ret);
	}

	function myCollect(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->member_model->getMyCollects($content);
			$root=$query->result();
			$nums=$this->member_model->getMyCollectForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}
	
	function myOfficeReq(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->office_model->getMyOfficeReq($content);
			$root=$query->result();
			$nums=$this->office_model->getMyOfficeReqForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function myOffice(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->office_model->getMyOffice($content);
			$root=$query->result();
			$nums=$this->office_model->getMyOfficeForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}


	function city(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->city_model->getCityForPage($content);
			$root=$query->result();
			$nums=$this->city_model->getCityForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function dataConfig(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->configs_model->getDataConfig();
			$root=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function params(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->configs_model->getConfigForPage($content);
			$root=$query->result();
			$nums=$this->configs_model->getConfigForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}
	//学校信息
	function edus(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->edu_model->getEduForPage($content);
			$root=$query->result();
			$nums=$this->edu_model->getEduForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function nearbys(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->nearby_model->getNearbyForPage($content);
			$root=$query->result();
			$nums=$this->nearby_model->getNearbyForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,"total"=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}
	
	function myComment(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$comment=$this->mall_model->getMyComment($content);
			$ret=array('success' =>1 ,'errorCode'=>0,'root'=>$comment->result(),'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function comment(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->mall_model->getMallForBrandInfo($content);
			$comment=$this->mall_model->getMallForBrandCommentInfo($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"brandInfo"=>$query,'root'=>$comment->result(),'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}
	function addComment(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->mall_model->addComment($content);
			$ret=array('success' =>1 ,'errorCode'=>0,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function category(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->category_model->getCategoryForPage($content);
			$nums=$this->category_model->getCategoryForNums($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$query->result(),'total'=>$nums->num,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK','errorMsg'=>'操作成功');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error','errorMsg'=>'请求失败');
		}
		echo json_encode($ret);
	}

	function uInfo(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$filename=$this->photo_model->doUpload('image');
			$imgfiles=explode('.', $filename);
			$imgfile="0";
			if (count($imgfiles)>1) {
				$imgfile=$filename;
			}
			$this->member_model->updateMember($content,$imgfile);

			$ret=array('success' =>1 ,'errorCode'=>0 ,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	//通知信息
	function messages(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->mall_model->getMessages($content);
			$root=$query->result();
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$root,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	//检测版本
	function version(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
	
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);

		$version=$this->version_model->getVersion($content->platform);
		$data['data']=$version;
		$data['dataType']="version";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	//意见反馈
	function feedback(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}

		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$this->feedback_model->save($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function getNotifys(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}

		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		if (!isset($content->mobile)) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'mobile is null');
			echo json_encode($ret);
			return;
		}

		try{
			$query=$this->member_model->getMemberNotifys($content);
			$root=$query->result();
			$data['root']=$root;
			$data['dataType']="getNotifys";
			$data['success']="1";
			$data['errorCode']="0";
			$data['errorMsg']="操作成功";
		}catch(Exception $e){
			$data['root']=array();
			$data['dataType']="pdfs";
			$data['success']="1";
			$data['errorCode']="0";
			$data['errorMsg']="操作成功";
		}
		echo json_encode($data);
	}

	function addNotify(){
		if(!isset($_POST["content"])){
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		if (!isset($content->mobile)) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'mobikle is null');
			echo json_encode($ret);
			return;
		}
		if (!isset($content->type)) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'type is null');
			echo json_encode($ret);
			return;
		}
		try{
			$data=$this->member_model->getMemberNotify($content);
			if ($data!=null&&isset($data->id)) {
				$this->member_model->updateNotify($data->id,$content);
			}else{
				$this->member_model->addNotify($content);
			}
			$ret=array('success' =>1 ,'errorCode'=>0 ,'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}
	//更新会员信息
	function updateUser(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$info=$this->member_model->getMemberInfoForID($content->mid);
		if (!empty($info)) {
			$this->member_model->updateMemberInfoForMid($content);
		}else{
			$this->member_model->addMemberInfo($content);
		}
		$this->member_model->updateMemberForId($content);
		$data['dataType']="updateUser";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function memberInfo(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->member_model->getMemberInfoForMid($content->mid);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$query->result(),'errorMsg'=>'OK','errorMsg'=>'ok');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error','errorMsg'=>'error');
		}
		echo json_encode($ret);
	}

	//简历
	function addMemberResume(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$info=$this->resume_model->getResumeForMid($content->mid);
		if (!empty($info)) {
			$this->resume_model->changeMemberResume($content->resumeInfo,$info->rid);
		}else{
			$this->resume_model->addMemberResume($content->resumeInfo);
		}
		$data['dataType']="addMemberResume";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function addMemberLife(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$info=$this->resume_model->addMemberLife($content);
		// foreach ($content->datas as $key) {
		// 	$this->resume_model->addMemberLifeInfo($info,$content->mid,$key->title);
		// }
		$data['dataType']="addMemberLife";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function addMemberWork(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$wid=$this->resume_model->addMemberWork($content);
		// foreach ($content->datas as $key) {
		// 	$this->resume_model->addMemberWorkInfo($wid,$content->mid,$key->title);
		// }
		$data['msg']=$body;
		$data['dataType']="addMemberWork";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function addMemberHonor(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$this->resume_model->addMemberHonor($content);
		$data['dataType']="addMemberHonor";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}

	function addMemberLang(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		$this->resume_model->addMemberLang($content);
		$data['dataType']="addMemberLang";
		$data['success']="1";
		$data['errorCode']="0";
		$data['errorMsg']="操作成功";
		echo json_encode($data);
	}
	
	function resumeWork(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->resume_model->getMemberWork($content);
			// $root=array();
			// foreach($query->result() as $row)
			// {
			// 	$infos=$this->resume_model->getMemberWorkInfo($row->wid,$row->mid)->result();
			// 	$wid=$row->wid;
			// 	$mid=$row->mid;
			// 	$companyName=$row->companyName;
			// 	$officeName=$row->officeName;
			// 	$beginTime=$row->beginTime;
			// 	$endTime=$row->endTime;
			// 	$rs=compact("wid","mid","companyName","officeName","beginTime","endTime","infos");
			// 	array_push($root, $rs);
			// }
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$query->result(),'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function resumeLife(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->resume_model->getMemberLife($content);
			// $root=array();
			// foreach($query->result() as $row)
			// {
			// 	$infos=$this->resume_model->getMemberLifeInfo($row->lid,$row->mid)->result();
			// 	$lid=$row->lid;
			// 	$mid=$row->mid;
			// 	$orgName=$row->orgName;
			// 	$officeName=$row->officeName;
			// 	$beginTime=$row->beginTime;
			// 	$endTime=$row->endTime;
			// 	$rs=compact("lid","mid","orgName","officeName","beginTime","endTime","infos");
			// 	array_push($root, $rs);
			// }
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$query->result(),'errorMsg'=>'OK');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error');
		}
		echo json_encode($ret);
	}

	function resumeInfo(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->resume_model->getMemberResume($content);
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$query->result(),'errorMsg'=>'OK','errorMsg'=>'ok');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error','errorMsg'=>'error');
		}
		echo json_encode($ret);
	}

	function resumeHonor(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->resume_model->getMemberHonor($content);
			// $nums=$this->category_model->getCategoryForNums($content);
			$nums=10;
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$query->result(),'total'=>$nums,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK','errorMsg'=>'ok');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error','errorMsg'=>'error ');
		}
		echo json_encode($ret);
	}

	function resumeLang(){
		if (!isset($_POST["content"])) {
			$ret = array('success' => 0,'errorCode'=>-1,'errorMsg'=>'Invalid content');
			echo json_encode($ret);
			return;
		}
		$encoded_content=$_POST['content'];
		$content=json_decode($encoded_content);
		try{
			$query=$this->resume_model->getMemberLang($content);
			// $nums=$this->category_model->getCategoryForNums($content);
			$nums=10;
			$ret=array('success' =>1 ,'errorCode'=>0 ,"root"=>$query->result(),'total'=>$nums,'start'=>$content->start,'end'=>$content->end,'errorMsg'=>'OK','errorMsg'=>'ok');
		}catch(Exception $e){
			$ret=array('success' =>0 ,'errorCode'=>-1 ,'errorMsg'=>'DB error','errorMsg'=>'error ');
		}
		echo json_encode($ret);
	}
	/*
	 * Interface to accept event log by client
	 */
	function postEvent() {
		if (! isset ( $_POST ["content"] )) {
			
			$ret = array (
					'flag' => - 3,
					'msg' => 'Invalid content.' 
			);
			echo json_encode ( $ret );
			return;
		}
		
		$encoded_content = $_POST ["content"];
		log_message ( "debug", $encoded_content );
		$content = json_decode ( $encoded_content );
		$retParamsCheck = $this->utility->isPraramerValue ( $content, $array = array (
				'appkey',
				'event_identifier',
				'time',
				'activity' 
		) );
		
		if ($retParamsCheck ['flag'] <= 0) {
			$ret = array (
					'flag' => - 2,
					'msg' => $retParamsCheck ['msg'] 
			);
			echo json_encode ( $ret );
			return;
		}
		$key = $content->appkey;
		$isKeyAvailable = $this->utility->isKeyAvailale ( $key );
		if (! $isKeyAvailable) {
			$ret = array (
					'flag' => - 1,
					'msg' => 'NotAvailable appkey ' 
			);
			echo json_encode ( $ret );
			return;
		} 
		else
		{
			$isgetEventid = $this->event->addEvent ( $content );
			if (!$isgetEventid) {
				$ret = array (
						'flag' => - 5,
						'msg' => 'event_identifier not defined in product with provided appkey' 
				);
				echo json_encode ( $ret );
				return;
			} 
			else
			{
				$ret = array (
						'flag' => 1,
						'msg' => 'ok' 
					);
			}
			echo json_encode ( $ret );
		}
	}
	
	/*
	 * Interface to accept error log by client
	 */
	function postErrorLog() {
		if (! isset ( $_POST ["content"] )) {
			$ret = array (
					'flag' => - 3,
					'msg' => 'Invalid content.' 
			);
			echo json_encode ( $ret );
			return;
		}
		$encoded_content = $_POST ["content"];
		$content = json_decode ( $encoded_content );
		log_message ( 'debug', $encoded_content );
		$retParamsCheck = $this->utility->isPraramerValue ( $content, $array = array (
				"appkey",
				"stacktrace",
				"time",
				"activity",
				"os_version",
				"deviceid" 
		) );
		if ($retParamsCheck ["flag"] <= 0) {
			$ret = array (
					'flag' => - 2,
					'msg' => $retParamsCheck ['msg'] 
			);
			echo json_encode ( $ret );
			return;
		}
		$key = $content->appkey;
		$isKeyAvailable = $this->utility->isKeyAvailale ( $key );
		if (! $isKeyAvailable) {
			$ret = array (
					'flag' => - 1,
					'msg' => 'NotAvailable appkey  ' 
			);
			echo json_encode ( $ret );
			return;
		} else {
			try {
				$this->userlog->addUserlog ( $content );
				$ret = array (
						'flag' => 1,
						'msg' => 'ok' 
				);
			} catch ( Exception $ex ) {
				$ret = array (
						'flag' => - 4,
						'msg' => 'DB Error' 
				);
			}
		}
		echo json_encode ( $ret );
	}
	
	/*
	 * Interface to accept client data
	 */
	function postClientData() {
		if (! isset ( $_POST ["content"] )) {
			$ret = array (
					'flag' => - 3,
					'msg' => 'Invalid content.' 
			);
			echo json_encode ( $ret );
			return;
		}
		$encoded_content = $_POST ["content"];
		$content = json_decode ( $encoded_content );
		$retParamsCheck = $this->utility->isPraramerValue ( $content, $array = array (
				"appkey",
				"platform",
				"os_version",
				"language",
				"deviceid",
				"resolution" 
		) );
		if ($retParamsCheck ["flag"] <= 0) {
			$ret = array (
					'flag' => - 2,
					'msg' => $retParamsCheck ['msg'] 
			);
			echo json_encode ( $ret );
			return;
		}
		$key = $content->appkey;
		$isKeyAvailable = $this->utility->isKeyAvailale ( $key );
		if (! $isKeyAvailable) {
			$ret = array (
					'flag' => - 1,
					'msg' => 'Invalid app key' 
			);
			echo json_encode ( $ret );
			return;
		} else {
			try {
				$this->clientdata->addClientdata ( $content );
				$ret = array (
						'flag' => 1,
						'msg' => 'ok' 
				);
			} catch ( Exception $ex ) {
				$ret = array (
						'flag' => - 4,
						'msg' => 'DB Error' 
				);
			}
		}
		log_message('debug',json_encode($ret));
		echo json_encode ( $ret );
	}
	
	/*
	 * Interface to accept Activity Log
	 */
	function postActivityLog() {
		if (! isset ( $_POST ["content"] )) {
			$ret = array (
					'flag' => - 3,
					'msg' => 'Invalid content.' 
			);
			echo json_encode ( $ret );
			return;
		}
		$encoded_content = $_POST ["content"];
		log_message ( "debug", $encoded_content );
		$content = json_decode ( $encoded_content );
		$retParamsCheck = $this->utility->isPraramerValue ( $content, $array = array (
				"appkey",
				"session_id",
				"start_millis",
				"end_millis",
				"duration",
				"activities" 
		) );
		if ($retParamsCheck ["flag"] <= 0) {
			$ret = array (
					'flag' => - 2,
					'msg' => $retParamsCheck ['msg'] 
			);
			echo json_encode ( $ret );
			return;
		}
		$key = $content->appkey;
		$isKeyAvailable = $this->utility->isKeyAvailale ( $key );
		if (! $isKeyAvailable) {
			$ret = array (
					'flag' => - 1,
					'msg' => 'NotAvailable appkey ' 
			);
			echo json_encode ( $ret );
			return;
		} else {
			try {
				$this->activitylog->addActivitylog ( $content );
				$ret = array (
						'flag' => 1,
						'msg' => 'ok' 
				);
			} catch ( Exception $ex ) {
				$ret = array (
						'flag' => - 4,
						'msg' => 'DB Error' 
				);
			}
		}
		echo json_encode ( $ret );
	}
	
	/*
	 * Interface to accept total log
	 */
	function uploadLog() {
		if (! isset ( $_POST ["content"] )) {
			$ret = array (
					'flag' => - 3,
					'msg' => 'Invalid content.' 
			);
			echo json_encode ( $ret );
			return;
		}
		$encoded_content = $_POST ['content'];
		log_message ( "debug", $encoded_content );
		$content = json_decode ( $encoded_content );
		$key = $content->appkey;
		$isKeyAvailable = $this->utility->isKeyAvailale ( $key );
		if (! $isKeyAvailable) {
			$ret = array (
					'flag' => - 1,
					'msg' => 'NotAvailable appkey  ' 
			);
			echo json_encode ( $ret );
			return;
		} else {
			try {
				$this->uploadlog->addUploadlog ( $content );
				$ret = array (
						'flag' => 1,
						'msg' => 'ok' 
				);
			} catch ( Exception $ex ) {
				$ret = array (
						'flag' => - 4,
						'msg' => 'DB Error' 
				);
			}
		}
		echo json_encode ( $ret );
	}
	
	function Gzip() {
		$data = $_POST ['content'];
		$this->utility->gzdecode ( $data );
	}
	
	/*
	 * Get Application Update by version no
	 */
	function getApplicationUpdate() {
		header ( "Content-Type:application/json" );
		if (! isset ( $_POST ["content"] )) {
			
			$ret = array (
					'flag' => - 3,
					'msg' => 'Invalid content.' 
			);
			echo json_encode ( $ret );
			return;
		}
		$encoded_content = $_POST ["content"];
		log_message ( "debug", $encoded_content );
		$content = json_decode ( $encoded_content );
		$retParamsCheck = $this->utility->isPraramerValue ( $content, $array = array (
				"appkey",
				"version_code" 
		) );
		if ($retParamsCheck ["flag"] <= 0) {
			$ret = array (
					'flag' => - 2,
					'msg' => $retParamsCheck ['msg'] 
			);
			echo json_encode ( $ret );
			return;
		}
		$key = $content->appkey;
		$version_code = $content->version_code;
		$isKeyAvailable = $this->utility->isKeyAvailale ( $key );
		if (! $isKeyAvailable) {
			$ret = array (
					'flag' => - 1,
					'msg' => 'NotAvailable appkey ' 
			);
			echo json_encode ( $ret );
			return;
		} else {
			$haveNewversion = $this->update->haveNewversion ( $key, $version_code );
			if (! $haveNewversion) {
				$ret = array (
						'flag' => - 7,
						'msg' => 'no new version' 
				);
				echo json_encode ( $ret );
				return;
			} else {
				try {
					$product = $this->update->getProductUpdate ( $key );
					if ($product != null) {
						$ret = array (
								'flag' => 1,
								'msg' => 'ok',
								'fileurl' => $product->updateurl,
								'forceupdate' => $product->man,
								'description' => $product->description,
								'time' => $product->date,
								'version' => $product->version 
						);
					}
				} catch ( Exception $ex ) {
					$ret = array (
							'flag' => - 4,
							'msg' => 'DB Error' 
					);
				}
			}
			echo json_encode ( $ret );
		}
	}
	/*
	 * Used to get Online Configuration
	 */
	function getOnlineConfiguration() {
		$encoded_content = $_POST ['content'];
		log_message ( 'debug', $encoded_content );
		$content = json_decode ( $encoded_content );
		$key = $content->appkey;
		log_message ( 'debug', $key );
		if (! isset ( $key )) {
			$ret = array (
					'flag' => - 2,
					'msg' => 'Invalid key.' 
			)
			;
			echo json_encode ( $ret );
			return;
		} else {
			$isKeyAvailable = $this->utility->isKeyAvailale ( $key );
			if (! $isKeyAvailable) {
				$ret = array (
						'flag' => - 1,
						'msg' => 'NotAvailable appkey ' 
				);
				echo json_encode ( $ret );
				return;
			} else {
				try {
					$productid = $this->onlineconfig->getProductid ( $key );
					$configmessage = $this->onlineconfig->getConfigMessage ( $productid );
					if ($configmessage != null) {
						$ret = array (
								'flag' => 1,
								'msg' => 'ok',
								'autogetlocation' => $configmessage->autogetlocation,
								'updateonlywifi' => $configmessage->updateonlywifi,
								'sessionmillis' => $configmessage->sessionmillis,
								'reportpolicy' => $configmessage->reportpolicy 
						);
					}
				} catch ( Exception $ex ) {
					$ret = array (
							'flag' => - 4,
							'msg' => 'DB Error' 
					);
				}
			}
			echo json_encode ( $ret );
		}
	}
}
