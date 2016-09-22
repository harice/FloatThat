<?

class commonFunctins{


  

  
    


// Generates 14 digit random Id based on time, IP address and pid
function genRandomId()
{
  srand((double)microtime()*1000000);
  $abcdef = rand(10000,32000);
  $ip = getenv ("REMOTE_ADDR");
  $ip = substr($ip, 0, 8);
  $ip = preg_replace("/\./","",$ip);
  srand($ip);
  $ghij = rand(1000,9999);
  $pid = getmypid();
  srand($pid);
  $kl = rand(10,99);
  $number = $abcdef.$ghij.$kl;
  return $number;
}


function isExist($Querry_Sql)
{//	echo $Querry_Sql;
   
$commonObject = new Common();// common Database manipulatin function's class
   if((@$result = mysql_query ($Querry_Sql))==FALSE)
   	{
		if (DEBUG=="True")
		{
			
			echo $commonObject->mysql_message($Querry_Sql);		
		}	
	}  
	else
 	{	
		if ($check=mysql_fetch_array($result))
   		{
      		return $check;
   		}
			return false;	
	}
}







function createSession($username)
{
		$commonObject = new Common();// common Database manipulatin function's class

		$MemberSession="";
		$MemberSession = md5(uniqid(rand()) . commonFunctins::genRandomId());  // To Creat a unique SessionID
		setcookie ("onlineMembercookie", $MemberSession, time()+(8 * (60 * 60)),  '/'); 

        $now=date('Y-m-d H:i:s');        // Format of Session Start Date
		/*if (commonFunctins::isExist("select userlogin from ". TBL_SESSIONS . " where userlogin='$username'"))
		{
			if($usr_id == "")
			{
				$commonObject->deleteFrom("delete from session where userlogin='$username'");
			}
		}
		*/
		$commonObject->insertInto("INSERT INTO session(session_id, userlogin, session_time) VALUES('$MemberSession','$username','$now')");	

			$sessionMemberTime = time();
			$_SESSION['onlineSessionMemberTime'] = $sessionMemberTime;
			
		//	$loginContents = $commonObject->selectFrom_DB("select * from " . TBL_MEMBER . " where ua_login_name='$username' and ua_password = '$pass'");
						
		//	session_register("onlineLoginContents");
		//	$_SESSION["onlineLoginContents"] = $loginContents;
		//	session_register("onlineMemid");
		//	$_SESSION["onlineMemid"] = $loginContents["ua_id"];
		//	session_register("onlineName");
		//	$_SESSION["onlineName"] = $loginContents["ua_login_name"];
		//}
		 $_SESSION["onlinesMemberId"]= $MemberSession;
		
		//echo $_SESSION["sid"];
		//exit;
		
}

function loggedUser() // returns the valid logged username
{
	if(isset($_SESSION["onlinesMemberId"]))
	{
		$commonObject = new Common();// common Database manipulatin function's class
		$sessionID = $_SESSION["onlinesMemberId"];
		$now = date('Y-m-d H:i:s');
		//echo "SID: " . $sessionID;
		//echo "SELECT username from session where session_id='$sid'";
		$sql4session="SELECT userlogin from session where session_id='$sessionID'";
		if (!commonFunctins::isExist($sql4session) || !isset($sessionID)){
			return false;
		}
		
		$commonObject->update("update session set session_time='$now' where session_id='$sessionID'");	
		$content=$commonObject->selectFrom($sql4session);
	
		if (($_SESSION["onlineSessionMemberTime"] == '') or ((time()-$_SESSION["onlineSessionMemberTime"]) > (8 * (60 * 60)))) 
		{
			session_unset();
			header("Location: ./estore.php");
			exit;
		}
		else
		{
			// on success, update the session time
			$_SESSION["onlineSessionMemberTime"] = time();
			// one day shift will be 8 hours. on above I have set it to 8 hours, so no need to extend it again
			//setcookie ("onlineMembercookie", $_SESSION["onlinesMemberId"], time()+1800,  '/');
		}
		return $content["userlogin"];
	}
}



}//end of class





?>