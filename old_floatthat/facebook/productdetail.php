<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/product_detail.css">
    <link rel="stylesheet" href="css/home2.css">
	<link rel="stylesheet" href="css/responsive.css">
<?php 
if(md5($_REQUEST['pro_id'])==$_REQUEST['sc_id'] and $_REQUEST['ms']="paymentssucc")
{
	$pid=$_REQUEST['pro_id'];
	$uid=$_REQUEST['user_id'];
	$date=date('Y-m-d');
mysql_query("insert into tbl_buydeal(user_id,pro_id,date) value('$pid','$uid','$date')");

}

$selpro=mysql_query("select * from tbl_products where pro_id='".$_REQUEST['pro_id']."'");

$product=mysql_fetch_array($selpro);




$seldeal=@mysql_query("select * from tbl_deal where pro_id='".$_REQUEST['pro_id']."' and closestatus=0 and user_id=$user");

$nmdeal=@mysql_num_rows($seldeal);

?>
	<div class="container">
		<div class="sixteen columns">
			
			<div id="pageName">
				<div class="name_tag">
					<p>
					You're Here :: <a href="#">home</a> &raquo; Product Float Page</p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	<div class="container">

		<div class="sixteen columns">
			<div class="ten columns alpha">

				<div class="product_img">
					<ul id="etalage">
                    <?php 
					
					$selproimg=mysql_query("select * from tbl_photos where pro_id='".$_REQUEST['pro_id']."'");

						while($productimg=mysql_fetch_array($selproimg))
							{?>
                                <li>
                                    <a href="../wadmin/gallaryimg/<?php echo $productimg['image'];?>">
                                    <img class="etalage_thumb_image" src="../wadmin/gallaryimg/thumbnails/<?php echo $productimg['image'];?>" alt="<?php echo $productimg['photoname'];?>">
                                    <img class="etalage_source_image" src="../wadmin/gallaryimg/thumbnails/<?php echo $productimg['image'];?>" alt="<?php echo $productimg['photoname'];?>">
                                    </a>
                                </li>
                    		<?php }?>
					
					</ul>
					<div id="hidden"><div id="zoom"></div></div>
				</div><!--end product_img-->
			</div><!--end ten-->


			<div class="six columns omega">
				<div class="product_desc">

					<div class="pro_desc_conent">
						<h6><?php echo $product['title'];?></h6>
					</div>
					<div class="pro_desc_conent">
						<h5>$<?php echo $product['price'];?></h5>
					</div>
					<div class="pro_desc_conent">

						<div class="inputs clearfix">
                        <div class="floatbtn_bg" style="margin-left:45px;"> <?php if($nmdeal==0){?><a href="<?php echo $apppath;?>index.php?m=become_member&pro_id=<?php echo $product['pro_id'];?>" target="_top" class="large_btn">Float Deal</a>
                        <?php }?>
                        </div>
							<ul class="pro_buttons" style="float:left; margin-left:60px;">
                            <?php if($nmdeal==0){?>
								<li><form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frm" target="_blank" >
	<input type="hidden" name="cmd" value="_xclick">
	  <input type="hidden" name="business" value="ferdous23553@yahoo.com">
	 <!-- <input type="hidden" name="business" value="rizwaan@gmail.com">-->
	  <input type="hidden" name="item_name" value="<?php echo $product['title'];?>">
	  <input type="hidden" name="currency_code" value="USD">
	  <input type="hidden" name="amount" value="<?php echo $product['price'];?>">
	
      <input type="hidden" name="return" value="https://apps.facebook.com/floatthat/index.php?m=productdetail&pro_id=<?php echo $product['pro_id'];?>&ms=paymentssucc&user_id=<?php echo $user;?>&sc_id=<?php echo md5($product['pro_id']);?>" id="return"> 
	  <input type="hidden" name="cancel_return" value="https://apps.facebook.com/floatthat/index.php?m=productdetail&pro_id=<?php echo $product['pro_id'];?>&mc=cancel&user_id=<?php echo $user;?>&sc_id=<?php echo md5($product['pro_id']);?>" id="cancel_return">
      <input type="submit" value="Buy Deal" class="grn_btn"/>
	</form></li>
								
                                <?php }?>
                          <li style="margin-top:50px; font-size:18px; color:#060"><a href="<?php echo $apppath;?>index.php?m=become_member&pro_id=<?php echo $product['pro_id'];?>" target="_top" class="grn_btn">Group Deal</a></li>
                              
						<li style="margin-top:10px; font-size:18px; color:#060"><img src="../images/icons/tick_imgg.jpg" />Deal is On</li>
							</ul>

						</div><!--end inputs-->
					</div>

				</div><!--end product_desc-->
			</div><!--end six-->


			<div class="ten columns alpha">
				<div class="product_tabs">

							<div id="pro_info" class="tabContent">

								<h4>Prduct Descriptions</h4>
								<p>
									<?php echo $product['detail'];?>
								</p>
							</div><!--end recent-->


				</div><!--end product_tabs-->
			</div><!--end ten-->


			<div class="six columns omega">
				<div class="make_review">

				<div id="pro_info" class="tabContent">
								<h2>Terms</h2>
								<p>
									<?php echo $product['terms'];?>
								</p>
								
							</div><!--end recent-->

				</div><!--end make_review-->
			</div><!--end six-->


			<div class="related_pro">

				<div class="box_head">
					<h3>Related Products</h3>
					<div class="pagers center">
						<a class="prev related_prev" href="#prev">Prev</a>
						<a class="nxt related_nxt" href="#nxt">Next</a>
					</div>
				</div><!--end box_head -->

				<div class="pro_relates_content">
                 <ul class="product_show">
                
				<?php 
		$i=0;
			$selproqry=mysql_query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id and featured=1 order by Rand() limit 4");
			$num=mysql_num_rows($selproqry);
			while($products=mysql_fetch_array($selproqry))
			{
			$selproimg=mysql_query("select * from tbl_photos where pro_id='".$products['pro_id']."'");
				$productimg=mysql_fetch_array($selproimg);		
				?>
                
                
                
					<li class="column">
						<div class="img">
							<div class="hover_over">
								<a class="link" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">link</a>
								<a class="link" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">cart</a>
							</div>
							<a class="link" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">
								<img src="../wadmin/gallaryimg/thumbnails/<?php echo $productimg['image'];?>" alt="<?php echo $products['title'];?>">
							</a>
						</div>
						<h6><a class="link" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top"><?php echo $products['title'];?></a></h6>
                        
						<h5>$<?php echo $products['price'];?></h5>
					</li>
			        
				
             <?php }?>   
				</ul>
				</div><!--end pro_relates_content-->
			</div><!--end related_pro-->

		</div><!--end sixteen-->

</div><!--end container-->
	<!-- end the main content area --> 
       
        