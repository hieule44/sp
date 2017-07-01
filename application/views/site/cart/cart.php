<!-- zoom image -->
<script src="<?php echo public_url('site/'); ?>jqzoom_ev/js/jquery.jqzoom-core.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo public_url('site/'); ?>jqzoom_ev/css/jquery.jqzoom.css" type="text/css">
<script type="text/javascript">
	$(document).ready(function() {
		$('.jqzoom').jqzoom({
			zoomType: 'standard',
		});
	});
</script>
<!-- end zoom image -->

<div class="box-content-center">
<?php if(count($this->cart->contents()) > 0): ?>
<form action="<?php echo cart_url('update') ?>" method="post">
	<table class="table">
		<thead>
			<th>STT</th>
			<th>Tên sản phẩm</th>
			<th>Số lượng</th>
			<th>Đơn giá</th>
			<th>Thành tiền</th>
			<th> Hành động</th>
		</thead>
		<?php $i = 0;
					$tt = 0;
		?>
		<?php foreach ($cart as $cart) {
			$i++;
			$tt = $tt + $cart['subtotal'];
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $cart['name']; ?></td>
			<td><input name="<?php echo $cart['id']; ?>" value="<?php echo $cart['qty']; ?>" size="5"/></td>
			<td><?php echo number_fm_vnd($cart['price']); ?></td>
			<td><?php echo number_fm_vnd($cart['subtotal']); ?></td>
			<td><a href="<?php echo cart_url('del/'.$cart['id']);?>">Xóa</a></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="6">Tổng số tiền Thanh toán : <?php echo number_fm_vnd($tt); ?>  --  <a href="<?php echo cart_url('del');?>">Xóa toàn bộ</a></td>
		</tr>
		<tr>
			<td colspan="6"><input type="submit" value="Cập nhật"/></td>
		</tr>
	</table>
</form>
<?php else: ?>
	<h4> Chưa có SP nào trong giỏ hàng</h4>
<?php endif;?>
</div>
<!-- End content -->
