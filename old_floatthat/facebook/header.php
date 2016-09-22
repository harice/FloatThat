 <div id="fb-root"></div>
 <style>
		@import "Assets/LightFace.css";
</style>
<link rel="stylesheet" href="Assets/lightface.css" />
	<script src="Assets/mootools.js"></script>
	<script src="Source/LightFace.js"></script>
	<script src="Source/LightFace.js"></script>
	<script src="Source/LightFace.IFrame.js"></script>
	<script src="Source/LightFace.Image.js"></script>
	<script src="Source/LightFace.Request.js"></script>
        <script type="text/javascript">

            window.fbAsyncInit = function() {

                FB.init({appId: '498786253474282', status: true, cookie: true, xfbml: true});
             
			 
			  FB.Event.subscribe('auth.login', function(response) {
                    // do something with response
					
                    login();
					//window.location.reload();
                });
				
				 FB.Canvas.setAutoResize();
                FB.Event.subscribe('auth.logout', function(response) {
                    // do something with response
                    logout();
                });

                FB.getLoginStatus(function(response) {
                    if (response.session) {
                        // logged in and connected user, someone you know
                        login();
						
                    }
                });
            };
            (function() {
                var e = document.createElement('script');
                e.type = 'text/javascript';
                e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }());

            function login(){
                FB.api('/me', function(response) {
                  //  document.getElementById('login').style.display = "block";
                  //  document.getElementById('login').innerHTML = response.name + " succsessfully logged in!";
				
                });
            }
            function logout(){
                //document.getElementById('login').style.display = "none";
            }
		

            function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){

                FB.ui(

                {

                    method: 'stream.publish',

                    message: '',

                    attachment: {

                        name: name,

                        caption: '',

                        description: (description), properties:[{'text':'Visit '+name, 'href':hrefLink }],'media':[{

                  'type':'image',

                  'src':hrefTitle,
				

                  'href':hrefLink }],

                        href: hrefLink

                    }, user_prompt_message: userPrompt

                },

                function(response) {

					//alert('wall-Published');

					//InviteFriends();

                });



            }

     
	  function showStream(strquizname, strauthorname, strdescription, strurl){
                FB.api('/me', function(response) {
				//alert('ddddddddd');
               
                    streamPublish(strquizname, strauthorname, strdescription, strurl);
                });
            }
			
			
            
			
			function invite(){
				
						
			FB.ui({method: 'apprequests', message: 'Here will be Message for friends to use this app', data: 'tracking information for the user',
filters: ['app_non_users']});
			}
			
		
function Save_Real_Prize(user_id,pro_id)
{
if(user_id.length==0)
  {
  document.getElementById("member").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
    document.getElementById("member").innerHTML=xmlhttp.responseText;
		

    }
  }
  
  var selection = document.frch.ctype;
			
			for (i=0; i<selection.length; i++)
			{
			
			  if (selection[i].checked == true)
			  var ctype=selection[i].value;
						
			}
  
   var countries=document.getElementById('countries').value;
   var cardnum=document.getElementById('cardnum').value;
   var cscnum=document.getElementById('cscnum').value;
   
   var month=document.getElementById('month').value;
   var year=document.getElementById('year').value;
   var phone=document.getElementById('phone').value;
   
  
 
 	if(cardnum=="" && cscnum=="" && ctypee=="" && countries=="")
	{
	alert('Please fill mondatory fields');
	return false;
	}
	else
	{
 
	
xmlhttp.open("GET","save_real_prize.php?user_id="+user_id+"&pro_id="+pro_id+"&cardnum="+cardnum+"&cscnum="+cscnum+"&month="+month+"&year="+year+"&ctype="+ctype+"&phone="+phone,true);
xmlhttp.send();
	}
}


function Open_Cardinfo(user_id,pro_id){
	
				document.getElementById('lightfacepopupdiv').innerHTML = "";
				
				ajaxFace = new LightFace.Request({
					url: 'become_member.php',
					width:500,height:500,
					buttons: [
						
						{ title: 'Close', event: function() {this.close();  } }
					],
					request: { 
						data: { 
							user_id: user_id,pro_id:pro_id
						},
						method: 'post'
					},
					title: 'Join Deal'
				}).open();
				
			}
			
			
			function Members(user_id,pro_id){
	
				document.getElementById('lightfacepopupdiv').innerHTML = "";
				
				ajaxFace = new LightFace.Request({
					url: 'appmembers_list.php',
					width:400,
					buttons: [
						
						{ title: 'Close', event: function() {this.close();  } }
					],
					request: { 
						data: { 
							user_id: user_id,pro_id:pro_id
						},
						method: 'post'
					},
					title: 'Float Users'
				}).open();
				
			}
	
	

</script>

<?php /*?><?php $invitationnew=mysql_query("select * from tbl_members where user_id=$user and status=0");

$numbers=mysql_num_rows($invitationnew);
?>

  <div id="lightfacepopupdiv"></div>
<div class="menu_box">
        <div class="logo"><a href="<?php echo $apppath;?>index.php" target="_top" ><img src="images/logo2.png" width="237" height="111" alt="logo" border="none" /></a></div> 
        <div class="menu">
        <ul class="main_nav">
          <li><a href="<?php echo $apppath;?>index.php?m=productslist&fdeal=1" <?php if(isset($_REQUEST['fdeal'])){?>class="active" <?php }?> target="_top">Featured Deal</a></li>        
          <li><a href="<?php echo $apppath;?>index.php?m=productslist&all=1"  target="_top" <?php if(isset($_REQUEST['all'])){?>class="active" <?php }?>>All Deals</a></li>   
          <li><a href="<?php echo $apppath;?>index.php?m=mydeals&mdeal=1" <?php if(isset($_REQUEST['mdeal'])){?>class="active" <?php }?> target="_top">My Deals</a></li>    
          <li><a href="<?php echo $apppath;?>index.php?m=invitations&minvi=1" <?php if(isset($_REQUEST['minvi'])){?>class="active" <?php }?> target="_top"><span style="text-decoration:blink; color:#F00; font-weight:bold; font-size:14px"><?php echo $numbers;?></span>&nbsp; Invitations</a></li>
          <li><a href="<?php echo $apppath;?>index.php?m=howworks&how=1"  target="_top" <?php if(isset($_REQUEST['how'])){?>class="active" <?php }?>>How It Works?</a></li>            
  </ul>
              </div>
        <div class="clear"></div>       
  </div>
     <div class="top_btns">
     <a href="http://www.floatthat.net" target="_blank"><img src="images/visit_btn.png" width="115" height="29" alt="visit website" /></a> 
     <a href="#" onclick="invite();"><img src="images/invite_frnds.png" width="196" height="29" alt="invite button" /></a>
     </div>   <?php */?>
	 
     
     	<div class="container">
		<div class="sixteen columns">
			
			<div id="slide_outer">
				<div class="mainslide">

					<div class="pagers center">
						<a class="prev slide_prev" href="#prev">Prev</a>
						<a class="nxt slide_nxt" href="#nxt">Next</a>
					</div>

					<ul class="cycle-slideshow clearfix" 
			        data-cycle-fx="scrollHorz"
			        data-cycle-timeout="2000"
			        data-cycle-slides="> li"
			        data-cycle-pause-on-hover="true"
			        data-cycle-prev="div.pagers a.slide_prev"
			        data-cycle-next="div.pagers a.slide_nxt"
			        >
                    <?php 
		$i=0;
			$selproqry=mysql_query("SELECT pro.*,cat.c_id,cat.title as cattitle FROM tbl_products pro,tbl_category cat where cat.c_id=pro.c_id and featured=1 order by Rand()");
			$num=mysql_num_rows($selproqry);
			while($products=mysql_fetch_array($selproqry))
			{
				?>
				  <li class="clearfix">
							<div class="slide_img">
								<img src="images/icons/iphone_4_icon.png" alt="">
							</div>
							<div class="flex-caption">
								<h5>Pay $49 for $200<br><span><?php echo $products['title'];?></span></h5>
								<p>
									<?php echo $products['detail'];?>
								</p>
								<p>
									</p>
								<a href="<?php echo $apppath;?>index.php?m=productdetail&pro_id=<?php echo $products['pro_id'];?>" target="_top"><span>view Detail</span><span class="shadow">$<?php echo $products['price'];?></span></a>
							</div>
						</li>

						<?php }?>
					</ul>
				</div>
				<div class="shadow_left"></div>
				<div class="shadow_right"></div>
			</div>

		</div>
	</div><!-- container -->