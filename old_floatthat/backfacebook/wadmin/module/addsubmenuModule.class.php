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
			
			
			if(isset($_GET['m_id']))
			{
			$this->htmlObj->paramss['Catname']=$this->EditMenu();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelContents();
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>contents deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['submenu_id']=="")
			{
					$this->insertcat();
						$this->htmlObj->params['errorMsg'] = "<font color=green>Sub Menu Created Successfully</font>";
				}
			else if(isset($_POST['Regbtn']) and $_POST['submenu_id']!="")
			{
			$this->Updatesubmenu();
			
			$this->htmlObj->params['errorMsg'] = "<font color=green>Submenu updated successfully</font>";
			}
			
			
			
			$getCategorylist = $this-> getMenu();
			$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
			
			$this->htmlObj->paramsc['CatInfo']=$this->SelectMainMenu();
				
			
					
	}
	
	
	
		private function insertcat()
		{
	
			$this->menu = $this->MMdbobj->quote($_POST['submenu']);
			$m_id=$_REQUEST['m_id'];
			
		
		  $sql = "insert into tbl_mainmenu 
				(mainmenu,status,sub_id)
				values
				({$this->menu},1,$m_id)";
				
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		public function getMenu()
		{
				$sql = $this->MMdbobj->query("SELECT cat.* FROM tbl_mainmenu cat where sub_id!='0' order by cat.m_id ASC");
				$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
		
		public function DelContents()
		{
			$this->cid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_contents where content_id={$this->cid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditMenu()
			{
				$sql = $this->MMdbobj->query("select * FROM tbl_mainmenu  where m_id=$_REQUEST[m_id]");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function Updatesubmenu()
		{
	
			$this->m_id = $this->MMdbobj->quote($_POST['m_id']);
			$this->submenu_id = $_POST['submenu_id'];
			$this->submenu = $this->MMdbobj->quote($_POST['submenu']);
			
			$sql = $this->MMdbobj->query("update tbl_mainmenu set sub_id={$this->m_id},mainmenu={$this->submenu} where m_id=$this->submenu_id");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
			public function SelectMainMenu()
			{
			
			$sql = $this->MMdbobj->query("select * FROM tbl_mainmenu where status=1");
			$sendcatinfo = $this->MMdbobj->fetchRows();
						
			return $sendcatinfo;
			}
	
			
	
				
}

?>
