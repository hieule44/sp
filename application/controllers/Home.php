<?php
Class Home extends MY_Controller
{
	function index(){
		// load du lieu
		$this->load->model('slide_model');// load sile
		$this->load->model('Product_model');// load san pham
		// get du lieu vao bien
		$data = array();
		$input = array();
		$slide_list   = $this->slide_model->get_list();// get du lieu slile
		// lay SP moi
		$input['limit'] = array('3','0');
		$input['order'] = array('id','desc');
		$product_list = $this->Product_model->get_list($input);
		// trueyn vao bien data
		$data['slide_list'] = $slide_list;//data slide
		$data['product_list'] = $product_list;
		$data['temp'] = 'site/home/index';//view index home
		// load -> view
		//print_r($product_list);
		$this->load->view('site/layout', $data);
		//$this->load->view('site/demo');// an tam thoi
	}

	function product(){
		$this->load->model('product_model');// load san pham
		$data = array();
		$input = array();
		// lay di truyen vao
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$product = $this->product_model->call_product_full_info($id);
		$data['product'] = $product;

		$data['temp'] = 'site/product/product';//view index home
		//pre($data);
		$this->load->view('site/layout', $data);
	}
}
?>
