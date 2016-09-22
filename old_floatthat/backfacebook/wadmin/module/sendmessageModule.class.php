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
						
						
						if(isset($_POST['sndsms']) and $_POST['subject']!="")
						{
						$this->insertsms();
						$this->htmlObj->params['errorMsg'] = "<font color=green>Message sent successfully</font>";
						
						}
			}
	
			
		
		
		
	
		
		
	
	private function insertsms()
		{
	
			
			$filename = stripslashes($_FILES['file']['name']);
			
			$refno = date('mdys').rand(1,9);
			$contents=$filename;
			$target="../files/".$contents;
			move_uploaded_file($_FILES['file']['tmp_name'], $target);
			
			
			$this->subject = $this->MMdbobj->quote($_POST['subject']);
			$this->detail = $this->MMdbobj->quote($_POST['msg']);
			$this->emp_id=$_POST['emp_id'];
			$this->admin_id=$_SESSION['adminid'];
		
		 $sql = "insert into tbl_jobpro 
				(postedby,sendto,subject,msg,desig,status,files)
				values
				({$this->emp_id},{$this->admin_id},{$this->subject},{$this->detail},'admin',0,'$contents')";
				
				
				
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
	public function UpdateStatus()
		{
						
			$sql = $this->MMdbobj->query("update tbl_jobpro set status='1' where pro_id=$_GET[pro_id]");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	
}

?>
