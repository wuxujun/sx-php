<?php
class Push_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getPushs(){
		$sql="select *  from T_push_msg ";
		$query=$this->db->query($sql);
		return $query;
	}

	function save($content){

		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('title' => $content['title'],
			'member'=>$content['member'],
			'uuid'=>$content['uuid'],
			'content'=>$content['desc'],
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('push_msg',$arrayName);
	}



}

