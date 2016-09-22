<?php

if(isset($_SESSION['adminemail'])){?><?php }?>
<table width="100%"  border="0" cellspacing="2" cellpadding="0" style="background-image:url(images/bg.jpg); height:100px;">
      <tr>
        <td width="69%" rowspan="3" style="padding-top:2px; padding-left:150px;"><a href="index.php"><img src="images/logo.png" border="0"  /></a></td>
        <td height="38" colspan="2" align="center"><?php if(isset($_SESSION['adminemail'])){?><span class="readmore">welcome</span> <?php echo $_SESSION['adminemail'];?> &nbsp;&nbsp; <a href="index.php?module=homepage&logout=logout" class="readmore">Logout</a><?php }?></td>
        <td width="1%">&nbsp;</td>
      </tr>
     
    </table>
