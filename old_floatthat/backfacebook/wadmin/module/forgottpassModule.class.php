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
		
			
			
			if(isset($_POST['passbtn']))
			{
						
				if($this->isExistPassword())
					{
					$Pass = $this->isExistPassword();
					 $this->htmlObj->paramss['Pass'] = $Pass;
						$to = $_POST['useremail'];
						$from_header = "From: $from";
				
						$subject ="Forgot Password request";
						$contents="Your login information is following \n";
						$contents.="Email : ".$to."\n";
						$contents.="Password : ".$Pass."\n";
						$contents.="\n";
						$contents.="Best Regard \n";
						$contents.="UKMPH team \n";
						 mail($to, $subject, $contents, $from_header);
					//$this->htmlObj->params['errorMsg'] = "<font color=green>Password is Exist.</font>";
					return true;
				}
				else 
				{
					$this->htmlObj->params['errorMsg'] = "<font color=red>This user is not exist</font>";
					return false;
		
				}
			
			
			}
			
					
	}
	
	
	private function isExistPassword()
		{
		if($name=="")
			$name= $this->MMdbobj->quote($_POST['useremail']);
			
			$sql = $this->MMdbobj->query("SELECT * FROM tbl_admin WHERE email = $name");
		
			$sendpassword = $this->MMdbobj->fetch_assoc();
			$total = $this->MMdbobj->numRows();
		
			if($total==1)
			
				return $sendpassword['password'];
			else
				return false;
		}
	
	
	
		
	
	
}

?>
