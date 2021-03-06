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
			
			
			if(isset($_GET['cust_id']))
			{
			$this->htmlObj->paramss['EmpInfo']=$this->SelectCustomer();
			}
			
			
			
			if(isset($_POST['Regbtn']) and $_POST['customer_id']!="")
			{
			$this->UpdateCustomer();
			$this->UpdateEmpSecLog();
			print "<script>window.location.href='index.php?module=$_POST[modp]&errorMsg=<font color=green>Customer Information updated successfully</font>'</script>";
			//header('Location:index.php?module=emplist&errorMsg=<font color=green>Employee Information updated successfully</font>');
			}
			
			
			
					
	}
	
	
			
			public function SelectCustomer()
			{
			$this->empid = $this->MMdbobj->quote($_GET['cust_id']);
			$sql = $this->MMdbobj->query("select emp.* FROM tbl_customer emp where emp.cust_id={$this->empid}");
			$sendempinfo = $this->MMdbobj->fetch_assoc();
						
			return $sendempinfo;
			}
			
			
			
		
		public function UpdateCustomer()
		{
		
			
			$refno = $_POST['refno'];
			
		
			$this->empid = $this->MMdbobj->quote($_POST['customer_id']);
			$this->title = $this->MMdbobj->quote($_POST['title']);
			$this->fname = $this->MMdbobj->quote($_POST['fname']);
			$this->lname = $this->MMdbobj->quote($_POST['lname']);
			
			$this->email = $this->MMdbobj->quote($_POST['email']);
			$this->password = $this->MMdbobj->quote($_POST['password']);
			$this->gender 	 = $this->MMdbobj->quote($_POST['gender']);
			$this->dateofbirth	 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
			$this->address = $this->MMdbobj->quote($_POST['address']);
			
			$this->town = $this->MMdbobj->quote($_POST['city']);
			$this->phone = $this->MMdbobj->quote($_POST['phone']);
			$this->mobilephone = $this->MMdbobj->quote($_POST['mobilephone']);
			$this->postcode = $this->MMdbobj->quote($_POST['postcode']);
			$this->county = $this->MMdbobj->quote($_POST['county']);
			$this->country = $this->MMdbobj->quote($_POST['country']);
			
			
			$this->nationality = $this->MMdbobj->quote($_POST['nationality']);
			
			
										 
										$sql = $this->MMdbobj->query("update tbl_customer set 
										title={$this->title},fname={$this->fname},lname={$this->lname},password={$this->password},gender={$this->gender},
										dateofbirth='$this->dateofbirth',address={$this->address},city={$this->town},phone={$this->phone},
										mobilephone={$this->mobilephone},postcode={$this->postcode},country={$this->country},
										nationality={$this->nationality}
										 where cust_id={$this->empid}");
			 
										 
			$sendcontents = $this->MMdbobj->affectedRows();
			
			return true;
			}
			
	
	
	private function UpdateEmpSecLog()
				{
				$ip=@$REMOTE_ADDR; 
					$adid=$_SESSION['adminid'];	
					$name=$_SESSION['fname'];
					$date=date('Y-m-d G:i:s');
					$catname = $_POST['catname'];
					$this->empid = $this->MMdbobj->quote($_POST['employ_id']);
					$sql = "insert into tbl_seclogs 
							(ipadress,userid,username,action,date)
							values
							('$ip','$adid','$name','updated Clients Record with this Id $this->empid ','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
	
}

?>
