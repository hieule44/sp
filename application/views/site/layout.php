<htm>
	<head>
		<?php $this->load->view('site/head'); ?>
	</head>
<body>
<div class="thongbao">Đây là thông báo</div>
		<script>
			window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '391105534620712',
		      xfbml      : true,
		      version    : 'v2.9'
		    });
		    FB.AppEvents.logPageView();
		  };
		(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=391105534620712&version=v2.9";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
				//$(".fb-comments").attr('data-href',encodeURIComponent(location.href));
				// data-href=""
		</script>
		<a href="#" id="back_to_top"><img src="<?php echo public_url('site/') ?>images/top.png"/></a>

		<div class="wraper">
			<div class="header">
				<?php $this->load->view('site/header'); ?>
			</div>

			<div class="container">
				<div class="left">
					<?php $this->load->view('site/left',$this->data); ?>
				</div>

				<div class="content">
					<?php $this->load->view($temp, $this->data); ?>
				</div>

				<div class="right">
					<?php $this->load->view('site/right', $this->data); ?>
				</div>
				<div class="clear"></div>
			</div>

			<center>
			<!--	<img src="<?php echo public_url() ?>/site/images/bank.png" /> -->
		  </center>

		  <div class="footer">
					<?php $this->load->view('site/footer'); ?>
				</div>
		</div>
	</body>
</htm>
