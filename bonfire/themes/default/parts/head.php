<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="author" content="UTC London" />  
	<meta name="copyright" content="&copy; 2013" />
	
	<meta property="og:title" content="UTC London - Deals Website" />
	<meta property="og:description" content="Buy Cheap and Discounted deals only at UTC London" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo current_url(); ?>" />
	<meta property="og:image" content="<?echo base_url();?>images/apple-touch-icon.png" />
	
	<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1" />
	<meta name="robots" content="index,follow" /> 
	<meta name="robots" content="noodp" />

	<link rel="author" href="humans.txt" />
	<link rel="canonical" href="<?php echo current_url(); ?>" />
	
	
    <title><?php e($this->settings_lib->item('site.title')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<?php echo Assets::css(); ?>

	
	<script src="http://code.jquery.com/jquery.js"></script>
	
	
	<script type="text/javascript" src="<?php echo Template::theme_url('js/jquery.validate.js')?>"></script>
	<script type="text/javascript" src="<?php echo Template::theme_url('js/jquery.countdown.js')  ?>"></script>
	<script type="text/javascript" src="<?php echo Template::theme_url('js/jquery.tipsy.js')?>"></script>
	<script type="text/javascript" src="<?php echo Template::theme_url('js/alphanumeric/jquery.alphanumeric.pack.js')?>"></script>
	<script type="text/javascript" src="<?php echo Template::theme_url('js/common.js')?>"></script>
	
	<link rel="icon" href="images/favicon.ico" />
    <!-- iPhone and Mobile favicon's and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/images/apple-touch-icon-114x114.png">
	<script type="text/javascript">
		var base_url='<?php echo base_url();?>';
	</script>
	
	<script type="text/javascript">
			$(document).ready(function(){
				<?php
				if(isset($selected_slug))
					echo '$("#change_location_select").val(\''.$selected_slug.'\');';
				?>
				$("#change_location_select").change(function(){
					var city_val=$("#change_location_select").val();
					if(city_val!="")
						document.location=base_url+city_val;
				})
				$("#mail_subscription").validate({errorElement:"span",errorClass:"Frm_Error_Msg",focusInvalid: false});
			})
		</script>

  </head>
<body>
<!--[if lt IE 7]>
		<p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or
		<a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
<![endif]-->
