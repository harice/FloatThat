
<?php ?>
						
                                        	
											<?php if(!isset($_SESSION['adminemail'])){?>
											<br>
											<br><br>
											
											<form name="frm" action="index.php?module=homepage" method="post">
											
											<table cellpadding="2" cellspacing="2" width="40%" style=" border:3px outset;margin-top:20px; margin-bottom:20px" align="center" height="137">
                                              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg'];?></td></tr>
                                               <tr>
                                                 <td align="right"  class="para">&nbsp;</td>
                                                 <td  class="paneltxt">&nbsp;</td>
                                               </tr>
                                               <tr>
                                                 <td width="28%" align="right"  class="para">
												 	<div align="center">useremail												 
											     </div></td>
												 <td width="66%"  class="paneltxt">
												 	<input type="text" name="useremail" class="textBox">											 
												 </td>
                                              </tr>
											  <tr>
											    <td align="right"  class="para">
											 	   <div align="center">Password											 
											     </div></td>
												 <td  class="paneltxt">
												 	<input type="password" name="password" class="textBox">											 
												 </td>
                                              </tr>
											  <tr>
										      <td></td><Td align="left" style="padding-left:5px; "><input type="submit" name="loginbtn" value="Login to admin" class="Button"></Td></tr>
                                            	
											 <tr>
										      <td></td><Td align="left" style="padding-left:5px; "><a href="index.php?module=forgottpass" class="readmore">Forgott Password</a></Td></tr>
											 <tr>
											   <td></td>
											   <Td align="left" style="padding-left:5px; ">&nbsp;</Td>
										      </tr>
                                     
										  
										  </table>
                                          </form> 
										  
										  <br><br><br>
                                        <?php } else {?>
										<table width="90%"  border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td width="1%">&nbsp;</td>
        <td width="21%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
       
      <td width="28%">&nbsp;</td>
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        
        <td align="center"><img src="images/home_icon.gif" width="89" height="89"></td>
        <td align="center"><img src="images/branch_icon.gif" width="89" height="89"></td>
        <td align="center"><img src="images/settings.jpeg" width="89" height="89"></td>
         <td align="center"><img src="images/salary_sheet.gif" width="89" height="89"></td>
       
       
      </tr>
      <tr>
        <td>&nbsp;</td>
         <td align="center"><a href="index.php?" class="buttons">Home</a></td>
      
        <td align="center"><a href="index.php?module=jobcat" class="buttons">Main Menu Management</a></td>
        <td align="center"><a href="index.php?module=category" class="buttons">Category Management</a></td>
         <td align="center"><a href="index.php?module=contents" class="buttons">Contents Management</a></td>
      
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
         <td width="28%">&nbsp;</td>
       
      </tr>
      
	   <tr>
        <td>&nbsp;</td>
        <td align="center"><img src="images/purchase_icon.gif" width="89" height="89"></td>
        <td align="center"><img src="images/database_icon.gif" width="89" height="89"></td>
        <td align="center"><img src="images/userlis_icon.gif" width="89" height="89"></td>
       
      
       
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><a href="index.php?module=sendnewsletter" class="buttons">Send News Letter</a></td>
        
        <td align="center"><span style="cursor:pointer;"
onclick="javascript:partd();" class="buttons" >

Database Backup</span></td>
        
        <td align="center"><a href="index.php?module=sendnewsletter" class="buttons">Log out</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
       
       
      
    </table>
										
										
										<?php }?>
                                        
                               
                               
                                