<?php
class Isip extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper(array('form','url'));
		$this->load->model ( 'common' );
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Shanghai');
		$this->load->helper('url');
		$this->load->model('isip_model');
	}

	// function MyFormat($str,$isArray = false){
	// 	$rule = '/(?:([^\$\}]+)\$([^\$\}]*))\}?/';
	// 	$groups = array();
	// 	$isSuccess = preg_match_all($rule,$str,$groups);
	// 	if(!isSuccess){
	// 		return false;
	// 	}
	// 	$res = array();
	// 	$groups_keys = $groups[1];
	// 	$groups_values = $groups[2];
	// 	foreach($groups_keys as $key =>$val){
	// 		$res[$val] = $groups_values[$key];
	// 	}
	// 	if(!$isArray){
	// 		$res = (object)$res;
	// 	}
	// 	return $res;
	// }

	function index() {
		$submitdata=$_POST["submitdata"];
		$rule = '/(?:([^\$\}]+)\$([^\$\}]*))\}?/';
		$groups = array();
		$isSuccess = preg_match_all($rule,$submitdata,$groups);
		if(!$isSuccess){
			echo "0〒1";
		}else{
			$res = array();
			$groups_keys = $groups[1];
			$groups_values = $groups[2];
			foreach($groups_keys as $key =>$val){
				$res[$val] = $groups_values[$key];
			}
			//var_dump($res);
			//echo substr($res[7],0,strpos($res[7],'^'));
			$this->isip_model->save($res);
			echo "1〒1";
		}
	}
}