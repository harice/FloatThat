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
			if(isset($_GET['proac']))
			{
			$this->UpdateStatus();
			}
			
			if(isset($_GET['pro_id']))
			{
			$this->htmlObj->paramss['Catname']=$this->EditProducts();
			}
			
			if(isset($_GET['del_id']))
			{
			$this->DelProducts();
			$this->DelSecLog();
			$this->htmlObj->params['errorMsgDel'] = "<font color=red>Product deleted successfully</font>";
			}
			
			
			if(isset($_POST['Regbtn']) and $_POST['products_id']=="")
			{
						
				if($this->isAvailable($name))
					{	
					$this->insertProducts();
					$this->SecLog();
					$getCategorylist = $this-> getProducts();
					$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
						$this->htmlObj->params['errorMsg'] = "<font color=green>Product Created Successfully</font>";
						return false;
						
				}
				else 
				{	
					$getCategorylist = $this-> getProducts();
					$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
					$this->htmlObj->params['errorMsg'] = "<font color=red>Product allready exist agaisnt this category</font>";
					return false;
		
				}
			
			
			}
			else if(isset($_POST['Regbtn']) and $_POST['products_id']!="")
			{
			$this->UpdateProducts();
			$this->UpdateSecLog();
			$this->htmlObj->params['errorMsg'] = "<font color=green>Product updated successfully</font>";
			}
			
			
			
			$getCategorylist = $this-> getProducts();
			$this->htmlObj->paramss['CategoryList'] = $getCategorylist;
			$this->htmlObj->paramsc['CatInfo']=$this->SelectCateg();
			
			
			
					
	}
	
	
	private function isAvailable($name="")
	{
		if($name=="")
			$pname= $this->MMdbobj->quote($_POST['pname']);
			
			$catname= $_POST['cat_id'];
			
		$sql = $this->MMdbobj->query("SELECT pname FROM tbl_books WHERE pname = $pname and cat_id=$catname");
		$total = $this->MMdbobj->numRows();
		
		
		if($total==0)	
			return true;
		else
			return false;
	}
		
	
	
	
	
		private function insertProducts()
		{
	
			$this->pname = $this->MMdbobj->quote($_POST['pname']);
			
			$this->cat_id = $this->MMdbobj->quote($_POST['cat_id']);
			$this->price = $this->MMdbobj->quote($_POST['price']);
			$this->company = $this->MMdbobj->quote($_POST['company']);
			
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			if($_POST['hot']=='on'){ $this->hot=1; } else { $this->hot=0;}
			$date=date('Y-m-d');
			$this->image=$this->MMdbobj->quote($_POST['file']);
		 
			///////////////////////////////////////////////////////////////////////////
			$imname=$_FILES[userfile][name];
			$add="upimg/".$_FILES[userfile][name]; // the path with the file name where the file will be stored, upload is the directory name.
			//echo $add;
			if(move_uploaded_file ($_FILES[userfile][tmp_name],$add)){
			//echo "Successfully uploaded the mage";
			chmod("$add",0777);
			
			}
			else
			{
			$this->htmlObj->params['errorMsgIMG']= "Failed to upload file Contact Site admin to fix the problem";
			
			}
			
			///////// Start the thumbnail generation//////////////
			$n_width=100; // Fix the width of the thumb nail images
			$n_height=100; // Fix the height of the thumb nail imaage
			
			$tsrc="thimg/".$_FILES[userfile][name]; // Path where thumb nail image will be stored
			//echo $tsrc;
			if (!($_FILES[userfile][type] =="image/jpeg" OR $_FILES[userfile][type]=="image/gif")){echo "Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
			exit;}
					 
					//////////// Starting of GIF thumb nail creation///////////
			if (@$_FILES[userfile][type]=="image/gif")
			{
			$im=ImageCreateFromGIF($add);
			$width=ImageSx($im); // Original picture width is stored
			$height=ImageSy($im); // Original picture height is stored
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			if (function_exists("imagegif")) {
			Header("Content-type: image/gif");
			ImageGIF($newimage,$tsrc);
			}
			elseif (function_exists("imagejpeg")) {
			Header("Content-type: image/jpeg");
			ImageJPEG($newimage,$tsrc);
			}
			chmod("$tsrc",0777);
			}////////// end of gif file thumb nail creation//////////
			
			////////////// starting of JPG thumb nail creation//////////
			if($_FILES[userfile][type]=="image/jpeg"){
			$im=ImageCreateFromJPEG($add);
			$width=ImageSx($im); // Original picture width is stored
			$height=ImageSy($im); // Original picture height is stored
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImageJpeg($newimage,$tsrc);
			chmod("$tsrc",0777);
			}
			//////////////// End of JPG thumb nail creation ////////// 
		 
		 
		 
		 $sql = "insert into tbl_books 
				(cat_id,pname,company,detail,price,image,status,hot,date)
				values
				({$this->cat_id},{$this->pname},{$this->company},{$this->detail},{$this->price},'$imname',1,{$this->hot},'$date')";
				
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
			$limit = 15;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 	
			
				if(isset($_POST['srcbtn']))
				{
				$catname=$_POST['pname'];
				$sql = $this->MMdbobj->query("SELECT pro.*,cat.cat_id,cat.catname FROM tbl_books pro,tbl_category cat where pro.pname like '%$catname%' and cat.cat_id=pro.cat_id or cat.catname like '%$catname%' and pro.cat_id=cat.cat_id order by pro.pro_id DESC limit $eu, $limit ");
				$sendcontents = $this->MMdbobj->fetchRows();
				}
				else
				{
				$sql = $this->MMdbobj->query("SELECT pro.*,cat.cat_id,cat.catname FROM tbl_books pro,tbl_category cat where pro.cat_id='$_GET[cat_id]' and cat.cat_id=pro.cat_id order by pro.pro_id DESC limit $eu, $limit ");
				$sendcontents = $this->MMdbobj->fetchRows();
				}			
			return $sendcontents;
			}
	
		public function DelProducts()
		{
			$this->catid = $this->MMdbobj->quote($_GET['del_id']);
			$sql = $this->MMdbobj->query("delete FROM tbl_books where pro_id={$this->catid}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			}
			
			
			public function EditProducts()
			{
			$this->catid = $this->MMdbobj->quote($_GET['pro_id']);
			$sql = $this->MMdbobj->query("select pro.*,cat.cat_id,cat.catname FROM tbl_books pro,tbl_category cat where pro.pro_id={$this->catid} and cat.cat_id=pro.cat_id");
			$sendpassword = $this->MMdbobj->fetch_assoc();
						
			return $sendpassword;
			}
	
		
		public function UpdateProducts()
		{
			
			
			$this->pro_id = $this->MMdbobj->quote($_POST['products_id']);
			$this->pname = $this->MMdbobj->quote($_POST['pname']);
			$this->company = $this->MMdbobj->quote($_POST['company']);
			$this->price = $this->MMdbobj->quote($_POST['price']);
			$this->detail = $this->MMdbobj->quote($_POST['detail']);
			$this->cat_id = $this->MMdbobj->quote($_POST['cat_id']);
			if($_POST['hot']=='on'){ $this->hot=1; } else { $this->hot=0;}
			
			
			if($_FILES[userfile]!="")
			{
			///////////////////////////////////////////////////////////////////////////
			$imname=$_FILES[userfile][name];
			$add="upimg/".$_FILES[userfile][name]; // the path with the file name where the file will be stored, upload is the directory name.
			//echo $add;
			if(move_uploaded_file ($_FILES[userfile][tmp_name],$add)){
			//echo "Successfully uploaded the mage";
			chmod("$add",0777);
			
			}
			else
			{
			$this->htmlObj->params['errorMsgIMG']= "Failed to upload file Contact Site admin to fix the problem";
			
			}
			
			///////// Start the thumbnail generation//////////////
			$n_width=100; // Fix the width of the thumb nail images
			$n_height=100; // Fix the height of the thumb nail imaage
			
			$tsrc="thimg/".$_FILES[userfile][name]; // Path where thumb nail image will be stored
			//echo $tsrc;
			if (!($_FILES[userfile][type] =="image/jpeg" OR $_FILES[userfile][type]=="image/gif")){echo "Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
			exit;}
					 
					//////////// Starting of GIF thumb nail creation///////////
			if (@$_FILES[userfile][type]=="image/gif")
			{
			$im=ImageCreateFromGIF($add);
			$width=ImageSx($im); // Original picture width is stored
			$height=ImageSy($im); // Original picture height is stored
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			if (function_exists("imagegif")) {
			Header("Content-type: image/gif");
			ImageGIF($newimage,$tsrc);
			}
			elseif (function_exists("imagejpeg")) {
			Header("Content-type: image/jpeg");
			ImageJPEG($newimage,$tsrc);
			}
			chmod("$tsrc",0777);
			}////////// end of gif file thumb nail creation//////////
			
			////////////// starting of JPG thumb nail creation//////////
			if($_FILES[userfile][type]=="image/jpeg"){
			$im=ImageCreateFromJPEG($add);
			$width=ImageSx($im); // Original picture width is stored
			$height=ImageSy($im); // Original picture height is stored
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImageJpeg($newimage,$tsrc);
			chmod("$tsrc",0777);
			}
			//////////////// End of JPG thumb nail creation ////////// 
		 
			$sql = $this->MMdbobj->query("update tbl_books set image='$imname' where pro_id={$this->pro_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
			}
			
			
			$sql = $this->MMdbobj->query("update tbl_books set cat_id={$this->cat_id},pname={$this->pname},company={$this->company},detail={$this->detail},hot={$this->hot},price={$this->price} where pro_id={$this->pro_id}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return true;
			}
			
			public function SelectCateg()
			{
			
			$sql = $this->MMdbobj->query("select * FROM tbl_category where status=1 order by sorto");
			$sendcatinfo = $this->MMdbobj->fetchRows();
						
			return $sendcatinfo;
			}
	
			
	
	public function UpdateStatus()
		{
			$this->proid = $this->MMdbobj->quote($_GET['proac']);
			$this->st = $this->MMdbobj->quote($_GET['st']);
			
			
			$sql = $this->MMdbobj->query("update tbl_books set status={$this->st} where pro_id={$this->proid}");
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
							('$ip','$adid','$name','Product $pname added','$date')";
							
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
							('$ip','$adid','$name','Delete Product with this id $_GET[del_id]','$date')";
							
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
							('$ip','$adid','$name','Updated Product with this id $_POST[categ_id]','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
				
				
				
				
				
				
}

?>
