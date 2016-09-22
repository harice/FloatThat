<?
class Common{

// return false on failure and array of records on success
function selectMultiRecords($Querry_Sql)
{   
	if((@$result = mysql_query ($Querry_Sql))==FALSE)
   	{
		if (DEBUG=="True")
		{
			echo Common::mysql_message($Querry_Sql);		
		}	
	}   
	else
 	{	
	    $count = 0;
		$data = array();
		while ( $row = mysql_fetch_array($result)) 
		{
			$data[$count] = $row;
			$count++;
		}
			return $data;
	}
}

function selectFrom($Querry_Sql)
{ //echo DEBUG . $Querry_Sql;
        
	if((@$result = mysql_query ($Querry_Sql))==FALSE)
   	{
		if (DEBUG=="True")
		{
			echo Common::mysql_message($Querry_Sql);		
		}	
	}   
	else
 	{	
		if ($check=mysql_fetch_array($result))
   		{
      		return $check;
   		}
			return false;	
	}
}

function update($Querry_Sql)
{
        
	if((@$result = mysql_query ($Querry_Sql))==FALSE)
   	{
		if (DEBUG=="True")
		{
		echo Common::mysql_message($Querry_Sql);		
		}	
	}   
	else
 	{	
		return true;
   	}
	//mysql_free_result($result);
}
function insertInto($Querry_Sql)
{	  

   if((@$result = mysql_query ($Querry_Sql))==FALSE)
   	{
		if (DEBUG=="True")
		{
			echo Common::mysql_message($Querry_Sql);		
		}	
	}   
	else
 	{	
		return true;	
	}
	//mysql_free_result($result);
}



function mysql_message($Querry_Sql)
{
	$msg .= "Error in your Query: $Querry_Sql<BR>";
	$msg .= mysql_errno() . " " . mysql_error() . "</div><HR>";
	echo $msg;
}	

}// end of class
?>