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
		
		
		
		if(isset($_POST['updatebtn']) and $_REQUEST['photo_id']=="")
		{
			
			$this->InsertNewComp();	
			echo "<script>window.location.href='index.php?module=categoryphotos&gal_id=$_REQUEST[gal_id]&msg=Image uploaded successfull'</script>";
			
		}
		
				$this->htmlObj->paramsc['GalleryList'] =$this->getGallery();
			
	}
	
	
	
		
		
		public function getGallery()
		{
				
				$sql = $this->MMdbobj->query("SELECT * FROM tbl_products order by title");
				$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
			
	
	
	function getExtension($str) 
							{

									 $i = strrpos($str,".");
									 if (!$i) { return ""; } 
							
									 $l = strlen($str) - $i;
									 $ext = substr($str,$i+1,$l);
									 return $ext;
							 }
	
			
			public function InsertNewComp()
				{
					
										  
					$path="webimages/gallaryimg/gallaryphotos/";
					$sdate=date('Y-m-d G:i:s');
		 
					$cnt=count($_FILES['userfile']);
					
					for($i=0;$i<$cnt;$i++)
					{
						$this->heading = $this->MMdbobj->quote($_POST['title'][$i]);
						/*$path1= $path.$_FILES['userfile']['name'][$i];
						copy($_FILES['userfile']['tmp_name'][$i], $path1);
						
						$n_width=190; // Fix the width of the thumb nail images
						$n_height=160; // Fix the height of the thumb nail imaage*/
						
						 $image =$_FILES["userfile"]["name"][$i];
						 $uploadedfile = $_FILES['userfile']['tmp_name'][$i];
						
						  if ($image) 
						  {
						  $filename = stripslashes($_FILES['userfile']['name'][$i]);
								$extension = $this->getExtension($filename);
						  $extension = strtolower($extension);
						 if (($extension != "jpg") && ($extension != "jpeg") 
						
						&& ($extension != "png") && ($extension != "gif")) 
						  {
						echo ' Unknown Image extension ';
						$errors=1;
						  }
						 else
						{
						   $size=filesize($_FILES['userfile']['tmp_name'][$i]);
						 
						/*if ($size > MAX_SIZE*1024)
						{
						 echo "You have exceeded the size limit";
						 $errors=1;
						}*/
						 
						if($extension=="jpg" || $extension=="jpeg" )
						{
						$uploadedfile = $_FILES['userfile']['tmp_name'][$i];
						$src = imagecreatefromjpeg($uploadedfile);
						}
						else if($extension=="png")
						{
						$uploadedfile = $_FILES['userfile']['tmp_name'][$i];
						$src = imagecreatefrompng($uploadedfile);
						}
						else 
						{
						$src = imagecreatefromgif($uploadedfile);
						}
						 
						list($width,$height)=getimagesize($uploadedfile);
						
						$newwidth=500;
						$newheight=400;
						$tmp=imagecreatetruecolor($newwidth,$newheight);
						
						
						
						imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
						
						 $width,$height);
						
						//imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
						
						$filename = "gallaryimg/gallaryphotos/". $_FILES['userfile']['name'][$i];
						//$filename1 = "images/small". $_FILES['file']['name'];
						
						imagejpeg($tmp,$filename,100);
						
						$newwidth1=190;
						$newheight1=160;
						$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
						
						imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, $width,$height);
						
						$filename = "gallaryimg/thumbnails/". $_FILES['userfile']['name'][$i];
						imagejpeg($tmp1,$filename,100);
						//imagejpeg($tmp1,$filename1,100);
							//imagedestroy($tmp1);
						}
						}
			
						$cat_id = $_POST['cat_id'];
						$g_id = $_POST['pro_id'];
		
					$imname=$_FILES[userfile][name][$i];
						if($imname!="")
						{
						
						
						 $sql = $this->MMdbobj->query("insert into tbl_photos set photoname={$this->heading},image='$imname',date='$sdate',pro_id='$g_id'");
						
						
						}
					
					}
					
					
		
	}
		
		
		
	
}


?>
