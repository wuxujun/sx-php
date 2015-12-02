<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Floor  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('mall/floor_model');
		$this->load->model('mall/mall_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->floor_model->getFloors();
		$data['infolist']=$query;

		$queryMall=$this->mall_model->getMallCodes();
		$data['malls']=$queryMall;
		$this->common->loadHeader(lang('v_man_floorInfo'));
		$this->load->view('mall/floor',$data);
	}

	function update($id){
		$this->common->loadHeader(lang('v_man_floor_update'));
		$query=$this->mall_model->getMallCodes();
		$data['malls']=$query;
		$queryInfo=$this->floor_model->getFloor($id);
		$data['floorInfo']=$queryInfo;
		$this->load->view('mall/floorEdit',$data);
	}

	function addFloor()
	{
		
		$name=$_POST ['name'];
		$mid=$_POST ['mid'];
		$content=$_POST ['content'];
		$image=$_POST['image'];		
		if($name != '' && $mid != ''){
			$this->floor_model->addFloor( $mid, $name,$image,$content);
			redirect('mall/floor');
		}
	}
	function modifyFloor()
	{
		$id=$_POST['id'];
		$name=$_POST ['name'];
		$mid=$_POST ['mid'];
		$image=$_POST['image'];
		$content=$_POST ['content'];		
		if($id!=''&&$name != '' && $mid != ''){
			$this->floor_model->modifyFloor($id,$mid,$name,$image,$content);
			redirect('mall/floor');
		}
	}
	

}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */