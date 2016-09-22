<?php
require_once('TwitterAPIExchange.php');
$user_array = array();

$consumerKey = 'fRIciicNhd6vXYZ36VadXgjSr';
$consumerKeySecret = 'ghJzbdFalS5Hw7xJdUgPm2lQGHQhkmJInUvlEG4UGqKaZo0kH9';
$accessToken = '575376243-0rqdOeq9RoATqEINNR1oH96SucJC7FJLW9dxn72x';
$accessTokenSecret = 'UQSVkDDpY9Ba0eiSW44yHlNZ4e21TA9vCP8MYqdIwDMyI';
 
 
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
  //$getfield = '?cursor='.$cursor.'&screen_name='.$screen_name='RanaNaskar'.'&skip_status=true&include_user_entities=false';
  $getfield = '?screen_name='.$screen_name.'&skip_status=true&include_user_entities=false';
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