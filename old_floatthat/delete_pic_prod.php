<?php
	require_once("config.php");
	
	if(trim($_GET['pid']) != "" && trim($_GET['pic']) != "")
	{
		if(is_file("./wadmin/gallaryimg/thumbnails/".$_GET['pic']))
		{
			unlink("./wadmin/gallaryimg/thumbnails/".$_GET['pic']);
			unlink("./wadmin/gallaryimg/gallaryphotos/".$_GET['pic']);
		}
		
		$query = "delete from tbl_photos  where photo_id = ".$_GET['pid']."";
		$resut = mysql_query($query );
		
		header("Location: add_products.php?id=".$_GET['id']);
	}
?>	