<?php
$query = mysql_query("select * from users");
$total_users = mysql_num_rows($query);
?>
<footer>
		<div class="container">
			<div class="three columns">
				<div id="info">
					<h3>Informations</h3>
					<ul>
						<li><a href="about-us.php">About Us</a></li>
						
						<li><a href="privecy-policy.php">Privacy Policy</a></li>
											</ul>
				</div>
			</div><!--end three-->

			<div class="three columns">
				<div id="customer_serices">
					<h3>Customer Services</h3>
					<ul>
						<li><a href="contact-us.php">Contact Us</a></li>
						<li><a href="sitemap.php">Sitemap</a></li>
                        <li><a href="how-it-works.php">How it Works</a></li>
					</ul>
				</div>
			</div><!--end three-->

			<div class="three columns">
				<div id="extra">
					<h3>Extra Stuff</h3>
					<ul>
						<li><a href="terms-and-conditions.php">Terms &amp; Conditions</a></li>
						<li><a href="delivery-informations.php">Delivery Informations</a></li>
					</ul>
				</div>
			</div><!--end three-->

			<div class="three columns">
				<div id="my_account">
					<h3>My Account</h3>
					<ul>
						<?php
						if($userContents['email'] != "")
						{
						?>
						<li><a href="my-account.php">My Orders</a></li>
						<li><a href="sign-out.php">Logout</a></li>						
						<?php
						}
						else
						{
						?>					
						<li><a href="login.php">Login Area</a></li>
						<li><a href="register.php">Register</a></li>
						<?php
						}
						?>
					</ul>
				</div>
			</div><!--end three-->

			<div class="four columns">
				<div id="delivery" class="clearfix">
					<h3>Float Info</h3>
					<ul>
						<li class="f_call">Call Us On: 555-555-555</li>
						<li class="f_call">Call Us On: 666-666-666</li>
						<li class="f_mail">info@floatthat.net</li>
						<li class="f_mail">FloatThat@floatthat.net</li>
						<li style="color:#FFFFFF; font-weight:bold;">Total Site Users: <?php echo $total_users;?></li>

					</ul>
				</div>
			</div><!--end four-->

		</div><!--end container-->

		<div class="container ">
			<div class="sixteen copyright_area">
				<p class="copyright">
					Copyright 2013 for <a href="index.php">floatthat.net</a>
					Powered By: <a href="http://www.esolutions.asia" target="_blank">eSol</a>
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