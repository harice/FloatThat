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
			if(isset($_GET['faqac']))
			{
			$this->UpdateStatus();
			}
			
			if(isset($_GET['faq_id']))
			{
			$this->htmlObj->paramss['FAQ']=$this-> EditFaq();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelFAQ();
			$this->DeleteNewSecLog();
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>Record deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['FAQ_id']=="")
			{
						
					$this->insertfaq();
					 $this->AddNewSecLog();
					$this->htmlObj->paramss['FaqList'] = $this-> getFaq();
					$this->htmlObj->params['errorMsg'] = "<font color=green>Record created Successfully</font>";
					return false;
						
			}
			else if(isset($_POST['Regbtn']) and $_POST['FAQ_id']!="")
			{
			$this->UpdateFAQ();
			 $this->UpdateNewSecLog();
			$this->htmlObj->params['errorMsg'] = "<font color=green>Record updated successfully</font>";
			}
			
			
			 
			$this->htmlObj->paramss['FaqList'] = $this-> getFaq();
			
			
			
			
					
	}
	
	
		private function insertfaq()
		{
	
			$this->question = $this->MMdbobj->quote($_POST['question']);
			$this->answer = $this->MMdbobj->quote($_POST['answer']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			$date=date('Y-m-d');
		
		 $sql = "insert into tbl_faq 
				(question,answers,status)
				values
				({$this->question},{$this->answer},{$this->status})";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getFaq()
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
			
			$sql = $this->MMdbobj->query("SELECT * FROM tbl_faq limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
		public function DelFAQ()
		{
			$this->fqid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_faq where fq_id={$this->fqid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditFaq()
			{
			$this->catid = $this->MMdbobj->quote($_GET['faq_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_faq where fq_id={$this->catid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateFAQ()
		{
			$this->fqid = $this->MMdbobj->quote($_POST['FAQ_id']);
			$this->question = $this->MMdbobj->quote($_POST['question']);
			$this->answer = $this->MMdbobj->quote($_POST['answer']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			
			
			$sql = $this->MMdbobj->query("update tbl_faq set question={$this->question},answers={$this->answer},status={$this->status} where fq_id={$this->fqid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	public function UpdateStatus()
		{
			$this->catid = $this->MMdbobj->quote($_GET['faqac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_faq set status={$this->st} where fq_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
			
			
			private function AddNewSecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','Added FAQ with this question $_POST[question] ','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
				
				private function UpdateNewSecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','updated FAQ with this question $_POST[question] ','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
				
				
				private function DeleteNewSecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','Deleted FAQ with this id $_GET[del_id] ','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
				
	
}

?>
