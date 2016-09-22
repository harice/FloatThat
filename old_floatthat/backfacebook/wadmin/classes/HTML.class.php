
<?php
defined('VALID_ACCESS') or die('Restricted Access');
class HTML
{
	private $cfg;
	
	private $pageTitle;
	private $metaTags;
	private $cssTags;
	private $jsTags;
	
	private $headerContents;
	private $bodyContents;
	
	public  $params;
	
	public $paramss;
	public function __construct()
	{
		$this->cfg = $GLOBALS['config'];
		$this->params = array();
		
		$this->linkCSS();
		$this->linkJavascript();
	}
	
	public function renderHTML()
	{
		$html = '<html xmlns="http://www.w3.org/1999/xhtml">';
		$html .= $this->createHeader();
		$html .= $this->createBody();
		$html .= "</html>";
		
		echo $html;
	}
	
	private function createHeader()
	{
		$header = '<head>';
		$header .= 	$this->pageTitle;		
		$header .= $this->metaTags;
		$header .= $this->cssTags;
		$header .= $this->jsTags;
		$header .= $this->headerContents;
		$header .= '</head>';
		
		return $header;
	}
	
	private function createBody()
	{
		$body = "<body bgcolor='FFFFFF'>";
		$body .= $this->bodyContents;
		$body .= "</body>";
		
		return $body;
	}
	
	public function addCustomPageTitle($title="")
	{
		if($title=="")
			$title = "Control Panel";
			
		$this->pageTitle = "<title>$title</title>";
	}
	
	public function addMetaTags($tag)
	{
		$this->metaTags = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		if($tag!="")
			$this->metaTags .= $tag;
	}
	
	public function linkCSS($cssFileName="")
	{
		$cssFileName="style.css";
		 $this->cssTags = '<link href="'.$cssFileName.'" rel="stylesheet" type="text/css">';
		
		
	}
	
	public function linkJavascript($jsFileName="")
	{
		$jsFileName="css/validation.js";
			$this->jsTags = '<script language="javascript" type="text/javascript" src="'.$jsFileName.'"></script>';
	}
	
	public function addHeaderContent($contents)
	{
		$this->headerContents = $contents;
	}
	
	public function addBodyContents($contents)
	{
		$this->bodyContents = $contents;
	}
	
	public function loadHTMLFile($filename)
	{
	
		$filepath = "$filename.html.php";
		$html = '<html xmlns="http://www.w3.org/1999/xhtml">';
		$html .= $this->createHeader();
		$html .= "<body>";
		echo $html;
		?>

	
    <link rel="favicon" href="favicon.ico" type="image/icon" />
	
	
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" valign="top">
    <td height="92" colspan="6" background="../images/top_header.gif" style="background-repeat:repeat-x ">
	
	<?php include(HTML_DIR."/header.html.php");?>
	
	
	</td>
  </tr>
  <tr>
    <td width="1%" height="19">&nbsp;</td>
    <td width="20%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="41%">&nbsp;</td>
    <td width="36%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
  </tr>
  
  <tr>
  <?php if(isset($_SESSION['adminemail'])){?>
    <td height="345" colspan="2" align="center" valign="top" bgcolor="#728DB8">
	
	<?php include(HTML_DIR."/left.html.php");?>
	
	</td>
	
    <td>&nbsp;</td>
	 <td colspan="3" align="center" valign="top" bgcolor="#FFFFFF">
	
	
	<?php include(HTML_DIR."/$filepath");?>
	
	
	</td>
	<?php } else {?>
	
	
    <td colspan="6" align="center" valign="top" bgcolor="#FFFFFF">
	
	
	<?php include(HTML_DIR."/$filepath");?>
	
	
	</td>
	<?php }?>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#003399">
    
    <td colspan="6" align="center" class="copy" style="background-image:url(images/footerbg.png); height:44px; background-repeat:repeat-x">
	<?php include(HTML_DIR."/footer.html.php");?>
	
    
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

				
				<?php
			/*include(HTML_DIR."/header.html.php");
		 	       
     		include(HTML_DIR."/footer.html.php");*/
			?>
					
             
         <?php
		
		$html = "</body>";
		$html .= "</html>";
		echo $html;
	}
}

?>
