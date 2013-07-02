<?php
	// Setup our default assets to load.
	Assets::add_js( array('bootstrap.min.js','bootstrap.js' ));
	Assets::add_css( array('bootstrap.min.css', 'bootstrap.css'));
			
	$inline  = '$(".dropdown-toggle").dropdown();';
	$inline .= '$(".tooltips").tooltip();';
	$inline .= '$(".login-btn").click(function(e){ e.preventDefault(); $("#modal-login").modal(); });';

	Assets::add_js( $inline, 'inline' );

	Template::block('header', 'parts/head');
	
	if($this->auth->is_logged_in()){
		if($this->auth->role_id()!=4){
			Template::block('topbar', 'parts/topbar');
		}
	}
?>
