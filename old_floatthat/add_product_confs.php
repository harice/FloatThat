<?
	require_once("config.php");
	

	
//	print_r($_POST['color']);
//	exit;
//You do not need to alter these functions
function getHeight($image) {
	$sizes = getimagesize($image);
	$height = $sizes[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$sizes = getimagesize($image);
	$width = $sizes[0];
	return $width;
}
function resizeImage($image,$width,$height,$scale) {

	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	$source = imagecreatefromjpeg($image);
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$image,90);
	chmod($image, 0777);
	return $image;
}

function createThumbs( $photo_file, $pathToImages, $pathToThumbs, $thumbWidth, $thumbHeight ) 
{
	$ext_array = explode(".",$photo_file);
	$ext = $ext_array[count($ext_array) - 1];
  // open the directory
  //$dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  //while (false !== ($fname = readdir( $dir ))) 
  {
    // parse path for the extension
    $info = pathinfo($pathToImages . $photo_file);
    // continue only if this is a JPEG image
    //if ( strtolower($info['extension']) == 'jpg' ) 
    {
     // echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
	  if($ext == "gif")
     	 $img = imagecreatefromgif( "{$pathToImages}{$photo_file}" );
	  elseif($ext == "jpg" || $ext == "jpeg") 
	  {
	  
      	$img = imagecreatefromjpeg( "{$pathToImages}{$photo_file}" );
	  }		
	  elseif($ext == "png") 
	  	$img = imagecreatefrompng( "{$pathToImages}{$photo_file}" );
		
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
//echo "{$pathToThumbs}{$photo_file}";exit;
      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$photo_file}" );
    }
  }
  // close the directory
 // closedir( $dir );
}
// call createThumb function and pass to it as parameters the path 
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width. 
// We are assuming that the path will be a relative path working 
// both in the filesystem, and through the web for links

	$max_width = 180;
	$max_height = 135;
	
	if(trim($_POST['id']) == "")
	{
				$query = "
					insert into tbl_products  
												(
												  c_id,
												  title,
												  detail,
												  price,
												  date,
												  status,
												  user_id
												 )
												 values 
												 (
												 	'".$_POST['c_id']."',
													'".$_POST['title']."',
													'".$_POST['detail']."',
													'".$_POST['price']."',
													NOW(),
													1,
													'".$userContents['id']."'
												 )	
				";
				$result = mysql_query($query);
				$insert_id =  mysql_insert_id();
				
		for($i=1;$i<=$_POST['counter'];$i++)
		{
			$name = "textbox".$i;
			{
				if(trim($_FILES[$name]["tmp_name"]) != "")
				{
					  $photos = strtotime(date("Y-m-d  g:i"))."_1_".$_FILES[$name]["name"];
					  if(move_uploaded_file($_FILES[$name]["tmp_name"],"./wadmin/gallaryimg/gallaryphotos/" .$photos) )
					  {
							$photos = $photos;
							createThumbs( $photos, "./wadmin/gallaryimg/gallaryphotos/", "./wadmin/gallaryimg/thumbnails/",  $max_width, $max_height );
					  }	
				}	
				if($photos != "")
				{					
					$query = "insert into   tbl_photos( pro_id,photoname, date, image) 
							values
							(".$insert_id.",'".$photos."','".date("Y-m-d")."','".$photos."') ";	
					$result = mysql_query($query);
				}
			}	
		}
				
	}
	else
	{	
				  $query = "
					update tbl_products set
												  c_id = '".$_POST['c_id']."',
												  title = '".$_POST['title']."',
												  detail = '".$_POST['detail']."',
												  price = '".$_POST['price']."',
												  date	= NOW()										  											 
					where pro_id = '".$_POST['id']."'			
				";	
				$result = mysql_query($query);
		
		//$query = "delete from tbl_photos where pro_id = '".$_POST['id']."' ";
		//$result = mysql_query($query);
		
		for($i=1;$i<=$_POST['counter'];$i++)
		{
			$name = "textbox".$i;
			{
				if(trim($_FILES[$name]["tmp_name"]) != "")
				{
					  $photos = strtotime(date("Y-m-d  g:i"))."_1_".$_FILES[$name]["name"];
					  if(move_uploaded_file($_FILES[$name]["tmp_name"],"./wadmin/gallaryimg/gallaryphotos/" .$photos) )
					  {
							$photos = $photos;
							createThumbs( $photos, "./wadmin/gallaryimg/gallaryphotos/", "./wadmin/gallaryimg/thumbnails/",  $max_width, $max_height );

					  }	
				}	
				if($photos != "")
				{					
					$query = "insert into   tbl_photos( pro_id,photoname, date, image) 
							values
							(".$_POST['id'].",'".$photos."','".date("Y-m-d")."','".$photos."') ";	
					$result = mysql_query($query);
				}
			}	
		}
								
	}

	header("Location: my-products.php");
?>
