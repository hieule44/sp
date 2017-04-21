<?php
	Class MY_Controller extends CI_Controller
	{
		public $data = array();

		function __construct()
		{
			// ke thu tu CI_Controller
			parent::__construct();

			$controller = $this->uri->segment(1);
			switch ($controller) {
				case 'admin':
				{
					// xu ly khi tru cap vao trang admin
					$this->load->helper('admin');
					$this->_check_login();
					break;
				}
				default:
				{	# code...
					$this->load->model('catalog_model');
					$input = array();
					$input['where'] = array('parent_id' => 0);
					$catalog_list = $this->catalog_model->get_list($input);
					foreach ($catalog_list as $row) {
						$input['where'] = array('parent_id' => $row->id);
						$subs = $this->catalog_model->get_list($input);
						$row->con = $subs;
					}
					$this->data['catalog_list'] = $catalog_list;
					//pre($catalog_list);
					// lay danh sach bai viet Moi
					$this->load->model('news_model');
					$input = array();
					$input['limit'] = array (0,5);
					$news_list = $this->news_model->get_list($input);
					//pre($news_list);
					$this->data['news_list'] = $news_list;
				}
			}
		}
		private function _check_login()
		{
			$controller = $this->uri->rsegment(1);
			$controller = strtolower($controller);

			$login = $this->session->userdata('login');
			//
			if(!$login && $controller != 'login')
			{
				redirect(admin_url('login'));
			}
			if($login && $controller == 'login')
			{
				redirect(admin_url('home'));
			}
		}
	}
 ?>
