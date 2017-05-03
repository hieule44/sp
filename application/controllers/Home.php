<?php
Class Home extends MY_Controller
{
	function index(){
		$this->load->model('slide_model');// load sile
		$slide_list = $this->slide_model->get_list();// get du lieu slile
		$data = array();
		$data['slide_list'] = $slide_list;//data slide
		$data['temp'] = 'site/home/index';//view index home
		$this->load->view('site/layout', $data);
		//$this->load->view('site/demo');// an tam thoi
	}
}
?>
