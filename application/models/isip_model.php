<?php
class Isip_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();

		$this->load->helper('date');
		date_default_timezone_set('Asia/Shanghai');
	}

	function save($content){

		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array(
			'nationality' => $content[1],
			'cityname'=>$content[2],
			'name'=>$content[3],
			'enname'=>$content[4],
			'gender'=>$content[5],
			'birthday'=>$content[6],
			'mobile'=>substr($content[7],0,strpos($content[7],'^')),
			'email'=>substr(strrchr($content[7],'^'),1),
			'address'=>$content[8],
			'university'=>$content[9],
			'major'=>$content[10],
			'grade'=>$content[11],
			'graduate_year'=>$content[12],
			'future_plan'=>$content[13],
			'following_ability'=>$content[14],
			'know_program'=>$content[15],
			'project_time'=>$content[16],
			'call_interview'=>$content[17],
			'group_interview'=>$content[18],
			'imitate_test'=>$content[19],
			'group_interview_sh'=>$content[20],
			'imitate_test_sh'=>$content[21],
			'party_time_sh'=>$content[22],
			'resume_file'=>$content[23],
			'photo_file'=>$content[24],
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('investigation',$arrayName);
	}



}

