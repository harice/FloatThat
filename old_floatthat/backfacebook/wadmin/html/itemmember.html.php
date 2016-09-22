
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=userlist";
		
		
		
		
		$st=$_GET['status'];
		$query2="SELECT mem.*,user.* FROM tbl_members mem,user_info user where mem.deal_id=$_REQUEST[deal_id] and user.user_id=mem.user_id and status=1";
				$result2=mysql_query($query2);
				echo mysql_error();
				$nume=mysql_num_rows($result2);
				
				$start=$_GET['start'];
				if(!isset($start)) {                         // This variable is set to zero for the first page
				$start = 0;
				}
				
				$eu = ($start - 0); 
				$limit = 10;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 

		
		?>
			<table  width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
             
            <tr><td align="center" colspan="8">Product Members List</STRONG></FONT></td></tr>
			 
			 <tr><td  class="para" colspan="9" align="center"><?php echo $_GET['errorMsg'];?></td></tr>
               <tr bgcolor="#FFFFFF" height="35">
					<td width="3%"  class="tdbord" >S#</td>
						
					<td width="32%"  class="tdbord">Name</td>
					<td width="18%"  class="tdbord">Email</td>
                    <td width="18%"  class="tdbord">Price Devided</td>
					<td width="11%"  class="tdbord">Join Date</td>
                    <td width="11%"  class="tdbord">Detect Amount</td>
					
              </tr>
				  <?php  
				  $i=$start;
				  if($this->paramss['EmployList']!=""){
					 $totmemebers= count($this->paramss['EmployList']);
					 
					 $selpro=mysql_query("select deal.*,pro.* from tbl_deal deal,tbl_products pro where deal.deal_id=$_REQUEST[deal_id] and pro.pro_id=deal.pro_id");
					 $productprice=mysql_fetch_array($selpro);
					 $partprice=number_format($productprice['price']/$totmemebers,2);
					 
				  
				   foreach ($this->paramss['EmployList'] as $category)
				  	{
				  	$i++;
					
				 
				  ?>  
				 <tr height="26" style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
					 <td class="tdbord"><?php echo $i;?></td>
					
					 <td class="tdbord"><?php echo $category['name'];?></td>
					 <td class="tdbord"><?php echo $category['email'];?></td>
                     <td class="tdbord">$<?php echo $partprice;?></td>
					 <td class="tdbord"><?php echo $category['date'];?></td>
                     
                     <td class="tdbord"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frm" >
	<input type="hidden" name="cmd" value="_xclick">
	  <input type="hidden" name="business" value="ferdous23553@yahoo.com">
	 <!-- <input type="hidden" name="business" value="rizwaan@gmail.com">-->
	  <input type="hidden" name="item_name" value="<?php echo $productprice['title'];?>">
	  <input type="hidden" name="currency_code" value="USD">
	  <input type="hidden" name="amount" value="<?php echo $partprice;?>">
	
      <input type="hidden" name="return" value="http://floatthat.net/facebook/wadmin/index.php?module=itemmember&pro_id=<?php echo $_REQUEST['pro_id'];?>&m=paymentssucc&user_id=<?php echo $category['user_id'];?>" id="return"> 
	  <input type="hidden" name="cancel_return" value="http://floatthat.net/facebook/wadmin/index.php?module=itemmember&pro_id=<?php echo $_REQUEST['pro_id'];?>&m=cancel&user_id=<?php echo $category['user_id'];?>" id="cancel_return">
      <input type="submit" value="Detect Amount" />
	</form>
    
   </td>
					
				 </tr> 
				  <?php 
				  
				  } ?>
				  
				
				  <?php
				  
				  }?>                         	
              <tr>
              
                <td colspan="8" align="center">
				
				 <?php        
               if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

						/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
						echo "<table align = 'center' width='30%' ><tr class='para'><td  align='left' width='30%'>";
						//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
						if($back >=0) { 
						print "<a href='$page_name&start=$back&status=$st&m=$m&y=$y' class='para'> << </a>"; 
						} 
						//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
						echo "</td><td align=center width='100%'>";
						$i=0;
						$l=1;
						for($i=0;$i < $nume;$i=$i+$limit){
						if($i <> $eu){
						echo " <a href='$page_name&start=$i&status=$st&m=$m&y=$y' class='para'>$l</a> ";
						}
						else { echo "<span class='para'>$l</span>";}        /// Current page is not displayed as link and given font color red
						$l=$l+1;
						}
						
						
						echo "</td><td  align='right' width='20%' class='para'>";
						///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
						if($this1 < $nume) { 
						print "<a href='$page_name&start=$next&status=$st&m=$m&y=$y' class='para'> >> </a>";} 
						echo "</td></tr></table>";
						
						}// end of if checking sufficient records are there to display bottom navigational link. 
						?>
				
				</td>
              </tr>
			  <tr><td colspan="8"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
            </table>
			
		 
		
                                