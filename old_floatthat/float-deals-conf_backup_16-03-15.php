<?php
@session_start();
require_once("config.php");

function get_tiny_url($url)  {
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
	$data = curl_exec($ch);  
	curl_close($ch);  
	return $data;  
}
	
error_reporting(0);
$list = isset($_SESSION['list']) ?  count($_SESSION['list']) : 0;
$users_id = isset($_SESSION['users_id']) ?  count($_SESSION['users_id']) : 0;
$tw_users_id = isset($_SESSION['tw_users_id']) ?  count($_SESSION['tw_users_id']) : 0;
$data_email_ids = isset($_SESSION['data_email']) ? count($_SESSION['data_email']) : 0;

$date=date("Y-m-d G:i:s");

$inserted = 0;
$pro_id = $_POST['pro_id'];
$productqryimg = mysql_query("select * from tbl_photos WHERE pro_id='".$pro_id."'");
$productdetailimg = mysql_fetch_array($productqryimg);
if($list > 0 || $users_id > 0 || $tw_users_id > 0 || count($_SESSION['data_email']) > 0)
{
		if(count($_SESSION['data_email']) > 0)
		{
			$nmembers = (count($_SESSION['data_email'])+1);
			$users_ids = $userContents['id'];	

			$Query="SELECT * FROM tbl_products WHERE pro_id  = '".$_POST['pro_id']."'";
			$products = $commonObject->selectMultiRecords($Query);
			$query = "insert into tbl_deal(
											user_id,
											pro_id, 
											ods,
											date, 
											status, 
											closestatus,
											type
										) 
										values
										(
											'".$users_ids."',
											'".$_POST['pro_id']."',
											'".$nmembers."',
											NOW(),
											0,
											0,
											'".$_POST['type']."'
										)";
			$result = mysql_query($query);
			$deal_id2 = $deal_id = mysql_insert_id();
			
			mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','".$users_ids."','$date')");
			$inserted = 1;				
		}
		/*$Query="SELECT * FROM tbl_deal WHERE pro_id  = '".$_POST['pro_id']."' and user_id = '".$userContents['id']."' and status = 1 and closestatus = 0 ";
		$deals = $commonObject->selectMultiRecords($Query);
		if(count($deals) > 0)
		{
			header("Location: float-deal.php?msg=exist&id=".$_POST['pro_id']);
			exit;	
		}
		else*/
		if($list > 0 || $users_id > 0 || $tw_users_id > 0)
		{
		$nmembers = $_POST['members'];
		if($_POST['type'] == "group")
		{			
			$nmembers = ( $list + $users_id + 1);
		}
		else
		{
			$nmembers = $_POST['members'];	
		}
				
		if($list > 0)
		{	
		if($user == "")
			$users_ids = $userContents['id'];
		else
			$users_ids = $user;	
		
			
		$Query="SELECT * FROM tbl_products WHERE pro_id  = '".$_POST['pro_id']."'";
		$products = $commonObject->selectMultiRecords($Query);
		$query = "insert into tbl_deal(
										user_id,
										pro_id, 
										ods,
										date, 
										status, 
										closestatus,
										type
									) 
									values
									( 
										'".$users_ids."',
										'".$_POST['pro_id']."',
										'".$nmembers."',
										NOW(),
										0,
										0,
										'".$_POST['type']."'
									)";
		$result = mysql_query($query);
		$deal_id = mysql_insert_id();
		
	
		mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','".$users_ids."','$date')");
		$inserted = 1;							
			for($i=0;$i<$list;$i++)
			{			
					$date=date("Y-m-d G:i:s");
					
					
					mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','".$list[$i]."','$date')");

					$countmem = count($list);
					
				
					
					
					$fmmsname=mysql_query("select * from tbl_members where deal_id=$deal_id");
					$countmem=mysql_num_rows($fmmsname);
					
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
						
							$totmem=$countmem;
							
							//echo "select * from user_info where id='".$userContents['id']."'  OR user_id = '".$userContents['id']."' ";
							//exit;
					$username=mysql_query("select * from user_info where id='".$userContents['id']."'  OR user_id = '".$userContents['id']."' ");
					    $uname=mysql_fetch_array($username);
							
							while($frname=mysql_fetch_array($fmmsname))
							{
					
					//$win=$winner;
					
			 	$fuser = $frname['user_id'];
					
					$shortmsg=$uname['name']." Floated " .$productdetail['title'].  " to ".$countmem." friends You have a 1 in".$countmem."  chance of owning this item. Winner will be announced on ".date('m-d-Y',strtotime($floatdate));
						
					/* $imgs="http://www.floatthat.net/wadmin/gallaryimg/thumbnails/".$productdetailimg['image'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
				*/
							}
							
				
				$Query="SELECT * FROM user_info WHERE id  = '".$list[$i]."' OR user_id = '".$list[$i]."'  limit 1 ";
				//exit;
				$users = $commonObject->selectMultiRecords($Query);	
				$email = 	$users[0]['email'];	
				$from_email = $userContents['email'];
	
				$Subject = $userContents['name']." has floated a product ".$products[0]['title'].' with you.' ;
				$Message = "Hello ".$users[0]['fname'].' '.$users[0]['lname'].",<br /><br />
							
							".$userContents['name']." send you a deal. Click here to view this product.<br><br>
							<a href='http://www.floatthat.net/float-deal.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$list[$i]."'>
							http://www.floatthat.net/float-deal.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$list[$i]."
							</a>
							<br />/n
							<a href='www.floatthat.net/invitations.php'>Invitations</a>
							<br />/n
							<br /><br /><br />
							FloatThat Team 
							<br /><br />
							Important: To stay up to date make sure to add info@floatthat.net in your trusted emails list.";
			
							
				$headers  = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
				$headers .= "From: ".$from_email."<".$from_email.">\r\n"."Reply-To: ".$email."<".$email.">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
				
				mail($email, $Subject, $Message, $headers);					
			}						
		}
	}
if(isset($_POST['cc']) && $_POST['cc'] == "yes")
{
	$user_id=$_REQUEST['user_id'];
	$pro_id=$_REQUEST['pro_id'];
	$ctype=$_REQUEST['ctype'];
	
	$cardnum=$_REQUEST['cardnum'];
	$cscnum=$_REQUEST['cscnum'];
	$month=$_REQUEST['month'];
	$year=$_REQUEST['year'];
	$phone=$_REQUEST['phone'];
	$countries=$_REQUEST['countries'];
	$floatdate=$_REQUEST['closedate'];
	$date=date("Y-m-d G:i:s");

mysql_query("update user_info set paymenttype='$ctype',paymenttype='$ctype',cardnumber='$cardnum',cscnum='$cscnum',expirymonth='$month',expiryyear='$year',country='$countries' where id='".$userContents['id']."'");

}

if( isset($tw_users_id) && $tw_users_id > 0)
{


		 $tw_users_id = count($_SESSION['tw_users_id']);
		 
		 
		
				$usname=mysql_query("select * from user_info where user_id=$user");
					$myname=mysql_fetch_array($usname);
					
				
					$countmem=$users_id+1;
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
					//$fdate=$productdetail['fdate'];

		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."'");
		$betdata=mysql_fetch_array($bet);
		$nmr=mysql_num_rows($bet);
		$date=date('Y-m-d');
		
			if($nmr==0)
			{
				
			mysql_query("insert into tbl_deal(pro_id,user_id,date,ods,type)values('$pro_id','$user','$date', '".$nmembers."','".$_POST['type']."')");
			$deal_id  = $last_deal_id=mysql_insert_id();	
			}
			
			
		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."' order by deal_id desc limit 1");
		$betdata=mysql_fetch_array($bet);
		
		$deal_id=$betdata['deal_id'];	
				
					
mysql_query("update tbl_deal closedate='".date("Y-m-d", strtotime($_POST['closedate']))."' where deal_id=$deal_id");


mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','$user','$date')");
					
	
				
					$mesuser=$user;
					$totmem=($tw_users_id+1);
					$tw_users_id = count($_SESSION['tw_users_id']);
							
					/*$shortmsg=$uname['name']." has Floated " .$productdetail['title'].  " to ".$countmem." friends. You have a 1 in ".$countmem."  chances of winning this item.";
						
					 $imgs="http://www.floatthat.net/wadmin/gallaryimg/thumbnails/".$productdetailimg['image'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$mesuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
							
							$totmem=$users_id+1;
							
						*/	



							require_once('TwitterAPIExchange.php');
							for($i=0;$i<$tw_users_id;$i++)
							{
								
					
					//$win=$winner;
					$fb_users_id = $_SESSION['tw_users_id'][$i];
				//	echo "<br>";
					$fuser = $_SESSION['tw_users_id'][$i];
					$friend_names = $_SESSION['tw_friend_names'][$i];
					$friend_pics = $_SESSION['tw_friend_pics'][$i];
				//	echo "insert into tbl_members(deal_id,user_id,date)values('$deal_id','$fuser','$date')";
				//	echo "<br>";
				//echo $i;

					 $consumerKey = 'fRIciicNhd6vXYZ36VadXgjSr';
					$consumerKeySecret = 'ghJzbdFalS5Hw7xJdUgPm2lQGHQhkmJInUvlEG4UGqKaZo0kH9';
					$accessToken = '575376243-0rqdOeq9RoATqEINNR1oH96SucJC7FJLW9dxn72x';
					$accessTokenSecret = 'UQSVkDDpY9Ba0eiSW44yHlNZ4e21TA9vCP8MYqdIwDMyI';

					$settings = array(
					  'oauth_access_token' => $accessToken,
					  'oauth_access_token_secret' => $accessTokenSecret,
					  'consumer_key' => $consumerKey,
					  'consumer_secret' => $consumerKeySecret
					);

					 $url = 'https://api.twitter.com/1.1/users/show.json';
					  //$getfield = '?cursor='.$cursor.'&screen_name='.$screen_name='RanaNaskar'.'&skip_status=true&include_user_entities=false';
					  $getfield = '?user_id='.$fuser;
					  $requestMethod = 'GET';
					  $twitter = new TwitterAPIExchange($settings);
					  $response = $twitter->setGetfield($getfield)
					                      ->buildOauth($url, $requestMethod)
					                      ->performRequest();
					 
					  $response = json_decode($response, true);

					  $existing=mysql_fetch_array(mysql_query("select * from user_info where user_id='$fuser'"));

					  $last_id=0;

					  if(empty($existing)){
					  	$user_name=$response['screen_name'];
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
															'".$fuser."',
															'".$pic=""."',
															'".$user_name."',
															'".$user_name."@floatthat.net"."',
															'".$password="twitter9211pass"."',
															1,
															2,
															'".$user_name."',
															2
														 )	
						";
						$result = mysql_query($query);

						$last_id = mysql_insert_id();
					  } else {
					  	$last_id=$existing['id'];
					  }

					  
					  /* Add a new deal */
					  
					// $ins_sql="insert into tbl_members(deal_id,user_id,date,friend_names,friend_pics,t1) values ('$deal_id','$last_id','$date','$friend_names','$friend_pics',1)";
					// $restu = mysql_query($ins_sql);


					// $url_org="http://www.floatthat.net/float-deal.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$last_id;
					$url_org="http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$last_id."&deal_id=".$deal_id;
					// $url_org="http://www.floatthat.net/float-deal.php?id=".$_POST['pro_id']."&from=".$userContents['id'];
					$urls=get_tiny_url($url_org);
					$tw_status = $userContents['name']."
							Floated a product. \n
							Click on the link $urls to view this product\n
							FloatThat Team";

					$url = "https://api.twitter.com/1.1/direct_messages/new.json";
				  $getfield = '?status='.$tw_status.'&user_id='.$fuser;
				  $pst_field=array(
				  	"text"=>$tw_status,
				  	"user_id"=>$fuser
				  	);
				  $requestMethod = 'POST';
				  $twitter = new TwitterAPIExchange($settings);
				  $response = $twitter->setPostfields($pst_field)
                      ->buildOauth($url, $requestMethod)
                      ->performRequest();
										
					
					
							}
/*			$Query=mysql_query("SELECT * FROM tbl_products WHERE pro_id  = '".$pro_id."'");
							$products = mysql_fetch_array($Query);	
							
							$amount = ($products['price'] / $_POST['members']);			
				?>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="buypro" id="buypro" target="_top">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="business" value="aliirizvi1975@hotmail.com">
	<input type="hidden" name="currency_code" value="USD">
	
		<input type="hidden" name="item_number_1" value="<?php echo $products['pro_id']?>">
		<input type="hidden" name="item_name_1" value="<?php echo $products['title']?>">
		<input type="hidden" name="amount_1" value="<?=number_format($amount,2)?>">
	
		<input type="hidden" name="quantity" value="1">	
		<input type="hidden" name="return" value="https://www.floatthat.net/thanks.php?item_number=<?php echo $_POST['type'].'&deal_id='.$deal_id;?>">
		<input type="hidden" name="cancel_return" value="https://www.floatthat.net/cancel.php">
		<input type="hidden" name="amount" value="<?=number_format($amount,2)?>">
	
		
	</form>
	
			
				<script type="text/javascript">
				<!--
					setTimeout(function( ) { document.buypro.submit( ); }, 100);
				-->
				</script>  
                
                <?php*/			
		
}
if( $users_id > 0)
{
	 
		 $user_id=$_SESSION['users_id'];
		 
		 
		
				$usname=mysql_query("select * from user_info where user_id=$user");
					$myname=mysql_fetch_array($usname);
					
				
					$countmem=$users_id+1;
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
					//$fdate=$productdetail['fdate'];

		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."'");
		$betdata=mysql_fetch_array($bet);
		$nmr=mysql_num_rows($bet);
		$date=date('Y-m-d');
		
			if($nmr==0)
			{
				
			mysql_query("insert into tbl_deal(pro_id,user_id,date,ods,type)values('$pro_id','$user','$date', '".$nmembers."','".$_POST['type']."')");
			$deal_id  = $last_deal_id=mysql_insert_id();	
			}
			
			
		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."' order by deal_id desc limit 1");
		$betdata=mysql_fetch_array($bet);
		
		$deal_id=$betdata['deal_id'];	
				
					
mysql_query("update tbl_deal closedate='".date("Y-m-d", strtotime($_POST['closedate']))."' where deal_id=$deal_id");


mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','$user','$date')");
					
	
				
					$mesuser=$user;
					$totmem=$users_id+1;
					$fb_users_id = $_SESSION['users_id'][0];
							
					$shortmsg=$uname['name']." has Floated " .$productdetail['title'].  " to ".$countmem." friends. You have a 1 in ".$countmem."  chances of winning this item.";
						
					 $imgs="http://www.floatthat.net/wadmin/gallaryimg/thumbnails/".$productdetailimg['image'];
					$statuss      	= $shortmsg;
				//	$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				/*$statusUpdate = $facebook->api("/$mesuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));*/
							
							$totmem=$users_id+1;
							
							
							
							for($i=0;$i<$users_id;$i++)
							{
								
					
					//$win=$winner;
					$fb_users_id = $_SESSION['users_id'][$i];
				//	echo "<br>";
					$fuser = $_SESSION['users_id'][$i];
					$friend_names = $_SESSION['friend_names'][$i];
					$friend_pics = $_SESSION['friend_pics'][$i];
				//	echo "insert into tbl_members(deal_id,user_id,date)values('$deal_id','$fuser','$date')";
				//	echo "<br>";
				
				
					mysql_query("insert into tbl_members(deal_id,user_id,date,friend_names,friend_pics)
					values
					('$deal_id','$fuser','$date','$friend_names','$friend_pics')");
										
					
					/*$shortmsg=$uname['name']." Floated " .$productdetail['title'].  " to ".$countmem." friends You have a 1 in".$countmem."  chance of owning this item. Winner will be announced on ".date('m-d-Y',strtotime($floatdate));
						
					 $imgs="http://www.floatthat.net/wadmin/gallaryimg/thumbnails/".$productdetailimg['image'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));*/
							}
/*			$Query=mysql_query("SELECT * FROM tbl_products WHERE pro_id  = '".$pro_id."'");
							$products = mysql_fetch_array($Query);	
							
							$amount = ($products['price'] / $_POST['members']);			
				?>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="buypro" id="buypro" target="_top">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="business" value="aliirizvi1975@hotmail.com">
	<input type="hidden" name="currency_code" value="USD">
	
		<input type="hidden" name="item_number_1" value="<?php echo $products['pro_id']?>">
		<input type="hidden" name="item_name_1" value="<?php echo $products['title']?>">
		<input type="hidden" name="amount_1" value="<?=number_format($amount,2)?>">
	
		<input type="hidden" name="quantity" value="1">	
		<input type="hidden" name="return" value="https://www.floatthat.net/thanks.php?item_number=<?php echo $_POST['type'].'&deal_id='.$deal_id;?>">
		<input type="hidden" name="cancel_return" value="https://www.floatthat.net/cancel.php">
		<input type="hidden" name="amount" value="<?=number_format($amount,2)?>">
	
		
	</form>
	
			
				<script type="text/javascript">
				<!--
					setTimeout(function( ) { document.buypro.submit( ); }, 100);
				-->
				</script>  
                
                <?php*/			
							
	}
        
      

if( count($_SESSION['data_email']) > 0)
{
	// for($i=0;$i<count($_SESSION['data_email']);$i++)
	// {

	foreach($_SESSION['data_email'] as $i=>$em) {

		$query = "insert into invitations(
										friend_email, 
										friend_name,
										deal_id,
										user_id,
										pro_id, 
										created, 
										type
									) 
									values
									(
										'".$_SESSION['data_email'][$i]."',
										'".$_SESSION['data_name'][$i]."',
										'".$deal_id."',
										'".$userContents['id']."',
										'".$_POST['pro_id']."',
										NOW(),
										'".$_POST['type']."'
									)";
		$result = mysql_query($query);
		//echo "<br>";echo "<br>";
		$Query="SELECT * FROM tbl_products WHERE pro_id  = '".$_POST['pro_id']."'";
		$products = $commonObject->selectMultiRecords($Query);
							
		$email = 	$_SESSION['data_email'][$i];
		$from_email = $userContents['email'];

		$Subject = $userContents['name']." has floated a product ".$products[0]['title'].' with you.' ;
		$Message = "<html><body>Hello ".$_SESSION['data_name'][$i].",<br /><br />
					
					".$userContents['name']." send you a deal. Click here to view this product.<br><br>
					<a href='http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&deal_id=".$deal_id2."'>http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&deal_id=".$deal_id2."</a>
					
					<br /><br /><br />
					FloatThat Team 
					<br /><br />
					Important: To stay up to date make sure to add info@floatthat.co.uk in your trusted emails list.</body></html>";
	
					
		// $headers  = "MIME-Version: 1.0\r\n";
		// $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
		// $headers .= "From: ".$from_email."<".$from_email.">\r\n"."Reply-To: ".$email."<".$email.">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";

		$headers = "From: " . strip_tags($from_email) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($from_email) . "\r\n";
		//$headers .= "CC: susan@example.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $from_email = "timcuban@floatthat.net";

		$mail->setFrom($from_email,'Floatthat');

		$mail->addReplyTo($from_email);

		$mail->addAddress($email);

		$mail->Subject = $Subject;

		$mail->isHTML(true);

		$mail->Body = $Message;
                

		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
                }
                
                
                
                
		
		// if(mail($email, $Subject, $Message, $headers)){
		// 	echo "Sent To:- ".$email."<br/>";
		// }else{
		// 	echo "<pre>";
		// 	var_dump(error_get_last());
		// 	exit;
		// }							
	}	
}

if( $users_id > 0 ||  $tw_users_id > 0 || count($_SESSION['data_email']) > 0)
{
			$Query=mysql_query("SELECT * FROM tbl_products WHERE pro_id  = '".$pro_id."'");
							$products = mysql_fetch_array($Query);	
							if(count($_SESSION['data_email']) > 0)
								$amount = ($products['price'] / (count($_SESSION['data_email']) + 1));
							else
								$amount = ($products['price'] / $_POST['members']);			
				?>
<!--              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="buypro" id="buypro" target="_top">
--><form name="buypro" id="buypro" target="_top" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> 

	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<!--<input type="hidden" name="business" value="aliirizvi1975@hotmail.com">-->
 <input type="hidden" name="business" value="saesd-facilitator@arhamsoft.com" />
	<input type="hidden" name="currency_code" value="USD">
	
		<input type="hidden" name="item_number_1" value="<?php echo $products['pro_id']?>">
		<input type="hidden" name="item_name_1" value="<?php echo $products['title']?>">
		<input type="hidden" name="amount_1" value="<?=number_format($amount,2)?>">
	
		<input type="hidden" name="quantity" value="1">	
		<input type="hidden" name="return" value="http://www.floatthat.net/thanks.php?item_number=<?php echo $_POST['type'].'&deal_id='.$deal_id;?>">
		<input type="hidden" name="cancel_return" value="http://www.floatthat.net/thanks.php?item_number=<?php echo $_POST['type'].'&deal_id='.$deal_id;?>">
		<!-- <input type="hidden" name="cancel_return" value="http://www.floatthat.net/cancel.php"> -->
		<input type="hidden" name="amount" value="<?=number_format($amount,2)?>">
	
		
	</form>
	
			
				<script type="text/javascript">
				
					setTimeout(function( ) { document.buypro.submit( ); }, 100);
				
				</script>  
                
                <?php
}




	//exit;
if($_POST['type'] == 'group')
{
  

	mysql_query("insert into tbl_group_members(deal_id,person_name,email,occusion_id,created)
				values
					('$deal_id','".$_SESSION['person_name']."','".$_SESSION['email']."','".$_SESSION['occusion']."',NOW())");
		 		
		if($_SESSION['infrom'] == 1)
		{
			$Subject = $userContents['fname'].' '.$userContents['lname']." has floated a product ".$products[0]['title'].' with you.' ;
			$Message = "Hello ".$_SESSION['person_name'].",<br /><br />
						
						".$userContents['name']." send you a deal. Click here to view this product.<br><br>
						<a href='http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$users[0]['id']."'>http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$users[0]['id']."</a>
						
						<br /><br /><br />
						FloatThat Team 
						<br /><br />
						Important: To stay up to date make sure to add info@floatthat.net in your trusted emails list.";
		
						
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
			$headers .= "From: ".$from_email."<".$from_email.">\r\n"."Reply-To: ".$email."<".$email.">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
			
			//mail($_SESSION['email'], $Subject, $Message, $headers);			

			$mail->setFrom($from_email);

			$mail->addReplyTo($from_email);

			$mail->addAddress($_SESSION['email']);

			$mail->Subject = $Subject;

			$mail->isHTML(true);

			$mail->Body = $Message;
                        
                        	
			if (!$mail->send()) {
			    echo "Mailer Error: " . $mail->ErrorInfo;
			}
		}

		$_SESSION['person_name'] = '';
		$_SESSION['email'] = '';	
		$_SESSION['occusion'] = '';
}			
//exit;

		
		$Query="SELECT * FROM tbl_products WHERE pro_id  = '".$_POST['pro_id']."'";
               
		$products = $commonObject->selectMultiRecords($Query);
		$ncount = (count($list) + count($_SESSION['users_id']) +1);
		$amount = ($products[0]['price'] / $ncount);
	?>
	
			<?php
		
			
		
		//else
		//{		
				//	echo "i am rer";
		//header("Location: success.php?msg=succ&id=".$_POST['pro_id']);	
		// send user to payment page	
		//exit;
		//}
	}
	
		/*echo "<script>//window.location.href='https://apps.facebook.com/floatthat/floatwebmembers.php'</script>";*/
	
		
?>
