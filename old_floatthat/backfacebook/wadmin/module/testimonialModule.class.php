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
			if(isset($_GET['newac']))
			{
			$this->UpdateStatus();
			}
			
			if(isset($_GET['new_id']))
			{
			$this->htmlObj->paramss['News']=$this->EditNews();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelNew();
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>Record deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['categ_id']=="")
			{
						
					$this->insertnews();
					
					$this->htmlObj->paramss['NewsList'] = $this-> getNews();
					$this->htmlObj->params['errorMsg'] = "<font color=green>Record created Successfully</font>";
					return false;
						
			}
			else if(isset($_POST['Regbtn']) and $_POST['categ_id']!="")
			{
			$this->UpdateNews();
			
			$this->htmlObj->params['errorMsg'] = "<font color=green>Record updated successfully</font>";
			}
			
			
			 
			$this->htmlObj->paramss['NewsList'] = $this-> getNews();
			
			
			
			
					
	}
	
	
		private function insertnews()
		{
	
			$this->name = $this->MMdbobj->quote($_POST['name']);
			$this->company = $this->MMdbobj->quote($_POST['company']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			$date=date('Y-m-d');
		
		 $sql = "insert into tbl_testimonial 
				(name,company,comments,status)
				values
				({$this->name},{$this->company},{$this->detail},{$this->status})";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getNews()
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
			
			$sql = $this->MMdbobj->query("SELECT * FROM tbl_testimonial limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
		public function DelNew()
		{
			$this->newid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_testimonial where t_id={$this->newid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditNews()
			{
			$this->catid = $this->MMdbobj->quote($_GET['new_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_testimonial where t_id={$this->catid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateNews()
		{
			$this->newid = $this->MMdbobj->quote($_POST['categ_id']);
			$this->name = $this->MMdbobj->quote($_POST['name']);
			$this->company = $this->MMdbobj->quote($_POST['company']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			
			
			$sql = $this->MMdbobj->query("update tbl_testimonial set name={$this->name},company={$this->company},comments={$this->detail},status={$this->status} where t_id={$this->newid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	public function UpdateStatus()
		{
			$this->catid = $this->MMdbobj->quote($_GET['newac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_testimonial set status={$this->st} where t_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
			
			
			
				
	
}

?>
