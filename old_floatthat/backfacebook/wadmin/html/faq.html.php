
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=news";
		
		
		$query2="SELECT * FROM tbl_faq";
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

		
		<?php if(isset($_GET['shfrm']) and $_GET['shfrm']=='addnew'){?>
			<form name="frm" action="index.php?module=faq" method="post">
			<input type="hidden" name="FAQ_id" value="<?php echo $_GET['faq_id'];?>">
			<br>
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;"  >
            
           <tr><td colspan="2" align="left" style="padding-left:5px; " class="bheading" >FAQ information</td></tr>
		   </table>
		
			
			<table width="98%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
             
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg'];?></td></tr>
              <?php /*?>
			   <tr>
                 <td  class="tdbord">Job Ref #: </td>
                 <td  class="tdbord"><?php echo "UK-".date('mdys').rand(1,9);?></td>
               </tr><?php */?>
               <tr bgcolor="#efefef">
                   <td  class="tdbord">Question: </td>
					<td  class="tdbord"><input type="text" name="question" value="<?php echo $this->paramss['FAQ']['question'];?>" class="textBox"></td>
              </tr>
				<tr>
                   <td  class="tdbord">Answer: </td>
					<td  class="tdbord"><textarea id="detail" name="answer" cols="60" rows="4" style="border:1px solid #fff; background-color:#DFDFDF; color:#000; font-size:14px;"><?php echo $this->paramss['FAQ']['answers'];?></textarea></td>
                </tr>
				 <tr bgcolor="#efefef">
                   <td  class="tdbord">Status: </td>
					<td  class="tdbord"><input type="checkbox" name="status" <?php if($this->paramss['FAQ']['status']==1){?> checked <?php } ?>  class="textBox"></td>
              </tr>
				<tr ><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord"><input type="submit" name="Regbtn" value="Save FAQ" class="button"></Td></tr>
				<tr>
				  <td class="tdbord"></td>
				  <Td align="left" style="padding-left:10px; " class="tdbord">&nbsp;</Td>
			  </tr>
			      
            </table>
			</form>
			<?php } else {?>
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">FAQ List</td><td  align="right" style="padding-right:30px; "><?php if($_SESSION['editrec']==1){?><a href="index.php?module=faq&shfrm=addnew" class="para">Add Faq</a><?php }?></td></tr>
	    </table>
		<br>
			<table width="98%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#DFDFDF" style="border:1px outset " >
            <tr><td  colspan="8" align="center"><?php echo $this->params['errorMsg'];?></td></tr> 
           <tr><td colspan="8" align="center"><?php echo $this->params['errorMsgDel'];?></td></tr>
            
               <tr bgcolor="#FFFFFF">
			    <td height="25"  class="tdbord" >S.No</td>
                <td  class="tdbord">Question</td>
				<td width="30%"  class="tdbord">Answer</td>
				
				<?php if($_SESSION['editrec']==1){?><td width="5%"  class="tdbord">Status</td><?php }?>
				<?php if($_SESSION['editrec']==1){?><td width="5%"  class="tdbord">Edit</td><?php }?>
				
				<?php if($_SESSION['delrec']==1){?><td width="5%"  class="tdbord">Delete</td><?php }?>
					
              </tr>
				  <?php  
				  $i=$start;
				  if($this->paramss['FaqList']!=""){
				   foreach ($this->paramss['FaqList'] as $newslist)
				  {
				  $i++;
				  
				  ?>  
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				 <td class="tdbord"><?php echo $newslist['question'];?></td>
				 <td class="tdbord"><?php echo $newslist['answers'];?></td>
				
				<?php if($_SESSION['editrec']==1){?> <td class="tdbord"><?php if($newslist['status']==1){?><a href="index.php?module=faq&faqac=<?php echo $newslist['fq_id'];?>&st=0&start=<?php echo $start;?>" class="para" onClick="return condc();">Active</a><?php } else {?><a href="index.php?module=faq&faqac=<?php echo $newslist['fq_id'];?>&st=1&start=<?php echo $start;?>" class="para" onClick="return conac();">Disable</a><?php }?></td><?php }?>
				<?php if($_SESSION['editrec']==1){?> <td ><a href="index.php?module=faq&faq_id=<?php echo $newslist['fq_id'];?>&shfrm=addnew" class="tdbord">Edit</a></td><?php }?>
				<?php if($_SESSION['delrec']==1){?> <td ><a href="index.php?module=faq&del_id=<?php echo $newslist['fq_id'];?>&start=<?php echo $start;?>" class="tdbord" onClick="return condel();">Delete</a></td><?php }?>
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