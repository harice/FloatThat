<?php
	require_once ("config.php");
	//$_SESSION['deal_id']=(int)microtime() + floor(rand(1,99999)*10000);
	$_SESSION['deal_id']=(int)microtime(1) ;
	if($userContents['email'] == "")
	{
		$_SESSION['page_url'] = curPageURL();
		header("Location: register.php");
		exit;
	}
	else
	{
		$_SESSION['page_url'] = '';
	}
	
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
	<?php require_once("header.php");
	
if($_POST['deal_type'] == "group")
	{
            echo "Hiii"; exit;
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
			<?php
			if($_GET['type'] != "group")
			{
			?>	
<form action="estimated-cost.php?id=<?php echo $_GET['id']?>&type=<?php echo $_GET['type']?>" method="post" name="frmFD">	
			<?php
			}
			else
			{
			?>
<form action="float-deal.php?id=<?php echo $_GET['id']?>&type=<?php echo $_GET['type']?>" method="post" name="frmFD">	
<input type="hidden" name="members" id="members" value="0">
			
			<?php
			}
			?>
<input type="hidden" name="pro_id" id="pro_id" value="<?php echo $_GET['id']?>">
<input type="hidden" name="type" id="type" value="<?php echo $_GET['type']?>">

			<table width="940" align="center" border="0" cellspacing="3" cellpadding="4">
			<tr><td  width="200" align="center"><img width="180" height="100" src="./wadmin/gallaryimg/thumbnails/<?php echo $product_details[$i]['image']?>" alt="<?php echo $product_details[$i]['title']?>"></td>
				<td width="300" align="left" ><strong>$<?php echo number_format($product_details[$i]['price'],2)?></strong><br />
				<?php echo $product_details[$i]['detail']?>
				</td>
			</tr>	
			<tr><td></td>
				<td  align="left" >&nbsp;
				</td>
			</tr>							
			<?php
			if($_GET['type'] != "group")
			{
			?>
			<tr>
				<td  align="right">Please select the Odds you want:&nbsp;&nbsp;</td>
				<td  ><select name="members" id="members">
				<option value="2">1 in 2</option>
				<?php
				for($i=1;$i<=100;$i++)
				{
					if($i % 5 == 0)
					{
						$index = ($i - 5);
						if($index == 0)
							$index = 1;
						
				?>
				<option value="<?php echo $i?>">1 in <?php echo $i;?></option>
				<?php
					}
				}
				?>
				</select></td>
			</tr>
			<?php
			}
			elseif($_GET['type'] == "group")
			{
	$Query="SELECT * from occusions order by id asc";
	$arrResults = $commonObject->selectMultiRecords($Query);			
			?>
			<tr>
				<td  align="right">Whom do you want to sent this to:&nbsp;&nbsp;</td>
				<td  ><input type="text" name="person_name" id="person_name" placeholder="Enter the lucky recipient's name"></td>
			</tr>
			<tr>
				<td  align="right">Email:&nbsp;&nbsp;</td>
				<td  ><input type="text" name="email" id="email" placeholder="Email"></td>
			</tr>   
			<tr>
				<td  align="right">Occasion:&nbsp;&nbsp;</td>
				<td  ><select name="occusion" id="occusion" onChange="check_type();">
				<option value="">Select Occasion</option>
				<?php 
				if(count($arrResults) > 0)
				{
					for($i=0;$i<count($arrResults);$i++)
					{
					?>
					<option value="<?php echo $arrResults[$i]['occusion']?>"><?php echo $arrResults[$i]['occusion']?></option>
					<?php
					}
				}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td  align="right">Do you want to infrom lucky recipient :&nbsp;&nbsp;</td>
				<td  ><input type="checkbox" name="infrom" id="infrom" value="1"></td>
			</tr>             
			<tr id="other_oc" style="display:none;">
				<td  align="right"  >Other Occasion:&nbsp;&nbsp;</td>
				<td  ><input type="text" name="other_occusion" id="other_occusion" placeholder="Other Occusion"></td>
			</tr> 			  			         			
			<?php	
			}
			?>
            <tr>
				<td colspan="2" style="font-size:18px; font-weight:bold; color:rgb(29, 10, 253);" >
				<br />Who will participate with you please select Friends from:<br />
				
				</td>
			</tr>
			<tr><td  ></td>
				<td  align="left" >
			<?php
		//	echo "<pre>";
		//	print_r($userContents);
		//	echo $_SESSION['oauth_id'];
		/*	if($user == '' && $_SESSION['oauth_id'] == '')
			{
			?>	
				 <input type="radio" checked="checked" id="user_types" name="user_types" value="1"> floatthat.net Friends only
				<br />
			<?php
			}
			else*/
			{
			?>	
				<input type="radio" checked="checked" id="user_types" name="user_types" value="1"> FloatThat.net Friends only
				<br />	
				<?php
				
				if($userContents['fb'] == 1 && $user != '')
				{
				?>		
<!--				 <input type="radio" id="user_types" name="user_types" value="2"> Facebook.com Friends only-->
                                <a href="#" onclick="sendfbmsg();">
                                    Facebook Friends </a>
                                <div id="root"></div>
				<br />
				<?php
				}
				
				if($userContents['fb'] == 2 && $userContents['tw'] == 2 )
				{				
				?>
 				<input type="radio" id="user_types" name="user_types" value="4"> Twitter.com Friends only
				<br />	
				<?php
				}
				
				if($userContents['fb'] == 1 && $user != '')
				{				
				?>										
				<input type="radio" id="user_types" checked="checked" name="user_types" value="3"> Facebook.com, and FloatThat.net Friends
				<br />	
				<?php
				}
				
				if($userContents['fb'] == 2 && $userContents['tw'] == 2 && $user == '')
				{				
				?>					
				<input type="radio" id="user_types" checked="checked" name="user_types" value="5"> Twitter.com and FloatThat.net Friends
				<br />
				<?php
				}
				
				if($userContents['fb'] == 2 && $userContents['tw'] == 2 && $user != '')
				{				
				?>								
				<input type="radio" id="user_types" checked="checked" name="user_types" value="6"> Facebook.com, Twitter.com and FloatThat.net Friends
				<br />	
				<?php
				}
				
				?>									
			<?php
			}
			?>
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
									<a href="#" onClick="page_validation();" class="red_btn"> Go Next</a>
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

<script>
function facebook_send_message() {
    FB.ui({
        app_id:'743102912465318',
        method: 'send',
        name: "sdfds jj jjjsdj j j ",
        link: 'https://apps.facebook.com/xxxxxxxaxsa',
        //to:to,
        description:'sdf sdf sfddsfdd s d  fsf s '

    });
}
function check_type()
{
			if($("#occusion").val() == 'Other' )
			{
				$("#other_oc").show();
			}
			else
				$("#other_oc").hide();
}


function page_validation()
{
	<?php
		if($_GET['type'] == "group")
		{
	?>	
		if($("#person_name").val() == "")
		{
			alert("Please enter the lucky recipient's name.");
			$("#person_name").focus();
			return false;	
		}
		if($("#email").val() == "")
		{
			alert('Please enter valid email address.');
			$("#email").focus();
			return false;	
		}
		else
		{
			 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if(!emailReg.test($('#email').val()))	
			{
				$('#email').focus();
				alert("Enter a valid email address.");			
				return false;
			}
		}
		if($("#occusion").val() == "")
		{
			alert('Please select Occasion.');
			$("#occusion").focus();
			return false;	
		}	
	<?php
		}
	?>
	document.frmFD.submit();	
}

</script>	

<!-- End Document
================================================== -->
</body>
</html>