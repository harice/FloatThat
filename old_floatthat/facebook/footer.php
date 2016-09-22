<?php /*?>
<div class="footer">
       <div class="leftfot"> 
            
            <?php $catqry=mysql_query("select * from tbl_category");
			while($cat=mysql_fetch_array($catqry))
			{
		?>
    	<a href="<?php echo $apppath;?>index.php?m=productslist&cat_id=<?php echo $cat['c_id'];?>" target="_top"><?php echo $cat['title'];?></a> |
        <?php }?>
        
               
       </div>
       <div class="ri8fot">                          
          <?php $catqry=mysql_query("select * from tbl_mainmenu");
			while($cat=mysql_fetch_array($catqry))
			{
		?>
    	<a href="<?php echo $apppath;?>index.php?m=contents&m_id=<?php echo $cat['m_id'];?>" target="_top"><?php echo $cat['mainmenu'];?></a> |
        <?php }?>     
       </div>
        <div class="clear"></div>       
  </div>
    <div class="">
           <div class="leftfot"> 
  © 2013  Float that - Developed By <a href="http://www.esolpakistan.com" target="_blank" >ESol Pakistan</a>
           </div>
           <div class="ri8fot">                          
           <img src="images/shate_btns.jpg" width="166" height="22" alt="btns" /></div>
     <div class="clear"></div>       
    </div>
    
    


<?php */?>

<footer>
		<div class="container">
			<div class="three columns">
				<div id="info">
					<h3>Informations</h3>
					<ul>
						<li><a href="#">About Us</a></li>
						
						
						<li><a href="#">Terms &amp; Conditions</a></li>
					</ul>
				</div>
			</div><!--end three-->

			<div class="three columns">
				<div id="customer_serices">
					<h3>Customer Servies</h3>
					<ul>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">privecy Policy</a></li>
						
					</ul>
				</div>
			</div><!--end three-->

			<div class="three columns">
				<div id="extra">
					<h3>Extra Stuff</h3>
					<ul>
						<li><a href="#">All Deals</a></li>
						<li><a href="#">Featured Deals</a></li>
						
					</ul>
				</div>
			</div><!--end three-->

			<div class="three columns">
				<div id="my_account">
					<h3>My Account</h3>
					<ul>
					
						<li><a class="get" href="<?php echo $apppath;?>index.php?m=mydeals&mdeal=1" target="_top">My Deals</a></li>
						<li><a class="goods" href="<?php echo $apppath;?>index.php?m=invitations&minvi=1" target="_top"><span style="text-decoration:blink; color:#F00; font-weight:bold; font-size:14px"><?php echo $numbers;?></span>Invitations</a></li>
						
					</ul>
				</div>
			</div><!--end three-->

			<div class="four columns">
				<div id="delivery" class="clearfix">
					<h3>Float Info</h3>
					<ul>
						<li class="f_call">Call Us On: 555-555-555</li>
						<li class="f_call">Call Us On: 666-666-666</li>
						<li class="f_mail">example@example.com</li>
						<li class="f_mail">FloatThat@floatthat.net</li>
					</ul>
				</div>
			</div><!--end four-->

		</div><!--end container-->

		<div class="container ">
			<div class="sixteen copyright_area">
				<p class="copyright">
					Copyright 2013 for <a href="#">floatthat.net</a>
					Powered By: <a href="http://www.esolutions.asia" target="_blank">eSolutions</a>
				</p>
				<ul class="socials">
					<li><a class="twitter" href="#">twitter</a></li>
					<li><a class="facebook" href="#">face</a></li>
					<li><a class="googlep" href="#">google+</a></li>
					<li><a class="vimeo" href="#">vimeo</a></li>
					<li><a class="skype" href="#">skype</a></li>
					<li><a class="linked" href="#">linked</a></li>
				</ul>
			</div><!--end sixteen-->
		</div><!--end container-->

	</footer>
    
    
    <!-- JS
	================================================== -->
  
<!-- End Document
================================================== -->