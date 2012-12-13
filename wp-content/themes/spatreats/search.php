<?php get_header();?>
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
        
        	<?php if( have_posts() ): ?>
        	<?php while ( have_posts() ) : the_post(); ?>
            <?php	get_template_part('framework/loops/content','search'); ?>
            <?php endwhile; ?>
            <?php else:?>
            	<div class="hr_invisible"> </div>
            	<h1><?php _e( 'Nothing Found', 'spatreats' ); ?></h1>
				<h3><?php _e( 'Apologies, but no posts found in blog.', 'spatreats' ); ?></h3>
				<?php get_search_form(); ?>
            <?php endif;?>

            <!-- **Pagination** -->
            <div class="pagination">
				<div class="prev-post"> <?php previous_posts_link('<span> Prev Posts </span>');?> </div>           
                <div class="next-post"> <?php next_posts_link('<span> Next Posts </span>');?> </div>
                <?php my_pagination();?>
            </div><!-- **Pagination - End** -->
        </div> <!-- **Content Full Width - End** -->   	
<?php get_footer();?>