<?php
require_once("config.php");


if($_GET['id'] != "")
{

			$query = "delete from sales where   sale_session_id = '".$_SESSION['current_session_id']."' ";
			$result = mysql_query($query);
			
			
$_SESSION['cart'] = 1;
	if($_GET['qty'] == "" || $_GET['qty'] == 0)
	{
		$_GET['qty'] = 1;
	}
		$query="SELECT * from tbl_products where pro_id = '".$_GET['id']."' ";
		$productArray = $commonObject->selectMultiRecords($query);
		$price = ($productArray[0]['price']);
		$discount = $productArray[0]['discount'];
		$product_price = ($productArray[0]['price'] * $_GET['qty']);
		$query="SELECT pid, quantity ,total_amount FROM sales where pid = ".$_GET['id']." and sale_session_id = '".$_SESSION['current_session_id']."' ";
		$cart_array = $commonObject->selectFrom($query);	
		if($cart_array['pid'] > 0 )
		{				
			$query = "update sales set quantity = (".$_GET['qty']."), price = '".$price."', total_amount = (total_amount +  ".$price." ) 
			, discount = (discount +  ".$discount." ) 
				where pid = ".$_GET['id']." and sale_session_id = '".$_SESSION['current_session_id']."' ";
			$result = mysql_query($query);
		}
		else
		{
			$total_amount = ($price * $_GET['qty']);
			$query = "insert into sales(sale_session_id, uid, pid, price, quantity, discount, total_amount, status,created) values(
			'".$_SESSION['current_session_id']."',
			'".$userContents['id']."',
			'".$_GET['id']."',
			'".$price."',
			".$_GET['qty'].",
			'".$discount."',
			'".$total_amount."',
			'1'	,
			NOW()
			);";
			$result = mysql_query($query);
			
			$query = "insert into tbl_buydeal(user_id , pro_id , date) values(
			'".$userContents['id']."',
			'".$_GET['id']."',
			NOW()
			);";
			$result = mysql_query($query);
						
		}
	//if($_GET['rtn'] == 1)
		header("Location: cart.php");
	//else			
	//	header("Location: index.php");
		exit;		
}
?>