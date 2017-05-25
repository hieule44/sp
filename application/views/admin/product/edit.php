<?php $this->load->view('admin/product/head',$this->data); ?>
<div class="wrapper">
<script type="text/javascript">

</script>
	   	<!-- Form -->
<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
	<fieldset>
		<div class="widget">
			<div class="title">
				<img src="<?php echo public_url('admin')?>/images/icons/dark/add.png" class="titleIcon">
				<h6>Cập nhật Sản phẩm</h6>
			</div>

			<ul class="tabs">
		        <li><a href="#tab1">Thông tin chung</a></li>
		        <li><a href="#tab2">SEO Onpage</a></li>
		        <li><a href="#tab3">Bài viết</a></li>
			</ul>
			<div class="tab_container">
<!-- Tab 1 -->
				<div id="tab1" class="tab_content pd0">
					<div class="formRow">
						<label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
						<div class="formRight">
							<span class="oneTwo"><input name="name" value="<?php echo $product->name ?>" id="param_name" _autocheck="true" type="text"></span>
							<span name="name_autocheck" class="autocheck"></span>
							<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
						<div class="formRight">
							<div class="left">
								<input type="file" id="image" name="image">
								<img src="<?php echo base_url('upload/product/'.$product->image_link)?>" style="width: 100px;height: 70px">
							</div>
							<div name="image_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>
					<?php $image_list = json_decode($product->image_list) ?>
					<div class="formRow">
						<label class="formLeft">Ảnh kèm theo:</label>
						<div class="formRight">
							<div class="left">
								<input type="file" id="image_list" name="image_list[]" multiple="">
							<?php if(count($image_list) > 0): ?>
								<?php foreach($image_list as $img): ?>
									<img src="<?php echo base_url('upload/product/'.$img)?>" style="width: 100px;height: 70px;margin: 5px;">
								<?php endforeach ?>
							<?php endif; ?>
							</div>
							<div name="image_list_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>


					<div class="formRow">
						<label class="formLeft" for="param_price">Giá :<span class="req">*</span>
						</label>
						<div class="formRight">
							<span class="oneTwo">
								<input name="price" value="<?php echo $product->price ?>" style="width:100px" id="param_price" class="format_number" _autocheck="true" type="text">
								<img class="tipS" title="Giá bán sử dụng để giao dịch" style="margin-bottom:-8px" src="<?php echo public_url('admin')?>/crown/images/icons/notifications/information.png">
							</span>
							<span name="price_autocheck" class="autocheck"></span>
							<div name="price_error" class="clear error"><?php echo form_error('price') ?></div>
						</div>
						<div class="clear"></div>
					</div>

<!-- Price -->
					<div class="formRow">
						<label class="formLeft" for="param_discount">Giá khuyến mãi<span></span>:
						</label>
						<div class="formRight">
							<span>
								<input name="discount" value="<?php echo $product->discount ?>" style="width:100px" id="param_discount" class="format_number" type="text">
								<img class="tipS" title="Giá bán khuyến mãi" style="margin-bottom:-8px" src="<?php echo public_url('admin')?>/crown/images/icons/notifications/information.png">
							</span>
							<span name="discount_autocheck" class="autocheck"></span>
							<div name="discount_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>


					<div class="formRow">
						<label class="formLeft" for="param_cat">Thể loại:<span class="req">*</span></label>
						<div class="formRight">
							<select name="catalog" class="left">
									<option value="">-- Lựa chon danh mục --</option>
									<?php foreach($catalogs as $rows): ?>
										<?php if(count($rows->subs) > 0):?>
										    <optgroup label="<?php echo $rows->name ?>">
										    	<?php foreach($rows->subs as $subs):?>
							<option value="<?php echo $subs->id ?>" <?php if($subs->id == $product->catalog_id){echo 'selected';}?>><?php echo $subs->name ?></option>
										        <?php endforeach ?>
										    </optgroup>
										<?php else: ?>
											<option value="<?php echo $rows->id ?>" <?php if($rows->id == $product->catalog_id){echo 'selected';}?>><?php echo $rows->name ?></option>
										<?php endif; ?>
									<?php endforeach ?>


								</select>
							<span name="cat_autocheck" class="autocheck"></span>
							<div name="cat_error" class="clear error"><?php echo form_error('catalog') ?></div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_warranty">
							Bảo hành :
						</label>
						<div class="formRight">
							<span class="oneFour"><input value="<?php echo $product->warranty ?>" name="warranty" id="param_warranty" type="text"></span>
							<span name="warranty_autocheck" class="autocheck"></span>
							<div name="warranty_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="formRow">
						<label class="formLeft" for="param_sale">Tặng quà:</label>
						<div class="formRight">
							<span class="oneTwo">
							<textarea value="" name="sale" id="param_sale" rows="4" cols=""><?php echo $product->gifts ?></textarea></span>
							<span name="sale_autocheck" class="autocheck"></span>
							<div name="sale_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>					         <div class="formRow hide"></div>
				</div>
<!-- Tab 2 -->
			<div id="tab2" class="tab_content pd0">
				<div class="formRow">
					<label class="formLeft" for="param_site_title">Title:</label>
					<div class="formRight">
						<span class="oneTwo"><textarea value="" name="site_title" id="param_site_title" _autocheck="true" rows="4" cols=""><?php echo $product->site_title ?></textarea></span>
						<span name="site_title_autocheck" class="autocheck"></span>
						<div name="site_title_error" class="clear error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_meta_desc">Meta description:</label>
					<div class="formRight">
						<span class="oneTwo"><textarea value="" name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols=""><?php echo $product->meta_desc ?></textarea></span>
						<span name="meta_desc_autocheck" class="autocheck"></span>
						<div name="meta_desc_error" class="clear error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label class="formLeft" for="param_meta_key">Meta keywords:</label>
					<div class="formRight">
						<span class="oneTwo"><textarea value="" name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols=""><?php echo $product->meta_key ?></textarea></span>
						<span name="meta_key_autocheck" class="autocheck"></span>
						<div name="meta_key_error" class="clear error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow hide"></div>
			</div>
<!-- Tab 3 -->
			<div id="tab3" class="tab_content pd0">
				<div class="formRow">
					<label class="formLeft">Nội dung:</label>
					<div class="formRight">
						<textarea name="content" id="param_content" class="editor"><?php echo $product->content ?></textarea>
						<div name="content_error" class="clear error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow hide"></div>
			</div>
		</div><!-- End tab_container-->

	    <div class="formSubmit">
	        <input type="submit" value="Cập nhật" class="redB">
	        <input type="reset" value="Hủy bỏ" class="basic">
	    </div>
	    <div class="clear"></div>
		</div>
	</fieldset>
</form>
</div>
<div class="clear mt30"></div>
