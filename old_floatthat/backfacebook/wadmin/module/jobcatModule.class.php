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
				$this->htmlObj->params['errorMsgDel'] = "<font color=red>Category deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['categ_id']=="")
			{
						
				if($this->isAvailable($name))
					{	
					$this->insertcat();
					$getMenulist = $this-> getMenu();
					$this->htmlObj->paramss['MenueList'] = $getMenulist;
						$this->htmlObj->params['errorMsg'] = "<font color=green>Menu Created Successfully</font>";
						return false;
						
				}
				else 
				{	
					$getMenulist = $this-> getMenu();
					$this->htmlObj->paramss['MenueList'] = $getMenulist;
					$this->htmlObj->params['errorMsg'] = "<font color=red>Menu allready exist</font>";
					return false;
		
				}
			
			
			}
			else if(isset($_POST['Regbtn']) and $_POST['categ_id']!="")
			{
			$this->UpdateCategory();
			$this->htmlObj->params['errorMsg'] = "<font color=green>Menu updated successfully</font>";
			}
			
			$getMenulist = $this-> getMenu();
			$this->htmlObj->paramss['MenueList'] = $getMenulist;
			
			
			
			
					
	}
	
	
	private function isAvailable($name="")
	{
		if($name=="")
			$menu= $this->MMdbobj->quote($_POST['menu']);
			
		$sql = $this->MMdbobj->query("SELECT mainmenu FROM tbl_mainmenu WHERE mainmenu = $menu");
		$total = $this->MMdbobj->numRows();
		
		
		if($total==0)	
			return true;
		else
			return false;
	}
		
	
	
	
	
		private function insertcat()
		{
	
			$this->vendor = $this->MMdbobj->quote($_POST['menu']);
			
		
		  $sql = "insert into tbl_mainmenu 
				(mainmenu,status)
				values
				({$this->vendor},1)";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getMenu()
		{
				$sql = $this->MMdbobj->query("SELECT cat.* FROM tbl_mainmenu cat order by cat.m_id ASC");
				$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
		public function DelCategory()
		{
			$this->catid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_mainmenu where m_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditCategory()
			{
			$this->catid = $this->MMdbobj->quote($_GET['cat_id']);
			$sql = $this->MMdbobj->query("select * FROM tbl_mainmenu where m_id={$this->catid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateCategory()
		{
			$this->catid = $this->MMdbobj->quote($_POST['categ_id']);
			$this->menu = $this->MMdbobj->quote($_POST['menu']);
			
				$sql = $this->MMdbobj->query("update tbl_mainmenu set mainmenu={$this->menu} where m_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
	
	public function UpdateStatus()
		{
			$this->catid = $this->MMdbobj->quote($_GET['catac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			$sql = $this->MMdbobj->query("update tbl_mainmenu set status={$this->st} where m_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
				
				
				
}

?>
