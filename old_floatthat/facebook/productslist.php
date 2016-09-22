
        <?php 
		$page_name=$apppath."index.php?m=productslist";
		
		if(isset($_REQUEST['cat_id']) and $_REQUEST['cat_id']!="")
		{
			$c_id=$_REQUEST['cat_id'];
			$query2=mysql_query("select * from tbl_products where c_id=$c_id");
		}
		else if(isset($_REQUEST['fdeal']))
		{
		$query2=mysql_query("select * from tbl_products where featured=1");	
		}
		else
		{
		$query2=mysql_query("select * from tbl_products");	
		}
		
		
				echo mysql_error();
				$nume=mysql_num_rows($query2);
		
		$start=$_GET['start'];
				if(!isset($start)) {                         // This variable is set to zero for the first page
				$start = 0;
				}
				
				$eu = ($start - 0); 
				$limit = 8;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 
		
	
?>
        
     
               
             
    
    <div class="container sixteen columns">

		<div class="latest">
			
			<div class="box_head">
				<h3>All Deals</h3>
				
			</div><!--end box_head -->

			<div class="cycle-slideshow"> 
				<ul class="product_show">
					
                    <?php 
						$selpro=mysql_query("select * from tbl_products limit $eu, $limit");
						$i=0;
					while($products=mysql_fetch_array($selpro))
						{
						$i++;
					?>
                    
                    <li class="column">
						<div class="img">
							<div class="hover_over">
								<a class="link" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">link</a>
								<a class="cart" href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">cart</a>
							</div>
							<a href="#">
								<img src="wadmin/products/<?php echo $products['c_id'];?>/<?php echo $products['thumb'];?>" style="width:240px; height:145px; border:none" alt="<?php echo $products['title'];?>">
							</a>
						</div>
						<h6><a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top"><?php echo $products['title'];?></a></h6>
                        <p>Do you think that photoshop floral shapes are useful in design work?</p>
						<h5>$<?php echo $products['price'];?></h5>
					</li>
                    	<?php if($i==4){?>
						 <div class="clearfix">&nbsp;</div>
                    		<?php }?>
				  <?php }?>
                
               
                
					
				</ul>
				
			</div>
		</div><!--end latest-->

		<div class="sixteen columns">
			<div class="pagination">
            <!--<a class="text">Page 1 Of 15</a>-->
            <?php        
               if($nume > $limit ){?>
               
             
               <?php // Let us display bottom links if sufficient records are there for paging

						/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
						
						//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
						if($back >=0) { 
						print "<a href='$page_name&start=$back&cat_id=$c_id' target='_top' class='page'> <img src='images/icons/left_white_icon.png' alt='' width='7' height='8'> </a>"; 
						} 
						//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
						
						$i=0;
						$l=1;
						for($i=0;$i < $nume;$i=$i+$limit){
						if($i <> $eu){
						echo " <a href='$page_name&start=$i&cat_id=$c_id' target='_top' class='page'>$l</a> ";
						}
						else { echo "<span class='activePage'>$l</span>";}        /// Current page is not displayed as link and given font color red
						$l=$l+1;
						}
						
						
						
						///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
						if($this1 < $nume) { 
						print "<a href='$page_name&start=$next&cat_id=$c_id' target='_top' class='page'> <img src='images/icons/right_white_icon.png' alt='' width='7' height='8'> </a>";} 
						
						
						}// end of if checking sufficient records are there to display bottom navigational link. 
						?>
				
			</div><!--end pagination-->
		</div><!--end sixteen-->

	</div>