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
		
			// $_SESSION['Counter']=$this->getcounter();
			
			if(isset($_POST['loginbtn']))
			{
							
				if($this->isExist($name))
				{
				//	$this->SecLog();
					$Email = $this->isExist($name);
					 $this->htmlObj->paramss['Email'] = $Email;
					
						session_register('adminemail');
						session_register('adminid');
						$_SESSION['adminemail']=$this->htmlObj->paramss['Email']['useremail'];	
						$_SESSION['adminid']=$this->htmlObj->paramss['Email']['ad_id'];	
						
					return false;
				}
				else 
				{
					// $this->WrongSecLog();
					 $this->htmlObj->params['errorMsg'] = "<font color='red' >Invalid username or password Please try again</font>";
					//echo $this->htmlObj->params['errorMsg'];
					
				/*	session_register('errorMsg');
					$_SESSION['errorMsg']="<font color='red' >This user is not exist.</font>";
					*/
					return false;
		
				}
			}
			
				if(isset($_GET['logout']) && $_GET['logout']=="logout")
					{
					
					unset($_SESSION['adminemail']);
					unset($_SESSION['adminid']);
					print "<script>window.location.href='../index.php?module=homepage'</script>";
						
					}
			
			
					
	}
	
	
	
	private function isExist($name="")
	{
		if($name=="")
			$name= $this->MMdbobj->quote($_POST['useremail']);
			$password= $this->MMdbobj->quote($_POST['password']);
			
		
		 $sql = $this->MMdbobj->query("SELECT * FROM tbl_admin WHERE userid = $name and password=$password");
		$sendademail = $this->MMdbobj->fetch_assoc();
		$total = $this->MMdbobj->numRows();
	
		if($total==1)	
			return $sendademail;
		else
			return false;
	}
	
	
	/*private function SecLog()
	{
	$ip=@$REMOTE_ADDR; 
		$adid=$_SESSION['adminid'];	
		$name=$_SESSION['fname'];
		$date=date('Y-m-d G:i:s');
		$sql = "insert into tbl_seclogs 
				(ipadress,userid,username,action,date)
				values
				('$ip','$adid','$name','loged in successfully','$date')";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
	}
	
	private function WrongSecLog()
	{
	$ip=@$REMOTE_ADDR; 
		$adid=$_SESSION['adminid'];	
		$name= $_POST['useremail'];
			$password= $_POST['password'];
			$date=date('Y-m-d G:i:s');
		 $sql = "insert into tbl_seclogs 
				(ipadress,userid,username,action,date)
				values
				('$ip','$adid','$name','wrong atempt with userid = $name and password = $password','$date')";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
	}*/
	
	

public function getcounter()
		{
		
			$sql = $this->MMdbobj->query("SELECT counterfield FROM tbl_counter");
			$sendcount = $this->MMdbobj->fetch_assoc();
						
			return $sendcount;
			}
	
		
	
	
}


?>
