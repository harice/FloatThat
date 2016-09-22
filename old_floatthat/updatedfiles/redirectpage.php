<?php 
@ini_set('session.gc_maxlifetime', 50);
@ini_set('session.gc_divisor', 1);

@session_start();
require_once 'facebook/libs/facebook.php';

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
    
      //print_r($loginUrl);
		$fbme = "null";


	try {
 $access_token = $facebook->getAccessToken();
     $user      =   $facebook->getUser();

$albums = $facebook->api('/me/albums');

foreach($albums['data'] as $album)
{
        // get all photos for album
        $photos = $facebook->api("/{$album['id']}/photos");
        foreach($photos['data'] as $photo)
        {
                echo "<img src='{$photo['source']}' />", "<br />";
        }
}		
	
/*echo $fql1    =   "SELECT uid,first_name,last_name,pic,name,email FROM user WHERE uid = $user";

$param1  =   array(

	'method'    => 'fql.query',

	'query'     => $fql1,

	'callback'  => ''

);
$fqlResult1   =   $facebook->api($param1);

print_r($fqlResult1);*/

exit();	
			$pic=$fqlResult1[0]['pic'];	
			$email=$fqlResult1[0]['email'];	
			$uid=$fqlResult1[0]['uid'];	
			$name=$fqlResult1[0]['name'];	
				
	
				$sql=@mysql_query("SELECT * FROM user_info where user_id=$uid");
				$getdata=@mysql_fetch_array($sql);
				$rated=@mysql_num_rows($sql);
				
				$date=date('Y-m-d G:i:s'); 
				
				
				
				



		
	} catch (FacebookApiException $e) {
		//print_r($e);
		
		
			echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
	
		exit;
	}
	
	?>
 