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
												created, 
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
				$result = mysql_query($query) or die(mysql_error());
				
				// $Query="SELECT * FROM user_info WHERE email  = '".$friends[$i]."' limit 1 ";
				// $users = $commonObject->selectMultiRecords($Query);	
				$email = 	$friends[$i];	
				$from_email = $userContents['email'];
	
				$Subject = $userContents['fname'].' '.$userContents['lname']." has floaded a product ".$products[0]['title'].' with you.' ;
				$Message = "Hello ,<br /><br />
							
							".$userContents['fname'].' '.$userContents['lname']." send you a deal. Click here to view this product.<br><br>
							http://www.floatthat.net/product-details.php?id=".$_POST['pro_id']."&from=".$userContents['id']."
							
							
							<br /><br /><br />
							FloatThat Team 
							<br /><br />
							Important: To stay up to date make sure to add info@floatthat.co.uk in your trusted emails list.";
			
				$headers  = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
				$headers .= "From: ".$from_email."<".$from_email.">\r\n"."Reply-To: ".$email."<".$email.">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
				
				// mail($email, $Subject, $Message, $headers);
				$from_email="timcuban@floatthat.net";
				$mail->setFrom($from_email,'Floatthat');

				$mail->addReplyTo($from_email);

				$mail->addAddress($email);

				$mail->Subject = $Subject;

				$mail->isHTML(true);

				$mail->Body = $Message;

				if (!$mail->send()) {
				    echo "Mailer Error: " . $mail->ErrorInfo;
				}					
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
