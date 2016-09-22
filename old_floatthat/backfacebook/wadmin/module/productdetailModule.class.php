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
			
			$this->htmlObj->paramss['jobdata']=$this->ProData();
			
					
	}
	
	
			
			public function ProData()
			{
			$this->catid = $this->MMdbobj->quote($_GET['pro_id']);
			$sql = $this->MMdbobj->query("select pro.*,cat.catname FROM tbl_books pro,tbl_category cat where pro_id={$this->catid} and cat.cat_id=pro.cat_id");
			$senddata = $this->MMdbobj->fetch_assoc();
						
			return $senddata;
			}
	
	
	
}

?>
