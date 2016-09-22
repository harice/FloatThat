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
			if($_GET['shfrm']=="empty")
			{
			
			 $this->EmpLogs();
			}
			
			$this->htmlObj->paramss['logsdata']=$this->LogsData();
			
					
	}
	
	
	
		
	
	
	
			
			public function LogsData()
			{
			
			$sql = $this->MMdbobj->query("select * FROM tbl_seclogs");
			$senddata = $this->MMdbobj->fetchRows();
						
			return $senddata;
			}
	
		public function EmpLogs()
		{
		$sql = $this->MMdbobj->query("delete FROM tbl_seclogs");
			$sendcontents = $this->MMdbobj->affectedRows();
		
		}
		
			
	
	
	
}

?>
