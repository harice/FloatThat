<?
	require_once("config.php");
		

	$_SESSION['fname'] = $_POST['fname'];
	$_SESSION['lname'] = $_POST['lname'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];
	$dob = date("Y-m-d", strtotime($_POST['dob']));

					
	if(trim($_POST['id']) == "")
	{
	
		$Query="SELECT * FROM users WHERE email= '".$_POST['email']."'";
		$user_array = $commonObject->selectMultiRecords($Query);	
		if( count($user_array) > 0)
		{
			header("Location: register.php?msg=exist");
			exit();
		}	
			$query = "
					insert into users  
												(
												  fname,
												  lname,
												  email,
												  password,
												  pin_code,
												  dob,
												  phone,
												  gender,
												 `address`,
												 `city`,
												 `state`,
											     `country`,
												 `c_person_name`,
												 `c_person_phone`,
												 `profession`,
												 `website`,
												 `come_to_know`,
												 `reffer_by`,
												 `rel_reffer_by`,
												 `secret_q`,
												 `answer`,
												 `aniversry`, 
												  marital_status,												  
												  status,
												  created
												 )
												 values
												 (
												 	'".$_POST['fname']."',
													'".$_POST['lname']."',
													'".$_POST['email']."',
													'".$_POST['password']."',
													'".$_POST['pin_code']."',
													'".$dob."',
													'".$_POST['phone']."',
													'".$_POST['gender']."',
													'".$_POST['address']."',
													'".$_POST['city']."',
													'".$_POST['state']."',
													'".$_POST['country']."',
													'".$_POST['c_person_name']."',
													'".$_POST['c_person_phone']."',
													'".$_POST['profession']."',
													'".$_POST['website']."',
													'".$_POST['come_to_know']."',
													'".$_POST['reffer_by']."',
													'".$_POST['rel_reffer_by']."',
													'".$_POST['secret_q']."',
													'".$_POST['answer']."',
													'".$aniversry."',
													'".$_POST['marital_status']."',
													1,
													NOW()
												 )	
				";
				$result = mysql_query($query);
				
	$_SESSION['fname'] = '';
	$_SESSION['lname'] = '';
	$_SESSION['email'] = '';
	$_SESSION['gender'] = '';
	$_SESSION['marital_status'] = '';
	$_SESSION['phone'] = '';
	$_SESSION['address'] = '';
	$_SESSION['city'] =	 '';
	$_SESSION['state'] = '';	
	$_SESSION['country'] = '';	
	$_SESSION['c_person_name'] = '';
	$_SESSION['c_person_phone'] = '';	
	$_SESSION['profession'] = '';	
	$_SESSION['website'] = '';
	$_SESSION['come_to_know'] = '';
	$_SESSION['reffer_by'] = '';
	$_SESSION['rel_reffer_by'] = '';	
	$_SESSION['secret_q'] = '';	
	$_SESSION['answer'] = '';
	$_SESSION['aniversry'] = '';	
	$_SESSION['dob'] = '';
	
	$Subject = "Welcome to xyz, You Account Is Opened";
	$Message = "Hello,<br /><br />
				
				Please enjoy shoping.	
				
				<br />
				xyz Team 
				<br /><br />
				Important: To stay up to date make sure to add info@xyz.co.uk in your trusted emails list.";

				
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";		
	$headers .= "From: info@xyz.co.uk <info@xyz.co.uk>\r\n"."Reply-To: ".$_POST['email']."<".$_POST['email'].">\r\n"."X-Mailer: PHP/" . phpversion()."\r\n";
	
	mail($_POST['email'], $Subject, $Message, $headers);
		header("Location: login.php?msg=succ");
		exit;		
	}
	else
	{	

				$query = "
					update users set
									  fname = '".$_POST['fname']."',
									  lname = '".$_POST['lname']."',
									  email = '".$_POST['email']."',
									  password = '".$_POST['password']."',
									  pin_code = '".$_POST['pin_code']."',
									  dob = '".$dob."',
									  phone = '".$_POST['phone']."',
									  gender = '".$_POST['gender']."',
									 `address` = '".$_POST['address']."',
									 `city` = '".$_POST['city']."',
									 `state` = '".$_POST['state']."',
									 `country` = '".$_POST['country']."',
									 `c_person_name` = '".$_POST['c_person_name']."',
									 `c_person_phone` = '".$_POST['c_person_phone']."',
									 `profession` = '".$_POST['profession']."',
									 `website` = '".$_POST['website']."',
									 `come_to_know` = '".$_POST['come_to_know']."',
									 `reffer_by` = '".$_POST['reffer_by']."',
									 `rel_reffer_by` = '".$_POST['rel_reffer_by']."',
									 `secret_q` = '".$_POST['seq_qus']."',
									 `answer` = '".$_POST['ans']."',
									 `aniversry` = '".$aniversry."'	,
									  marital_status	 = '".$_POST['marital_status']."'							 												 
					where uid = '".$userContents['uid']."'			
				";	
				$result = mysql_query($query);
	}

	$_SESSION['fname'] = '';
	$_SESSION['lname'] = '';
	$_SESSION['email'] = '';
	$_SESSION['gender'] = '';
	$_SESSION['marital_status'] = '';
	$_SESSION['phone'] = '';
	$_SESSION['address'] = '';
	$_SESSION['city'] =	 '';
	$_SESSION['state'] = '';	
	$_SESSION['country'] = '';	
	$_SESSION['c_person_name'] = '';
	$_SESSION['c_person_phone'] = '';	
	$_SESSION['profession'] = '';	
	$_SESSION['website'] = '';
	$_SESSION['come_to_know'] = '';
	$_SESSION['reffer_by'] = '';
	$_SESSION['rel_reffer_by'] = '';	
	$_SESSION['seq_qus'] = '';	
	$_SESSION['ans'] = '';
	$_SESSION['aniversry'] = '';	
	$_SESSION['dob'] = '';
	header("Location: my-account.php?msg=succ");

?>
