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
						You're Here :: <a href="index.php">Home</a> :: My Deals
					</p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
<script>

function float_deals()
{
	$("#empty_div").hide();
	$("#group_deals_div").hide();
	$("#float_deals_div").show();
	$("#my_deals_div").hide();
}
function group_deals()
{
	$("#empty_div").hide();
	$("#group_deals_div").show();
	$("#float_deals_div").hide();
	$("#my_deals_div").hide();
}
function my_deals()
{
	$("#empty_div").hide();
	$("#group_deals_div").hide();
	$("#float_deals_div").hide();
	$("#my_deals_div").show();
}
</script>	
	<div class="container">

			<div id="user_log" class="clearfix">

<div style="width:850px; margin:20px 0;">
<a class="large_btn" onClick="float_deals();" href="#" style=" cursor:pointer;">My Float Deals</a>
<a class="large_btn" onClick="group_deals();"  href="#" style=" cursor:pointer;">My Group Deals</a>
<a class="large_btn" onClick="my_deals();"  href="#" style=" cursor:pointer;">My Buy Deals</a>
</div>
<div id="empty_div" style="height:200px;"></div>

<div class="nine columns" id="my_deals_div" style="display:none;">
					<div class="register">
						<div class="box_head">
							<h3>My Buy Deals</h3>
						</div><!--end box_head -->

<div id="receivedd"  style="width:800px; border:1px solid #CCC; margin-top:20px;" align="center">

		<?php
		$Query="SELECT sales.* , pro.title, pro.detail, pro.pro_id, pro.price, pro.thumb, photos.image
		FROM sales 
		inner join tbl_products pro on pro.pro_id = sales.pid
		inner join tbl_photos as photos on photos.pro_id = pro.pro_id
		WHERE sales.uid = '".$userContents['id']."' and sales.status = 1";
		$deals_array = $commonObject->selectMultiRecords($Query);
				 
		if(count($deals_array) > 0)
		{
			for($i=0;$i<count($deals_array);$i++)
			{
		?>
<div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; background-color:#cfeef5" align="left">
                <div style="clear:both"></div>
                <div style="width:450px;" align="left">
                   <h2>Deal Title : <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $deals_array[$i]['pro_id'];?>" target="_top"><?php 
				   echo $deals_array[$i]['title'];?></a>
                   </h2></div>
                    <div style="clear:both"></div>
                   <div style="width:150px;border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; padding:5px;margin:5px;" align="left">
                    <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $deals_array[$i]['pro_id'];?>" target="_top">
         <img src="wadmin/gallaryimg/thumbnails/<?php echo $deals_array[$i]['image'];?>" style="width:140px; height:85px; border:none" alt="product" /></a>  </div>
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Price :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($deals_array[$i]['price'],2);?></div>
                <div style="clear:both"></div>
				<div style="clear:both"></div>
				<div style="clear:both"></div>
            
			</div>		
		<?php
			}
		}	
		else
		{
	?>
	<br /><br />
	You have no Deals in your account.
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	
	<?php
	}	
			?>
 </div>
						

					</div>
				</div>
				

				<div class="nine columns" id="group_deals_div" style="display:none;">
					<div class="register">
						<div class="box_head">
							<h3>My Group Deals</h3>
						</div><!--end box_head -->

<div id="receivedd"  style="width:800px; border:1px solid #CCC; margin-top:20px;" align="center">

			<?php 
			//echo "select deal.*,pro.* from tbl_deal deal,tbl_products pro where deal.user_id=$user and pro.pro_id=deal.pro_id and deal.status=1 and deal.type = 'group'";
			mysql_query("delete from tbl_deals where user_id=$user and status=0");
			$mydealqry=mysql_query("select deal.*,pro.* , photos.image
			from tbl_deal deal,tbl_products pro 
			inner join tbl_photos as photos on photos.pro_id = pro.pro_id
			where deal.user_id=$user and pro.pro_id=deal.pro_id and deal.status=1 and deal.type = 'group'");
		$rowss = mysql_num_rows($mydealqry);
		if($rowss > 0)
			{
			while($dealinfo=mysql_fetch_array($mydealqry))
			{
				$particpaneqry=mysql_query("select * from tbl_members where deal_id=$dealinfo[deal_id]");
				$nummembers=mysql_num_rows($particpaneqry);
				
				$contribution=($dealinfo['price']/$nummembers);
				
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* from tbl_members mem,user_info as user where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and user.user_id=mem.user_id  ");
				$maturemembers=mysql_num_rows($mparticpaneqry);
			?>
            
            <div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; background-color:#cfeef5" align="left">
                <div style="clear:both"></div>
                <div style="width:450px;" align="left">
                   <h2>Deal Title : <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top"><?php echo $dealinfo['title'];?></a>
                   </h2></div>
                    <div style="clear:both"></div>
                   <div style="width:150px;border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; padding:5px;margin:5px;" align="left">
                    <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top">
         <img src="wadmin/gallaryimg/thumbnails/<?php echo $dealinfo['image'];?>" style="width:140px; height:85px; border:none" alt="product" /></a>  </div>
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
                 <a style="cursor:pointer;" href="<?php echo $apppath;?>reminder.php?deal_id=<?php echo $dealinfo['deal_id'];?>" target="_top">
                 <input type="button" value="" style="background-image:url(images/reminder.jpg); width:115px; height:29px; border:none; cursor:pointer;"/>
                 </a>
                 <?php }?>
                 </div>
                 <div style="clear:both"></div>
                  <div style="float:left; width:100%;">
				
                <?php 
				//echo "select mem.*,user.* from tbl_members mem,user_info user where mem.deal_id=$dealinfo[deal_id] and mem.status=0 and user.user_id=mem.user_id";
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
								
				/*?>
                <div style="float:left; width:50px; margin-left:15px;"><a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank"><img src="<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></a></div>
                
                <?php*/ }?>
                
                
                </div>
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Your contribution :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($contribution,2);?></div>
                
                
                <div style="clear:both"></div>
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
				
								
				
				/*
				
				?>
                <div style="float:left; width:50px; border:1px solid #069; padding:5px;margin:5px;"><img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;" /></div>
                
                <?php */}?>
                
                
                </div>
  <?php
  
$mparticpaneqry=@mysql_query("
			
			select mem.*,user.* from tbl_members mem 
			inner join user_info as user on  user.user_id=mem.user_id
			where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					$memberspic=@mysql_fetch_array($mparticpaneqry); 
//print_r($memberspic);
		if($memberspic['name'] != "")
		{			
  ?>              
                <div style="clear:both"></div>
                   <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2></div>
                <div style="float:left; width:100%;">
                	<?php 
					echo $memberspic['name'];
					?>
                    <br />
			<?php
								if($memberspic['fb'] == 1)
					{
			?>		
                <img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
			<?php
			}
			else
			{
			?>		
                <img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
			<?php
			}
			?>	
                </div>
    <?php 
			}
			?>             <div style="clear:both"></div>
            
			</div>
    
    		<?php 
			
			}
		}	
		else
		{
	?>
	<br /><br />
	You have no Group Deals in your account.
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	
	<?php
	}	
			?>
 </div>
						

					</div>
				</div><!--end nine-->



				<!--end seven-->

			</div><!--end user_log-->


<div id="user_log" class="clearfix">

				<div class="nine columns" id="float_deals_div"  style="display:none;">
					<div class="register">
						<div class="box_head">
							<h3>My Float Deals</h3>
						</div><!--end box_head -->

<div id="receivedd"  style="width:800px; border:1px solid #CCC; margin-top:20px;" align="center">

			<?php 
			//echo "select deal.*,pro.* from tbl_deal deal,tbl_products pro where deal.user_id=$user and pro.pro_id=deal.pro_id and deal.status=1 and deal.type = 'float'";
			mysql_query("delete from tbl_deals where user_id=$user and status=0");
			$mydealqry=mysql_query("select deal.*,pro.*, photos.image from tbl_deal deal,tbl_products pro 
			inner join tbl_photos as photos on photos.pro_id = pro.pro_id
			where deal.user_id=$user and pro.pro_id=deal.pro_id and deal.status=1 and deal.type = 'float'");
		$rowss = mysql_num_rows($mydealqry);
		if($rowss > 0)
			{
			while($dealinfo=mysql_fetch_array($mydealqry))
			{
				$particpaneqry=mysql_query("select * from tbl_members where deal_id=$dealinfo[deal_id]");
				$nummembers=mysql_num_rows($particpaneqry);
				
				$contribution=($dealinfo['price']/$nummembers);
				
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* from tbl_members mem,user_info as user where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and user.user_id=mem.user_id  ");
				$maturemembers=mysql_num_rows($mparticpaneqry);
			?>
            
            <div style="width:90%; margin:20; margin-top:20px; margin-bottom:20px; border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; background-color:#cfeef5" align="left">
                <div style="clear:both"></div>
                <div style="width:450px;" align="left">
                   <h2>Deal Title : <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top"><?php echo $dealinfo['title'];?></a>
                   </h2></div>
                    <div style="clear:both"></div>
                   <div style="width:150px;border:solid 1px #144d9a;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px;
    padding:10px; padding:5px;margin:5px;" align="left">
                    <a href="<?php echo $apppath;?>product-details.php?id=<?php echo $dealinfo['pro_id'];?>" target="_top">
         <img src="./wadmin/gallaryimg/thumbnails/<?php echo $dealinfo['image'];?>" style="width:140px; height:85px; border:none" alt="product" /></a>  </div>
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
                 <a style="cursor:pointer;" href="<?php echo $apppath;?>reminder.php?deal_id=<?php echo $dealinfo['deal_id'];?>" target="_top">
                 <input type="button" value="" style="background-image:url(images/reminder.jpg); width:115px; height:29px; border:none; cursor:pointer;"/>
                 </a>
                 <?php }?>
                 </div>
                 <div style="clear:both"></div>
                  <div style="float:left; width:100%;">
				
                <?php 
				//echo "select mem.*,user.* from tbl_members mem,user_info user where mem.deal_id=$dealinfo[deal_id] and mem.status=0 and user.user_id=mem.user_id";
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
								
				/*?>
                <div style="float:left; width:50px; margin-left:15px;"><a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank"><img src="<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></a></div>
                
                <?php*/ }?>
                
                
                </div>
                <div style="clear:both"></div>
                <div style="float:left; width:120px;">Your contribution :</div>
                <div style="float:left; width:100px;">$<?php echo number_format($contribution,2);?></div>
                
                
                
                <div style="clear:both"></div>
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
				
								
				
				/*
				
				?>
                <div style="float:left; width:50px; border:1px solid #069; padding:5px;margin:5px;"><img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;" /></div>
                
                <?php */}?>
                
                
                </div>
  <?php
  
$mparticpaneqry=@mysql_query("
			
			select mem.*,user.* from tbl_members mem 
			inner join user_info as user on  user.user_id=mem.user_id
			where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					$memberspic=@mysql_fetch_array($mparticpaneqry); 
//print_r($memberspic);
		if($memberspic['name'] != "")
		{			
  ?>              
                <div style="clear:both"></div>
                   <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2></div>
                <div style="float:left; width:100%;">
                	<?php 
					echo $memberspic['name'];
					?>
                    <br />
			<?php
								if($memberspic['fb'] == 1)
					{
			?>		
                <img src="<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
			<?php
			}
			else
			{
			?>		
                <img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
			<?php
			}
			?>	
                </div>
    <?php 
			}
			?>             <div style="clear:both"></div>
            
			</div>
    
    		<?php 
			
			}
		}	
		else
		{
	?>
	<br /><br />
	You have no Float Deals in your account.
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