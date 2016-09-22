
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
        
		<?php if(isset($_GET['shfrm']) and $_GET['shfrm']=='addnew'){?>
			 <form name="frm" action="index.php?module=category&p=3" method="post">
			<input type="hidden" name="categ_id" value="<?php echo $_GET['cat_id'];?>">
         <table width="98%"  border="0" cellspacing="4" cellpadding="4" style="border:1px outset #00ff00; margin:10px 10px 10px 10px" >         
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg'];?></td></tr>
              
              
           
               <tr bgcolor="#F5FBEA">
                   <td  class="tdbord">Title: <span class="mond">*</span></td>
					<td  class="tdbord"><input type="text" name="catname" value="<?php echo $this->paramss['Catname']['title'];?>" class="textBox" style="background:#efefef; height:30px; width:250px;"></td>
              </tr>
				
             
				<tr ><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord_left"><input type="submit" name="Regbtn" value="Save Category" class="btn" onClick="return checkcategory();"></Td></tr>
				<tr>
				  <td class="tdbord_left"></td>
				  <Td align="left" style="padding-left:10px; " class="tdbord_left">&nbsp;</Td>
			  </tr>
			   <tr bgcolor="#F5FBEA"><td colspan="2" align="right" style="padding:15px 10px 15px 0px "><input type="button" onclick="window.location.href='javascript:history.go(-1)'" class="btn" value="&laquo; Go Back" title="Go at previous page">
              </td></tr> 
                                            	
              
            </table>
			</form>
			<?php } else {?>
            
             <form name="sfrm" action="" method="post">
         <table width="98%"  border="0" cellspacing="4" cellpadding="4" style="border:1px outset #00ff00; margin:10px 10px 10px 10px" >               
           <tr>
          
        <td class="para"></td><td  align="right" style="padding-right:30px; "><input type="button" onclick="window.location.href='index.php?module=category&shfrm=addnew&p=8'" class="btn" value="Add New Category Title" /></td></tr>
	    </table>
		</form>
		
		  <table width="98%"  border="0" cellspacing="1" cellpadding="1" style="border:1px outset #00ff00; margin:10px 10px 10px 10px" >            <tr><td  colspan="8" align="center"><?php echo $this->params['errorMsg'];?></td></tr> 
           <tr><td colspan="8" align="center"><?php echo $this->params['errorMsgDel'];?></td></tr>
            
               <tr bgcolor="#B6D3A0">
			    <td height="25"  class="tdbord" >S#</td>
                <td  class="tdbord">Title</td>
					<td width="14%"  class="tdbord">Actions</td>
				
				
					
              </tr>
				  <?php  
				  $i=$start;
			
				   foreach ($this->paramss['CategoryList'] as $category)
				  {
				  $i++;
				
				  ?>  
				 <tr style="background-color:<?php if($i%2==0){ echo "#F5FBEA";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				
				  <td class="tdbord"><?php echo $category['title'];?></td>
               
			   
				
                
                 <td class="tdbord">
               <a href="index.php?module=category&cat_id=<?php echo $category['c_id'];?>&shfrm=addnew&p=3&m_id=<?php echo $category['m_id'];?>" class="tdbord_left"><img src="images/edit_icon.gif" style="border:0px " ></a                
				 ><a href="index.php?module=category&del_id=<?php echo $category['c_id'];?>&start=<?php echo $start;?>&p=3"  onClick="return condel();"><img src="images/delete_icon.gif"  style="border:0px " ></a></td>
               
				 </tr> 
				  <?php }?>                         	
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="44%">&nbsp;</td>
              </tr>
			  <tr>
			  	<td colspan="8">
				 <?php        
               if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

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
						
						}// end of if checking sufficient records are there to display bottom navigational link. 
						?>
				</td>
			</tr>
			<tr bgcolor="#F5FBEA" class="noprint"><td colspan="9" align="right" style="padding:15px 10px 15px 0px "><input type="button" onclick="window.location.href='javascript:history.go(-1)'" class="btn" value="&laquo; Go Back" title="Go at previous page"> &nbsp;
              </td></tr> 
        </table>
			<br><br>
			<?php }?>