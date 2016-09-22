<?
$strPath = "./";
require_once $strPath."config2.php";

$Query="update user_info set  password = '".$_POST['password']."' WHERE email = '".$userContents['email']."'  ";					
$commonObject->update($Query);

header("Location: change-password.php?msg=true");			
			
?>