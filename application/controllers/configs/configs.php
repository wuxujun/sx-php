<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configs  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('configs/configs_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->configs_model->getConfigss();
		$data['configslist']=$query;
		$this->common->loadHeader(lang('m_configs_info'));
		$this->load->view('configs/configs',$data);
	}

	function addConfigs(){
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$type=$_POST['type'];
		$result=$this->configs_model->isUnique($type,$code);
		if(!empty($result)){
			$query=$this->configs_model->getConfigss();
			$data['citylist']=$query;
			$this->common->loadHeader(lang('m_configs_info'));
			$this->load->view('configs/configs',$data);
		}
		else{
			if($code != '' && $name != ''){
				$this->configs_model->addConfigs ( $type,$code, $name );
				redirect('configs/configs');
			}
		}
	}

	function modifyConfigs(){
		$id = $_POST ['id'];
		$type = $_POST ['type'];
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$result=$this->configs_model->isUniqueForId($id,$code);
		if(!empty($result)){
			$data ['configsInfo'] = $this->configs_model->getConfigs( $id );
			$this->common->loadHeader(lang('v_man_configs_update'));
			$this->configs_model->modifyConfigs ($id,$type,$code, $name );
			redirect('configs/configs');
		}
		else{
			if($id!=''&&$code != '' && $name != ''){
				$this->configs_model->modifyConfigs ($id,$type,$code, $name );
				redirect('configs/configs');
			}
		}
	}

	function update($id){
		$data ['configsInfo'] = $this->configs_model->getConfigs( $id );
		$this->common->loadHeader(lang('v_man_configs_update'));
		$this->load->view ( 'configs/configsEdit', $data );
	}

	function delete($id)
	{
		
	}

}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */