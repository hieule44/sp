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
?>
