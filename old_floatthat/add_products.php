<?php
	require_once ("config.php");
if($_GET['id'] > 0)
{
	$sqlQuery = "select *  from  tbl_products  where pro_id = ".$_GET['id']."";
	$arrResults = $commonObject->selectMultiRecords($sqlQuery);
	$text = "Edit";
}
else
	$text = "Add";
?>
<script src="./js/jquery-1.3.2.min.js" type="text/javascript"></script>
  <?
 		$query = "select * from tbl_photos where pro_id = '".$_GET['id']."' ";
		$arrPhotoResult = $commonObject->selectMultiRecords($query);
			
			
  ?>
<script>
  $(document).ready(function(){



	    var counter = 1;

		//alert(counter);

	    $("#addButton").click(function () {
  		
			$("#counter").val(counter);
			var html = '<div><label>Picture #'+ counter + ': </label>' +
			'<input type="file" name="textbox' + counter + '" id="textbox' + counter + '" value="" class="photo_sec" >&nbsp;</div>';

			$("#TextBoxesGroup").append(html);

		    counter++;

	    });


  });
  
  


</script>  
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
						You're Here :: <a href="index.php">Home</a> :: <?php echo $text;?> Products
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

<table width="713" border="0" cellpadding="0" cellspacing="0">
                          <tbody><tr>
                            <td class="SiteTextBlack12" valign="top" align="left">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="SiteTextBlack12" valign="top" align="left" height="400">	
							<form id="frmHosting" name="frmHosting" method="post"  action="add_product_confs.php"enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
	<input type="hidden" name="counter" id="counter" value="0">
	<table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" class="text">
                              <tr>
                                <td width="35%">&nbsp;</td>
                                <td width="75%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
<tr>
                                <td align="right" >&nbsp;Category:</td>
								<?php
								$sqlQuery = "select * from   tbl_category order by c_id asc";
	$arrResultSet = $commonObject->selectMultiRecords($sqlQuery);	
								?>
								<td>&nbsp;<select name="c_id" id="c_id" style="width:305px;" >
																<option value=''>Select Category</option>

<?php

	for($i=0;$i<count($arrResultSet);$i++)
	{	
	if($arrResults[0]['c_id'] == $arrResultSet[$i]['c_id'])
	{
		$selected = "selected";
	}	
	else
		$selected = '';	
		
	?>
	<option value="<?php echo $arrResultSet[$i]['c_id']?>" <?php echo $selected?>><?php echo $arrResultSet[$i]['title']?></option>
	<?
	}
?>								
								</select>
								<script>$("#cid").val('<?php echo $arrResults[0]['c_id']?>');</script>
								</td>
                              </tr>							  
                              <tr>
                                <td align="right" >&nbsp;Product Name:</td>
								<td>&nbsp;<input type="text" name="title"  style="width:300px;" id="title" value="<?php echo $arrResults[0]['title']?>"  /></td>
                              </tr>	<tr>
                                <td align="right" >&nbsp;Description:</td>
								<td>&nbsp;<textarea name="detail" style="width:400px; height:200px;" id="detail"><?php echo $arrResults[0]['detail']?></textarea>
								 </td>
                              </tr>	                           	
                              <tr>
                                <td align="right" >&nbsp;Price:</td>
								<td>&nbsp;<input type="text" name="price" style="width:300px;" id="price" value="<?php echo $arrResults[0]['price']?>"  /></td>
                              </tr>	
													  						  							  
                            							  						  							  							  
                              							  							  
							  <tr>
							  	<td colspan="2"><br /><br /><strong>Set Images</strong></td>
							  </tr>							  							
<tr>
                                <td colspan="2"><div ><div class="galler_all">
								<?php
								//echo count($arrPhotoResult);
								if( count($arrPhotoResult) > 0)
								{
								?>
								<table width="700" border="0" align="center" cellpadding="4" cellspacing="0">
								<?php
								for($i=0;$i<count($arrPhotoResult);$i++)
								{
																
								?>
                                  <tr>
                                    <td><div id="gallery"><a href="./wadmin/gallaryimg/thumbnails/<?php echo $arrPhotoResult[$i]['image']?>" target="_blank"><img src="./wadmin/gallaryimg/thumbnails/<?php echo $arrPhotoResult[$i]['image']?>"  border="0" /></a></div><br />
									<a href="delete_pic_prod.php?pid=<?php echo $arrPhotoResult[$i]['photo_id']?>&id=<?php echo $_GET['id']?>&pic=<?php echo $arrPhotoResult[$i]['image']?>">Delete</a>
									</td>
									<?php $i = ($i+1);
									 if($arrPhotoResult[$i]['image'] != "")
									 {	
									?>
                                     <td><div id="gallery"><a href="./wadmin/gallaryimg/thumbnails/<?php echo $arrPhotoResult[$i]['image']?>" target="_blank"><img src="./wadmin/gallaryimg/thumbnails/<?php echo $arrPhotoResult[$i]['image']?>"  border="0" /></a></div><br />
									<a href="delete_pic_prod.php?pid=<?php echo $arrPhotoResult[$i]['photo_id']?>&id=<?php echo $_GET['id']?>&pic=<?php echo $arrPhotoResult[$i]['image']?>">Delete</a>
									</td>
									 <?php 
									 }
									 $i = ($i+1);
									 if($arrPhotoResult[$i]['image'] != "")
									 {
									 ?>
                                     <td><div id="gallery"><a href="./wadmin/gallaryimg/thumbnails/<?php echo $arrPhotoResult[$i]['image']?>" target="_blank"><img src="./wadmin/gallaryimg/thumbnails/<?php echo $arrPhotoResult[$i]['image']?>"  border="0" /></a></div><br />
									<a href="delete_pic_prod.php?pid=<?php echo $arrPhotoResult[$i]['photo_id']?>&id=<?php echo $_GET['id']?>&pic=<?php echo $arrPhotoResult[$i]['image']?>">Delete</a>
									</td>
									<?php
									}
									?>
                                  </tr>
								 <?php
								 }
								 ?> 
                                </table>
								<?php
								}
								?></div></div>
								</td>
                              </tr>
                              <tr>
                                <td colspan="2" align="right">
														
<div id='TextBoxesGroup'>

	<div id="TextBoxDiv1">
	</div>
</div>			
                  <bR /> &nbsp;<input type='button' value='Add Photo(s)' id='addButton' class="gray_btn">
                  </p>
								</td>
                              </tr>
							    								
                              <tr>
                                <td colspan="2" align="center">&nbsp;<br />
                                    <input type="submit" name="SaveChanges" value="Save Changes"  class="save_changes gray_btn"/>
                                  &nbsp;
                                    <input type="reset" name="reset" value="Reset"  class="reset gray_btn" />                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                            </table>
                            </form>                            
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
        <script>
            $(document).ready(function(){
               
					 $("#frmHosting").submit(function(){
												
                    if( typeof($("#textbox1").val())!="undefined" && ( $("#textbox1").length  >= 1 && $.trim($("#textbox1").val())!="" )){
                       
                    }else{
						if($("#gallery").html()==null){
							 alert("Please upload atleast 1 image");
							return false;
						}
                       
                    }
					
					
                });
               
            });
            </script>
	
	

<!-- End Document
================================================== -->
</body>
</html>