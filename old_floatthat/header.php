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
                
                <div class="four columns">
					<div id="logo">
						<h1><a href="index.php">logo</a></h1>
					</div><!--end logo-->
                </div>
                
				<div class="twelve columns">
                <div id="middleHeader">
					<div>
                    <ul id="topNav">
                    
					<?php
					//echo $userContents['user_id']."sss";
						if(trim($userContents['email']) == "")
						{
						?>
                    	
<li><a href="<?php echo $loginUrl;?>"><img src="images/icons/facebook.png" width="32" height="32" alt="facebook"></a></li>
						<li><a href="login-twitter.php?login&oauth_provider=twitter"><img src="images/icons/twitter.png" width="32" height="32" alt="twitter"></a></li>						
						<li><a href="#"><img src="images/icons/instagram.png" width="32" height="32" alt="instagram"></a></li>
						<?php
						}
						?>
						
<!--                        <li><a href="#"><img src="images/icons/googleplus.png" width="32" height="32" alt="gplus"></a></li>
-->                        
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
						<li style="width:190px;">Welcome&nbsp;&nbsp;<strong><?php echo $userContents['name'];?></strong></li>
						<li><a href="my-account.php">My Deals</a></li>
						<li><a href="my-products.php">My Products</a></li>
						
						<li><a href="invitations.php"><?php 
						if($numbers > 0) echo $numbers;?>&nbsp;Invitations</a></li>
						<li><a href="sign-out.php">Logout</a></li>
						<?php
						}
						else
						{
						?>
						<li><a href="login.php">Log in</a></li>

                        <li >-or-</li>
						<li><a href="register.php">Register</a></li>						
						<?php
						}
						?> 
                        
                        <!--<li><strong><a href="refer-to-friends.php">Refer to Friends</a></strong></li>-->
					</ul>
                    </div><div>
                    <form action="search.php" method="post" accept-charset="utf-8">
						<label>
							<input type="text" name="search" id="search" placeholder="Search in Product" value="<?php echo $search;?>">
						</label>
						
						<div class="submit">
							<input type="submit" name="Search" value="Search">
						</div>
					</form><!--end form-->
					</div>
                    </div>
                    </div>
				<!--end sixteen-->
                
                
                
                
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
