<?php
function public_url($url=''){
	return base_url('public/'.$url);
}

function home_url($url=''){
	return base_url('home/'.$url);
}

function pre($list, $exit = true)
{
	echo '<pre>';
 	print_r($list);
 	if($exit){
 		die();
 	}
}

function echo_product_iamge_upload($value){
	if (strlen($value) > 0 ){
		echo base_url('upload/product/'.$value);
	}else{
		echo base_url('upload/no-image.png');
	}
}

function number_fm_vnd($value){
	$value = number_format($value).' đ';
	echo $value;
}
?>
