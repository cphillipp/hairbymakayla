<?php global $my_theme_settings; ?>
<?php get_header();?>
		<?php $is_fullwidth_page = ( get_post_meta($post->ID,'_fullwidthpage',TRUE) == "1") ? "content-full-width" : NULL; ?>
    	<!-- **Content Full Width** -->
    	<div class="content <?php echo $is_fullwidth_page; ?>">
        
        <!-- Page header code -->
		<?php $header_section = ( isset($my_theme_settings["codes"]["page-top-code"])  && (isset($my_theme_settings["codes"]["enable-page-top-code"])) ) 
            ? $my_theme_settings["codes"]["page-top-code"] : '';
        echo $header_section;?>
        <!-- Page header code end-->
        
        	<?php if( have_posts() ): ?>
        	<?php while ( have_posts() ) : the_post(); ?>
            
            	<?php get_template_part( 'framework/loops/content', 'page' ); ?>
                
            	<?php #comments_template( '', true ); ?>
                
			<?php endwhile; // end of the loop. 
           		  endif;?>
            
        </div> <!-- **Content Full Width - End** -->
      	<?php if( empty($is_fullwidth_page) ):?>
         <!-- **Sidebar** -->
    	<div class="sidebar">
        	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('display-everywhere-sidebar') ): endif;?>        
	        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page-sidebar') ): endif;?>
        </div>
        <?php endif; ?>

        <!-- Page footer code -->
		<?php $footer_section = ( isset($my_theme_settings["codes"]["page-bottom-code"])  && (isset($my_theme_settings["codes"]["enable-page-bottom-code"])) ) 
            ? $my_theme_settings["codes"]["page-bottom-code"] : '';
        echo $footer_section;?>
        <!-- Page footer code end-->

        
<?php get_footer();?>