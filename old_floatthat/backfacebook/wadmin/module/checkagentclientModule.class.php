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
		
			if(isset($_GET['emp_id']))
			{
			$this->DelEmp();
			}
			
			if(isset($_GET['Aemp_id']))
			{
			$this->UpdateStatus();
			$this->SecLog();
			}
			
			
			$getCategorylist = $this-> getemprecords();
			$this->htmlObj->paramss['EmployList'] = $getCategorylist;
			
			
					
	}
	
			
		
		
		public function getemprecords()
		{
			
			
			$start=$_GET['start'];
			if(!isset($start)) {                         // This variable is set to zero for the first page
			$start = 0;
			}	
			$eu = ($start - 0); 
			$limit = 10;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 		
			
			$sql = $this->MMdbobj->query("SELECT emp.* FROM tbl_emp emp where ctype='agent' order by emp.date DESC limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
	
	
	
	public function DelEmp()
		{
			$this->empid = $this->MMdbobj->quote($_GET['emp_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_emp where emp_id={$this->empid}");
			$sendcontents = $this->MMdbobj->affectedRows();
			$sql = $this->MMdbobj->query("delete FROM tbl_appjobs where emp_id={$this->empid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
		}
	
	public function UpdateStatus()
		{
			$this->Aemp_id = $this->MMdbobj->quote($_GET['Aemp_id']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_emp set astatus={$this->st} where emp_id={$this->Aemp_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
				private function SecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','Account activated by admin','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
}

?>
