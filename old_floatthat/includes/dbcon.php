<?
	function log_exit($message, $line, $file)
	{
		echo "<font color=red><u>Error:</u></font><br>" . $message .  " on line: ". $line. " in ". $file ;
		exit;
	}
	
class connections{

	function dbConnect($SERVER="50.63.108.69")
	{
	//	echo "$SERVER, ".USER.", ".PASSWORD."<br>";
		if ((@$db=mysql_pconnect($SERVER, USER, PASSWORD)) == FALSE)
			log_exit( "<b>Sorry:</b> Could not connect to MySQL Database server $SERVER", __LINE__, __FILE__);
	
		if(!mysql_select_db(DATABASE, $db))
		   log_exit( "<b>Sorry:</b> Could not connect to database DATABASE", __LINE__, __FILE__);
		return $db;
	}
	
	function dbClose($db)
	{
	   mysql_close($db);
	}
}// end of class


?>