
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=news";
		
		
		$query2="SELECT * FROM tbl_news";
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
<script type="text/javascript" src="openwysiwyg/scripts/wysiwyg.js"></script>
		<script type="text/javascript" src="openwysiwyg/scripts/wysiwyg-settings.js"></script>
		
		<?php if(isset($_GET['shfrm']) and $_GET['shfrm']=='addnew'){?>
			<form name="frm" action="index.php?module=news" method="post">
			<input type="hidden" name="categ_id" value="<?php echo $_GET['new_id'];?>">
			<br>
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;"  >
            
           <tr><td colspan="2" align="left" style="padding-left:5px; " class="bheading" >News & Events information</td></tr>
		   </table>
		
			
			<table width="98%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
             
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg'];?></td></tr>
              <?php /*?>
			   <tr>
                 <td  class="tdbord">Job Ref #: </td>
                 <td  class="tdbord"><?php echo "UK-".date('mdys').rand(1,9);?></td>
               </tr><?php */?>
               <tr bgcolor="#efefef">
                   <td  class="tdbord">Heading: </td>
					<td  class="tdbord"><input type="text" name="heading" value="<?php echo $this->paramss['News']['heading'];?>" class="textBox"></td>
              </tr>
				<tr>
                   <td  class="tdbord">Detail: </td>
					<td  class="tdbord">
                     <script language="javascript">
							WYSIWYG.attach('detail1', full);
							</script>
                    
                    <textarea id="detail1" name="detail" cols="60" rows="4" style="border:1px solid #fff; background-color:#DFDFDF; color:#000; font-size:14px;"><?php echo $this->paramss['News']['detail'];?></textarea></td>
                </tr>
				 <tr bgcolor="#efefef">
                   <td  class="tdbord">Status: </td>
					<td  class="tdbord"><input type="checkbox" name="status" <?php if($this->paramss['News']['status']==1){?> checked <?php } ?>  class="textBox"></td>
              </tr>
				<tr ><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord"><input type="submit" name="Regbtn" value="Save News" class="button"></Td></tr>
				<tr>
				  <td class="tdbord"></td>
				  <Td align="left" style="padding-left:10px; " class="tdbord">&nbsp;</Td>
			  </tr>
			      
            </table>
			</form>
			<?php } else {?>
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">News & Event List</td><td  align="right" style="padding-right:30px; "><a href="index.php?module=news&shfrm=addnew" class="para">Add News or Events</a></td></tr>
	    </table>
		<br>
			<table width="98%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#DFDFDF" style="border:1px outset " >
            <tr><td  colspan="8" align="center"><?php echo $this->params['errorMsg'];?></td></tr> 
           <tr><td colspan="8" align="center"><?php echo $this->params['errorMsgDel'];?></td></tr>
            
               <tr bgcolor="#FFFFFF">
			    <td height="25"  class="tdbord" >S.No</td>
                <td  class="tdbord">Heading</td>
				<td width="30%"  class="tdbord">Detail</td>
				
				<td width="5%"  class="tdbord">Status</td>
				<td width="5%"  class="tdbord">Edit</td>
				
				<td width="5%"  class="tdbord">Delete</td>
					
              </tr>
				  <?php  
				  $i=$start;
				  if($this->paramss['NewsList']!=""){
				   foreach ($this->paramss['NewsList'] as $newslist)
				  {
				  $i++;
				  
				  ?>  
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				 <td class="tdbord"><a href="index.php?module=newdetail&new_id=<?php echo $newslist['news_id'];?>" class="para"><?php echo $newslist['heading'];?></a></td>
				 <td class="tdbord"><?php echo $newslist['detail'];?></td>
				
				 <td class="tdbord"><?php if($newslist['status']==1){?><a href="index.php?module=news&newac=<?php echo $newslist['news_id'];?>&st=0&start=<?php echo $start;?>" class="para" onClick="return condc();">Active</a><?php } else {?><a href="index.php?module=news&newac=<?php echo $newslist['news_id'];?>&st=1&start=<?php echo $start;?>" class="para" onClick="return conac();">Disable</a><?php }?></td>
				 <td ><a href="index.php?module=news&new_id=<?php echo $newslist['news_id'];?>&shfrm=addnew" class="tdbord">Edit</a></td>
				 <td ><a href="index.php?module=news&del_id=<?php echo $newslist['news_id'];?>&start=<?php echo $start;?>" class="tdbord" onClick="return condel();">Delete</a></td>
				 </tr> 
				  <?php }
				  }
				  ?>                         	
              <tr>
                <td width="5%">&nbsp;</td>
                <td width="20%">&nbsp;</td>
              </tr>
			  <tr>
			  	<td colspan="8">
				 <?php        
               if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

						/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
						echo "<table align = 'center' width='30%' ><tr class='para'><td  align='left' width='30%'>";
						//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
						if($back >=0) { 
						print "<a href='$page_name&start=$back' class='para'> << </a>"; 
						} 
						//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
						echo "</td><td align=center width='100%'>";
						$i=0;
						$l=1;
						for($i=0;$i < $nume;$i=$i+$limit){
						if($i <> $eu){
						echo " <a href='$page_name&start=$i' class='para'>$l</a> ";
						}
						else { echo "<span class='para'>$l</span>";}        /// Current page is not displayed as link and given font color red
						$l=$l+1;
						}
						
						
						echo "</td><td  align='right' width='20%' class='para'>";
						///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
						if($this1 < $nume) { 
						print "<a href='$page_name&start=$next' class='para'> >> </a>";} 
						echo "</td></tr></table>";
						
						}// end of if checking sufficient records are there to display bottom navigational link. 
						?>
				</td>
			</tr>
			 <tr><td colspan="6"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
        </table>
			<br><br>
			<?php }?>