
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		<script>
		
		</script>
		
		
		
		
			<form name="frm" action="index.php?module=changepass" method="post" enctype="multipart/form-data">
			<input type="hidden" name="employ_id" value="<?php echo $_GET['emp_id'];?>">
			<input type="hidden" name="module" value="<?php echo $_GET['mod'];?>">
			
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;"  >
            
           <tr><td colspan="2" align="left" style="padding-left:5px; " class="bheading" >Change Password</td></tr>
		   </table>
		
			
			<table width="98%"  border="0" cellspacing="4" cellpadding="4" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
             
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg'];?></td></tr>
               <tr bgcolor="#efefef">
			   
				  	<tr><td colspan="2" class="bheading">New Password</td></tr>
				 
					<tr bgcolor="#efefef">
					<td width="26%"  class="tdbord">Password: <span class="mond">*</span></td>
					<td width="74%"  class="tdbord"><input type="text" name="password" value="<?php echo $this->paramss['EmpInfo']['password'];?>" class="textBox"></td>
       
			  </tr>
			
				<tr bgcolor="#efefef"><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord"><input type="submit" name="Regbtn" value="Change Password" class="button" ></Td></tr>
				<tr>
				  <td class="tdbord"></td>
				  <Td align="left" style="padding-left:10px; " class="tdbord">&nbsp;</Td>
			  </tr>
			  
			   <tr><td height="20"></td></tr>
				 <tr><td colspan="2"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
				    
                          
			     </table>
			     </tr>
				
			  
			 
			                   	
              
            </table>
			</form>
			