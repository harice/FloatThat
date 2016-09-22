<?php
require_once('TwitterAPIExchange.php');
$user_array = array();

$consumerKey = 'YNZrRJ1kxPxGepxC2xESzjIGN';
$consumerKeySecret = 'ytIM8UE4Ngzd9grUhRvhm37IC2pQkXzUHVRMMnJ3uu29EJO3Yj';
$accessToken = '575376243-vKMBw61d1XBcrM5xBipf3NMafLk84UPbNIhGYhLs';
$accessTokenSecret = ' 3lsDI38p6FGSOfzUcg3R9iS5kGXOpkYBU3bSnrxobrpu3';
 
$settings = array(
  'oauth_access_token' => $accessToken,
  'oauth_access_token_secret' => $accessTokenSecret,
  'consumer_key' => $consumerKey,
  'consumer_secret' => $consumerKeySecret
);
 
$i = 0;
$cursor = -1;
 
do {
  $url = 'https://api.twitter.com/1.1/followers/list.json';
  $getfield = '?cursor='.$cursor.'&screen_name='.$screen_name.'&skip_status=true&include_user_entities=false';
  $requestMethod = 'GET';
  $twitter = new TwitterAPIExchange($settings);
  $response = $twitter->setGetfield($getfield)
                      ->buildOauth($url, $requestMethod)
                      ->performRequest();
 
  $response = json_decode($response, true);
  $errors = $response["errors"];
 
  if (!empty($errors)) {
    foreach($errors as $error){
      $code = $error['code'];
      $msg = $error['message'];
      echo "<br><br>Error " . $code . ": " . $msg;
    }
    $cursor = 0;
  }
  else {
    $users = $response['users'];
	//echo "<pre>";
	//print_r( $users);
    foreach($users as $user){
      $user_array[$i]['thumb'] = $user['profile_image_url'];
      $user_array[$i]['url'] = $user['screen_name'];   
      $user_array[$i]['name'] = $user['name'];
	  $user_array[$i]['uid'] = $user['id'];
     // echo "<a title='" . $name . "' href='http://www.twitter.com/" . $url . "'>" . "<img src='" . $thumb . "' /></a>";
      $i++;
    }
    $cursor = $response["next_cursor"];
  }
}
while ( $cursor != 0 );

/*if (!empty($users)) {
  echo '<br><br>Total: ' . $i;
}*/
 
?>