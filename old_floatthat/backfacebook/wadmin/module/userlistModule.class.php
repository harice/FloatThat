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
		
			
			$getCategorylist = $this-> getcustomerrecords();
			$this->htmlObj->paramss['EmployList'] = $getCategorylist;
			
			
					
	}
	
			
		
		
		public function getcustomerrecords()
		{
			
			
			
			$st=$_GET['status'];
			
			$start=$_GET['start'];
			if(!isset($start)) {                         // This variable is set to zero for the first page
			$start = 0;
			}	
			$eu = ($start - 0); 
			$limit = 10;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 		
			
			$sql = $this->MMdbobj->query("SELECT * FROM user_info order by name limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
	
	
	
	
	
}

?>
