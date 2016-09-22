<?php 
//@ini_set('session.gc_maxlifetime', 50);
//@ini_set('session.gc_divisor', 1);

@session_start();
require_once 'libs/facebook.php';


$database_host = "50.63.108.69";//50.63.108.69
$database_name = "floatthat";
$database_user = "floatthat";
$database_pass = "Pass123!@#";

$connection=mysql_connect($database_host,$database_user,$database_pass) or die("cant connect to the serveer");
$fblink = mysql_select_db($database_name, $connection) or die("cant connect to the database");
 
$fb_app_canvas='floatthat';
$CanvasURL='http://www.floatthat.net/';
$images='http://www.floatthat.net/images/';

$apppath = 'http://apps.facebook.com/'.$fb_app_canvas.'/';
					
 $strCanvasUrl = 'http://apps.facebook.com/'.$fb_app_canvas.'/index.php';
//////end constatnt	
$app_id='468197239904388';

$api_key ='468197239904388';
$fb_app_secret='e10ef7cc449c2e375948750dfd116a73';
	 
//////end constatnt	



$facebook = new Facebook(array(
    'appId' => '468197239904388',
    'secret' => 'e10ef7cc449c2e375948750dfd116a73',
    'cookie' => true,
	'domain' => "floatthat.net",
));

 $access_session =$facebook->getUser();
 //print_r($access_session);
     $loginUrl = $facebook->getLoginUrl(array(
     'canvas' => 1,
     'fbconnect' => 0,
     'scope' => 'email,read_stream, publish_stream,offline_access',
	 'redirect_uri' => 'https://floatthat.net/',
));
      //print_r($loginUrl);
		$fbme = "null";


	try {
 		
	
	$date=date('Y-m-d');
	
	
	$sqldeal=@mysql_query("SELECT * FROM tbl_deal where status='1' and closedate='$date' and closestatus='0'");
	
	while($deal_id=mysql_fetch_array($sqldeal))
	{
				$sql=@mysql_query("SELECT * FROM tbl_members where deal_id= $deal_id[deal_id] order by Rand() limit 1");
				$getdata=@mysql_fetch_array($sql);
				
					mysql_query("update tbl_members set winner='1' where user_id='$getdata[user_id]' and deal_id= '$deal_id[deal_id]'");
					
					mysql_query("update tbl_deal set closestatus='1' where deal_id= '$deal_id[deal_id]'");
					
					$username=mysql_query("select * from user_info where id=$getdata[user_id]");
					    $uname=mysql_fetch_array($username);
						
						$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$deal_id['pro_id']."'");
					    $productdetail=mysql_fetch_array($productqry);
					
						
					
					
					$shortmsg=$uname['name']." Become a Winner Of ".$productdetail['title'];
						
					$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
					$fuser=$getdata['user_id'];
					
      				$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://www.floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
					
					
					$statusUpdate = $facebook->api("/1222526519/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
					
					
					$sql2=@mysql_query("SELECT * FROM tbl_members where deal_id= $deal_id[deal_id] and status=1");
					while($getdata2=@mysql_fetch_array($sql2))
					{
						$muser=$getdata2['user_id'];
					$statusUpdate = $facebook->api("/$muser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
					}
					
					
					
					
	}
				
				
	} catch (FacebookApiException $e) {
		//print_r($e);
		
		
			echo "aaa";
	
		exit;
	}
