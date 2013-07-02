
<div id="Header_Right" class="clsFloatRight">
	<div class="clearfix">
		<div class="topbar">
			<ul class="global-links-r">
				<li class="down-arrow">
					<a href="#" class="view_cities">Show Cities</a>
				</li>
				<?php
					if(!$this->auth->is_logged_in()){?>
				<li class="down-arrow">
					<a href="#" class="subscribe">Get Daily <?php e($this->settings_lib->item('site.title')); ?> Alerts!</a>
				</li>
				<?php	
					}
				?>
				<li class="down-arrow">
					<a href="#" class="refer-friend">Refer Friends</a>
				</li>
				<li class="down-arrow">
					<a href="#" class="contact-us">Contact Us</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="city-block clearfix">
		<div class="city-desc-block clearfix">
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
			<div class="clearfix" id="Input_Blk">
				<div class="Input_Bg1">
					<input type="text" value="Enter your Email Address" name="email" id="email" class="required email" />
					<span class="Frm_Error_Msg"><?php echo form_error('email'); ?></span>
				</div>
				<div class="Input_Bg2">
					<select name="change_location_select" id="change_location_select" class="required">
						<option value="">Select City</option>
						<?php //echo $city_drop_down
							foreach($change_location_select as $dd)
								echo "<option value='".$dd['name']."'>".$dd['name']."</option>";
						?>
					</select>
					<span class="Frm_Error_Msg"><?php echo form_error('change_location_select'); ?></span>
				</div>
			</div>
			<div style="clear:both"></div>
			<div id="selHead_Butts" class="clearfix">
				<div class="HeadSubmit"><input type="submit" class="Butt_Bg" value="SUBMIT" name="subscribesubmit" /></div>
				<div class="HeadSign_in"><a class="clsLinks_Bg" href="<?php echo base_url()?>login"><span>Sign In</span></a></div>
				<div class="HeadSign_up"><a class="clsLinks_Bg" href="<?php echo base_url()?>signup"><span>Sign Up</span></a></div>
			</div>
			<div style="clear:both"></div>
			<?php echo form_close();
					}else{
			?>
			<dl class="total-list clearfix">
				<dt><?php echo ('Total Saved: '); ?></dt>
				<dd><span>$10</span></dd>
				<dt><?php echo ('Total Bought: '); ?></dt>
				<dd><span>$10</span></dd>
				<dt><?php echo ('Balance: '); ?></dt>
			</dl>
			<p class="clsHead_left_Titt">Welcome <?php //echo $user_id; ?></p>
			<p class="clearfix" id="Input_Blk">
				<span class="Input_Bg2">
					<select name="change_location_select" id="change_location_select">
						<option value="">Select City</option>
						<?php 
							foreach($change_location_select as $dd)
								echo "<option value='".$dd['name']."'>".$dd['name']."</option>";
						?>
					</select>
				</span>
			</p>
			<div style="clear:both"></div>
			<div id="selHead_Butts" class="clearfix">
				<div class="HeadSign_in"><a class="clsLinks_Bg" href="<?php echo base_url()?>logout"><span>Logout</span></a></div>
				<div class="HeadSign_in"><a class="clsLinks_Bg" href="<?php echo base_url()?>my_account"><span>Account</span></a></div>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
		</div>
	</div>
</div>

