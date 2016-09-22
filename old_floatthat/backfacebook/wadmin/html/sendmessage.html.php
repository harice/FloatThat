
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		<script>
		function condel()
		{
		var get_res = confirm("Did you like to delete this job category?");

		   if (get_res == true)
			  {
			  return true;
			  }
			  else
			  {
			  return false;
			  }
		}
		</script>
		
		
			
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">Post New Message</td><td  align="right" style="padding-right:30px; "></td></tr>
	    </table>
		  
		 <form name="frm" action="" method="post" enctype="multipart/form-data">
		 <input type="hidden" name="emp_id" value="<?php echo $_GET['posted_id'];?>">
		  <table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#efefef" style="border:1px outset;margin-top:10px;" >
              
           
			<tr><td  class="para" colspan="2"><?php echo $this->params['errorMsg'];?></td></tr>
				
             
				<tr><td  class="para">Subject:</td><td class="tdtext"><input type="text" class="textBox" name="subject"></td></tr>
				
				 <tr>
                <td width="15%"  class="para">Message:</td><td class="tdtext"><textarea name="msg" cols="50" rows="7" style="border:1px solid #fff; background-color:#DFDFDF; color:#000; font-size:14px;"></textarea></td>
				
                </tr>
				 <tr>
                <td width="15%"  class="para">Attachment:</td><td class="tdtext"><input type="file" name="file" ></td>
				
                </tr>
				 <tr>
                <td width="15%"  class="para"></td><td class="tdtext"><input type="submit" value="Submit" name="sndsms"></td>
				
                </tr>
				                        	
              <tr>
                <td width="15%">&nbsp;</td>
                <td width="85%">&nbsp;</td>
              </tr>
			   <tr><td height="20"></td></tr>
				 <tr><td colspan="2"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
				    
            </table>
			</form>