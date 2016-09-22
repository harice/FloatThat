<?
	require_once("config.php");
	
	if(trim($_POST['username']) == "")
	{
			
	}
	else
	{
		if( strlen( trim($_POST['password']) ) < 6 )
		{
			header("Location: cha_password.php?msg=error");
			exit();
		}
		else
		{
$Query="SELECT * FROM administrator WHERE userpassword= '".$_POST['old_password']."' and userlogin ='".$_POST['username']."'";
$user_array = $commonObject->selectMultiRecords($Query);	
if( count($user_array) == 0)
{
			header("Location: cha_password.php?msg=nil");
			exit();
}		
		}
				$query = "
					update administrator  set
												  userpassword  = '".$_POST['password']."'												 
												 
					where userlogin = '".$_POST['username']."'	and 	userpassword = 	'".$_POST['old_password']."'
				";	
				$result = mysql_query($query);
	}

		header("Location: cha_password.php?msg=succ");
?>
