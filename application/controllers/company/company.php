<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('manager/photo_model');
		$this->load->model('configs/city_model');
		$this->load->model('configs/configs_model');
		$this->load->model('company/company_model');
		$this->load->model('company/category_model');
		$this->load->library('form_validation');
	}

	function index(){
		$this->common->loadHeader(lang('m_company'));
		$query=$this->city_model->getCityCodes();
		$data['citys']=$query;
		$cate=$this->category_model->getParentCodes();
		$data['cates']=$cate;
		$data['scales']=$this->configs_model->getConfigsForType('4');
		$queryInfos=$this->company_model->getCompanys();
		$data['companylist']=$queryInfos;
		$this->load->view('company/company',$data);
	}

	function update($id){
		$this->common->loadHeader(lang('v_man_mall_update'));
		$query=$this->city_model->getCityCodes();
		$data['citys']=$query;
		$data['cates']=$this->category_model->getParentCodes();
		$data['scales']=$this->configs_model->getConfigsForType('4');
		$queryInfo=$this->company_model->getCompany($id);
		$data['companyInfo']=$queryInfo;
		$query=$this->company_model->getImages(0,$id);
		$data['imageList']=$query;
		$this->load->view('company/companyEdit',$data);
	}

	function addCompany()
	{
		$name=$_POST ['name'];
		$title=$_POST['title'];
		$city=$_POST ['city'];
		$logo=$_POST ['logo'];
		$image=$_POST['image'];
		$address=$_POST ['address'];
		$tel=$_POST ['tel'];
		$contact=$_POST ['contact'];
		$category=$_POST ['category'];
		$website=$_POST ['website'];
		$scale=$_POST ['scale'];
		$content=$_POST ['content'];
		$remark=$_POST ['remark'];
		$email=$_POST['email'];
		if($name != '' && $city != ''){
			$mid=$this->company_model->addCompany($city,$name,$title,$logo,$image,$content,$remark,$address,$tel,$contact,$email,$category,$website,$scale);
			redirect('company/company');
		}
	}
	function modifyCompany()
	{
		$id=$_POST['id'];
		$name=$_POST ['name'];
		$title=$_POST['title'];
		$city=$_POST ['city'];
		$logo=$_POST ['logo'];
		$image=$_POST['image'];
		$address=$_POST ['address'];
		$tel=$_POST ['tel'];
		$contact=$_POST ['contact'];
		$category=$_POST ['category'];
		$website=$_POST ['website'];
		$scale=$_POST ['scale'];
		$content=$_POST ['content'];
		$remark=$_POST ['remark'];
		$email=$_POST['email'];	
		if($id!=''&&$name != '' && $city != ''){
			$this->company_model->modifyCompany($id,$city,$name,$title,$logo,$image,$content,$remark,$address,$tel,$contact,$email,$category,$website,$scale);
			// $this->company_model->deleteImages(0,$id);
			// foreach ($param as $row) {
			// 	$this->company_model->addImage(0,$id,$row);
			// }	
			redirect('company/company');
		}
	}

}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */