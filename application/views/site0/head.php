<meta http-equiv="Content-Type" content="text/html ;charset=utf-8" />
        <!-- the CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <!-- End CSS -->
        <link rel="icon" href="<?php echo public_url() ?>/site/images/icon.png" type="image/x-icon" />
        <!-- the Javascript -->

        <script type="text/javascript" src="<?php echo public_url() ?>/js/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo public_url() ?>/js/jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="<?php echo public_url() ?>/js/jquery/jquery-ui/custom-theme/jquery-ui-1.8.21.custom.css" type="text/css">

        <script src="<?php echo public_url() ?>/site/js/script.js"></script>

        <!-- raty -->
		 <script type="text/javascript" src="<?php echo public_url() ?>site/raty/jquery.raty.min.js"></script>
		 <script type="text/javascript">
	      $(function() {
	         $.fn.raty.defaults.path = '<?php echo public_url() ?>site/raty/img';
	         $('.raty').raty({
	          	  score: function() {
	          	    return $(this).attr('data-score');
	          	  },
	              readOnly  : true,
	          });
	      });
	     </script>
	     <style>.raty img{width:16px !important;height:16px; !important;}</style>
	     <!--End raty -->

        <!-- End Javascript -->
        <script type="text/javascript">
	        $(document).ready(function(){
		        $('#back_to_top').click(function() {
		            $('html, body').animate({scrollTop:0},"slow");
		       });
		       // go top
		       $(window).scroll(function() {
		            if($(window).scrollTop() != 0) {
		                $('#back_to_top').fadeIn();
		            } else {
		                $('#back_to_top').fadeOut();
		            }
		       });
	        });
		</script>
		<style>
		#back_to_top {
		    bottom: 10px;
		    color: #666;
		    cursor: pointer;
		    padding: 5px;
		    position: fixed;
		    right: 55px;
		    text-align: center;
		    text-decoration: none;
		    width: auto;
		}
		</style>
<title>Thydu Shop</title>
