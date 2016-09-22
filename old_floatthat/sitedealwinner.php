<?php 
@session_start();
$database_host = "localhost";//50.63.108.69
$database_name = "akmalran_floatthat";
$database_user = "akmalran_float";
$database_pass = "4455044#";

$connection=mysql_connect($database_host,$database_user,$database_pass) or die("cant connect to the serveer");
$fblink = mysql_select_db($database_name, $connection) or die("cant connect to the database");
 
include "phpMailerClass.php";
$email = new PHPMailer();
 		
	
	$date=date('Y-m-d');
	
	
	$sqldeal=@mysql_query("SELECT * FROM tbl_deal where closestatus='0'");
	
	while($deal_id=mysql_fetch_array($sqldeal))
	{
	
				$checkmembers=mysql_query("select * from tbl_members where deal_id= $deal_id[deal_id]");
				$numrows=mysql_num_rows($checkmembers);
				
				if($numrows>=$deal_id['ods'])
				{
				
				
				$sql=@mysql_query("SELECT * FROM tbl_members where deal_id= $deal_id[deal_id] order by Rand() limit 1");
				$getdata=@mysql_fetch_array($sql);
				
					mysql_query("update tbl_members set winner='1' where user_id='$getdata[user_id]' and deal_id= '$deal_id[deal_id]'");
					
					mysql_query("update tbl_deal set closestatus='1' where deal_id= '$deal_id[deal_id]'");
					
					$username=@mysql_query("select * from user_info where id=$getdata[user_id]");
					$uname=@mysql_fetch_array($username);
						
					    $productqry=mysql_query("select * from tbl_products WHERE pro_id='".$deal_id['pro_id']."'");
					    $productdetail=mysql_fetch_array($productqry);
					    
					    
					    $productqryimg=mysql_query("select * from tbl_photos WHERE pro_id='".$deal_id['pro_id']."'");
					    $productdetailimg=mysql_fetch_array($productqryimg);
					
						
					
					
					$shortmsg=$uname['name']." Become a Winner Of ".$productdetail['title'];
						
					 $imgs="http://www.floatthat.net/wadmin/gallaryimg/thumbnails/".$productdetailimg['image'];
					
					$fuser=$uname['user_id'];
					
					$subject = $shortmsg;
	$EmailText = '
<html>
<head>
  <title>Float That Deal Winner</title>
</head>
<body>
<table>';
$EmailText.="<tr><td><b>Information about the winner of the deal is </b></tr></td>";
							
							$EmailText.="<tr><td>We feel pleasure to inform you that ".$uname['name']."(".$uname['email'].") become the winner for following Floatthat deal</td></tr>";
							
							$EmailText.="<tr><td><b>Product title:</b> ".$productdetail['title']."</td></tr>";
							
							
							$EmailText.="<tr><td><b>Image:</b> <img src=".$imgs."></td></tr>";
							
							
							$EmailText.="<tr><td>...................................................</td></tr>";
							
							$EmailText.="<tr><td><b>Best Regards</b></td></tr>";
							$EmailText.="<tr><td>Floatthat Team</td></tr>";
							
							$EmailText.="</table>";
"</body>
</html>
";

// To send HTML mail, the Content-type header must be set
$to=$uname['email'];
					
							$email->From      = 'info@floatthat.net';
							$email->FromName  = 'Rana Akmal';
							$email->Subject   = $subject;
							$email->Body      = $EmailText;
							$email->AddAddress( $uname['email'] );
							$email->IsHTML(true);   
							
							 $email->Send();
					
					
					$sql2=@mysql_query("SELECT mem.*,user.* FROM tbl_members mem,user_info user where mem.deal_id= $deal_id[deal_id] and user.id=mem.user_id and user.id!=$fuser");
					while($getdata2=@mysql_fetch_array($sql2))
					{
						
							$email->From      = 'info@floatthat.net';
							$email->FromName  = 'Rana Akmal';
							$email->Subject   = $subject;
							$email->Body      = $EmailText;
							$email->AddAddress( $getdata2['email'] );
							$email->IsHTML(true);   
							
							 $email->Send();
					
					
					}
				}
					
					
					
		}
				
	
