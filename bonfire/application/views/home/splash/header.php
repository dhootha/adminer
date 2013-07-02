<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="<?php echo $this->config->item('meta_tags')?>" />
		<meta name="title" content="<?php echo $this->config->item('site_title')?>" />
		<meta name="description" content="<?php echo $this->config->item('meta_tags_description')?>" />
		<title>
		<?php
			if($this->config->item('site_title')!="")
				echo $this->config->item('site_title');
			else
				echo "Daily Deals";
		?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/splash.css" />
		</head>
		<body>
			<div id="container">