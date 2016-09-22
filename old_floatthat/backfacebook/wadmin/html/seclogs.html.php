
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		
			
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">Security Logs</td><td  align="right" style="padding-right:30px; "><?php if($_SESSION['editrec']==1){?><a href="index.php?module=seclogs&shfrm=empty" class="para" onClick="return condel();">Remove Logs File</a><?php }?></td></tr>
	    </table>
		<br>
			<table width="98%"  border="0" cellspacing="4" cellpadding="4" bgcolor="#DFDFDF" style="border:1px outset " >
            
              
				
				 <tr >
				 <td width="16%" colspan="2" bgcolor="#FFFFFF">
				 
				 <?php foreach($this->paramss['logsdata'] as $logs)
				 { 
				 $logsdata.=$logs['date']." \n";
				 $logsdata.=$logs['ipadress']." \n";
				 $logsdata.=$logs['userid']." \n";
				 $logsdata.=$logs['username']." \n";
				 $logsdata.=$logs['action']." \n";
				 }
				 
				 ?>
				 
				 <?php 
				 
				 $myFile = "LogsFile.txt";
				$fh = fopen($myFile, 'w') or die("can't open file");
				$stringData = "$logsdata\n";
				fwrite($fh, $stringData);
				
				fclose($fh);

				 
				// include "../testFile.txt";
				 echo $logsdata;
				// echo "a \n\r b"; 

				 ?></td>
				
				 </tr>
				 
				                         	
              <tr bgcolor="#efefef">
                <td width="16%">&nbsp;</td>
                <td width="84%">&nbsp;</td>
              </tr>
			  <tr><td colspan="2"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
        </table>
			<br><br>
			