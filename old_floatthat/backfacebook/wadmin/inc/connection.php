
<?php 
function conn()
			{		
		mysql_connect ("localhost", "root",
"") or die('Cannot connect to the database because: ' . mysql_error());
$seldb="attarisoft";
			mysql_select_db($seldb)  or die('Cannot select database '.$seldb); 
		
			
				/*$dbh=mysql_connect ("localhost", "attariso_asoft26", "softat26") or die ('I cannot connect to the database because: ' . mysql_error());
			mysql_select_db ("attariso_atsoft",$dbh);*/
			}
			?>