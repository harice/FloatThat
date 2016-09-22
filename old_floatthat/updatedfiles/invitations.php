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
	$( "#flaot_deal_link" ).removeClass( "large_btn" ).addClass( "large_btn5" );
	$( "#group_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#accepted_float_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#accepted_group_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );

	$("#accepted_float_deals_div").hide();
	$("#accepted_group_deals_div").hide();
	$("#group_deals_div").hide();
	$("#float_deals_div").show();
}
function group_deals()
{
	$( "#flaot_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#group_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn5" );
	$( "#accepted_float_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#accepted_group_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	
	$("#accepted_float_deals_div").hide();
	$("#accepted_group_deals_div").hide();
	$("#group_deals_div").show();
	$("#float_deals_div").hide();
} 
function accepted_group_deals()
{
	$( "#flaot_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#group_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#accepted_float_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#accepted_group_deal_link" ).removeClass( "large_btn" ).addClass( "large_btn5" );
	
	$("#group_deals_div").hide();
	$("#float_deals_div").hide();
	$("#accepted_float_deals_div").hide();
	$("#accepted_group_deals_div").show();
	
}
function accepted_float_deals()
{
	$( "#flaot_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#group_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	$( "#accepted_float_deal_link" ).removeClass( "large_btn" ).addClass( "large_btn5" );
	$( "#accepted_group_deal_link" ).removeClass( "large_btn5" ).addClass( "large_btn" );
	
	$("#group_deals_div").hide();
	$("#float_deals_div").hide();
	$("#accepted_float_deals_div").show();
	$("#accepted_group_deals_div").hide();
}
</script>

	<!-- strat the main content area -->
	
	<div class="container">

			<div id="user_log" class="clearfix">
<?php
$user=$_SESSION['u_id'];
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.user_id != $user and deals.type = 'group'");
	$user == '';		
	$GroupDeals = mysql_num_rows($invitations);
	
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.user_id != $user and deals.type = 'float'");
	$user == '';		
	$FloatDeals = mysql_num_rows($invitations);	
	
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1 and members.status = 1
	where members.user_id=$user and deals.type = 'group'");
	$user == '';		
	$AccpeptedGroupDeals = mysql_num_rows($invitations);
	
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1 and members.status = 1
	where members.user_id=$user and deals.type = 'float'");
	$user == '';		
	$AccpeptedFloatDeals = mysql_num_rows($invitations);
			
	$float = 'block';
	$group = 'none';
	$class1 = "large_btn";
	$class2 = "large_btn";
	$class3 = "large_btn";
	$class4 = "large_btn";
	
	
	if($FloatDeals > 0)
	{
		$float = 'block';
		$class1 = "large_btn5";
		$class2 = "large_btn";
		$class3 = "large_btn";
		$class4 = "large_btn";
	}	
	else	if($GroupDeals > 0)
	{
		$group = 'block';
		$class1 = "large_btn";
		$class2 = "large_btn5";
		$class3 = "large_btn";
		$class4 = "large_btn";		
	}	
?>
<div style="width:850px; margin:20px 0;">
<a class="<?php echo $class1;?>" id="flaot_deal_link" onClick="float_deals();"  href="#" style=" cursor:pointer;">Float Deals <?php if($FloatDeals > 0) echo "(".$FloatDeals.")";?></a>
<a class="<?php echo $class2;?>" id="group_deal_link" onClick="group_deals();"  href="#" style=" cursor:pointer;">Group Deals <?php if($GroupDeals > 0) echo "(".$GroupDeals.")";?></a>
<a class="<?php echo $class3;?>" id="accepted_float_deal_link" onClick="accepted_float_deals();"  href="#" style=" cursor:pointer;">Accpepted Float <?php if($AccpeptedFloatDeals > 0) echo "(".$AccpeptedFloatDeals.")";?></a>
<a class="<?php echo $class4;?>" id="accepted_group_deal_link" onClick="accepted_group_deals();"  href="#" style=" cursor:pointer;">Accpepted Group <?php if($AccpeptedGroupDeals > 0) echo "(".$AccpeptedGroupDeals.")";?></a>

</div>

				<div class="nine columns" id="group_deals_div" style="display:<?php echo $group;?>;">
					<div class="register">
						<div class="box_head">
							<h3>Group Invitations Received</h3>
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
	where members.user_id=$user and deals.user_id != $user and deals.type = 'group'");
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
				
				$contribution=($dealinfo['price']/$dealinfo['ods']);
				
				$createdby=mysql_query("select * from user_info where id=$dealinfo[user_id]");
				$uinfo=mysql_fetch_array($createdby);
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* 
											from tbl_members mem,user_info as user 
										where 
											mem.deal_id=$dealinfo[deal_id] 
										and 
											mem.status=1 and user.id=mem.user_id");
				
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
				<img src="<?php echo $invitinfo['friend_pics'];?>" />
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
				left join user_info as user on  user.id=mem.user_id
				where mem.deal_id=$dealinfo[deal_id] and mem.status=1");
				
				while($memberspic2=mysql_fetch_array($mparticpaneqry2))
				{
				
					if($memberspic2['fb'] == 1)
					{
				?>
                <div style="width:50px; margin-left:15px;">
					<?php echo $memberspic2['email'];?>
         <?php /*?>       <a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank">
                <img src="<?php echo $memberspic2['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" />
                </a><?php */?>
<!--
                <a href="<?php echo $memberspic2['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" />
                </a>--></div>
                
                <?php 
				}
				else
				{
					echo $memberspic2['email'];
				?>
             <?php /*?>   <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
             <?php */?>   
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
                <div style="width:50px; margin-left:15px;">
                <?php echo $memberspic['email'];?>
            <?php /*?>    <img src="<?php echo $memberspic['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
            <?php */?>    
                <?php 
				}
				else
				{
				?>
                <?php echo $memberspic['email'];?>
              <?php /*?>  <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
              <?php */?>  
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
            <input type="button" value="Decline Icon"  style="background-image:url(images/decline.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>


            <?php } else {?>
            <input type="button" value=""  style="background-image:url(images/accepted.jpg); width:200px; height:60px; border:none; cursor:pointer"/>
            <?php }
			}
			else
			{
			?>
            
            <?php $mparticpaneqry=@mysql_query("
			
			select mem.*,user.* from tbl_members mem 
			inner join user_info as user on  user.id=mem.user_id
			where mem.deal_id=$dealinfo[deal_id] and mem.status=0 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					
					if($memberspic['fb'] == 1)
					{				
					?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name']."<br>";
						   echo $memberspic['email'];
					?>
                    <br />
             <?php /*?>   <img src="<?php echo $memberspic['friend_pics'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           	<?php */?>		 </div>
            
            <?php 
			}
			else
			{
?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name']."<br>";
						   echo $memberspic['email'];
					?>
                    <br />
              <?php /*?>  <img src="./avatar/<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           		<?php */?>	 </div>
            
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
							<h3>Float Invitations Received</h3>
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
	where members.user_id=$user and deals.user_id != $user and deals.type = 'float'");
	$user == '';		
	$rowss = mysql_num_rows($invitations);
	if(	$rowss > 0 )
	{	
			while($invitinfo=mysql_fetch_array($invitations))
			{
				
			
				$mydealqry=mysql_query("select deal.deal_id,deal.user_id as dealuser,deal.pro_id,pro.*, photos.* from tbl_deal deal,tbl_products  pro
				
				left join tbl_photos as photos on photos.pro_id = pro.pro_id
				
				 where deal.deal_id=$invitinfo[deal_id] and pro.pro_id=deal.pro_id and deal.type = 'float'  and deal.status = 1");
				
				$dealinfo=mysql_fetch_array($mydealqry);
				
				$particpaneqry=mysql_query("select * from tbl_members where deal_id=$dealinfo[deal_id]");
				$nummembers=mysql_num_rows($particpaneqry);
				
				$contribution=($dealinfo['price']/$dealinfo['ods']);
				$createdby=mysql_query("select * from user_info where id=$dealinfo[dealuser]");
				$uinfo=mysql_fetch_array($createdby);
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* from tbl_members mem,user_info as user where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and user.id=mem.user_id");
				
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
                <div style="width:400px;"><h2>Created By : <?php echo $uinfo['name']."(".$uinfo['email'].")";?></h2></div>
               
                  <div style="clear:both"></div>
               
				<?php
				/*?>//echo $uinfo['fb']; <div style=" width:100px;border:1px solid #069; padding:5px;margin:5px;">
				if($uinfo['fb'] == 1)				
				{
					echo	$uinfo['name']."(".$uinfo['email'].")";	
				?>
				<?php /*?><img src="<?php echo $invitinfo['friend_pics'];?>" /><?php */
				
				//}
				//else
				//{
				//echo $uinfo['name']."(".$uinfo['email'].")";	
				?>
			<?php /*?>	<img src="./avatar/<?php echo $uinfo['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
			<?php */?>	<?php
				//}<?php </div>*/?>
				
				
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
				left join user_info as user on  user.id=mem.user_id
				where mem.deal_id=$dealinfo[deal_id]");
				
				while($memberspic2=mysql_fetch_array($mparticpaneqry2))
				{
				
					if($memberspic2['fb'] == 1)
					{
						
				?>
                <div style="width:50px; margin-left:15px;">
           <?php 
		   echo $memberspic2['email'];
		   /*?>     <a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank">
                <img src="<?php echo $memberspic2['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" />
                </a><?php */?>
                </div>
                
                <?php 
				}
				else
				{
					echo $memberspic2['email']."<br>";
				?>
              <?php /*?>  <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
              <?php */?>  
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
						echo $memberspic['email']."<br>";
				?>
            <?php /*?>    <div style="float:left; width:50px; margin-left:15px;"><img src="<?php echo $memberspic['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
            <?php */?>    
                <?php 
				}
				else
				{
					echo $memberspic['email']."<br>";
				?>
              <?php /*?>  <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
               <?php */?> 
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
            <input type="button" value="Decline Icon"  style="background-image:url(images/decline.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>


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
			where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					
					if($memberspic['fb'] == 1)
					{				
					?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
<?php echo $memberspic['friend_names'];?>
                    <br />
              <?php /*?>  <img src="<?php echo $memberspic['friend_pics'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           		<?php */?>	 </div>
            
            <?php 
			}
			else
			{
?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name']."<br>"; echo $memberspic['email'];?>
                    <br />
              <?php /*?>  <img src="./avatar/<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           		<?php */?>	 </div>
            
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
			


<div  id="accepted_group_deals_div" class="clearfix">

				<div class="nine columns">
					<div class="register">
						<div class="box_head">
							<h3>Accepted Group Deals</h3>
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
	where members.user_id=$user and members.status = 1 and deals.type = 'group'");
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
				
				$contribution=($dealinfo['price']/$dealinfo['ods']);
				
				$createdby=mysql_query("select * from user_info where id=$dealinfo[user_id]");
				$uinfo=mysql_fetch_array($createdby);
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* 
											from tbl_members mem,user_info as user 
										where 
											mem.deal_id=$dealinfo[deal_id] 
										and 
											mem.status=1 and user.id=mem.user_id");
				
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
				<img src="<?php echo $invitinfo['friend_pics'];?>" />
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
				left join user_info as user on  user.id=mem.user_id
				where mem.deal_id=$dealinfo[deal_id] and mem.status=1");
				
				while($memberspic2=mysql_fetch_array($mparticpaneqry2))
				{
				
					if($memberspic2['fb'] == 1)
					{
				?>
                <div style="float:left; width:50px; margin-left:15px;">
             <?php 
			 echo $memberspic2['email'];
			 /*?>   <a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank">
                <img src="<?php echo $memberspic2['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></a></div>
             <?php */?>   
                <?php 
				}
				else
				{
					 echo $memberspic2['email'];
				?>
           <?php /*?>     <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
           <?php */?>     
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
                <div style="float:left; width:50px; margin-left:15px;">
          <?php 
		   echo $memberspic['email'];
		  /*?>      <img src="<?php echo $memberspic['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
          <?php */?>      
                <?php 
				}
				else
				{
					 echo $memberspic['email'];
				?>
                
             <?php /*?>   <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
              <?php */?>  
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
            <input type="button" value="Decline Icon"  style="background-image:url(images/decline.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>


            <?php } else {?>
            <input type="button" value=""  style="background-image:url(images/accepted.jpg); width:200px; height:60px; border:none; cursor:pointer"/>
            <?php }
			}
			else
			{
			?>
            
            <?php $mparticpaneqry=@mysql_query("
			
			select mem.*,user.* from tbl_members mem 
			inner join user_info as user on  user.id=mem.user_id
			where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					
					if($memberspic['fb'] == 1)
					{				
					?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['friend_names'];?>
                    <br />
             <?php /*?>   <img src="<?php echo $memberspic['friend_pics'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           	<?php */?>		 </div>
            
            <?php 
			}
			else
			{
?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name'];?>
                    <br />
               <?php /*?> <img src="./avatar/<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           		<?php */?>	 </div>
            
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
	You have no Accepted Groups.
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	
	<?php
	}
			?>
 </div>
				

					</div>
				</div><!--end nine-->



				<!--end seven-->

			</div>
			
<div  id="accepted_float_deals_div" class="clearfix">

				<div class="nine columns">
					<div class="register">
						<div class="box_head">
							<h3>Accepted Float Deals</h3>
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
	where members.user_id=$user and members.status = 1 and deals.type = 'float'");
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
				
				$contribution=($dealinfo['price']/$dealinfo['ods']);
				//echo "select * from user_info where user_id=$dealinfo[user_id]";
				$createdby=mysql_query("select * from user_info where id=$dealinfo[user_id]");
				$uinfo=mysql_fetch_array($createdby);
				
				
				$mparticpaneqry=mysql_query("select mem.*,user.* from tbl_members mem,user_info as user where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and user.id=mem.user_id");
				
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
					echo $uinfo['email'];
				?>
				<?php /*?><img src="<?php echo $invitinfo['friend_pics'];?>" /><?php */?>
				<?php
				}
				else
				{
				echo	$uinfo['email'];
				?>
				<?php /*?><img src="./avatar/<?php echo $uinfo['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
			<?php */?>	<?php
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
				left join user_info as user on  user.id=mem.user_id
				where mem.deal_id=$dealinfo[deal_id]");
				
				while($memberspic2=mysql_fetch_array($mparticpaneqry2))
				{
				
					if($memberspic2['fb'] == 1)
					{
				?>
                <div style="width:50px; margin-left:15px;">
          <?php 
		  			echo $memberspic2['email'];
		  /*?>      <a href="https://www.facebook.com/profile.php?id=<?php echo $memberspic2['user_id'];?>" target="_blank">
                <img src="<?php echo $memberspic2['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></a></div>
           <?php */?>     
                <?php 
				}
				else
				{
					 echo $memberspic2['email'];
				?>
             <?php /*?>   <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic2['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
             <?php */?>   
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
              <?php 
			  echo $memberspic['email'];
			  /*?>  <div style="float:left; width:50px; margin-left:15px;"><img src="<?php echo $memberspic['friend_pics'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
              <?php */?>  
                <?php 
				}
				else
				{
				?>
             <?php /*?>   <div style="float:left; width:50px; margin-left:15px;"><img src="./avatar/<?php echo $memberspic['pic'];?>"  style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;" /></div>
             <?php */?>   
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
            <input type="button" value="Decline Icon"  style="background-image:url(images/decline.jpg); width:200px; height:60px; border:none; cursor:pointer"/></a>


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
			where mem.deal_id=$dealinfo[deal_id] and mem.status=1 and mem.winner=1 ");
					$memberspic=@mysql_fetch_array($mparticpaneqry);
					
					if($memberspic['fb'] == 1)
					{				
					?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['friend_names'];?>
                    <br />
            <?php /*?>    <img src="<?php echo $memberspic['friend_pics'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           	<?php */?>		 </div>
            
            <?php 
			}
			else
			{
?>
                      <div style="float:left; width:200px;"><h2>Winner Of The Deal :</h2>
                    
                    <?php echo $memberspic['name']."<br>".$memberspic['email'];?>
                    <br />
           <?php /*?>     <img src="./avatar/<?php echo $memberspic['pic'];?>"   style="width:50px; height:50px;border:1px solid #069; padding:5px; margin:5px;"/>
           	<?php */?>		 </div>
            
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
	You have no Accepted Float Deals.
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