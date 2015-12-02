<?php
class Version_model extends CI_Model
{

	function __construct()
	{
		$this->load->database();
	}


	function getVersion($platform){
		$sql="select *  from `T_version` where state=0 and platform=".$platform;
		$query=$this->db->query($sql);
		if ($query!=null&&$query->num_rows()>0) {
			return $query->first_row();
		}
	}

	function save($dataType,$title,$desc){

		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		
		$arrayName = array('title' => $title,
			'data_type'=>$dataType,
			'content'=>$desc,
			'addtime'=>date('Y-m-d H:i:s')
		 );
		$this->db->insert('app_info',$arrayName);
	}
}

