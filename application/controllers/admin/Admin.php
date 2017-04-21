<?php 
/**
 * 
 */
 class Admin extends MY_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin_model');
 	}
 	// kiem tra usernmae ton tai
 	function check_username()
 	{
 		$username = $this->input->post('username');
 		$where = array('username' => $username);

 		//kiem tra
 		if($this->admin_model->check_exists($where))
 		{
 			$this->form_validation->set_message(__FUNCTION__,'Tài khoản đã tồn tại');
 			return false;
 		}
 		return true;
 	}
 	
 	//lay danh sach ad
 	function index()
 	{
 		$input = array();
 		$list = $this->admin_model->get_list($input);
 		$this->data['list'] = $list;

 		$total = $this->admin_model->get_total();
 		$this->data['total'] = $total;
 		$this->data['temp'] = 'admin/admin/index';

 		//lấy message từ flashdata
 		$message = $this->session->flashdata('message');
 		$this->data['message'] = $message;
		$this->load->view('admin/main',$this->data);
 	}
 	//them mới ad
 	function add()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//neu co du lieu post thi kiem tra
 		if ($this->input->post()) {
 			# code...
 			$this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
 			$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
 			$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
 			$this->form_validation->set_rules('repassword', 'Mật khẩu nhập lại', 'matches[password]');

 			//nhập ok
 			if($this->form_validation->run())
 			{
 				$name = $this->input->post('name');
 				$username = $this->input->post('username');
 				$password = $this->input->post('password');
 				$data = array(
 					'name' 		=> $name,
 					'username' 	=> $username,
 					'password' 	=> md5($password)
 					);
 				if ($this->admin_model->create($data)) {
 					$this->session->set_flashdata('message','Thêm mới thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Thêm không thành công');
 				}
 				redirect('admin/admin');
 			}
 		}

 		$this->data['temp'] = 'admin/admin/add';
		$this->load->view('admin/main',$this->data);
 	}
 	//cập nhật
 	function edit()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		$id = $this->uri->rsegment('3');
 		$id = intval($id);
 		$info = $this->admin_model->get_info($id);
 		if (!$info) {
 			$this->session->set_flashdata('message', 'Không tồn tại Admin này !');
 			redirect(admin_url('admin'));
 		}
 		//nếu post du lieu thi thuc hien update
 		if ($this->input->post()) 
 		{ 			
 			$this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
 			if($this->input->post('username') == $info->username)
 			{
 				$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required');
 			}else
 			{
 				$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');	
 			}
 			$password = $this->input->post('password');
 			//kiem tra pass neu rong moi set dk
 			if($password)
 			{
 			$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
 			$this->form_validation->set_rules('repassword', 'Mật khẩu nhập lại', 'matches[password]');
 			}
 			//kiem tra neu validate ok thi update
 			if($this->form_validation->run())
 			{
 				$name = $this->input->post('name');
 				$username = $this->input->post('username'); 				
 				$data = array(
 					'name' 		=> $name,
 					'username' 	=> $username
 					);
 				if($password){
 					$data['password'] = md5($password);
 				}
 				if ($this->admin_model->update($id,$data)) {
 					$this->session->set_flashdata('message','Cập nhật thành công');
 				}else 
 				{
 					$this->session->set_flashdata('message','Cập nhật không thành công');
 				}
 				redirect(admin_url('admin'));
 			}
 		}	

 		$this->data['info'] = $info;
 		$this->data['temp'] = 'admin/admin/edit';
 		$this->load->view('admin/main',$this->data);
 		
 	}
 	//xoa ad
 	function delete()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		$id = $this->uri->rsegment('3');
 		$id = intval($id);
 		$info = $this->admin_model->get_info($id);
 		if (!$info) {
 			$this->session->set_flashdata('message', 'Không tồn tại Admin này !');
 			redirect(admin_url('admin'));
 		}
 		$this->admin_model->delete($id);
 		$this->session->set_flashdata('message', 'Xóa thành công !');
 		redirect(admin_url('admin'));
 		
 	}

 	function logout()
 	{
 		if($this->session->userdata('login'))
 		{
 			$this->session->unset_userdata('login');
 		}
 		redirect(admin_url('login'));
 	}

 	
 } 
 ?>