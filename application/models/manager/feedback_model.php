<?php
class Feedback_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function getInfos()
	{
		$sql="select *  from T_feedback ";
		$query=$this->db->query($sql);
		return $query;
	}

	function save($content){

		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('mobile' => $content->mobile,
			'remark'=>$content->remark,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('feedback',$arrayName);
	}
}

