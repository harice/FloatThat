
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=userlist";
		
		
		
		
		$st=$_GET['status'];
		$query2="select deal.*,pro.*,user.* from tbl_deal deal,tbl_products pro,user_info user where pro.pro_id=deal.pro_id and deal.status=1 and user.user_id=deal.user_id";
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
						
					<td width="32%"  class="tdbord">Created By</td>
					<td width="18%"  class="tdbord">Product Name</td>
                    <td width="18%"  class="tdbord">Price</td>
                    <td width="18%"  class="tdbord">Memebrs</td>
					<td width="11%"  class="tdbord">Created Date</td>
                    <td width="11%"  class="tdbord">Closing Date</td>
                   
					
              </tr>
				  <?php  
				  $i=$start;
				  if($this->paramss['EmployList']!=""){
					
				  
				   foreach ($this->paramss['EmployList'] as $category)
				  	{
				  	$i++;
					
				  $selpro=mysql_query("select * from tbl_members where deal_id=$category[deal_id] and status=1");
						 $numrows=mysql_num_rows($selpro);
				  ?>  
				 <tr height="26" style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
					 <td class="tdbord"><?php echo $i;?></td>
					
					 <td class="tdbord"><?php echo $category['name'];?></td>
					 <td class="tdbord"><?php echo $category['title'];?></td>
                     <td class="tdbord">$<?php echo $category['price'];?></td>
                      <td class="tdbord"><a href="index.php?module=itemmember&deal_id=<?php echo $category['deal_id'];?>"><?php echo $numrows;?></a></td>
					 <td class="tdbord"><?php echo $category['date'];?></td>
                     
                     <td class="tdbord"><?php echo $category['closedate'];?></td>
                     
					
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
			
		 
		
                                