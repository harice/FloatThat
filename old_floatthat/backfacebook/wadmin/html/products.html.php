
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=products";
		
		if(isset($_POST['srcbtn']))
				{
				$catname=$_POST['catname'];
				
				$query2="SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where pro.title like '$catname%' and cat.c_id=pro.c_id or cat.title like '$catname%' and pro.c_id=cat.c_id order by cat.c_id ASC";
				$result2=mysql_query($query2);
				echo mysql_error();
		
				}
				else
				{
				$query2="SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id order by cat.c_id ASC ";
				$result2=mysql_query($query2);
				echo mysql_error();
				}
				
				$nume=mysql_num_rows($result2);
				
				$start=$_GET['start'];
				if(!isset($start)) {                         // This variable is set to zero for the first page
				$start = 0;
				}
				
				$eu = ($start - 0); 
				$limit = 20;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 

		
		?>
<?php 
		include_once "FCKeditor/fckeditor.php";
		?>		
		<?php if(isset($_GET['shfrm']) and $_GET['shfrm']=='addnew'){?>
			<form name="frm" action="index.php?module=products" method="post" enctype="multipart/form-data">
			<input type="hidden" name="exams_id" value="<?php echo $_GET['ex_id'];?>">
			<br>
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#efefef" style="border:1px outset;margin-top:10px;"  >
            
           <tr><td colspan="2" align="left" style="padding-left:5px; " class="bheading" >Product information</td></tr>
		   </table>
		
			
			<table width="98%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#efefef" style="border:1px outset;margin-top:10px;" >
             
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg']; echo $this->params['errorMsgIMG'];?></td></tr>
              
			   <tr>
                 <td  class="tdbord">Category: </td>
				 
                 <td  class="tdbord">
               			
							
                 <select name="c_id" style="border:1px solid #ccc; width:300px; font-size:12px; color:#999999 ">
						
						
                        <option value="">--Select Category--</option>
								
						<?php foreach($this->paramsc['CatInfo'] as $cat){?>
						<option value="<?php echo $cat['c_id'];?>" <?php if($cat['c_id']==$this->paramss['Catname']['c_id']){?> selected<?php }?>><?php echo $cat['title'];?></option>
						<?php } 
						?>
						</select></td>
               </tr>
               <tr bgcolor="#efefef">
                   <td  class="tdbord">Product Title Name: </td>
					<td  class="tdbord"><input type="text" name="exname" value="<?php echo $this->paramss['Catname']['title'];?>" class="textBox"></td>
              </tr>
              
              <tr bgcolor="#efefef">
                   <td  class="tdbord">Product Price: </td>
					<td  class="tdbord"><input type="text" name="price" value="<?php echo $this->paramss['Catname']['price'];?>" class="textBox"></td>
              </tr>
              
              <tr bgcolor="#efefef">
                   <td  class="tdbord">Detail: </td>
					<td  class="tdbord">
                      <textarea name="detail" id="detail" cols="60" rows="5"><?php echo $this->paramss['Catname']['detail'];?></textarea></td>
         
                   
                  </tr>
              
               <tr bgcolor="#efefef">
                   <td  class="tdbord">Thumbnail (image): </td>
					<td  class="tdbord"><input type="file" name="userfile1" ></td>
              </tr>
              
               <tr bgcolor="#efefef">
                   <td  class="tdbord">Float Date: </td>
					<td  class="tdbord"><input type="text" name="fdate" class="textBox"></td>
              </tr>
			   
			   <tr bgcolor="#efefef">
                   <td  class="tdbord">Hot: </td>
					<td  class="tdbord"><input type="checkbox" name="featured" <?php if($this->paramss['Catname']['featured']==1){?> checked <?php } ?>  class="textBox"></td>
              </tr>
              
               <tr bgcolor="#efefef">
                   <td  class="tdbord">Termas: </td>
					<td  class="tdbord">
                     <?php
					$editor = new FCKeditor('terms') ;
					$editor->BasePath		= 'FCKeditor/' ;
					$editor->ToolbarSet 	='Default';
					$editor->Value	= $this->paramss['Catname']['terms'];
					$editor->Width  = '100%' ;
					$editor->Height = '400' ;
					$editor->Create() ;	
					?>
                   
                       </tr>
			  
				<tr ><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord"><input type="submit" name="Regbtn" value="Save Products" class="button"></Td></tr>
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
            
           <tr><td class="bheading">Products List</td><td class="para">Search Products:&nbsp;<input type="text" name="pname">&nbsp;<input type="submit" value="Search" name="srcbtn"></td><td  align="right" style="padding-right:30px; "><a href="index.php?module=products&shfrm=addnew" class="para">Add New Product</a></td></tr>
	    </table>
		</form>
		<br>
			<table width="98%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#efefef" style="border:1px outset;" >
            <tr><td  colspan="8" align="center"><?php echo $this->params['errorMsg'];?></td></tr> 
           <tr><td colspan="8" align="center"><?php echo $this->params['errorMsgDel'];?></td></tr>
            
               <tr bgcolor="#FFFFFF">
			    <td height="10"  class="tdbord" >S#</td>
               
				<td width="300"  class="tdbord">Product Title</td>
                <td width="300"  class="tdbord">Detail</td>
				<td width="200"  class="tdbord">Thumbnail</td>
                <td width="200"  class="tdbord">Price</td>
              
				
				<td width="75"  class="tdbord">Status</td>
				<td width="50"  class="tdbord">Edit</td>
				
				<td width="40"  class="tdbord">Delete</td>
					
              </tr>
				  <?php  
				  $i=$start;
				  $temp=0;
				  if($this->paramss['CategoryList']!="")
				  {
				   foreach ($this->paramss['CategoryList'] as $product)
				  {
				  $i++;
				  
				 /* $selmem=mysql_query("select deal.*,mem.* from tbl_deals deal,tbl_members mem where deal.pro_id=$product[pro_id] and pro.deal_id=deal.pro_id");
				  $selnum=mysql_num_rows($selmem);*/
				 if($temp!=$product['c_id'])
				 {
				  ?>  
                  <tr><td colspan="8" align="center" bgcolor="#999999" class="heading"><?php echo $product['cattitle'];?></td></tr>
                  <?php 
				  $temp=$product['c_id'];
				  }?>
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				
				 <td class="tdbord"><?php echo $product['title'];?></td>
                 <td class="tdbord"><?php echo $product['detail'];?></td>
				 <td class="tdbord"><img src="products/<?php echo $product['c_id'];?>/<?php echo $product['thumb'];?>" width="60" /></td>
                 <td class="tdbord">$<?php echo $product['price'];?></td>
				<?php /*?><td class="tdbord"><a href="index.php?module=itemmember&pro_id=<?php echo $product['pro_id'];?>"><?php echo $selnum;?></a></td><?php */?>
                
				<td class="tdbord"><?php if($product['status']==1){?><a href="index.php?module=products&exmac=<?php echo $product['pro_id'];?>&st=0&start=<?php echo $start;?>" class="para" onClick="return condc();">Active</a><?php } else {?><a href="index.php?module=products&exmac=<?php echo $product['pro_id'];?>&st=1&start=<?php echo $start;?>" class="para" onClick="return conac();">Disable</a><?php }?></td>
				<td ><a href="index.php?module=products&ex_id=<?php echo $product['pro_id'];?>&shfrm=addnew&c_id=<?php echo $product['c_id'];?>" class="tdbord">Edit</a></td>
				 <td ><a href="index.php?module=products&del_id=<?php echo $product['pro_id'];?>&start=<?php echo $start;?>" class="tdbord" onClick="return condel();">Delete</a></td>
				 </tr> 
				  <?php }
				  }?>                         	
              <tr>
                <td width="4%">&nbsp;</td>
                <td width="29%">&nbsp;</td>
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
			 <tr><td colspan="6"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
        </table>
			<br><br>
			<?php }?>