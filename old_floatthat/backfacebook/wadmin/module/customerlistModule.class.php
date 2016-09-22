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
		
			if(isset($_GET['cust_id']))
			{
			$this->DelEmp();
			}
			
			if(isset($_GET['Acust_id']))
			{
			$this->UpdateStatus();
		
			}
			
			
			
			
			$getCategorylist = $this-> getcustomerrecords();
			$this->htmlObj->paramss['EmployList'] = $getCategorylist;
			
			
					
	}
	
			
		
		
		public function getcustomerrecords()
		{
			
			
			$start=$_GET['start'];
			if(!isset($start)) {                         // This variable is set to zero for the first page
			$start = 0;
			}	
			$eu = ($start - 0); 
			$limit = 30;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 		
			
			$sql = $this->MMdbobj->query("SELECT cust.* FROM tbl_clients cust order by cust.createddate DESC limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
	
	
	
	public function DelEmp()
		{
			$this->empid = $this->MMdbobj->quote($_GET['cust_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_clients where u_id={$this->empid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			
		}
		
		public function UpdateStatus()
		{
			$this->Acust_id = $this->MMdbobj->quote($_GET['Acust_id']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_clients set status={$this->st} where u_id={$this->Acust_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
				
				
	
}

?>
