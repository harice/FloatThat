<?php 
if(md5($_REQUEST['pro_id'])==$_REQUEST['sc_id'] and $_REQUEST['ms']="paymentssucc")
{
	$pid=$_REQUEST['pro_id'];
	$uid=$_REQUEST['user_id'];
	$date=date('Y-m-d');
mysql_query("insert into tbl_buydeal(user_id,pro_id,date) value('$pid','$uid','$date')");

}

$selpro=mysql_query("select * from tbl_products where pro_id='".$_REQUEST['pro_id']."'");

$product=mysql_fetch_array($selpro);




$seldeal=@mysql_query("select * from tbl_deal where pro_id='".$_REQUEST['pro_id']."' and closestatus=0 and user_id=$user");

$nmdeal=@mysql_num_rows($seldeal);

?>

       
   
     
       
       <div class="mainhead"><?php echo $product['title'];?> $<?php echo $product['price'];?></div>
        <!-- <div class="boldtxt"><?php //echo $product['detail'];?></div>-->
	<?php /*?>onclick="Open_Cardinfo('<?php echo $user;?>','<?php echo $product['pro_id'];?>');"<?php */?>	
   <div class="inner_banner">
   <div class="leftpanel">
     <div class="float_btn">
     <?php if($nmdeal==0){?>
     <a href="<?php echo $apppath;?>index.php?m=become_member&pro_id=<?php echo $product['pro_id'];?>" target="_top">
     <img src="images/float_deal.png" width="198" height="67" alt="float_btn"  style="cursor:pointer" border="none" /></a>
     <?php } else {?>
     
      <img src="images/dealdone.jpg" width="198" height="67" alt="float_btn"  style="cursor:pointer" border="none" />
     <?php }?>
     
     </div>
     <div class="inner">
     <div class="buy_btn">
     <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frm" target="_blank" >
	<input type="hidden" name="cmd" value="_xclick">
	  <input type="hidden" name="business" value="ferdous23553@yahoo.com">
	 <!-- <input type="hidden" name="business" value="rizwaan@gmail.com">-->
	  <input type="hidden" name="item_name" value="<?php echo $product['title'];?>">
	  <input type="hidden" name="currency_code" value="USD">
	  <input type="hidden" name="amount" value="<?php echo $product['price'];?>">
	
      <input type="hidden" name="return" value="https://apps.facebook.com/floatthat/index.php?m=productdetail&pro_id=<?php echo $product['pro_id'];?>&ms=paymentssucc&user_id=<?php echo $user;?>&sc_id=<?php echo md5($product['pro_id']);?>" id="return"> 
	  <input type="hidden" name="cancel_return" value="https://apps.facebook.com/floatthat/index.php?m=productdetail&pro_id=<?php echo $product['pro_id'];?>&mc=cancel&user_id=<?php echo $user;?>&sc_id=<?php echo md5($product['pro_id']);?>" id="cancel_return">
      <input type="submit" value="" style="background-image:url(images/buy_deal.png); width:198px; height:67px; border:none; cursor:pointer" />
	</form>
    </div>
    	<div style="clear:both"></div>
     	<div class="buy_btn">
        <?php if($nmdeal==0){?>
        	<a href="<?php echo $apppath;?>index.php?m=become_member&pro_id=<?php echo $product['pro_id'];?>" target="_top">
     <img src="images/groupdeal.jpg" width="198" height="67" alt="float_btn"  style="cursor:pointer" border="none" /></a>
     		<?php }?>
     	</div>
     <div class="greenarea">
    <div class="deal_on">Deal is on</div>
    <p>&nbsp;</p><p>&nbsp;</p>
     </div>
     </div>
   </div>
   <div class="ri8panel">
   <img src="wadmin/products/<?php echo $product['c_id'];?>/<?php echo $product['thumb'];?>" style="width:445px; height:266px;" alt="inner thumb" />
   <div class="social_butns"> <?php 
			$mainPath=$CanvasURL."wadmin/products/".$product['c_id']."/".$product['thumb'];
			
			$encoded_url=urlencode($mainPath.$product['pro_id']);?>
            
            <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $encoded_url;?>&amp;send=false&amp;layout=button_count&amp;width=80&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=verdana&amp;height=21&amp;appId=498786253474282" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe></iframe></div>
   </div>
   <div class="clear"></div>
   </div>
 	<div class="content">
    <div class="cont_left">
      <p class="conthead">Terms & Conditions</p>
      <p><?php echo $product['terms'];?> </p>
    </div>
    <div class="cont_ri8">
      <p class="conthead">Description</p>
      <p><strong>Expires <?php echo date('m-d-Y',strtotime($product['fdate']));?></strong></p>
      <p><?php echo $product['detail'];?>.</p>
    </div>
    <div class="clear"></div>
    </div>
      
      
       
        