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
 		$this->load->library('form_validation');
 		$this->load->library('upload_library');
 		$this->load->helper('form');
 		$this->load->library('pagination');
 	}
 	
 	//lay danh sach danh muc sp
 	function index()
 	{
 	
 		//lay so luong san pham
 		$total_rows = $this->product_model->get_total();
 		$this->data['total_rows'] = $total_rows;
 		//kho tao bien phan trang
 		$config = array();
 		$config['total_rows'] =$total_rows;//tong tat ca cac san pham
 		$config['base_url'] = admin_url('product/index');
 		$config['per_page'] = 5;// so luong tren 1 trang
 		$config['uri_segment'] = 4;// phan doan hien thi ra so trang tren url
 		$config['next_link'] = "Trang kế tiếp";
 		$config['prev_link'] = "Trang trước";
 		$this->pagination->initialize($config);
 		
 		$segment = $this->uri->segment(4);
 		$segment = intval($segment);



 		$input = array();
 		$input['limit'] = array($config['per_page'],$segment);

 		//loc danh sach bang id,name,catalog
 		$id = $this->input->get('id');
 		$name = $this->input->get('name');
 		$catalog = $this->input->get('catalog');

 		$id = intval($id);
 		$catalog = intval($catalog); 		
 		$input['where'] = array();
 		if($id>0){
 			$input['where']['id'] = $id;
 		}
 		if($catalog != ''){
 			$input['where']['catalog_id'] = $catalog;
 		}
 		if($name){
 			$input['like'] = array('name',$name);
 		}

 		// lấy danh sách sản phẩm
 		$list = $this->product_model->get_list($input);
 		$this->data['list'] = $list;

 		//lay danh sách danh mục sản phẩm
 		$this->load->model('catalog_model');
 		$input = array();
 		$input['where'] = array('parent_id' => 0);
 		$catalogs = $this->catalog_model->get_list($input);
 		foreach ($catalogs as $rows) {
 			$input['where'] = array('parent_id' => $rows->id);
 			$subs = $this->catalog_model->get_list($input);
 			$rows->subs=$subs;
 		} 		
 		$this->data['catalogs'] = $catalogs;
 		
 		//lấy message từ flashdata
 		$message = $this->session->flashdata('message');
 		$this->data['message'] = $message;

 		$this->data['temp'] = 'admin/product/index';
 		$this->load->view('admin/main',$this->data);
 		
 	}

 	//them moi san pham
 	function add()
 	{
 		//neu co du lieu post thi kiem tra
 		if ($this->input->post()) 
 		{
 			
 			$this->form_validation->set_rules('name', 'Tên sản phẩm', 'required'); 
 			$this->form_validation->set_rules('catalog', 'Thể loại', 'required');
 			$this->form_validation->set_rules('price', 'Giá sản phẩm', 'required');			

 			//nhập ok
 			if($this->form_validation->run())
 			{
 				$name 		= $this->input->post('name');
 				$catalog_id = $this->input->post('catalog');
 				$price 		= $this->input->post('price');
 				$price 		= str_replace(',', '', $price);
 				$discount	= $this->input->post('discount');
 				$warranty	= $this->input->post('warranty');
 				$sale		= $this->input->post('sale');

 				//lay ten file anh duoc upload len
 				$upload_path = './upload/product';
 				$upload_data = $this->upload_library->upload_file($upload_path,'image');
 				$upload_datas = $this->upload_library->upload_files($upload_path,'image_list'); 				
 				$image_link = '';
 				$image_list = array();
 				$image_list = $upload_datas;
 				$image_list = json_encode($image_list);
 				if (isset($upload_data['file_name'])) 
 				{
 					$image_link = $upload_data['file_name'];
 				}
 				
 				//data insert
 				$data = array(
 					'name' 			=> $name,
 					'catalog_id' 	=> $catalog_id,
 					'price' 		=> $price,
 					'image_link' 	=> $image_link,
 					'image_list'	=> $image_list,
 					'discount'		=> $discount,
 					'warranty'		=> $warranty,
 					'gifts'			=> $sale,
 					'site_title'	=> $this->input->post('site_title'),
 					'meta_desc'		=> $this->input->post('meta_desc'),
 					'meta_key'		=> $this->input->post('meta_key'),
 					'content'		=> $this->input->post('content'),
 					'created'		=> now()
 					);
 				if ($this->product_model->create($data)) {
 					$this->session->set_flashdata('message','Thêm mới thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Thêm không thành công');
 				}
 				redirect('admin/product');
 			}
 		}
 		//lay danh sách danh mục sản phẩm
 		$this->load->model('catalog_model');
 		$input = array();
 		$input['where'] = array('parent_id' => 0);
 		$catalogs = $this->catalog_model->get_list($input);
 		foreach ($catalogs as $rows) {
 			$input['where'] = array('parent_id' => $rows->id);
 			$subs = $this->catalog_model->get_list($input);
 			$rows->subs=$subs;
 		} 		
 		$this->data['catalogs'] = $catalogs;
 		//load view add
 		$this->data['temp'] = 'admin/product/add';
 		$this->load->view('admin/main',$this->data);
 	} 

 	//ham edit
 	function edit()
 	{
 		//lay thong tin can tchinh sua
 		$id = $this->uri->rsegment('3');
 		$id = intval($id);
 		$product = $this->product_model->get_info($id);
 		//nếu không có thông tin thì redir trang chính
 		if (!$product) 
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại Admin này !');
 			redirect(admin_url('product'));
 		}

 		//neu co du lieu post thi kiem tra
 		if ($this->input->post()) 
 		{
 			
 			$this->form_validation->set_rules('name', 'Tên sản phẩm', 'required'); 
 			$this->form_validation->set_rules('catalog', 'Thể loại', 'required');
 			$this->form_validation->set_rules('price', 'Giá sản phẩm', 'required');			

 			//nhập ok
 			if($this->form_validation->run())
 			{
 				$name 		= $this->input->post('name');
 				$catalog_id = $this->input->post('catalog');
 				$price 		= $this->input->post('price');
 				$price 		= str_replace(',', '', $price);
 				$discount	= $this->input->post('discount');
 				$discount 		= str_replace(',', '', $discount);
 				$warranty	= $this->input->post('warranty');
 				$sale		= $this->input->post('sale');

 				//lay ten file anh duoc upload len
 				$upload_path = './upload/product';
 				$upload_data = $this->upload_library->upload_file($upload_path,'image');
 				$upload_datas = $this->upload_library->upload_files($upload_path,'image_list'); 				
 				$image_link = '';
 				$image_list = array();
 				$image_list = $upload_datas;
 				$image_list_js = json_encode($image_list);
 				if (isset($upload_data['file_name'])) 
 				{
 					$image_link = $upload_data['file_name'];
 				}
 				
 				//data insert
 				$data = array(
 					'name' 			=> $name,
 					'catalog_id' 	=> $catalog_id,
 					'price' 		=> $price, 					
 					'discount'		=> $discount,
 					'warranty'		=> $warranty,
 					'gifts'			=> $sale,
 					'site_title'	=> $this->input->post('site_title'),
 					'meta_desc'		=> $this->input->post('meta_desc'),
 					'meta_key'		=> $this->input->post('meta_key'),
 					'content'		=> $this->input->post('content')

 					);
 				//nếu không cập nhật ảnh thì giữ nguyên
 				if($image_link != '')
 				{
 					$data['image_link'] = $image_link;
 				}
 				if(!empty($image_list))
 				{
 					$data['image_list'] = $image_list_js;
 				}
 				if ($this->product_model->update($id,$data)) {
 					$this->session->set_flashdata('message','Cập nhật thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Cập nhật thành công');
 				}
 				redirect('admin/product');
 			}
 		}
 		//lay danh sách danh mục sản phẩm
 		$this->load->model('catalog_model');
 		$input = array();
 		$input['where'] = array('parent_id' => 0);
 		$catalogs = $this->catalog_model->get_list($input);
 		foreach ($catalogs as $rows) {
 			$input['where'] = array('parent_id' => $rows->id);
 			$subs = $this->catalog_model->get_list($input);
 			$rows->subs=$subs;
 		} 	
 		$this->data['catalogs'] = $catalogs;
 		//	
 		$this->data['product'] = $product;
 		//load view add
 		$this->data['temp'] = 'admin/product/edit';
 		$this->load->view('admin/main',$this->data);
 	}

 	function del()
 	{
 		// lay thong tin san pham theo id
 		$id = $this->uri->rsegment('3');
 		$this->_del($id); 		

 		$this->session->set_flashdata('message', 'Xóa thành công !');
 		redirect(admin_url('product'));
 	}

 	//xoa nhieu san pham
 	function del_all()
 	{
 		$ids = $this->input->post('ids');
 		foreach ($ids as $id) {
 			$this->_del($id);
 		}
 	}

 	private function _del($id)
 	{
 		$id = intval($id);
 		$product = $this->product_model->get_info($id);
 		if (!$product) {
 			$this->session->set_flashdata('message', 'Không tồn tại danh mục này !');
 			redirect(admin_url('product'));
 		}
 		//xoa sp
 		$this->product_model->delete($id);
 		// xoa cac anh sp sp
 		$image_link = './upload/product/'.$product->image_link;
 		if (file_exists($image_link)) {
 			unlink($image_link);
 		}
 		//xoa cac anh minh hoa
 		$image_list = json_decode($product->image_list);
 		if(is_array($image_list))
 		{
	 		foreach ($image_list as $img) {
	 			$image_links = './upload/product/'.$img;
 				if (file_exists($image_links)) 
 					{
 					unlink($image_links);
 					}
	 		}
 		}
 	}	

 }
 ?>