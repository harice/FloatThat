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
			
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>News deleted successfully</font>";
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
	
			$this->heading = $this->MMdbobj->quote($_POST['heading']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			$date=date('Y-m-d');
		
		 $sql = "insert into tbl_news 
				(heading,detail,date,status)
				values
				({$this->heading},{$this->detail},'$date',{$this->status})";
				
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
			
			$sql = $this->MMdbobj->query("SELECT news.* FROM tbl_news news limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
		public function DelNew()
		{
			$this->newid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_news where news_id={$this->newid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditNews()
			{
			$this->catid = $this->MMdbobj->quote($_GET['new_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_news where news_id={$this->catid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateNews()
		{
			$this->newid = $this->MMdbobj->quote($_POST['categ_id']);
			$this->heading = $this->MMdbobj->quote($_POST['heading']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			if($_POST['status']=='on'){ $this->status=1; } else { $this->status=0;}
			
			
			$sql = $this->MMdbobj->query("update tbl_news set heading={$this->heading},detail={$this->detail},status={$this->status} where news_id={$this->newid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	public function UpdateStatus()
		{
			$this->catid = $this->MMdbobj->quote($_GET['newac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_news set status={$this->st} where news_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
			
			
				
			
				
	
}

?>
