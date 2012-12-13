<?php global $my_theme_settings; ?>
<?php get_header();?>
<!-- Post header code -->
<?php $header_section = ( isset($my_theme_settings["codes"]["post-top-code"])  && (isset($my_theme_settings["codes"]["enable-post-top-code"])) ) 
    ? $my_theme_settings["codes"]["post-top-code"] : '';
echo $header_section;?>
<!-- Post header code end-->
    	<!-- **Content Full Width** -->
    	<div class="content content-full-width">
        	<?php get_template_part( 'framework/loops/content', 'single-gallery' ); ?>
           <!-- Related Post Section -->
           <div class="hr_invisible"></div>
           <?php get_template_part( 'framework/loops/content', 'releated-gallery' ); ?>      
            <!-- Releated post section end -->                    
                  
            <!-- Post bottom code -->
            <?php $footer_section = ( isset($my_theme_settings["codes"]["post-bottom-code"])  && (isset($my_theme_settings["codes"]["enable-post-bottom-code"])) ) 
                ? $my_theme_settings["codes"]["post-bottom-code"] : '';
            echo $footer_section;?>
            <!-- Post bottom code end-->
        </div> <!-- **Content Full Width - End** -->   	
<?php get_footer();?>