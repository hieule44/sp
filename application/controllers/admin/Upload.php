<?php 
/**
* 
*/
class Upload extends MY_Controller
{
	
	function index()
	{
		if ($this->input->post('submit'))
		{
			$this->load->library('upload_library');
			$upload_path = './upload/user';
			$data = $this->upload_library->upload_file($upload_path,'image');	
			pre($data);
		}
		$this->data['temp'] = 'admin/upload/index';
		$this->load->view('admin/main', $this->data);
	}

	function upload_file()
	{
		if ($this->input->post('submit'))
		{
			$this->load->library('upload_library');
			$upload_path = './upload/user';
			$data = $this->upload_library->upload_files($upload_path,'image_list');	
			pre($data);
		}
		$this->data['temp'] = 'admin/upload/upload_list';
		$this->load->view('admin/main', $this->data);
	}
}
 ?>