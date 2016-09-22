<?php

	interface DB
		{
		
			public function setHost($host);
			public function setDB($db);
			public function setUserName($user);
			public function setPassword($pwd);
			public function connect();
		}


class MySQLManager extends Exception implements DB
{
	private $dblink; 
	private $dbHost;
	private $dbUser;
	private $dbPass;
	private $dbDB;
	private $query;
	private $result;
	private $query_id;
	protected $MM;
	private $error_query;
	public $debug = false;
	
	public function __construct()
	{
		$this->MM = $GLOBALS['MM'];
	}
					
			
	public function setHost($host)
	{
		$this->dbHost = $host;
	}

	public function setDB($db)
	{
		$this->dbDB=$db;
	}
	
	public function setUserName($user)
	{
		$this->dbUser=$user;
	}
	
	public function setPassword($pwd)
	{
		$this->dbPass=$pwd;
	}
	
	public function connect()
	{
		$this->dblink=mysql_connect($this->dbHost,$this->dbUser,$this->dbPass) or die('cannot connect');
		mysql_select_db($this->dbDB) or die('Cannot Exist Database');
	//now connect
	}
	

	public function query($qry)
	{
		$this->query = mysql_query($qry, $this->dblink);
	}
	
	public function fetchRows()
	{
		while($results = mysql_fetch_array($this->query))
		{
		$retArray[] = $results;
		}	
		
		return $retArray;
	}
	
	public function numRows()
	{
		return mysql_num_rows($this->query);
	}
	
	public function fetchArray()
	{
		return mysql_fetch_array($this->query);
	}
	
	

	
	public function fetch_assoc() 
	{ 
		return mysql_fetch_assoc($this->query); 
	} 
				
	
		
	
	
	public function fetch_row() 
	{ 
	return mysql_fetch_row($this->query); 
	} 
	
	
	
	function quote( $text )
		{
			if ( get_magic_quotes_gpc() )
				$text = stripslashes($text);
	
			return '\'' . mysql_real_escape_string($text) . '\'';
		}
		
		public function affectedRows()
		{
			return ( $this->dblink ) ? mysql_affected_rows($this->dblink) : false;
		}
		
		
		private function halt( $errormsg = null )
		{
			echo 'Class Error Message: ' .$errormsg. '<br>';
			if ( $this->link_id ) {
				echo 'MySQL Error Message: ' .mysql_error($this->dblink). '<br>';
				echo 'MySQL Error Number: ' .mysql_errno($this->dblink). '<br>';
				echo 'MySQL Error Query: ' .$this->error_query. '<br>';
			}
			$this->close();
			die();
		}

}

				

?>