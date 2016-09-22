<?php
	require_once ("config.php");

	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM tbl_products products
			
			left join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.pro_id = '".$_GET['id']."'";
	$product_details = $commonObject->selectMultiRecords($Query);
	
?>
<?php
////print_r($_POST['list']);
//print_r($_POST['users_id']);

$data_name = array();
$data_email = array();
for($i=1;$i<=$_POST['nCounter'];$i++)
{
	if( trim($_POST['friend_email'.$i]) != "" )
	{
		$data_name[$i] = $_POST['friend_name'.$i];
		$data_email[$i] = $_POST['friend_email'.$i];
	}
}
$_SESSION['data_name'] = $data_name;
$_SESSION['data_email'] = $data_email;
$nemails = count($data_email);
if(count($_POST['list']) > 0)
{
	$_SESSION['list'] = $_POST['list'];
	$nlist = count($_POST['list']);
}	
if(count($_POST['users_id']) > 0)
{
	$_SESSION['users_id'] = $_POST['users_id'];
	$_SESSION['friend_names'] = $_POST['friend_names'];
	$_SESSION['friend_pics'] = $_POST['friend_pics'];
	$nusers_id = count($_POST['users_id']);
}	
if(count($_POST['tw_users_id']) > 0)
{
	$_SESSION['tw_users_id'] = $_POST['tw_users_id'];
	$_SESSION['tw_friend_names'] = $_POST['tw_friend_names'];
	$_SESSION['tw_friend_pics'] = $_POST['tw_friend_pics'];
	$tw_users_id = count($_POST['tw_users_id']);
}
if(count($_SESSION['list']) > 0)
{
	$nlist = count($_SESSION['list']);
}	
if(count($_SESSION['users_id']) > 0)
{
	$nusers_id = count($_SESSION['users_id']);
}	
if(count($_SESSION['tw_users_id']) > 0)
{
	$tw_nusers_id = count($_SESSION['tw_users_id']);
}
//print_r($_POST['users_id']);
$total_inviates = (($nlist + $nusers_id + $nemails + $tw_nusers_id) + 1);
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
					You're Here :: <a href="index.php">Home</a> &raquo; <?php echo $product_details[0]['title']?> &raquo; <?php echo $label;?> </p>
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
	
		<?php if($_GET['msg'] == "exist"){?>
				<div style="color:red; font-size:14px;">You have already float this Product.</div><br />
				<?php }
				if($_GET['msg'] == "succ"){?>
				<div style="color:green; font-size:14px;">You have successfully float this product</div><br />
				<?php }
if($_GET['msg'] == "no"){?>
				<div style="color:red; font-size:14px;">Sorry you did not select any user to float this product</div><br />
				<?php }				
	
	if($total_inviates >= $_POST['members'])
	{
		if($_POST['deal_type'] == "group")	
		{			
		?>		
		<form action="float-deals-conf.php?id=<?php echo $_GET['id']?>&type=<?php echo $_POST['deal_type']?>" method="post" name="frmFD">	
		<?php
		}
		else
		{
		?>
		<form action="float-deals-conf.php?id=<?php echo $_GET['id']?>&type=<?php echo $_POST['deal_type']?>" method="post" name="frmFD">	
		
		<?php
		}
	}
	else
	{
	?>
<form action="float-deal.php?id=<?php echo $_GET['id']?>&type=<?php echo $_POST['deal_type']?>" method="post" name="frmFD">	
	<?
	}
?>


<input type="hidden" name="pro_id" id="pro_id" value="<?php echo $_GET['id']?>">
<input type="hidden" name="type" id="type" value="<?php echo $_POST['deal_type']?>">
<input type="hidden" name="list" id="list" value="<?php echo unserialize($_POST['list'])?>">
<input type="hidden" name="members" id="members" value="<?php echo $_POST['members']?>">
<input type="hidden" name="user_types" id="user_types" value="<?php echo $_POST['user_types']?>">

			<table width="940" align="center" border="0" cellspacing="0" cellpadding="0">
			
				<tr>
				<td  colspan="2"  style="font-size:18px; font-weight:bold; color:rgb(29, 10, 253);" align="center" >
<?php 				
	
if($_POST['deal_type'] == "group")	
{			
?>
No one will
be charged until everyone chips in. The gift fund will be sent to your
PayPal account.
<?php
}else
{
?>
				No one will be charged until the selected odds are met and all
participating members have accepted on float deal.
<?php
}
if($total_inviates >= $_POST['members'])
{

}
else
{
?>
<span  style="font-size:18px; font-weight:bold; color:red;">
			<br /><br />You did not select enough friends to complete ods. Please go back and select friends more then or equal to your selected Odd.
</span>			
<?php
}
?>

<br /><br />
				
				</td>
			</tr>			
			<tr><td  width="200" align="center"><img width="180" height="100" src="./wadmin/gallaryimg/thumbnails/<?php echo $product_details[0]['image']?>" alt="<?php echo $product_details[0]['title']?>"></td>
				<td width="300" align="left" >
				<strong>$<?php echo number_format($product_details[0]['price'],2)?></strong><br />
				<?php echo $product_details[0]['detail']?>
				</td>
			</tr>	
			<tr><td></td>
				<td  align="left" >&nbsp;
				</td>
			</tr>
						
			<tr>
				<td align="right">Total Cost:&nbsp;&nbsp;</td>
				<td  ><strong>$<?php echo number_format($product_details[0]['price'],2)?></strong></td>
			</tr>
			<tr>
				<td align="right">Total Invites :&nbsp;&nbsp;</td>
				<td><?php echo (($nlist + $nusers_id + $nemails + $tw_nusers_id) + 1);?></td>
			</tr>
			<tr>
				<td align="right">Your contribution:&nbsp;&nbsp;</td>
				<td><strong>$<?php echo number_format(($product_details[0]['price'] / ((($nlist + $nusers_id + $nemails + $tw_nusers_id) + 1)) ),2);
				//echo number_format(($product_details[0]['price'] / ($nlist + $nusers_id + 1) ),2)
				?></strong></td>
			</tr>
<tr>
				<td colspan="2" align="center">
				
<!--<strong>Note:</strong> You will not be charged untill the deal closed.You have a 1 in <strong><?php echo $_POST['members'];?></strong> chances of winning this deal for <strong>$<?php echo number_format(($product_details[0]['price'] / ($_POST['members']) ),2)?>.</strong>  Please invite your friends.  First <strong><?php echo $_POST['members'];?></strong> to accept will Float the Deal.				
-->				</td>
				
			</tr>			
			<tr>
				<td colspan="2">Terms & Conditions</td>
				
			</tr>
			<tr>
				<td colspan="2">Terms & Conditions</td>
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
								<?php
									if($total_inviates >= $_POST['members'])
									{								
								?>
									<div class="inputOuter button">
									<a href="#" onClick="document.frmFD.submit();" class="red_btn">Go Next</a>
									</div>	
								<?php
									}
									else
									{
									?>
									<div class="inputOuter button">
									<a href="#" onClick="document.frmFD.submit();"  class="red_btn">Go Back</a>
									</div>										
									<?php
									}									
								?>									
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