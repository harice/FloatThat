<?php
defined('VALID_ACCESS') or die('Restricted Access');
@session_start();
class Module extends PageController
{

	private $useremail;
	private $password;
	
	
	public function __construct() 
	{
		parent::__construct ();
	
	}
	
	
	
	public function render()
	{
			
	}
	
	
	
		
	
	
	
function _mysqldump_csv($table)
{
	$delimiter= ",";
	if( isset($_REQUEST['csv_delimiter']))
		$delimiter= $_REQUEST['csv_delimiter'];
	
	if( 'Tab' == $delimiter)
		$delimiter="\t";
	
	
	$sql="select * from `$table`;";
	$result=mysql_query($sql);
	if( $result)
	{
		$num_rows= mysql_num_rows($result);
		$num_fields= mysql_num_fields($result);
		
		$i=0;
		while( $i < $num_fields)
		{
			$meta= mysql_fetch_field($result, $i);
			echo($meta->name);
			if( $i < $num_fields-1)
				echo "$delimiter";
			$i++;
		}
		echo "\n";
		
		if( $num_rows > 0)
		{
			while( $row= mysql_fetch_row($result))
			{
				for( $i=0; $i < $num_fields; $i++)
				{
					echo mysql_real_escape_string($row[$i]);
					if( $i < $num_fields-1)
							echo "$delimiter";
				}
				echo "\n";
			}
			
		}
	}
	mysql_free_result($result);
	
}	


function _mysqldump($mysql_database)
{
	$sql="show tables;";
	$result= mysql_query($sql);
	if( $result)
	{
		while( $row= mysql_fetch_row($result))
		{
			_mysqldump_table_structure($row[0]);
			
			if( isset($_REQUEST['sql_table_data']))
			{
				_mysqldump_table_data($row[0]);
			}
		}
	}
	else
	{
		echo "/* no tables in $mysql_database */\n";
	}
	mysql_free_result($result);
}

function _mysqldump_table_structure($table)
{
	echo "/* Table structure for table `$table` */\n";
	if( isset($_REQUEST['sql_drop_table']))
	{
		echo "DROP TABLE IF EXISTS `$table`;\n\n";
	}	
	if( isset($_REQUEST['sql_create_table']))
	{
	
		$sql="show create table `$table`; ";
		$result=mysql_query($sql);
		if( $result)
		{
			if($row= mysql_fetch_assoc($result))
			{
				echo $row['Create Table'].";\n\n";
			}
		}
		mysql_free_result($result);
	}
}

function _mysqldump_table_data($table)
{
	
	$sql="select * from `$table`;";
	$result=mysql_query($sql);
	if( $result)
	{
		$num_rows= mysql_num_rows($result);
		$num_fields= mysql_num_fields($result);
		
		if( $num_rows > 0)
		{
			echo "/* dumping data for table `$table` */\n";
			
			$field_type=array();
			$i=0;
			while( $i < $num_fields)
			{
				$meta= mysql_fetch_field($result, $i);
				array_push($field_type, $meta->type);
				$i++;
			}
			
			//print_r( $field_type);
			echo "insert into `$table` values\n";
			$index=0;
			while( $row= mysql_fetch_row($result))
			{
				echo "(";
				for( $i=0; $i < $num_fields; $i++)
				{
					if( is_null( $row[$i]))
						echo "null";
					else
					{
						switch( $field_type[$i])
						{
							case 'int':
								echo $row[$i];
								break;
							case 'string':
							case 'blob' :
							default:
								echo "'".mysql_real_escape_string($row[$i])."'";
								
						}
					}
					if( $i < $num_fields-1)
						echo ",";
				}
				echo ")";
				
				if( $index < $num_rows-1)
					echo ",";
				else
					echo ";";
				echo "\n";
				
				$index++;
			}
		}
	}
	mysql_free_result($result);
	echo "\n";
}

function _mysql_test($mysql_host,$mysql_database, $mysql_username, $mysql_password)
{
	global $output_messages;
	$link = mysql_connect($mysql_host, $mysql_username, $mysql_password);
	if (!$link) 
	{
	   array_push($output_messages, 'Could not connect: ' . mysql_error());
	}
	else
	{
		array_push ($output_messages,"Connected with MySQL server:$mysql_username@$mysql_host successfully");
	
		$db_selected = mysql_select_db($mysql_database, $link);
		if (!$db_selected) 
		{
			array_push ($output_messages,'Can\'t use $mysql_database : ' . mysql_error());
		}
		else
			array_push ($output_messages,"Connected with MySQL database:$mysql_database successfully");
	}
	
}
	
	
}

?>
