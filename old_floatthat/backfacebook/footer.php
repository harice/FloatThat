
<div class="footer">
       <div class="leftfot"> 
            
            <?php $catqry=mysql_query("select * from tbl_category");
			while($cat=mysql_fetch_array($catqry))
			{
		?>
    	<a href="<?php echo $apppath;?>index.php?m=productslist&cat_id=<?php echo $cat['c_id'];?>" target="_top"><?php echo $cat['title'];?></a> |
        <?php }?>
        
               
       </div>
       <div class="ri8fot">                          
          <?php $catqry=mysql_query("select * from tbl_mainmenu");
			while($cat=mysql_fetch_array($catqry))
			{
		?>
    	<a href="<?php echo $apppath;?>index.php?m=contents&m_id=<?php echo $cat['m_id'];?>" target="_top"><?php echo $cat['mainmenu'];?></a> |
        <?php }?>     
       </div>
        <div class="clear"></div>       
  </div>
    <div class="">
           <div class="leftfot"> 
  © 2013  Float that - Developed By <a href="http://www.esolpakistan.com" target="_blank" >ESol Pakistan</a>
           </div>
           <div class="ri8fot">                          
           <img src="images/shate_btns.jpg" width="166" height="22" alt="btns" /></div>
     <div class="clear"></div>       
    </div>
    
    


