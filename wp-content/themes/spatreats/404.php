<?php get_header();?>
    	<!-- **Content Full Width** -->
    	<div class="content content-full-width">
        <?php $image_404 = isset($my_theme_options["general"]["404-image"]) ? $my_theme_options["general"]["404-image"] :"";?>
        <?php if(!empty($image_404)): ?>
        	<div class="error-image"> <img src="<?php echo $image_404;?>" alt="" title="" /> </div>
        <?php endif;?>    
            
            <h1 class="big-title"><?php _e('Probably 404!','spatreats');?></h1>
            <div class="clear"> </div>
            <a href="javascript:history.go(-1)" title="" class="back-btn"><?php _e('Back','spatreats');?> </a>    
            
            <div class="hr_invisible"> </div>        
            
             <div class="column one-third">
	            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('404 Page Column 1') ): endif;?>
    	     </div>

             <div class="column one-third">
	            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('404 Page Column 2') ): endif;?>
    	     </div>

             <div class="column one-third last">
	            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('404 Page Column 3') ): endif;?>
    	     </div>
            
        </div> <!-- **Content Full Width - End** -->
<?php get_footer();?>