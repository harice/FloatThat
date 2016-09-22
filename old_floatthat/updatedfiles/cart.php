<?php
	require_once ("config.php");

	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail, sales.quantity,
			sales.discount
			FROM sales 
			
			inner join tbl_products as products on sales.pid = products.pro_id
			
			left join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where sales.sale_session_id = '".$_SESSION['current_session_id']."'
			group by products.pro_id
			";
	$cart = $commonObject->selectMultiRecords($Query);
?>	
<!DOCTYPE html>
	<title>Float That</title>
	<meta name="description" content="">
	<meta name="Hassan" content="Float That">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/cart.css">
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
						You're Here :: <a href="index.php">Home</a> &raquo; Cart
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
			
			<div class="box_head">
				<h3>My Floating Cart</h3>
			</div><!--end box_head -->
<form method="get" action="add-to-cart.php" name="frmCart" onSubmit="return false;">

			<table class="cart_table">
				<thead>
					<tr>
						<th class="first_td"><h4>The Product</h4></th>
						<th><h4>Quantity</h4></th>
						<th><h4>Uint Price</h4></th>
						<th><h4>Total Price</h4></th>
						<th><h4>Delete</h4></th>
					</tr>
				</thead>
				<tbody>
				
<?php
if(count($cart) > 0)
{
?>			
				<?php
				for($i=0;$i<count($cart);$i++)
				{	
				$sub_total = $sub_total + (  ($cart[$i]['price'] - $cart[$i]['discount'])  * $cart[$i]['quantity'] );
				$discount = ($discount + $cart[$i]['discount']);
				?>				
					<tr>
						<td class="first_td">
							<div class="clearfix">
								<img src="./wadmin/gallaryimg/thumbnails/<?php echo $cart[$i]['image']?>" alt="product image">
								<span>
									<strong><a href="product-details.php?id=<?php echo $cart[$i]['pro_id']?>"><?php echo $cart[$i]['title']?></a></strong><br>
									
								</span>
							</div>
						</td>
						<td class="quantity">1
							<!--
							<label>
								<input type="text" maxlength="12" name="qty<?php echo $cart[$i]['pro_id']?>" id="qty<?php echo $cart[$i]['pro_id']?>" value="<?php echo $cart[$i]['quantity']?>" size="2">
							</label>
							
							<a style="cursor:pointer;"  onClick="add_to_cart('<?php echo $cart[$i]['pro_id']?>');"><span>Update Quantity</span></a>-->
						</td>
						<td>
							<h5>$<?php echo number_format(( ($cart[$i]['price'] - $cart[$i]['discount']) ) ,2)?></h5>
						</td>
						<td class="total_price">
							<h5>$<?php echo number_format(( ($cart[$i]['price'] - $cart[$i]['discount'])  * $cart[$i]['quantity']) ,2)?></h5>
						</td>
						<td>
							<a class="" href="remove.php?id=<?php echo $cart[$i]['pro_id']?>">delete</a>
						</td>
					</tr>
<?php
				}
}
else
{
?>
	<tr>
		<td align="center">
		There in no product in your cart
		</td>
	</tr>
<?
}	
?>					
					

					
				</tbody>
			</table><!--end cart_table-->
</form>
		</div><!--end sixteen-->


		<div class="ten columns">
			<div class="cart_tabs clearfix">

				<ul class="">
					<li><a  href="#estimate"></a></li>
					<li><a href="#discount_code"></a></li>
					<li><a href="#gift_voucher"></a></li>
				</ul><!--end cart_tabs_nav-->
				<!--end cart_tabs_content-->
            </div>
			<!--end cart_tabs-->
		</div><!--end ten-->



		<div class="six columns">

			<table class="receipt" bgcolor="#ffffff" border="1" bordercolor="#CCCCCC">
				<tbody>
					<tr>
						<td>Sub Total</td>
						<td>$<?php echo number_format($sub_total,2);?></td>
					</tr>
					<tr>
						<td>Promotion Discount</td>
						<td>$<?php echo number_format($discount,2);?></td>
					</tr>

					<tr>
						<td style="font-weight:600;font-size:16px;">TOTAL</td>
						<td style="font-weight:600;font-size:16px;">$<?php echo number_format( ($sub_total - $discount),2);?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td class="last_td">
							<a class="gray_btn" href="index.php">Continue Shopping</a>
						</td>
						<td class="last_td">
							<a class="red_btn" href="checkout.php">Checkout</a>
						</td>
					</tr>
				</tfoot>
				

			</table>

		</div><!--end six -->


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
function add_to_cart(id)
{
	var qty = $("#qty"+id).val();
	window.location = "add-to-cart.php?id="+id+"&qty="+qty;
}
</script>	

<!-- End Document
================================================== -->
</body>
</html>