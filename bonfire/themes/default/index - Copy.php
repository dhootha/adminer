<?php echo theme_view('parts/_header'); ?>	
<div class="container body narrow-body">
	<header id="header">
		<div id="header_left" class="clsFloatLeft">
			<div id="logo">
				<p>
					<h1>
						<a href="<?php echo site_url('/'); ?>" class="brand">
							<?php e($this->settings_lib->item('site.title')); ?>
						</a>
					</h1>
				</p>
			</div>
		</div>
		<?php echo Template::block('header','home/header');?>
	</header>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div id='cssmenu'>
				<ul>
					<li><a href='<?php echo base_url(); ?>'><span>Home</span></a></li>
					<li class='has-sub last'>
						<?php if($this->auth->is_logged_in()){ echo anchor("my_account","My Account");}else{ echo anchor("login","My Account"); }?>
						<ul>
							<li>
								<?php if($this->auth->is_logged_in()){ echo anchor("home/change_password","Change Password");}else{ echo anchor("login","Change Password"); }?>
							</li>
							<li class='last'>
								<?php if($this->auth->is_logged_in()){ echo anchor("home/my_coupon","My Coupons");}else{ echo anchor("login","My Coupons"); }?>
							</li>
						</ul>
					</li>
				</ul>
			</div>
	</nav>
	<section id="middle">
	<?php
		//echo Template::block('index','home/index');
		// echo Template::message();
		echo isset($content) ? $content : Template::yield();
	?>
	</section>
</div>
<?php echo theme_view('parts/_footer'); ?>
