<?php $this->load->view('admin/product/head',$this->data); ?>
<div class="wrapper" id="main_product">
<?php $this->load->view('admin/message',$this->data); ?>
	<div class="widget">

		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Danh sách sản phẩm			</h6>
		 	<div class="num f12">Số lượng: <b></b><?php echo count($list); ?></b></div>
		</div>

		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">

			<thead class="filter"><tr><td colspan="6">
				<form class="list_filter form" action="<?php echo admin_url('product') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>

						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" id="filter_id" type="text" value="<?php echo $this->input->get('id'); ?>" style="width:55px;"></td>
							<td class="label" style="width:40px;"><label for="filter_id">Tên</label></td>
							<td class="item" style="width:155px;"><input name="name" value="<?php echo $this->input->get('name'); ?>" id="filter_iname" type="text" style="width:155px;"></td>

							<td class="label" style="width:60px;"><label for="filter_status">Thể loại</label></td>
							<td class="item">
								<select name="catalog">
									<option value="">-- Tất cả --</option>
									<?php foreach($catalogs as $rows): ?>
										<?php if(count($rows->subs) > 1):?>
										    <optgroup label="<?php echo $rows->name ?>">
										    	<?php foreach($rows->subs as $subs):?>
										        <option value="<?php echo $subs->id ?>" <?php echo($this->input->get('catalog') == $subs->id) ? 'selected':'' ?>><?php echo $subs->name ?></option>
										        <?php endforeach ?>
										    </optgroup>
										<?php else: ?>
											<option value="<?php echo $rows->id ?>" <?php echo($this->input->get('catalog') == $rows->id) ? 'selected':'' ?>><?php echo $rows->name ?></option>
										<?php endif; ?>
									<?php endforeach ?>


								</select>
							</td>

							<td style="width:150px">
							<input type="submit" class="button blueB" value="Lọc">
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('product') ?>'; ">
							</td>

						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>

			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/') ?>images/icons/tableArrows.png"></td>
					<td style="width:60px;">Mã số</td>
					<td>Tên</td>
					<td>Giá</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>

 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="6">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('product/del_all')?>">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>

					     <div class="pagination">
					     	<?php echo $this->pagination->create_links(); ?>
					     </div>
					</td>
				</tr>
			</tfoot>

			<tbody class="list_item">
			<?php foreach($list as $rows): ?>
			    <tr class="row_<?php echo $rows->id ?>">
					<td><input type="checkbox" name="id[]" value="<?php echo $rows->id ?>"></td>
					<td class="textC"><?php echo $rows->id ?></td>
					<td>
						<div class="image_thumb">
							<img src="<?php echo base_url('upload/product/'.$rows->image_link) ?>" height="50">
							<div class="clear"></div>
						</div>
						<a href="" class="tipS" title="" target="_blank">
						<b><?php echo $rows->name ?></b>
						</a>
						<div class="f11">Đã bán: <?php echo $rows->buyed ?> | Xem: <?php echo $rows->view ?></div>
					</td>
					<td class="textR">
						<b style="color: red"><?php echo number_format($rows->discount) ?> đ</b>
						<?php if($rows->discount > 0){?>
							<p style="text-decoration:line-through"><?php echo number_format($rows->price) ?> đ</p>
						<?php } ?>
					</td>
					<td class="textC"><?php echo get_date($rows->created,false) ?></td>
					<td class="option textC">
						<a href="<?php echo admin_url('product/view/'.$rows->id) ?>" target="_blank" class="tipS" title="Xem chi tiết sản phẩm">
							<img src="<?php echo public_url('admin/') ?>images/icons/color/view.png">
						 </a>
						 <a href="<?php echo admin_url('product/edit/'.$rows->id) ?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin/') ?>images/icons/color/edit.png">
						</a>
						<a href="<?php echo admin_url('product/del/'.$rows->id) ?>" title="Xóa" class="tipS verify_action">
						    <img src="<?php echo public_url('admin/') ?>images/icons/color/delete.png">
						</a>
					</td>
				</tr>
			<?php endforeach ?>
		    </tbody>

		</table>
	</div>

</div>
