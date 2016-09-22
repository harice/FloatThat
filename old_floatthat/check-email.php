<?
	require_once("config.php");
		
	$Query="SELECT * FROM user_info WHERE email= '".$_POST['mail']."'";
	$user_array = $commonObject->selectMultiRecords($Query);	
	if( count($user_array) > 0)
	{
		echo "exist";
	}
	else
		echo "no";

?>
