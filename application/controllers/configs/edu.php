<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edu  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('configs/edu_model');
		$this->load->model('configs/city_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->edu_model->getEdus();
		$data['edulist']=$query;
		$this->common->loadHeader(lang('m_configs_edu'));
		$data['provinces']=$this->city_model->getProvince();
		$this->load->view('configs/edu',$data);
	}

	function citySel($cid){
		$data=$this->city_model->getProvinceForCity($cid)->result();
		$str='';
		foreach ($data as $row) {
			$str.='<option value="'.$row->code.'">'.$row->title.'</option>';
		}
		echo $str;
	}

	function typeSel($cid){
		$data=$this->edu_model->getEduForCity($cid)->result();
		$str='';
		foreach ($data as $row) {
			$str.='<option value="'.$row->code.'">'.$row->title.'</option>';
		}
		echo $str;
	}


	function addEdu(){
		$province=$_POST['province'];
		$cityId = $_POST ['cityId'];
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$address = $_POST ['address'];
		$tel = $_POST ['tel'];
		$eId = $_POST ['eduId'];
		$type = $_POST ['type'];
		
		$result=$this->edu_model->isUnique($code);
		if(!empty($result)){
			$query=$this->edu_model->getEdus();
			$data['edulist']=$query;
			$this->common->loadHeader(lang('m_configs_edu'));
			$this->load->view('configs/edu',$data);
		}
		else{
			if($cityId!='' &&$code != '' && $name != ''){
				$this->edu_model->addEdu ($cityId,$province,$type,$eId,$code, $name,$address,$tel);
				redirect('configs/edu');
			}
		}
	}

	function modifyEdu(){
		$id = $_POST ['id'];
		$province=$_POST['province'];
		$cityId = $_POST ['cityId'];
		$name = $_POST ['name'];
		$address = $_POST ['address'];
		$tel = $_POST ['tel'];
		$eId = $_POST ['eduId'];
		$type = $_POST ['type'];
		if($id!=''&&$cityId!=''&& $name != ''){
			$this->edu_model->modifyEdu ($id,$cityId,$province,$type,$eId, $name,$address,$tel );	
			redirect('configs/edu');
		}
		
	}

	function update($id){
		$data ['eduInfo'] = $this->edu_model->getEdu( $id );
		$this->common->loadHeader(lang('v_man_edu_update'));
		$data['provinces']=$this->city_model->getProvince();
		$this->load->view ( 'configs/eduEdit', $data );
	}

	function delete($id)
	{
		
	}

}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */