<script src="http://connect.facebook.net/en_US/all.js"></script>

<script>
 FB.init({
     appId:'1654810721416394',
     cookie:true,
     status:true,
     xfbml:true
 });

 function FacebookInviteFriends()
 {
     FB.ui({method: 'apprequests',
            message: 'this is your message'
     }, function(response){
         console.log(response);
     });
 }
</script>


<div id="fb-root"></div>
<a href='#' onclick="FacebookInviteFriends();">
  Facebook Invite Friends Link
</a>
