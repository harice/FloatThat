<?php
require_once("config.php");
try {	
	error_reporting(0);
	$list = $_SESSION['list'];
	$users_id = $_SESSION['users_id'];
	$date=date("Y-m-d G:i:s");
	//	print_r($user_id);
	$inserted = 0;
	if(count($list) > 0 || count($users_id) > 0)
	{
		/*$Query="SELECT * FROM tbl_deal WHERE pro_id  = '".$_POST['pro_id']."' and user_id = '".$userContents['id']."' and status = 1 and closestatus = 0 ";
		$deals = $commonObject->selectMultiRecords($Query);
		if(count($deals) > 0)
		{
			header("Location: float-deal.php?msg=exist&id=".$_POST['pro_id']);
			exit;	
		}
		else*/
		
		$nmembers = $_POST['members'];
		if($_POST['type'] == "group")
		{			
			$nmembers = ( count($list) + count($users_id) + 1);
		}
		else
		{
			$nmembers = $_POST['members'];	
		}
				
		if(count($list) > 0)
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
			for($i=0;$i<count($list);$i++)
			{			
					$date=date("Y-m-d G:i:s");
					mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','".$list[$i]."','$date')");

					$countmem = count($list);
					
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$_POST['pro_id']."'");
					$productdetail=mysql_fetch_array($productqry);
					
					
					
					$fmmsname=mysql_query("select * from tbl_members where deal_id=$deal_id");
					$countmem=mysql_num_rows($fmmsname);
					
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
						
							$totmem=$countmem;
							
							
					$username=mysql_query("select * from user_info where id='".$userContents['id']."'");
					    $uname=mysql_fetch_array($username);
							
							while($frname=mysql_fetch_array($fmmsname))
							{
					
					//$win=$winner;
			 	$fuser = $frname['user_id'];
				if($frname['user_id'] != "" && $user != "")
				{	
					$shortmsg=$uname['name']." Floated " .$productdetail['title'].  " to ".$countmem." friends You have a 1 in".$countmem."  chance of owning this item. Winner will be announced on ".date('m-d-Y',strtotime($floatdate));
						
					$imgs="http://www.floatthat.net/facebook/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$uname[name]", 'description' => $statuss, 'cb' => "$statuss"));
				}
							}
							
				
				$Query="SELECT * FROM user_info WHERE id  = '".$list[$i]."' limit 1 ";
				$users = $commonObject->selectMultiRecords($Query);	
				$email = 	$users[0]['email'];	
				$from_email = $userContents['email'];
	
				$Subject = $userContents['name']." has floated a product ".$products[0]['title'].' with you.' ;
				$Message = "Hello ".$users[0]['fname'].' '.$users[0]['lname'].",<br /><br />
							
							".$userContents['name']." send you a deal. Click here to view this product.<br><br>
							<a href='http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$list[$i]."'>
							http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$list[$i]."
							</a>
							<br />/n
							<a href='https://floatthat.net/invitations.php'>Invitations</a>
							<br />/n
							The closing date of this deal is ".$_POST['closedate'].". 
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

if($_POST['cc'] == "yes")
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


if( count($_SESSION['users_id']) > 0)
{
	 
		 $user_id=$_SESSION['users_id'];
		 //print_r($users_id);
				$usname=mysql_query("select * from user_info where user_id=$user");
					$myname=mysql_fetch_array($usname);
					
					$pro_id=$_POST['pro_id'];
					$countmem=count($users_id)+1;
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$pro_id."'");
					$productdetail=mysql_fetch_array($productqry);
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
					//$fdate=$productdetail['fdate'];
if($deal_id > 0)
{}
else	
{
		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."'");
		$betdata=mysql_fetch_array($bet);
		$nmr=mysql_num_rows($bet);
		$date=date('Y-m-d');
		
			///if($nmr==0)
			{
			mysql_query("insert into tbl_deal(pro_id,user_id,date,ods,type)values('$pro_id','$user','$date', '".$nmembers."','".$_POST['type']."')");
			$deal_id  = $last_deal_id=mysql_insert_id();	
			}
			
			
	//	$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."' order by deal_id desc limit 1");
	//	$betdata=mysql_fetch_array($bet);
		
	//	$deal_id=$betdata['deal_id'];	
}				
					
mysql_query("update tbl_deal closedate='".date("Y-m-d", strtotime($_POST['closedate']))."' where deal_id=$deal_id");

if($inserted == 0)
	mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','$user','$date')");

				
					
					$totmem=count($users_id)+1;
					$fb_users_id = $users_id[0];
							
					$shortmsg="Started a deal Total Cost is ".$cstp." Total Memberrs ".$totmem." and you have to pay $".$expectedprice." last date for float ";
						
					$imgs="http://www.floatthat.net/facebook/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
				//echo $myname[name]$fb_users_id."i am here 3";exit;
//$statusUpdate = $facebook->api("/$fb_users_id/feed", 'post', array('picture'=>  "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => " ",'name' => "$myname[name]", 'description' => $statuss, 'cb' => "$statuss"));

							
							$totmem=count($users_id)+1;
							
							for($i=0;$i<count($users_id);$i++)
							{
					
					//$win=$winner;
					$fb_users_id = $users_id[$i];
				//	echo "<br>";
					$fuser = $users_id[$i];
				//	echo "insert into tbl_members(deal_id,user_id,date)values('$deal_id','$fuser','$date')";
				//	echo "<br>";
					mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','$fuser','$date')");
										
					
					$shortmsg="started a deal Total Cost is ".$cstp." Total Memberrs ".$totmem." and you have to pay $".$expectedprice." last date for float ";
						
					$imgs="http://www.floatthat.net/facebook/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
      				//$statusUpdate = $facebook->api("/$fb_users_id/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$myname[name]", 'description' => $statuss, 'cb' => "$statuss"));
//$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://floatthat.net/invitations.php','caption' => "visit here ",'name' => "$myname[name]", 'description' => $statuss, 'cb' => "$statuss"));
					
							}
	}


if( count($_SESSION['data_email']) > 0)
{
	for($i=1;$i<=count($_SESSION['data_email']);$i++)
	{


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
		$Message = "Hello ".$_SESSION['data_name'][$i].",<br /><br />
					
					".$userContents['name']." send you a deal. Click here to view this product.<br><br>
					<a href='http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$users[0]['id']."'>http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$users[0]['id']."</a>
					
					<br /><br /><br />
					FloatThat Team 
					<br /><br />
					Important: To stay up to date make sure to add info@floatthat.co.uk in your trusted emails list.";
	
					
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
		$headers .= "From: ".$from_email."<".$from_email.">\r\n"."Reply-To: ".$email."<".$email.">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
		
		mail($email, $Subject, $Message, $headers);							
	}	
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
						Important: To stay up to date make sure to add info@floatthat.co.uk in your trusted emails list.";
		
						
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
			$headers .= "From: ".$from_email."<".$from_email.">\r\n"."Reply-To: ".$email."<".$email.">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
			
			mail($_SESSION['email'], $Subject, $Message, $headers);			
		}			
		$_SESSION['person_name'] = '';
		$_SESSION['email'] = '';	
		$_SESSION['occusion'] = '';
}			
//exit;

		//if($_POST['type'] == 'group')
		{
		$Query="SELECT * FROM tbl_products WHERE pro_id  = '".$_POST['pro_id']."'";
		$products = $commonObject->selectMultiRecords($Query);
		$ncount = (count($list) + count($_SESSION['users_id']) +1);
		$amount = ($products[0]['price'] / $ncount);
	?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="buypro" id="buypro">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="business" value="aliirizvi1975@hotmail.com">
	<input type="hidden" name="currency_code" value="USD">
	
		<input type="hidden" name="item_number_1" value="<?php echo $products[0]['pro_id']?>">
		<input type="hidden" name="item_name_1" value="<?php echo $products[0]['title']?>">
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
			<?php
		
			
		}	
		//else
		//{		
				//	echo "i am rer";
		//header("Location: success.php?msg=succ&id=".$_POST['pro_id']);	
		// send user to payment page	
		//exit;
		//}
	}
	/*else
	{
		header("Location: float-deal.php?msg=no&id=".$_POST['pro_id']);
		exit;
	}*/

} catch (FacebookApiException $e) {
		//print_r($e);
		//echo "<font color='red'>Today Publish Limit Excede</font>";
		exit;
	}	

		
?>
