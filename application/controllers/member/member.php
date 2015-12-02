<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('manager/photo_model');
		$this->load->model('manager/member_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->member_model->getMemberList();
		$data['infolist']=$query;
		$this->common->loadHeader(lang('m_member_l'));
		$this->load->view('member/member_list',$data);
	}

	function add(){
		$this->common->loadHeader(lang('m_member_add'));
		$query=$this->category_model->getMemberType();
		$data['categorys']=$query;
		$this->load->view('member/member_add',$data);
	}

	//审批
	function approval(){
		$query=$this->member_model->getMemberList();
		$data['infolist']=$query;
		$this->common->loadHeader(lang('m_member_approval'));
		$this->load->view('member/member_approval',$data);
	}

	function approvalinfo($id){

		$this->common->loadHeader(lang('m_member_s'));
		$query=$this->category_model->getMemberType();
		$data['categorys']=$query;
		$member=$this->member_model->getMemberForID($id);
		if (isset($member)) {
			$data['mobile']=$member->mobile;
		}
		$this->load->view('member/member_add',$data);
	}

	//服务
	function service(){
		$query=$this->service_model->getServices();
		$data['infolist']=$query;
		$this->common->loadHeader(lang('m_member_s'));
		$this->load->view('member/member_service',$data);
	}

	function buycar(){
		$query=$this->member_model->getBuyCar();
		$data['infolist']=$query;
		$this->common->loadHeader(lang('m_buycar_s'));
		$this->load->view('member/buycar_list',$data);
	}
	function salecar(){
		$query=$this->member_model->getSaleCar();
		$data['infolist']=$query;
		$this->common->loadHeader(lang('m_salecar_s'));
		$this->load->view('member/salecar_list',$data);
	}

	function travel(){
		$query=$this->member_model->getTravel();
		$data['infolist']=$query;
		$this->common->loadHeader(lang('m_travel_s'));
		$this->load->view('member/travel_list',$data);
	}
	
	function queryinfo($id)
	{
		$this->common->loadHeader(lang('v_man_member_info'));
		$query=$this->category_model->getMemberType();
		$data['categorys']=$query;
		$member=$this->member_model->getMemberForID($id);
		if (isset($member)) {
			$data['mobile']=$member->mobile;
		}
		$info=$this->member_model->getMemberInfoForID($id);
		if (isset($info)) {
			$data['name']=$info->name;
			$data['sex']=$info->sex;
			$data['cardno']=$info->card_no;
			$data['email']=$info->email;
			$data['phone']=$info->phone;
			$data['address']=$info->address;
			$data['postcode']=$info->post_code;
			$data['card_validtime']=$info->card_validtime;
			$data['system_cardno']=$info->system_card_no;
			$data['driving_date']=$info->driving_yearly_verify_date	;
			$data['category']=$info->system_category;
		}
		$this->load->view('member/member_info',$data);
	}

	function carinfo($id)
	{
		$this->common->loadHeader(lang('v_man_member_carinfo'));
		$query=$this->category_model->getMemberType();
		$data['categorys']=$query;
		$member=$this->member_model->getMemberForID($id);
		if (isset($member)) {
			$data['id']=$member->id;
			$data['mobile']=$member->mobile;
		}
		$info=$this->member_model->getMemberInfoForID($id);
		if (isset($info)) {
			$data['name']=$info->name;
		}
		$data['colors']=$this->category_model->getCarColor()->result();
		$data['brands']=$this->category_model->getCarBrand()->result();
		$data['types']=$this->category_model->getCarType()->result();

		$query=$this->member_model->getCar($id);
		$data['infolist']=$query->result();
		$this->load->view('member/carview',$data);

	}
	function deletecar($id)
	{
		$this->member_model->deletecar($id);
		redirect('/member/member');
	}

	function addcar()
	{
		$memberid=$_POST['memberid'];
		$carno=$_POST['carno'];
		$carbrand=$_POST['carbrand'];
		$cartype =$_POST['cartype'];
		$carcolor=$_POST['carcolor'];
		$frameno=$_POST['frameno'];
		$engineno=$_POST['engineno'];
		$carregister=$_POST['carregister'];
		$caryearlydate=$_POST['caryearlydate'];

		$isUnique=$this->member_model->isUniqueCar($memberid,$carno);
		if(!empty($isUnique)){
			echo false;
		}
		else{
		if ($memberid != '' && $carno != '')
		{
			$this->member_model->addCar($memberid,$carno,$carbrand,$cartype,$carcolor,$frameno,$engineno,$carregister,$caryearlydate);
			echo true;
		}
		}
	}

	function saveInfo()
	{

		$this->form_validation->set_rules('mobile','登录名','trim|required');
		// $this->form_validation->set_rules('sex','性别','trim|required');
		$this->form_validation->set_rules('name','姓名','trim|required');
		$this->form_validation->set_rules('cardno','证件号码','trim|required');

		$this->form_validation->set_rules('phone','联系电话','trim|required');
		$this->form_validation->set_rules('address','联系地址','trim|required');
		$this->form_validation->set_rules('category','会员类型','trim|required');
		$this->form_validation->set_rules('driving_date','驾驶证年检日期','trim|required');
		if ($this->form_validation->run()) {
			$mobile=$this->input->post('mobile');
			$pass=$this->input->post('pass');
			$name=$this->input->post('name');
			$sex=$this->input->post('sex');
			$cardno=$this->input->post('cardno');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$address=$this->input->post('address');
			$postcode=$this->input->post('postcode');
			$category=$this->input->post('category');
			$system_cardno=$this->input->post('system_cardno');
			$card_vaildtime=$this->input->post('card_vaildtime');
			$driving_date=$this->input->post('driving_date');

			$this->member_model->saveMember($mobile,$pass);
			$id=1;
			$query=$this->member_model->getMember($mobile);
			if (isset($query)) {
				$id=$query->id;
			}
			$this->member_model->saveMemberInfo($id,$name,$sex,$cardno,$email,$phone,$address,$postcode,$system_cardno,$card_vaildtime,$driving_date,$category);
			$this->member_model->addCar($id,'','','','','','','','');
			
			redirect('member/member');
		}else{
			$this->data['mobile']=$this->input->post('mobile');
			$this->data['pass']=$this->input->post('pass');
			$this->data['name']=$this->input->post('name');
			$this->data['sex']=$this->input->post('sex');
			$this->data['cardno']=$this->input->post('cardno');
			$this->data['email']=$this->input->post('email');
			$this->data['phone']=$this->input->post('phone');
			$this->data['address']=$this->input->post('address');
			$this->data['postcode']=$this->input->post('postcode');
			$this->data['category']=$this->input->post('category');
			$this->data['system_cardno']=$this->input->post('system_cardno');
			$this->data['card_vaildtime']=$this->input->post('card_vaildtime');
			$this->data['driving_date']=$this->input->post('driving_date');
			$this->common->loadHeader(lang('m_member_add'));

			$query=$this->category_model->getMemberType();
			$this->data['categorys']=$query;
			$this->load->view('member/member_add',$this->data);
		}
		 // $this->output->enable_profiler(TRUE);
	}

}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */