
<div class="row-fluid">	
	<div class="span12 offset1">
		<ul class="nav nav-pills">
			<li>
				<a href="#">View Cities</a>
			</li>
			<?php
				if(!$this->auth->is_logged_in()){?>
			<li>
				<a href="#">Get Daily UTC LONDON Alerts!</a>
			</li>
			<?php	
				}
			?>
			<li>
				<a href="#">Refer a Friend</a>
			</li>
			<li>
				<a href="#">Cantact Us</a>
			</li>
		</ul>
	</div>
</div>
<div class="row-fluid">	
	<div class="span12">
		<?php
			$email_sub_con='on';
			if(isset($email_sub_container) && $email_sub_container=='no')
				$email_sub_con='off';
			else
				$email_sub_con='on';
		
			//var_dump($email_sub_con);
		
			if($email_sub_con=='on'){
				if(!$this->auth->is_logged_in()){
					$sign_up_option=array("name"=>"mail_subscription","id"=>"mail_subscription","method"=>"post");
					echo form_open('home/subscribe',$sign_up_option);
		?>
		<div class="row-fluid">
			<div class="span4">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-envelope"></i></span>
					<input class="span8" id="prependInput" type="text" placeholder="Enter Your Email" />
				</div>
			</div>
			<div class="span5">
				<div class="row-fluid">
					<select class="span8">
						<option>Select Cities</option>
						<?php 
							foreach($change_location_select as $dd)
								echo "<option value='".$dd['name']."'>".$dd['name']."</option>";
						?>
					</select>
				</div>
			</div>
			<div class="span3">
				<input type="submit" class="btn .btn-small btn-primary" value="Subscribe">
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12 offset8">
				<a class="btn btn-primary" href="<?php echo base_url();?>login">LogIn</a>
				<a class="btn btn-primary" href="<?php echo base_url();?>register">Register</a>
			</div>
		</div>
		<?php
			echo form_close();
			}else{
		?>
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
					<select style="float:right">
						<option>Select Cities</option>
						<?php 
							foreach($change_location_select as $dd)
								echo "<option value='".$dd['name']."'>".$dd['name']."</option>";
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<span style="float:right">
					<h4>Welcome <?php echo $current_user->display_name;?></h4>
					<a style="float:right" class="btn btn-primary" href="<?php echo base_url();?>logout">Logout</a>
					<a style="float:right" class="btn btn-primary" href="<?php echo base_url();?>myaccount">Account</a>
				</span>
			</div>
		</div>
		<?php
		}}
		?>
	</div>
</div>