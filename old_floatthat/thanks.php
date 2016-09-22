<?php
require_once ("config.php");
//echo "<pre>";
//print_r($userContent);
$date=date("Y-m-d G:i:s");
//echo $_SESSION['from'];

if( $_SESSION['current_session_id'] != '' && $_GET['item_number'] == 'deal' )// && $_SESSION['item_number'] == 'deal' 
{
	exit;
	$Query="SELECT * FROM sales WHERE sale_session_id= '".$_SESSION['current_session_id']."'";
	$sales_array = $commonObject->selectMultiRecords($Query);
		
	$query = "insert into tbl_buydeal(user_id , pro_id , date) values(
	'".$userContents['id']."',
	'".$sales_array[0]['pid']."',
	NOW()
	);";
	$result = mysql_query($query);
			
	$query = "update sales set status = 2 where sale_session_id = '".$_SESSION['current_session_id']."' and uid = '".$userContents['id']."' ";
	$rst = mysql_query($query);
	$_SESSION['current_session_id'] = '';
}
else
{

	if($_SESSION['product_id'] != "" && $_SESSION['from'] != "" && $_SESSION['deal_id'] != "")
	{
		mysql_query("insert into tbl_members(deal_id,user_id,date,status)values('".$_SESSION['deal_id']."','".$userContents['id']."','$date',1)");
	}
	else
	{
		// if($user == "")
		// 	$deal_id = $_GET['deal_id'];


		if(isset($_GET['deal_id'])){
			$deal_id = $_GET['deal_id'];
		}else{
			$deal_id = $_SESSION['deal_id'];
		}
		
		$seluid=mysql_query("select * from tbl_deal where deal_id=$deal_id");
		$deluid=mysql_fetch_array($seluid);
			$user = $deluid['user_id']; 
			
			mysql_query("update tbl_members set status='1' where deal_id=$deal_id and user_id=$user");
			mysql_query("update tbl_deal set status='1' where deal_id=$deal_id");
	} 
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
						You're Here :: <a href="index.php">Home</a> :: Payment Success
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
							<h3>Payment Successful</h3>
						</div><!--end box_head -->

						<h6>&nbsp;</h6>

<?php if($type == "deal"){?>
Your payment has been received, We will proceed your order shortly.
	<?php } elseif($type == "group")
	{?>
Your payment has been received, We will proceed your order shortly. 	
	<?php }elseif($type == "float")
	{?>
Your payment has been received, We will proceed your order shortly. 	
	<?php }?>	<br />	<br /><br /><br /><br /><br /><br /><br />			
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
	
	


<!-- End Document
================================================== -->
</body>
</html>