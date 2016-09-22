<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Device extends Public_Controller
{

  public function __construct()
  {
		parent::__construct();
		$this->load->helper(array(
			'form',
			'url'
		));
		$this->load->model('users_model');
		$this->load->model('devices_model');
		$this->load->model('users/ion_auth_model');
		$this->load->library('facebookapiexception');
		$this->load->library('facebook');
		
		$this->template->set_layout('device_bounty.html');
		error_reporting(0);
		// We'll set the partials and metadata here since they're used everywhere
		//$this->template->append_js('module::admin.js')->append_css('module::admin.css');
  }
  
  public function logout()
  {  
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	setcookie('fbs_'.$facebook->getAppId(), '', time()-100, '/', base_url());
	session_destroy();
    redirect( base_url()."users/logout" );	
	  
  }
  
  public function index()
  {  
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	$password = 'facebook9211pass';
	
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;							
		
		if( $this->users_model->login($data['username'], $password, FALSE) )
		{	
		//	$facebook->setSession(NULL);		
			redirect(base_url());
		}
		else
		{			
		
			$this->users_model->fb_register($data['username'], $password, $fullname, $facebook_uid, $fb_token);
			$this->users_model->login($data['username'], $password, FALSE);

		//	$facebook->setSession(NULL);			
			redirect(base_url());			
		}	
		
	}
	$data['logoutUrl'] = $logoutUrl;
    $data['loginUrl'] = $loginUrl;
  	$data['home'] = 'class="current"';	
	
	$this->template->build('template.view.php',$data);	
  }
  public function iphoneapp()
  {
  
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	$password = 'facebook9211pass';
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;							
		
		if( $this->users_model->login($data['username'], $password, FALSE) )
		{	
			redirect(base_url());
		}
		else
		{			
			$this->users_model->fb_register($data['username'], $password, $fullname, $facebook_uid, $fb_token);
			$this->users_model->login($data['username'], $password, FALSE);
			redirect(base_url());			
		}	
	}
	
	$data['contents'] = $this->devices_model->get_page_contents('iphone-app');
    $data['loginUrl'] = $loginUrl;
	$data['logoutUrl'] = $logoutUrl;

	$data['iphone'] = 'class="current"';	
    $this->template->build('iphone.php',$data);
  }
  public function stories()
  {	
  
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	$password = 'facebook9211pass';
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;							
		
		if( $this->users_model->login($data['username'], $password, FALSE) )
		{	
			redirect(base_url());
		}
		else
		{			
			$this->users_model->fb_register($data['username'], $password, $fullname, $facebook_uid, $fb_token);
			$this->users_model->login($data['username'], $password, FALSE);
			redirect(base_url());			
		}	
	}

    $data['loginUrl'] = $loginUrl;
	$data['logoutUrl'] = $logoutUrl;
    $data['contents'] = $this->devices_model->get_page_contents('success-stories');
  	$data['stories'] = 'class="current"';		
    $this->template->build('stories.php',$data);
  }
    
  public function aboutus()
  {
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	$password = 'facebook9211pass';
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
				
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;							
		
		if( $this->users_model->login($data['username'], $password, FALSE) )
		{	
			redirect(base_url());
		}
		else
		{			
			$this->users_model->fb_register($data['username'], $password, $fullname, $facebook_uid, $fb_token);
			$this->users_model->login($data['username'], $password, FALSE);
			redirect(base_url());			
		}	
	}

    $data['loginUrl'] = $loginUrl;
	$data['logoutUrl'] = $logoutUrl;
    $result = $this->devices_model->get_page_contents('about-us');
	$data['contents'] = $result['page'];
  	$data['aboutus'] = 'class="current"';		
    $this->template->build('aboutus.php',$data);
  }
  
  public function contact()
  {	
  
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	$password = 'facebook9211pass';
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;							
		
		if( $this->users_model->login($data['username'], $password, FALSE) )
		{	
			redirect(base_url());
		}
		else
		{			
			$this->users_model->fb_register($data['username'], $password, $fullname, $facebook_uid, $fb_token);
			$this->users_model->login($data['username'], $password, FALSE);
			redirect(base_url());			
		}	
	}

    $data['loginUrl'] = $loginUrl;
	$data['logoutUrl'] = $logoutUrl;
	$data['contents'] = $this->devices_model->get_page_contents('contact-us');
  	$data['contact'] = 'class="current"';		
    $this->template->build('contact.php',$data);
  }
  public function login()
  {
  	$data['redirect_to'] = $this->agent->referrer();
  	if($this->current_user->id == 0 || !$this->current_user->id) 
	{}
	else
	{
		redirect(base_url().'device');
	}	
  	$data['login'] = 'class="current"';		
    $this->template->build('login.php',$data);
  }
  public function register()
  {	
  	if($this->current_user->id == 0 || !$this->current_user->id) 
	{}
	else
	{
		redirect(base_url().'device');
	}	  
  	$data['register'] = 'class="current"';		
    $this->template->build('register.php',$data);
  }    
  public function thanks()
  {
	
  
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	$password = 'facebook9211pass';
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;							
		
		if( $this->users_model->login($data['username'], $password, FALSE) )
		{	
			redirect(base_url());
		}
		else
		{			
			$this->users_model->fb_register($data['username'], $password, $fullname, $facebook_uid, $fb_token);
			$this->users_model->login($data['username'], $password, FALSE);
			redirect(base_url());			
		}	
	}

    $data['loginUrl'] = $loginUrl;
    $data['logoutUrl'] = $logoutUrl;
    $this->template->build('thanks.php',$data);
    
  
  } 
  public function downloads()
  {	
  
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
	$password = 'facebook9211pass';
  	if(trim($_GET['state']) != "" && trim($_GET['code']) != "" )
	{
		$face_data = $facebook->api('/'.$user);
		//print_r($face_data);
		
		$face_data['username'];
		$fullname = $face_data['name'];
		$facebook_uid = $face_data['id'];
		$fb_token = $_GET['state'];
		
		
		$data['username'] = $face_data['username'];	
		$data['password'] = $password;							
		
		if( $this->users_model->login($data['username'], $password, FALSE) )
		{	
			redirect(base_url());
		}
		else
		{			
			$this->users_model->fb_register($data['username'], $password, $fullname, $facebook_uid, $fb_token);
			$this->users_model->login($data['username'], $password, FALSE);
			redirect(base_url());			
		}	
	}

    $data['loginUrl'] = $loginUrl;
    $data['logoutUrl'] = $logoutUrl;
  	$data['downloads'] = 'class="current"';		
    $this->template->build('downloads.php',$data);
  }  
  
  function password()
  {
	// Create our Application instance (replace this with your appId and secret).
	$facebook = new Facebook(array(
	  'appId'  => '365172880224522',
	  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
	));
	
	// Get User ID
	$user = $facebook->getUser();
	
	// We may or may not have this data based on whether the user is logged in.
	//
	// If we have a $user id here, it means we know the user is logged into
	// Facebook, but we don't know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	
	if ($user) {
	  try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	
	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}

    $data['loginUrl'] = $loginUrl;
    $data['logoutUrl'] = $logoutUrl;
  	$data['downloads'] = 'class="current"';		
    $this->template->build('password.php',$data);
    
  }
  
  function recove_password()
  {
		// Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array(
		  'appId'  => '365172880224522',
		  'secret' => '6a4ae6c33e4fe4ff0459cd1b6b9970eb',
		));
		
		// Get User ID
		$user = $facebook->getUser();
		
		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		
		if ($user) {
		  try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		  }
		}
		
		// Login or logout url will be needed depending on current user state.
		if ($user) {
	  $url = base_url()."device/logout";		
	  $params = array( 'next' => $url );		
	  $logoutUrl = $facebook->getLogoutUrl( $params );
		} else {
		  $loginUrl = $facebook->getLoginUrl();
		}
	
		$data['loginUrl'] = $loginUrl;
	  $data['logoutUrl'] = $logoutUrl;
		 $email = $_POST['email'];	 
		 $password = "device_".rand(5, 15)."_bounty";
		 if( $this->users_model->recove_password($email, $password) )
		 {
			$data['error'] = 'no';
		 }
		 else
		 {
			$data['error'] = 'yes';	 
		 }		
		 
		 $this->template->build('password.php',$data);
  }
}
