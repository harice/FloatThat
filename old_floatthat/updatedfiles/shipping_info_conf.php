<?php 
	require_once("config.php");

$Query="SELECT * from shipping_infor where user_id = '".$userContents['id']."'		";
$shipping_info = $commonObject->selectMultiRecords($Query);	

if(count($shipping_info) == 0)
	{
				 $query = "
					insert into shipping_infor   
												(
												  first_name,
												  last_name,
												  address,
												   address2,
												    post_code,
												  sale_session_id,
												  city,
												  state,
												  country,
												  
												  created,
												  bill_first_name,
												  bill_last_name,
												  bill_address2,
												  bill_address,
												  bill_city,
												  bill_state,
												  bill_country,
												  bill_post_code,
												  user_id
												 )
												 values
												 (
												 	'".$_POST['first_name']."',
													'".$_POST['last_name']."',
													'".$_POST['address']."',
													'".$_POST['address2']."',
													'".$_POST['post_code']."',
													'".$_SESSION['current_session_id']."',
													'".$_POST['city']."',
													'".$_POST['state']."',
													'".$_POST['country']."',
																								
													NOW(),
													'".$_POST['bill_first_name']."',
													'".$_POST['bill_last_name']."',
													'".$_POST['bill_address2']."',
													'".$_POST['bill_address']."',
													'".$_POST['bill_city']."',
													'".$_POST['bill_state']."',
													'".$_POST['bill_country']."',
													'".$_POST['bill_post_code']."',
													'".$userContents['id']."'
												 )	
				";
				$result = mysql_query($query);
	}
	else
	{	
				 $query = "
					update  shipping_infor set
												  first_name = '".$_POST['first_name']."',
												  last_name = '".$_POST['last_name']."',
												  post_code = '".$_POST['post_code']."',
												  
												  address2 = '".$_POST['address2']."',
												  address = '".$_POST['address']."',
												  city = '".$_POST['city']."',
												  state = '".$_POST['state']."',
												  country = '".$_POST['country']."'		,
 												  bill_first_name= '".$_POST['bill_first_name']."'		,
												  bill_last_name= '".$_POST['bill_last_name']."'		,
												  bill_address2= '".$_POST['bill_address2']."'		,
												  bill_address= '".$_POST['bill_address']."'		,
												  bill_city= '".$_POST['bill_city']."'		,
												  bill_state= '".$_POST['bill_state']."'		,
												  bill_country= '".$_POST['bill_country']."'		,
												  bill_post_code= '".$_POST['bill_post_code']."'														  										 
					where user_id = '".$userContents['id']."'		
				";	
				$result = mysql_query($query);
	}
	
	header("Location: checkout.php?msg=yes");	
		
?>
