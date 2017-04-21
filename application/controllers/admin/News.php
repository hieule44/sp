<?php 
/**
 * 
 */
 class News extends MY_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('news_model');
 		$this->load->library('form_validation');
 		$this->load->library('upload_library');
 		$this->load->helper('form');
 		$this->load->library('pagination');
 	}
 	
 	//lay danh sach danh muc sp
 	function index()
 	{
 	
 		//lay so luong san pham
 		$total_rows = $this->news_model->get_total();
 		$this->data['total_rows'] = $total_rows;
 		//kho tao bien phan trang
 		$config = array();
 		$config['total_rows'] =$total_rows;//tong tat ca cac san pham
 		$config['base_url'] = admin_url('news/index');
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
 		$name = $this->input->get('title');
 		//$catalog = $this->input->get('catalog');

 		$id = intval($id);
 		//$catalog = intval($catalog); 		
 		$input['where'] = array();
 		if($id>0){
 			$input['where']['id'] = $id;
 		}
 		//if($catalog != ''){
 		//	$input['where']['catalog_id'] = $catalog;
 		//}
 		if($name){
 			$input['like'] = array('title',$name);
 		}

 		// lấy danh sách sản phẩm
 		$list = $this->news_model->get_list($input);
 		$this->data['list'] = $list;

 		//lay danh sách danh mục sản phẩm 		
 		
 		//lấy message từ flashdata
 		$message = $this->session->flashdata('message');
 		$this->data['message'] = $message;

 		$this->data['temp'] = 'admin/news/index';
 		$this->load->view('admin/main',$this->data);
 		
 	}

 	//them moi san pham
 	function add()
 	{
 		//neu co du lieu post thi kiem tra
 		if ($this->input->post()) 
 		{
 			
 			$this->form_validation->set_rules('title', 'Tiêu đề', 'required'); 
 			$this->form_validation->set_rules('intro', 'Intro', 'required'); 				

 			//nhập ok
 			if($this->form_validation->run())
 			{
 				$title 		= $this->input->post('title');
 				$intro 		= $this->input->post('intro');
 				$content 	= $this->input->post('content'); 				
 				$meta_desc	= $this->input->post('meta_desc');
 				$meta_key	= $this->input->post('meta_key'); 				

 				//lay ten file anh duoc upload len
 				$upload_path = './upload/news';
 				$upload_data = $this->upload_library->upload_file($upload_path,'image'); 								
 				$image_link = '';

 				if (isset($upload_data['file_name'])) 
 				{
 					$image_link = $upload_data['file_name'];
 				}
 				
 				//data insert
 				$data = array(
 					'title' 		=> $title,
 					'intro' 		=> $intro,
 					'content' 		=> $content,
 					'image_link' 	=> $image_link,
 					'meta_desc'		=> $meta_desc,
 					'meta_key'		=> $meta_key, 										
 					'created'		=> now()
 					);
 				if ($this->news_model->create($data)) {
 					$this->session->set_flashdata('message','Thêm mới thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Thêm không thành công');
 				}
 				redirect('admin/news');
 			}
 		}
 		
 		//load view add
 		$this->data['temp'] = 'admin/news/add';
 		$this->load->view('admin/main',$this->data);
 	} 

 	//ham edit
 	function edit()
 	{
 		//lay thong tin can tchinh sua
 		$id = $this->uri->rsegment('3');
 		$id = intval($id);
 		$news = $this->news_model->get_info($id);
 		//nếu không có thông tin thì redir trang chính
 		if (!$news) 
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại tin tức này !');
 			redirect(admin_url('news'));
 		}

 		//neu co du lieu post thi kiem tra
 		if ($this->input->post()) 
 		{
 			
 			$this->form_validation->set_rules('title', 'Tiêu đề', 'required');  					

 			//nhập ok
 			if($this->form_validation->run())
 			{
 				$title 		= $this->input->post('title');
 				$intro 		= $this->input->post('intro');
 				$content 	= $this->input->post('content'); 				
 				$meta_desc	= $this->input->post('meta_desc');
 				$meta_key	= $this->input->post('meta_key'); 

 				//lay ten file anh duoc upload len
 				$upload_path = './upload/news';
 				$upload_data = $this->upload_library->upload_file($upload_path,'image'); 								
 				$image_link = ''; 				
 				if (isset($upload_data['file_name'])) 
 				{
 					$image_link = $upload_data['file_name'];
 				}
 				//pre($upload_data);
 				//data insert
 				$data = array(
 					'title' 		=> $title,
 					'intro' 		=> $intro,
 					'content' 		=> $content,
 					'image_link' 	=> $image_link,
 					'meta_desc'		=> $meta_desc,
 					'meta_key'		=> $meta_key

 					);
 				//nếu không cập nhật ảnh thì giữ nguyên
 				if($image_link != '')
 				{
 					$data['image_link'] = $image_link;
 					//xoa anh da co
 					$image_link_exist = './upload/news/'.$news->image_link;
 					if (file_exists($image_link_exist)) 
 					{
 						unlink($image_link_exist);
 					}
 				} 				
 				if ($this->news_model->update($id,$data)) {
 					$this->session->set_flashdata('message','Cập nhật thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Cập nhật không thành công');
 				}
 				redirect('admin/news');
 			}
 		}
 		//lay danh sách danh mục sản phẩm
 		
 		//	
 		$this->data['news'] = $news;
 		//load view add
 		$this->data['temp'] = 'admin/news/edit';
 		$this->load->view('admin/main',$this->data);
 	}

 	function del()
 	{
 		// lay thong tin san pham theo id
 		$id = $this->uri->rsegment('3');
 		$this->_del($id); 		

 		$this->session->set_flashdata('message', 'Xóa thành công !');
 		redirect(admin_url('news'));
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
 		$news = $this->news_model->get_info($id);
 		if (!$news) {
 			$this->session->set_flashdata('message', 'Không tồn tại danh mục này !');
 			redirect(admin_url('news'));
 		}
 		//xoa sp
 		$this->news_model->delete($id);
 		// xoa cac anh sp sp
 		$image_link = './upload/news/'.$news->image_link;
 		if (file_exists($image_link)) {
 			unlink($image_link);
 		}
 		
 	}	

 }
 ?>