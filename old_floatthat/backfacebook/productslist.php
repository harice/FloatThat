<div class="box_head">
       <div class="box_headtxt">All Deals   </div>
   <div class="clear"></div>
     </div>   
     <div>
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
				$limit = 6;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 
		
		$selpro=mysql_query("select * from tbl_products limit $eu, $limit");
	$i=0;
	while($products=mysql_fetch_array($selpro))
		{
			$i++;
?>
        
        <div class="product_box <?php if($i==3){ $i=0;?>last<?php }?>" style="margin-top:10px;">
         <div class="thumbimg">
         <a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">
         <img src="wadmin/products/<?php echo $products['c_id'];?>/<?php echo $products['thumb'];?>" style="width:240px; height:145px; border:none" alt="product" />
         </a>
         </div>
         <div class="hedtxt">Deal Details 
           <br />
           <?php echo $products['title'];?></div>
         <div class="prodtxt">
         <div class="onlinetxt"></div>
         <div class="grbtn"><a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top">View Detail</a></div>
         <div class="clear"></div>
         </div>
       </div>
        
       
        
        <?php }?>
        
    </div>
     <div class="clear"></div>  
   <div class="pagination">
       
           
             <?php        
               if($nume > $limit ){?>
               
             
               <?php // Let us display bottom links if sufficient records are there for paging

						/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
						
						//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
						if($back >=0) { 
						print "<a href='$page_name&start=$back&cat_id=$c_id' target='_top' class='page'> First </a>"; 
						} 
						//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
						
						$i=0;
						$l=1;
						for($i=0;$i < $nume;$i=$i+$limit){
						if($i <> $eu){
						echo " <a href='$page_name&start=$i&cat_id=$c_id' target='_top' class='page'>$l</a> ";
						}
						else { echo "<span class='page active'>$l</span>";}        /// Current page is not displayed as link and given font color red
						$l=$l+1;
						}
						
						
						
						///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
						if($this1 < $nume) { 
						print "<a href='$page_name&start=$next&cat_id=$c_id' target='_top' class='page'> Last </a>";} 
						
						
						}// end of if checking sufficient records are there to display bottom navigational link. 
						?>
    
    </div>
     <div class="clear"></div>       