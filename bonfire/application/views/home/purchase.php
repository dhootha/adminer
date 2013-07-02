<script type="text/javascript">
$(document).ready(function(){
	$("#change_password_form").validate({errorElement:"p",errorClass:"Frm_Error_Msg",focusInvalid: false})
	
	$("#order_amount").numeric();
	
	$("#alerts").hide();
	
	$("#alerts_quanity").hide();
	
	$("#order_amount").keyup(function(){
		var order_amount=parseInt($("#order_amount").val());
		var option_max_purchase=parseInt($("#option_max_purchase_<?php echo $deal_id?>").val())
		var unit_price=parseInt($("#unit_price_<?php echo $deal_id?>").val())
		var deal_quantity=parseInt($("#deal_quantity_<?php echo $deal_id?>").val())
		
		if($("#order_amount").val()=="")
		{
			order_amount=1;
			$("#order_amount").val(1);
		}
			
		if(order_amount==0 || order_amount=='')
			$("#order_amount").val(1);
		else
		{
			/*if(order_amount>option_max_purchase)
			{
				$("#order_amount").val(option_max_purchase);
				order_amount=parseInt($("#order_amount").val());
				$("#alerts").show();
				setTimeout('$("#alerts").hide("slow")',3000);
				
				//delay(800);
				//setTimeout(50000,"$(\"#alerts\").hide()");
			}
			var total=order_amount*unit_price;
			
			$(".currency_html .integer").html(+total);
			$(".clsMyPrice_Span2").html("$ "+total);
			$("#total_price").val(total);*/
		}
		if(order_amount>deal_quantity)
		{
			$("#order_amount").val(1);
				order_amount=parseInt($("#order_amount").val());
			$("#alerts_quanity").show();
			
			setTimeout('$("#alerts_quanity").hide("slow")',3000);
				
			var total=order_amount*unit_price;
			
			$(".currency_html .integer").html(+total);
			$(".clsMyPrice_Span2").html("$ "+total);
			$("#total_price").val(total);
		}
		
	});
}) 
</script>
<style type="text/css">
.clsLoging_Form
{
	margin-left:20px;
}
</style>
<div class="row-fluid">
	<div class="span12">
		<h2><?php echo $title?></h2>
		<div class="row-fluid">
			<div class="span12">
				<div class="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					Quantity must be <?php echo $deal_max_purchase; if($deal_max_purchase>1) echo 'or less';?>; we took care of that for you.
				</div>
				<div class="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					Quantity Less So you Should Purchase <?php echo $deal_quantity; if($deal_quantity>1) echo ' or less';?>
				</div>
				<?php
					$attribute=array("name"=>"paypal_post","id"=>"paypal_post","method"=>"post");
					echo form_open("home/paypal_checkout",$attribute)
				?>
				<div class="row-fluid">
					<table class="table">
						<thead>
							<tr>
								<th>Description</th>
								<th>Quantity</label</th>
								<th>&nbsp;</th>
								<th>Price</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input type="hidden" value="<?php echo $deal_id?>" id="deal_id" name="deal_id">
									<input type="hidden" value="<?php echo current_url()?>" id="current_pay_url" name="current_pay_url">
									<input type="hidden" value="<?php echo $deal_price?>" id="unit_price_<?php echo $deal_id?>">
									<input type="hidden" value="<?php echo $deal_max_purchase?>" id="option_max_purchase_<?php echo $deal_id?>">
									 <input type="hidden" value="<?php echo $deal_quantity?>" id="deal_quantity_<?php echo $deal_id?>">
									<?php echo $deal_title?>
								</td>
								<td>
									<input type="text" value="1" size="3" name="order_amount" maxlength="3" id="order_amount" class="numerical input">
								</td>
								<td>
									x
								</td>
								<td>
									<input type="hidden" value="<?php echo $deal_price?>" name="deal_price" id="deal_price">           
									<span class="deal_price_currency_html">
										<span class="unit multi_letter">$</span>
										<span class="integer"><?php echo $deal_price?></span>
									</span>
								</td>
								<td>
									<span class="currency_html">
										<span class="unit multi_letter">$</span>
										<span class="integer"><?php echo $deal_price?></span>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="row-fluid">
					<input type="hidden" name="total_price" id="total_price" value="<?php echo $deal_price?>" />
					<div class="clsMy_Price">
						<p class="text-right"><span class="clsMyPrice_Span1">My Price:</span><span class="clsMyPrice_Span2">$ <?php echo $deal_price?></span></p>
					</div>
					<br />
					<input type="submit" name="complete_order" value="Pay Now" id="complete_order" class="btn btn-primary pull-right" style="font-size:9px;"/>
				</div>
                <?php
					echo form_close();
				?>
			</div>
		</div>
	</div>
</div>