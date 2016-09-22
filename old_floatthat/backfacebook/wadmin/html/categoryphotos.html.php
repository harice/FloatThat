

	<?php 
	
	$page_name="index.php?module=categoryphotos";
	
	
	
	$query2="SELECT * FROM tbl_photos order by photo_id ASC ";
	
	$result2=mysql_query($query2);
				echo mysql_error();
				$nume=mysql_num_rows($result2);
				
				$start=$_GET['start'];
				if(!isset($start)) {                         // This variable is set to zero for the first page
				$start = 0;
				}
				
				$eu = ($start - 0); 
				$limit = 48;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 
	
	?>
   
    
     <form action="" method="post"  name="frm">
            <table width="100%" border="0" cellspacing="4" cellpadding="4">
		     
             
              
              	<tr>
                	<Td colspan="3" height="445" valign="top">
                    	
                    <table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#F5FBEA" style="border:1px outset;margin-top:10px;" >
       
                            	 <tr><td class="bheading">Photo Gallery List</td><td class="para"></td><td  align="right" style="padding-right:30px; "></td></tr>
                              
                                
                          
            <tr><td width="165" height="30"></td></tr>
                               
                                <?php 
								
													
								if($this->paramss['myGallary']!="")
								{
									$i=0;
									$temp=0;
									foreach($this->paramss['myGallary'] as $comp)
									{
								
								if($temp!=$comp['pro_id']) 
										 	{	
											?>
                                    		<tr><td colspan="4" align="center" bgcolor="#CACD96" height="30" class="bheading"><?php echo $comp['title'];?></td></tr>
                                     		<?php 
									  		$temp = $comp['pro_id'];
											 }
									
                               		if ($i % 4 == 0)
												 echo "<tr>";
												 echo "<td width='190' align='left' class='tdbord' >";
												 ?>
                                                 <div style="" align="center">
                                                 
                                              		<a href="index.php?module=viewphotos&photo_id=<?php echo $comp['photo_id'];?>&p=3" ><img src="gallaryimg/thumbnails/<?php echo $comp['image'];?>"  border="none"  /></a>
                                           
                                     
                                     </div><br>
                                     <span class="text" ><b>Title :</b><?php echo $comp['photoname']; ?></span>
                                     <br />
                                            
                                  
                                      <a href="index.php?module=categoryphotos&photo_id=<?php echo $comp['photo_id'];?>&mod_id=8&p=3" class="tdbord" onClick="return condel();">  Delete</a>
                             <?php /*?> <a href="index.php?module=editphotos&photo_id=<?php echo $comp['photo_id'];?>&p=3&cat_id=<?php echo $comp['cat_id']?>&mod_id=8" class="tdbord">  Edit</a>        
                                     <?php */?>
									
                                     
                               <?php      echo "</td>";
											  $i++;    
											}
											echo "</tr>";
                           			}?>
                            </table>
                    
                    </Td>
                </tr>
                 <tr>
								<td   colspan="2" >
                              
								 <?php        
							   if($nume > $limit )
							   
							   { // Let us display bottom links if sufficient records are there for paging

								
									/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
									echo "<table align = 'center' width='400' ><tr class='para'><td  align='left' width='30%'>";
									//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
									if($back >=0) { 
									print "<a href='$page_name&start=$back' class='para'> <img src='images/pre_btn.gif' width='22' height='21' border='none' /> </a>"; 
									} 
									//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
									echo "</td><td align=center width='100%'>";
									$i=0;
									$l=1;
									for($i=0;$i < $nume;$i=$i+$limit){
									if($i <> $eu){
									echo " <a href='$page_name&start=$i' class='item_link'>$l</a> ";
									}
									else { echo "<span class='item_link'>$l</span>";}        /// Current page is not displayed as link and given font color red
									$l=$l+1;
									}
									
									
									echo "</td><td  align='right' width='20%' class='item_link'>";
									///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
									if($this1 < $nume) { 
									print "<a href='$page_name&start=$next' class='para'><img src='images/fwd_btn.gif' width='22' height='21' border='none'/> </a>";} 
									echo "</td></tr></table>";
									
									
								}// end of if checking sufficient records are there to display bottom navigational link. 
										
										
									?>
                                    </td></tr>
                                     
   	        </table>
            </form>
    	
     