
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=searchlist";
		
			if(isset($_POST['textfield']))
			{
			$urlnameref=$_POST['textfield'];
			}
			else
			{
			$urlnameref=$_GET['textfield'];
			}
		
			$query2="SELECT cust.* FROM tbl_customer cust where (fname like '%$urlnameref%' or lname like '%$urlnameref%') order by cust.date DESC";
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
            
           <tr><td class="bheading">Search Result Of Customer</td><td  align="right" style="padding-right:30px; "></td></tr>
	    </table>
		<br>
		
		<br>
			<table  width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
             
             <tr><td  class="para" colspan="9" align="center"><?php echo $_GET['errorMsg'];?></td></tr>
               <tr bgcolor="#FFFFFF" height="35">
			    <td width="5%"  class="tdbord" >Sno</td>
                <td width="36%"  class="tdbord">Name</td>
				<td width="19%"  class="tdbord">City</td>
				<td width="12%"  class="tdbord">pending orders</td>
				<td width="11%"  class="tdbord">orders done</td>
				<?php if($_SESSION['editrec']==1){?><td width="8%"  class="tdbord">Status</td><?php }?>
				<?php if($_SESSION['editrec']==1){?><td width="4%"  class="tdbord">Edit</td><?php }?>
				<?php if($_SESSION['delrec']==1){?><td width="5%"  class="tdbord">Delete</td><?php }?>
              </tr>
				  <?php  
				  $i=$start;
				  if($this->paramss['EmployList']!=""){
				  
				   foreach ($this->paramss['EmployList'] as $category)
				  {
				  $i++;
				  $saledata=mysql_query("SELECT sal.* FROM tbl_mastersale sal where sal.cust_id=$category[cust_id] and sal.status='0' order by sal.cust_id");
				  $gettot=mysql_num_rows($saledata);
				  
				  $saledata2=mysql_query("SELECT sal.* FROM tbl_mastersale sal where sal.cust_id=$category[cust_id] and sal.status='1' order by sal.cust_id");
				  $gettot2=mysql_num_rows($saledata2);
				  ?>  
				 <tr height="26" style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				 <td class="tdbord"><a href="index.php?module=customerdetail&cust_id=<?php echo $category['cust_id'];?>" class="para"><?php echo $category['fname']." ".$category['lname'];?></a></td>
				 
				
				 <td class="tdbord"><?php echo $category['city'];?></td>
				
				  <td class="tdbord">
				 <a href="index.php?module=orderdetail&cust_id=<?php echo $category['cust_id'];?>&status=0" class="tdbord"><?php echo $gettot;?></a>
				  </td>
				  <td class="tdbord">
				 <a href="index.php?module=orderdetail&cust_id=<?php echo $category['cust_id'];?>&status=1" class="tdbord"><?php echo $gettot2;?></a>
				  </td>
				 <?php if($_SESSION['editrec']==1){?><td class="tdbord"><?php if($category['astatus']==1){?><a href="index.php?module=searchlist&Acust_id=<?php echo $category['cust_id'];?>&st=0&start=<?php echo $start;?>" class="para" onClick="return condc();">Active</a><?php } else {?><a href="index.php?module=customerlist&Acust_id=<?php echo $category['cust_id'];?>&st=1&start=<?php echo $start;?>" class="para" onClick="return conac();">Disable</a><?php }?></td><?php }?>
				
				 <?php if($_SESSION['editrec']==1){?><td ><a href="index.php?module=editcustomer&cust_id=<?php echo $category['cust_id'];?>&shfrm=addnew&mod=customerlist" class="tdbord">Edit</a></td><?php }?>
				
				 <?php if($_SESSION['delrec']==1){?><td ><a href="index.php?module=customerlist&cust_id=<?php echo $category['cust_id'];?>&start=<?php echo $start;?>" class="tdbord" onClick="return condel();">Delete</a></td><?php }?>
				
				 </tr> 
				  <?php }
				  
				  }?>                         	
              <tr>
              
                <td colspan="8" align="center">
				
				 <?php        
               if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

						/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
						echo "<table align = 'center' width='30%' ><tr class='para'><td  align='left' width='30%'>";
						//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
						if($back >=0) { 
						print "<a href='$page_name&start=$back&textfield=$urlnameref' class='para'> << </a>"; 
						} 
						//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
						echo "</td><td align=center width='100%'>";
						$i=0;
						$l=1;
						for($i=0;$i < $nume;$i=$i+$limit){
						if($i <> $eu){
						echo " <a href='$page_name&start=$i&textfield=$urlnameref' class='para'>$l</a> ";
						}
						else { echo "<span class='para'>$l</span>";}        /// Current page is not displayed as link and given font color red
						$l=$l+1;
						}
						
						
						echo "</td><td  align='right' width='20%' class='para'>";
						///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
						if($this1 < $nume) { 
						print "<a href='$page_name&start=$next&textfield=$urlnameref' class='para'> >> </a>";} 
						echo "</td></tr></table>";
						
						}// end of if checking sufficient records are there to display bottom navigational link. 
						?>
				
				</td>
              </tr>
			  <tr><td colspan="8"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
            </table>
			
		 
		
                                