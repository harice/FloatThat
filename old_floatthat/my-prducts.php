<?php
	require_once ("config.php");

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
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
	<link rel="stylesheet" href="css/user_log.css">
	<link rel="stylesheet" href="css/responsive.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<link rel="stylesheet" type="text/css" href="css/ie8-and-down.css" />
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">

</head>
<body>

	<!--start header-->
	<?php require_once("header.php");?>	
	<!--end header-->



	<div class="container">
		<div class="sixteen columns">
			
			<div id="pageName">
				<div class="name_tag">
					<p>
						You're Here :: <a href="index.php">Home</a> :: My Products
					</p>
					<div class="shapLeft"></div>
					<div class="shapRight"></div>
				</div>
			</div><!--end pageName-->

		</div>
	</div><!-- container -->



	<!-- strat the main content area -->
	
	<div class="container">

			<!--end user_log-->
<?php
	if ($offset == "")
		$offset = 0;
	$limit = 20; // from common file in include folder
	if ($_GET["newOffset"] != "") {
		$offset = $_GET["newOffset"];
	}
	if ($_GET["offSett"] != "") {
		$offset = $_GET["offSett"];
	}
	$nxt = $offset + $limit;
	$prv = $offset - $limit;
	
	
	$sqlQuery="SELECT products.title , products.featured, products.price, products.status, photos.image, products.pro_id, products.detail,
	category.title as category
			
			FROM tbl_products products
			left join tbl_category as category on category.c_id = products.c_id
			inner join tbl_photos as photos on photos.pro_id = products.pro_id
			
			where products.status = 1 
			
			group by products.pro_id
			
			order by products.pro_id desc ";//and user_id = '".$userContents['id']."'
	$arrResults = $commonObject->selectMultiRecords($sqlQuery);
	$allCount = count($arrResults);
	$sqlQuery .= " LIMIT $offset , $limit";			
	$arrResults = $commonObject->selectMultiRecords($sqlQuery);
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td valign="top" width="9" align="left" background="images/sideMenu_MiddleLeft.png"><img src="images/spacer.gif" width="9" border="0" height="1"></td>
                      <td valign="top" width="100%" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="SiteTextBlack12" valign="top" align="right">&nbsp;<a href="add_products.php" style="color:#FFFFFF;">Add New</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br /></td>
                          </tr>
                              <form action="delete_products.php" method="post" name="delete" id="delete">
                                <input type="hidden" name="newOffset" value="<? echo $offset;?>" />
                                <tr>
                                  <td height="25" colspan="7" valign="middle"><table width="98%" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF">
                                      <tr>
                                        <td align="left" class="text"><?php if (count($arrResults) > 0) {;?>
                                          Showing <b><?php print ($offset+1) . ' - ' . ($offset+count($arrResults));?></b> of
                                          <?=$allCount; ?>
                                          records
                                          <?php } ;?>                                        </td>
                                        <?php if ($prv >= 0) { ?>
                                        <td width="50" class="link2"><a href="<?php print $PHP_SELF . "?newOffset=0"?>"><font color="#005b90">First</font></a> </td>
                                        <td width="50" align="right"class="link2"><a href="<?php print $PHP_SELF . "?newOffset=$prv"?>"><font color="#005b90">Previous</font></a> </td>
                                        <?php } ?>
                                        <?php 
					if ( ($nxt > 0) && ($nxt < $allCount) ) {
						$alloffset = (ceil($allCount / $limit) - 1) * $limit;
				?>
                                        <td width="50" align="right"class="link2"><a href="<?php print $PHP_SELF . "?newOffset=$nxt"?>"><font color="#005b90">Next</font></a>&nbsp; </td>
                                        <td width="50" align="right"class="link2"><a href="<?php print $PHP_SELF . "?newOffset=$alloffset"?>"><font color="#005b90">Last</font></a>&nbsp; </td>
                                        <?php } ?>
                                      </tr>
                                  </table></td>
                                </tr>						  
                          <tr>
                            <td class="SiteTextBlack12" valign="top" align="left" height="400">
							
							<table border="1" width="98%" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="link2"> 
                             
                                
                                <tr bgcolor="#666666" class="text">
                                   <td width="3%"><font color="#FFFFFF"><strong>Edit</strong></font></td>
								  <td width="5%"><font color="#FFFFFF"><strong>Status</strong></font></td>
								  <td width="16%"><font color="#FFFFFF"><strong>Category</strong></font></td>
								  <td width="32%"><font color="#FFFFFF"><strong>Product Name</strong></font></td>
								  <td width="10%"><font color="#FFFFFF"><strong>Price</strong></font></td>								  
                                  
                                </tr>
                                <?php 
		if(count($arrResults) > 0)
		{			
			for($i=0;$i<count($arrResults);$i++)
			{

			?>
                                <tr bgcolor="#FFFFFF">
                                  <td align="left" class="text"><a class='link2' href="add_products.php?id=<?php echo $arrResults[$i]["pro_id"]?>">Edit</a></td>
								  
         <td align="left" class="text">
								  <?php
								  if($arrResults[$i]["status"] == 1)
								  {
								  ?>
						<a class='link2' href="status_products.php?pid=<?=$arrResults[$i]["pro_id"]?>&newOffset=<?=$offset?>&status=0">Active</a>							  								  <?php
								  }
								 else
								  {
								  ?>
						<a class='link2' href="status_products.php?pid=<?php echo $arrResults[$i]["pro_id"]?>&newOffset=<?php echo $offset?>&status=1">Disable</a>							  								  <?php
								  }								  
								  ?>
								  </td>    
<td align="left" class="text"><?php
					echo $arrResults[$i]["category"];
					?>                                  </td>								  
								                                 <td align="left" class="text"><?php
					echo $arrResults[$i]["title"];
					?>                                  </td>
<td align="left" class="text"><?php echo $arrResults[$i]["price"];?>                                  </td>        								
                                  					 
                                  
                                </tr>
                                <?php
			}
			?>
                                
                                <?
			} // greater than zero
			else
			{
			?>
                                <tr>
                                  <td  colspan="5" align="center"  class="text"> No Record Found </td>
                                </tr>
                                <?php
			}
			?>
                             </form>
                            </table>                            
                            <p>&nbsp;</p>
                                </td>
                          </tr>
                          <tr>
                            <td class="SiteTextBlack12" valign="top" align="left">&nbsp;</td>
                          </tr>
                      </tbody></table>
			
			
	</div><!--end container-->
	<!-- end the main content area -->


	<!-- start the footer area-->
	<?php require_once("footer.php");?>	
	<!--end the footer area -->



	<!-- JS
	================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <!-- jQuery.dropKick plug-in -->
    <link rel="stylesheet" href="js/dropKick/dropkick.css">
	<script src="js/dropKick/jquery.dropkick-1.0.0.js"></script>
	<!-- jQuery.nicescroll plug-in -->
	<script src="js/jquery.nicescroll.js"></script>
	<!-- jQuery.tweet plug-in -->
	<script src="js/jquery.tweet.js"></script>
	<!-- jQuery.cycle2 plug-in -->
	<script src="js/jquery.cycle2.min.js"></script>
	<script src="js/jquery.cycle2.tile.min.js"></script>
	<!-- jQuery.jcarousellite plug-in -->
	<script src="js/jcarousellite_1.0.1.min.js"></script>
	<!-- jQuery.fancybox plug-in -->
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css">
	<script src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<!-- jQuery.etalage plug-in -->
	<script src="js/jquery.etalage.min.js"></script>
	<!-- jQuery.cookie plug-in -->
	<script src="js/jquery.cookie.js"></script>
	<!--my custom code-->	
	<script src="js/main.js"></script>
	
	

<!-- End Document
================================================== -->
</body>
</html>