<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('configs/city_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->city_model->getCitys();
		$data['citylist']=$query;
		$this->common->loadHeader(lang('m_configs_city'));
		$this->load->view('configs/city',$data);
	}

	function addCity(){
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$result=$this->city_model->isUnique($code);
		if(!empty($result)){
			$query=$this->city_model->getCitys();
			$data['citylist']=$query;
			$this->common->loadHeader(lang('m_configs_city'));
			$this->load->view('configs/city',$data);
		}
		else{
			if($code != '' && $name != ''){
				$this->city_model->addCity ( $code, $name );
				redirect('configs/city');
			}
		}
	}

	function modifyCity(){
		$id = $_POST ['id'];
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$result=$this->city_model->isUniqueForId($id,$code);
		if(!empty($result)){
			$data ['cityInfo'] = $this->city_model->getCity( $id );
			$this->common->loadHeader(lang('v_man_city_edit'));
			$this->load->view ( 'configs/cityEdit', $data );
		}
		else{
			if($id!=''&&$code != '' && $name != ''){
				$this->city_model->modifyCity ($id,$code, $name );
				redirect('configs/city');
			}
		}
	}

	function update($id){
		$data ['cityInfo'] = $this->city_model->getCity( $id );
		$this->common->loadHeader(lang('v_man_city_update'));
		$this->load->view ( 'configs/cityEdit', $data );
	}

	function delete($id)
	{
		
	}

}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */