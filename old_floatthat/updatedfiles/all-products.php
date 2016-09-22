<?php
	require_once ("config.php");
	if($_GET['type'] == "feature")
	{
		$feature = 'class="current_nav"';
		$label = "Feature Deals";
		$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
				
				FROM tbl_products products
				
				left join tbl_photos as photos on photos.pro_id = products.pro_id
				
				where products.featured = 1 and products.status = 1
				
				group by products.pro_id
				
				order by products.pro_id desc";
		//$deals = $commonObject->selectMultiRecords($Query);
	}
	else
	{
		$all = 'class="current_nav"';
		$label = "All Deals";
		$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
				
				FROM tbl_products products
				
				left join tbl_photos as photos on photos.pro_id = products.pro_id
				
				where products.featured = 1
				
				group by products.pro_id
				
				order by products.pro_id ";
		//$deals = $commonObject->selectMultiRecords($Query);		
	}	
	$pager = new PS_Pagination($Query, 8, 5, "type=".$_GET['type']);
	$deals = $pager->paginate();
	//Display the full navigation in one go		
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
	<meta name="author" content="Hassan Shahbaz">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/category_4cols.css">
	<link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/home2.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<link rel="stylesheet" type="text/css" href="css/ie8-and-down.css" />
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

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
						You're Here :: <a href="index.php">Home</a> &raquo; <?php echo $label;?>.
					</p>
					
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	
	<div class="container sixteen columns">
		
			<!--<div class="products_filter">

				<div class="filter_content clearfix">

					<div class="pro_category clearfix">
						<strong>Category</strong>
						<form method="" action="" class="clearfix">
						<select name="product_category" class="default" tabindex="1">
							<option value="Default">Category</option>
							<option value="">Desktop</option>
							<option value="">-- PC</option>
							<option value="">-- MAC</option>
							<option value="">LapTops</option>
							<option value="">Compoinient</option>
							<option value="">-- Mointors</option>
							<option value="">-- Printers</option>
							<option value="">-- Scanners</option>
							<option value="">Tablets</option>
							<option value="">SoftWare</option>
						</select>
						</form>
					</div>

					<div class="pro_sort clearfix">
						<strong>Sort By:</strong>
						<form method="" action="" class="clearfix">
						<select name="product_sort" class="default" tabindex="1">
							<option value="Default">Default</option>
							<option value="">Name (A-A)</option>
							<option value="">Name (Z-A)</option>
							<option value="">Price (Low-Hight)</option>
							<option value="">Price (Height-Low)</option>
							<option value="">Highest Rating</option>
							<option value="">Lowest Rating</option>
							<option value="">Model (A-Z)</option>
							<option value="">Model (Z-A)</option>
						</select>
						</form>
					</div>

					<div class="pro_number">
						<strong>View:</strong>
						<form method="#" action="#" class="clearfix">
						<select name="product_number" class="default" tabindex="1">
							<option value="15">15</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="75">75</option>
							<option value="100">100</option>
						</select>
						</form>
					</div>

					<div class="pro_compare">
						<a href="#">Product Compare ( <span>0</span> )</a>
					</div>

				</div>

			</div>--><!--end product_filter-->  
		
        <div class="latest">
		<ul class="product_show clearfix">

<?php
if(count($deals) > 0)
{
?>			
				<?php
				for($i=0;$i<count($deals);$i++)
				{	
				?>
			<li class="four columns">
				<div class="img">
					
					<a href="product-details.php?id=<?php echo $deals[$i]['pro_id']?>">
						<img src="./wadmin/gallaryimg/thumbnails/<?php echo $deals[$i]['image']?>" alt="product">
					</a>
				</div>
				<h6><a href="product-details.php?id=<?php echo $deals[$i]['pro_id']?>"><?php echo $deals[$i]['title']?></a></h6>
				<h5>$<?php echo number_format($deals[$i]['price'],2)?></h5>
			</li>
							
				  
				<?php
				}
				?>	
<?php
}
?>
		</ul>
        </div><!--end product_show -->
		

		<div class="pagination">
		<?php echo $pager->renderFullNav();?>
			<!--<a class="text">Page 1 Of 15</a>
			<a href="#">
				<img src="images/icons/left_white_icon.png" alt="" width="7" height="8">
			</a>
			<a href="#">1</a>
			<a class="activePage" href="#">2</a>
			<a href="#">3</a>
			<a href="#">4</a>
			<a class="text">...</a>
			<a href="#">13</a>
			<a href="#">14</a>
			<a href="#">15</a>
			<a href="#">
				<img src="images/icons/right_white_icon.png" alt="" width="7" height="8">
			</a>-->
		</div><!--end pagination-->

	
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