<?php
/**
*
*/
class Product_model extends MY_Model
{
	var $table = 'product';

	function call_product_full_info($id){
		$rows = $this->db->query("call select_product_full_info('$id')");
		$data = $rows->row();
		$rows->free_result();
		return $data;
	}

	function call_product_same_full_info($id){
		$rows = $this->db->query("call select_product_same_full_info(''$id')");
		$data = $rows->row();
		$rows->free_result();
		return $data;
	}
}
 ?>
