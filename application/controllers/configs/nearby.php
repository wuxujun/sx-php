<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nearby  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('configs/city_model');
		$this->load->model('configs/nearby_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->nearby_model->getNearbys();
		$data['nearbylist']=$query;
		$data['provinces']=$this->city_model->getProvince();
		$this->common->loadHeader(lang('m_configs_nearby'));
		$this->load->view('configs/nearby',$data);
	}

	function addNearby(){
		$province=$_POST['province'];
		$cityId = $_POST ['cityId'];
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$pId = $_POST ['pId'];
		$type = $_POST ['type'];
		
		$result=$this->nearby_model->isUnique($code);
		if(!empty($result)){
			$query=$this->nearby_model->getNearbys();
			$data['edulist']=$query;
			$this->common->loadHeader(lang('m_configs_nearby'));
			$this->load->view('configs/nearby',$data);
		}
		else{
			if($cityId!='' &&$code != '' && $name != ''){
				$this->nearby_model->addNearby ($province,$cityId,$type,$pId,$code, $name);
				redirect('configs/nearby');
			}
		}
	}

	function modifyNearby(){
		$id = $_POST ['id'];
		$province=$_POST['province'];
		$cityId = $_POST ['cityId'];
		$name = $_POST ['name'];
		$type=$_POST['type'];
		$pId = $_POST ['pId'];
		if($id!=''&&$cityId != '' && $name != ''){
			$this->nearby_model->modifyNearby ($id,$province,$cityId,$type,$pId, $name );
			redirect('configs/nearby');
		}
	}

	function update($id){
		$data ['nearbyInfo'] = $this->nearby_model->getNearby( $id );
		$data['provinces']=$this->city_model->getProvince();
		$this->common->loadHeader(lang('v_man_nearby_update'));
		$this->load->view ( 'configs/nearbyEdit', $data );
	}

	function citySel($cid){
		$data=$this->city_model->getProvinceForCity($cid)->result();
		$str='';
		foreach ($data as $row) {
			$str.='<option value="'.$row->code.'">'.$row->title.'</option>';
		}
		echo $str;
	}
}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */