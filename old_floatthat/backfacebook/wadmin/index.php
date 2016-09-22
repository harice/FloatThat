<?php
require 'config.php';
class PageController 
{
	protected $MMdbobj;
	protected $htmlObj;
	private $module;
	
	public function __construct()
	{
		$this->MMdbobj = $GLOBALS['MMdbobj'];
		$this->htmlObj = $GLOBALS['htmlObj'];
	}
	
	private function loadModule()
	{
		$this->module = isset($_GET['module']) && $_GET['module']!="" ? $_GET['module'] : 'homepage';
		
		$this->module = $this->module == 'index' ? 'homepage' : $this->module;
				
		require MODULE_DIR.'/'.$this->module.'Module.class.php';
		$modObj = new Module();
		$modObj->render();
	}
	
	public function display()
	{
		$this->loadModule();
		$this->htmlObj->addCustomPageTitle(SITE_NAME);
		 $this->htmlObj->loadHTMLFile($this->module);
	}
}
?>

<?php

$pgObj = new PageController();
$pgObj->display();

?>
