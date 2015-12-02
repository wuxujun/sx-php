<?php
class Upload extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper(array('form','url'));
		$this->load->model ( 'common' );
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Shanghai');
		$this->load->helper('url');
		$this->load->model('manager/photo_model');
	}
	function index() {
		try{
			$filename=$this->photo_model->doUpload('file');
			$imgfiles=explode('.', $filename);
			$imgfile="0";
			if (count($imgfiles)>1) {
				$imgfile=$filename;
			}
			$data['fileName']=$imgfile;
		}catch(Exception $e){
			
		}
		$this->load->view('upload',$data);
	}

}