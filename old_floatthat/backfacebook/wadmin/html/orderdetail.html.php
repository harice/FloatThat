
<?php 
		$page_name="index.php?module=orderdetail";
		
		$cust_id=$_GET['cust_id'];
			$st=$_GET['status'];
		$query2="select sal.date,sal.cust_id,sal.invoice_no,sal.totalbill,cust.fname,cust.city,cust.mobilephone,cust.email,cust.address from tbl_mastersale sal,tbl_customer cust where sal.status=$st and cust.cust_id=$cust_id and sal.cust_id=cust.cust_id";
				$result2=mysql_query($query2);
				echo mysql_error();
				$nume=mysql_num_rows($result2);
				
				$start=$_GET['start'];
				if(!isset($start)) {                         // This variable is set to zero for the first page
				$start = 0;
				}
				
				$eu = ($start - 0); 
				$limit = 5;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 

		
		?>

		
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">Orders Detail</td><td  align="right" style="padding-right:30px; "></td></tr>
	    </table>

			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
              <tr>
                <td width="14%">&nbsp;</td>
                <td width="41%">&nbsp;</td>
              </tr>
            
			
               <tr bgcolor="#FFFFFF" height="30">
			    <td  class="tdbord" >Name Customer</td>
				<td  class="tdbord"><?php echo $this->paramss['MsgList']['0']['fname'];?></td>
             	<td  class="tdbord" >Mobile No</td>
				<td  class="tdbord"><?php echo $this->paramss['MsgList']['0']['mobilephone'];?></td>
                </tr>
				<tr bgcolor="#efefef" height="30">
				<td  class="tdbord" >Email</td>
				<td  class="tdbord"><?php echo $this->paramss['MsgList']['0']['email'];?></td>
			    <td  class="tdbord" >City</td>
				<td  class="tdbord"><?php echo $this->paramss['MsgList']['0']['city'];?></td>
                
					
                </tr>
				<tr bgcolor="#FFFFFF" height="30">
				
			    <td  class="tdbord" >Address</td>
				<td  class="tdbord" colspan="3"><?php echo $this->paramss['MsgList']['0']['address'];?></td>
                
					
                </tr>
				 <?php  
				 
				  
				  if($this->paramss['MsgList']!="")
				  {
				   foreach ($this->paramss['MsgList'] as $msg)
				  {
				 
				  ?>  
				  <tr bgcolor="#AAADCC">
				<td width="14%"  class="tdbord" style="padding-top:10px; "><h2>Invoice No</h2></td>
				<td width="41%"  class="tdbord" ><?php echo $msg['invoice_no'];?></td>
				   <td width="18%"  class="tdbord">Date</td>
				<td width="27%"  class="tdbord"><?php echo $msg['date'];?></td>
					
				</tr>
				<tr bgcolor="efefef" height="30">
			    <td  class="tdbord" >S.no</td>
				<td  class="tdbord">Product</td>
                <td width="18%"  class="tdbord">Qty</td>
				<td width="27%"  class="tdbord">price</td>
					
                </tr>
				  <?php 
				   $i=0;
				   $sumbill=0;
				  $detail=mysql_query("select ord.*,pro.* from tbl_orderdetail ord,tbl_books pro where ord.invoice_no=$msg[invoice_no] and pro.pro_id=ord.pro_id"); 
				  while($prodata=mysql_fetch_array($detail))
				  {
				   $i++;
				   $sumbill+=$prodata['amount'];
				  ?>  
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				 <td class="tdbord"><?php echo $prodata['pname'];?></td>
				
				 <td class="tdbord"><?php echo $prodata['qty'];?></td>
				  <td class="tdbord"><?php echo $prodata['amount'];?></td>
				 </tr> 
				  <?php
				  }
				  ?>
				  <tr bgcolor="#FFFFFF"><td colspan="3" class="tdbord">Total Bill</td><td class="tdbord"><?php echo number_format($sumbill,2);?></td></tr>
				  <?php
				  $totalbill+=$sumbill;
				   }
				   ?>
				   <tr><td height="20"></td></tr>
				    <tr bgcolor="#efefef"><td colspan="3" class="tdbord">Total Amount</td><td class="tdbord"><?php echo number_format($totalbill,2);?></td></tr>
				
				   <?php
				  }
				  ?>                         	
              <tr>
                <td width="14%">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
              </tr>
			  
			  <tr>
			  	<td colspan="2">
			   <?php        
               if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

						/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
						echo "<table align = 'center' width='30%' ><tr class='para'><td  align='left' width='30%'>";
						//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
						if($back >=0) { 
						print "<a href='$page_name&start=$back&cust_id=$cust_id&status=$st' class='para'> << </a>"; 
						} 
						//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
						echo "</td><td align=center width='100%'>";
						$i=0;
						$l=1;
						for($i=0;$i < $nume;$i=$i+$limit){
						if($i <> $eu){
						echo " <a href='$page_name&start=$i&cust_id=$cust_id&status=$st' class='para'>$l</a> ";
						}
						else { echo "<span class='para'>$l</span>";}        /// Current page is not displayed as link and given font color red
						$l=$l+1;
						}
						
						
						echo "</td><td  align='right' width='20%' class='para'>";
						///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
						if($this1 < $nume) { 
						print "<a href='$page_name&start=$next&cust_id=$cust_id&status=$st' class='para'> >> </a>";} 
						echo "</td></tr></table>";
						
						}// end of if checking sufficient records are there to display bottom navigational link. 
						?>
			  	</td>
			</tr>
			
			   <tr><td colspan="4"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
            </table>
			  