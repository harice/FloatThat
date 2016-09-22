<?
	require_once("config.php");
	
	if($_POST['friends'] != '')
	{
		$Query="SELECT * FROM tbl_products WHERE pro_id  = '".$_POST['pro_id']."'";
		$products = $commonObject->selectMultiRecords($Query);
			
			$friends = explode(",",$_POST['friends']);		
			for($i=0;$i<count($friends);$i++)
			{
							
				$query = "insert into invitations(
												friend_email, 
												user_id,
												pro_id, 
												date, 
												closedate,
												type
											) 
											values
											(
												'".$friends[$i]."',
												'".$userContents['id']."',
												'".$_POST['pro_id']."',
												NOW(),
												'".$_POST['closedate']."',
												'".$_POST['type']."'
											)";
				$result = mysql_query($query);
				
				$Query="SELECT * FROM user_info WHERE email  = '".$friends[$i]."' limit 1 ";
				$users = $commonObject->selectMultiRecords($Query);	
				$email = 	$users[0]['email'];	
				$from_email = $userContents['email'];
	
				$Subject = $userContents['fname'].' '.$userContents['lname']." has floaded a product ".$products[0]['title'].' with you.' ;
				$Message = "Hello ".$users[0]['fname'].' '.$users[0]['lname'].",<br /><br />
							
							".$userContents['fname'].' '.$userContents['lname']." send you a deal. Click here to view this product.<br><br>
							http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."&to=".$users[0]['id']."
							
							The closing date of this deal is ".$_POST['closedate'].". 
							<br /><br /><br />
							FloatThat Team 
							<br /><br />
							Important: To stay up to date make sure to add info@floatthat.co.uk in your trusted emails list.";
			
							
				$headers  = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
				$headers .= "From: ".$from_email."<".$from_email.">\r\n"."Reply-To: ".$email."<".$email.">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
				
				mail($email, $Subject, $Message, $headers);					
			}						
		header("Location: invite-friends.php?msg=succ&id=".$_POST['pro_id'].'&type='.$_POST['type']);		
		exit;
	}
	else
	{
		header("Location: invite-friends.php?msg=no&id=".$_POST['pro_id'].'&type='.$_POST['type']);
		exit;
	}
	

		
?>
