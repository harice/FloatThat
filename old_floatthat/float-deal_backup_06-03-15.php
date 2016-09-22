<?php
	require_once ("config.php");

	if(trim($userContents['user_name']) != "" && $userContents['tw'] == 2)
	{
		$screen_name = $userContents['user_name'];
		require_once ("friends.php");
	}
	 $user      =   $facebook->getUser();
	 
	if($userContents['email'] == "")
	{
		$_SESSION['page_url'] = curPageURL();
		header("Location: register.php");
		exit;
	}
	else
	{
		$_SESSION['page_url'] = '';
	}
	$_SESSION['infrom'] = '';
	if($_POST['type'] == "group")
	{
		if($_POST['infrom'] == "1")
		{
			$_SESSION['infrom'] = 1;
		}	
		else
			$_SESSION['infrom'] = 1;
				
		$_SESSION['person_name'] = $_POST['person_name'];
		$_SESSION['email'] = $_POST['email'];
		if($_POST['occusion'] == "Other")	
			$_SESSION['occusion'] = $_POST['other_occusion'];		
		else
			$_SESSION['occusion'] = $_POST['occusion'];		
	}
	
	$Query="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail
			
			FROM tbl_products products
			
			left join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.pro_id = '".$_GET['id']."'";
	$product_details = $commonObject->selectMultiRecords($Query);
	$i = 0;
	
									if($_GET['type'] == "group")
									{
										$msg = "Group Purchase with your Friends";
										
									}
									else
									{		
										$msg = "Float deal with your Friends";
									}	
?>	
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="https://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

<script>
  $(document).ready(function(){



	    var counter = 2;

		//alert(counter);

	    $("#addButton").click(function () {

				

		
									 

			var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
			
			
				
                newTextBoxDiv.after().html('<bR /><label>Friend Name : </label>' +
				'<input type="text" name="friend_name' + counter + '" id="friend_name' + counter + '" placeholder="Friend Name" value="" class="photo_sec" >&nbsp;<label>Email Address : </label>' +
				'<input type="text" name="friend_email' + counter + '" id="friend_email' + counter + '" placeholder="Email Address" value="" class="photo_sec" >&nbsp;<a  id="removeButton" onclick="removeme(' + counter + ');"  style="cursor:pointer;">X</a>');

            

			newTextBoxDiv.appendTo("#TextBoxesGroup");

				
			$("#nCounter").val(counter);
		    counter++;

	    });

	   
		

  });
  
function removeme(id)
{
	$("#TextBoxDiv"+id).html('');
}
</script>


<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Float That</title>
	<meta name="description" content="">
	<meta name="Hassan" content="Float That">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/product_detail.css">
    <link rel="stylesheet" href="css/home2.css">
	<link rel="stylesheet" href="css/responsive.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<link rel="stylesheet" type="text/css" href="css/ie8-and-down.css" />
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Attach our CSS -->
	  	<link rel="stylesheet" href="./popup/reveal.css">	
	  	
		<!-- Attach necessary scripts -->
<!--		<script type="text/javascript" src="./popup/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="./popup/jquery.reveal.js"></script>-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
          
  <script>
  $(function() {
    $( "#myModal" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>
		
</head>
<body>
<?php
if($_GET['type'] == "group")
{	
	$title = 'Group Purchase with Friends';
}
else
{
	$title = 'Float Product with Friends';
}
?>
<div id="myModal" title="<?php echo $title;?>">
     
<?php
if($_GET['type'] == "group")
{
	$msg = "Group Purchase with your Friends";
	?>
	<h1>No one will be charged until the selected odds are met and all
participating members have accepted on float deal instead of  No one will
be charged until everyone chips in. The gift fund will be sent to your
PayPal account</h1>
	</script>
	<?php
}
else
{
	?><h1>You can invite as many members as you want, However minimum <?php echo $_POST['members']?> members need to complete the Float.</h1>
	<?php
}
?>	 
     
    
</div>

		<a href="#" class="big-link" data-reveal-id="myModal"></a>

	<!--start header-->
	<?php require_once("header.php");?>
	<!--end header-->



	<div class="container">
		<div class="sixteen columns">
			
			<div id="pageName">
				<div class="name_tag">
					<p>
					You're Here :: <a href="index.php">Home</a> &raquo; <?php echo $product_details[$i]['title']?> &raquo; <?php echo $msg?>  </p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	<div class="container">

		<div class="sixteen columns">
			

			<div class="ten columns alpha">
	
		<?php if($_GET['msg'] == "exist"){?>
				<div style="color:red; font-size:14px;">You have already float this Product.</div><br />
				<?php }
				if($_GET['msg'] == "succ"){?>
				<div style="color:green; font-size:14px;">You have successfully float this product</div><br />
				<?php }
if($_GET['msg'] == "no"){?>
				<div style="color:red; font-size:14px;">Sorry you did not select any user to float this product</div><br />
				<?php }				
				
				?>		
			
<form action="float-deal-setp2.php?id=<?php echo $_GET['id']?>" method="post" name="frmFD">	
<input type="hidden" name="pro_id" id="pro_id" value="<?php echo $_POST['id']?>">
	<input type="hidden" name="type" id="type" value="<?php echo $_POST['type']?>">
	<input type="hidden" name="deal_type" id="deal_type" value="<?php echo $_POST['type']?>">
<input type="hidden" name="members" id="members" value="<?php echo $_POST['members']?>">
<input type="hidden" name="user_types" id="user_types" value="<?php echo $_POST['user_types']?>">
<input type="hidden" name="nCounter" id="nCounter" value="1">
	
			<table width="940" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td  align="left" colspan="6"  style="font-size:18px; font-weight:bold; color:rgb(29, 10, 253);" >
				
<?php 				
	
if($_POST['deal_type'] == "group")	
{			
?>
No one will be charged until the selected odds are met and all
participating members have accepted on float deal.
<?php
}else
{
				?>
		No one will
be charged until everyone chips in. The gift fund will be sent to your
PayPal account.						
				
<?php
}
?>				
				
<br /><br />
				
				</td>
			</tr>

			<tr><td   width="200" align="center"><img width="180" height="100" src="./wadmin/gallaryimg/thumbnails/<?php echo $product_details[$i]['image']?>" alt="<?php echo $product_details[$i]['title']?>"></td>
				<td width="300" colspan="6" align="left" valign="top" >
				<strong>$<?php echo number_format($product_details[$i]['price'],2)?></strong><br />
				<?php echo $product_details[$i]['detail']?>
				</td>
			</tr>	
			
			<tr><td></td>
				<td colspan="6" align="left" >&nbsp;
				</td>
			</tr>
			
			
						
			<tr>
				<td colspan="6" align="left" >
				
<div id='TextBoxesGroup'>

	<div id="TextBoxDiv1">
								
		<label>Friend Name : </label><input type="text" name="friend_name1" id="friend_name1" placeholder="Friend Name" value="" class="photo_sec" >&nbsp;<label>Email Address : </label><input type="text" name="friend_email1" id="friend_email1" placeholder="Email Address" value="" class="photo_sec" >
				
	</div>
				
	</div>
	<bR /> &nbsp;<input type='button' value='Add another Friend' id='addButton' class="add_more">				
				
				</td>
			</tr>

			<?php
			//echo $_POST['user_types'];
			$Query="SELECT users.id, users.email, users.fname, users.lname, users.pic, users.name, friends.friend_id
					FROM friends AS friends
					INNER JOIN user_info AS users ON friends.friend_id = users.id
					WHERE friends.user_id  = '".$userContents['id']."'";
			$friends = $commonObject->selectMultiRecords($Query);			
			if(count($friends) > 0 && ($_POST['user_types'] == 1 || $_POST['user_types'] == 3 || $_POST['user_types'] == 5 || $_POST['user_types'] == 6))
			{
			?>	
<tr>
	<td colspan="6"><h5>floatthat.net Friends</h5></td>
</tr>					
				 <tr>	
							
							<?php
							for($i=0;$i<count($friends);$i++)
							{	
							?>
 
    <td align="center" width="200"><img height="100" width="100" src="avatar/<?php echo $friends[$i]['pic']?>" alt="<?php echo $friends[$i]['fname'].' '.$friends[$i]['lname']?>">
	<br>
	<?php echo $friends[$i]['name'].' '.$friends[$i]['lname']?>
	<br>
	<input type="checkbox" name="list[]" value="<?php echo $friends[$i]['friend_id']?>" >
	</td>
    

  						
							<?php
							//echo ($i / 5);
								if( ($i % 6) == 0 && $i >= 5)
								{
								?>
								</tr>		
								<tr>		
								<?
								}
							}
							?>	
						</tr>		
			<?php
			}
			
			{
			
if($user != "" && $user > 0 && ($_POST['user_types'] == 2 || $_POST['user_types'] == 3 || $_POST['user_types'] == 6))
{
?>
<tr>
	<td colspan="2"><h5>Facebook.com Friends</h5></td>
</tr>
<?
		$fql1    =   "SELECT uid,pic_big,pic,pic_small,name,birthday_date FROM user WHERE  uid IN ( SELECT uid2 FROM friend WHERE uid1= $user) order by name";
		$param1  =   array(
						
							'method'    => 'fql.query',
						
							'query'     => $fql1,
						
							'callback'  => ''
						
						);
		$fqlResult2   =   $facebook->api($param1);
	//	echo "<pre>";
	//	print_r($fqlResult2);
	//	echo "<pre>";	
		$i=0;
		$frndids = "";
		$cnt= 1;
		?>
		<tr>
		<?php
		foreach($fqlResult2 as $friends)
	        {
				 $i++; 
	
							?>
 
    <td align="center" width="200"><img src="<?php echo $friends['pic'];?>" style="width:80px; height:80px;" />
	<br>
	<?php echo htmlentities($friends['name'], ENT_QUOTES);?></span>
	
	<?php //echo date("Y-m-d",strtotime($friends['birthday_date']));?>
	<br />
	<input type="checkbox" name="users_id[]" value="<?php echo $friends['uid'];?>" >
	<input type="hidden" name="friend_names[]" value="<?php echo htmlentities($friends['name'], ENT_QUOTES)?>" >
	<input type="hidden" name="friend_pics[]" value="<?php echo $friends['pic']?>" >	
	</td>
    

  						
							<?php
								if( ($i % 6) == 0 && $i >= 5)
								{
								?>
								</tr>		
								<tr>		
								<?
								}
					}
?>	
						</tr>		
			<?php					
}
/*echo $_POST['user_types'];
echo $userContents['tw'];
echo "<pre>";
print_r($user_array);*/
if($userContents['tw'] == 2 && ($_POST['user_types'] == 4 || $_POST['user_types'] == 5 || $_POST['user_types'] == 6))
{
?>
<tr>
	<td colspan="2"><h5>Twitter.com Friends</h5></td>
</tr>
<?
		 foreach($user_array as $friends)
	        {
				 $i++; 
	
							?>
 
    <td align="center" width="200"><img src="<?php echo $friends['thumb'];?>" style="width:80px; height:80px;" />
	<br>
	<?php echo htmlentities($friends['name'], ENT_QUOTES);?></span>
	
	<?php //echo date("Y-m-d",strtotime($friends['birthday_date']));?>
	<br />
	<input type="checkbox" name="tw_users_id[]" value="<?php echo $friends['uid'];?>" >
	<input type="hidden" name="tw_friend_names[]" value="<?php echo htmlentities($friends['name'], ENT_QUOTES)?>" >
	<input type="hidden" name="tw_friend_pics[]" value="<?php echo $friends['thumb']?>" >	
	</td>
    

  						
							<?php
								if( ($i % 6) == 0 && $i >= 5)
								{
								?>
								</tr>		
								<tr>		
								<?
								}
					}
?>	
						</tr>		
			<?php					
}
if(count($friends) == 0 && $user == "")
{		
			?>
			<tr>
				
				<td colspan="2" align="center" style="color:red;"><br /> <br /> <br /> 
				Currently You have no friends in your list, to float this product Please first <a href="invite-friends.php?id=<?php echo $_GET['id']?>&type=<?php echo $_GET['type']?>" style="color:blue; font-weight:bolder; text-decoration:underline;">invite your friends</a>.
				
				<br /> 
				<br /> 
				<br /> 
				</td>
			</tr>			
			<?php
			}
}			
			?>
</table>
</form>	
				<!--end product_tabs-->
			</div><!--end ten-->


			<!--end six-->


			<!--end related_pro-->

		</div><!--end sixteen-->
							<ol>
								<li class="row clearfix">
									<div class="inputOuter button">
								<a href="#" onClick="document.frmFD.submit();" class="red_btn">Go Next</a>
								</div>
																		
								</li>
								
							</ol>
</div><!--end container-->
	<!-- end the main content area -->



	<!-- start the footer area-->
	<?php require_once("footer.php");?>
	<!--end the footer area -->


	

<!-- End Document
================================================== -->
</body>
</html>
  
