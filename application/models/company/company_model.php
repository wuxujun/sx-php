<?php
class Company_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getConfigTops(){
		$sql="SELECT * FROM `T_config_top` ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCompanyCodes(){
		$sql="SELECT  id as code,title FROM `T_company` WHERE status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCompanys(){
		$sql="SELECT a.*,b.cityName FROM `T_company` as a,`T_city` as b  WHERE a.cityId=b.cityId  and a.status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getCompanyList($content){
		$sql="SELECT * FROM `T_company`  WHERE id=".$content->companyId;
		$query=$this->db->query($sql);
		return $query;
	}

	function getCompany($id){
		$sql="select * from `T_company` where id=".$id;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function addImage($type,$sid,$image)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('type' => $type,
			'sid'=>$sid,
			'image'=>$image,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('images',$arrayName);
	}

	function deleteImages($type,$sid)
	{
		$sql="delete from `T_images` where sid=".$sid." and type=".$type." ";
		$this->db->query($sql);
	}
	
	function getImages($type,$sid)
	{
		$sql="SELECT * FROM `T_images`  WHERE sid=".$sid." and type=".$type." ";
		$query=$this->db->query($sql);
		return $query;
	}

	function addCompany($city,$name,$title,$logo,$image,$content,$remark,$address,$tel,$contact,$email,$category,$website,$scale)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $city,
			'name'=>$name,
			'title'=>$title,
			'logo'=>$logo,
			'image'=>$image,
			'content'=>$content,
			'remark'=>$remark,
			'address'=>$address,
			'tel'=>$tel,
			'contact'=>$contact,
			'email'=>$email,
			'category'=>$category,
			'website'=>$website,
			'scale'=>$scale,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('company',$arrayName);
		return $this->db->insert_id();
	}

	function modifyCompany($id,$city,$name,$title,$logo,$image,$content,$remark,$address,$tel,$contact,$email,$category,$website,$scale)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$arrayName = array('cityId' => $city,
			'name'=>$name,
			'title'=>$title,
			'logo'=>$logo,
			'image'=>$image,
			'content'=>$content,
			'remark'=>$remark,
			'address'=>$address,
			'tel'=>$tel,
			'contact'=>$contact,
			'email'=>$email,
			'category'=>$category,
			'website'=>$website,
			'scale'=>$scale,
			'changetime'=>date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('company',$arrayName);
	}
	


	function getSearchKey($content){
		$sql="SELECT title,nums FROM `T_search_key` order by nums desc limit 0,6";
		$query=$this->db->query($sql);
		return $query;
	}

	function getHome($content){
		$sql="SELECT a.*,b.mallName,b.mallLogo,b.id as mallid FROM `T_article` as a,`T_mall` as b WHERE a.type=0 and a.sid=b.id and a.tops=1 and a.status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}
	function getHomeList($content){
		$sql="SELECT a.*,b.mallName FROM `T_article` as a,`T_mall` as b WHERE a.sid=b.id and a.tops=2 and a.status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getSales($content){
		$sql="SELECT a.*,b.mallName,c.brandName FROM `T_article` as a,`T_mall` as b,`T_brand` as c WHERE a.type=1 and a.tops=3 and a.sid=b.id and a.bid=c.id and a.status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMaps($content){
		$sql="SELECT a.*,b.cityName FROM `T_mall` as a,`T_city` as b  WHERE a.cityId=b.areaCode  and a.status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getBrands($content){
		$sql="SELECT a.*,b.brandName,c.mallName FROM `T_mall_brand` as a,`T_brand` as b,`T_mall` as c  WHERE a.mallId=c.id  and a.brandId=b.id and a.mallId=".$content->$mallId." and  a.status<3 ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallForBrands($content){
		$sql="SELECT a.id,a.mallId,a.brandId,a.floorId,a.site,a.tel,b.image as mallImage,b.mallName,c.brandName,c.brandLogo,c.brandCate,'0' as type,d.category as cateName FROM `T_mall_brand` a,`T_mall` b,`T_brand` c,T_brand_cate d where a.mallId=b.id and a.brandId=c.id  and b.id=".$content->mallId."  and c.brandCate=d.code ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallForBrandSales($content){
		$sql="SELECT distinct b.*,c.brandLogo,c.brandName,'1' as isSale FROM T_mall_brand a,T_article b,T_brand c where a.mallId=b.sid and b.type=1 and b.bid=c.id and  b.sid=".$content->mallId;
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallForBrandSaleInfo($content){
		$sql="SELECT distinct b.* FROM T_mall_brand a,T_article b where a.mallId=b.sid and b.type=1 and  b.sid=".$content->mallId."  and b.bid=".$content->brandId;
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallForBrandCommentInfo($content){
		$sql="SELECT a.*,b.image FROM T_comment a,T_member b where a.uid=b.id and mallId=".$content->mallId." and brandId=".$content->brandId;
		$query=$this->db->query($sql);
		return $query;
	}

	function getMyComment($content){
		$sql="SELECT a.*,b.image FROM T_comment a,T_member b where a.uid=b.id and b.id=".$content->uid;
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallForFloors($content){
		$sql="SELECT *  FROM `T_mall_floor` where mid=".$content->mallId." order by listorder  ";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallBrandForFloorId($mid,$fid){
		$sql="SELECT a.id,a.mallId,a.brandId,a.floorId,a.image,a.content,b.brandName,b.brandCate,b.brandLogo,d.category as cateName FROM T_mall_brand a,T_brand b,T_mall_floor c,T_brand_cate d where a.brandId=b.id and a.mallid=".$mid." and a.floorId=c.id and c.id=".$fid." and b.brandCate=d.code order by a.floorId,a.id asc";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallForBrandCate($content){
		$sql="SELECT a.id,a.mallId,a.brandId,a.floorId,a.image,a.content,b.brandName,b.brandCate,b.brandLogo,d.category as cateName,c.floorName FROM T_mall_brand a,T_brand b,T_mall_floor c,T_brand_cate d where a.brandId=b.id and a.mallid=".$content->mallId." and a.floorId=c.id and b.brandCate=d.code and d.code='".$content->cateCode."' order by a.floorId,a.id asc";
		$query=$this->db->query($sql);
		return $query;
	}

	function getMallForCates($content){
		$sql="SELECT *  FROM `T_brand_cate`  ";
		$query=$this->db->query($sql);
		return $query;
	}

	function search($content){
		if ($content->type=="0") {
			$sql="SELECT a.brandName,a.brandLogo,b.*,c.mallName,c.address FROM `T_brand` as a,`T_mall_brand` as b,`T_mall` as c where a.id=b.brandId and b.mallId=c.id and (a.brandName like '%".$content->searchKey."%'  or a.searchKey like '%".$content->searchKey."%' ) limit 0,20";
			$query=$this->db->query($sql);
			return $query;
		}else if($content->type=="2"){
			$sql="SELECT * FROM `T_mall` where mallName like '%".$content->searchKey."%' or searchKey like '%".$content->searchKey."%' ";
			$query=$this->db->query($sql);
			return $query;
		}
	}

	function getMallForBrandInfo($content)
	{
		$sql="SELECT a.*,b.brandName,c.mallName,d.floorName FROM `T_mall_brand` as a,`T_brand` as b,`T_mall` as c,`T_mall_floor` d  WHERE a.mallId=c.id  and a.brandId=b.id and a.floorId=d.id and a.mallId=".$content->mallId." and a.brandId=".$content->brandId." and  a.status<3 ";
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function getMessages($content){
		$sql="SELECT *  FROM `T_message` where type=".$content->type." order by id ";
		$query=$this->db->query($sql);
		return $query;
	}
}

