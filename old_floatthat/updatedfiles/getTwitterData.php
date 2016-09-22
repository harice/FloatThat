<?php
error_reporting(1);
require("twitter/twitteroauth.php");
require 'config/twconfig.php';
//require 'config/functions.php';
require 'config.php';
//session_start();

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
    ///echo '<pre>';
    //print_r($user_info);
    //echo '</pre><br/>';
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {
	   $twitter_otoken=$_SESSION['oauth_token'];
	   $twitter_otoken_secret=$_SESSION['oauth_token_secret'];
	   $email='';
        $uid = $user_info->id;
        $username = $user_info->name;
		$user_name = $user_info->screen_name;
	  $password = 'twitter9211pass';
//print_r($user_info);
		$data['username'] = $username;	
		$data['password'] = $password;	
		$email = $user_name.'@floatthat.net';
		$pic = $userdata['profile_image_url'];
		$user_name = $user_name;
			  
        /*$user = new User();
        $userdata = $user->checkUser($uid, 'twitter', $username,$email,$twitter_otoken,$twitter_otoken_secret);
		//print_r($userdata);
        if(!empty($userdata)){
           // session_start();
           // $_SESSION['id'] = $userdata['id'];
 			//$_SESSION['oauth_id'] = $uid;
          //  $_SESSION['username'] = $userdata['username'];
          //  $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
			$pic = $userdata['profile_image_url'];*/
			
		 $Query="SELECT * FROM user_info WHERE user_id= '".$uid."' and  email = '".$email."'";
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
												  fb,
												  user_name,
												  tw
												 )
												 values
												 (
													'".$uid."',
													'".$pic."',
													'".$username."',
													'".$email."',
													'".$password."',
													1,
													2,
													'".$user_name."',
													2
												 )	
				";
				$result = mysql_query($query);
			header("Location: validation-fb.php?email=".$email.'&password='.$password.'&new=yes');		
			exit;
		}				
            //header("Location: home.php");
       // }
    }
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
?>
