<?php
	require_once ("config.php");

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Float That</title>
	<meta name="description" content="">
	<meta name="Hassan" content="Float That">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/user_log.css">
	<link rel="stylesheet" href="css/responsive.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<link rel="stylesheet" type="text/css" href="css/ie8-and-down.css" />
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">

</head>
<body>

	<!--start header-->
	<?php require_once("header.php");?>	
	<!--end header-->



	<div class="container">
		<div class="sixteen columns">
			
			<div id="pageName">
				<div class="name_tag">
					<p>
						You're Here :: <a href="index.php">Home</a> :: Invitations
					</p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->

<script>

function float_deals()
{
	///$("#empty_div").hide();
	$("#group_deals_div").hide();
	$("#float_deals_div").show();
}
function group_deals()
{
	//$("#empty_div").hide();
	$("#group_deals_div").show();
	$("#float_deals_div").hide();
}
</script>

	<!-- strat the main content area -->
	
	<div class="container">

			<div id="user_log" class="clearfix">
<?php
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.type = 'group'");
	$user == '';		
	$GroupDeals = mysql_num_rows($invitations);
	
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.type = 'float'");
	$user == '';		
	$FloatDeals = mysql_num_rows($invitations);	
	
	$float = 'block';
	$group = 'none';
	if($FloatDeals > 0)
		$float = 'block';
	else	if($GroupDeals > 0)
		$group = 'block';
?>
<div style="width:850px; margin:20px 0;">
<a class="large_btn" onClick="float_deals();"  href="#" style=" cursor:pointer;">Float Deals <?php if($FloatDeals > 0) echo "(".$FloatDeals.")";?></a>
<a class="large_btn" onClick="group_deals();"  href="#" style=" cursor:pointer;">Group Deals <?php if($GroupDeals > 0) echo "(".$GroupDeals.")";?></a>
</div>

				<div class="nine columns" id="group_deals_div" style="display:<?php echo $group;?>;">
					<div class="register">
						<div class="box_head">
							<h3>Group Invitations</h3>
						</div><!--end box_head -->


<div id="receivedd"  style="width:800px; border:1px solid #CCC; margin-top:20px;" align="center">

			<?php 
if($_GET['msg'] == "decline")
{
	echo "<span style='color:red;'><br /><br />You deal has been Declined.</span><br /><br />";
}

if($user == "")
	$user = $userContents['user_id'];
	//mysql_query("delete from tbl_deals where user_id=$user and status=0");	
	
	$invitations=mysql_query("select deals.*, members.*, members.status as member_status 
	from tbl_members as members  
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.type = 'group'");
	$user == '';		
	$rowss = mysql_num_rows($invitations);
	if(	$rowss > 0 )
	{	
			while($invitinfo=mysql_fetch_array($invitations))
			{
			
			
				
				$mydealqry=mysql_query("select deal.*,pro.* , photos.*
				from tbl_deal deal,tbl_products pro 
				
				left join tbl_photos as photos on photos.pro_id = pro.pro_id
				
				where deal.deal_id=$invitinfo[deal_id] and pro.pro_id=deal.pro_id and deal.type = 'group' and deal.status = 1
				limit 1
				");
				
				$dealinfo=mysql_fetch_array($mydealqry);
				
				$particpaneqry=mysql_query("select * from tbl_members where deal_id=$dealinfo[deal_id]");
				$nummembers=mysql_num_rows($particpaneqry);
				
				$contribution=($dealinfo['price']/$nummembers);
				
				$createdby=mysql_query("select * from user_info where user_id=$dealinfo[user_id]");
				$uinfo=mysql_fetch_array($createdby);
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* 
											from tbl_members mem,user_info as user 
										where 
											mem.deal_id=$dealinfo[deal_id] 
										and 
											mem.status=1 and user.user_id=mem.user_id");
				
				$maturemembers=mysql_num_rows($mparticpaneqry);
			?>
            
            <div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; background-color:#cfeef5" align="left">
                <div style="clear:both"></div>
                <div style="width:400px;" align="left">
                   <h2>Deal Title : <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top"><?php echo $dealinfo['title'];?></a></h2></div>
                    <div style="clear:both"></div>
                   <div style="width:150px;border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; padding:5px;margin:5px;" align="left">
                    <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top">
         <img src="./wadmin/gallaryimg/gallaryphotos/<?php echo $dealinfo['image'];?>" style="width:140px; height:85px; border:none" alt="product" /></a>  </div>
                   <div style="clear:both"></div>
                <div style="width:400px;"><h2>Created By : <?php echo $uinfo['name'];?></h2></div>
               
                  <div style="clear:both"></div>
                <div style=" width:100px;border:1px solid #069; padding:5px;margin:5px;">
				<?php
				if($uinfo['fb'] == 1)				
				{
				?>
				<img src="<?php echo $uinfo['pic'];?>" />
				<?php
				}
				else
				{
				?>
				<img src="./avatar/<?php echo $uinfo['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
				<?php
				}
				?>
				</div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Total Cost :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($dealinfo['price'],2);?></div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Total participant :</div>
                <div style="float:left; width:100px;"><?php echo $nummembers;?></div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Pending participant :</div>
                <div style="float:left; width:100px;"><?php echo $nummembers-$maturemembers;?></div>
                 <div style="clear:both"></div>
                  <div style="float:left; width:100%;">
				
                <?php 
				$mparticpaneqry2=mysql_query("
				select mem.*,user.* from tbl_members mem
				left join user_info as user on  user.user_id=mem.user_id
				where mem.deal_id=$dealinfo[deal_id] and mem.status=1");
				
				while($memberspic2=mysql_fetch_array($mparticpaneqry2))
				{
				
					if($memberspic2['fb'] == 1)
					{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank"><img src="<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></a></div>
                
                <?php 
				}
				else
				{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
                
                <?php 				
				}
				}?>
                
                
                </div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Your contribution :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($contribution,2);?></div>
                 <div style="clear:both"></div>
                
                <!--<div style="float:left; width:200px;">Closing Date :</div>
                <div style="float:left; width:100px;"><?php echo date('m-d-Y',strtotime($dealinfo['closedate']));?></div>
                  <div style="clear:both"></div>-->
                   <div style="float:left; width:200px;"><h2>Participating Members :</h2></div>
                <div style="float:left; width:100%;">
				
                <?php 
				
				
				while($memberspic=mysql_fetch_array($mparticpaneqry))
				{
									if($memberspic['fb'] == 1)
					{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
                
                <?php 
				}
				else
				{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
                
                <?php 				
				}
				}?>
                
                
                </div>
                  <div style="clear:both"></div>
                 <div style="margin-top:15px;">
                 
                 <?php 
			if($dealinfo['closestatus']==0){
				 
				 if($invitinfo['member_status']==0){?> 
                 
                 <a href="<?php echo $apppath;?>accept.php?deal_id=<?php echo $dealinfo['deal_id'];?>"  target="_top">
            <input type="button" value=""  style="background-image:url(images/accept.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>
<br>
                 <a href="<?php echo $apppath;?>decline.php?deal_id=<?php echo $dealinfo['deal_id'];?>"  target="_top">
            <input type="button" value="Decline Icon"  style="background-image:url(images/accept.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>


            <?php } else {?>
            <input type="button" value=""  style="background-image:url(images/accepted.jpg); width:200px; height:60px; border:none; cursor:pointer"/>
            <?php }
			}
			else
			{
			?>
            
            <?php $mparticpaneqry=@mysql_query("
			
			select mem.*,user.* from tbl_members mem 
			inner join user_info as user on  user.user_id=mem.user_id
			where mem.deal_id=$dealinfo[deal_id] and mem.status=0 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					
					if($memberspic['fb'] == 1)
					{				
					?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name'];?>
                    <br />
                <img src="<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           			 </div>
            
            <?php 
			}
			else
			{
?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name'];?>
                    <br />
                <img src="./avatar/<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           			 </div>
            
            <?php 			
			}
			
			
			
			
			}?>
            </div>
            
                    <div style="clear:both"></div>
            </div>
    		<?php }
	
	}
	else
	{
	?>
	<br /><br />
	You have no Group Invitataions.
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	
	<?php
	}
			?>
 </div>
				

					</div>
				</div><!--end nine-->



				<!--end seven-->

			</div><!--end user_log-->


<div  id="float_deals_div" style="display:<?php echo $float;?>;" class="clearfix">

				<div class="nine columns">
					<div class="register">
						<div class="box_head">
							<h3>Float Deal Invitations</h3>
						</div><!--end box_head -->


<div id="receivedd"  style="width:800px; border:1px solid #CCC; margin-top:20px;" align="center">

			<?php 
if($_GET['msg'] == "decline")
{
	echo "<span style='color:red;'><br /><br />You deal has been Declined.</span><br /><br />";
}

if($user == "")
	$user = $userContents['user_id'];
	/*echo "select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user";*/			
	$invitations=mysql_query("select deals.*, members.*, members.status as member_status 
	 from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.type = 'float'");
	$user == '';		
	$rowss = mysql_num_rows($invitations);
	if(	$rowss > 0 )
	{	
			while($invitinfo=mysql_fetch_array($invitations))
			{
			
				$mydealqry=mysql_query("select deal.*,pro.*, photos.* from tbl_deal deal,tbl_products  pro
				
				left join tbl_photos as photos on photos.pro_id = pro.pro_id
				
				 where deal.deal_id=$invitinfo[deal_id] and pro.pro_id=deal.pro_id and deal.type = 'float'  and deal.status = 1");
				
				$dealinfo=mysql_fetch_array($mydealqry);
				
				$particpaneqry=mysql_query("select * from tbl_members where deal_id=$dealinfo[deal_id]");
				$nummembers=mysql_num_rows($particpaneqry);
				
				$contribution=($dealinfo['price']/$nummembers);
				//echo "select * from user_info where user_id=$dealinfo[user_id]";
				$createdby=mysql_query("select * from user_info where user_id=$dealinfo[user_id]");
				$uinfo=mysql_fetch_array($createdby);
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* from tbl_members mem,user_info as user where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and user.user_id=mem.user_id");
				
				$maturemembers=mysql_num_rows($mparticpaneqry);
				
				//echo "<pre>";
				//print_r($uinfo);
			?>
            
            <div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; background-color:#cfeef5" align="left">
                <div style="clear:both"></div>
                <div style="width:400px;" align="left">
                   <h2>Deal Title : <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top"><?php echo $dealinfo['title'];?></a></h2></div>
                    <div style="clear:both"></div>
                   <div style="width:150px;border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; padding:5px;margin:5px;" align="left">
                    <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top">
         <img src="./wadmin/gallaryimg/gallaryphotos/<?php echo $dealinfo['image'];?>" style="width:140px; height:85px; border:none" alt="product" /></a>  </div>
                   <div style="clear:both"></div>
                <div style="width:400px;"><h2>Created By : <?php echo $uinfo['name'];?></h2></div>
               
                  <div style="clear:both"></div>
                <div style=" width:100px;border:1px solid #069; padding:5px;margin:5px;">
				<?php
				//echo $uinfo['fb'];
				if($uinfo['fb'] == 1)				
				{
				?>
				<img src="<?php echo $uinfo['pic'];?>" />
				<?php
				}
				else
				{
				?>
				<img src="./avatar/<?php echo $uinfo['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
				<?php
				}
				?>
				</div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Total Cost :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($dealinfo['price'],2);?></div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Total participant :</div>
                <div style="float:left; width:100px;"><?php echo $nummembers;?></div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Pending participant :</div>
                <div style="float:left; width:100px;"><?php echo $nummembers-$maturemembers;?></div>
                 <div style="clear:both"></div>
                  <div style="float:left; width:100%;">
				
                <?php 
				$mparticpaneqry2=mysql_query("
				select mem.*,user.* from tbl_members mem
				left join user_info as user on  user.user_id=mem.user_id
				where mem.deal_id=$dealinfo[deal_id] and mem.status=0");
				
				while($memberspic2=mysql_fetch_array($mparticpaneqry2))
				{
				
					if($memberspic2['fb'] == 1)
					{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank"><img src="<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></a></div>
                
                <?php 
				}
				else
				{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
                
                <?php 				
				}
				}?>
                
                
                </div>
                <div style="clear:both"></div>
                <div style="float:left; width:200px;">Your contribution :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($contribution,2);?></div>
                 <div style="clear:both"></div>
                
                <!--<div style="float:left; width:200px;">Closing Date :</div>
                <div style="float:left; width:100px;"><?php echo date('m-d-Y',strtotime($dealinfo['closedate']));?></div>
                  <div style="clear:both"></div>-->
                   <div style="float:left; width:200px;"><h2>Participating Members :</h2></div>
                <div style="float:left; width:100%;">
				
                <?php 
				
				
				while($memberspic=mysql_fetch_array($mparticpaneqry))
				{
									if($memberspic['fb'] == 1)
					{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
                
                <?php 
				}
				else
				{
				?>
                <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
                
                <?php 				
				}
				}?>
                
                
                </div>
                  <div style="clear:both"></div>
                 <div style="margin-top:15px;">
                 
                 <?php 
			if($dealinfo['closestatus']==0){
				 
				 if($invitinfo['member_status']==0){?> 
                 
                 <a href="<?php echo $apppath;?>accept.php?deal_id=<?php echo $dealinfo['deal_id'];?>"  target="_top">
            <input type="button" value=""  style="background-image:url(images/accept.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>
<br>
                 <a href="<?php echo $apppath;?>decline.php?deal_id=<?php echo $dealinfo['deal_id'];?>"  target="_top">
            <input type="button" value="Decline Icon"  style="background-image:url(images/accept.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>


            <?php } else {?>
            <input type="button" value=""  style="background-image:url(images/accepted.jpg); width:200px; height:60px; border:none; cursor:pointer"/>
            <?php }
			}
			else
			{
			?>
            
            <?php $mparticpaneqry=@mysql_query("
			
			select mem.*,user.* from tbl_members mem 
			inner join user_info as user on  user.user_id=mem.user_id
			where mem.deal_id=$dealinfo[deal_id] and mem.status=0 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					
					if($memberspic['fb'] == 1)
					{				
					?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name'];?>
                    <br />
                <img src="<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           			 </div>
            
            <?php 
			}
			else
			{
?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name'];?>
                    <br />
                <img src="./avatar/<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           			 </div>
            
            <?php 			
			}
			
			
			
			
			}?>
            </div>
            
                    <div style="clear:both"></div>
            </div>
    		<?php }
	
	}
	else
	{
	?>
	<br /><br />
	You have no Float Deal Invitataions.
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	
	<?php
	}
			?>
 </div>
				

					</div>
				</div><!--end nine-->



				<!--end seven-->

			</div>
			
			
	</div><!--end container-->
	<!-- end the main content area -->


	<!-- start the footer area-->
	<?php require_once("footer.php");?>	
	<!--end the footer area -->



	<!-- JS
	================================================== -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <!-- jQuery.dropKick plug-in -->
    <link rel="stylesheet" href="js/dropKick/dropkick.css">
	<script src="js/dropKick/jquery.dropkick-1.0.0.js"></script>
	<!-- jQuery.nicescroll plug-in -->
	<script src="js/jquery.nicescroll.js"></script>
	<!-- jQuery.tweet plug-in -->
	<script src="js/jquery.tweet.js"></script>
	<!-- jQuery.cycle2 plug-in -->
	<script src="js/jquery.cycle2.min.js"></script>
	<script src="js/jquery.cycle2.tile.min.js"></script>
	<!-- jQuery.jcarousellite plug-in -->
	<script src="js/jcarousellite_1.0.1.min.js"></script>
	<!-- jQuery.fancybox plug-in -->
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css">
	<script src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<!-- jQuery.etalage plug-in -->
	<script src="js/jquery.etalage.min.js"></script>
	<!-- jQuery.cookie plug-in -->
	<script src="js/jquery.cookie.js"></script>
	<!--my custom code-->	
	<script src="js/main.js"></script>
	
	

<!-- End Document
================================================== -->
</body>
</html>