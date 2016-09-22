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
			if(isset($_GET['userac']))
			{
			$this->UpdateStatus();
			}
			
			if(isset($_GET['ad_id']))
			{
			$this->htmlObj->paramss['User']=$this->EditUser();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelUser();
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>User deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['categ_id']=="")
			{
					if($this->isAvailable($name))
					{	
					$this->insertuser();
					$this->htmlObj->paramss['UserList'] = $this-> getUsers();
					$this->htmlObj->params['errorMsg'] = "<font color=green>User created Successfully</font>";
					return false;
					}
					else
					{
					$this->htmlObj->paramss['UserList'] = $this-> getUsers();
					$this->htmlObj->params['errorMsg'] = "<font color=red>user allready exist</font>";
					return false;
					
					}
						
			}
			else if(isset($_POST['Regbtn']) and $_POST['categ_id']!="")
			{
			$this->UpdateUser();
			$this->htmlObj->params['errorMsg'] = "<font color=green>Unser information updated successfully</font>";
			}
			
			
			 
			$this->htmlObj->paramss['UserList'] = $this-> getUsers();
			
			
			
			
					
	}
	
	
		private function insertuser()
		{
	
			$this->name = $this->MMdbobj->quote($_POST['name']);
			$this->email = $this->MMdbobj->quote($_POST['email']);
			$this->userid = $this->MMdbobj->quote($_POST['userid']);
			$this->password = $this->MMdbobj->quote($_POST['password']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			
			if($_POST['selrec']=='on'){ $this->selrec=1; } else { $this->selrec=0;}
			if($_POST['editrec']=='on'){ $this->editrec=1; } else { $this->editrec=0;}
			if($_POST['delrec']=='on'){ $this->delrec=1; } else { $this->delrec=0;}
			$this->role = $_POST['role'];
			$date=date('Y-m-d');
		
		 $sql = "insert into tbl_admin 
				(name,email,userid,password,date,status,selrec,editrec,delrec,role)
				values
				({$this->name},{$this->email},{$this->userid},{$this->password},'$date',{$this->status},{$this->selrec},{$this->editrec},{$this->delrec},'$this->role')";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getUsers()
		{
		
			$sql = $this->MMdbobj->query("SELECT * FROM tbl_admin");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
		public function DelUser()
		{
			$this->adid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_admin where ad_id={$this->adid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditUser()
			{
			$this->adid = $this->MMdbobj->quote($_GET['ad_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_admin where ad_id={$this->adid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateUser()
		{
			$this->name = $this->MMdbobj->quote($_POST['name']);
			$this->email = $this->MMdbobj->quote($_POST['email']);
			$this->userid = $this->MMdbobj->quote($_POST['userid']);
			$this->password = $this->MMdbobj->quote($_POST['password']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			
			if($_POST['selrec']=='on'){ $this->selrec=1; } else { $this->selrec=0;}
			if($_POST['editrec']=='on'){ $this->editrec=1; } else { $this->editrec=0;}
			if($_POST['delrec']=='on'){ $this->delrec=1; } else { $this->delrec=0;}
			$this->adid=$this->MMdbobj->quote($_POST['categ_id']);
			$this->role = $_POST['role'];
			$sql = $this->MMdbobj->query("update tbl_admin set name={$this->name},email={$this->email},userid={$this->userid},password={$this->password},status={$this->status},selrec={$this->selrec},editrec={$this->editrec},delrec={$this->delrec},role='$this->role' where ad_id={$this->adid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	public function UpdateStatus()
		{
			$this->catid = $this->MMdbobj->quote($_GET['userac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_admin set status={$this->st} where ad_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	private function isAvailable($name="")
	{
		if($name=="")
			$email= $this->MMdbobj->quote($_POST['email']);
			
		$sql = $this->MMdbobj->query("SELECT email FROM tbl_admin WHERE email = $email");
		$total = $this->MMdbobj->numRows();
		
		
		if($total==0)	
			return true;
		else
			return false;
	}
			
	
}

?>
