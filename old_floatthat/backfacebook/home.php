     <?php 
	if(isset($_REQUEST['users_id']))
	 {
		 $user_id=$_REQUEST['user_id'];
				$usname=mysql_query("select * from user_info where user_id=$user_id");
					$myname=mysql_fetch_array($usname);
					
					$users_id=$_REQUEST['users_id'];
					$pro_id=$_REQUEST['pro_id'];
					$countmem=count($users_id)+$_REQUEST['mem_id'];
					$productqry=mysql_query("select * from tbl_products WHERE pro_id='".$pro_id."'");
					$productdetail=mysql_fetch_array($productqry);
					
					$cstp=$productdetail['price'];
					$expectedprice=number_format($productdetail['price']/$countmem,2);
					$fdate=$productdetail['fdate'];
					
							
							$shortmsg="started a deal Total Cost is ".$cstp." Total Memberrs ".$totmem." and you have to pay $".$expectedprice." last date for float $fdate";
						
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
					
							}
	}
	
	if(isset($_REQUEST['disagree_id']))
	{
	mysql_query("delete from tbl_deal where deal_id='".$_REQUEST['disagree_id']."'");
	
	mysql_query("delete from tbl_members where deal_id='".$_REQUEST['disagree_id']."'");	
	
	}
	
	 
	$selproqry=mysql_query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id and featured=1 order by Rand() limit 1");
	$products=mysql_fetch_array($selproqry);
	
	
	?>
        <div class="banner">
       <div class="banimg"><img src="images/tell-friend.jpg" style="width:323px; height:226px;"  alt="banner img" /></div>
       <div class="bantxt">
         <div class="mainhead" align="left">Float your friends at</div>  
		 <div class="greentxt" align="left">An Online Deal</div>
         <div class="normtxt" align="left">FloatThat lets you put your contacts to good use; to help you pay for deals.Members can select an item / deal, Float it to their contacts and split the cost over the number of participants. When the Float period ends, one of the participants will receive the item that everyone else contributed to. A $50 item / Deal Floated to twenty-five friends ($2/ friend) will allow one of the friends to receive the Deal for $2. 
FloatThat will allow each participant to get points, for assigned tasks, to apply towards their individual contribution.
 </div>
		<div>
		 <?php /*?> <div class="blubtn"><a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">View Deal</a></div><?php */?>
		</div>
       </div>
       <div class="clear"></div>
     </div>
     <div class="box_head">
       <div class="box_headtxt">All Deals</div>
       <div class="box_headsmall"><a href="<?php echo $apppath;?>index.php?m=productslist&all=1" class="view" target="_top">See all deals</a></div>
       <div class="clear"></div>
     </div>   
     <div>
     <?php 
		$i=0;
			$selproqry=mysql_query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id order by Rand() limit 3");
			while($products=mysql_fetch_array($selproqry))
			{
				$i++;
		?>
     
       <div class="product_box <?php if($i==3){?>last<?php }?>">
         <div class="thumbimg">
         <a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">
         <img src="wadmin/products/<?php echo $products['c_id'];?>/<?php echo $products['thumb'];?>" style="width:240px; height:145px; border:none" alt="product" /></a>
         </div>
         <div class="hedtxt">Deal Details 
           <br />
           <?php echo $products['title'];?></div>
         <div class="prodtxt">
         <div class="onlinetxt"></div>
         <div class="grbtn"><a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">View Detail</a></div>
         <div class="clear"></div>
         </div>
       </div>
       
       
       <?php }?>
     
       
       <div class="clear"></div>
     </div>
     <div class="box_head">
       <div class="box_headtxt">Featured Deals</div>
       <div class="box_headsmall"><a href="<?php echo $apppath;?>index.php?m=productslist&fdeal=1" class="view" target="_top">See all deals</a></div>
       <div class="clear"></div>
     </div>  
     <div>
       <?php 
		$i=0;
			$selproqry=mysql_query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id and featured=1 order by Rand() limit 3");
			while($products=mysql_fetch_array($selproqry))
			{
				$i++;
		?>
     
       <div class="product_box <?php if($i==3){?>last<?php }?>">
         <div class="thumbimg">
         <a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">
         <img src="wadmin/products/<?php echo $products['c_id'];?>/<?php echo $products['thumb'];?>"  style="width:240px; height:145px;border:none" alt="product" /></a>
         </div>
         <div class="hedtxt">Deal Details 
           <br />
           <?php echo $products['title'];?></div>
         <div class="prodtxt">
         <div class="onlinetxt"></div>
         <div class="grbtn"><a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">View Detail</a></div>
         <div class="clear"></div>
         </div>
       </div>
       
       
       <?php }?>
       <div class="clear"></div>
     </div> 
    
    