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
			if(isset($_GET['exmac']))
			{
			$this->UpdateStatus();
			}
			
			if(isset($_GET['ex_id']))
			{
			$this->htmlObj->paramss['Catname']=$this->EditProducts();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelProducts();
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>Exam deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['exams_id']=="")
			{
						
				if($this->isAvailable($name))
					{	
					$this->insertProducts();
					
					$getCategorylist = $this-> getProducts();
					$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
						$this->htmlObj->params['errorMsg'] = "<font color=green>Exam Created Successfully</font>";
						return false;
						
				}
				else 
				{	
					$getCategorylist = $this-> getProducts();
					$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
					$this->htmlObj->params['errorMsg'] = "<font color=red>Exam allready exist agaisnt this Vendor</font>";
					return false;
		
				}
			
			
			}
			else if(isset($_POST['Regbtn']) and $_POST['exams_id']!="")
			{
			$this->UpdateProducts();
			
			$this->htmlObj->params['errorMsg'] = "<font color=green>Product updated successfully</font>";
			}
			
			
			
			$getCategorylist = $this-> getProducts();
			$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
			
					
	}
	
	
	private function isAvailable($name="")
	{
		if($name=="")
			$pname= $this->MMdbobj->quote($_POST['exname']);
			
			
			
		$sql = $this->MMdbobj->query("SELECT exname FROM tbl_demoexams WHERE exname = $pname");
		$total = $this->MMdbobj->numRows();
		
		
		if($total==0)	
			return true;
		else
			return false;
	}
		
	
	
	
	
		private function insertProducts()
		{
	
			$this->exname = $this->MMdbobj->quote($_POST['exname']);
			
			
			$this->price = $this->MMdbobj->quote($_POST['price']);
			$this->company = $this->MMdbobj->quote($_POST['company']);
			
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			if($_POST['hot']=='on'){ $this->hot=1; } else { $this->hot=0;}
			$date=date('Y-m-d');
			
			
			
			$folder="papers/demoexams";
		 
		 if($_FILES[userfile][name]!="")
		 
		 {
		 
		 
			///////////////////////////////////////////////////////////////////////////
			$imname=$_FILES[userfile][name];
			if(!file_exists($folder)) 
				{ 
				mkdir($folder); 
				//echo "made"; 
				} 
				else 
				{ 
				//echo "already made"; 
				} 

			$add=$folder."/".$_FILES[userfile][name]; // the path with the file name where the file will be stored, upload is the directory name.
			//echo $add;
				if(move_uploaded_file ($_FILES[userfile][tmp_name],$add))
				{
				//echo "Successfully uploaded the mage";
				chmod("$add",0777);
				
				}
				else
				{
				$this->htmlObj->params['errorMsgIMG']= "Failed to upload file Contact Site admin to fix the problem";
				
				}
			
		 
		 
		 $sql = "insert into tbl_demoexams 
				(exname,status,attachments,date)
				values
				({$this->exname},'1','$imname','$date')";
				
		
		}
		else
		{
		
		 $sql = "insert into tbl_demoexams 
				(exname,status,date)
				values
				({$this->exname},'1','$date')";
				
		
		}
		
		
		
		
		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
		public function getProducts()
		{
		
		$start=$_GET['start'];
			if(!isset($start)) {                         // This variable is set to zero for the first page
			$start = 0;
			}	
			$eu = ($start - 0); 
			$limit = 20;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 	
			
				if(isset($_POST['srcbtn']))
				{
				$catname=$_POST['pname'];
				$sql = $this->MMdbobj->query("SELECT pro.* FROM tbl_demoexams pro where pro.exname like '%$catname%' order by pro.ex_id ASC limit $eu, $limit ");
				$sendcontents = $this->MMdbobj->fetchRows();
				}
				else
				{
				$sql = $this->MMdbobj->query("SELECT pro.* FROM tbl_demoexams pro order by pro.ex_id ASC limit $eu, $limit ");
				$sendcontents = $this->MMdbobj->fetchRows();
				}			
			return $sendcontents;
			}
	
		public function DelProducts()
		{
			$this->exid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_demoexams where ex_id={$this->exid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditProducts()
			{
				$this->exid = $this->MMdbobj->quote($_GET['ex_id']);
			
			$sql = $this->MMdbobj->query("select pro.* FROM tbl_demoexams pro where pro.ex_id={$this->exid}");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateProducts()
		{
			
			
			$this->ex_id = $this->MMdbobj->quote($_POST['exams_id']);
			$this->exname = $this->MMdbobj->quote($_POST['exname']);
			
			$folder="papers/demoexams";
			
			 if($_FILES[userfile][name]!="")
		 
		 {
		 
		 
			///////////////////////////////////////////////////////////////////////////
			$imname=$_FILES[userfile][name];
			if(!file_exists($folder)) 
				{ 
				mkdir($folder); 
				//echo "made"; 
				} 
				else 
				{ 
				//echo "already made"; 
				} 

			$add=$folder."/".$_FILES[userfile][name]; // the path with the file name where the file will be stored, upload is the directory name.
			//echo $add;
				if(move_uploaded_file ($_FILES[userfile][tmp_name],$add))
				{
				//echo "Successfully uploaded the mage";
				chmod("$add",0777);
				
				}
				else
				{
				$this->htmlObj->params['errorMsgIMG']= "Failed to upload file Contact Site admin to fix the problem";
				
				}
				$sql = $this->MMdbobj->query("update tbl_demoexams set exname={$this->exname},attachments='$imname' where ex_id={$this->ex_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
		 }
			
			
			
			$sql = $this->MMdbobj->query("update tbl_demoexams set exname={$this->exname} where ex_id={$this->ex_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
			
	
	public function UpdateStatus()
		{
			$this->proid = $this->MMdbobj->quote($_GET['exmac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			
			$sql = $this->MMdbobj->query("update tbl_demoexams set status={$this->st} where ex_id={$this->proid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
				
				
				
}

?>
