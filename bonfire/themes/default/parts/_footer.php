    <footer class="footer">
    	<div class="container">
			<div class="row-fluid">
				<div class="span12">
					<div class="span2" style="width: 15%;">
						<ul class="unstyled">
							<li>GitHub<li>
							<li><a href="#">About us</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">Contact & support</a></li>
							<li><a href="#">Enterprise</a></li>
							<li><a href="#">Site status</a></li>
						</ul>
					</div>
					<div class="span2" style="width: 15%;">
						<ul class="unstyled">
							<li>Applications<li>
							<li><a href="#">Product for Mac</a></li>
							<li><a href="#">Product for Windows</a></li>
							<li><a href="#">Product for Eclipse</a></li>
							<li><a href="#">Product mobile apps</a></li>							
						</ul>
					</div>
					<div class="span2" style="width: 15%;">
						<ul class="unstyled">
							<li>Services<li>
							<li><a href="#">Web analytics</a></li>
							<li><a href="#">Presentations</a></li>
							<li><a href="#">Code snippets</a></li>
							<li><a href="#">Job board</a></li>							
						</ul>
					</div>
					<div class="span2" style="width: 15%;">
						<ul class="unstyled">
							<li>Documentation<li>
							<li><a href="#">Product Help</a></li>
							<li><a href="#">Developer API</a></li>
							<li><a href="#">Product Markdown</a></li>
							<li><a href="#">Product Pages</a></li>							
						</ul>
					</div>	
					<div class="span2" style="width: 15%;">
						<ul class="unstyled">
							<li>More<li>
							<li><a href="#">Training</a></li>
							<li><a href="#">Students & teachers</a></li>
							<li><a href="#">The Shop</a></li>
							<li><a href="#">Plans & pricing</a></li>
							<li><a href="#">Contact us</a></li>
						</ul>
					</div>					
				</div>
			</div>
			<hr>
			<div class="row-fluid">
				<div class="span12">
					<div class="span8">
						<a href="#">Terms of Service</a>    
						<a href="#">Privacy</a>    
						<a href="#">Security</a>
					</div>
					<div class="span4">
						<p class="muted pull-right">© 2013 Company Name. All rights reserved</p>
					</div>
				</div>
			</div>
	        <?php if (ENVIRONMENT == 'development') :?>
				<p style="float: right; margin-right: 80px;">Page rendered in {elapsed_time} seconds, using {memory_usage}.</p>
			<?php endif; ?>
	
		</div>
	</footer>
	
	<?php echo theme_view('parts/modal_login'); ?>

	<div id="debug"></div>
  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo js_path(); ?>jquery-1.7.2.min.js"><\/script>')</script>

  <!-- This would be a good place to use a CDN version of jQueryUI if needed -->
	<?php echo Assets::js(); ?>

</body>
</html>
