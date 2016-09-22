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
		
		$deal_id=$_REQUEST['deal_id'];
		
	
		
	try {
				


					
						$fusname=mysql_query("select * from tbl_deal where deal_id=$deal_id");
					    $frname=mysql_fetch_array($fusname);
					
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$frname['pro_id']."'");
					$productdetail=mysql_fetch_array($productqry);
					
					
					
					$fmmsname=mysql_query("select * from tbl_members where deal_id=$deal_id");
					$countmem=mysql_num_rows($fmmsname);
					
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
						
							$totmem=$countmem;
							
							
					$username=mysql_query("select * from user_info where user_id=$user");
					    $uname=mysql_fetch_array($username);
							
							while($frname=mysql_fetch_array($fmmsname))
							{
					
					//$win=$winner;
			 	$fuser=$frname['user_id'];
					
					
					
					$shortmsg="This is reminder that ".$uname['name']." Floated " .$productdetail['title'].  " to ".$countmem." friends You have a 1 in".$countmem."  chance of owning this item. Winner will be announced on ".date('m-d-Y',strtotime($floatdate));
						
					$imgs="http://www.floatthat.net/facebook/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://apps.facebook.com/floatthat','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
					
							}
				
			
				
	   ?>
    <div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px;" align="left">
    
    Reminder Sent Successfully <a href="<?php echo $apppath;?>index.php?m=mydeals" target="_top"><input type="button" value="Go Back" /></a>
    
    </div>
   
  
   
   <?php				} catch (FacebookApiException $e) {
		//print_r($e);
		//echo "<font color='red'>Today Publish Limit Excede</font>";
		exit;
	}

?>                      	
           