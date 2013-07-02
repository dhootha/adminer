<div class="span12">
	<div class="row-fluid">
		<div class="span8">
			<div class="clsPro_Avai_Blk">
				<!-- Info -->
				<?php 	
				if(isset($expired) and $expired=="yes"){ 
				?>
				<div class="clsInfo_Pro_Exp clearfix">
					<div class="clsInfoPE_Name">
						<h3><?php echo $deal_title?></h3>
					</div>
					<div class="clsInfoPE_Val clsFloatLeft">
						<p class="InfoPE_Titt">Value</p>
						<p class="InfoPE_CrossVal">$ <?php if(isset($deal_detail->deal_face_value)) echo $deal_detail->deal_face_value?></p>
						<p class="InfoPE_Cross"><img src="<?php echo base_url()?>images/info_exp_cross.png" alt="image" /></p>
					</div>
					<div class="clsInfoPE_Dis clsFloatLeft">
						<p class="InfoPE_Titt">Disc</p>
						<p class="InfoPE_Val"><?php if(isset($deal_detail->deal_save_percent)) echo $deal_detail->deal_save_percent?>%</p>
					</div>
				</div>
				<?php 	
				}else{ ?>
				<div class="clsInfo_Pro_Des clearfix">
					<div class="clsInfoPD_Name">
						<h3><?php echo $deal_title?></h3>
					</div>
					<div class="clsInfoPD_Val clsFloatLeft">
						<span class="InfoPD_Titt">Value</span>
						<p class="InfoPD_CrossVal">$<?php if(isset($deal_detail->deal_face_value)) echo $deal_detail->deal_face_value?></p>
						<p class="InfoPD_Cross"><img src="<?php echo Template::theme_url('images/info_val_cross.png')?>" alt="image" /></p>
					</div>
					<div class="clsInfoPD_Dis clsFloatLeft">
						<span class="InfoPD_Titt">Disc</span>
						<p class="InfoPD_Val"><?php if(isset($deal_detail->deal_save_percent)) echo $deal_detail->deal_save_percent?>%</p>
					</div>
					<div class="clsInfoPD_Tim_lft clsFloatLeft">
						<script type="text/javascript">
							$(document).ready(function(){
								inner_count_down_timer('InfoPD_Val_<?php echo $deal_detail->id?>','<?php echo date('D, d M Y h:i:m',strtotime($deal_detail->deal_end_date))?>')
							})
						</script>
						<p class="InfoPD_Titt">Time Left</p>
						<p id="InfoPD_Val_<?php echo $deal_detail->id?>" class="InfoPD_Val"></p>
					</div>
				</div>
				<?php 	
				}	
				?>
				<!-- End of Info -->
				<!-- Product Image -->
				<div class="clsPro_Image_Blk"> <!-- Same div strcture used in Home Page -->
					<div class="clsProduct_Image">
						<a href="<?php echo base_url().'deal/'.$deal_detail->slug;?>"><img src="<?php echo base_url()?>uploads/deals/<?php echo $deal_detail->deal_image_url?>" alt="Product"/></a>
					</div>
					<div class="clsBuy_Price">
						<a href="<?php if(isset($expired) and $expired=="yes")	echo"#";else echo base_url().'purchase/'.$deal_detail->slug;?>">
							<span><p>Price</p></span><span><p>$<?php if(isset($deal_detail->deal_price)) echo $deal_detail->deal_price?>/-</p></span>
						</a>
					</div>
					<?php
					if(isset($expired) and $expired=="yes")
						echo '<div class="clsExpried"><p>&nbsp;</p></div>';
					?>
				</div>
				<!-- End of Product Image -->
				<!-- Content -->
				<div class="clsInfoPD_Cont clearfix">
					<div class="clsInfoPD_ContLeft clsFloatLeft">
						<h2>Highlights</h2>
						<br>
						<div class="ProDes_Sup_Blk">
							<?php echo $deal_detail->deals_highlight?>
						</div>
					</div>
					<div class="clsInfoPD_Status clsFloatLeft">
						<p class="clsBold"><?php echo $bought?> bought</p>
						<p><?php echo $required_bought?> more needed to get the deal</p>
					</div>
					<div class="clsInfoPD_ContRight clsFloatRight">
						<p>
							<?php 
								if(isset($expired) and $expired=="yes")
									echo '<a href="javascript:void(0)"class="clsPE_Buy_Link">BUY</a>';
								else
									echo anchor('home/purchase/'.$deal_detail->slug,"BUY",array("class"=>"clsPD_Buy_Link"));
							?>
						</p>
						<p>
							<div id="fb-root"></div>
							<script>
								(function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if (d.getElementById(id)) return;
									js = d.createElement(s); js.id = id;
									js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
									fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));
							</script>
							<div style="margin-left:10px;" class="fb-like" data-href="<?php current_url();?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						</p>
						<p style="margin-left:10px;">
							<a  href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo current_url();?>" data-via="utclondon" data-related="utclondon" data-hashtags="UTCLONDON" data-dnt="true">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						</p>
						<p style="margin-left:10px;">
							<!--
								<a href="mailto:?subject=I wanted to you to see the amazing offer&amp;body=Check out this <a href='<?php echo current_url();?>'>offer</a>" title="share by Email"><i class="icon-envelope"></i></a>
							-->
						</p>
					</div>
				</div>
				<!-- End of Content -->
			</div>
			<div class="clsPB_Write_up clearfix">
				<div class="clsWrite_left clsFloatLeft">
					<div id="Location_Blk">
						<h2>Location</h2>
						<?php
						if(isset($merchant_address) && $merchant_address!=""){
						?>
						<!--	<iframe src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $mergent_address?>&output=embed" style="width:180px;height:400px; border:none"></iframe>
						-->
                    	<?php 
						}
						/*?><img src="<?php echo base_url()?>images/map.png" alt="image" /><?php */?>
						<!--<p class="clsView_Det_Link"><a href="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $merchant_address?>">View Detailed Map</a></p>
						-->
						<div class="clsWrite_Add">
							<br />
							<h2>The Company</h2>
							<p><?php if(isset($merchant_name) && $merchant_name!="") echo '<a href="'.$merchant_site_url.'">'.$merchant_name.'</a>';?></p>
							<p>
								<?php echo str_replace(", ","<br>",$merchant_address)?>
							</p>
						</div>
					</div>
					<div id="selAdd_PD">
						<a href="#">Advertisement Code</a>
					</div>
				</div>
				<div class="clsWirte_Right clsFloatRight">
					<div class="ProDes_Sup_Blk">
						<h2>The Fine Print</h2>
						<p>
							<?php echo $deal_detail->deals_fine_prints?>
						</p>
					</div>
					<div class="ProDes_Sup_Blk">
						<h2>Need to Know</h2>
						<?php echo $deal_detail->deal_description?>
						<br />
						<div class="fb-comments" data-href="<?php echo base_url().'home/deal/'.$deal_detail->slug;?>" data-num-posts="2" data-width="500"></div>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
		<div class="span4">
			<?php
            if(isset($side_deals) && count($side_deals)!=0){
				$save_value=0;
				foreach($side_deals as $side_deal){
					$save_value=$side_deal->deal_face_value-$side_deal->deal_price;
			?>
        		<script type="text/javascript">
					
					$(document).ready(function(){
							inner_count_down_timer('InfoPD_Side_Val_<?php echo $side_deal->id?>','<?php echo date('D, d M Y H:i:m', strtotime($side_deal->deal_end_date))?>')
					})
				</script>
        		<div class="clsOfferPD_Side">
					<!-- Info -->            
					<div class="clsInfoPD_Side">
						<div class="clsInfoPD_Side_Val clsFloatLeft">
							<span class="InfoPD_Side_Titt">Value</span>
							<p class="InfoPD_SideCrossVal">$ <del><?php echo $side_deal->deal_face_value?></del></p>
						</div>
						<div class="clsInfoPD_Side_Dis clsFloatLeft">
							<span class="InfoPD_Side_Titt">Disc</span>
							<p class="InfoPD_Side_Val"><?php echo $side_deal->deal_save_percent?>%</p>
						</div>
						<div class="clsInfoPD_Side_Sav clsFloatLeft">
							<span class="InfoPD_Side_Titt">Save</span>
							<p class="InfoPD_Side_Val">$ <?php echo $save_value?></p>
						</div>
						<div class="clsInfoPD_Side_TimLft clsFloatLeft">
							<span class="InfoPD_Side_Titt">Time Left</span>
							<p class="InfoPD_Side_Val" id="InfoPD_Side_Val_<?php echo $side_deal->id?>"></p>
						</div>
					</div>
					<!-- End of Info -->
					<!-- Product Image -->
					<div class="clsProImg_Side_Blk">
						<div class="clsProduct_Image">
							<span><?php echo anchor("deal/".$side_deal->slug,'<img src="'.base_url().'uploads/deals/'.$side_deal->deal_image_url.'" alt="Product" />')?></span>
						</div>
						<div class="clsBuy_Price_side">
							<?php echo anchor("purchase/".$side_deal->slug,'<span>Price</span><br /><span>$'.$side_deal->deal_price.'/-</span>')?>
						</div>
					</div>
					<!-- End of Product Image -->
					<!-- Content -->
					<div class="clsInfo_Cont_Side">
						<span><strong><?php echo anchor("deal/".$side_deal->slug,$side_deal->deal_title)?></strong></span>
					</div>
					<!-- End of Content -->
					<!-- End of Left -->
				</div><br/>
				<?php
				}
			}else{
				echo '<div style="text-align:center">'.fan_box().'</div>';
			}
			?>
		</div>
	</div>
</div>