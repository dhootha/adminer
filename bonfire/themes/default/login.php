
	<?php echo theme_view('parts/_header'); ?>	
	<div class="container body">
		<div class="row-fluid">
			<div class="span12">
				<div class="span4">
					<h1>
						<a href="<?php echo site_url('/'); ?>" class="brand">
							<?php e($this->settings_lib->item('site.title')); ?>
						</a>
					</h1>				
				</div>
				<div class="span8">
					<?php echo Template::block('header','home/header');?>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="<?php echo base_url();?>">Home</a>
						<div class="nav-collapse collapse">
							<ul class="nav" >
								<li><a href="#" >Featured Deal</a></li>
								<li><a href="#">My Account</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
<?php

	echo Template::message();
	echo isset($content) ? $content : Template::yield();
?>
</div>
<section>
			<?php echo theme_view('parts/_footer'); ?>
		</section>
	</div>
