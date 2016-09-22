<?php
	require_once ("config.php");

	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM tbl_products products
			
			left join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.pro_id = '".$_GET['id']."'";
	$product_details = $commonObject->selectMultiRecords($Query);
	$i = 0;
	if($_POST['members'] == "")
		$_POST['members'] = 1;
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

		<!-- Attach our CSS -->
	  	<link rel="stylesheet" href="./popup/reveal.css">	
	  	
		<!-- Attach necessary scripts -->
		<script type="text/javascript" src="./popup/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="./popup/jquery.reveal.js"></script>
		<script>
$(function(){
    $('.big-link').trigger('click');
});
		</script>
		
</head>
<body>

<div id="myModal" class="reveal-modal">
     
     <h1>The item cost will be divided by the number you selected, giving you a per user contribution amount.</h1>
     <a class="close-reveal-modal">&#215;</a>
</div>

		<a href="#" class="big-link" data-reveal-id="myModal"></a>
	<!--start header-->
	<?php require_once("header.php");
	
if($_POST['deal_type'] == "group")
	{
		$label = "Group this deal with your Friends";
	}
	else
	{
		$label = "Float this deal with your Friends";	
	}
	
	?>
	<!--end header-->



	<div class="container">
		<div class="sixteen columns">
			
			<div id="pageName">
				<div class="name_tag">
					<p>
					You're Here :: <a href="index.php">Home</a> &raquo; <?php echo $product_details[$i]['title']?> &raquo; <?php echo $label;?> </p>
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
	
<form action="float-deal.php?id=<?php echo $_GET['id']?>&type=<?php echo $_GET['type']?>" method="post" name="frmFD">	

<input type="hidden" name="pro_id" id="pro_id" value="<?php echo $_POST['pro_id']?>">
<input type="hidden" name="type" id="type" value="<?php echo $_POST['type']?>">
<input type="hidden" name="members" id="members" value="<?php echo $_POST['members']?>">
<input type="hidden" name="user_types" id="user_types" value="<?php echo $_POST['user_types']?>">

<input type="hidden" name="list" id="list" value="<?php echo unserialize($_POST['list'])?>">

			<table width="940" align="center" border="0" cellspacing="0" cellpadding="0">
			<tr><td  width="200" align="center"><img width="180" height="100" src="./wadmin/gallaryimg/thumbnails/<?php echo $product_details[$i]['image']?>" alt="product"></td>
				<td width="300" align="left" ><?php echo $product_details[$i]['title']?>
				</td>
			</tr>	
			<tr><td></td>
				<td  align="left" >&nbsp;
				</td>
			</tr>	
<tr>	
				<td  align="left" colspan="6"  style="font-size:18px; font-weight:bold; color:rgb(29, 10, 253);" >
				The item cost will be divided by the number you selected, giving you a per user contribution amount.
<br /><br />
				
				</td>
			</tr>
<tr><td></td>
				<td  align="left" >&nbsp;
				</td>
			</tr>										
			<tr>
				<td align="right">Total Cost:&nbsp;&nbsp;</td>
				<td  ><strong>$<?php echo number_format($product_details[$i]['price'],2)?></strong></td>
			</tr>
			
			<tr>
				<td align="right">Total Ods selected :&nbsp;&nbsp;</td>
				<td><strong><?php echo $_POST['members'];?></strong></td>
			</tr>
			<tr>
				<td align="right">Per member Contribution:&nbsp;&nbsp;</td>
				<td><strong>$<?php echo number_format(($product_details[$i]['price'] / ($_POST['members']) ),2)?></strong></td>
			</tr>
			<tr>
				<td colspan="2" align="center" style="color:rgb(29, 10, 253); font-size:14px;">
You have a <strong>1</strong> in <strong><?php echo $_POST['members'];?></strong> chances of winning this deal for <strong>$<?php echo number_format(($product_details[$i]['price'] / ($_POST['members']) ),2)?>.</strong>  Please invite your friends.  First <strong><?php echo $_POST['members'];?></strong> to accept will Float the Deal.				
				</td>
				
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
									<a href="#" onClick="document.frmFD.submit();" class="red_btn">  Go Next </a>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="select-members.php?id=<?php echo $_POST['pro_id']?>&type=<?php echo $_POST['type']?>" class="red_btn">  Go Back </a>
									</div>									
								</li>
								
							</ol>
</div><!--end container-->
	<!-- end the main content area -->



	<!-- start the footer area-->
	<?php require_once("footer.php");?>
	<!--end the footer area -->
	
		
<script>
//alert("The item cost will be divided by the number you selected, giving you a per user contribution amount.");
	</script>
<!-- End Document
================================================== -->
</body>
</html>