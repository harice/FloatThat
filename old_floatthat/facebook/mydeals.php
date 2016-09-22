 
    <div class="container sixteen columns">

		<div class="latest">
			
			<div class="box_head">
				<h3>My Deals</h3>
				
			</div><!--end box_head -->

			<div class="cycle-slideshow"> 
			
			<?php 
			
			mysql_query("delete from tbl_deals where user_id=$user and status=0");
			$mydealqry=mysql_query("select deal.*,pro.* from tbl_deal deal,tbl_products pro where deal.user_id=$user and pro.pro_id=deal.pro_id and deal.status=1");
			while($dealinfo=mysql_fetch_array($mydealqry))
			{
				$particpaneqry=mysql_query("select * from tbl_members where deal_id=$dealinfo[deal_id]");
				$nummembers=mysql_num_rows($particpaneqry);
				
				$contribution=($dealinfo['price']/$nummembers);
				
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* from tbl_members mem,user_info user where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and user.user_id=mem.user_id");
				$maturemembers=mysql_num_rows($mparticpaneqry);
			?>
            
            <div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; background-color:#cfeef5" align="left">
                <div style="clear:both"></div>
                <div style="width:450px;" align="left">
                   <h2>Deal Title : <a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $dealinfo['pro_id'];?>" target="_top"><?php echo $dealinfo['title'];?></a>
                   </h2></div>
                    <div style="clear:both"></div>
                   <div style="width:150px;border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; padding:5px;margin:5px;" align="left">
                    <a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $dealinfo['pro_id'];?>" target="_top">
         <img src="wadmin/products/<?php echo $dealinfo['c_id'];?>/<?php echo $dealinfo['thumb'];?>" style="width:140px; height:85px; border:none" alt="product" /></a>  </div>
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Total Cost :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($dealinfo['price'],2);?></div>
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Total participant :</div>
                <div style="float:left; width:100px;"><?php echo $nummembers;?></div>
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Pending participant :</div>
                <div style="float:left; width:100px;"><?php echo $nummembers-$maturemembers;?></div>
                
                 <div style="float:left; width:100px;">
                 <?php if($dealinfo['closestatus']==0){?>
                 <a href="<?php echo $apppath;?>index.php?m=reminder&deal_id=<?php echo $dealinfo['deal_id'];?>" target="_top">
                 <input type="button" value="" style="background-image:url(images/reminder.jpg); width:115px; height:29px; border:none"/>
                 </a>
                 <?php }?>
                 </div>
                 <div style="clear:both"></div>
                  <div style="float:left; width:100%;">
				
                <?php 
				$mparticpaneqry2=mysql_query("select mem.*,user.* from tbl_members mem,user_info user where mem.deal_id=$dealinfo[deal_id] and mem.status=0 and user.user_id=mem.user_id");
				
				while($memberspic2=mysql_fetch_array($mparticpaneqry2))
				{
				
				?>
                <div style="float:left; width:50px; margin-left:15px;"><a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank"><img src="<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></a></div>
                
                <?php }?>
                
                
                </div>
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Your contribution :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($contribution,2);?></div>
                
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Closing Date :</div>
                <div style="float:left; width:100px;"> <?php echo date('m-d-Y',strtotime($dealinfo['closedate']));?></div>
                
                <div style="clear:both"></div>
                   <div style="float:left; width:200px;"><h2>Mature Members :</h2></div>
                <div style="float:left; width:100%;">
				
                <?php 
				
				
				while($memberspic=mysql_fetch_array($mparticpaneqry))
				{
				
				?>
                <div style="float:left; width:50px; border:1px solid #069; padding:5px;margin:5px;"><img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;" /></div>
                
                <?php }?>
                
                
                </div>
                
                <div style="clear:both"></div>
                   <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2></div>
                <div style="float:left; width:100%;">
                	<?php $mparticpaneqry=@mysql_query("select mem.*,user.* from tbl_members mem,user_info user where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and mem.winner=1 and user.user_id=mem.user_id");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					echo $memberspic['name'];
					?>
                    <br />
                <img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
                </div>
                 <div style="clear:both"></div>
            
			</div>
    
    		<?php }?>
 	</div><!--end pagination-->
		</div><!--end sixteen-->

	</div>