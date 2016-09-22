<?
$strPath = "./";
require_once $strPath."config2.php";
	error_reporting(1);

$date_time = $now=date('Y-m-d H:i:s'); 

$username = addslashes(trim($_GET["email"]));
//$pass  = md5(addslashes(trim($_POST["pass"])));
$pass = $_GET["password"];

setcookie ("username", $username, time()+7200,  '/');

$Query="SELECT user_id, email   FROM users WHERE email='$username'";
$userContent = $commonObject->selectFrom($Query);

//echo $userContent["email"];
//echo $_POST['url'];
//exit;

	if(trim($userContent["email"]) != "")
	{	
		//if ($sec == md5("s4shahid79@hotmail.com"))
		{
			$Query="update users set  last_login = '$date_time' WHERE email='$username'   and status = 1";					
			$commonObject->update($Query);
			$commonFunctionInsta->createSession($username);//echo $PHPSESSID;
			if( $_SESSION['cart'] == 1)
			{
				$query = "update sales set uid = '".$userContent["uid"]."' where sale_session_id = '".$_SESSION['current_session_id']."'";
				$rst = mysql_query($query);
				$_SESSION['cart'] = '';
			
			}
			if( trim($_SESSION['page_url']) != "")
				header("Location:".$_SESSION['page_url']);
			else
				header("Location: index.php");
			exit;			
			// ta hukme sani when estore will be active 
			//header("Location: cart.php");
			//header("Location: index.php");
			//else
			//	header("Location: ".$_POST['url']);
		}
	}


?>