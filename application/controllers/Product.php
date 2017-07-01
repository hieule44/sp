<?php
/**
 *
 */
 class Product extends MY_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('product_model');
 	}
  // chi tiet san pham
  function view(){
		$data = array();
		$input = array();
		// lay di truyen vao
		$id = $this->uri->rsegment('3');
		$id = intval($id);
		$product 			= $this->product_model->call_product_full_info($id);
		//$product_same = $this->product_model->call_product_same_full_info($id);
    if(!$product){
      redirect();
    }
		$data['product'] = $product;
    $image_list = @json_decode($product->image_list);
		$data['image_list'] = $image_list;
		$data['temp'] = 'site/product/product';//view index home
		//pre($data['image_list']);
		$this->load->view('site/layout', $data);
	}

  function catalog(){
    $input = array();
    $data  = array();
    //lay id tren url
    $id = $this->uri->rsegment('3');
		$id = intval($id);
    //lay ra danh muc catalog
    $this->load->model('catalog_model');
    $catalog = $this->catalog_model->get_info($id);
    if(!$catalog){
      redirect();
    }
    $data['catalog'] = $catalog; //lay data catalog
    //kiem tra catalog la danh muc Cha

    if($catalog->parent_id == 0){
      $input_ca = array();
      $input_ca['where'] = array('parent_id' => $id);
      $catalog_subs = $this->catalog_model->get_list($input_ca);
      if(!empty($catalog_subs)){//neu danh muc hien tai co danh muc con
        $catalog_subs_id = array();
        foreach ($catalog_subs as $sub) {
          $catalog_subs_id[] = $sub->id;
        }
        $input['where_in'] = array('catalog_id',$catalog_subs_id);
      }else{
        $input['where'] = array('catalog_id' => $id);
      }
    }else{
      $input['where'] = array('catalog_id' => $id);
    }
    //lay so luong san pham
 		$total_rows = $this->product_model->get_total($input);
 		$this->data['total_rows'] = $total_rows;
 		//kho tao bien phan trang
    $this->load->library('pagination');
 		$config = array();
 		$config['total_rows'] =$total_rows;//tong tat ca cac san pham
 		$config['base_url'] = base_url('product/catalog/'.$id);
 		$config['per_page'] = 15;// so luong tren 1 trang
 		$config['uri_segment'] = 4;// phan doan hien thi ra so trang tren url
 		$config['next_link'] = "Trang kế tiếp";
 		$config['prev_link'] = "Trang trước";
 		$this->pagination->initialize($config);
 		$segment = $this->uri->segment(4);
 		$segment = intval($segment);
 		$input['limit'] = array($config['per_page'],$segment);

    // lấy danh sách sản phẩm
 		$list = $this->product_model->get_list($input);
 		$data['list'] = $list;//danh sach san pham
    $data['temp'] = 'site/product/catalog';
    $this->load->view('site/layout', $data);
  }

 }
 ?>
