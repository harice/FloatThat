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
			
			
			
			
			if(isset($_POST['SendLetter']))
			{
			$this->htmlObj->paramss['NewsLetter']=$this->SendNewsLetter();
			}
			
			
			
					
	}
	
	public function SendNewsLetter()
		{
		
		
			$sql = $this->MMdbobj->query("SELECT email,fname FROM tbl_clients");
			$sendcontents = $this->MMdbobj->fetchRows();
						
			return $sendcontents;
			}
	
	
	
	
	
}

?>
