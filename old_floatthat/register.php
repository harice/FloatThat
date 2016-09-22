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
						You're Here :: <a href="index.php">Home</a> :: Login Or Create a New Account
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

				<div class="nine columns">
					<div class="register">
						<div class="box_head">
							<h3>Create Account</h3>
						</div><!--end box_head -->

						<h6>Already have account, Login on right side.</h6>
	<?php if($_GET['msg'] == "succ"){?>
				<div style="color:green; font-size:14px;">Your account has been created. Enjoy your shopping .....</div><br />
				<?php }?>
				
				
						<form name="frmRegister" id="frmRegister" method="post" action="register-conf.php" onSubmit="return rsubmit();" enctype="multipart/form-data">
							<ol>
								<li class="row clearfix">
									<label class="input_tag" for="firstName">First Name <em>*</em></label>
									<div class="inputOuter">
									<input id="firstName" type="text" name="firstName" value="" placeholder="John">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="secondName">Last Name <em>*</em></label>
									<div class="inputOuter">
									<input id="secondName" type="text" name="secondName" value="" placeholder="Smith">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="email">Your E-Mail <em>*</em></label>
									<div class="inputOuter">
									<input id="mail" type="text" name="mail" value=""  onBlur="check_email();"placeholder="example@example.com">
									</div>
								</li>
<!--								<li class="row clearfix">
									<label class="input_tag" for="tele">Telephone <em></em></label>
									<div class="inputOuter">
									<input id="tele" type="text" name="tele" value="" placeholder="0126598745 or 555-987-456">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="fax">Your FAX</label>
									<div class="inputOuter">
									<input id="fax" type="text" name="fax" value="" placeholder="Optional">
									</div>
								</li>
-->							</ol>

							
								
<!--						<ol>		<li class="row clearfix">
									<label class="input_tag" for="firstAddress">First Address <em>*</em></label>
									<div class="inputOuter">
									<input id="firstAddress" type="text" name="firstAddress" value="" placeholder="2st, abd-elhahim, Shoubra, Cairo">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="secondAddress">second Address</label>
									<div class="inputOuter">
									<input id="secondAddress" type="text" name="secondAddress" value="" placeholder="Optional">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="city">city <em>*</em></label>
									<div class="inputOuter">
									<input id="city" type="text" name="city" value="" placeholder="Cairo">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="postCode">Post Code <em>*</em></label>
									<div class="inputOuter">
									<input id="postCode" type="text" name="postCode" value="" placeholder="12345">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="contury">contury <em>*</em></label>
									<div class="inputOuter">
									<select id="contury" name="contury" class="default" tabindex="1">
										<option value="">-- Your Country --</option>
										<option value="USA">USA</option>
									</select>
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="region">Region/Stats <em>*</em></label>
									<div class="inputOuter">
									<select id="region" name="state" class="default" tabindex="1">
										<option value="">-- Your Regoin --</option>
										<option value="text1">text1</option>
										<option value="text2">text2</option>
										<option value="text3">text3</option>
									</select>
									</div>
								</li>
								</ol>
-->							

							<ol>
								<li class="row clearfix">
									<label class="input_tag" for="chPass">Choose Password <em>*</em></label>
									<div class="inputOuter">
									<input id="pass" type="password" name="pass" value="" placeholder="********************">
									(minimum 4 characters)
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="coPass">Confirm Password <em>*</em></label>
									<div class="inputOuter">
									<input id="coPass" type="password" name="coPass" value="" placeholder="********************">
									</div>
								</li>
							</ol>

							<ol>
								<li class="row clearfix">
									<label class="input_tag">Profile Picture <em></em></label>
									<div class="inputOuter">
									<input id="avatar" name="avatar" type="file" >
									<input id="avatar1" name="avatar1" value="<?php echo $userContents['pic']?>" type="hidden" >
									<br>

									</div>
								</li>
							</ol>
<!--
							<ol>
								<li class="row clearfix">
									<label class="input_tag" for="checkbox1">Privacy Policy <em>*</em></label>
									<div class="inputOuter">
									<input type="checkbox" name="agress" value="1" id="checkbox1">
									<label for="checkbox1">I Readed it</label><br><br>
									<a href="#">Read and Know Privacy Policy</a>
									</div>
								</li>
							</ol>-->

							<ol>
								<li class="row clearfix">
									<label class="input_tag" for="firstName">&nbsp;</label>
									<div class="inputOuter button">
									<input type='submit' name='submit' value='Create Account' />
									</div>
								</li>
							</ol>
						</form>

					</div>
				</div><!--end nine-->



				<div class="seven columns">
					<div class="login">
						<div class="box_head">
							<h3>Login</h3>
						</div><!--end box_head -->

						<h6>Don't have account, register on left side.</h6>
	<?php if($_GET['msg'] == "invalid"){?>
				<div style="color:red; font-size:14px;">You have entered a wrong username or password.</div><br />
				<?php }?>
						<form action="validation.php" class="section" method="post" id="frmLogin" name="frmLogin" onSubmit="return login();">
					<input type="hidden" name="sec" id="sec" value="<?php echo md5("s4shahid79@hotmail.com");?>" />
					<input type="hidden" name="cart" id="cart" value="<?php echo $_GET['cart'];?>" />
							<ol>
								<li class="row clearfix">
									<label class="input_tag" for="mail">E-Mail <em>*</em></label>
									<div class="inputOuter">
									<input id="email" type="text" name="email" value="" placeholder="example@example.com">
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="pass">Password <em>*</em></label>
									<div class="inputOuter">
									<input id="password" type="password" name="password" value="" placeholder="**********">
									<small><a href="forgot-password.php">Forget your Password?</a></small>
									</div>
								</li>
								<li class="row clearfix">
									<label class="input_tag" for="firstName">&nbsp;</label>
									<div class="inputOuter button">
									<input type='submit' name='signin'  value='Sign in' />
                                    &nbsp;
                                    									</div>
																		
					<?php
						if(trim($userContents['email']) == "")
						{
						?>
                        <div style="text-align:center; margin:40px 0;">
                    	<a href="<?php echo $loginUrl;?>"><img src="images/login_fb.png" width="" height="" alt="facebook connect"></a>
						<a href="login-twitter.php?login&oauth_provider=twitter"><img src="images/login_tw.png"  alt="twitter connect"></a>
<!--                        <a href="login-instagram.php?login&oauth_provider=instagram"><img src="images/login_in.png"  alt="instagram connect"></a>
-->						</div>
						<?php
						}
						?>
																								
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
						return true;
					}//end function

			 });

	
	}		
/*	if($("#city").val() == "")
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
	}	*/
	var passwrd = $("#pass").val(); 
	if(passwrd.length < 4)
	{
		alert("Password should be minimum of 4 chracters.");
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
	//document.frmRegister.submit();
return true;

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