<div class="span12">
	<h3>Welcome to <?php e($this->settings_lib->item('site.title'));?>!</h3>
	<div class="span9">
		<?php
			$count=count($deal_datas);
				if($count!=0){
					$save_value=0;
					$class_name='';
					$time_zone=$this->config->item("site_time_zone");
					for($i=0;$i<$count;$i++){
						$save_value=$deal_datas[$i]->deal_face_value-$deal_datas[$i]->deal_price;
						if($i%2==0){
							echo '<div class="All_Offers clearfix">';
							$class_name='clsFloatLeft';
						}else
							$class_name='clsFloatRight';
						?>
						<div class="clsOffer_left <?php echo $class_name?>">
							<!-- Info -->
							<div class="clsInfo clearfix">
								<div class="clsInfo_Val clsFloatLeft">
									<span class="Info_Titt">Value</span>
									<p class="Info_CrossVal">$ <?php echo $deal_datas[$i]->deal_face_value?></p>
									<p class="Info_Cross"><img src="<?php echo Template::theme_url('images/info_val_cross.png')?>" alt="image" /></p>
								</div>
								<div class="clsInfo_Dis clsFloatLeft">
									<span class="Info_Titt">Disc</span>
									<p class="Info_Val"><?php echo $deal_datas[$i]->deal_save_percent;?>%</p>
								</div>
								<div class="clsInfo_Sav clsFloatLeft">
									<span class="Info_Titt">Save</span>
									<p class="Info_Val">$ <?php echo $save_value?></p>
								</div>
								<div class="clsInfo_Tim_lft clsFloatLeft">
									<script type="text/javascript">
											$(document).ready(function(){
												count_down_timer('<?php echo $deal_datas[$i]->id?>','<?php echo date('D, d M Y h:i:m', strtotime($deal_datas[$i]->deal_end_date))?>')
												
												//count_down_timer('<?php echo $deal_datas[$i]->id?>','<?php echo date('D, d M Y H:i:m',gmt_to_local(strtotime($deal_datas[$i]->deal_end_date),$time_zone,TRUE))?>')
											})
									</script>
									<span class="Info_Titt">Time Left</span>
									<p class="Info_Val" id="clsDeal_Time_<?php echo $deal_datas[$i]->id;?>"></p>
								</div>
							</div>
							<!-- End of Info -->
							<!-- Product Image -->
							<div class="clsPro_Image_Blk">
								<div class="clsProduct_Image">
									<span><a href="<?php echo base_url()?>deal/<?php echo $deal_datas[$i]->slug?>"><img src="<?php echo base_url()?>uploads/deals/<?php echo $deal_datas[$i]->deal_image_url?>" alt="Product" style="width:346px; height:237px;" /></a></span>
								</div>
								<div class="clsBuy_Price">
									<a href="<?php echo base_url()?>deal/<?php echo $deal_datas[$i]->slug?>"><span><p>Price</p></span><span><p>$<?php echo $deal_datas[$i]->deal_price;?>/-</p></span></a>
								</div>
							</div>
							<!-- End of Product Image -->
							<!-- Content -->
							<div class="clsInfo_Cont">
								<span class="Big"><a href="<?php echo base_url()?>deal/<?php echo $deal_datas[$i]->slug?>"><?php echo $deal_datas[$i]->deal_title;?></a></span>
							   <?php /*?> <p class="Samll_orange">Buy a plan for only 84 € 210 € </p><?php */?>
							</div>
							<!-- End of Content -->
							<!-- Likes -->
							<div class="clsSoc_like_Blk clearfix">
								<div class="clsSocial_Img clsFloatLeft">
									<iframe src="http://www.facebook.com/plugins/like.php?app_id=255867891112647&amp;href=<?php echo urlencode(base_url()."deal/".$deal_datas[$i]->slug)?>&amp;send=false&amp;layout=button_count&amp;width=75&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:20px;" allowTransparency="true"></iframe>
									&nbsp;
									<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo urlencode(base_url()."deal/".$deal_datas[$i]->slug)?>" data-count="horizontal">Tweet</a>
								</div>
								<div class="clsOff_Mail clsFloatLeft">
									<a href="mailto:?subject='<?php echo $deal_datas[$i]->deal_title?>.'&body='<?php echo base_url()."deal/".$deal_datas[$i]->slug?>'" class="Off_Mail_Bg">Email</a>
								</div>
							</div>
							<!-- End of Liks -->
							<!-- End of Left -->
						</div>
						<?php
						if($i==$count-1){
							if($count%2!=0){
								echo '<div class="clsOffer_left clsFloatRight"></div></div><div class="clear"></div>';
							}
						}
						if($i%2!=0)
							echo '</div><div class="clear"></div>';
					}
				}else{
			echo '<h1>No deals</h1>';
		}
		?>
	</div>
	<div class="span3">
	
	</div>
</div>