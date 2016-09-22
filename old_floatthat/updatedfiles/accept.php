<?php
require_once ("config.php");


$deal_id = $_GET['deal_id'];	   
$user_id=$_REQUEST['user_id'];
/*
$ctype=$_REQUEST['ctype'];

$cardnum=$_REQUEST['cardnum'];
$cscnum=$_REQUEST['cscnum'];
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
$phone=$_REQUEST['phone'];
$countries=$_REQUEST['countries'];
$floatdate=$_REQUEST['closedate'];
$date=date("Y-m-d G:i:s");



$language_id=$_REQUEST['lang_id'];*/

//mysql_query("update user_info set paymenttype='$ctype',paymenttype='$ctype',cardnumber='$cardnum',cscnum='$cscnum',expirymonth='$month',expiryyear='$year',country='$countries' where user_id=$user");

//header("Location: accepted.php?deal_id=".$deal_id);	
//	   exit;

					$deal_id = $_GET['deal_id'];
					$fusname=mysql_query("select * from tbl_deal where deal_id=$deal_id"); 
					$frname=mysql_fetch_array($fusname);
					
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$frname['pro_id']."'");
					$productdetail=mysql_fetch_array($productqry);
					
					
					
					$fmmsname=mysql_query("select * from tbl_members where deal_id=$deal_id");
					$countmem=mysql_num_rows($fmmsname);
					
					
					$cstp=$productdetail['price'];
					$amount = $expectedprice = number_format($productdetail['price']/$countmem,2);
						
					$totmem=$countmem;
							
							
?>

	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="buypro" id="buypro">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="business" value="aliirizvi1975@hotmail.com">
	<input type="hidden" name="currency_code" value="USD">
	
		<input type="hidden" name="item_number_1" value="<?php echo $frname['pro_id']?>">
		<input type="hidden" name="item_name_1" value="<?php echo $frname[0]['title']?>">
		<input type="hidden" name="amount_1" value="<?=number_format($amount,2)?>">
	
		<input type="hidden" name="quantity" value="1">	
		<input type="hidden" name="return" value="https://www.floatthat.net/accepted.php?deal_id=<?php echo $_GET['deal_id'];?>">
		<input type="hidden" name="cancel_return" value="https://www.floatthat.net/cancel.php">
		<input type="hidden" name="amount" value="<?=number_format($amount,2)?>">
	
		
	</form>
	
			
				<script type="text/javascript">
				<!--
					setTimeout(function( ) { document.buypro.submit( ); }, 100);
				-->
				</script>	   
	   