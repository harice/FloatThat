<?php
//////////////////languages/////////////////
		
		if(isset($_REQUEST['idma'])){	      
		  if(@$_REQUEST['idma']=="fr"){ $_SESSION['idma']="fr";	}else{
				$_SESSION['idma']="en";	}///////////end switch////////////		
				}
		if( @$_SESSION['idma']=="en"){ include("languages/en_uk.php"); }else{ include( "languages/fr_french.php");		}
?>
<div style="position:absolute; left:920px; top:70px; ">
<span class="style4">Languages:</span>	&nbsp;&nbsp;<a href="<?=$_SERVER['PHP_SELF']?>?idma=en">
<img src="images/languages/uken.gif" alt="Click for English Language..." width="24" height="13" border="0"></a>
		<a href="<?=$_SERVER['PHP_SELF']?>?idma=fr"><img src="images/languages/french.gif" alt="Click for French Language" width="24" height="13" hspace="4" border="0"></a>
</div>
