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
		
			$getmsglist = $this->getsaldetail();
			$this->htmlObj->paramss['MsgList'] = $getmsglist;
			
					
	}
	
			
		
		
		public function getsaldetail()
		{
			
			$start=$_GET['start'];
			if(!isset($start)) {                         // This variable is set to zero for the first page
			$start = 0;
			}	
			$eu = ($start - 0); 
			$limit = 5;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 	
			
			$cust_id=$_GET['cust_id'];
			$st=$_GET['status'];
			$sql = $this->MMdbobj->query("select sal.date,sal.cust_id,sal.invoice_no,sal.totalbill,cust.fname,cust.city,cust.mobilephone,cust.email,cust.address from tbl_mastersale sal,tbl_customer cust where sal.status=$st and cust.cust_id=$cust_id and sal.cust_id=cust.cust_id limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
}

?>
