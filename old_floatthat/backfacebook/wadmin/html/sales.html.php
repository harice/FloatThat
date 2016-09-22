
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=sales";
		
		if(isset($_GET['m']) and isset($_GET['y']))
						{
						$m=$_GET['m'];
						$y=$_GET['y'];
						}
						else
						{
						$y=date('Y');
						$m=date('m');
						}
						
						switch($m)
						{
						
						case 01:
						$mm= "Jan";
						break;
						
						case 02:
						$mm= "Feb";
						break;
						case 03:
						$mm= "Mar";
						break;
						
						case 04:
						$mm= "Apr";
						break;
						
						case 05:
						$mm= "May";
						break;
						
						case 06:
						$mm= "Jun";
						break;
						
						case 07:
						$mm= "Jul";
						break;
						
						case '08':
						$mm= "Aug";
						break;
						
						case '09':
						$mm= "Sep";
						break;
						
						case 10:
						$mm= "Oct";
						break;
						
						case 11:
						$mm= "Nov";
						break;
						
						case 12:
						$mm= "Dec";
						break;
						
						}
						
		
		
		
		
		
		$st=$_GET['status'];
		$query2="SELECT sal.*,cust.fname,cust.lname,cust.city FROM tbl_mastersale sal,tbl_customer cust where sal.status=$st and DATE_FORMAT(sal.date,'%Y%m')=DATE_FORMAT(CURDATE(),'%$y%$m') and cust.cust_id=sal.cust_id";
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
<br>
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading"><?php if($_GET['status']==0){?>Pending <?php } else {?>Mature <?php }?>Sale Report</td><td  align="right" style="padding-right:30px; "></td></tr>
	    </table>
		<br>
		
		<br>
			<table  width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
             
            <tr><td align="center" colspan="8"><FONT face=Verdana size="4"><STRONG><?php echo $mm ." ". $y;?> Sales Report&nbsp;</STRONG></FONT></td></tr>
			 <tr>
				<td align="center" colspan="8">
					<table width="100%" cellpadding="1" cellspacing="2" align="center">
				   
						<tr class="AText">
					   
							<td width="100" ><a href="index.php?module=sales&status=<?php echo $st;?>&m=<?php echo $m;?>&y=<?php echo $y-1;?>" class="tdbord">Previous Year</a></td>
							<td width="23"><a href="index.php?module=sales&status=<?php echo $st;?>&m=01&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Jan'){?><font size="+1" color="#FF0000"><?php }?>Jan</a></td>
							<td width="21"><a href="index.php?module=sales&status=<?php echo $st;?>&m=02&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Feb'){?><font size="+1" color="#FF0000"><?php }?>Feb</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=03&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Mar'){?><font size="+1" color="#FF0000"><?php }?>Mar</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=04&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Apr'){?><font size="+1" color="#FF0000"><?php }?>Apr</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=05&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='May'){?><font size="+1" color="#FF0000"><?php }?>May</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=06&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Jun'){?><font size="+1" color="#FF0000"><?php }?>Jun</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=07&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Jul'){?><font size="+1" color="#FF0000"><?php }?>July</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=08&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Aug'){?><font size="+1" color="#FF0000"><?php }?>Aug</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=09&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Sep'){?><font size="+1" color="#FF0000"><?php }?>Sep</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=10&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Oct'){?><font size="+1" color="#FF0000"><?php }?>Oct</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=11&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Nov'){?><font size="+1" color="#FF0000"><?php }?>Nov</a></td>
							<td width="32"><a href="index.php?module=sales&status=<?php echo $st;?>&m=12&y=<?php echo $y;?>" class="tdbord"><?php if($mm=='Dec'){?><font size="+1" color="#FF0000"><?php }?>Dec</a></td>
							<td width="84"><a href="index.php?module=sales&status=<?php echo $st;?>&m=<?php echo $m;?>&y=<?php echo $y+1;?>" class="tdbord">Next Year</a></td>
						   
						</tr>
						<tr><td colspan="14" height="12"></td></tr>
					</table>
				</td>
			</tr>
			
			 <tr><td  class="para" colspan="9" align="center"><?php echo $_GET['errorMsg'];?></td></tr>
               <tr bgcolor="#FFFFFF" height="35">
					<td width="3%"  class="tdbord" >Sno</td>
					<td width="9%"  class="tdbord">Date</td>
					<td width="11%"  class="tdbord">Invoice No</td>
					<td width="32%"  class="tdbord">Name</td>
					<td width="18%"  class="tdbord">City</td>
					<td width="11%"  class="tdbord">Amount</td>
					<?php if($_SESSION['delrec']==1){?><td width="11%"  class="tdbord">Status</td><?php }?>
					<?php if($_SESSION['delrec']==1){?><td width="5%"  class="tdbord">Delete</td><?php }?>
              </tr>
				  <?php  
				  $i=$start;
				  if($this->paramss['EmployList']!=""){
				  
				   foreach ($this->paramss['EmployList'] as $category)
				  {
				  $i++;
				 
				  ?>  
				 <tr height="26" style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
					 <td class="tdbord"><?php echo $i;?></td>
					 <td class="tdbord"><?php echo date('Y-m-d',strtotime($category['date']));?></td>
					 <td class="tdbord"><a href="index.php?module=invoicedetail&invoice_no=<?php echo $category['invoice_no'];?>"><?php echo $category['invoice_no'];?></a></td>
					 <td class="tdbord"><?php echo $category['fname']." ".$category['lname'];?></td>
					 <td class="tdbord"><?php echo $category['city'];?></td>
					 <td class="tdbord"><?php echo $category['totalbill'];?></td>
					<?php if($_SESSION['editrec']==1){?> <td class="tdbord"><?php if($category['status']==1){?><a href="index.php?module=sales&ainvoice_no=<?php echo $category['invoice_no'];?>&status=0&start=<?php echo $start;?>&m=<?php echo $m;?>&y=<?php echo $y;?>" class="para" onClick="return condc();">Mature</a><?php } else {?><a href="index.php?module=sales&ainvoice_no=<?php echo $category['invoice_no'];?>&status=1&start=<?php echo $start;?>&m=<?php echo $m;?>&y=<?php echo $y;?>" class="para" onClick="return conac();">Pending</a><?php }?></td><?php }?>
					
					 <?php if($_SESSION['delrec']==1){?><td ><a href="index.php?module=sales&invoice_no=<?php echo $category['invoice_no'];?>&status=0&start=<?php echo $start;?>&m=<?php echo $m;?>&y=<?php echo $y;?>" class="tdbord" onClick="return condel();">Delete</a></td><?php }?>
					
				 </tr> 
				  <?php 
				  $totalamount+=$category['totalbill'];
				  
				  } ?>
				  
				  <tr bgcolor="#FFFFFF"><td colspan="5"  style="padding-top:10px; padding-right:10px; " align="right" class="tdtext"><h2>Total Amount</h2></td><td class="tdbord"><?php echo number_format($totalamount,2);?></td><td colspan="2"></td></tr>
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
			
		 
		
                                