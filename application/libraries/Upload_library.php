<?php 
/**
* 
*/
class Upload_library
{
	var $CI = '';
	
	function __construct()
	{
		$this->CI =& get_instance();
	}

	function upload_file($upload_path = '', $file_name = '')
	{
		$config = $this->config($upload_path);
		$this->CI->load->library('upload', $config);
		//thuc hien upload	
		if ($this->CI->upload->do_upload($file_name))
			{
				//upload thanh cong
				$data = $this->CI->upload->data();
				
			}
		else
			{	//uo load khong thanh cong
				$data = $this->CI->upload->display_errors();
				
			}
		return $data;	

	}
	function upload_files($upload_path = '', $file_name = '')
	{
		$config = $this->config($upload_path);
		$this->CI->load->library('upload', $config);

		$file = $_FILES[$file_name];
		$count = count($file['name']);
		$image_list = array();//luu ten cac file anh upload thanh cong
		for ($i=0; $i<=$count-1 ; $i++) { 
			$_FILES['userfile']['name'] 	= $file['name'][$i];
			$_FILES['userfile']['type'] 	= $file['type'][$i];
			$_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
			$_FILES['userfile']['error'] 	= $file['error'][$i];
			$_FILES['userfile']['size'] 	= $file['size'][$i];

			if ($this->CI->upload->do_upload()) {

				$data = $this->CI->upload->data();
				$image_list[] = $data['file_name'];
			}
		}
		return $image_list;

	}

	function config($upload_path = '')
	{
		//khai bao bien cau hinh upload
			$config = array();
			//thu muc chua
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '5000';
			$config['max_width']  = '5024';
			$config['max_height']  = '5024';
			$config['max_filename']  = '255';

			return $config;
	}
}
 ?>