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
		
		if($_REQUEST['photo_id']!="")
		{
			$this->DelPhoto();
		
		}
		
		$this->htmlObj->paramss['myGallary']=$this->getMyGallary();
			
	}
	
	
			
			public function DelPhoto()
			{
				$sql = $this->MMdbobj->query("delete from tbl_photos where photo_id=$_REQUEST[photo_id]");	
			}
			
			
			public function getMyGallary()
			{
		
			$start=$_GET['start'];
				if(!isset($start)) {                         // This variable is set to zero for the first page
				$start = 0;
				}
				
				$eu = ($start - 0); 
				$limit = 48;                                 // No of records to be shown per page.
				$this1 = $eu + $limit; 
				$back = $eu - $limit; 
				$next = $eu + $limit; 
				
				
		
			$sql = $this->MMdbobj->query("SELECT pho.*,cat.pro_id,cat.title FROM tbl_photos pho,tbl_products cat where cat.pro_id=pho.pro_id order by pho.pro_id ASC limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
	
}


?>
