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
			
			$invoice=$_GET['invoice_no'];
			$sql = $this->MMdbobj->query("select sal.date,sal.cust_id,sal.invoice_no,sal.totalbill,cust.fname,cust.city,cust.phone,cust.email,cust.address from tbl_mastersale sal,tbl_customer cust where sal.invoice_no=$invoice and cust.cust_id=sal.cust_id");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
}

?>
