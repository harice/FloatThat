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
			
			
			if(isset($_GET['emp_id']))
			{
			$this->htmlObj->paramss['EmpInfo']=$this->SelectEmploy();
			}
			
			$this->htmlObj->paramsc['CatInfo']=$this->SelectCateg();
			
			
			if(isset($_POST['Regbtn']) and $_POST['employ_id']!="")
			{
			$this->UpdateEmploy();
			$this->UpdateEmpSecLog();
			print "<script>window.location.href='index.php?module=$_POST[modp]&agent_id=$_POST[agent]&createdby=$_POST[createdby]&errorMsg=<font color=green>Employee Information updated successfully</font>'</script>";
			//header('Location:index.php?module=emplist&errorMsg=<font color=green>Employee Information updated successfully</font>');
			}
			
			
			
					
	}
	
	
			
			public function SelectEmploy()
			{
			$this->empid = $this->MMdbobj->quote($_GET['emp_id']);
			$sql = $this->MMdbobj->query("select emp.* FROM tbl_emp emp where emp.emp_id={$this->empid}");
			$sendempinfo = $this->MMdbobj->fetch_assoc();
						
			return $sendempinfo;
			}
			
			
			public function SelectCateg()
			{
			
			$sql = $this->MMdbobj->query("select * FROM tbl_category where status=1");
			$sendcatinfo = $this->MMdbobj->fetchRows();
						
			return $sendcatinfo;
			}
	
		
		public function UpdateEmploy()
		{
		
			
			$refno = $_POST['refno'];
			
		
			$this->empid = $this->MMdbobj->quote($_POST['employ_id']);
			$this->title = $this->MMdbobj->quote($_POST['title']);
			$this->fname = $this->MMdbobj->quote($_POST['fname']);
			$this->lname = $this->MMdbobj->quote($_POST['lname']);
			
			$this->email = $this->MMdbobj->quote($_POST['email']);
			$this->password = $this->MMdbobj->quote($_POST['password']);
			$this->gender 	 = $this->MMdbobj->quote($_POST['gender']);
			$this->dateofbirth	 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
			$this->address = $this->MMdbobj->quote($_POST['address']);
			$this->address2 = $this->MMdbobj->quote($_POST['address2']);
			$this->address3 = $this->MMdbobj->quote($_POST['address3']);
			$this->town = $this->MMdbobj->quote($_POST['city']);
			$this->phone = $this->MMdbobj->quote($_POST['phone']);
			$this->mobilephone = $this->MMdbobj->quote($_POST['mobilephone']);
			$this->postcode = $this->MMdbobj->quote($_POST['postcode']);
			$this->county = $this->MMdbobj->quote($_POST['county']);
			$this->country = $this->MMdbobj->quote($_POST['country']);
			
			$this->agent_id = $this->MMdbobj->quote($_POST['agent_id']);
			
			$this->referedb = $_POST['referedb'];
			
			$this->paystatus = $_POST['paystatus'];
			$this->paymethod = $_POST['paymethod'];
			$this->amount = $_POST['amount'];
			
			$this->workloc = $this->MMdbobj->quote($_POST['workloc']);
			
			$this->nationality = $this->MMdbobj->quote($_POST['nationality']);
			
			if($this->paystatus!="" and $this->paymethod!="" and $this->amount!="")
			{
						
			$sql = $this->MMdbobj->query("update tbl_emp set 
										title={$this->title},fname={$this->fname},lname={$this->lname},password={$this->password},gender={$this->gender},
										dateofbirth='$this->dateofbirth',address={$this->address},address2={$this->address2},address3={$this->address3},city={$this->town},phone={$this->phone},
										mobilephone={$this->mobilephone},postcode={$this->postcode},county={$this->county},country={$this->country},
										nationality={$this->nationality},worklocation={$this->workloc},agent_id={$this->agent_id},refferedb='$this->referedb',paystatus='$this->paystatus',paymethod='$this->paymethod',amount='$this->amount'
										 where emp_id={$this->empid}");
										 
										 
										 }
										 
										 else
										 {
										 
										$sql = $this->MMdbobj->query("update tbl_emp set 
										title={$this->title},fname={$this->fname},lname={$this->lname},password={$this->password},gender={$this->gender},
										dateofbirth='$this->dateofbirth',address={$this->address},address2={$this->address2},address3={$this->address3},city={$this->town},phone={$this->phone},
										mobilephone={$this->mobilephone},postcode={$this->postcode},county={$this->county},country={$this->country},
										nationality={$this->nationality},worklocation={$this->workloc},agent_id={$this->agent_id},refferedb='$this->referedb'
										 where emp_id={$this->empid}");
			 }
										 
										 
			$sendcontents = $this->MMdbobj->affectedRows();
			
			
			for($i=0;$i<=5;$i++)
						{
						$cat_id=$_POST['jobcat'.$i];
						
						$oldcat_id=$_POST['oldcat'.$i];
						$expyer=$_POST['expyer'.$i];
					
							if($oldcat_id=="" and $cat_id!="")
							{
							$sql = "insert into tbl_appjobs(cat_id,emp_id,expyear) values('$cat_id',{$this->empid},'$expyer')";
							$this->MMdbobj->query($sql);
							}
							else if($oldcat_id!="" and $cat_id!="")
							{
							$sql = $this->MMdbobj->query("update tbl_appjobs set cat_id='$cat_id',expyear='$expyer' where emp_id={$this->empid} and cat_id=$oldcat_id");
							$sendcontents = $this->MMdbobj->affectedRows();
							}
						
						}
			
			
						
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
							('$ip','$adid','$name','updated Applicable Record with this Id $this->empid ','$date')";
							
					$this->MMdbobj->query($sql);
					
					if(!$this->MMdbobj->affectedRows())
						return false;
					
					return true;
				}
				
	
}

?>
