<?php $this->load->view('admin/slide/head',$this->data);  ?>

<div class="wrapper">
	<div class="widget">
		<div class="title">				
			<h6>Thêm mới Slide ảnh</h6>			 	
		</div>
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>			
				<div class="formRow">
					<label class="formLeft" for="param_name">Tên Slide:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="name" value="<?php echo set_value('name') ?>" id="param_name" _autocheck="true" type="text"></span>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_sort_order">Tên ảnh:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="image_name" value="<?php echo set_value('image_name') ?>" id="param_image_name" _autocheck="true" type="text"></span>
						<span name="image_name_autocheck" class="autocheck"></span>
						<div name="image_name_error" class="clear error"><?php echo form_error('image_name') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_sort_order">Link:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="link" value="<?php echo set_value('link') ?>" id="param_link" _autocheck="true" type="text"></span>
						<span name="link_autocheck" class="autocheck"></span>
						<div name="link_error" class="clear error"><?php echo form_error('link') ?></div>
					</div>
					<div class="clear"></div>
				</div>	

				<div class="formRow">
					<label class="formLeft" for="param_sort_order">Info:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="info" value="<?php echo set_value('info') ?>" id="param_info" _autocheck="true" type="text"></span>
						<span name="info_autocheck" class="autocheck"></span>
						<div name="info_error" class="clear error"><?php echo form_error('info') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_sort_order">Thứ tự sắp xếp:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="sort_order" value="<?php echo set_value('sort_order') ?>" id="param_sort_order" _autocheck="true" type="text"></span>
						<span name="sort_order_autocheck" class="autocheck"></span>
						<div name="sort_order_error" class="clear error"><?php echo form_error('sort_order') ?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
						<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
						<div class="formRight">
							<div class="left">
								<input type="file" id="image" name="image">
							</div>
							<div name="image_error" class="clear error"></div>
						</div>
						<div class="clear"></div>
					</div>		

				<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB">	           			
	           	</div>
			</fieldset>
		</form>
	</div>
</div>	

