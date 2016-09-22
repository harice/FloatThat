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
			
			$this->htmlObj->paramss['jobdata']=$this->JobData();
			
					
	}
	
	
	
		
	
	
	
			
			public function JobData()
			{
			$this->catid = $this->MMdbobj->quote($_GET['v_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_vendor where v_id={$this->catid}");
			$senddata = $this->MMdbobj->fetch_assoc();
						
			return $senddata;
			}
	
		
		
			
	
	
	
}

?>
