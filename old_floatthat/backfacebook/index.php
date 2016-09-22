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
     'scope' => 'email,read_stream, publish_stream,offline_access',
	 'redirect_uri' => 'https://apps.facebook.com/floatthat/',
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Float That</title>
<!--style sheet-->
<?php include "style.php";?>
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>
</head>

<body>
<div class="container">

	<?php 
	include "header.php";
	if (isset($_REQUEST['m']))
			{
				
				?>
                
           <?php	$m = $_REQUEST['m'].'.php';
							include_once($m); 
			 } 
			 else 
			{
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
	
</div>
</body>
</html>
