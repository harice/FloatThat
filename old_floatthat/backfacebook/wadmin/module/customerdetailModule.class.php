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
			
			$this->htmlObj->paramss['Empdata']=$this->CustData();
			
					
	}
	
	
	
		
	
	
	
			
			public function CustData()
			{
			$this->empid = $this->MMdbobj->quote($_GET['cust_id']);
			$sql = $this->MMdbobj->query("select cust.* FROM  tbl_clients cust where cust.u_id={$this->empid}");
			$senddata = $this->MMdbobj->fetch_assoc();
						
			return $senddata;
			}
	
		
		
			
	
	
	
}

?>
