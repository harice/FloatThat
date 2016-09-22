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
		


$user_id=$_REQUEST['user_id'];
$pro_id=$_REQUEST['pro_id'];
$ctype=$_REQUEST['ctype'];

$cardnum=$_REQUEST['cardnum'];
$cscnum=$_REQUEST['cscnum'];
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
$phone=$_REQUEST['phone'];
$countries=$_REQUEST['countries'];

$date=date("Y-m-d G:i:s");

$pro_id=$_REQUEST['pro_id'];
/*$language_id=$_REQUEST['lang_id'];*/

mysql_query("update user_info set paymenttype='$ctype',paymenttype='$ctype',cardnumber='$cardnum',cscnum='$cscnum',expirymonth='$month',expiryyear='$year',country='$countries' where user_id=$user_id");

	
mysql_query("insert into tbl_members(user_id,pro_id,date,phone) values ('$user_id','$pro_id','$date','$phone')");
			
		echo	$msg="<font color='#00CC00'>You joined Deal Successfully </font>";
	try {
					$usname=mysql_query("select * from user_info where user_id=$user_id");
					$myname=mysql_fetch_array($usname);
					
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$pro_id."'");
					$productdetail=mysql_fetch_array($productqry);
										
					$cstp=$productdetail['price'];
					$fdate=$productdetail['fdate'];
					
					$shortmsg="Become a memebr at floatthat last date for floath $fdate";
						
					$imgs="http://www.floatthat.net/facebook/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					/*
      				$statusUpdate = $facebook->api("/$user_id/feed", 'post', array('picture'=> "$imgs",'link' => 'https://apps.facebook.com/floatthat','caption' => "visit here ",'name' => "$myname[name]", 'description' => $statuss, 'cb' => "$statuss"));*/
					
				
				echo "<script>window.location.href='https://apps.facebook.com/floatthat/index.php'</script>";
					?>
					
					
					
			<?php


session_start();

require_once 'config.php';

					
					$user_id= $_REQUEST['user_id'];	
					$pro_id= $_REQUEST['pro_id'];	
					
						?>

<style>

.thumb{
    width:100px;
    float: left;
    margin-left: 5px;
    border: solid 1px #ccc;
}
.img {

}

input.chk{
margin-left: 70px;



}

</style>	
<?php /*?><div id="received">
<form action="index.php?m=home" method="post" name="frmreceived">
<?php 
$pro_id=$_REQUEST['pro_id'];
$productqry=mysql_query("select * from tbl_members WHERE pro_id='".$pro_id."'");
					$productdetail=mysql_num_rows($productqry);
?>
<input type="hidden" name="mem_id" value="<?php echo $productdetail;?>" />
<input type="hidden" name="pro_id" value="<?php echo $_REQUEST['pro_id'];?>" />
<input type="hidden" name="user_id" value="<?php echo $_REQUEST['user_id'];?>" />
<table cellpadding="0" cellspacing="0" >
<tr>

<td valign="top" style="border:1px solid #CCC">
		<div style="overflow:auto; width:350">
	<table cellpadding="0" cellspacing="0" width="300">
    <?php 

	   $i=0;
		
		$fql1    =   "SELECT uid,pic_big,pic,pic_small,name FROM user WHERE  uid IN ( SELECT uid2 FROM friend WHERE uid1= $user_id )";
		$param1  =   array(
						
							'method'    => 'fql.query',
						
							'query'     => $fql1,
						
							'callback'  => ''
						
						);
		$fqlResult2   =   $facebook->api($param1);
		
					
												
													
													
													$frndids = "";
													$cnt= 1;
														foreach($fqlResult2 as $friends)
	        {
			if ($i % 3 == 0)
						echo "<tr>";
						echo "<td width='100' align='left' class='s_txt' valign='top' >";?>
            					   
                                
								<div class="imgs">

								<div class="thumb">
								<img src="<?php echo $friends['pic'];?>" height="80" width="80" />
								<input type="checkbox" name="users_id[]" value="<?php echo $friends['user_id'];?>" />
								</div>
								
								<div align="center" style="padding-top:15px;">
                            	<?php echo htmlentities($friends['name'], ENT_QUOTES);?></span><br />
                                	
                                </div> 
                      			</div>
					 		 
					  <?php      echo "</td>";
						$i++;    
					}
						echo "</tr>";
				?>
                
    </table>
</div>
	
</td>

</tr>

<tr><td align="right"><input type="submit" value="Float Users" name="receivedsub"  /></td></tr>

</table>
</form>
</div>		
					
					<?php */?>
					
					
	<?php				} catch (FacebookApiException $e) {
		//print_r($e);
		//echo "<font color='red'>Today Publish Limit Excede</font>";
		exit;
	}

?>                      	
                        
                  