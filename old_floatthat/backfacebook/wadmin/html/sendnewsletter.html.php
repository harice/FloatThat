
<?php if(isset($_SESSION['adminemail'])){} else {
												echo "<script>window.location.href='index.php'</script>";
										
										 }?>
		
		<script type="text/javascript" src="openwysiwyg/scripts/wysiwyg.js"></script>
		<script type="text/javascript" src="openwysiwyg/scripts/wysiwyg-settings.js"></script>

		<?php
		
$from    = "From: \"www.allexams.com\" <{admin@allexams.com}>";
$subject = $_POST['subject'];
$message = $_POST['txt_content'];
$fileatt      = $_FILES['image']['tmp_name'];
$fileatt_type = $_FILES['image']['type'];
$fileatt_name = $_FILES['image']['name'];
$headers = "From: $from";
if (is_uploaded_file($fileatt)) {
 // Read the file to be attached ('rb' = read binary)
 $file = fopen($fileatt,'rb');
 $data = fread($file,filesize($fileatt));
 fclose($file);
 // Generate a boundary string
 $semi_rand = md5(time());
 $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
 
 // Add the headers for a file attachment
 $headers .= "\nMIME-Version: 1.0\n" .
             "Content-Type: multipart/mixed;\n" .
             " boundary=\"{$mime_boundary}\"";
			 
			  // Add a multipart boundary above the plain message
 $message = "This is a multi-part message in MIME format.\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
            $message . "\n\n";
			
			// Base64 encode the file data
 $data = chunk_split(base64_encode($data));
 
 // Add file attachment to the message
 $message .= "--{$mime_boundary}\n" .
             "Content-Type: {$fileatt_type};\n" .
             " name=\"{$fileatt_name}\"\n" .
             "Content-Disposition: attachment;\n" .
             " filename=\"{$fileatt_name}\"\n" .
             "Content-Transfer-Encoding: base64\n\n" .
             $data . "\n\n" .
             "--{$mime_boundary}--\n";
}


if($this->paramss['NewsLetter']!="")
{
	foreach ($this->paramss['NewsLetter'] as $newsletter)
		{

			$to= $newsletter["email"];
			
			// Send the message
			$ok = @mail($to, $subject, $message, $headers);

		}
		if ($ok) {
		 echo "<p><font color='red'>Mail sent!</font></p>";
		} else {
		 echo "<p><font color='red'>Mail could not be sent. Sorry!</font></p>";
		}
} 
		
		 ?>

			
		<table width="98%"  border="0" cellspacing="3" cellpadding="3" bgcolor="#DFDFDF" style="border:1px outset;margin-top:10px;" >
            
           <tr><td class="bheading">Send Marketing News latter To Customers</td><td  align="right" style="padding-right:30px; "></td></tr>
	    </table>
		<br>
			<table width="98%"  border="0" cellspacing="4" cellpadding="4" bgcolor="#DFDFDF" style="border:1px outset " >
            
              <tr>
			  	<td colspan="2">
			  <table cellpadding="2" cellspacing="2"width="90%" align="center" border="0">
            <form name="frm" action="index.php?module=sendnewsletter" method="post" enctype="multipart/form-data">
            	
                <tr><td class="tdtext" align="right" style="padding-right:20px;">Subject:</td><td align="left"><input type="text" name="subject" class="textBox"></td></tr>
                <tr><td class="tdtext" align="right" style="padding-right:20px;">Attach File:</td><td align="left"><input type="file" name="image" class="textBox"></td></tr>
                <tr><td valign="top" class="tdtext" align="right" style="padding-right:20px;" >Desctiption:</td>
                <td>
                 <script language="javascript">
							WYSIWYG.attach('txt_content', full);
							</script>
                <textarea name="txt_content" id="txt_content" cols="65" rows="12" ></textarea>
                </td></tr>
                <tr><td colspan="2" align="right" style="padding-right:10px;"><input type="submit" value="Send News Latter" name="SendLetter"></td></tr>
                </form>
            </table>
			  
			  	</td>
			</tr>
			                        	
              <tr bgcolor="#efefef">
                <td width="16%">&nbsp;</td>
                <td width="84%">&nbsp;</td>
              </tr>
			  <tr><td colspan="2"><a  href="javascript:history.go(-1)" class="readmore">Back</a></td></tr>
        </table>
			<br><br>
			