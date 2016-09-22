<?php
if(!session_id())
	session_start();

define("VALID_ACCESS", 1);

/**
 * defining the global setting variable
 * these can access through out the site
 */

//site configration
define("SITE_NAME", "Float That Admin Panel");

define("SITE_URL", "localhost");
define("SITE_DIR", dirname(__FILE__));
define("IMG_URL", SITE_URL."/images");
define("IMG_DIR", SITE_DIR."/images");
define("JS_URL", SITE_URL."/js");
define("JS_DIR", SITE_DIR."/js");
define("CSS_URL", SITE_URL."/css");
define("CSS_DIR", SITE_DIR."/css");
define("CLASSES_URL", SITE_URL."/classes");
define("CLASSES_DIR", SITE_DIR."/classes");
define("MODULE_URL", SITE_URL."/modules");

define("MODULE_DIR", SITE_DIR."/module");
define("HTML_URL", SITE_URL."/html");
define("HTML_DIR", SITE_DIR."/html");


//database configration

/*define("", "");
define("", "");
define("", "");
define("", "");
define("", "");
define("", "");
define("", "");
define("", "");*/


/**
 * creating global object of most commently used classes
 */

// HTML class object

require CLASSES_DIR.'/HTML.class.php';
$htmlObj = new HTML();

//Database class object
require CLASSES_DIR.'/connectdb.php';
				$MMdbobj = new MySQLManager();
				/*$MMdbobj->setHost("localhost");
				$MMdbobj->setDB("ranaakmal");
				$MMdbobj->setUserName("root");
				$MMdbobj->setPassword("");
				$MMdbobj->connect();*/
				
				
				$MMdbobj->setHost("50.63.108.69");
				$MMdbobj->setDB("floatthat");
				$MMdbobj->setUserName("floatthat");
				$MMdbobj->setPassword("Pass123!@#");
				$MMdbobj->connect();
?>