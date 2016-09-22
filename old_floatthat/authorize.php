<?php
require_once ("config.php");

//print_r($_SESSION['users_id']);
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


				
				
			

<div class="checkout_outer">
				
				
				<h2><span>Creadit Card Information</span></h2>
				<!--end checkout_content-->
			
			</div>
			<form method="post" action="float-deals-conf.php?id=<?php echo $_GET['id']?>" name="frmSI" onSubmit="return validation();">
<input type="hidden" name="pro_id" id="pro_id" value="<?php echo $_GET['id']?>">
<input type="hidden" name="type" id="type" value="<?php echo $_GET['type']?>">
<input type="hidden" name="list" id="list" value="<?php echo $_POST['list']?>">	
<input type="hidden" name="user_id" id="user_id" value="<?php echo $_POST['users_id']?>">	

<input type="hidden" name="cc" id="cc" value="yes">	

			<div class="checkout_outer">
				<div class="checkout_content billing_account clearfix">
					
					<table>
						<tr>
							<td>
								<strong>Deal Closing Date <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" size="12" id="inputField" name="closedate" id="closedate" value="<?php echo $_POST['closedate'];?>"/>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Phone Number <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="phone" id="phone" maxlength="16" size="25"/>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Payment Type <em>*</em></strong>
							</td>
							<td class="input">
								<input type="radio" name="ctype" id="ctype"  checked="checked"value="Visa"/> <img src="images/visa.png" /> <input type="radio" name="ctype" id="ctype" value="Master Card"/> <img src="images/master.png" /> <input type="radio" name="ctype" id="ctype" value="Discover"/> <img src="images/discover.png" /> <input type="radio" name="ctype" id="ctype" value="Amax"/> <img src="images/amax.png" />
							</td>
						</tr>
						<tr>
							<td>
								<strong>Card Number <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="cardnum" id="cardnum" maxlength="16" size="25"/>
							</td>
						</tr>
						<tr>
							<td>
								<strong>CSC <em>*</em></strong>
							</td>
							<td class="input">
								<input type="text" name="cscnum" id="cscnum" maxlength="4" size="25"/>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Expiry Date <em>*</em></strong>
							</td>
							<td class="input">
                                <input type="text" name="month" id="month" style="width:127px;" maxlength="2" size="5" /> // <input type="text" name="year" id="year" maxlength="4" size="5" style="width:127px;"/>
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
							<td></td>
							<td>

<input class="red_btn" type="submit" name="submit" value="Submit">
</td>
						
					</table>
				</form>	
				</div><!--end checkout_content-->
			</div><!--end checkout_outer-->

			<!--end checkout_outer-->
			

		
		</div><!--end sixteen-->
	</div><!--end container-->
	<!-- end the main content area -->



	<!-- start the footer area-->
	<?php require_once("footer.php");?>	
	<!--end the footer area -->


	<!-- JS
	================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
function validation()
{
	if($("#closedate").val() == "")
	{
		alert("Please enter your Deal Closing Date");
		$("#closedate").focus();
		return false;
	}
	if($("#phone").val() == "")
	{
		alert("Please enter your phone");
		$("#phone").focus();
		return false;
	}
	if($("#cardnum").val() == "")
	{
		alert("Please enter your Card Number");
		$("#cardnum").focus();
		return false;
	}
	if($("#cscnum").val() == "")
	{
		alert("Please enter your CSC");
		$("#cscnum").focus();
		return false;
	}
	if($("#month").val() == "")
	{
		alert("Please enter card exipiry date");
		$("#month").focus();
		return false;
	}	
	if($("#year").val() == "")
	{
		alert("Please enter card exipiry date");
		$("#year").focus();
		return false;
	}
	if($("#country").val() == "")
	{
		alert("Please enter your Country");
		$("#country").focus();
		return false;
	}

	


	
								
return true;
								
}
</script>	

<!-- End Document
================================================== -->
</body>
</html>