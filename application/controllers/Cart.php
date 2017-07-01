<?php
/**
 *
 */
 class Cart extends MY_Controller
 {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('product_model');
 	}
  // chi tiet san pham
  function index()
  {
		$data = array();
		$input = array();

		$data['cart'] = $this->cart->contents();
		$data['temp'] = 'site/cart/cart';//view index home
		//pre($data['cart']);
		$this->load->view('site/layout', $data);
	}

  function add()
  {
    $data = array();
    $id = $this->uri->rsegment(3);
    $id = intval($id);
    // lay du lieu product
    $product = $this->product_model->get_info($id);
    if(!$product){
      redirect();
    }
    //dua vào data
    $price = $product->discount == 0 ? $product->price : $product->discount;// lay lai gia dung
    $data = array(
        'id'      => $product->id,
        'qty'     => 1,
        'price'   => $price,
        'name'    => $product->name
      );
    $this->cart->insert($data);
    redirect();
  }

  function update()
  {
    //
    //$id = $this->uri->rsegment(3);
    //$id = intval($id);
    // lay du lieu product
    $carts = $this->cart->contents();
    foreach($carts as $key => $row)
    {
      //lay so luong
      $qty = $this->input->post($row['id']);
      $data = array();
      $data['rowid']  = $key;
      $data['qty'] = $qty;
      $this->cart->update($data);
    }
    //chuyen ve cart/index
    redirect(cart_url('index'));

  }

  function del()
  {
    //
    $id = $this->uri->rsegment(3);
    $id = intval($id);
    $carts = $this->cart->contents();
    if($id > 0)//xóa 1 sp
    {
      foreach($carts as $key => $row)
      {
        //lay so luong
        if($row['id'] == $id)
        {
          $data = array();
          $data['rowid']  = $key;
          $data['qty'] = 0;
          $this->cart->update($data);
        }
      }
    }else //xóa toàn bộ
    {
      foreach($carts as $key => $row)
      {
        //lay so luong
        $data = array();
        $data['rowid']  = $key;
        $data['qty'] = 0;
        $this->cart->update($data);
      }
    }
    redirect(cart_url('index'));

  }

 }
 ?>
