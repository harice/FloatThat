 window.fbAsyncInit = function() {
    FB.init({
      appId      : '498786253474282', // App ID = 308041575962796
      channelUrl : 'https://www.floatthat.net', // Channel File for x-domain communication   http://devdesks.com/swigtix
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });
  };

  (function(d, debug){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
     ref.parentNode.insertBefore(js, ref);
   }(document, /*debug*/ false));
   $(document).on("click",".fb_login",function(){
		loginUser();
	});
   
   function loginUser() {
	  
			FB.login(function(response) {
				console.log(JSON.stringify(response.authResponse));
			
				if (response.authResponse) {
					FB.api('/me', function(response) {
						
						//alert(response.interests.name);
						
						//var fb_data = new Object();
						
							var goto="http://floatthat.net/redirectpage.php";
						
						
						var fb_data = "email="+response.email+"&first_name="+response.first_name+"&last_name="+response.last_name+"&city="+response.hometown.name+"&address="+response.location.name;
						$.ajax({
							url: goto,
							type: "post",
							data: fb_data,
							success: function(res){
								
								/*alert(res);
								return false;*/
								window.location.href=goto;
							}
						});
					});
				}
			} , {scope:'email,user_interests,user_photos'}); 
	}