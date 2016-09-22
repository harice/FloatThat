<?php
	require_once ("config.php");

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
						You're Here :: <a href="index.php">Home</a> :: Reminder
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
							<h3>Reminder</h3>
						</div><!--end box_head -->

<?php

				
$deal_id = $_GET['deal_id'];

					
					$fusname=mysql_query("select * from tbl_deal where deal_id=$deal_id");
					$frname=mysql_fetch_array($fusname);
				
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$frname['pro_id']."'");
					$productdetail=mysql_fetch_array($productqry);
					
					
					
					$fmmsname=mysql_query("select * from tbl_members where deal_id=$deal_id");
					$countmem=mysql_num_rows($fmmsname);
					
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
						
							$totmem=$countmem;
if($user == "")
	$users = $userContents['user_id'];							
else
	$users = $user;							
					$username=mysql_query("select * from user_info where user_id=$users");
					    $uname=mysql_fetch_array($username);
		$user = '';					
							while($frname=mysql_fetch_array($fmmsname))
							{
					
					//$win=$winner;
			 	$fuser=$frname['user_id'];
					
					
					
					$shortmsg="This is reminder that ".$uname['name']." Floated " .$productdetail['title'].  " to ".$countmem." friends You have a 1 in".$countmem."  chance of owning this item. Winner will be announced on ".date('m-d-Y',strtotime($floatdate));
						
					$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					if($user != "")
					{
      				$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
					}
							}
				
			
				
	   ?>
    <div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px;" align="left">
    
    Reminder Sent Successfully <a href="<?php echo $apppath;?>my-account.php" target="_top"><input style="cursor:pointer;" type="button" value="Go Back" /></a>
    
    </div>
   
  
   
   <?php				
?>
						

					</div>
				</div><!--end nine-->



				<!--end seven-->

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
	
	

<!-- End Document
================================================== -->
</body>
</html>