<?php
require_once("config.php");


if($_GET['id'] != "")
{
	echo $query = "delete from sales
		where pid = ".$_GET['id']." and sale_session_id = '".$_SESSION['current_session_id']."' ";
	$result = mysql_query($query);
	
	//if($_GET['rtn'] == 1)
		header("Location: cart.php");
	//else	
	//	header("Location: index.php");
}
?>