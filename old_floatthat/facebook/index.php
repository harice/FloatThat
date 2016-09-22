<?php 
@ini_set('session.gc_maxlifetime', 50);
@ini_set('session.gc_divisor', 1);

@session_start();
require_once 'libs/facebook.php';
require_once 'config.php';
//include("stylecss.php"); 

//////end constatnt	



$facebook = new Facebook(array(
    'appId' => '498786253474282',
    'secret' => 'c24906b9398b6e5a3f9c8965850e10fc',
    'cookie' => true,
	'domain' => "floatthat.net",
));

 $access_session =$facebook->getUser();
 //print_r($access_session);
     $loginUrl = $facebook->getLoginUrl(array(
     'canvas' => 1,
     'fbconnect' => 0,
     'scope' => 'email,user_likes, publish_stream,offline_access',
	 'redirect_uri' => 'http://floatthat.net/facebook/',
));
      //print_r($loginUrl);
		$fbme = "null";

if (!$access_session) {
	echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
	exit;
}
else {
	try {
 $access_token = $facebook->getAccessToken();
     $user      =   $facebook->getUser();

		
	
$fql1    =   "SELECT uid,first_name,last_name,pic,name,email FROM user WHERE uid = me()";

$param1  =   array(

	'method'    => 'fql.query',

	'query'     => $fql1,

	'callback'  => ''

);
$fqlResult1   =   $facebook->api($param1);

	
			$pic=$fqlResult1[0]['pic'];	
			$email=$fqlResult1[0]['email'];	
			$uid=$fqlResult1[0]['uid'];	
			$name=$fqlResult1[0]['name'];	
				
	
				$sql=@mysql_query("SELECT * FROM user_info where user_id=$uid");
				$getdata=@mysql_fetch_array($sql);
				$rated=@mysql_num_rows($sql);
				
				$date=date('Y-m-d G:i:s'); 
				if($rated==0)
				{
					mysql_query("insert into user_info(user_id,email,pic,name,lastlogin) values('$user','$email','$pic','$name','$date')");
				}
				else
				{
				mysql_query("update user_info set lastlogin='$date' where user_id='$uid'");	
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
	<header>

		<div id="topHeader">
			<div class="container">
				<div class="sixteen columns">
					<ul id="topNav">
						<li><a href="#"><img src="images/icons/facebook.png" width="29" height="28" alt="facebook"></a></li>
						<li><a href="#"><img src="images/icons/twitter.png" width="29" height="28" alt="twitter"></a></li>
                        <li><a href="#"><img src="images/icons/gplus.png" width="29" height="28" alt="gplus"></a></li>
                        <li><a href="http://www.floatthat.net/index.php?frm=fb" target="_blank"><img src="images/icons/visit_btn.png" width="115" height="29" alt="visit"></a></li>
                        <li><a href="#" onClick="invite();"><img src="images/icons/invite_frnds.png" width="196" height="29" alt="invite"></a></li>
					</ul>
				</div><!--end sixteen-->
                
                
			</div><!--end container-->
		</div><!--end topHeader-->


		<div id="mainNavbox">
        <div class="container">
			<div class="five columns">
            	<div id="logo">
						<h1><a href="<?php echo $apppath;?>index.php" target="_top">logo</a></h1>
				</div><!--end logo-->
             </div>
            <div class="eleven columns">
				<div id="mainNav" class="clearfix">
					<nav>
						<ul>
							<li  <?php if(isset($_REQUEST['fdeal'])){?>class="current_nav" <?php }?> ><a class="feature" href="<?php echo $apppath;?>index.php?m=productslist&fdeal=1" target="_top">Feature Deals</a></li>
						  <li <?php if(isset($_REQUEST['all'])){?>class="current_nav" <?php }?>><a class="deals" href="<?php echo $apppath;?>index.php?m=productslist&all=1"  target="_top">All Deals</a></li>
					     <?php /*?> <li <?php if(isset($_REQUEST['mdeal'])){?>class="current_nav" <?php }?>><a class="get" href="<?php echo $apppath;?>index.php?m=mydeals&mdeal=1" target="_top">My Deals</a></li>
			        		<li <?php if(isset($_REQUEST['minvi'])){?>class="current_nav" <?php }?>><a class="goods" href="<?php echo $apppath;?>index.php?m=invitations&minvi=1" target="_top"><span style="text-decoration:blink; color:#F00; font-weight:bold; font-size:14px"><?php echo $numbers;?></span>Invitations</a></li><?php */?>
                            
                             <li <?php if(isset($_REQUEST['mdeal'])){?>class="current_nav" <?php }?>><a class="get" href="#" target="_top">Getaways</a></li>
			        		<li <?php if(isset($_REQUEST['minvi'])){?>class="current_nav" <?php }?>><a class="goods" href="#" target="_top"><span style="text-decoration:blink; color:#F00; font-weight:bold; font-size:14px"><?php echo $numbers;?></span>Goods</a></li>
                            
						    <li <?php if(isset($_REQUEST['how'])){?>class="current_nav" <?php }?>><a class="work" href="<?php echo $apppath;?>index.php?m=howworks&how=1"  target="_top" >How It Works?</a></li>
						  
						</ul>

					</nav><!--end nav-->
					
					
				</div><!--end main-->
			</div><!--end sixteen-->
           
		</div>
        </div><!--end container-->

	</header>
	<!--end header-->

	<?php 
	
	if (isset($_REQUEST['m']))
			{
				
				?>
                
           <?php	$m = $_REQUEST['m'].'.php';
							include_once($m); 
			 } 
			 else 
			{
				include "header.php";
				//echo 'im here';
				include_once("home.php");
			}
		
		include "footer.php";
		
	} catch (FacebookApiException $e) {
		//print_r($e);
		
		
			echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
	
		exit;
	}
}	
	?>
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
</div>
</body>
</html>
