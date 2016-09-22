<?php
	require_once ("config.php");

	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM tbl_products products
			
			left join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.pro_id = '".$_GET['id']."'";
	$product_details = $commonObject->selectMultiRecords($Query);
	$i = 0;
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
	<link rel="stylesheet" href="css/product_detail.css">
    <link rel="stylesheet" href="css/home2.css">
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
					You're Here :: <a href="index.php">Home</a> &raquo; <?php echo $product_details[$i]['title']?> &raquo; Invite Your Friends </p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	<div class="container">

		<div class="sixteen columns">
			

			<div class="ten columns alpha">
	
		<?php 
				if($_GET['msg'] == "succ"){?>
				<div style="color:green; font-size:14px;">You invitation has been sent to your friends. <a href="float-deal.php?id=<?php echo $_GET['id']?>&type=<?php echo $_GET['type']?>" style="color:maroon; text-decoration:underline;">Click here to Go Back</a></div><br />
				<?php }
if($_GET['msg'] == "no"){?>
				<div style="color:red; font-size:14px;">Sorry you did not enter any email to float this product</div><br />
				<?php }				
				
				?>			
			
<form action="invite-friends-conf.php" method="post" name="frmIF">	
<input type="hidden" name="pro_id" id="pro_id" value="<?php echo $_GET['id']?>">	
	<input type="hidden" name="type" id="type" value="<?php echo $_GET['type']?>">

			<table width="940" align="center" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
				<td colspan="2">Invite Your Friends with their email address. ( Please separate multiple email addresses with coma.)</td>
			</tr>
			<tr>
				<td colspan="2"><textarea id="friends" name="friends" rows="10" cols="100"></textarea></td>
			</tr>
</table>
</form>	
				<!--end product_tabs-->
			</div><!--end ten-->


			<!--end six-->


			<!--end related_pro-->

		</div><!--end sixteen-->
							<ol>
								<li class="row clearfix">
									
									<div class="inputOuter button">
									&nbsp;&nbsp;&nbsp;<a href="#" onClick="document.frmIF.submit();" class="red_btn">Invite Friends</a>
									</div>									
								</li>
								
							</ol>
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