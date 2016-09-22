
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
		<?php 
		$page_name="index.php?module=products";
		
		if(isset($_POST['srcbtn']))
				{
				$catname=$_POST['catname'];
				
				$query2="SELECT pro.*,cat.cat_id,cat.catname FROM tbl_books pro,tbl_category cat where pro.pname like '%$catname%' and cat.cat_id=pro.cat_id or cat.catname like '%$catname%' and pro.cat_id=cat.cat_id";
				$result2=mysql_query($query2);
				echo mysql_error();
		
				}
				else
				{
				$query2="SELECT pro.*,cat.cat_id,cat.catname FROM tbl_books pro,tbl_category cat where pro.cat_id='$_GET[cat_id]' and cat.cat_id=pro.cat_id";
				$result2=mysql_query($query2);
				echo mysql_error();
				}
				
				$nume=mysql_num_rows($result2);
				
				$start=$_GET['start'];
				if(!isset($start)) {                         // This variable is set to zero for the first page
				$start = 0;
				}
				
				$eu = ($start - 0); 
				$limit = 15;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 

		
		?>

		
		<?php if(isset($_GET['shfrm']) and $_GET['shfrm']=='addnew'){?>
			<form name="frm" action="index.php?module=products" method="post" enctype="multipart/form-data">
			<input type="hidden" name="products_id" value="<?php echo $_GET['pro_id'];?>">
			<br>
			<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;"  >
            
           <tr><td colspan="2" align="left" style="padding-left:5px; " class="bheading" >Category information</td></tr>
		   </table>
		
			
			<table width="98%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
             
              
              <tr><td  class="para" colspan="2" align="center"><?php echo $this->params['errorMsg']; echo $this->params['errorMsgIMG'];?></td></tr>
              
			   <tr>
                 <td  class="tdbord">Category: </td>
				 
                 <td  class="tdbord"><select name="cat_id" style="border:1px solid #ccc; width:300px; font-size:12px; color:#999999 ">
						
						<?php if(isset($this->paramss['Catname'])){?>
						<option value="<?php echo $this->paramss['Catname']['cat_id'];?>"><?php echo $this->paramss['Catname']['catname'];?></option>
						<?php } else {?>
						<option value="">----Select Category----</option>
						<?php }?>
						<?php foreach($this->paramsc['CatInfo'] as $cat){?>
						<option value="<?php echo $cat['cat_id'];?>" <?php if($cat['cat_id']==$_POST['jobcat1']){?> selected<?php }?>><?php echo $cat['catname'];?></option>
						<?php }?>
						</select></td>
               </tr>
               <tr bgcolor="#efefef">
                   <td  class="tdbord">Product Name: </td>
					<td  class="tdbord"><input type="text" name="pname" value="<?php echo $this->paramss['Catname']['pname'];?>" class="textBox"></td>
              </tr>
			   <tr bgcolor="#efefef">
                   <td  class="tdbord">Company Name: </td>
					<td  class="tdbord"><input type="text" name="company" value="<?php echo $this->paramss['Catname']['company'];?>" class="textBox"></td>
              </tr>
			   <tr bgcolor="#efefef">
                   <td  class="tdbord">Price: </td>
					<td  class="tdbord"><input type="text" name="price" value="<?php echo $this->paramss['Catname']['price'];?>" class="textBox"></td>
              </tr>
				<tr>
                   <td  class="tdbord">Detail: </td>
					<td  class="tdbord"><textarea id="detail" name="detail" cols="60" rows="4" style="border:1px solid #fff; background-color:#DFDFDF; color:#000; font-size:14px;"><?php echo $this->paramss['Catname']['detail'];?></textarea></td>
                </tr>
				 <tr bgcolor="#efefef">
                   <td  class="tdbord">Hot Job: </td>
					<td  class="tdbord"><input type="checkbox" name="hot" <?php if($this->paramss['Catname']['hot']==1){?> checked <?php } ?>  class="textBox"></td>
              </tr>
			   <tr bgcolor="#efefef">
                   <td  class="tdbord">Image: </td>
					<td  class="tdbord"><input type="file" name="userfile" class="textBox"></td>
              </tr>
			  
				<tr ><td class="tdbord"></td><Td align="left" style="padding-left:10px; " class="tdbord"><input type="submit" name="Regbtn" value="Save Category" class="button"></Td></tr>
				<tr>
				  <td class="tdbord"></td>
				  <Td align="left" style="padding-left:10px; " class="tdbord">&nbsp;</Td>
			  </tr>
			  
                                            	
              
            </table>
			</form>
			<?php } else {?>
			<form name="sfrm" action="" method="post">
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">Products List</td><td class="para">Search Products:&nbsp;<input type="text" name="pname">&nbsp;<input type="submit" value="Search" name="srcbtn"></td><td  align="right" style="padding-right:30px; "><?php if($_SESSION['editrec']==1){?><a href="index.php?module=products&shfrm=addnew" class="para">Add New Product</a><?php }?></td></tr>
	    </table>
		</form>
		<br>
			<table width="98%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#DFDFDF" style="border:1px outset " >
            <tr><td  colspan="8" align="center"><?php echo $this->params['errorMsg'];?></td></tr> 
           <tr><td colspan="8" align="center"><?php echo $this->params['errorMsgDel'];?></td></tr>
            
               <tr bgcolor="#FFFFFF">
			    <td height="25"  class="tdbord" >S.No</td>
                <td  class="tdbord">Category</td>
				
				<td width="24%"  class="tdbord">Product</td>
				<td width="21%"  class="tdbord">Company</td>
				<td width="9%"  class="tdbord">Price</td>
				<?php if($_SESSION['editrec']==1){?><td width="5%"  class="tdbord">Status</td><?php }?>
				<?php if($_SESSION['editrec']==1){?><td width="5%"  class="tdbord">Edit</td><?php }?>
				
				<?php if($_SESSION['delrec']==1){?><td width="5%"  class="tdbord">Delete</td><?php }?>
					
              </tr>
				  <?php  
				  $i=$start;
				   foreach ($this->paramss['CategoryList'] as $product)
				  {
				  $i++;
				 
				  ?>  
				 <tr style="background-color:<?php if($i%2==0){ echo "#efefef";}?> ">
				 <td class="tdbord"><?php echo $i;?></td>
				 <td class="tdbord"><a href="index.php?module=productdetail&pro_id=<?php echo $product['pro_id'];?>" class="para"><?php echo $product['catname'];?></a></td>
				 <td class="tdbord"><?php echo $product['pname'];?></td>
				 <td class="tdbord"><?php echo $product['company'];?></td>
				 <td class="tdbord"><?php echo $product['price'];?></td>
				<?php if($_SESSION['editrec']==1){?><td class="tdbord"><?php if($product['status']==1){?><a href="index.php?module=products&proac=<?php echo $product['pro_id'];?>&st=0&start=<?php echo $start;?>" class="para" onClick="return condc();">Active</a><?php } else {?><a href="index.php?module=products&proac=<?php echo $product['pro_id'];?>&st=1&start=<?php echo $start;?>" class="para" onClick="return conac();">Disable</a><?php }?></td><?php }?>
				 <?php if($_SESSION['editrec']==1){?><td ><a href="index.php?module=products&pro_id=<?php echo $product['pro_id'];?>&shfrm=addnew" class="tdbord">Edit</a></td><?php }?>
				<?php if($_SESSION['delrec']==1){?> <td ><a href="index.php?module=products&del_id=<?php echo $product['pro_id'];?>&start=<?php echo $start;?>" class="tdbord" onClick="return condel();">Delete</a></td><?php }?>
				 </tr> 
				  <?php }?>                         	
              <tr>
                <td width="5%">&nbsp;</td>
                <td width="26%">&nbsp;</td>
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