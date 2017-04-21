<?php 
/**
 * 
 */
 class Catalog extends MY_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('catalog_model');
 		$this->load->library('form_validation');
 		$this->load->helper('form');
 	}
 	
 	//lay danh sach danh muc sp
 	function index()
 	{
 		$message = $this->session->flashdata('message');
 		$this->data['message'] = $message;

 		$list = $this->catalog_model->get_list();
 		$this->data['list'] = $list;
 		
 		$total = $this->catalog_model->get_total();
 		$this->data['total'] = $total;
 		//load ra view
 		$this->data['temp'] = 'admin/catalog/index';
 		$this->load->view('admin/main',$this->data);
 		
 	}

 	//them moi du lieu
 	function add()
 	{	

 		//neu co du lieu post thi kiem tra
 		if ($this->input->post()) {
 			# code...
 			$this->form_validation->set_rules('name', 'Tên danh mục', 'required'); 				

 			//nhập ok
 			if($this->form_validation->run())
 			{
 				$name = $this->input->post('name');
 				$parent_id = $this->input->post('parent_id');
 				$sort_order = $this->input->post('sort_order');
 				//data insert
 				$data = array(
 					'name' 		=> $name,
 					'parent_id' 	=> $parent_id,
 					'sort_order' 	=> $sort_order
 					);
 				if ($this->catalog_model->create($data)) {
 					$this->session->set_flashdata('message','Thêm mới thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Thêm không thành công');
 				}
 				redirect('admin/catalog');
 			}
 		}
 			//lấy danh mục cha
 			$input = array();
 			$input['where'] = array('parent_id'=>0);
 			$list = $this->catalog_model->get_list($input);
 			$this->data['list'] = $list;
 			$this->data['temp'] = 'admin/catalog/add';
			$this->load->view('admin/main',$this->data);
 	}
 	//ham chinh sua
 	function edit()
 	{
 		//lấy thông tin cần cập nhật từ id
 		$id = $this->uri->rsegment('3');
 		$id = intval($id);
 		$info = $this->catalog_model->get_info($id);
 		if (!$info) 
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại Admin này !');
 			redirect(admin_url('catalog'));
 		}
 		//neu co du lieu post thi kiem tra
 		if ($this->input->post()) 
 		{
 			# code...
 			$this->form_validation->set_rules('name', 'Tên danh mục', 'required'); 				

 			//nhập ok
 			if($this->form_validation->run())
 			{
 				$name = $this->input->post('name');
 				$parent_id = $this->input->post('parent_id');
 				$sort_order = $this->input->post('sort_order');
 				//data insert
 				$data = array(
 					'name' 		=> $name,
 					'parent_id' 	=> $parent_id,
 					'sort_order' 	=> $sort_order
 					);
 				if ($this->catalog_model->update($id,$data)) {
 					$this->session->set_flashdata('message','Cập nhật thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Cập nhật không thành công');
 				}
 				redirect('admin/catalog');
 			}
 		}
 			
 			//lấy danh mục cha
 			$input = array();
 			$input['where'] = array('parent_id'=>0);
 			$list = $this->catalog_model->get_list($input);

 			$this->data['list'] = $list;
 			$this->data['info'] = $info;
 			$this->data['temp'] = 'admin/catalog/edit';
			$this->load->view('admin/main',$this->data);

 	}

 	//ham xoa du lieu
 	function del()
 	{
 		
 		$id = $this->uri->rsegment('3');
 		$this->_del($id);
 		$this->session->set_flashdata('message', 'Xóa thành công !');
 		redirect(admin_url('catalog'));
 		
 	}

 	function del_all()
 	{
 		$ids = $this->input->post('ids');
 		foreach ($ids as $id) {
 			$this->_del($id,false);
 		}
 	}

 	private function _del($id, $re = true)
 	{
 		$id = intval($id);
 		$info = $this->catalog_model->get_info($id);
 		if (!$info) {
 			$this->session->set_flashdata('message', 'Không tồn tại danh mục này !');
 			if ($re) {
 				redirect(admin_url('catalog'));
 			}else
 			{
 				return false;
 			}
 			
 		}
 		//kiem tra danh muc co sp khong
 		$this->load->model('product_model');
 		$product = $this->product_model->get_info_rule(array('catalog_id' => $id),'id');
 		if ($product) {
 			$this->session->set_flashdata('message', 'Danh mục '.$info->name.' có chứa sản phẩm, cần xóa sản phẩm trước !');
 			if ($re) {
 			redirect(admin_url('catalog'));
 			}else
 			{
 				return false;
 			}
 		}
 		//xoa danh muc
 		$this->catalog_model->delete($id);
 	}

 }
 ?>