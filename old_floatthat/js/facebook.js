
var user = 0; // players username and other stuff
var snapPic = 0; // Pic before crashing
var urlPic = 0; // saved image
var postToFeed = function(){return false;}; // function of feed

   function checkLoginState(){
      
        FB.getLoginStatus(function(stsResp) {
        
        if(stsResp.authResponse) {
            
            // You are loggined 
          //  accesstoken = stsResp.authResponse.accessToken;
            getUserInfo();
            
           
        } else {
            
            
            // FB dialog to login
            FB.login(function(loginResp) {
                if(loginResp.authResponse) {
                   // accesstoken = stsResp.authResponse.accessToken;
                    getUserInfo();

                    console.log('Loggined');
                } else {
                    console.log('Not Loggined');
                        // authenticate app
                        location.href="https://www.facebook.com/dialog/oauth/?scope=email&client_id=758132727559462&redirect_uri=" + location.href + "&response_type=token";
                }
            });
            
        }
    });
   }
   
function getUserInfo() {
    
    
        FB.api('/me', {fields: 'email,picture,id,name,first_name,last_name'}, function(resp) {
                user = resp;
               // 
              console.log(user);
              
            });
    }
    
function sendfbmsg(){
  FB.ui({
  method: 'send',
  link: 'http://www.nytimes.com/2011/06/15/arts/people-argue-just-to-win-scholars-assert.html',
});
}

// Login setup
window.fbAsyncInit = function() {
    
    $('#loginbutton, #feedbutton').removeAttr('disabled');


    // Check if loggined
 
      
    FB.getLoginStatus(function(stsResp) {
        
        if(stsResp.authResponse) {
            
            // You are loggined 
            accesstoken = stsResp.authResponse.accessToken;
            getUserInfo();
            
            console.log('Loggined');
        } else {
            
            
            // FB dialog to login
            FB.login(function(loginResp) {
                if(loginResp.authResponse) {
                    accesstoken = stsResp.authResponse.accessToken;
                    getUserInfo();

                    console.log('Loggined');
                } else {
                    console.log('Not Loggined');
                        // authenticate app
                        location.href="https://www.facebook.com/dialog/oauth/?scope=email,user_birthday&client_id=743102912465318&redirect_uri=" + location.href + "&response_type=token";
                }
            });
            
        }
    });
   
    postToFeed = function () {

          // call the API
          var obj = {
            method: 'feed',
            link: location.href,
            picture: location.href + urlPic,
            name: user.first_name + ' is playing a dash of romance',
            caption: user.first_name + ' got a score of ' + ( heart_points + coin_points ) + '!',
            actions: [
              {'name': 'Play Now', 'link': location.href }
            ],
            description: 'Can you beat my score?',
          };

          function callback(response) {
            console.log(response);
          }

          FB.ui(obj, callback);
    };
};

/*(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=794798587211056&version=v2.0";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

*/
