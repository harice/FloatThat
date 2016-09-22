
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
			
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">News Detail</td><td  align="right" style="padding-right:30px; "><?php if($_SESSION['editrec']==1){?><a href="index.php?module=news&shfrm=addnew" class="para">Add News or Events</a><?php }?></td></tr>
	    </table>
		<br>
			<table width="98%"  border="0" cellspacing="4" cellpadding="4" bgcolor="#DFDFDF" style="border:1px outset " >
            
              
				
				 <tr >
				 <td width="16%"  class="tdbord"><b>Date :</b></td>
				 <td class="tdbord"><?php echo $this->paramss['newsdata']['date'];?></td>
				 </tr>
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td width="16%"  class="tdbord"><b>Heading :</b></td>
				 <td class="tdbord"><?php echo $this->paramss['newsdata']['heading'];?></td>
				 </tr>
				
				 <tr >
				 <td width="16%"  class="tdbord"><b>Detail :</b></td>
				 <td class="tdbord"><?php echo$this->paramss['newsdata']['detail'];?></td>
				 </tr>
				
				                         	
              <tr bgcolor="#efefef">
                <td width="16%">&nbsp;</td>
                <td width="84%">&nbsp;</td>
              </tr>
			  <tr><td colspan="2"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
        </table>
			<br><br>
			