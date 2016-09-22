<?php
@session_start();
require_once("config.php");
	
error_reporting(0);

			$Query = mysql_query("SELECT * FROM tbl_deal WHERE deal_id  = '".$_SESSION['deal_id']."'");
			$deals = mysql_fetch_array($Query);
			
			$Query = mysql_query("SELECT * FROM tbl_products WHERE pro_id  = '".$_SESSION['product_id']."'");
			$products = mysql_fetch_array($Query);
				
							//if(count($_SESSION['data_email']) > 0)
								$amount = ($products['price'] / ($deals['ods']));		
				?>
<!--              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="buypro" id="buypro" target="_top">
--><form name="buypro" id="buypro" target="_top" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> 

	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<!--<input type="hidden" name="business" value="aliirizvi1975@hotmail.com">-->
 <input type="hidden" name="business" value="saesd-facilitator@arhamsoft.com" />
 <!-- <input type="hidden" name="business" value="anidy@yopmail.com" /> -->
	<input type="hidden" name="currency_code" value="USD">
	
		<input type="hidden" name="item_number_1" value="<?php echo $products['pro_id']?>">
		<input type="hidden" name="item_name_1" value="<?php echo $products['title']?>">
		<input type="hidden" name="amount_1" value="<?=number_format($amount,2)?>">
	
		<input type="hidden" name="quantity" value="1">	
		<input type="hidden" name="return" value="http://www.floatthat.net/thanks.php?item_number=<?php echo $_POST['type'].'&deal_id='.$_SESSION['deal_id'];?>">
		 <input type="hidden" name="cancel_return" value="http://www.floatthat.net/cancel.php"> 
		
		<input type="hidden" name="amount" value="<?=number_format($amount,2)?>">
	
		
	</form>
	
			
				<script type="text/javascript">
				
					setTimeout(function( ) { document.buypro.submit( ); }, 100);
				
				</script>  
                
