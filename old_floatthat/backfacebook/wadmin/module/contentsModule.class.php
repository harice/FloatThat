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
			
			
			if(isset($_GET['content_id']))
			{
			$this->htmlObj->paramss['Catname']=$this->EditContents();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelContents();
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>contents deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['content_id']=="")
			{
						
				if($this->isAvailable($name))
					{	
					$this->insertContents();
					
					$getCategorylist = $this-> getContents();
					$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
						$this->htmlObj->params['errorMsg'] = "<font color=green>contents Created Successfully</font>";
						return false;
						
				}
				else 
				{	
					$getCategorylist = $this-> getContents();
					$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
					$this->htmlObj->params['errorMsg'] = "<font color=red>contents allready exist agaisnt this menu</font>";
					return false;
		
				}
			
			
			}
			else if(isset($_POST['Regbtn']) and $_POST['content_id']!="")
			{
			$this->UpdateContents();
			
			$this->htmlObj->params['errorMsg'] = "<font color=green>Contents updated successfully</font>";
			}
			
			
			
			$getCategorylist = $this-> getContents();
			$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
			$this->htmlObj->paramsc['CatInfo']=$this->SelectMainMenu();
				
			
					
	}
	
	
	private function isAvailable($name="")
	{
		if($name=="")
			$pname= $this->MMdbobj->quote($_POST['exname']);
			
			$menu_id= $_POST['m_id'];
			
		$sql = $this->MMdbobj->query("SELECT m_id FROM tbl_contents WHERE m_id = $menu_id");
		$total = $this->MMdbobj->numRows();
		
		
		if($total==0)	
			return true;
		else
			return false;
	}
		

	
		private function insertContents()
		{
	
			
			$this->m_id = $this->MMdbobj->quote($_POST['m_id']);
			
			$this->contents = $this->MMdbobj->quote($_POST['contents']);
			
		
		 $sql = "insert into tbl_contents
				(m_id,contents)
				values
				({$this->m_id},{$this->contents})";
		
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getContents()
		{
		
		$start=$_GET['start'];
			
				$sql = $this->MMdbobj->query("SELECT content.*,menu.m_id,menu.mainmenu FROM tbl_contents content,tbl_mainmenu menu where menu.m_id=content.m_id order by content.content_id ASC");
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
			
			
			public function EditContents()
			{
				$this->content = $this->MMdbobj->quote($_GET['content_id']);
			
			$sql = $this->MMdbobj->query("select content.*,menu.m_id,menu.mainmenu FROM tbl_contents content,tbl_mainmenu menu where content.content_id={$this->content} and menu.m_id=content.m_id");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateContents()
		{
	
			$this->content_id = $this->MMdbobj->quote($_POST['content_id']);
			$this->contents = $this->MMdbobj->quote($_POST['contents']);
			$this->m_id = $this->MMdbobj->quote($_POST['m_id']);
			
			$sql = $this->MMdbobj->query("update tbl_contents set m_id={$this->m_id},contents={$this->contents} where content_id={$this->content_id}");
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
