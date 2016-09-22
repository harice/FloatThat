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
						
					$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
					$statuss      	= $shortmsg;
					$statuss       = htmlentities($statuss, ENT_QUOTES);
					
      				$statusUpdate = $facebook->api("/$user_id/feed", 'post', array('picture'=> "$imgs",'link' => 'https://apps.facebook.com/floatthat','caption' => "visit here ",'name' => "$myname[name]", 'description' => $statuss, 'cb' => "$statuss"));
							
							$totmem=count($users_id)+1;
							
							for($i=0;$i<count($users_id);$i++)
							{
					
					//$win=$winner;
					$fuser=$_REQUEST['users_id'][$i];
					
					
					
					$shortmsg="started a deal Total Cost is ".$cstp." Total Memberrs ".$totmem." and you have to pay $".$expectedprice." last date for float $fdate";
						
					$imgs="http://www.floatthat.net/wadmin/products/".$productdetail['c_id']."/".$productdetail['thumb'];
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
      <!--  <div class="banner">
       <div class="banimg"><img src="images/tell-friend.jpg" style="width:323px; height:226px;"  alt="banner img" /></div>
       <div class="bantxt">
         <div class="mainhead" align="left">Float your friends at</div>  
		 <div class="greentxt" align="left">An Online Deal</div>
         <div class="normtxt" align="left">FloatThat lets you put your contacts to good use; to help you pay for deals.Members can select an item / deal, Float it to their contacts and split the cost over the number of participants. When the Float period ends, one of the participants will receive the item that everyone else contributed to. A $50 item / Deal Floated to twenty-five friends ($2/ friend) will allow one of the friends to receive the Deal for $2. 
FloatThat will allow each participant to get points, for assigned tasks, to apply towards their individual contribution.
 </div>-->
		<div class="container sixteen columns">

		
		<div class="featured">
			<div class="box_head">
				<h3>Featured Deals</h3>
				<div class="pagers center">
					<a class="prev featuredPrev" href="#prev">Prev</a>
					<a class="nxt featuredNxt" href="#nxt">Next</a>
				</div>
			</div><!--end box_head -->
		

			<div class="cycle-slideshow" 
	        data-cycle-fx="scrollHorz"
	        data-cycle-timeout=0
	        data-cycle-slides="> ul"
	        data-cycle-prev="div.pagers a.featuredPrev"
	        data-cycle-next="div.pagers a.featuredNxt"
	        >
				<?php 
		$i=0;
			$selproqry=mysql_query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id and featured=1 order by Rand()");
			$num=mysql_num_rows($selproqry);
			while($products=mysql_fetch_array($selproqry))
			{
			$selproimg=mysql_query("select * from tbl_photos where pro_id='".$products['pro_id']."'");
			$productimg=mysql_fetch_array($selproimg);	
				if($i==0){
				?>
                
                <ul class="product_show">
                
                <?php }?>
                
                
					<li class="column">
						<div class="img">
							<div class="hover_over">
								<a class="link" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">link</a>
								<a class="cart" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">cart</a>
							</div>
							<a href="#">
								<img src="../wadmin/gallaryimg/thumbnails/<?php echo $productimg['image'];?>" alt="<?php echo $products['title'];?>">
							</a>
						</div>
						<h6><a href="#"><?php echo $products['title'];?></a></h6>
                        
						<h5>$<?php echo $products['price'];?></h5>
					</li>
			        
				<?php $i++;
				
				if($i==4){ $i=0;?>
                
                </ul>
            	<?php }?>
            
             <?php }?>   
                
				
			</div>
		</div><!--end featured-->


		<div class="latest">
			
			<div class="box_head">
				<h3>All Deals</h3>
				<div class="pagers center">
					<a class="prev latest_prev" href="#prev">Prev</a>
					<a class="nxt latest_nxt" href="#nxt">Next</a>
				</div>
			</div><!--end box_head -->

			<div class="cycle-slideshow" 
	        data-cycle-fx="scrollHorz"
	        data-cycle-timeout=0
	        data-cycle-slides="> ul"
	        data-cycle-prev="div.pagers a.latest_prev"
	        data-cycle-next="div.pagers a.latest_nxt"
	        >

				<?php 
		$i=0;
			$selproqry=mysql_query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id order by Rand()");
			$num=mysql_num_rows($selproqry);
			while($products=mysql_fetch_array($selproqry))
			{
				$selproimg=mysql_query("select * from tbl_photos where pro_id='".$products['pro_id']."'");
				$productimg=mysql_fetch_array($selproimg);	
				
				if($i==0){
				?>
                
                <ul class="product_show">
                
                <?php }?>
                
                
					<li class="column">
						<div class="img">
							<div class="hover_over">
								<a class="link" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">link</a>
								<a class="cart" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">cart</a>
							</div>
							<a href="#">
								<img src="../wadmin/gallaryimg/thumbnails/<?php echo $productimg['image'];?>" alt="<?php echo $products['title'];?>">
							</a>
						</div>
						<h6><a href="#"><?php echo $products['title'];?></a></h6>
                        
						<h5>$<?php echo $products['price'];?></h5>
					</li>
			        
				<?php $i++;
				
				if($i==4){ $i=0;?>
                
                </ul>
            	<?php }?>
            
             <?php }?>   
				
			</div>
		</div><!--end latest-->
		


		<div class="sixteen columns clearfix">
			<div class="ten columns alpha">
				<div class="welcome">
					<div class="clearfix">
						<h2>Welcome To Float That</h2>
						<p>
							FloatThat is your source for millions of products from the leading automotive aftermarket brands. We carry all part numbers for every product we sell - if they make it, we have it. We get the newest part numbers faster, so you can get them on your vehicle sooner, so you can get them on your vehicle sooner.
						</p>
						<p>
							World-Class, US-Based Customer Service and Product Support is just a toll-free phone call away. Product Knowledge at Your Fingertips - Impartial Customer Reviews, Videos, Research Guides, Articles and More.
						</p>
						<h4>Our payment methods:</h4>
						<ul>
							<li><img src="images/cc.gif" /></li>
							
						</ul>
					</div>
				</div><!--end welcome-->
			</div><!--end ten-->

			<div class="six columns omega">
				<div class="home_news">
					<h3>Now, Get Your Free Shopping</h3>
					<div class="acc">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi malesuada, ante at feugiat tincidunt, enim massa gravida metus, commodo lacinia massa diam vel eros. Proin eget urna. Nunc fringilla neque vitae odio. Vivamus vitae ligula.</p>
					</div>
				
					

					<h3>Super easy to customize anything</h3>
					<div class="acc">
						<p>
							Morbi cursus urna at massa dictum ac venenatis lectus accumsan. Etiam vitae arcu ac ante elementum mollis. Nunc convallis tristique aliquet. Ut justo leo.
						</p>
						
					</div>

					<!--<h3>Signup and save your money</h3>
					<div class="acc">
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi malesuada, ante at feugiat tincidunt, enim massa gravida metus, commodo lacinia massa diam vel eros. Proin eget urna. Nunc fringilla neque vitae odio. Vivamus vitae ligula.
						</p>
					</div>-->
				</div><!--end home_news-->
			</div><!--end six-->
		</div><!--end sixteen-->


		<div class="sixteen columns">
			<div class="brands">

				<div class="box_head">
					<h3>Categories</h3>
					<div class="pagers center">
						<a class="prev brand_prev" href="#prev">Prev</a>
						<a class="nxt brand_nxt" href="#nxt">Next</a>
					</div>
				</div><!--end box_head -->

				<div class="brandOuter">
					<ul>
						<li>
							<a href="#">
								<img src="images/brands/logo_adidas-130x130.jpg" alt="brand">
							</a></li>
						<li>
							<a href="#">
								<img src="images/brands/logo_asics-130x130.jpg" alt="brand">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="images/brands/logo_conv-130x130.jpg" alt="brand">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="images/brands/logo_nike-130x130.jpg" alt="brand">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="images/brands/logo_puma-130x130.jpg" alt="brand">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="images/brands/logo_rbk-130x130.jpg" alt="brand">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="images/brands/logo_nike-130x130.jpg" alt="brand">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="images/brands/logo_asics-130x130.jpg" alt="brand">
							</a>
						</li>
					</ul>
				</div>
			</div><!--end brands-->
		</div><!--end sixteen-->

	</div>