<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
*/

Route::get('/', [
    'as' => '/',
    'uses' => 'WelcomeController@index',
]);

Route::get('home', 'HomeController@index');
Route::get('deals', 'FloatController@index');
Route::get('how-it-works', 'StaticController@how');

Route::post('facebook-canvas', 'InviteController@facebook_canvas');

Route::get('askemail', array(
    'as' => 'askemail',
    'uses' => 'StaticController@ask_email',
));

Route::post('storeemail', array(
    'as' => 'storeemail',
    'uses' => 'StaticController@store_email',
));

//** FLOAT **//
Route::get('float/create', array(
    'as' => 'createdeal',
    'uses' => 'FloatController@create',
));

Route::get('float/create-from-product/{product_id}',[
    'as' => 'create_from_product',
    'uses' => 'FloatController@create_from_product'
]);

Route::get('float/{float_id}', [
    'as' => 'getdeal',
    'uses' => 'FloatController@show'
]);

Route::get('float/share/{float_id}', [
    'as' => 'float.share',
    'uses' => 'StaticController@show_shareable'
]);


//** CREATE FLOAT **//
Route::post('float/add',[
    'as' => 'adddeal',
    'uses' => 'FloatController@add'
]);

Route::post('float/add_from_product',[
    'as' => 'addfromproduct',
    'uses' => 'FloatController@add_from_product'
]);

/** SEND INVITES **/
Route::get('invite/facebook_friends/{float_id}', [
    'middleware' => 'auth',
    'as' => 'invitefacebookfriends',
    'uses' => 'InviteController@facebook_friends'
]);

Route::get('invite/twitter_friends/{float_id}', [
    'middleware' => 'auth',
    'as' => 'invitetwitterfriends',
    'uses' => 'InviteController@twitter_friends'
]);

Route::get('invite/load_more_twitter_friends', [
    'middleware' => 'auth',
    'as' => 'loadmoretwitterfriends',
    'uses' => 'InviteController@load_more_twitter_friends'
]);

Route::get('invite/email_friends/{float_id}', [
    'middleware' => 'auth',
    'as' => 'inviteemailfriends',
    'uses' => 'InviteController@email_friends'
]);


Route::post('float/send_twitter_invites',[
    'middleware' => 'auth',
    'as' => 'sendtwitterinvites',
    'uses' => 'InviteController@send_twitter_invites'
]);

Route::post('float/send_email_invites',[
    'middleware' => 'auth',
    'as' => 'sendemailinvites',
    'uses' => 'InviteController@send_email_invites'
]);

Route::post('float/send_facebook_invites',[
    'middleware' => 'auth',
    'as' => 'sendfacebookinvites',
    'uses' => 'InviteController@send_facebook_invites'
]);

Route::get('invite/show/{float_id}', [
    'as' => 'inviteshow',
    'uses' => 'InviteController@show'
]);

Route::get('invite/accept/{float_id}', [
    'middleware' => 'auth',
    'as' => 'inviteaccept',
    'uses' => 'InviteController@accept'
]);

Route::get('invite/decline/{float_id}', [
    'middleware' => 'auth',
    'as' => 'invitedecline',
    'uses' => 'InviteController@decline'
]);

// ** TWITTER LOGIN ** //
Route::get('twitter', [
    'as' => 'twitter.login',
    'uses' => 'Auth\AuthController@twitter'
]);

Route::get('twitter_redirect', [
    'as' => 'twitter.callback',
    'uses' => 'Auth\AuthController@twitter_redirect'
]);

// ** FACEBOOK LOGIN ** //
Route::get('facebook', 'Auth\AuthController@facebook_redirect');
Route::get('login/facebook', 'Auth\AuthController@facebook');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// ** Verify Email ** //
Route::post('register', [
    'as' => 'register',
    'uses' => 'RegisterController@store'
]);

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegisterController@confirm'
]);

// ** PAYPAL ** //
// Add this route for checkout or submit form to pass the item into paypal
Route::post('payment', array(
    'as' => 'payment',
    'uses' => 'PaypalController@postPayment',
));

// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));

// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
    'as' => 'payment.status.buynow',
    'uses' => 'PaypalController@getPaymentStatus',
));

Route::get('payment/publishfloat', array(
    'as' => 'payment.ifPaidPublishFloat',
    'uses' => 'PaypalController@ifPaidPublishFloat',
));

Route::get('payment/success/{payment_id}', array(
    'as' => 'payment.success',
    'uses' => 'PayPalController@success'
));

Route::get('payment/buynow/{payment_id}', array(
    'as' => 'payment.success.buynow',
    'uses' => 'PayPalController@successBuyNow'
));

Route::get('payment/failed/{payment_id}', array(
    'as' => 'payment.failed',
    'uses' => 'PayPalController@fail'
));
