
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		include_once "FCKeditor/fckeditor.php";
		?>
		
		<?php if(isset($_GET['shfrm']) and $_GET['shfrm']=='addnew'){?>
			<form name="frm" action="index.php?module=contents" method="post" enctype="multipart/form-data">
			<input type="hidden" name="content_id" value="<?php echo $_GET['content_id'];?>">
			<br>
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#efefef" style="border:1px outset;margin-top:10px;"  >
            
           <tr><td colspan="2" align="left" style="padding-left:5px; " class="bheading" >Contents information</td></tr>
		   </table>
		
			
			<table width="98%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#efefef" style="border:1px outset;margin-top:10px;" >
             
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg']; echo $this->params['errorMsgIMG'];?></td></tr>
              
			   <tr>
                 <td  class="tdbord">Main Menu: </td>
				 
                 <td  class="tdbord">
                 <?php 
							if(isset($_GET['m_id']) and $_GET['m_id']!="")
							{
							$qry=mysql_query("select * from tbl_mainmenu where m_id=$_GET[m_id]");
							$vnd=mysql_fetch_array($qry);
							 }?>
							
							
                 <select name="m_id" style="border:1px solid #ccc; width:300px; font-size:12px; color:#999999 ">
						
						<?php if(isset($_GET['content_id']) and $_GET['m_id']!=""){
							
							?>
						<option value="<?php echo $vnd['m_id'];?>"><?php echo $vnd['mainmenu'];?></option>
						<?php } else {?>
                        <option value="">--Select Menu--</option>
								<?php }?>
						<?php foreach($this->paramsc['CatInfo'] as $cat){?>
						<option value="<?php echo $cat['m_id'];?>" <?php if($cat['m_id']==$_POST['m_id']){?> selected<?php }?>><?php echo $cat['mainmenu'];?></option>
						<?php } 
						?>
						</select></td>
               </tr>
              
              
              <tr bgcolor="#efefef">
                   <td  class="tdbord">Contents: </td>
					<td  class="tdbord">
                    
                   <?php
					$editor = new FCKeditor('contents') ;
					$editor->BasePath		= 'FCKeditor/' ;
					$editor->ToolbarSet 	='Default';
					$editor->Value	= $this->paramss['Catname']['contents'];
					$editor->Width  = '100%' ;
					$editor->Height = '400' ;
					$editor->Create() ;	
					?>
                <?php /*?>    <textarea name="contents" id="detail1" cols="60" rows="5"><?php echo $this->paramss['Catname']['contents'];?></textarea></td><?php */?>
              </tr>
              
               
			  
				<tr ><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord"><input type="submit" name="Regbtn" value="Save Contents" class="button"></Td></tr>
				<tr>
				  <td class="tdbord"></td>
				  <Td align="left" style="padding-left:10px; " class="tdbord">&nbsp;</Td>
			  </tr>
			  
               <tr><td colspan="6"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>                              	
              
            </table>
			</form>
			<?php } else {?>
			<form name="sfrm" action="" method="post">
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#efefef" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">Contents List</td><td class="para"></td><td  align="right" style="padding-right:30px; "><a href="index.php?module=contents&shfrm=addnew" class="para">Add New Conatents</a></td></tr>
	    </table>
		</form>
		<br>
			<table width="98%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#efefef" style="border:1px outset;" >
            <tr><td  colspan="8" align="center"><?php echo $this->params['errorMsg'];?></td></tr> 
           <tr><td colspan="8" align="center"><?php echo $this->params['errorMsgDel'];?></td></tr>
            
               <tr bgcolor="#FFFFFF">
			    <td height="10"  class="tdbord" >S#</td>
               
				<td width="150"  class="tdbord">Menu/Sub Menu</td>
                <td width="828"  class="tdbord">Contents</td>
				
                
				<td width="43"  class="tdbord">Edit</td>
				
				<td width="39"  class="tdbord" >Delete</td>
					
              </tr>
				  <?php  
				  $i=$start;
				  $temp=0;
				  if($this->paramss['CategoryList']!="")
				  {
				   foreach ($this->paramss['CategoryList'] as $product)
				  {
				  $i++;
					?>
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord" valign="top"><?php echo $i;?></td>
				
				 <td class="tdbord" valign="top"><?php echo $product['mainmenu'];?></td>
                 <td  valign="top"><?php echo $product['contents'];?></td>
				
				<td valign="top"><a href="index.php?module=contents&content_id=<?php echo $product['content_id'];?>&shfrm=addnew&m_id=<?php echo $product['m_id'];?>" class="tdbord">Edit</a></td>
				 <td valign="top"><a href="index.php?module=contents&del_id=<?php echo $product['content_id'];?>&start=<?php echo $start;?>" class="tdbord" onClick="return condel();">Delete</a></td>
				 </tr> 
				  <?php }
				  }?>                         	
              <tr>
                <td width="39">&nbsp;</td>
                <td width="150">&nbsp;</td>
              </tr>
			  <tr>
			  	<td colspan="8">
				
				</td>
			</tr>
			 <tr><td colspan="6"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
        </table>
			<br><br>
			<?php }?>