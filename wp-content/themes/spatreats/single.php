<?php global $my_theme_settings; ?>
<?php get_header();?>
<!-- Post header code -->
<?php $header_section = ( isset($my_theme_settings["codes"]["post-top-code"])  && (isset($my_theme_settings["codes"]["enable-post-top-code"])) ) 
    ? $my_theme_settings["codes"]["post-top-code"] : '';
echo $header_section;?>
<!-- Post header code end-->
    	<!-- **Content Full Width** -->
    	<div class="content content-full-width">
        
        	<!-- **Blog Header** -->
        	<div class="blog-header">
            	<ul class="cat-menu">
                    <li><a href="#" rel="toggle[categories]" title=""><?php _e('Categories','spatreats');?><span class="arrow-down"> </span> </a></li>
                    <li><a href="#" rel="toggle[archives]" title=""><?php _e('Archive','spatreats');?><span class="arrow-down"> </span></a> </li>
                </ul>
                <div id="categories" class="categories-list">      
                	<ul><?php wp_list_categories('show_count=1&echo=1&title_li=&depth=1&hide_empty=0&orderby=ID');?></ul>                                      	
                </div><!-- #categories -->
                
                <div id="archives" class="categories-list">
            		<ul><?php wp_get_archives('type=monthly'); ?></ul>
        		</div>
                         
            </div><!-- **Blog Header - End** -->
            
        
        	<?php if( have_posts() ): 
					while ( have_posts() ) : the_post();
            			get_template_part( 'framework/loops/content', 'single' ); 
					endwhile; // end of the loop. 
           		  endif;?>
                  
           <!-- Related Post Section -->
           <div class="hr_invisible"></div>
           <?php echo do_shortcode('[related-post/]'); ?>      
            <!-- Releated post section end -->                    
                  
                  

                <!-- Post bottom code -->
                <?php $footer_section = ( isset($my_theme_settings["codes"]["post-bottom-code"])  && (isset($my_theme_settings["codes"]["enable-post-bottom-code"])) ) 
                    ? $my_theme_settings["codes"]["post-bottom-code"] : '';
                echo $footer_section;?>
                <!-- Post bottom code end-->

                  
        </div> <!-- **Content Full Width - End** -->   	
<?php get_footer();?>