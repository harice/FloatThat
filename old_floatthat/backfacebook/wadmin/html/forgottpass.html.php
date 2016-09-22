
<?php ?>
						<table cellpadding="0" cellspacing="0" width="100%">
                                	<tr><td colspan="3"></td></tr>
                                    <tr>
                                    	<td width="6"></td>
                                        <td align="center">
                                        	
											<?php if(!isset($this->paramss['Pass'])){?>
											<form name="frm" action="index.php?module=forgottpass" method="post">
											<table cellpadding="1" cellspacing="1" width="40%" style="table-layout:fixed;" height="200">
                                            	 <tr><td  class="headtilte" colspan="2" height="50" align="center"></td></tr>
                                             
                                              <tr><td  class="headtilte" colspan="2" align="center"><?php echo $this->params['errorMsg'];?></td></tr>
                                               <tr>
                                                 <td   class="para">
												 	User Email											 
												 </td>
												 <td  class="para">
												 	<input type="text" name="useremail">											 
												 </td>
                                              </tr>
											
											  <tr><td></td><Td align="left" style="padding-left:10px; "><input type="submit" name="passbtn" value="Send Request"></Td></tr>
                                        
										   <tr><td></td><Td align="left" style="padding-left:5px; "><a href="index.php?module=homepage" class="readmore">Login</a></Td></tr>
                                     
										  </table>
                                          </form> 
                                        <?php } else {?>
										
										your password has been sent at your email address please check
										<?php //echo $this->paramss['Pass'];
										
										?>
										<?php }?>
                                        </td>
                                        <td  width="5"></td>
                                        </tr>
                                    
                                    <tr><td colspan="3"></td></tr>
                                    
                                </table>
                               
                               
                                