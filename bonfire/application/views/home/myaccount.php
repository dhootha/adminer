<?php
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

		if (!class_exists('User_model'))
		{
			$this->load->model('users/User_model', 'user_model');
		}

		$this->load->database();

		$this->load->library('users/auth');

	
?>

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<h3>Welcome, <?php echo ucfirst($current_user->display_name); ?>!</h3>
		</div>
		<div class="row-fluid">
			<?php $this->load->view("home/user_tabs",array("select_tab"=>"myaccount")); ?>
		</div>
		<div class="row-fluid">
			<?php 
				$email_fre_type=array(0=>"No",1=>"Yes");
				if($msg = $this->session->flashdata('flash_message')){
					echo "<div>".$msg."</div>";
				}		
			?>
			<section id="profile">

			<div class="page-header">
				<h1><?php echo lang('us_edit_profile'); ?></h1>
			</div>

			<?php if (auth_errors() || validation_errors()) : ?>
			<div class="row-fluid">
				<div class="span8 offset2">
					<div class="alert alert-error fade in">
						<a data-dismiss="alert" class="close">&times;</a>
						<?php echo auth_errors() . validation_errors(); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if (isset($user) && $user->role_name == 'Banned') : ?>
			<div class="row-fluid">
				<div class="span8 offset2">
					<div data-dismiss="alert" class="alert alert-error fade in">
					  <a data-dismiss="alert" class="close">&times;</a>
						<?php echo lang('us_banned_admin_note'); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="row-fluid">
				<div class="span8 offset2">
					<div class="alert alert-info fade in">
					  <a data-dismiss="alert" class="close">&times;</a>
						<h4 class="alert-heading"><?php echo lang('bf_required_note'); ?></h4>
						<?php if (isset($password_hints)):?>
							<?php echo $password_hints; ?>
						<?php endif;?>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">
				
				<?php echo form_open($this->uri->uri_string(), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
				<div class="control-group <?php echo iif( form_error('display_name') , 'error') ;?>">
		<label class="control-label" for="display_name"><?php echo lang('bf_display_name'); ?></label>
		<div class="controls">
			<input class="span6" type="text" id="display_name" name="display_name" value="<?php echo set_value('display_name', isset($user) ? $user->display_name : '') ?>" />
		</div>
	</div>

	<div class="control-group <?php echo iif( form_error('email') , 'error') ;?>">
		<label class="control-label required" for="email"><?php echo lang('bf_email'); ?></label>
		<div class="controls">
			<input class="span6" type="text" id="email" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : '') ?>" />
		</div>
	</div>

	<?php if ( settings_item('auth.login_type') !== 'email' OR settings_item('auth.use_usernames')) : ?>
	<div class="control-group <?php echo iif( form_error('username') , 'error') ;?>">
		<label class="control-label required" for="username"><?php echo lang('bf_username'); ?></label>
		<div class="controls">
			<input class="span6" type="text" id="username" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : '') ?>" />
		</div>
	</div>
	<?php endif; ?>
	
	<br />

	<div class="control-group <?php echo iif( form_error('password') , 'error') ;?>">
		<label class="control-label" for="password"><?php echo lang('bf_password'); ?></label>
		<div class="controls">
			<input class="span6" type="password" id="password" name="password" value="" />
		</div>
	</div>

	<div class="control-group <?php echo iif( form_error('pass_confirm') , 'error') ;?>">
		<label class="control-label" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
		<div class="controls">
			<input class="span6" type="password" id="pass_confirm" name="pass_confirm" value="" />
		</div>
	</div>

		<?php if (isset($languages) && is_array($languages) && count($languages)) : ?>
			<?php if(count($languages) == 1): ?>
				<input type="hidden" id="language" name="language" value="<?php echo $languages[0]; ?>">
			<?php else: ?>
				<div class="control-group <?php echo form_error('language') ? 'error' : '' ?>">
					<label class="control-label required" for="language"><?php echo lang('bf_language') ?></label>
					<div class="controls">
						<select name="language" id="language" class="chzn-select">
						<?php foreach ($languages as $language) : ?>
							<option value="<?php e($language) ?>" <?php echo set_select('language', $language, isset($user->language) && $user->language == $language ? TRUE : FALSE) ?>>
								<?php e(ucfirst($language)) ?>
							</option>

						<?php endforeach; ?>
						</select>
						<?php if (form_error('language')) echo '<span class="help-inline">'. form_error('language') .'</span>'; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="control-group <?php echo form_error('timezone') ? 'error' : '' ?>">
			<label class="control-label required" for="timezones"><?php echo lang('bf_timezone') ?></label>
			<div class="controls">
				<?php echo timezone_menu(set_value('timezones', isset($user) ? $user->timezone : $current_user->timezone)); ?>
				<?php if (form_error('timezones')) echo '<span class="help-inline">'. form_error('timezones') .'</span>'; ?>
			</div>
		</div>

		<?php
			// Allow modules to render custom fields
			Events::trigger('render_user_form', $user );
		?>

		<!-- Start User Meta -->
		<?php $this->load->view('home/user_meta', array('frontend_only' => TRUE));?>
		<!-- End of User Meta -->

	<!-- Start of Form Actions -->
	<div class="form-actions">
		<input type="submit" name="submit" class="btn btn-primary" value="<?php echo lang('bf_action_save') .' '. lang('bf_user') ?> " /> <?php echo lang('bf_or') ?>
		<?php echo anchor('/', '<i class="icon-refresh icon-white">&nbsp;</i>&nbsp;' . lang('bf_action_cancel'), 'class="btn btn-warning"'); ?>
	</div>
	<!-- End of Form Actions -->

<?php echo form_close(); ?>
				
				
				
				
				
		</div>
	</div>
</div>



<div class="clsFloatLeft" id="Main_left">
	<div class="inner_pages">
    	<h1 class="Main_Tittle"><span><?php echo $title?></span></h1>
		<div class="users view">
			<h2>
				<?php echo 'Welcome, '.ucfirst($current_user->display_name); ?>
			</h2>
		<div>
		
        <?php
			$this->load->view("home/user_tabs",array("select_tab"=>"myaccout"));
		?>
		
		
		
		
        <br />
            <div class="login_container">
            	<?php
					$email_fre_type=array(0=>"No",1=>"Yes");
			
					if($msg = $this->session->flashdata('flash_message'))
					{
						echo "<div>".$msg."</div>";
					}
					
					$add_user_form=array("name"=>"add_user","id"=>"add_user");
					
					$email=array("name"=>"email","id"=>"email","class"=>"required email forminput");
					
					$first_name=array("name"=>"first_name","id"=>"first_name","class"=>"required forminput");
					
					$last_name=array("name"=>"last_name","id"=>"last_name","class"=>"forminput");
					//$password=array("name"=>"password","id"=>"password","class"=>"forminput");
					
					$user_submit_button=array("name"=>"user_submit_button","id"=>"user_submit_button","class"=>"Butt_Bg","value"=>"Save","style"=>"float:left");
				
					$user_cancel_button=array("name"=>"user_cancel_button","id"=>"user_cancel_button","class"=>"Butt_Bg","value"=>"Cancel","style"=>"float:left",'content' => 'Cancel');
				
					echo form_open('',$add_user_form);
			
					$default = 'UTC';
					
					$not_login=0;
					
					if(isset($user_detail) && count($user_detail)!=0)
					{
						if($user_detail[0]->id==$user_id)
						{
							$email["value"]=$user_detail[0]->email;
							
							$first_name["value"]=$user_detail[0]->first_name;
							
							$last_name["value"]=$user_detail[0]->last_name;
							
							$default=$user_detail[0]->time_zone;
							
							echo '<script type="text/javascript">
								$(document).ready(function(){
									$("#city").val(\''.$user_detail[0]->city.'\');
									$("#email_frequency").val(\''.$user_detail[0]->email_frequency.'\');
								})
							</script>';
						}
						else
							$not_login=1;
					}
					else
						$not_login=1;
					if($not_login==1)
					{
						$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Access Denided'));
						redirect("signup");
					}
					
					echo '<div><h4>'.form_label("Email","email_label").'</h4><br><span class="Input_Bg_log">'.form_input($email).'</span></div><br>';
										
					echo '<div><h4>'.form_label("First Name","first_name_label").'</h4><br><span class="Input_Bg_log">'.form_input($first_name).'</span></div><br>';
					
					echo '<div><h4>'.form_label("Last Name","last_name_label").'</h4><br><span class="Input_Bg_log">'.form_input($last_name).'</span></div><br>';
					
					echo '<div><h4>'.form_label("Time Zone","time_zone_label").'</h4><br><span class="InputBg_Slecet">'.timezone_menu($default, $class = "select_box",'timezones').'</span></div><br>';
					
					$email_fre_js = 'id="email_frequency" class="select_box required"';
					
					echo '<div><h4>'.form_label("Email Frequency","email_frequency_label").'</h4><br><span class="InputBg_Slecet">'.form_dropdown("email_frequency",$email_fre_type,'',$email_fre_js).'</span></div><br>';
					
					$city_js= 'id="city" class="select_box"';
					
					echo '<div><h4>'.form_label("City","city_name_label").'</h4><br><span class="InputBg_Slecet">'.form_dropdown("city",$city_drop_val,'',$city_js).'</span></div><br>';
					
					echo '<div><br>'.form_submit($user_submit_button).'<div style="width:10px;float:left">&nbsp;</div>'.form_button($user_cancel_button).'</div><div class="clear"></div>';
				?>
            </div>
            <div class="login_ad_container">
               
            </div>
        	<div class="clear"></div>
       
   </div>
</div>
<?php
//$this->load->view("home/right_side_bar");
?>    
<?php
	$this->load->view("home/footer");
?>
