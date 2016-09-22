<?php
$strPath = "./";
require_once $strPath."config.php";
	

$date_time = $now=date('Y-m-d H:i:s'); 

$action = $_REQUEST["action"];

switch($action){
    
    case "fb_login_check":
        $data = $_POST["userData"];
        /**
         * Resoponse: id, name, first_name, last_name
        * /
         * 
         */
        $id = $data["id"];
        
        $data["email"] = isset($data["email"]) ? $data["email"] : "no@email.set";
        if(validateFbLogin($id)){
            processLogin($data);
            echo "loggedIn";
        }else{
            registerViaFb($data);
            echo "registered";
        }
        break;
    
}

function validateFbLogin($id){
    return true;
}

function registerViaFb($data){
    // firest register
    echo "registered";
    processLogin($data);
    
}

function processLogin($data){
    
    $_SESSION['u_id']=$data["id"];
    
//    //$Query="update user_info set  last_login = '$date_time' WHERE email='$username'  AND password='$pass' and status = 1";					
//    //$commonObject->update($Query);
//    $commonFunctionInsta->createSession($data["email"]);//echo $PHPSESSID;
//    if( $_SESSION['cart'] == 1)
//    {
//            //$query = "update sales set uid = '".$userContent["id"]."' where sale_session_id = '".$_SESSION['current_session_id']."'";
//            //$rst = mysql_query($query);
//
//    }
//    
//    if($_SESSION['product_id'] != "" && $_SESSION['from'] != "" && $_SESSION['deal_id'] != "")
//    {
//	header("Location: http://www.floatthat.net/product-details.php?id=".$_SESSION['product_id']."&from=".$_SESSION['from']."&deal_id=".$_SESSION['deal_id']);
//	exit;
//    }
//    
//    if( trim($_SESSION['page_url']) != "")
//            header("Location: ".$_SESSION['page_url']);
//    else
//            header("Location: index.php");
//    exit;
//    
    
}

?>
