<!--load head-->
<?php $this->load->view('admin/admin/head',$this->data); ?>
<div class="wrapper">
	<?php $this->load->view('admin/message',$this->data); ?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><div class="checker" id="uniform-titleCheck"><span><input type="checkbox" id="titleCheck" name="titleCheck" style="opacity: 0;"></span></div></span>
			<h6>Danh sách Admin</h6>
		 	<div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
		</div>
		
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin/') ?>images/icons/tableArrows.png"></td>
					<td style="width:80px;">ID</td>
					<td>Họ và tên</td>
					<td>username</td>
					<td>Group id</td>					
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot>
				<tr>
					<td colspan="7">
					     <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="user/del_all.html">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
							
					     <div class="pagination">
			            </div>
					</td>
				</tr>
			</tfoot>
 			
			<tbody>
				<!-- Filter -->
				<?php foreach($list as $row): ?>
					<tr>
						<td>
							<div class="checker" id="uniform-undefined"><span><input type="checkbox" name="id[]" value="<?php echo $row->id ?>" style="opacity: 0;"></span>
							</div>
						</td>
						
						<td class="textC"><?php echo $row->id ?></td>						
						
						<td><span class="tipS" original-title="<?php echo $row->name ?>"><?php echo $row->name ?></span></td>						
						
						<td><span class="tipS" original-title="<?php echo $row->username ?>"><?php echo $row->username ?></span></td>
						
						<td><?php echo $row->admin_group_id ?></td>
						
						<td class="option">
							<a href="<?php echo admin_url('admin/edit/'.$row->id) ?>" class="tipS " original-title="Chỉnh sửa">
								<img src="<?php echo public_url('admin/') ?>images/icons/color/edit.png">
							</a>
							
							<a href="<?php echo admin_url('admin/delete/'.$row->id) ?>" class="tipS verify_action" original-title="Xóa">
							    <img src="<?php echo public_url('admin/') ?>images/icons/color/delete.png">
							</a>
						</td>
					</tr>
				<?php endforeach; ?>	
					
				
			</tbody>
		</table>
		
	</div>
</div>
<div class="clear mt30"></div>