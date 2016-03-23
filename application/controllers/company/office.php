<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office  extends CI_Controller {
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

		$query=$this->office_model->getOffices();
		$data['officeList']=$query;
		$data['cates']=$this->category_model->getParentCodes();
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
		$data['configTops']=$this->office_model->getConfigTops();
		
		$this->common->loadHeader(lang('m_company_office'));
		$this->load->view('company/office',$data);
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


	function cateSel($cateid){
		$data=$this->category_model->getCateCodes($cateid)->result();
		$str='';
		foreach ($data as $row) {
			$str.='<option value="'.$row->code.'">'.$row->title.'</option>';
		}
		echo $str;
	}
	function rateSel($cid){
		$data=$this->category_model->getCateCodes($cid)->result();
		$str='';
		foreach ($data as $row) {
			$str.='<option value="'.$row->code.'">'.$row->title.'</option>';
		}
		echo $str;
	}

	function addOffice()
	{

		$this->form_validation->set_rules('company','所属名称','trim|required');
		$this->form_validation->set_rules('name','职位名称','trim|required');
		$this->form_validation->set_rules('city','工作城市','trim|required');
		if ($this->form_validation->run()) {
			$company=$this->input->post('company');
			$name=$this->input->post('name');
			$category=$this->input->post('category');
			$dept=$this->input->post('dept');
			$posts=$this->input->post('posts');
			$prop=$this->input->post('prop');

			$bDate=$this->input->post('dpMainFrom');
			$eDate=$this->input->post('dpMainTo');

			$week=$this->input->post('week');
			$rate=$this->input->post('rate');
			$city=$this->input->post('city');
			$address=$this->input->post('address');
			$email=$this->input->post('email');
			$edu=$this->input->post('edu');
			$exp=$this->input->post('exp');
			$ratained=$this->input->post('ratained');

			$content=$this->input->post('content');
			$remark=$this->input->post('remark');

			$this->office_model->addOffice($company,$category,$name,$dept,$posts,$prop,$week,$rate,$city,$address,$email,$edu,$exp,$ratained,$content,$remark,$bDate,$eDate);
			redirect('company/office');
		}else{
			$company=$this->input->post('company');
			$name=$this->input->post('name');
			$category=$this->input->post('category');
			$dept=$this->input->post('dept');
			$posts=$this->input->post('posts');
			$prop=$this->input->post('prop');

			$bDate=$this->input->post('dpMainFrom');
			$eDate=$this->input->post('dpMainTo');

			$week=$this->input->post('week');
			$edu=$this->input->post('edu');
			$rate=$this->input->post('rate');
			$city=$this->input->post('city');
			$address=$this->input->post('address');
			$email=$this->input->post('email');
			$exp=$this->input->post('exp');
			$ratained=$this->input->post('ratained');
			$content=$this->input->post('content');
			$remark=$this->input->post('remark');

			$data['cates']=$this->category_model->getParentCodes();
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

			$this->common->loadHeader(lang('m_company_office'));
		
			$this->load->view('company/office',$this->data);
		}
		 // $this->output->enable_profiler(TRUE);
	}

	function modifyOffice()
	{

		$this->form_validation->set_rules('company','所属名称','trim|required');
		$this->form_validation->set_rules('name','职位名称','trim|required');
		$this->form_validation->set_rules('city','工作城市','trim|required');
		if ($this->form_validation->run()) {
			$id=$this->input->post('id');
			$company=$this->input->post('company');
			$name=$this->input->post('name');
			$category=$this->input->post('category');
			$dept=$this->input->post('dept');
			$posts=$this->input->post('posts');
			$prop=$this->input->post('prop');

			$bDate=$this->input->post('dpMainFrom');
			$eDate=$this->input->post('dpMainTo');

			$week=$this->input->post('week');
			$rate=$this->input->post('rate');
			$city=$this->input->post('city');
			$address=$this->input->post('address');
			$email=$this->input->post('email');
			$edu=$this->input->post('edu');
			$exp=$this->input->post('exp');
			$ratained=$this->input->post('ratained');

			$content=$this->input->post('content');
			$remark=$this->input->post('remark');

			$this->office_model->modifyOffice($id,$company,$category,$name,$dept,$posts,$prop,$week,$rate,$city,$address,$email,$edu,$exp,$ratained,$content,$remark,$bDate,$eDate);
			redirect('company/office');
		}else{
			$id=$this->input->post('id');
			$this->common->loadHeader(lang('v_man_office_update'));
			$query=$this->office_model->getOffice($id);
			$data['officeInfo']=$query;
	
			$data['cates']=$this->category_model->getParentCodes();
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
		
			$this->load->view('company/officeEdit',$data);

		}
		 // $this->output->enable_profiler(TRUE);
	}
}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */