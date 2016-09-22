<?php 
	require_once("config.php");


	$query = "select *  from user_info where   email = '".$_POST['email']."' limit 1 ";
	$arrResults = $commonObject->selectMultiRecords($query);
	if(count($arrResults) > 0)
	{
	
	/*$query = "select *  from users where   secret_q = '".$_POST['seq_qus']."' and answer = '".$_POST['ans']."'  limit 1 ";
	$arrResultsQ = $commonObject->selectMultiRecords($query);
	
	if( count($arrResultsQ) == 0 )
	{
		header("Location: forget_password.php?msg=noq");	
		exit;	
	}*/	

$Subject = "Password Information ";
	$Message = "Here is your password information,<br /><br />

Email: ".$arrResults[0]['email']."
Password: ".$arrResults[0]['password']." 
<br /><br />

 xyz Team

			";	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
	$headers .= "From: info@floatthat.net <info@floatthat.net>\r\n"."Reply-To: ".$_POST['email']."<".$_POST['email'].">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
	
	mail($_POST['email'], $Subject, $Message, $headers);			

		header("Location: forgot-password.php?msg=succ");	
	}
	else
	{
			header("Location: forgot-password.php?msg=no");	

	}	
?>
