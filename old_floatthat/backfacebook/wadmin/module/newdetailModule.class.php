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
			
			$this->htmlObj->paramss['newsdata']=$this->NewsData();
			
					
	}
	
	
	
		
	
	
	
			
			public function NewsData()
			{
			$this->newid = $this->MMdbobj->quote($_GET['new_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_news where news_id={$this->newid}");
			$senddata = $this->MMdbobj->fetch_assoc();
						
			return $senddata;
			}
	
		
		
			
	
	
	
}

?>
