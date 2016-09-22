<?php
require_once ("config.php");


if(!isset($_SESSION) || !isset($_SESSION['onlineSessionMemberTime']) ){
	
	header("Location: index.php");
	exit;
}


if($_GET['id'] != "" && $_GET['from'] != "" && $_GET['deal_id'] != "")
{
	$_SESSION['product_id'] = $_GET['id'];
	$_SESSION['from'] = $_GET['from'];
	$_SESSION['deal_id'] = $_GET['deal_id'];
	$show_button = 1;
	
}else{
	unset($_SESSION['product_id']);
	unset($_SESSION['from']);
	unset($_SESSION['deal_id']);
}
if($_SESSION['product_id'] != "" && $_SESSION['from'] != "" && $_SESSION['deal_id'] != "")
{
	$show_button = 1;
}


	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail, products.thumb
			
			FROM tbl_products products
			
			left join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.pro_id = '".$_GET['id']."'";
	$product_details = $commonObject->selectMultiRecords($Query);
	$i = 0;
	
/*	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM related_products relp
			
			inner join  tbl_products as products on relp.related_pro_ids = products.pro_id
			left join tbl_photos as photos on photos.pro_id = relp.related_pro_ids
			
			where relp.pro_id = '".$_GET['id']."'";
	$related_products = $commonObject->selectMultiRecords($Query);*/
	 if(isset($userContents['user_id']) and $userContents['user_id']!=="")
	 
	 		{
				$date= date('Y-m-d');
				$uid=$userContents['user_id'];
				$pid=$_GET['id'];
				
				
				$check=mysql_query("select * from tbl_visiters where date='".$date."' and user_id='".$uid."' and pro_id=$pid");
				$nmrow=mysql_num_rows($check);
				if($nmrow==0)
				{
				
		 		mysql_query("insert into tbl_visiters(pro_id,user_id,date,visits) values($pid,'$uid','$date',1)");
				}
				else
				{
					mysql_query("update tbl_visiters set visits= visits + 1 where date='".$date."' and user_id='".$uid."' and pro_id=$pid");	
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
					You're Here :: <a href="index.php">Home</a> &raquo; <?php echo $product_details[$i]['title']?></p>
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

				<div class="product_img">
					<ul id="etalage">
				<?php
				for($i=0;$i<count($product_details);$i++)
				{	
				?>	
					<li>
						<a href="images/products/image1_large.jpg">
						<img class="etalage_thumb_image" src="./wadmin/gallaryimg/gallaryphotos/<?php echo $product_details[$i]['image']?>" alt="">
						<img class="etalage_source_image" src="./wadmin/gallaryimg/gallaryphotos/<?php echo $product_details[$i]['image']?>" alt="">
						</a>
					</li>
				<?php
				}
				$i=0;
				?>	
<!--					<li>
						<a href="images/products/image5_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image5_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image5_large.jpg" alt="">
						</a>
					</li>
					<li>
						<a href="images/products/image2_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image2_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image2_large.jpg" alt="">
						</a>
					</li>
					<li>
						<a href="images/products/image1_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image1_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image1_large.jpg" alt="">
						</a>
					</li>
					<li>
						<a href="images/products/image3_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image3_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image3_large.jpg" alt="">
						</a>
					</li>
					<li>
						<a href="images/products/image5_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image5_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image5_large.jpg" alt="">
						</a>
					</li>
					<li>
						<a href="images/products/image2_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image2_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image2_large.jpg" alt="">
						</a>
					</li>
					<li>
						<a href="images/products/image4_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image4_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image4_large.jpg" alt="">
						</a>
					</li>
					<li>
						<a href="images/products/image5_large.jpg">
						<img class="etalage_thumb_image" src="images/products/image5_thumb.jpg" alt="">
						<img class="etalage_source_image" src="images/products/image5_large.jpg" alt="">
						</a>
					</li>
-->					</ul>
					<div id="hidden"><div id="zoom"></div></div>
				</div><!--end product_img-->
			</div><!--end ten-->


			<div class="six columns omega">
				<div class="product_desc">
<?php
if($_SESSION['product_id'] != "" && $_SESSION['from'] != "" && $_SESSION['deal_id'] != "")
{			
?>	
					<div class="pro_desc_conent">
				<?php
				$Query = mysql_query("SELECT * FROM tbl_deal WHERE deal_id  = '".$_SESSION['deal_id']."'");
				$deals = mysql_fetch_array($Query);			
				$amount = ($product_details[$i]['price'] / ($deals['ods']));		
				?>	
						<h6>Your Contribution: $<?php echo number_format($amount,2)?></h6>
						<?php
						if($userContents['id'] > 0)
						{
						?>
						<a href="payments.php" class="red_btn"> Make Payment</a>
						<?php
						}
						else
						{
						?>
						<a href="register.php" class="red_btn">Make Payment</a>
						<?php
						}
						?>
					</div>
<?php
}
?>					
					<div class="pro_desc_conent">
						<h6><?php echo $product_details[$i]['title']?></h6>
					</div>
					<div class="pro_desc_conent">
						<h5>$<?php echo number_format($product_details[$i]['price'],2)?></h5>
					</div>
					<div class="pro_desc_conent">
						<div class="pro_desc_list">
						<ul>
							<li><strong>Product Code:</strong><?php echo $product_details[$i]['product_code']?></li>
							<li><strong>Menufacturer:</strong> <?php echo $product_details[$i]['menufacturer']?></li>
							<li><strong>Availability:</strong> <?php echo $product_details[$i]['in_stock']?></li>
						</ul>
						</div><!--end pro_desc_list-->

						<!--end pro_desc_rate-->
<?php
if($_SESSION['product_id'] != "" && $_SESSION['from'] != "" && $_SESSION['deal_id'] != "")
{		
}else
{	
?>	
						<div class="inputs clearfix">
							<!--end form-->
							<div class="floatbtn_bg" style="margin-left:-15px;">
                            <a class="large_btn" href="select-members.php?id=<?php echo $_GET['id']?>&type=float">Float Deal</a>
                            </div>
							<ul class="pro_buttons" style="float:left; padding-left:15px;">
								<li><a class="red_btn" href="add-to-cart.php?id=<?php echo $_GET['id']?>">Buy Deal</a></li>
								<li><a class="red_btn" href="select-members.php?id=<?php echo $_GET['id']?>&type=group">Group Purchase</a></li>
								<li class="deal_on">Deal is On</li>
							</ul>

<?php
}
?>						</div><!--end inputs-->
						
					</div>

				</div><!--end product_desc-->
			</div><!--end six-->


			<div class="ten columns alpha">
				<div class="product_tabs">
<?php echo $product_details[$i]['detail']?>
					<!--end tabs-->

				</div><!--end product_tabs-->
			</div><!--end ten-->


			<!--end six-->


<!--			<div class="related_pro">

				<div class="box_head">
					<h3>Related Products</h3>
					<div class="pagers center">
						<a class="prev related_prev" href="#prev">Prev</a>
						<a class="nxt related_nxt" href="#nxt">Next</a>
					</div>
				</div>

				<div class="pro_relates_content">

<?php
if(count($related_products) > 0)
{
?>			
				<ul class="product_show">
				<?php
				for($i=0;$i<count($related_products);$i++)
				{	
				?>
					<li>
						<div class="img">
							<div class="hover_over">
								<a class="link" href="product-details.php?id=<?php echo $related_products[$i]['pro_id']?>">link</a>
								<a class="cart" href="product-details.php?id=<?php echo $related_products[$i]['pro_id']?>">cart</a>
							</div>
							<a href="product-details.php?id=<?php echo $related_products[$i]['pro_id']?>">
								<img src="images/photos/four_column1.jpg" alt="product">
							</a>
						</div>
						<h6><a href="product-details.php?id=<?php echo $related_products[$i]['pro_id']?>"><?php echo $feature_deals[$i]['title']?></a></h6>
						<h5>$<?php echo number_format($feature_deals[$i]['price'],2)?></h5>
					</li>
				<?php
				}
				?>	
				</ul>
<?php
}
?>-->
				
				<!--<ul class="product_show">
					<li>
						<div class="img">
							<div class="hover_over">
								<a class="link" href="#">link</a>
								<a class="cart" href="#">cart</a>
							</div>
							<a href="#">
								<img src="images/photos/four_column1.jpg" alt="product">
							</a>
						</div>
						<h6><a href="#">Product Name Here</a></h6>
						<h5>$40.90</h5>
					</li>
					<li>
						<div class="img">
							<div class="hover_over">
								<a class="link" href="#">link</a>
								<a class="cart" href="#">cart</a>
							</div>
							<a href="#">
								<img src="images/photos/four_column2.jpg" alt="product">
							</a>
						</div>
						<h6><a href="#">Product Name Here</a></h6>
						<h5>$130.90</h5>
					</li>
					<li>
						<div class="img">
							<div class="offer_icon"></div>
							<div class="hover_over">
								<a class="link" href="#">link</a>
								<a class="cart" href="#">cart</a>
							</div>
							<a href="#">
								<img src="images/photos/four_column5.jpg" alt="product">
							</a>
						</div>
						<h6><a href="#">Product Name Here</a></h6>
						<h5><span class="sale_offer">$210.00</span>&nbsp;&nbsp;&nbsp;&nbsp;$194.90</h5>
					</li>
					<li>
						<div class="img">
							<div class="hover_over">
								<a class="link" href="#">link</a>
								<a class="cart" href="#">cart</a>
							</div>
							<a href="#">
								<img src="images/photos/four_column3.jpg" alt="product">
							</a>
						</div>
						<h6><a href="#">Product Name Here</a></h6>
						<h5>$200.00</h5>
					</li>
				</ul>-->
				<!--</div>--><!--end pro_relates_content-->
			<!--</div>--><!--end related_pro-->

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
	

<!-- End Document
================================================== -->
</body>
</html>