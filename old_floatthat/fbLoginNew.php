  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="js/facebook.js"></script>
<div id="fb-root"></div>
    <script>
 window.fbAsyncInit = function() {
    FB.init({
      appId : '743102912465318',
      status     : true,
      cookie     : true,
      oauth      : true,
      xfbml      : true
    });

  

  };
  
  function checkfb(){
      
                            var name      = user.name;
                            var email     = user.email;
                            var pic       = user['picture']['data']['url'];
                            console.log(user);
                                console.log("hiii");
                                $.ajax({
                                    url:'ajax.php?action=fb_login_check',
                                    type:"POST",
                                    data:{userData:user},
                                    success:function(res){
                                        console.log(res);
                                    }
                                });
                            
                            $("#profile").html("NAME: "+name+"<br>EMAIL: "+email+"<br>");
                           
  }

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     d.getElementsByTagName('head')[0].appendChild(js);
   }(document));
</script>
 <div class="facebook_icon"> <a href="javascript:void(0);"  onclick="checkLoginState();">Facebook Login</a> </div>
 
 <div id="profile"></div>