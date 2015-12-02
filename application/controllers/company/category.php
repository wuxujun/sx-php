<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category  extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->Model('common');
		$this->load->helper(array('form','url'));
		$this->load->model('company/category_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->category_model->getCategorys();
		$data['categorylist']=$query;
		$cate=$this->category_model->getParentCodes();
		$data['cates']=$cate;
		$this->common->loadHeader(lang('m_company_category'));
		$this->load->view('company/category',$data);
	}

	function addCategory(){
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$parentCode= $_POST ['parent_code'];
		$result=$this->category_model->isUnique($parentCode.$code);
		if(!empty($result)){
			redirect('company/category');
		}
		else{
			if($code != '' && $name != ''){
				$this->category_model->addCategory( $code, $name,$parentCode);
				redirect('company/category');
			}
		}
	}

	function modifyCategory(){
		$id=$_POST['id'];
		$code = $_POST ['code'];
		$name = $_POST ['name'];
		$parentCode= $_POST ['parent_code'];
		$this->category_model->modifyCategory($id,$code,$name,$parentCode);
		redirect('company/category');
	}

	function update($id){
		$cate=$this->category_model->getParentCodes();
		$data['cates']=$cate;
		$data ['categoryInfo'] = $this->category_model->getCategory( $id );
		$this->common->loadHeader(lang('v_man_category_edit'));
		$this->load->view ( 'company/categoryEdit', $data );
	}

	function delete($id)
	{
		
	}
}

/* End of file ad.php */
/* Location: ./application/controllers/ad.php */