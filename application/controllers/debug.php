<?php
class Debug extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper(array('form','url'));
		$this->load->model ( 'common' );
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Shanghai');
	}
	function index() {
		$this->common->loadHeader ("Debug");
		$this->load->view ( 'debug' );
	}

	function save(){
		$actionName=$_POST['actionName'];
		$content=$_POST['content'];

		echo $content;
	}
}