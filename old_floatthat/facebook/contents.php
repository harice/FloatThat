<?php $selpro=mysql_query("select * from tbl_contents where m_id='".$_REQUEST['m_id']."'");

$product=mysql_fetch_array($selpro);
?>

<div class="p-detail" style="margin-top:20px;">
    	
       
       
        		<?php echo $product['contents'];?>
       
       
    </div>