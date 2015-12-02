<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model
{
	var  $photo_path;
	var  $photo_path_url;

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('date');
		$this->photo_path=realpath(APPPATH.'../images');
		$this->photo_path_url=base_url().'images/';
	
		date_default_timezone_set('Asia/Shanghai');
	}

	public function do_upload()
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$filename=date('YmdHim',$timezonestimestamp).'_'.sprintf('%04d',rand(0,9999));
		$config=array(
			'allowed_types' =>'jpg|jpeg|gif|png' ,
			'upload_path'=>$this->photo_path,
			'file_name'=>$filename,
			'max_size'=>20000 
		);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		$images_data=$this->upload->data();
		$config = array(
			'source_image' =>$images_data['full_path'],
			'new_image'=>$this->photo_path.'/thumbs',
			'maintain_ration'=>true,
			'width'=>150,
			'height'=>100 
		);
		$this->load->library('image_lib',$config);
		$this->image_lib->resize();
		return $images_data['file_name'];
	}

	public function doUpload($fileid)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$filename=date('YmdHim',$timezonestimestamp).'_'.sprintf('%04d',rand(0,9999));
		$config=array(
			'allowed_types' =>'jpg|jpeg|gif|png' ,
			'upload_path'=>$this->photo_path,
			'file_name'=>$filename,
			'max_size'=>2000 
		);
		$this->load->library('upload',$config);
		$this->upload->do_upload($fileid);
		$images_data=$this->upload->data();
		$config = array(
			'source_image' =>$images_data['full_path'],
			'new_image'=>$this->photo_path.'/thumbs',
			'maintain_ration'=>true,
			'width'=>150,
			'height'=>100 
		);
		$this->load->library('image_lib',$config);
		$this->image_lib->resize();
		return $images_data['file_name'];
	}


	public function doUploadPdf($fileid)
	{
		$timezonestimestamp = gmt_to_local(local_to_gmt(), $this->config->item('timezones'));
		$filename=date('YmdHim',$timezonestimestamp).'_'.sprintf('%04d',rand(0,9999));
		$config=array(
			'allowed_types' =>'pdf' ,
			'upload_path'=>$this->photo_path,
			'file_name'=>$filename,
			'max_size'=>200000000 
		);
		$this->load->library('upload',$config);
		$this->upload->do_upload($fileid);
		$images_data=$this->upload->data();
		var_dump($images_data);
		return $images_data['file_name'];
	}

	function get_images()
	{
		$files=scandir($this->photo_path);
		$files=array_diff($files, array('.','..','thumbs'));
		$images=array();
		foreach ($files as $file) {
			$images[]=array(
				'url' =>$this->photo_path_url.$file ,
			 	'thumb_url'=>$this->photo_path_url.'thumbs/'.$file
			 );
		}
		require $images;
	}
}