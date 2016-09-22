<script src="//connect.facebook.net/en_US/all.js"></script> 
<script>

window.fbAsyncInit = function() {
FB.init({
      appId      : '498786253474282', // App ID = 308041575962796
      channelUrl : 'https://www.floatthat.net', // Channel File for x-domain communication   http://devdesks.com/swigtix
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });
};
    
    
   function sendFbMsg(_url){
       if(!_url){
           _url='http://www.w3.org/TR/html5/sections.html';
       }
        FB.ui({
        method: 'send',
        //link:'',
        //link: 'http://www.nytimes.com/2011/06/15/arts/people-argue-just-to-win-scholars-assert.html',
        link: _url,
		to:["1203308661"],
      });
   }
   
   function getFriends(){
	   FB.api('/me/feed','post',{
        app_id:'498786253474282',
        method: 'send',
        name: "Anything",
        link: 'my_link',
        to:"1203308661",
        description:'Check It.',
         display: 'dialog'
		},
		 function(response)
		 {
				  if (!response || response.error) {
					alert('Error occured');
					console.log(response);
				  } else {
					alert('Post ID: ' + response.id);
				  }
		}
		);
   }
   
   function sendFbFeed(_url){
       if(!_url){
           _url='https://www.floatthat.net/all-products.php';
       }
        FB.ui({
			method: 'share',
			href: _url,
		  },
		  function(response) {
			if (response && !response.error_code) {
			  alert('Posting completed.');
			} else {
			  alert('Error while posting.');
			}
      });
   }
   
   
      
</script>

<div id="fb-root"></div> 
<input type="button" value="send" onclick="sendFbMsg('http://www.nytimes.com/2011/06/15/arts/people-argue-just-to-win-scholars-assert.html')" />
<input type="button" value="send feed" onclick="sendFbFeed('http://www.nytimes.com/2011/06/15/arts/people-argue-just-to-win-scholars-assert.html')" />
<input type="button" value="Get Friends" onclick="getFriends()" />