<?php
require_once ("config.php");

if($userContents['email'] != "")
{
	header("Location: index.php");
	exit;
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
						You're Here :: <a href="index.php">Home</a> :: Forgot Password
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
							<h3>Forgot Password</h3>
						</div><!--end box_head -->

						<h6>Don't remember your password.</h6>
	<?php if($_GET['msg'] == "succ"){?>
				<div style="color:green; font-size:14px;">Your account information has been send on your email.</div><br />
				<?php }?>
	<?php if($_GET['msg'] == "no"){?>
				<div style="color:red; font-size:14px;">Your email does not exist, Please enter correct email.</div><br />
				<?php }?>				
						<form action="forgot_password_conf.php" class="section" method="post" id="frmFP" name="frmFP" onSubmit="return fp();">
					<input type="hidden" name="sec" id="sec" value="<?php echo md5("s4shahid79@hotmail.com");?>" />
							<ol>
								<li class="row clearfix">
									<label class="input_tag" for="mail">E-Mail <em>*</em></label>
									<div class="inputOuter">
									<input id="email" type="text" name="email" value="" placeholder="example@example.com">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="firstName">&nbsp;</label>
									<div class="inputOuter button">
									<input type="submit" name="submit" value="submit" class="red_btn">
									</div>
								</li>
							</ol>
						</form>
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
function fp()
{
	if($("#email").val() == "")
	{
		alert("Please enter your Email");
		$("#email").focus();
		return false;
	}
	else
	{
	     var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(!emailReg.test($('#email').val()))	
		{
			$('#email').focus();
			alert("Enter a valid email address.");			
			return false;
		}
	}
	return true;	
}



</script>

<!-- End Document
================================================== -->
</body>
</html>