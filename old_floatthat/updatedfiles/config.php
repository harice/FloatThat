<?php
error_reporting(0);
ini_set("session.use_trans_sid", false);
// Session Handling
session_start();
$strPath = './';
require_once ("includes/common.php");
require_once ("includes/common_class.php");	
require_once ("includes/functions.php");
require_once ("includes/dbcon.php");
require_once ("includes/facebookapiexception.php");
require_once ("includes/facebook.php");

$connectionsInstance = new connections();	//connection class
$connectionsInstance->dbConnect();//data base connection method
	
$commonFunctionInsta = new commonFunctins();	// functions class
$commonObject = new Common();// common Database manipulatin function's class


$UserLogged = $commonFunctionInsta->loggedUser();

$Query="SELECT * FROM user_info WHERE email='$UserLogged' and status = 1";
$userContents = $commonObject->selectFrom($Query);
/*
echo "<pre>";
print_r($userContents);
 
$trends_url = "http://api.twitter.com/1/statuses/followers/145532608.json";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $trends_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$curlout = curl_exec($ch);
curl_close($ch);
$response = json_decode($curlout, true);
foreach($response as $friends)
{
  $thumb = $friends['profile_image_url'];
  $url = $friends['screen_name'];   
   $name = $friends['name'];
 
   print "<a title='" . $name . "' href='http://www.twitter.com/" . $url . "'>" . "<img src='" . $thumb . "' /></a>";
}
*/
if( trim($_SESSION['current_session_id']) == "")
{
	$Query="SELECT id, sales_id FROM sales_ids order by id desc limit 1";
	$sale_id_array = $commonObject->selectFrom($Query);
	
	$_SESSION['current_session_id'] = date("Y").'-'.date("m").'-'.date("d").'-'.$sale_id_array['id'];
	$query = "insert into sales_ids(sales_id) values('".$_SESSION['current_session_id']."');";
	$result = mysql_query($query);
}
/**facebook login**/
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '468197239904388',
	  'secret' => 'e10ef7cc449c2e375948750dfd116a73',
		'cookie' => true,
		'domain' => "floatthat.net",	  
	));
	
	// Get User ID
	$user = $facebook->getUser();
	$access_session =$facebook->getUser();
 //print_r($access_session);
     $loginUrl = $facebook->getLoginUrl(array(
     'canvas' => 1,
     'fbconnect' => 0,
     'scope' => 'email,user_likes, publish_stream,offline_access',
	 
));
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	//$friends = $facebook->api('/me/friends');
//	echo "<pre>";
//	print_r($friends);
//	echo "<pre>";
	//exit;
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = "http://www.floatthat.net/sign-out.php";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	
	$password = 'facebook9211pass';
	
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);

	//$friends = $facebook->api('/me/friends');
//	echo "<pre>";
//	print_r($friends);
//	echo "<pre>";
		
		$fql1    =   "SELECT uid,pic_big,pic,pic_small,name FROM user WHERE  uid  = $user";
		$param1  =   array(
						
							'method'    => 'fql.query',
						
							'query'     => $fql1,
						
							'callback'  => ''
						
						);
		$fqlResult2   =   $facebook->api($param1);
		$pic = 	$fqlResult2[0]['pic'];
			
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;	
		$email = $face_data['username'].'@floatthat.net';						
		
		
		$Query="SELECT * FROM user_info WHERE user_id= '".$facebook_uid."' and  email = '".$email."'";
		$user_array = $commonObject->selectMultiRecords($Query);	
		if( count($user_array) > 0)
		{			
			header("Location: validation-fb.php?email=".$email);
			exit;
		}
		else
		{
			$query = "
					insert into user_info  
												(
												  user_id,
												  pic,
												  name,
												  email,
												  password,										  
												  status,
												  fb
												 )
												 values
												 (
													'".$facebook_uid."',
													'".$pic."',
													'".$fullname."',
													'".$email."',
													'".$password."',
													1,
													1
													
												 )	
				";
				$result = mysql_query($query);
			header("Location: validation-fb.php?email=".$email.'&password='.$password.'&new=yes');		
			exit;		
		}

			
	}

	
		//$pic = 	$fqlResult2['pic'];
		//print_r($fqlResult2);
/**facebook connect**/

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

//$_SESSION['page_url'] = curPageURL();

include('ps_pagination.php');
//echo $userContents['email'].'222';

/*if($user != "" && $user > 0)
{
		$fql1    =   "SELECT uid,pic_big,pic,pic_small,name FROM user WHERE  uid IN ( SELECT uid2 FROM friend WHERE uid1= $user) order by name";
		$param1  =   array(
						
							'method'    => 'fql.query',
						
							'query'     => $fql1,
						
							'callback'  => ''
						
						);
		$fqlResult2   =   $facebook->api($param1);
		
		$i=0;
		$frndids = "";
		$cnt= 1;
		
		foreach($fqlResult2 as $friends)
	        {
				 $i++; 
			?>				
            
         					<div class="thumb" style="float:left; margin-top:2px;">
								<img src="<?php echo $friends['pic'];?>" style="width:80px; height:80px;" />
								<input type="checkbox" name="users_id[]" value="<?php echo $friends['uid'];?>" />
                                <br />
                                <span>
                                <?php echo htmlentities($friends['name'], ENT_QUOTES);?></span>
								</div>
						 	<?php
						
						if($i%7==0)
						{
						?>
                      <div style="clear:both"></div>
                   
                        <?php
						}
						
					}
}		*/					

//if($user == "")
//	$user = $userContents['user_id'];

if($_GET['fb'] == 'yes')
{
	header("Location: $loginUrl");
	exit;
}
?>