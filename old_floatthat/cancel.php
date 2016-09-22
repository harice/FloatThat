<?php
require_once ("config.php");

$_SESSION['current_session_id'] = '';
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
	<link rel="stylesheet" href="css/user_log.css">
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
						You're Here :: <a href="index.php">Home</a> :: Cancel Order
					</p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	
	<div class="container">

			<div id="user_log" class="clearfix">

				<!--end nine-->



				<div class="seven columns">
					<div class="login">
						<div class="box_head">
							<h3>Cancel Order</h3>
						</div><!--end box_head -->

						<h6>&nbsp;</h6>

We are sorry your order  has been cancled Please check your card information.<br />	<br /><br /><br /><br /><br /><br /><br />			
					</div><!--end login-->


					<!--<div class="account_list">

						<div class="box_head">
							<h3>Account</h3>
						</div>

							<ul>
								<li><a href="#">Account</a></li>
								<li><a href="#">Edit Account</a></li>
								<li><a href="#">Password</a></li>
								<li><a href="#">Wish List</a></li>
								<li><a href="#">Order History</a></li>
								<li><a href="#">DownLoads</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Transactions</a></li>
								<li><a href="#">Newslatter</a></li>
								<li><a href="#">Logout</a></li>
							</ul>

					</div>--><!--end account_list-->
					
				</div><!--end seven-->

			</div><!--end user_log-->

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

function check_email()
{

	

		$.ajax(

			   { 

					type: "POST", 

					url: "./check-email.php", 

					data: 

					{

						mail:$("#mail").val() 

					}, 

					success: 

					function(response)																																																	   		 			{
						if(response == "exist")
						{
							alert("Email already exist, Please try with other email address.");
							$("#mail").focus();
							return false;
						}
					}//end function

			 });

	
	
}

function rsubmit()
{
	if($("#firstName").val() == "")
	{
		alert("Please enter your First Name");
		$("#firstName").focus();
		return false;
	}
	if($("#secondName").val() == "")
	{
		alert("Please enter your Last Name");
		$("#secondName").focus();
		return false;
	}
	if($("#mail").val() == "")
	{
		alert("Please enter your Email");
		$("#mail").focus();
		return false;
	}
	else
	{
	     var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(!emailReg.test($('#mail').val()))	
		{
			$('#mail').focus();
			alert("Enter a valid email address.");			
			return false;
		}

		$.ajax(

			   { 

					type: "POST", 

					url: "./check-email.php", 

					data: 

					{

						mail:$("#mail").val() 

					}, 

					success: 

					function(response)																																																	   		 			{
						if(response == "exist")
						{
							alert("Email already exist, Please try with other email address.");
							$("#mail").focus();
							return false;
						}
					}//end function

			 });

	
	}		
/*<!--	if($("#city").val() == "")
	{
		alert("Please enter your City Name");
		$("#city").focus();
		return false;
	}
	if($("#postCode").val() == "")
	{
		alert("Please enter your PostCode");
		$("#postCode").focus();
		return false;
	}
	if($("#contury").val() == "")
	{
		alert("Please select you County");
		$("#contury").focus();
		return false;
	}
	if($("#state").val() == "")
	{
		alert("Please select you State");
		$("#state").focus();
		return false;
	}	-->*/
	var passwrd = $("#pass").val(); 
	if(passwrd.length < 8)
	{
		alert("Password should be greater then 8 chracters.");
		$("#pass").focus();
		return false;
	}		
	if($("#pass").val() == "")
	{
		alert("Please enter your password");
		$("#pass").focus();
		return false;
	}
	if($("#coPass").val() == "")
	{
		alert("Please enter confirm password");
		$("#coPass").focus();
		return false;
	}
	if($("#pass").val() != $("#coPass").val())
	{
		alert("Password and Confirm Password are not same.");
		$("#pass").focus();
		return false;
	}			
	document.frmRegister.submit();
}

function ssubmit()
{
	if($("#email").val() == "")
	{
		alert("Please enter your email address");
		return false;
	}
	if($("#password").val() == "")
	{
		alert("Please enter your password");
		return false;
	}	
	document.frmLogin.submit();
}

</script>

<!-- End Document
================================================== -->
</body>
</html>