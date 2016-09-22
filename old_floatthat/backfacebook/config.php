<?php
@session_start();
//require_once 'facebook.php';
$database_host = "50.63.108.69";
	$database_name = "floatthat";
	$database_user = "floatthat";
	$database_pass = "Pass123!@#";
	
	$connection=mysql_connect($database_host,$database_user,$database_pass) or die("cant connect to the serveer");
	$fblink = mysql_select_db($database_name, $connection) or die("cant connect to the database");
	
//include("stylecss.php"); 
	$fb_app_canvas='floatthat';
	$CanvasURL='http://www.floatthat.net/facebook/';
	$images='http://www.floatthat.net/facebook/images/';
	
	$apppath = 'http://apps.facebook.com/'.$fb_app_canvas.'/';
						
	 $strCanvasUrl = 'http://apps.facebook.com/'.$fb_app_canvas.'/index.php';
//////end constatnt	
	$app_id='498786253474282';
	
	 $api_key ='498786253474282';
	 $fb_app_secret='c24906b9398b6e5a3f9c8965850e10fc';


?>