<htm>
	<head>
		<?php $this->load->view('site0/head'); ?>
	</head>
	<body class="w3-content">
		<a href="#" id="back_to_top"><img src="<?php echo public_url('site/') ?>images/top.png"/></a>

		<div class="wraper">
			<div class="header">
				<?php $this->load->view('site0/header'); ?>
			</div>

			<div class="w3-row">
				<div class="w3-col s2">
					<?php $this->load->view('site0/left',$this->data); ?>
				</div>

				<div class="w3-col s8">
					<?php $this->load->view($temp, $this->data); ?>
				</div>

				<div class="w3-col s2">
					<?php $this->load->view('site0/right', $this->data); ?>
				</div>
				<div class="clear"></div>
			</div>

			<center>
			<!--	<img src="<?php echo public_url() ?>/site/images/bank.png" /> -->
		  </center>

		  <div class="footer">
					<?php $this->load->view('site0/footer'); ?>
				</div>
		</div>
	</body>
</htm>
