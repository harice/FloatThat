<?php


session_start();

require_once 'config.php';

					
					$user_id= $_REQUEST['user_id'];	
					$pro_id= $_REQUEST['pro_id'];	
					
						?>

<style>

.thumb{
    width:100px;
    float: left;
    margin-left: 5px;
    border: solid 1px #ccc;
}
.img {

}

input.chk{
margin-left: 70px;



}

</style>	
<div id="received">
<form action="index.php?m=home" method="post" name="frmreceived">
<?php 
$pro_id=$_REQUEST['pro_id'];
$productqry=mysql_query("select * from tbl_members WHERE pro_id='".$pro_id."'");
					$productdetail=mysql_num_rows($productqry);
?>
<input type="hidden" name="mem_id" value="<?php echo $productdetail;?>" />
<input type="hidden" name="pro_id" value="<?php echo $_REQUEST['pro_id'];?>" />
<input type="hidden" name="user_id" value="<?php echo $_REQUEST['user_id'];?>" />
<table cellpadding="0" cellspacing="0" >
<tr>

<td valign="top" style="border:1px solid #CCC">
		<div style="overflow:auto; width:400">
	<table cellpadding="0" cellspacing="0" width="350">
    <?php 

	    $fql1 =mysql_query("SELECT * from user_info where user_id!=$user_id");

	  $i=0;
		
		while ($friends=mysql_fetch_array($fql1))
	        {
			if ($i % 3 == 0)
						echo "<tr>";
						echo "<td width='100' align='left' class='s_txt' valign='top' >";?>
            					   
                                
								<div class="imgs">

								<div class="thumb">
								<img src="<?php echo $friends['pic'];?>" height="80" width="80" />
								<input type="checkbox" name="users_id[]" value="<?php echo $friends['user_id'];?>" />
								</div>
								
								<div align="center" style="padding-top:15px;">
                            	<?php echo htmlentities($friends['name'], ENT_QUOTES);?></span><br />
                                	
                                </div> 
                      			</div>
					 		 
					  <?php      echo "</td>";
						$i++;    
					}
						echo "</tr>";
				?>
                
    </table>
</div>
	
</td>

</tr>

<tr><td align="right"><input type="submit" value="Float Users" name="receivedsub"  /></td></tr>

</table>
</form>
</div>