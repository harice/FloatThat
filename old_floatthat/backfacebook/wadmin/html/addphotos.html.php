<script>
function addElement() {

  var ni = document.getElementById('myDiv');

  var numi = document.getElementById('theValue');

  var num = (document.getElementById('theValue').value -1)+ 2;

  numi.value = num;

  var newdiv = document.createElement('div');

  var divIdName = 'my'+num+'Div';

  newdiv.setAttribute('id',divIdName);
var emp="'&nbsp;'";
  newdiv.innerHTML = '<div id="POITable" style="height:auto;margin-top:15px;"><div style="float:left;margin-left:-20px;" onclick="this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);"><img src="images/delete.jpg" style="margin-top:5px;"></div><div style="float:left;padding-left:2px;padding-top:1px;" class="s_txt">Title<br><input  style="padding:2px;margin-bottom:3px; width:200px;color:#000; font-size:11px" onclick="this.value='+emp+'" type="text" value="" rel="2"  name="title[]"><br>Image</div><br style="clear:both" /><div style="float:left;padding-left:2px;padding-top:1px;"><input  style="padding:2px;margin-bottom:3px; width:200px;color:#000; font-size:11px"  type="file" value="" rel="2"  name="userfile[]"></div></div><div style="clear:both; height:2px;" /></div>';ni.appendChild(newdiv);

}


</script>

        
     <form action="" method="post"  name="frm" enctype="multipart/form-data">
     
     <input type="hidden" name="photo_id" value="<?php echo $_REQUEST['photo_id'];?>">
              <table width="98%"  border="0" cellspacing="4" cellpadding="4" style="border:1px outset #00ff00; margin:10px 10px 10px 10px" >         
        
		     
             <tr><Td colspan="4" class="s_txt" align="center"><?php echo $this->params['errorMsg'];?></Td></tr>
             
             <tr>
               <Td colspan="4" class="tdbord" align="left"><b>Write caption and upload your photo in JPG,GIF and PNG format</b></Td></tr>
            <tr><td width="18%" height="30"></td></tr>
   
                 <tr>
                 <td  class="tdbord">Select Gallery: </td>
				 
                 <td width="49%" >
                 			
							
                 <select name="pro_id" style="border:1px solid #ccc; width:300px; font-size:12px; color:#999999 ">
								
						<?php foreach($this->paramsc['GalleryList'] as $cat){?>
						<option value="<?php echo $cat['pro_id'];?>" ><?php echo $cat['title'];?></option>
						<?php } 
						?>
						</select></td>
               </tr>
		     
            
            <tr>
	<th></th>
	<td valign="top">
     <input type="hidden" name="theValue" value="1" id="theValue" />
   <div id="myDiv" style="padding-left:0px; height:auto"> </div></td>
	<td width="33%" valign="top" style="padding-left:20px;">
   
	<input type="button" value="Add Photo" onclick="addElement();" />
	
	</td>
	</tr>
               
			  
              
		      <tr>
		        <td>&nbsp;</td>
		        <td colspan="2" align="left">
                
                <input name="updatebtn" type="submit" class="btn" id="button2" value="Upload Photo" onClick="return validateformuser();"></td>
	          </tr>
	        </table>
            </form>
           
    
    