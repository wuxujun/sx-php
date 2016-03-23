<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OfficeReq  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('company/category_model');
		$this->load->model('company/office_model');
		$this->load->model('company/company_model');
		$this->load->model('configs/configs_model');
		$this->load->model('configs/city_model');
		$this->load->library('form_validation');
	}

	function index(){

		$query=$this->office_model->getOfficeReqs();
		$data['infolist']=$query;
		$this->common->loadHeader(lang('m_company_office_req'));
		$this->load->view('company/officeReq',$data);
	}

	function update($id){
		$this->common->loadHeader(lang('v_man_office_update'));
		$query=$this->office_model->getOffice($id);
		$data['officeInfo']=$query;
		
		$data['companys']=$this->company_model->getCompanyCodes();
		$data['depts']=$this->category_model->getDeptCodes();
		$data['categorys']=$this->category_model->getOfficeCateCodes();
		$data['cates1']=$this->category_model->getCateCodes("10");
	
		$data['exps']=$this->configs_model->getConfigsForType("5");
		$data['rataineds']=$this->configs_model->getConfigsForType("6");
		$data['props']=$this->configs_model->getConfigsForType('1');
		$data['weeks']=$this->configs_model->getConfigsForType('2');
		$data['edus']=$this->configs_model->getConfigsForType('3');
		$data['citys']=$this->city_model->getCityCodes();
		$data['rates']=$this->category_model->getCateForType("40");
		
		
		$this->load->view('company/officeEdit',$data);
	}

	function notify($id){
		$this->office_model->notifyOfficeReq($id);
		redirect('company/officeReq');
	}

	function agree($id){
		$this->office_model->agreeOfficeReq($id);	
		redirect('company/officeReq');
	}
	
}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */