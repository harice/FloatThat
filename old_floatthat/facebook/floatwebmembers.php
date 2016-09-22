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

		
		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' order by deal_id desc limit 1");
		$betdata=mysql_fetch_array($bet);
		
		$deal_id=$betdata['deal_id'];
 					
			$productqryimg=mysql_query("select * from tbl_photos WHERE pro_id='".$betdata['pro_id']."'");
					$productdetailimg=mysql_fetch_array($productqryimg);
						
							$Query=mysql_query("SELECT * FROM tbl_products WHERE pro_id  = '".$betdata['pro_id']."'");
							$products = mysql_fetch_array($Query);
							
							$pname=$products['title'];
					
							$fmmsname=mysql_query("select * from tbl_members where deal_id=$deal_id");
							$totmem=mysql_num_rows($fmmsname);
					
					
					$amount = ($products['price'] / $totmem);
							
							$shortmsg="started a deal Total Cost is ".$products['price']." Total Memberrs ".$totmem." and you have to pay $".$amount." last date for float $fdate";
							$imgs="http://www.floatthat.net/wadmin/gallaryimg/thumbnails/".$productdetailimg['image'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
					
					$attachment =  array(
                              'access_token' => $access_token,
                              'message' => "$shortmsg",
                              'name' => "$name",
                              'description' => "$description",
                              'link' => "$link",
                              'picture' => "$imgs",
                              'actions' => array('name'=>'Float That', 'link' => "http://www.floatthat.net/index.php")
                          );

	
							while($members=mysql_fetch_array($fmmsname))
							{
					
					//$win=$winner;
					 $fuser=$members['user_id'];
					
					
					
					
						
					
                  
                      $post_id = $facebook->api("/$fuser/feed","POST",$attachment);
                  
					
      				/*$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'http://www.floatthat.net/index.php','caption' => "visit here ",'name' => "$name", 'description' => $statuss, 'cb' => "$statuss"));*/
					
					echo "success";
							}
	
					
			
?>
<div style="width:700px;">
Payment Form
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
	
		<input type="submit" value="Payment page" />
	</form>
	
	</div>		
				
				<?php 
				
				} catch (FacebookApiException $e) {
		//print_r($e);
		
		
	}
}	
				
				?>
				
                