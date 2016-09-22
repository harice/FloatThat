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
			
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>Book deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['exams_id']=="")
			{
						
				if($this->isAvailable($name))
					{	
					$this->insertProducts();
					
						$this->htmlObj->params['errorMsg'] = "<font color=green>Product Created Successfully</font>";
					
						
				}
				else 
				{	
					$this->htmlObj->params['errorMsg'] = "<font color=red>Product allready exist agaisnt this Vendor</font>";
					
		
				}
			
			
			}
			else if(isset($_POST['Regbtn']) and $_POST['exams_id']!="")
			{
			$this->UpdateProducts();
			
			$this->htmlObj->params['errorMsg'] = "<font color=green>Product updated successfully</font>";
			}
			
			
			
			$getCategorylist = $this-> getProducts();
			$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
			
			
			$this->htmlObj->paramsc['CatInfo']=$this->getCategories();
			
					
	}
	
	
	private function isAvailable($name="")
	{
		if($name=="")
			$pname= $this->MMdbobj->quote($_POST['exname']);
			
			$catname= $_POST['c_id'];
			
		$sql = $this->MMdbobj->query("SELECT title FROM tbl_products WHERE title = $pname");
		$total = $this->MMdbobj->numRows();
		
		
		if($total==0)	
			return true;
		else
			return false;
	}
		

	
		private function insertProducts()
		{
	
			$this->exname = $this->MMdbobj->quote($_POST['exname']);
			
			$this->c_id = $this->MMdbobj->quote($_POST['c_id']);
			$this->price = $this->MMdbobj->quote($_POST['price']);
			$this->company = $this->MMdbobj->quote($_POST['company']);
			
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			$this->terms = $this->MMdbobj->quote($_POST['terms']);
			$this->fdate = $this->MMdbobj->quote($_POST['fdate']);
			
			$date=date('Y-m-d');
			
			if($_POST['featured']=='on'){ $this->featured=1; } else { $this->featured=0;}
			
			
			$folder1="products/".$_POST['c_id'];
		 
		 if($_FILES[userfile1][name]!="")
		 
		 {
		 
		 
			///////////////////////////////////////////////////////////////////////////
			
		
			$n_width=100; // Fix the width of the thumb nail images
			$n_height=130; // Fix the height of the thumb nail imaage
		$newfolder=	$folder1;
			if(!file_exists($newfolder)) 
				{ 
				mkdir($newfolder); 
				//echo "made"; 
				} 
				else 
				{ 
				//echo "already made"; 
				} 
				
				$add1=$newfolder."/".$_FILES[userfile1][name];
				
				
				$add=$newfolder."/".$_FILES[userfile1][name];
				if(move_uploaded_file ($_FILES[userfile1][tmp_name],$add))
				{
				//echo "Successfully uploaded the mage";
				chmod("$add",0755);
				
				}
				else
				{
				$this->htmlObj->params['errorMsgIMG']= "Failed to upload file Contact Site admin to fix the problem";
				
				}
		 $thumb=$_FILES[userfile1][name];
		 
		 $sql = "insert into tbl_products
				(c_id,title,price,status,thumb,date,detail,featured,terms,fdate)
				values
				({$this->c_id},{$this->exname},{$this->price},'1','$thumb','$date',{$this->detail},{$this->featured},{$this->terms},{$this->fdate})";
				
		
		}
		else
		{
		
		 $sql = "insert into tbl_products 
				(c_id,title,price,status,date,detail,featured,terms,fdate)
				values
				({$this->c_id},{$this->exname},{$this->price},'1','$date',{$this->detail},{$this->featured},{$this->terms},{$this->fdate})";
				
		
		}

		$this->MMdbobj->query($sql);
		
		if(!$this->MMdbobj->affectedRows())
			return false;
		
		return true;
		
		}
		
		
			public function getCategories()
		{
		
		
				$sql = $this->MMdbobj->query("SELECT * from tbl_category order by c_id ASC");
				$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
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
				$sql = $this->MMdbobj->query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where pro.title like '$catname%' and cat.c_id=pro.c_id or cat.title like '$catname%' and pro.c_id=cat.c_id order by cat.c_id ASC limit $eu, $limit");
				$sendcontents = $this->MMdbobj->fetchRows();
				}
				else
				{
				$sql = $this->MMdbobj->query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id order by cat.c_id ASC limit $eu, $limit ");
				$sendcontents = $this->MMdbobj->fetchRows();
				}			
			return $sendcontents;
			}
	
		
		public function DelProducts()
		{
			$this->exid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_products where pro_id={$this->exid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditProducts()
			{
				$this->exid = $this->MMdbobj->quote($_GET['ex_id']);
			
			$sql = $this->MMdbobj->query("select pro.*,cat.c_id FROM tbl_products pro,tbl_category cat where pro.pro_id={$this->exid} and cat.c_id=pro.c_id");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateProducts()
		{
	
			$this->ex_id = $this->MMdbobj->quote($_POST['exams_id']);
			$this->title = $this->MMdbobj->quote($_POST['exname']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			$this->terms = $this->MMdbobj->quote($_POST['terms']);
			$this->fdate = $this->MMdbobj->quote($_POST['fdate']);
			$this->c_id = $this->MMdbobj->quote($_POST['c_id']);
			$this->price = $this->MMdbobj->quote($_POST['price']);
			if($_POST['featured']=='on'){ $this->featured=1; } else { $this->featured=0;}
			$folder1="products/".$_POST['c_id'];
		 
		 if($_FILES[userfile1][name]!="")
		 
		 {
			///////////////////////////////////////////////////////////////////////////
			$newfolder=	$folder1;
			if(!file_exists($newfolder)) 
				{ 
				mkdir($newfolder); 
				//echo "made"; 
				} 
				else 
				{ 
				//echo "already made"; 
				} 
				
				
				$add=$newfolder."/".$_FILES[userfile1][name];
				if(move_uploaded_file ($_FILES[userfile1][tmp_name],$add))
				{
				//echo "Successfully uploaded the mage";
				chmod("$add",0755);
				
				}
				else
				{
				$this->htmlObj->params['errorMsgIMG']= "Failed to upload file Contact Site admin to fix the problem";
				
				}
			 $thumb=$_FILES[userfile1][name];	
			//////////////// End of JPG thumb
			
				$sql = $this->MMdbobj->query("update tbl_products set c_id={$this->c_id},title={$this->title},price={$this->price},thumb ='$thumb',detail={$this->detail},featured={$this->featured},terms={$this->terms},fdate={$this->fdate} where pro_id={$this->ex_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
		 }
			
			else
			{
				
				
			
			$sql = $this->MMdbobj->query("update tbl_products set c_id={$this->c_id},title={$this->title},price={$this->price},detail={$this->detail},featured={$this->featured},terms={$this->terms},fdate={$this->fdate} where pro_id={$this->ex_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
			}
						
			return true;
			}
			
			
			
	
	public function UpdateStatus()
		{
			$this->proid = $this->MMdbobj->quote($_GET['exmac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			
			$sql = $this->MMdbobj->query("update tbl_products set status={$this->st} where pro_id={$this->proid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
				
				
				
}

?>
