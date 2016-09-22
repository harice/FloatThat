<?
	session_start();
	
	//Clear session varibles when user logs out.
	if(isset($_POST['logout']))
	{
		unset($_SESSION['user']);
		unset($_SESSION['host']);
		unset($_SESSION['pass']);
		unset($_SESSION['dbna']);
		unset($user);
		unset($host);
		unset($pass);
		unset($dbna);
	}

	//Sets the sessions variables when the user logs in to the application.
	if(isset($_POST['login_submit']))
	{
		$_SESSION['user'] = $_POST['username'];
		$_SESSION['host'] = $_POST['hostname'];
		$_SESSION['pass'] = $_POST['password'];
		$_SESSION['dbna'] = $_POST['dbname'];
	}

	//Check to make sure at least a username has been specified.
	if(isset($_SESSION['user']) && $_SESSION['user'] != "")
	{
		//grab session variables
		$uname = $_SESSION['user'];
		$dhost = $_SESSION['host'];
		$dname = $_SESSION['dbna'];
		$passw = $_SESSION['pass'];
		
		//Code to actually connect to database.
		$link = mysql_connect($dhost, $uname, $passw);
		if(!$link)
		{
			echo "There was an error connecting to the database: " . mysql_error();
		}
		mysql_select_db($dname);

		//This will run the queries when selected.
		if(isset($_REQUEST['query']))
		{
			$query = urldecode(stripslashes(trim($_REQUEST['query'])));
	
			//Starts timer.
			$start_time = microtime();
			
			$result = mysql_query($query, $link);
			
			//Ends timer.
			$end_time = microtime();
			
			//Compute final run time for query.
			$run_time = $end_time - $start_time;

		if($result)
		{
			$html = "Results:<br>\n";
			$html .= "Query Run Time: " . $run_time . " sec<br>\n";
			$i=0;
			while($row = @mysql_fetch_array($result, MYSQL_ASSOC))
			{
				$i++;
				$html .= "Row ". $i . " ---------------------<br>" ;
				foreach($row as $key => $value)
				{
					$html .= $key . " => " . $value . "<br>";
				}
				$html .= "<br>\n";
			}
		}
		else
		{
			$html = "Error running query: ".mysql_error();
		}
	}
	else
	{
		$query = "Enter MySQL Query here";
	}
	
	//Close database connection.
	mysql_close($link);
?>
<html>
	<head>
		<title>MySQL Database Connection/Query Test</title>
	</head>
	<body>
		<form name="querys" method ="post" action ="mysql_queries.php">
			<textarea rows="10" cols="50" name="query"><?= $query ?></textarea><br>
			<input type="submit" value="GO!" name="submit" /><input type="submit" value="Logout" name="logout" />
		</form>
		<?= $html ?>
	</body>
</html>
<?
	//End query block, begin login block.
	}
	else
	{
?>
<html>
	<head>
		<title>MySQL Database Connection/Query Test</title>
	</head>
	<body>
		<form action="mysql_queries.php" name="login_query" method = "post">
			Database Host Name: <input type="text" name="hostname" /><br />
			Database User Name: <input tyee="text" name="username" /><br />
			Database Name: <input type="text" name="dbname" /><br>
			Database Password : <input type="password" name="password" /><br />
			<input type="submit" value="Submit" name="login_submit" /><input type="reset" name="reset" value="Reset" />
			<br />
		</form>
	</body>
</html>
<?
	}
?>