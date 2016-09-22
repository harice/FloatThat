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
		
			if(isset($_GET['invoice_no']))
			{
			$this->DelInvoice();
			}
			
			if(isset($_GET['ainvoice_no']))
			{
			$this->UpdateStatus();
			$this->SecLog();
			}
			
			
			
			
			$getCategorylist = $this-> getcustomerrecords();
			$this->htmlObj->paramss['EmployList'] = $getCategorylist;
			
			
					
	}
	
			
		
		
		public function getcustomerrecords()
		{
			
			
			if(isset($_GET['m']) and isset($_GET['y']))
						{
						$m=$_GET['m'];
						$y=$_GET['y'];
						}
						else
						{
						$y=date('Y');
						$m=date('m');
						}
						
						switch($m)
						{
						
						case 01:
						$mm= "Jan";
						break;
						
						case 02:
						$mm= "Feb";
						break;
						case 03:
						$mm= "Mar";
						break;
						
						case 04:
						$mm= "Apr";
						break;
						
						case 05:
						$mm= "May";
						break;
						
						case 06:
						$mm= "Jun";
						break;
						
						case 07:
						$mm= "Jul";
						break;
						
						case '08':
						$mm= "Aug";
						break;
						
						case '09':
						$mm= "Sep";
						break;
						
						case 10:
						$mm= "Oct";
						break;
						
						case 11:
						$mm= "Nov";
						break;
						
						case 12:
						$mm= "Dec";
						break;
						
						}
						
			
			$st=$_GET['status'];
			
			$start=$_GET['start'];
			if(!isset($start)) {                         // This variable is set to zero for the first page
			$start = 0;
			}	
			$eu = ($start - 0); 
			$limit = 10;                                 // No of records to be shown per page.
			$this1 = $eu + $limit; 
			$back = $eu - $limit; 
			$next = $eu + $limit; 		
			
			$sql = $this->MMdbobj->query("SELECT sal.*,cust.fname,cust.lname,cust.city FROM tbl_mastersale sal,tbl_customer cust where sal.status=$st and DATE_FORMAT(sal.date,'%Y%m')=DATE_FORMAT(CURDATE(),'%$y%$m') and cust.cust_id=sal.cust_id order by sal.invoice_no DESC limit $eu, $limit");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
	
	
	
	public function DelInvoice()
		{
			$this->invoice_no = $this->MMdbobj->quote($_GET['invoice_no']);
			$sql = $this->MMdbobj->query("delete FROM tbl_mastersale where invoice_no={$this->invoice_no}");
			$sendcontents = $this->MMdbobj->affectedRows();
			
			$sql = $this->MMdbobj->query("delete FROM tbl_orderdetail where invoice_no={$this->invoice_no}");
			$sendcontents = $this->MMdbobj->affectedRows();
						
			return $sendcontents;
			
		}
		
		public function UpdateStatus()
		{
			$this->Ainvoice_no = $this->MMdbobj->quote($_GET['ainvoice_no']);
			$this->st = $this->MMdbobj->quote($_GET['status']);
			
			$sql = $this->MMdbobj->query("update tbl_mastersale set status={$this->st} where invoice_no={$this->Ainvoice_no}");
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
							('$ip','$adid','$name','Account activated by admin','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
	
}

?>
