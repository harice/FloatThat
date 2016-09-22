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
			$this->htmlObj->paramss['EmpInfo']=$this->SelectEmploy();
			}
			
			
			
			if(isset($_POST['Regbtn']) and $_POST['employ_id']!="")
			{
			$this->UpdateEmploy();
			$this->UpdateEmpSecLog();
			print "<script>window.location.href='index.php?module=$_POST[module]&errorMsg=<font color=green>Password updated successfully</font>'</script>";
			//header('Location:index.php?module=emplist&errorMsg=<font color=green>Employee Information updated successfully</font>');
			}
			
			
			
					
	}
	
	
	
	
			
			public function SelectEmploy()
			{
			$this->empid = $this->MMdbobj->quote($_GET['emp_id']);
			$sql = $this->MMdbobj->query("select emp.* FROM tbl_emp emp where emp.emp_id={$this->empid}");
			$sendempinfo = $this->MMdbobj->fetch_assoc();
						
			return $sendempinfo;
			}
			
			
			
	
		
		public function UpdateEmploy()
		{
		
			
			$refno = $_POST['refno'];
			$this->empid = $this->MMdbobj->quote($_POST['employ_id']);
		
			$this->password = $this->MMdbobj->quote($_POST['password']);
			
						
			$sql = $this->MMdbobj->query("update tbl_emp set 
										password={$this->password} where emp_id={$this->empid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	
	private function UpdateEmpSecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$this->empid = $this->MMdbobj->quote($_POST['employ_id']);
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','Password changed with this Id $this->empid ','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
	
}

?>
