<?
$strPath = "./";
require_once $strPath."config.php";
	

$date_time = $now=date('Y-m-d H:i:s'); 

$username = addslashes(trim($_POST["email"]));
//$pass  = md5(addslashes(trim($_POST["pass"])));
$pass = $_POST["password"];

setcookie ("username", $username, time()+7200,  '/');

$sec = addslashes(trim($_POST["sec"]));
$Query="SELECT id,user_id, email, password,  status   FROM user_info WHERE email='$username'  AND password='$pass' and status = 1";
$userContent = $commonObject->selectFrom($Query);


//echo $_POST['url'];
//exit;


	if(trim($userContent["email"]) != "")
	{	
	$_SESSION['u_id']=$userContent["id"];
		if ($sec == md5("s4shahid79@hotmail.com"))
		{
			$Query="update user_info set  last_login = '$date_time' WHERE email='$username'  AND password='$pass' and status = 1";					
			$commonObject->update($Query);
			$commonFunctionInsta->createSession($username);//echo $PHPSESSID;
			if( $_SESSION['cart'] == 1)
			{
				$query = "update sales set uid = '".$userContent["id"]."' where sale_session_id = '".$_SESSION['current_session_id']."'";
				$rst = mysql_query($query);
			
			}
		//	echo $_SESSION['page_url'];
		//	exit;
if($_SESSION['product_id'] != "" && $_SESSION['from'] != "" && $_SESSION['deal_id'] != "")
{
	header("Location: http://www.floatthat.net/product-details.php?id=".$_SESSION['product_id']."&from=".$_SESSION['from']."&deal_id=".$_SESSION['deal_id']);
	exit;
}	
			if( trim($_SESSION['page_url']) != "")
				header("Location: ".$_SESSION['page_url']);
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
	else
	{
		$msg = urlencode("invalid");
		header("Location: register.php?msg=$msg&cart=".$_GET['cart']);	
	}

?>