<?php
if($_GET['frm'] == "fb")
{
?>
<script>
window.location = "<?php echo $loginUrl;?>";
</script>
<?php
}
?>
<header>

		<div id="topHeader">
			<div class="container">
				<div class="sixteen columns">
					<ul id="topNav">
					<?php
						if(trim($userContents['email']) == "")
						{
						?>
                    	<li><a href="<?php echo $loginUrl;?>"><img src="images/login_fb.png" width="" height="" alt="facebook connect"></a></li>
						<?php
						}
						?>
						<li><a href="#"><img src="images/icons/facebook.png" width="24" height="24" alt="facebook"></a></li>
						<li><a href="#"><img src="images/icons/twitter.png" width="24" height="24" alt="twitter"></a></li>
                        <li><a href="#"><img src="images/icons/gplus.png" width="24" height="24" alt="gplus"></a></li>
						<?php
						if($userContents['email'] != "")
						{
						/*echo "select * from tbl_members as members 
left join tbl_deal as deals on deals.id = members.deal_id and deals.status= 1
where (members.user_id = $user OR members.user_id = '".$userContents['user_id']."')";*/
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.user_id != $user and  members.status = 0 and deals.type = 'group'");
	$user == '';		
	$GroupDeals = mysql_num_rows($invitations);
	
	$invitations=mysql_query("select * from tbl_members as members 
	inner join tbl_deal deals on deals.deal_id = members.deal_id and deals.status = 1
	where members.user_id=$user and deals.user_id != $user and  members.status = 0 and deals.type = 'float'");
	$user == '';		
	$FloatDeals = mysql_num_rows($invitations);	
	$numbers = ($GroupDeals + $FloatDeals);						
						?>
						<li style="width:190px;"><a style="font-size:12px;"><strong>Welcome</strong>&nbsp;&nbsp;<?php echo $userContents['name'];?></a></li>
						<li><strong><a href="my-account.php" style="color:white;">My Deals</a></strong></li>
						<li><strong><a href="my-products.php" style="color:white;">My Products</a></strong></li>
						
						<li><a href="invitations.php"><span style="text-decoration:blink; color:blue; font-weight:bold; font-size:18px"><?php 
						if($numbers > 0) echo $numbers;?></span>&nbsp;<strong style="color:white;">Invitations</strong></a></li>
						<li><a href="sign-out.php"><strong style="color:white;">Logout</strong></a></li>
						<?php
						}
						else
						{
						?>
						<li class="red_btn"><a href="login.php"><strong style="color:white;">Log in</strong></a></li>

                        <li >-or-</li>
						<li class="grn_btn"><a href="register.php"><strong style="color:white;">Register</strong></a></li>						
						<?php
						}
						?> 
                        
                        <!--<li><strong><a href="refer-to-friends.php">Refer to Friends</a></strong></li>-->
					</ul>
					
                    </div>
				<!--end sixteen-->
                
                <div id="middleHeader">
                <div class="sixteen columns">
					<div id="logo">
						<h1><a href="index.php">logo</a></h1>
					</div><!--end logo-->

					<form action="search.php" method="post" accept-charset="utf-8">
						<label>
							<input type="text" name="search" id="search" placeholder="Search in Product" value="<?php echo $search;?>">
						</label>
						
						<div class="submit">
							<input type="submit" name="Search" value="Search">
						</div>
					</form><!--end form-->

				</div><!--end sixteen-->
                </div>
                
                
			</div><!--end container-->
		</div><!--end topHeader-->


		<div id="mainNavbox">
        <div class="container">
			
            <div class="sixteen columns">
				<div id="mainNav" class="clearfix">
					<nav>
						<ul>
							<li <?php echo $feature;?>><a  href="all-products.php?type=feature">Feature Deals</a></li>
						  <li  <?php echo $all;?>><a class="deals" href="all-products.php?type=all">All Deals</a></li>
					      <li <?php echo $gateways;?>><a class="get" href="gateways.php">Getaways</a></li>
						  <li <?php echo $goods;?>><a class="goods" href="goods.php">Goods</a></li>
						    <li <?php echo $howitwork;?>><a class="work" href="how-it-works.php">How It Works?</a></li>
						  
						</ul>

					</nav><!--end nav-->
					
					
				</div><!--end main-->
			</div><!--end sixteen-->
           
		</div>
        </div><!--end container-->
          <!-- AddThis Button BEGIN -->
          <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=baazi81"></script>
          <!-- AddThis Button END -->        
        
	</header>
