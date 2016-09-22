<?php
require_once ("config.php");

//print_r($_SESSION['users_id']);
	if($userContents['email'] == "")
	{
		$_SESSION['page_url'] = curPageURL();
		$_SESSION['cart'] = '1';
		$display = "block";
	}
	else
	{
		$_SESSION['page_url'] = '';
		$display = "none";
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
	<link rel="stylesheet" href="css/checkout.css">
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
						You're Here :: <a href="index.php">Home</a> :: Deal Accepted
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


				
				
			

<div class="checkout_outer">
				
				
				<h2><span>Deal Accepted</span></h2>
				<!--end checkout_content-->
			
		  </div>
			<?php
					$deal_id = $_GET['deal_id'];
	$facebook_user = $user;				
	if($user == "")
		$user = $userContents['user_id']; 
	  
	   mysql_query("update tbl_members set status='1' where deal_id=$deal_id and user_id=$user");
	   

					
		$fusname=mysql_query("select * from tbl_deal where deal_id=$deal_id"); 
		$frname=mysql_fetch_array($fusname);
		$nOds = $frname['ods'];
		$deal_type = $frname['type'];
		
		$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$frname['pro_id']."'");
		$productdetail=mysql_fetch_array($productqry);
		
		
		
		$fmmsname=mysql_query("select * from tbl_members where deal_id=$deal_id");
		$countmem=mysql_num_rows($fmmsname);
		
		
		$cstp=$productdetail['price'];
		$expectedprice=number_format($productdetail['price']/$countmem,2);
			
		$totmem=$countmem;

		$result = mysql_query("select * from tbl_members where deal_id = $deal_id and status='1'");
		$nTotalMembs = mysql_num_rows($result);
		if($nTotalMembs == $nOds)
		{
			$sqldeal=@mysql_query("SELECT * FROM tbl_deal where status='1' and closestatus='0'");
			
			while($deal_id=mysql_fetch_array($sqldeal))
			{

				
				
						$sql=@mysql_query("SELECT * FROM tbl_members where deal_id= $deal_id[deal_id] order by Rand() limit 1");
						$getdata=@mysql_fetch_array($sql);
						
				if($deal_type != "group")
				{						
					mysql_query("update tbl_members set winner='1' where user_id='$getdata[user_id]' and deal_id= '$deal_id[deal_id]'");
				}			
							mysql_query("update tbl_deal set closestatus='1' where deal_id= '$deal_id[deal_id]'");
							
							$username=mysql_query("select * from user_info where id=$getdata[user_id]");
							$uname=mysql_fetch_array($username);
								
								$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$deal_id['pro_id']."'");
								$productdetail=mysql_fetch_array($productqry);
							
								
						if($facebook_user != "" && $userContents['fb'] == 1)
						{	
							if($deal_type != "group")
							{													
								$shortmsg = $uname['name']." Become a Winner Of ".$productdetail['title'];
							}
							else
							{
								$resultSet = mysql_query("select * from tbl_group_members WHERE deal_id = '$deal_id[deal_id]' ");
								$groupMemberData = mysql_fetch_array($resultSet);					
								$shortmsg = $groupMemberData['person_name']." is entitled the owner of ".$productdetail['title'];

								$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
								$statuss      	= $shortmsg;
								$statuss       = htmlentities($statuss, ENT_QUOTES);
								
								$fuser = $getdata['user_id'];
								
								$headers  = "MIME-Version: 1.0\r\n";
								$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
								$headers .= "From: info@floatthat.net <info@floatthat.net>\r\n"."Reply-To: ".$groupMemberData['email']."<".$groupMemberData['email'].">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
								mail($groupMemberData['email'], $shortmsg, $statuss, $headers);	
							} 
								
							$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
							$statuss      	= $shortmsg;
							$statuss       = htmlentities($statuss, ENT_QUOTES);
							
							$fuser=$getdata['user_id'];
							
							$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://www.floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
							
							
						//	$statusUpdate = $facebook->api("/1222526519/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
							
							
							$sql2=@mysql_query("SELECT * FROM tbl_members where deal_id= $deal_id[deal_id] and status=1");
							while($getdata2=@mysql_fetch_array($sql2))
							{
								$muser=$getdata2['user_id'];
							$username=mysql_query("select * from user_info where id='$muser'");
							$uname=mysql_fetch_array($username);
							if($uname['fb'] == 1)		
							{						
							$statusUpdate = $facebook->api("/$muser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
							}
							}
						}	
						else
						{	
							if($deal_type != "group")
							{													
								$shortmsg=$uname['name']." Become a Winner Of ".$productdetail['title'];
							}
							else
							{
								$resultSet = mysql_query("select * from tbl_group_members WHERE deal_id = '$deal_id[deal_id]' ");
								$groupMemberData = mysql_fetch_array($resultSet);					
								$shortmsg = $groupMemberData['person_name']." is entitled the owner of ".$productdetail['title'];
								
								$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
								$statuss      	= $shortmsg;
								$statuss       = htmlentities($statuss, ENT_QUOTES);
								
								$fuser = $getdata['user_id'];
								
								$headers  = "MIME-Version: 1.0\r\n";
								$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
								$headers .= "From: info@floatthat.net <info@floatthat.net>\r\n"."Reply-To: ".$groupMemberData['email']."<".$groupMemberData['email'].">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
								mail($groupMemberData['email'], $shortmsg, $statuss, $headers);								
							} 													
							
								
							$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
							$statuss      	= $shortmsg;
							$statuss       = htmlentities($statuss, ENT_QUOTES);
							
							$fuser=$getdata['user_id'];
							
							$headers  = "MIME-Version: 1.0\r\n";
							$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
							$headers .= "From: info@floatthat.net <info@floatthat.net>\r\n"."Reply-To: ".$uname['email']."<".$uname['email'].">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
							mail($uname['email'], $shortmsg, $statuss, $headers);
							
							$sql2=@mysql_query("SELECT * FROM tbl_members where deal_id= $deal_id[deal_id] and status=1");
							while($getdata2=@mysql_fetch_array($sql2))
							{
								$muser=$getdata2['user_id'];
							$username=mysql_query("select * from user_info where id='$muser'");
							$uname=mysql_fetch_array($username);	
														
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
	$headers .= "From: info@floatthat.net <info@floatthat.net>\r\n"."Reply-To: ".$uname['email']."<".$uname['email'].">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
	mail($uname['email'], $shortmsg, $statuss, $headers);
							}
												
						}
			}
			
		}
		
	   ?>
    <div class="mainhead"><?php echo $productdetail['title'];?> $<?php echo $productdetail['price'];?></div>
        <!-- <div class="boldtxt"><?php //echo $product['detail'];?></div>-->
	<?php /*?>onclick="Open_Cardinfo('<?php echo $user;?>','<?php echo $product['pro_id'];?>');"<?php */?>	
   <div class="inner_banner">
   
   <div style="float:left">
     
     <div style="background-image:url(images/arrow_bg.jpg); width:300px; height:100px; padding-top:10px;padding-left:30px;background-repeat:no-repeat">
     	<a href="<?php echo $apppath;?>index.php" target="_top">
     <img src="images/mainpagebtn.jpg" width="198" height="67" alt="float_btn"  style="cursor:pointer" border="none" /></a>	
    </div>
    
     <div style="background-image:url(images/arrow_bg.jpg); width:300px; height:100px; padding-top:10px;padding-left:30px; background-repeat:no-repeat">
     	
     <img src="images/dealaccepted.jpg" width="198" height="67" alt="float_btn"   border="none" />	
    </div>
   
   </div>
   
   <div class="ri8panel" style="float:left">
   <img src="wadmin/products/<?php echo $productdetail['c_id'];?>/<?php echo $productdetail['thumb'];?>" style="width:345px; height:215px;" alt="inner thumb" />
   
   </div>
   <div class="clear"></div>
   </div>
  
 			
				
	  </div><!--end checkout_content-->
</div><!--end checkout_outer-->

			<!--end checkout_outer--><!--end sixteen--><!--end container-->
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
function validation()
{
	if($("#closedate").val() == "")
	{
		alert("Please enter your Deal Closing Date");
		$("#closedate").focus();
		return false;
	}
	if($("#phone").val() == "")
	{
		alert("Please enter your phone");
		$("#phone").focus();
		return false;
	}
	if($("#cardnum").val() == "")
	{
		alert("Please enter your Card Number");
		$("#cardnum").focus();
		return false;
	}
	if($("#cscnum").val() == "")
	{
		alert("Please enter your CSC");
		$("#cscnum").focus();
		return false;
	}
	if($("#month").val() == "")
	{
		alert("Please enter card exipiry date");
		$("#month").focus();
		return false;
	}	
	if($("#year").val() == "")
	{
		alert("Please enter card exipiry date");
		$("#year").focus();
		return false;
	}
	if($("#country").val() == "")
	{
		alert("Please enter your Country");
		$("#country").focus();
		return false;
	}

	


	
								
return true;
								
}
</script>	

<!-- End Document
================================================== -->
</body>
</html>