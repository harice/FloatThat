<?
require_once("config.php");


$list = $_POST["list"];
$newOffset = $_POST["newOffset"];

if( $_POST["submit"] == "Delete Records")
{
		if( $_POST["type"] == 1)
		{
			for($i=0; $i<count($list);($i=$i+1))
			{
				 $md_id = $list[$i];	 
				 $Querry_Sqls = "delete from model_details  where md_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);
				 
				 $Querry_Sqls = "delete from catagories  where model_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);
				 
				 $Querry_Sqls = "delete from sub_catagories  where model_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);
					 
				 $Querry_Sqls = "delete from photographi_info  where model_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);
				 
				 $Querry_Sqls = "delete from physical_attributes  where model_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);	 	 
				 
				 $Querry_Sqls = "delete from web_info  where model_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);		 	 
			}
			header("Location: talent.php?newOffset=".$_GET['newOffset']);
		}
		elseif( $_POST["type"] == 2)
		{
			for($i=0; $i<count($list);($i=$i+1))
			{
				 $md_id = $list[$i];	 
				 $Querry_Sqls = "delete from model_details  where md_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);
				 
				 $Querry_Sqls = "delete from company_info  where model_id =  $md_id";
				 $commonObject->insertInto($Querry_Sqls);		 	 
			}
			header("Location: advertiser.php?newOffset=".$_GET['newOffset']);
		}	
}
elseif( $_POST["submit"] == "Activate All Members")
{
		if( $_POST["type"] == 1)
		{
			for($i=0; $i<count($list);($i=$i+1))
			{
				 $md_id = $list[$i];	 
				 $Querry_Sqls = "update model_details set status = 1 where md_id =  $md_id and type = 1";
				 $commonObject->insertInto($Querry_Sqls);
			}
								header("Location: talent.php?newOffset=".$_GET['newOffset']);

		}
		elseif( $_POST["type"] == 2)
		{
			for($i=0; $i<count($list);($i=$i+1))
			{
				 $md_id = $list[$i];	 
				 $Querry_Sqls = "update model_details set payment = 1 where md_id =  $md_id and type =2";
				 $commonObject->insertInto($Querry_Sqls);				 
			}	
								header("Location: advertiser.php?newOffset=".$_GET['newOffset']);
 
		}
		 
}
elseif( $_POST["submit"] == "Disable All Members")
{
		if( $_POST["type"] == 1)
		{
			for($i=0; $i<count($list);($i=$i+1))
			{
				 $md_id = $list[$i];	 
				  $Querry_Sqls = "update model_details set status = 0 where md_id =  $md_id and type = 1";
				 $commonObject->insertInto($Querry_Sqls);
			}
								header("Location: talent.php?newOffset=".$_GET['newOffset']);

		}
		elseif( $_POST["type"] == 2)
		{
			for($i=0; $i<count($list);($i=$i+1))
			{
				 $md_id = $list[$i];	 
				 $Querry_Sqls = "update model_details set payment = 0 where md_id =  $md_id and type =2";
				 $commonObject->insertInto($Querry_Sqls);				 
			}	
								header("Location: advertiser.php?newOffset=".$_GET['newOffset']);
 
		}
		

}

?>
