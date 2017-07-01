<?php
	$this->load->view('site/slide', $this->data);
?>
<div class="box-center"><!-- The box-center product-->
  <div class="tittle-box-center">
		<h2>Sản phẩm mới</h2>
	</div>
	<div class="box-content-center product"><!-- The box-content-center -->
	<!-- begin 1 san pham -->
		<?php foreach ($product_list as $sp):?>
		   <div class='product_item'>
	        <h3>
	          <a  href="" title="<?php echo $sp->name; ?>"><?php echo $sp->name; ?></a>
		      </h3>
	        <div class='product_img'>
	          <a  href="<?php echo product_url('view/'.$sp->id.'/'.urlencode($sp->name)) ?>" title="Sản phẩm">
	          	<img src="<?php echo_product_iamge_upload($sp->image_link)?>" alt=''/>
	          </a>
	        </div>
						<?php if($sp->discount > 0){ ?>
	        <p class='price'><?php number_fm_vnd($sp->discount); ?>
						<?php }else{?>
					<p class='price'><?php number_fm_vnd($sp->price); ?>
						<?php } ?>
						<?php if($sp->discount > 0){ ?>
						<span class='price_old'><?php number_fm_vnd($sp->price); ?></span>
						<?php } ?>
					</p>
	        <center>
	        	<div class='raty' style='margin:10px 0px' id='9' data-score='5'></div>
	        </center>
	        <div class='action'>
	          <p style='float:left;margin-left:10px'>Lượt xem: <b><?php echo $sp->view; ?></b></p>
		        <a class='button' href="<?php echo product_url('view/'.$sp->id.'/'.urlencode($sp->name)) ?>" title='Xem'>Xem chi tiết</a>
		        <div class='clear'></div>
	        </div>
        </div>
				<?php endforeach; ?>
				<div class='clear'></div>
					<!-- end 1 san pham -->
	</div><!-- End box-content-center -->
</div>	<!-- End box-center product-->
