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
			if(isset($_GET['catac']))
			{
			$this->UpdateStatus();
			}
			
			if(isset($_GET['cat_id']))
			{
			$this->htmlObj->paramss['Catname']=$this->EditCategory();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelCategory();
			$this->DelSecLog();
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>Job deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['career_id']=="")
			{
						$this->insertcareer();
						
						$getCategorylist = $this->getCareers();
						$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
						$this->htmlObj->params['errorMsg'] = "<font color=green>Job Created Successfully</font>";
						return false;
						
			
			}
			else if(isset($_POST['Regbtn']) and $_POST['career_id']!="")
			{
			$this->UpdateCategory();
			$this->UpdateSecLog();
			$this->htmlObj->params['errorMsg'] = "<font color=green>Job updated successfully</font>";
			}
			
			
			
			$getCategorylist = $this->getCareers();
			$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
			
			
			
			
					
	}
	
	
	
	
		private function insertcareer()
		{
	
			$this->jobname = $this->MMdbobj->quote($_POST['jobname']);
			$this->posts = $this->MMdbobj->quote($_POST['posts']);
			$this->salary = $this->MMdbobj->quote($_POST['salary']);
			$this->qualification = $this->MMdbobj->quote($_POST['qualification']);
			$this->skils = $this->MMdbobj->quote($_POST['skils']);
			$this->workexp = $this->MMdbobj->quote($_POST['workexp']);
			$this->lastdate = $this->MMdbobj->quote($_POST['lastdate']);
			$date=date('Y-m-d');
			$this->nature=$this->MMdbobj->quote($_POST['nature']);
			
		
		$sql = "insert into tbl_careers 
				(date,jobname,posts,salary,qualification,skils,workexp,lastdate,status,natureofjob)
				values
				('$date',{$this->jobname},{$this->posts},{$this->salary},{$this->qualification},{$this->skils},{$this->workexp},{$this->lastdate},'1',{$this->nature})";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getCareers()
		{
		
		$start=$_GET['start'];
			if(!isset($start)) {                         // This variable is set to zero for the first page
			$start = 0;
			}	
			$eu = ($start - 0); 
			$limit = 15;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 	
			
				
				$sql = $this->MMdbobj->query("SELECT * FROM tbl_careers order by cr_id DESC limit $eu, $limit ");
				$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
		public function DelCategory()
		{
			$this->catid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_careers where cr_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditCategory()
			{
			$this->catid = $this->MMdbobj->quote($_GET['cat_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_careers where cr_id={$this->catid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateCategory()
		{
			$this->jobname = $this->MMdbobj->quote($_POST['jobname']);
			$this->posts = $this->MMdbobj->quote($_POST['posts']);
			$this->salary = $this->MMdbobj->quote($_POST['salary']);
			$this->qualification = $this->MMdbobj->quote($_POST['qualification']);
			$this->skils = $this->MMdbobj->quote($_POST['skils']);
			$this->workexp = $this->MMdbobj->quote($_POST['workexp']);
			$this->lastdate = $this->MMdbobj->quote($_POST['lastdate']);
			$this->nature=$this->MMdbobj->quote($_POST['nature']);
			
			$sql = $this->MMdbobj->query("update tbl_careers set jobname={$this->jobname},posts={$this->posts},salary={$this->salary},qualification={$this->qualification},skils={$this->skils},workexp={$this->workexp},lastdate={$this->lastdate},natureofjob={$this->nature} where cr_id=$_POST[career_id]");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	public function UpdateStatus()
		{
			$this->catid = $this->MMdbobj->quote($_GET['catac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_careers set status={$this->st} where cr_id={$this->catid}");
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
							('$ip','$adid','$name','New job category $catname added','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
				private function DelSecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','Delete category with this id $_GET[del_id]','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
				private function UpdateSecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','Updated job category with this id $_POST[categ_id]','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
				
}

?>
