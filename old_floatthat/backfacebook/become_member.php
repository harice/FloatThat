<?php

$user_id=$user;
$pro_id=$_REQUEST['pro_id'];
$ctype=$_REQUEST['ctype'];
					
						?>

<?php 
		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."'");
		$betdata=mysql_fetch_array($bet);
		$nmr=mysql_num_rows($bet);
		$date=date('Y-m-d');
		
			if($nmr==0)
			{
			mysql_query("insert into tbl_deal(pro_id,user_id,date)values('$pro_id','$user','$date')");
			$last_deal_id=mysql_insert_id();	
			}
			
			
		$bet=mysql_query("select * from tbl_deal where user_id='".$user."' and pro_id='".$pro_id."'");
		$betdata=mysql_fetch_array($bet);	
			
		
		
					?>

<!--<tr>

<td valign="top" style="border:1px solid #CCC">
	You already joined Deal Successfully Now you can Float this prodcut to your friends
</td>

</tr>
-->
<?php 

if(isset($_REQUEST['users_id']))
	 {
		 $user_id=$_REQUEST['user_id'];
				$usname=mysql_query("select * from user_info where user_id=$user_id");
					$myname=mysql_fetch_array($usname);
					
					$users_id=$_REQUEST['users_id'];
					$pro_id=$_REQUEST['pro_id'];
					$countmem=count($users_id)+1;
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$pro_id."'");
					$productdetail=mysql_fetch_array($productqry);
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
					$fdate=$productdetail['fdate'];
					
					$deal_id=$betdata['deal_id'];
					
					for($i=0;$i<count($users_id);$i++)
							{
					
					//$win=$winner;
					$fuser=$_REQUEST['users_id'][$i];
					
					mysql_query("insert into tbl_members(deal_id,user_id,date)values('$deal_id','$fuser','$date')");
					
							}
					
					$totmem=count($users_id)+1;
					
							
							/*$shortmsg="Started a deal Total Cost is ".$cstp." Total Memberrs ".$totmem." and you have to pay $".$expectedprice." last date for float $fdate";
						
					$imgs="http://www.floatthat.net/facebook/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$user_id/feed", 'post', array('picture'=> "$imgs",'link' => 'https://apps.facebook.com/floatthat','caption' => "visit here ",'name' => "$myname[name]", 'description' => $statuss, 'cb' => "$statuss"));
							
							$totmem=count($users_id)+1;
							
							for($i=0;$i<count($users_id);$i++)
							{
					
					//$win=$winner;
					$fuser=$_REQUEST['users_id'][$i];
					
					
					
					$shortmsg="started a deal Total Cost is ".$cstp." Total Memberrs ".$totmem." and you have to pay $".$expectedprice." last date for float $fdate";
						
					$imgs="http://www.floatthat.net/facebook/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$fuser/feed", 'post', array('picture'=> "$imgs",'link' => 'https://apps.facebook.com/floatthat','caption' => "visit here ",'name' => "$myname[name]", 'description' => $statuss, 'cb' => "$statuss"));
					
							}*/
	}
				?>

<style>

.thumb{
    width:100px;
    float: left;
    margin-left: 5px;
    border: solid 1px #ccc;
}
.img {

}

input.chk{
margin-left: 10px;



}

</style>	
<div id="receivedd"  style="width:800px; border:1px solid #CCC; margin-top:20px;" align="center">

	<div style="width:100%; margin-top:5px;" align="center">
<?php if(!isset($_REQUEST['users_id']))
	 {?>

<form action="" method="post" name="frmreceived">
<?php 
$pro_id=$_REQUEST['pro_id'];

?>
<input type="hidden" name="deal_id" value="<?php echo $betdata['deal_id'];?>" />
<input type="hidden" name="pro_id" value="<?php echo $_REQUEST['pro_id'];?>" />
<input type="hidden" name="user_id" value="<?php echo $user;?>" />
	  <?php 

	   
		
		$fql1    =   "SELECT uid,pic_big,pic,pic_small,name FROM user WHERE  uid IN ( SELECT uid2 FROM friend WHERE uid1= $user_id) order by name";
		$param1  =   array(
						
							'method'    => 'fql.query',
						
							'query'     => $fql1,
						
							'callback'  => ''
						
						);
		$fqlResult2   =   $facebook->api($param1);
		
					
												
													
		$i=0;
		$frndids = "";
		$cnt= 1;
		
		foreach($fqlResult2 as $friends)
	        {
				 $i++; 
			?>				
            
         					<div class="thumb" style="float:left; margin-top:2px;">
								<img src="<?php echo $friends['pic'];?>" style="width:80px; height:80px;" />
								<input type="checkbox" name="users_id[]" value="<?php echo $friends['uid'];?>" />
                                <br />
                                <span>
                                <?php echo htmlentities($friends['name'], ENT_QUOTES);?></span>
								</div>
						 	<?php
						
						if($i%7==0)
						{
						?>
                      <div style="clear:both"></div>
                   
                        <?php
						}
						
					}
						
				?>
               
       <div style="margin-top:20px;"><input type="submit" value="" name="receivedsub" style="background-image:url(images/floatfriend.jpg); width:200px; height:60px; border:none; cursor:pointer"  />
  <div style="clear:both"></div>
</div>

  <div style="clear:both"></div>
  </form> 
  <?php } else {?>
  <div id="member" style="margin-left:20;width:90%;">
  

     			
     <div style="width:100%; margin-left:20;" align="left">
            <div style="clear:both"></div>
             <div style="width:300px;" align="left">
               <h2>Your Deal Plan</h2></div>
     		<div style="clear:both"></div>
    		<div style="float:left; width:200px;">Total Cost</div>
            <div style="float:left; width:100px;">$<?php echo $cstp;?></div>
            <div style="clear:both"></div>
            <div style="float:left; width:200px;">Total participant</div>
            <div style="float:left; width:100px;"><?php echo $totmem;?></div>
            <div style="clear:both"></div>
            <div style="float:left; width:200px;">Your contribution</div>
            <div style="float:left; width:100px;">$<?php echo $expectedprice;?></div>
             <div style="clear:both"></div>
            <div style="float:left; width:200px;"><h2>Terms & Conditions</h2></div>
            <div style="float:left; width:100%"><?php echo $productdetail['terms'];?></div>
            <div style="clear:both"></div>
            
            <div style="float:left; width:425px;">
            
             <a href="<?php echo $apppath;?>index.php?m=home&disagree_id=<?php echo $betdata['deal_id'];?>"  target="_top">
            <input type="button" value=""  style="background-image:url(images/dontagree.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>
            
            <a href="<?php echo $apppath;?>index.php?m=agree&deal_id=<?php echo $betdata['deal_id'];?>"  target="_top">
            <input type="button" value=""  style="background-image:url(images/agree.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>
            </div>
	</div>

</div>	
  <?php }?>
</div>
 <div style="clear:both"></div>