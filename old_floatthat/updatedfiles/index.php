<?php
	require_once ("config.php");

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: login-twitter.php");
		exit;
    } //else if ($oauth_provider == 'facebook') {
        //header("Location: login-facebook.php");
    //}
}

	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM tbl_products products
			
			inner join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.featured = 1 and products.status = 1
			
			group by products.pro_id
			
			order by products.pro_id desc limit 0,20";
	$feature_deals = $commonObject->selectMultiRecords($Query);


	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM tbl_products products
			
			inner join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.featured = 1
			
			group by products.pro_id
			
			order by products.pro_id desc limit 0,20";
	$all_deals = $commonObject->selectMultiRecords($Query);

	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM tbl_products products
			
			inner join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.featured = 1
			
			group by products.pro_id
			
			order by products.pro_id desc limit 0,20";
	$all_products = $commonObject->selectMultiRecords($Query);

	
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
<script src="fb_user.js"></script>
</head>
<body>

	<!--start header-->
	<?php require_once("header.php");?>
	<!--end header-->



	<div class="container">
		<div class="sixteen columns">
			
			<div id="slide_outer">
				<div class="mainslide">

					<div class="pagers center">
						<a class="prev slide_prev" href="#prev">Prev</a>
						<a class="nxt slide_nxt" href="#nxt">Next</a>
					</div>

					<ul class="cycle-slideshow clearfix" 
			        data-cycle-fx="scrollHorz"
			        data-cycle-timeout="5000"
			        data-cycle-slides="> li"
			        data-cycle-pause-on-hover="true"
			        data-cycle-prev="div.pagers a.slide_prev"
			        data-cycle-next="div.pagers a.slide_nxt" >
<?php
if(count($feature_deals) > 0)
{
?>			
				<?php
				for($i=0;$i<count($feature_deals);$i++)
				{	
				?>
				  <li class="clearfix">
							<div class="slide_img">
								<img src="./wadmin/gallaryimg/gallaryphotos/<?php echo $feature_deals[$i]['image']?>" alt="">
							</div>
							<div class="flex-caption">
								<h5><span><?php echo $feature_deals[$i]['title']?></span></h5>
								<p>
									<?php echo $feature_deals[$i]['detail']?>
								</p>
                                
								<a href="product-details.php?id=<?php echo $feature_deals[$i]['pro_id']?>"><span>View Details</span><span class="shadow">$<?php echo number_format($feature_deals[$i]['price'],2)?></span></a>
							</div>
						</li>
				<?php
				}
				?>	
<?php
}
?>					
					</ul>
				</div>
				<div class="shadow_left"></div>
				<div class="shadow_right"></div>
			</div>

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	
	<div class="container sixteen columns">

		
		<div class="featured">
			<div class="box_head">
				<h3>Featured Deals</h3>
				<div class="pagers center">
					<a class="prev featuredPrev" href="#prev">Prev</a>
					<a class="nxt featuredNxt" href="#nxt">Next</a>
				</div>
			</div><!--end box_head -->
		

			<div class="cycle-slideshow" 
	        data-cycle-fx="scrollHorz"
	        data-cycle-timeout=0
	        data-cycle-slides="> ul"
	        data-cycle-prev="div.pagers a.featuredPrev"
	        data-cycle-next="div.pagers a.featuredNxt"
	        >
<?php
if(count($feature_deals) > 0)
{
?>			
				<ul class="product_show">
				<?php
				for($i=1;$i<=count($feature_deals);$i++)
				{	
				?>
					<li class="column">
						<div class="img">
							<!--<div class="hover_over">
								<a class="link" href="product-details.php?id=<?php echo $feature_deals[$i-1]['pro_id']?>">link</a>
								<a class="cart" href="product-details.php?id=<?php echo $feature_deals[$i-1]['pro_id']?>">cart</a>
							</div>-->
							<a href="product-details.php?id=<?php echo $feature_deals[$i-1]['pro_id']?>">
								<img src="./wadmin/gallaryimg/thumbnails/<?php echo $feature_deals[$i-1]['image']?>" alt="product">
							</a>
						</div>
						<h6><a href="product-details.php?id=<?php echo $feature_deals[$i-1]['pro_id']?>"><?php echo $feature_deals[$i-1]['title']?></a></h6>
                        <p style="height:50px;"  align="left"><?php echo substr($feature_deals[$i-1]['detail'], 0, 100);?> ...</p>
						<h5>$<?php echo number_format($feature_deals[$i-1]['price'],2)?></h5>
                        <p>
                              <div class="addthis_toolbox addthis_default_style ">
                                <a class="addthis_button_preferred_1"></a>
                                <a class="addthis_button_preferred_2"></a>
                                <a class="addthis_button_preferred_3"></a>
                                <a class="addthis_button_compact"></a>
                                <a class="addthis_counter addthis_bubble_style"></a>
                               </div>
                        </p>
					</li>
				<?php
					if(($i % 4 ) == 0 && $i > 1)
					{
					?>
					</ul>
					<ul class="product_show">
					<?php
					}
				}
				?>	
				</ul>
<?php
}
?>				
				
			</div>
		</div><!--end featured-->


		<div class="latest">
			
			<div class="box_head">
				<h3>All Deals</h3>
				<div class="pagers center">
					<a class="prev latest_prev" href="#prev">Prev</a>
					<a class="nxt latest_nxt" href="#nxt">Next</a>
				</div>
			</div><!--end box_head -->

			<div class="cycle-slideshow" 
	        data-cycle-fx="scrollHorz"
	        data-cycle-timeout=0
	        data-cycle-slides="> ul"
	        data-cycle-prev="div.pagers a.latest_prev"
	        data-cycle-next="div.pagers a.latest_nxt"
	        >
<?php
if(count($all_deals) > 0)
{

?>			
				<ul class="product_show">
				<?php
				for($i=1;$i<=count($all_deals);$i++)
				{	
				?>
					<li class="column">
						<div class="img">
							<!--<div class="hover_over">
								<a class="link" href="product-details.php?id=<?php echo $all_deals[$i-1]['pro_id']?>">link</a>
								<a class="cart" href="product-details.php?id=<?php echo $all_deals[$i-1]['pro_id']?>">cart</a>
							</div>-->
							<a href="product-details.php?id=<?php echo $all_deals[$i-1]['pro_id']?>">
								<img src="./wadmin/gallaryimg/thumbnails/<?php echo $all_deals[$i-1]['image']?>" alt="product">
							</a>
						</div>
						<h6><a href="product-details.php?id=<?php echo $all_deals[$i-1]['pro_id']?>"><?php echo $all_deals[$i-1]['title']?></a></h6>
                        <p style="height:50px;"  align="left"><?php echo substr($all_deals[$i-1]['detail'], 0, 100);?> ...</p>
						<h5>$<?php echo number_format($all_deals[$i-1]['price'],2)?></h5>
                        <p>                              
                        		<div class="addthis_toolbox addthis_default_style ">
                                <a class="addthis_button_preferred_1"></a>
                                <a class="addthis_button_preferred_2"></a>
                                <a class="addthis_button_preferred_3"></a>
                                <a class="addthis_button_compact"></a>
                                <a class="addthis_counter addthis_bubble_style"></a>
                               </div>
                        </p>
					</li>
				<?php
					if(($i % 4 ) == 0 && $i > 1)
					{
					?>
					</ul>
					<ul class="product_show">
					<?php
					}				
				}
				?>	
				</ul>
<?php
}
?>				
			</div>
		</div><!--end latest-->
		


		<div class="sixteen columns clearfix">
			<div class="ten columns alpha">
				<div class="welcome">
					<div class="clearfix">
						<h2>Welcome To Float That</h2>
						<p>
							FloatThat is your source for millions of products from the leading automotive aftermarket brands. We carry all part numbers for every product we sell - if they make it, we have it. We get the newest part numbers faster, so you can get them on your vehicle sooner, so you can get them on your vehicle sooner.
						</p>
						<p>
							World-Class, US-Based Customer Service and Product Support is just a toll-free phone call away. Product Knowledge at Your Fingertips - Impartial Customer Reviews, Videos, Research Guides, Articles and More.
						</p>
						<h4 style="margin-top:17px !important;">Our payment methods:</h4>
						<img src="./images/cc.gif">
					</div>
				</div><!--end welcome-->
			</div><!--end ten-->

			<div class="six columns omega">
				<div class="home_news">
					<h3>Now, Get Your Free Shopping</h3>
					<div class="acc">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi malesuada, ante at feugiat tincidunt, enim massa gravida metus, commodo lacinia massa diam vel eros. Proin eget urna. Nunc fringilla neque vitae odio. Vivamus vitae ligula.</p>
					</div>
				
					<h3>Super easy to customize anything</h3>
					<div class="acc">
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi malesuada, ante at feugiat tincidunt, enim massa gravida metus, commodo lacinia massa diam vel eros. Proin eget urna. Nunc fringilla neque vitae odio. Vivamus vitae ligula.
						</p>
					</div>

				

					<h3>Signup and save your money</h3>
					<div class="acc">
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi malesuada, ante at feugiat tincidunt, enim massa gravida metus, commodo lacinia massa diam vel eros. Proin eget urna. Nunc fringilla neque vitae odio. Vivamus vitae ligula.
						</p>
					</div>
				</div><!--end home_news-->
			</div><!--end six-->
		</div><!--end sixteen-->


		<div class="sixteen columns">
			<div class="brands">

				<div class="box_head">
					<h3>PRODUCTS</h3>
					<div class="pagers center">
						<a class="prev brand_prev" href="#prev">Prev</a>
						<a class="nxt brand_nxt" href="#nxt">Next</a>
					</div>
				</div><!--end box_head -->

				<div class="brandOuter">
<?php

if(count($all_products) > 0)
{
//echo count($all_products);
//echo "i am here";
?>			
				<ul>
					<?php
					for($i=0;$i<count($all_products);$i++)
					{	
					//echo $i;
					//echo "i am here";
					?>
						<li>
								<a href="product-details.php?id=<?php echo $all_products[$i]['pro_id']?>">
									<img src="./wadmin/gallaryimg/thumbnails/<?php echo $all_products[$i]['image']?>" alt="brand">
								</a>
							</li>
					<?php
					}
					?>	
				</ul>
<?php
}
?>				
				</div>
			</div><!--end brands-->
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
	

<!-- End Document
================================================== -->
</body>
</html>