<?php
include("config.php");

// $user_array = $commonObject->update("delete from user_info where id=187");

// exit;


// $Query="SELECT * FROM user_info";
$Query="SELECT * FROM tbl_members";
$user_array = $commonObject->selectMultiRecords($Query);
echo "<pre>";
var_dump($user_array);
exit;
?>