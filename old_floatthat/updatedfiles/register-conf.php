<?
	require_once("config.php");
		
	if(trim($_POST['id']) == "")
	{
	
	if(trim($_FILES["avatar"]["tmp_name"]) != "")
	{
		  $avatar = strtotime(date("Y-m-d  g:i")).$_FILES["avatar"]["name"];
		  if(move_uploaded_file($_FILES["avatar"]["tmp_name"],"./avatar/" .$avatar) )
		  {
				$avatar = $avatar;
		  }
	}
		
		$Query="SELECT * FROM user_info WHERE email= '".$_POST['mail']."'";
		$user_array = $commonObject->selectMultiRecords($Query);	
		if( count($user_array) > 0)
		{
			header("Location: register.php?msg=exist");
			exit();
		}	
			$query = "
					insert into user_info  
												(
												  fname,
												  lname,
												  name,
												  email,
												  password,
												  phone,
												  fax,
												 `address1`,
												 `address2`,
												 `city`,
												 `state`,
											     `country`,
												 `postcode`,
												  pic,											  
												  status
												 )
												 values
												 (
												 	'".$_POST['firstName']."',
													'".$_POST['secondName']."',
													'".$_POST['firstName'].' '.$_POST['secondName']."',
													'".$_POST['mail']."',
													'".$_POST['pass']."',
													'".$_POST['tele']."',													
													'".$_POST['fax']."',
													'".$_POST['firstAddress']."',
													'".$_POST['secondAddress']."',
													'".$_POST['city']."',
													'".$_POST['state']."',
													'".$_POST['country']."',
													'".$_POST['postCode']."',
													'".$avatar."',
													1
												 )	
				";
				$result = mysql_query($query);
				
				$insert_id = $user_id = mysql_insert_id();
				
				$query = "update user_info set user_id = '".$user_id."' where id = '".$user_id."'";		
				$result = mysql_query($query);
								
	$Query="SELECT * FROM invitations WHERE friend_email= '".$_POST['mail']."'";
	$user_array = $commonObject->selectMultiRecords($Query);	
	if( count($user_array) > 0)
	{
			$query = "insert into friends  
												(
												  user_id,
												  friend_id
												 )
												 values
												 (
												 	'".$user_array[0]['user_id']."',
													'".$insert_id."'
												 )	
			";
			$result = mysql_query($query);
			$query = "insert into friends  
												(
												  user_id,
												  friend_id
												 )
												 values
												 (
												 	'".$insert_id."'
													'".$user_array[0]['user_id']."'
													
												 )	
				";
				$result = mysql_query($query);				
	}	
	
	$Subject = "Welcome to FloatThat, You Account Is Opened";
	$Message = "Hello,<br /><br />
				
				Welcome to FloatThat, You Account Is Opened, enjoy your shopping with us..	
				
				<br />
				FloatThat Team 
				<br /><br />
				Important: To stay up to date make sure to add info@floatthat.net in your trusted emails list.";

				
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
	$headers .= "From: info@floatthat.net <info@floatthat.net>\r\n"."Reply-To: ".$_POST['mail']."<".$_POST['mail'].">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
	
	mail($_POST['mail'], $Subject, $Message, $headers);
		header("Location: register.php?msg=succ");
		exit;		
	}
	else
	{	

	if(trim($_FILES["avatar"]["tmp_name"]) != "")
	{
		  $avatar = strtotime(date("Y-m-d  g:i")).$_FILES["avatar"]["name"];
		  if(move_uploaded_file($_FILES["avatar"]["tmp_name"],"./avatar/" .$avatar) )
		  {
				$avatar = $avatar;
		  }
	}
    else
    {
		 $avatar = $_POST['avatar1'];
    }
	
				$query = "
					update user_info set
									  			  fname = '".$_POST['firstName']."',
												  lname = '".$_POST['secondName']."',
												  email = '".$_POST['mail']."',
												  password = '".$_POST['pass']."',
												  phone = '".$_POST['tele']."',
												  fax = '".$_POST['fax']."',
												 `address1` = '".$_POST['firstAddress']."',
												 `address2` = '".$_POST['secondAddress']."',
												 `city` = '".$_POST['city']."',
												 `state` = '".$_POST['state']."',
											     `country` = '".$_POST['country']."',
												 `postcode` = '".$_POST['postCode']."',
												  pic = '".$avatar."'					 												 
					where id = '".$userContents['id']."'			
				";	
				$result = mysql_query($query);
	}


	header("Location: my-account.php?msg=succ");

?>
