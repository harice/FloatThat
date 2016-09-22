<?php

ini_set("session.use_trans_sid", false);
// Session Handling
session_start();
$strPath = './';
require_once ("includes/common.php");
require_once ("includes/common_class.php");	
require_once ("includes/functions.php");
require_once ("includes/dbcon.php");

$connectionsInstance = new connections();	//connection class
$connectionsInstance->dbConnect();//data base connection method
	
$commonFunctionInsta = new commonFunctins();	// functions class
$commonObject = new Common();// common Database manipulatin function's class


$UserLogged = $commonFunctionInsta->loggedUser();


?>