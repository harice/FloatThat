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

$Query="SELECT * FROM users WHERE email='$UserLogged' and status = 1";
$userContents = $commonObject->selectFrom($Query);

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
	  'appId'  => '498786253474282',
	  'secret' => 'c24906b9398b6e5a3f9c8965850e10fc',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
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
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;	
		$email = $face_data['username'].'@facebook.com';						
		
		
		$Query="SELECT * FROM users WHERE user_id= '".$facebook_uid."'";
		$user_array = $commonObject->selectMultiRecords($Query);	
		if( count($user_array) > 0)
		{			
			header("Location: validation-fb.php?email=".$email);
			exit;
		}
		else
		{
			$query = "
					insert into users  
												(
												  user_id,
												  name,
												  email,
												  password,										  
												  status
												 )
												 values
												 (
													'".$facebook_uid."',
													'".$fullname."',
													'".$email."',
													'".$password."',
													1
												 )	
				";
				$result = mysql_query($query);
			header("Location: validation-fb.php?email=".$email.'&password='.$password);		
			exit;		
		}

			
	}

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

$_SESSION['page_url'] = curPageURL();

include('ps_pagination.php');
//echo $userContents['email'].'222';
?>