<?php
require_once ("config.php");

	if($userContents['email'] == "")
	{
		$_SESSION['page_url'] = curPageURL();
		$_SESSION['cart'] = '1';
		$display = "block";
	}
	else
	{
		$_SESSION['page_url'] = '';
		$display = "none";
	}
	
	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail, sales.quantity,
			sales.discount
			FROM sales 
			
			inner join tbl_products as products on sales.pid = products.pro_id
			
			left join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where sales.sale_session_id = '".$_SESSION['current_session_id']."'
			group by products.pro_id
			";
	$cart = $commonObject->selectMultiRecords($Query);
	$sub_total = $cart[0]['price'];
	$discount = $cart[0]['discount'];
	$total_amount = ($sub_total - $discount);
	 

	if(count($cart) == 0)
	{
		header("Location: cart.php");
		exit;
	}
	
if($userContents['email'] == "")
{
	$show = "display:block;";
}
else
	$show = "display:none;";
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Float That</title>
	<meta name="description" content="">
	<meta name="Hassan" content="Float That">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/checkout.css">
	<link rel="stylesheet" href="css/responsive.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<link rel="stylesheet" type="text/css" href="css/ie8-and-down.css" />
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">

</head>
<body>

	<!--start header-->
	<?php require_once("header.php");?>	
	<!--end header-->


	<div class="container">
		<div class="sixteen columns">
			
			<div id="pageName">
				<div class="name_tag">
					<p>
						You're Here :: <a href="index.php">Home</a> :: Checkout
					</p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	
	<div class="container">
		<div class="sixteen columns">

			<div class="box_head">
				<h3>Checkout</h3>
			</div><!--end box_head -->

			
				
<?php

if($userContents['email'] == "")
{
?>				<div class="checkout_outer">
				<h2><span>Login to Continue</span></h2>
				<div class="checkout_content checkout_option clearfix" style="display:block;">
					<div class="not_register">
						<h6>If you don’t have account, Register for free</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. In facilisis vestibulum dictum. Morbi in odio dui, eget pharetra arcu. Quisque sem libero, varius at sagittis ac, vulputate condimentum sem.
						</p>
						<a class="gray_btn" href="register.php">register Now</a>
					</div>
					<form action="validation.php" class="section" method="post" id="frmLogin" name="frmLogin" onSubmit="return login();">
					<input type="hidden" name="sec" id="sec" value="<?php echo md5("s4shahid79@hotmail.com");?>" />
						<h6>If You alredy have an account, Please Login</h6>
						<label>
							<strong>Your E-Mail <em>*</em></strong>
							<input id="email" type="text" name="email" value="" placeholder="example@example.com">
						</label>
						<label>
							<strong>PassWord <em>*</em></strong>
							<input id="password" type="password" name="password" value="" placeholder="**********">
						</label>
						<div class="submit">
							<input class="red_btn" type="submit" name="submit" value="sign In">
						</div>
					</form>
				</div><!--end checkout_content-->
				</div><!--end checkout_outer-->
<div class="checkout_outer">
				
				
				<h2><span>Order Details</span></h2>
				<div class="checkout_content checkout_option clearfix" style="display:block;">
				<div>
				
				</div>
					<div>
			
			<table class="receipt"  border="1" align="right" style="width:300px;">
				<tbody>
					<tr>
						<td>Sub Total</td>
						<td>$<?php echo number_format($sub_total,2);?></td>
					</tr>
					<tr>
						<td>Promotion Discount</td>
						<td>$<?php echo number_format($discount,2);?></td>
					</tr>

					<tr>
						<td style="font-weight:600;font-size:16px;">TOTAL</td>
						<td style="font-weight:600;font-size:16px;">$<?php echo number_format( ($sub_total - $discount),2);?></td>
					</tr>
				</tbody>
			
				

			</table>

		</div>
					
				</div><!--end checkout_content-->
			
			</div>				
<?php
}
else
{
?>				
			

<div class="checkout_outer">
				
				
				<h2><span>Order Details</span></h2>
				<div class="checkout_content checkout_option clearfix" style="display:block;">
				<div>
				
				</div>
					<div>
			
			<table class="receipt"  border="1" align="right" style="width:300px;">
				<tbody>
					<tr>
						<td>Sub Total</td>
						<td>$<?php echo number_format($sub_total,2);?></td>
					</tr>
					<tr>
						<td>Promotion Discount</td>
						<td>$<?php echo number_format($discount,2);?></td>
					</tr>

					<tr>
						<td style="font-weight:600;font-size:16px;">TOTAL</td>
						<td style="font-weight:600;font-size:16px;">$<?php echo number_format( ($sub_total - $discount),2);?></td>
					</tr>
				</tbody>
			
				

			</table>
<?php
	$Query="SELECT * from shipping_infor where user_id = '".$userContents['id']."'		";
	$shipping_info = $commonObject->selectMultiRecords($Query);	
?>
		</div>
					
				</div><!--end checkout_content-->
			
			</div>
			<form method="post" action="shipping_info_conf.php" name="frmSI" onSubmit="return validation();">
			<div class="checkout_outer">
				<h2><span>Account &amp; Billing Details</span></h2>
				<div class="checkout_content billing_account clearfix">
					
					<table>
						<tr>
							<td>
								<strong>First Name <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="first_name" id="first_name" value="<?php echo $shipping_info[0]['first_name']?>">
							</td>
						</tr>
						<tr>
							<td>
								<strong>Last Name <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="last_name" id="last_name" value="<?php echo $shipping_info[0]['last_name']?>">
							</td>
						</tr>
						<tr>
							<td>
								<strong>First Address <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="address" id="address" value="<?php echo $shipping_info[0]['address']?>" >
							</td>
						</tr>
						<tr>
							<td>
								<strong>Secondry Address</strong>
							</td>
							<td class="input">
								<input type="text" name="address2" id="address2" value="<?php echo $shipping_info[0]['address2']?>" >
							</td>
						</tr>
						<tr>
							<td>
								<strong>City <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="city" id="city" value="<?php echo $shipping_info[0]['city']?>" >
							</td>
						</tr>
						<tr>
							<td>
								<strong>Post Code <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="post_code" id="post_code" value="<?php echo $shipping_info[0]['post_code']?>">
							</td>
						</tr>
						<tr>
							<td>
								<strong>Contury <em>*</em></strong>
							</td>
							<td >
							<?php
	$Query="SELECT * from countries order by country asc		";
	$countries = $commonObject->selectMultiRecords($Query);							
							?>
								<select  tabindex="1" id="country" name="country">
								<option value="">Your Country</option>
								<?php
				for($i=0;$i<count($countries);$i++)
				{	
				?>
									
									<option value="<?php echo $countries[$i]['country']?>"><?php echo $countries[$i]['country']?></option>
				<?php
				}
				?>					
								</select>
								
							</td>
						</tr>
						<tr>
							<td>
								<strong>Region/Stats <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="state" id="state" value="<?php echo $shipping_info[0]['state']?>">
							</td>
						</tr>
					</table>
					
				</div><!--end checkout_content-->
			</div><!--end checkout_outer-->

			<div class="checkout_outer">
				<h2><span>Delivery Details</span></h2>
				<div class="checkout_content billing_account clearfix">
					
					<table>
						<tr>
							<td>
								<strong>First Name <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="bill_first_name"  id="bill_first_name" value="<?php echo $shipping_info[0]['bill_first_name']?>">
							</td>
						</tr>
						<tr>
							<td>
								<strong>Last Name <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="bill_last_name"  id="bill_last_name" value="<?php echo $shipping_info[0]['bill_last_name']?>">
							</td>
						</tr>
						<tr>
							<td>
								<strong>First Address</strong></td>
							<td class="input">
								<input type="text" name="bill_address"  id="bill_address" value="<?php echo $shipping_info[0]['bill_address']?>" >
							</td>
						</tr>
						<tr>
							<td>
								<strong>Secondry Address</strong>
							</td>
							<td class="input">
								<input type="text" name="bill_address2" id="bill_address2" value="<?php echo $shipping_info[0]['bill_address2']?>" >
							</td>
						</tr>
						<tr>
							<td>
								<strong>City <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="bill_city" id="bill_city" value="<?php echo $shipping_info[0]['bill_city']?>" >
							</td>
						</tr>
						<tr>
							<td>
								<strong>Post Code <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="bill_post_code"   id="bill_post_code" value="<?php echo $shipping_info[0]['bill_post_code']?>">
							</td>
						</tr>
						<tr>
							<td>
								<strong>Contury <em>*</em></strong>
							</td>
							<td class="input">
							<?php
	$Query="SELECT * from countries order by country asc		";
	$countries = $commonObject->selectMultiRecords($Query);							
							?>
								<select  tabindex="1" id="bill_country" name="bill_country">
								<option value="">Your Country</option>
								<?php
				for($i=0;$i<count($countries);$i++)
				{	
				?>
									
									<option value="<?php echo $countries[$i]['country']?>"><?php echo $countries[$i]['country']?></option>
				<?php
				}
				?>
								</select>
								
							</td>
						</tr>
						<tr>
							<td>
								<strong>Region/Stats <em>*</em></strong>
							</td>
							<td class="input">
							<input type="text" name="bill_state" id="bill_state" value="<?php echo $shipping_info[0]['bill_state']?>">
							</td>
						</tr>
						<tr>
							<td></td>
							<td>

<input class="red_btn" type="submit" name="submit" value="Update Information">
</form>
<?php
$Query="SELECT * from shipping_infor where user_id = '".$userContents['id']."'		";
$shipping_info = $commonObject->selectMultiRecords($Query);	

	 
	 
if( count($shipping_info) > 0)
{
?>
<!--	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="buypro" id="buypro">
-->	<form id="PayForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">    

	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
<!--	<input type="hidden" name="business" value="aliirizvi1975@hotmail.com">
-->	<input type="hidden" name="currency_code" value="USD">
	    <input type="hidden" name="business" value="saesd-facilitator@arhamsoft.com" />    

		<input type="hidden" name="item_number_1" value="<?php echo $cart[0]['pro_id']?>">
		<input type="hidden" name="item_name_1" value="<?php echo $cart[0]['title']?>">
		<input type="hidden" name="amount_1" value="<?=number_format($total_amount,2)?>">
		
		
<input class="red_btn" type="submit" name="submit" value="Go for Payment">
		
	<input type="hidden" name="quantity" value="1">	
		<input type="hidden" name="return" value="http://www.floatthat.net/thanks.php?item_number=deal">
		<input type="hidden" name="cancel_return" value="http://www.floatthat.net/cancel.php">
		<input type="hidden" name="amount" value="<?=number_format($total_amount,2)?>">
	
		
	</form>
				
<?php
}
?>
							</td>
						</tr>
					</table>
					
				</div><!--end checkout_content-->
			</div><!--end checkout_outer-->
			
<?php }?>
		
		</div><!--end sixteen-->
	</div><!--end container-->
	<!-- end the main content area -->



	<!-- start the footer area-->
	<?php require_once("footer.php");?>	
	<!--end the footer area -->


	<!-- JS
	================================================== -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <!-- jQuery.dropKick plug-in -->
    <link rel="stylesheet" href="js/dropKick/dropkick.css">
	<script src="js/dropKick/jquery.dropkick-1.0.0.js"></script>
	<!-- jQuery.nicescroll plug-in -->
	<script src="js/jquery.nicescroll.js"></script>
	<!-- jQuery.tweet plug-in -->
	<script src="js/jquery.tweet.js"></script>
	<!-- jQuery.cycle2 plug-in -->
	<script src="js/jquery.cycle2.min.js"></script>
	<script src="js/jquery.cycle2.tile.min.js"></script>
	<!-- jQuery.jcarousellite plug-in -->
	<script src="js/jcarousellite_1.0.1.min.js"></script>
	<!-- jQuery.fancybox plug-in -->
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css">
	<script src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<!-- jQuery.etalage plug-in -->
	<script src="js/jquery.etalage.min.js"></script>
	<!-- jQuery.cookie plug-in -->
	<script src="js/jquery.cookie.js"></script>
	<!--my custom code-->	
	<script src="js/main.js"></script>
	
<script>
$("#bill_country").val('<?php echo $shipping_info[0]['country']?>');
$("#country").val('<?php echo $shipping_info[0]['country']?>');
function validation()
{
	if($("#first_name").val() == "")
	{
		alert("Please enter your First Name");
		$("#first_name").focus();
		return false;
	}
	if($("#last_name").val() == "")
	{
		alert("Please enter your Last Name");
		$("#last_name").focus();
		return false;
	}
	if($("#address").val() == "")
	{
		alert("Please enter your Address");
		$("#address").focus();
		return false;
	}
	if($("#city").val() == "")
	{
		alert("Please enter your City");
		$("#city").focus();
		return false;
	}
	if($("#post_code").val() == "")
	{
		alert("Please enter your Post Code");
		$("#post_code").focus();
		return false;
	}	

	if($("#country").val() == "")
	{
		alert("Please enter your Country");
		$("#country").focus();
		return false;
	}
	if($("#state").val() == "")
	{
		alert("Please enter your State");
		$("#state").focus();
		return false;
	}
	


	if($("#bill_first_name").val() == "")
	{
		alert("Please enter your Billing First Name");
		$("#bill_first_name").focus();
		return false;
	}
	if($("#bill_last_name").val() == "")
	{
		alert("Please enter your Billing Last Name");
		$("#bill_last_name").focus();
		return false;
	}
	if($("#bill_address").val() == "")
	{
		alert("Please enter your Billing Address");
		$("#bill_address").focus();
		return false;
	}
	if($("#bill_city").val() == "")
	{
		alert("Please enter your Billing City");
		$("#bill_city").focus();
		return false;
	}
	if($("#bill_post_code").val() == "")
	{
		alert("Please enter your Billing Post Code");
		$("#bill_post_code").focus();
		return false;
	}	

	if($("#bill_country").val() == "")
	{
		alert("Please enter your Billing Country");
		$("#bill_country").focus();
		return false;
	}
	if($("#bill_state").val() == "")
	{
		alert("Please enter your Billing State");
		$("#bill_state").focus();
		return false;
	}
								
return true;
								
}
</script>	

<!-- End Document
================================================== -->
</body>
</html>