
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
        
		<?php if(isset($_GET['shfrm']) and $_GET['shfrm']=='addnew'){?>
			<form name="frm" action="index.php?module=jobcat" method="post">
			<input type="hidden" name="categ_id" value="<?php echo $_GET['cat_id'];?>">
			<br>
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#efefef" style="border:1px outset;margin-top:10px;"  >
            
           <tr><td colspan="2" align="left" style="padding-left:5px; " class="bheading" >Menues Information</td></tr>
		   </table>
		
			
			<table width="98%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#efefef" style="border:1px outset;margin-top:10px;" >
             
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg'];?></td></tr>
              
               <tr bgcolor="#efefef">
                   <td width="22%"  class="tdbord">Menu Name: </td>
					<td width="78%"  class="tdbord"><input type="text" name="menu" value="<?php echo $this->paramss['Catname']['mainmenu'];?>" class="textBox"></td>
              </tr>
				
				 
				<tr ><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord"><input type="submit" name="Regbtn" value="Save Menu" class="button"></Td></tr>
				<tr>
				  <td class="tdbord"></td>
				  <Td align="left" style="padding-left:10px; " class="tdbord">&nbsp;</Td>
			  </tr>
			  
                                            	
              
            </table>
			</form>
			<?php } else {?>
            
            <table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#efefef" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">Menu List</td><td class="para"></td><td  align="right" style="padding-right:30px; "><a href="index.php?module=jobcat&shfrm=addnew" class="para">Add New Menu</a></td></tr>
	    </table>
			
		<br>
			<table width="98%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#efefef" style="border:1px outset " >
            <tr><td  colspan="8" align="center"><?php echo $this->params['errorMsg'];?></td></tr> 
           <tr><td colspan="8" align="center"><?php echo $this->params['errorMsgDel'];?></td></tr>
            
               <tr bgcolor="#FFFFFF">
			    <td height="25"  class="tdbord" >S#</td>
                <td  class="tdbord">Menu Name</td>
				<td width="15%"  class="tdbord">Sub Menu</td>
				
				<td width="5%"  class="tdbord">Status</td>
				<td width="6%"  class="tdbord">Edit</td>
				
				<td width="6%"  class="tdbord">Delete</td>
					
              </tr>
				  <?php  
				  $i=$start;
				  if($this->paramss['MenueList']!=""){
				   foreach ($this->paramss['MenueList'] as $category)
				  {
				  $i++;
				  $cvdata=mysql_query("SELECT mainmenu FROM tbl_mainmenu where m_id=$category[sub_id]");
				 	$getname=mysql_fetch_array($cvdata);
				  ?>  
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				 <td class="tdbord"><?php echo $category['mainmenu'];?></td>
				 
				
				 <td class="tdbord">&nbsp;  <?php echo $getname['mainmenu'];?></td>
				
				<td class="tdbord"><?php if($category['status']==1){?><a href="index.php?module=jobcat&catac=<?php echo $category['m_id'];?>&st=0&start=<?php echo $start;?>" class="para" onClick="return condc();">Active</a><?php } else {?><a href="index.php?module=jobcat&catac=<?php echo $category['m_id'];?>&st=1&start=<?php echo $start;?>" class="para" onClick="return conac();">Disable</a><?php }?></td>
				 <td ><a href="index.php?module=jobcat&cat_id=<?php echo $category['m_id'];?>&shfrm=addnew" class="tdbord">Edit</a></td>
				 <td ><a href="index.php?module=jobcat&del_id=<?php echo $category['m_id'];?>&start=<?php echo $start;?>" class="tdbord" onClick="return condel();">Delete</a></td>
				 </tr> 
				  <?php
				  }
				 }?>                         	
              <tr>
                <td width="2%">&nbsp;</td>
                <td width="33%">&nbsp;</td>
              </tr>
			  <tr>
			  	<td colspan="8">
				 <?php        
               /*if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

						/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
						echo "<table align = 'center' width='80%' ><tr class='para'><td  align='left' width='30%'>";
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
						
						}// end of if checking sufficient records are there to display bottom navigational link. */
						?>
				</td>
			</tr>
			 <tr><td colspan="6"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
        </table>
			<br><br>
			<?php }?>