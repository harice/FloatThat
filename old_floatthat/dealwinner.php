<?php 
//@ini_set('session.gc_maxlifetime', 50);
//@ini_set('session.gc_divisor', 1);
@session_start();
require_once 'config.php';
$imgs="https://www.floatthat.net/wadmin/gallaryimg/gallaryphotos/1424933880_1_cod-mw.jpg";
$muser="1380684852248396";

$statuss="You are the winner of Call Of Duty 4 DVD";

// $qry_str = "?client_id=743102912465318&client_secret=a6108fd3bc01201a25f8dcaf3fa99342&grant_type=email,user_likes, publish_stream,offline_access";

// $ch = curl_init();

// // Set query data here with the URL
// curl_setopt($ch, CURLOPT_URL, 'http://example.com/test.php' . $qry_str); 

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_TIMEOUT, '3');
// $content = trim(curl_exec($ch));
// curl_close($ch);

// /oauth/access_token?
//      client_id={app-id}
//     &client_secret={app-secret}
//     &grant_type=client_credentials

// try {
// 	// Proceed knowing you have a logged in user who's authenticated.
// 	$statusUpdate = $facebook->api("/$muser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/','caption' => "visit here ",'name' => "Rana Naskar", 'description' => $statuss, 'cb' => "$statuss"));
// } catch (FacebookApiException $e) {
// 	echo "<pre>";
// 	var_dump($e);
// 	exit;
// }
// exit;
// require_once 'libs/facebook.php';

// $database_host = "50.63.108.69";//50.63.108.69
// $database_name = "floatthat";
// $database_user = "floatthat";
// $database_pass = "Pass123!@#";

// $connection=mysql_connect($database_host,$database_user,$database_pass) or die("cant connect to the serveer");
// $fblink = mysql_select_db($database_name, $connection) or die("cant connect to the database");
 
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



// $facebook = new Facebook(array(
//     'appId' => '468197239904388',
//     'secret' => 'e10ef7cc449c2e375948750dfd116a73',
//     'cookie' => true,
// 	'domain' => "floatthat.net",
// ));

//  $access_session =$facebook->getUser();
//  //print_r($access_session);
//      $loginUrl = $facebook->getLoginUrl(array(
//      'canvas' => 1,
//      'fbconnect' => 0,
//      'scope' => 'email,read_stream, publish_stream,offline_access',
// 	 'redirect_uri' => 'https://floatthat.net/',
// ));
      //print_r($loginUrl);
		$fbme = "null";


	try {
 		
	
	$date=date('Y-m-d');
	
	$sqldeal=@mysql_query("SELECT tbl_deal.*,(SELECT COUNT(*) FROM tbl_members as mm WHERE mm.deal_id = tbl_deal.deal_id) total FROM tbl_deal where status='1' and closestatus='0'") or die(mysql_error());
	
	while($deal_id=mysql_fetch_array($sqldeal))
	{
		if($deal_id['total']==$deal_id['ods']){
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
			
				//$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://www.floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
			
			//$statusUpdate = $facebook->api("/1222526519/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
			
			$sql2=@mysql_query("SELECT tm.*,ui.name,ui.email,ui.tw,ui.fb FROM tbl_members as tm inner join user_info as ui on ui.id=tm.user_id where tm.deal_id= $deal_id[deal_id] and tm.status=1") or die(mysql_error());
			while($getdata2=@mysql_fetch_array($sql2))
			{

				$muser=$getdata2['user_id'];

				if($getdata2['user_id']!=$getdata['user_id']) {
					$Subject = $shortmsg;
					$Message = "<html><body>
						".$uname['name']." is the winner of <b>".$productdetail['title']."</b>.
						<br /><br /><br />
						FloatThat Team 
						<br /><br />
						Important: To stay up to date make sure to add info@floatthat.co.uk in your trusted emails list.</body></html>";

					$fbshortmsg=$uname['name']." Become a Winner Of ".$productdetail['title'];
					$fbshortmsg = htmlentities($fbshortmsg, ENT_QUOTES);
				} else {
					$Subject="You are the winner of ".$productdetail['title'];
					$Message = "<html><body>
						Congrats! You are the winner of <b>".$productdetail['title']."</b>.
						<br /><br /><br />
						FloatThat Team 
						<br /><br />
						Important: To stay up to date make sure to add info@floatthat.co.uk in your trusted emails list.</body></html>";

					$fbshortmsg="Congrats! You are the Winner Of ".$productdetail['title'];
					$fbshortmsg = htmlentities($fbshortmsg, ENT_QUOTES);
				}

				// if($getdata2['fb']=="2") {
				// 	$statusUpdate = $facebook->api("/$muser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
				// } else if($getdata2['tw']=="2") {

				// }

				$email = $getdata2['email'];

				$mail = new PHPMailer;
				// $mail->SMTPDebug = 2;

				//Ask for HTML-friendly debug output
				// $mail->Debugoutput = 'html';

				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'mail.floatthat.net';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'timcuban@floatthat.net';                 // SMTP username
				$mail->Password = 'M?w]_#x3!tZL';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 25;

				$from_email="timcuban@floatthat.net";

				$mail->setFrom($from_email,'Floatthat');

				$mail->addReplyTo($from_email);

				$mail->addAddress($email);

				$mail->Subject = $Subject;

				$mail->isHTML(true);

				$mail->Body = $Message;

				if (!$mail->send()) {
				    echo "Mailer Error: " . $mail->ErrorInfo;
				}else{
					echo "Sent to: " . $email."</br>";
				}


			}
		}
	}
				
				
	} catch (FacebookApiException $e) {
		//print_r($e);
		
		
			echo "aaa";
	
		exit;
	}
