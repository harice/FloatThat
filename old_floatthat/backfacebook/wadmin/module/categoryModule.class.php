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
			
			
			if(isset($_GET['cat_id']))
			{
			$this->htmlObj->paramss['Catname']=$this->EditCategory();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelCategory();
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>Category deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['categ_id']=="")
			{
						$this->insertcat();
					$this->htmlObj->params['errorMsg'] = "<font color=green>Category Created Successfully</font>";
						
					
			}
			else if(isset($_POST['Regbtn']) and $_POST['categ_id']!="")
			{
			$this->UpdateCategory();
		
			$this->htmlObj->params['errorMsg'] = "<font color=green>Gallery updated successfully</font>";
			}
			
			
			
			$getCategorylist = $this-> getCategory();
			$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
							
	}
	

	
	
	
	
		private function insertcat()
		{
	
			$this->title = $this->MMdbobj->quote($_POST['catname']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			$inst_id=$_REQUEST['in_id'];
		
		 $sql = "insert into tbl_category 
				(title)
				values
				({$this->title})";
				
		$this->MMdbobj->query($sql);
		
		
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getCategory()
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
			
				$sql = $this->MMdbobj->query("SELECT cat.* FROM tbl_category cat order by cat.c_id ASC limit $eu, $limit ");
				$sendcontents = $this->MMdbobj->fetchRows();
					
			return $sendcontents;
			}
	
		
		
		
		public function DelCategory()
		{
			$this->catid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_category where c_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditCategory()
			{
			$this->catid = $this->MMdbobj->quote($_GET['cat_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_category where c_id={$this->catid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateCategory()
		{
			$this->catid = $this->MMdbobj->quote($_POST['categ_id']);
			$this->title = $this->MMdbobj->quote($_POST['catname']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
		
			
			$sql = $this->MMdbobj->query("update tbl_category set title={$this->title} where c_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
			
			
			return true;
			}
			
	
	
				
}

?>
