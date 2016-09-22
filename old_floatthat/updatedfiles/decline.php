<?php
require_once ("config.php");


$deal_id = $_GET['deal_id'];	   
$user_id=$_REQUEST['user_id'];

$fmmsname=mysql_query("delete from tbl_members where deal_id=$deal_id");

header("Location: invitations.php?msg=decline");						
							
?>
