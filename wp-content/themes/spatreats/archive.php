<?php get_header();?>
    	<!-- **Content Full Width** -->
    	<div class="content content-full-width">
        	<?php if( have_posts() ): ?>
        	<?php while ( have_posts() ) : the_post(); ?>
            <?php	get_template_part('framework/loops/content'); ?>
            <?php endwhile; ?>
            <?php else:?>
	            <div class="hr_invisible"> </div>
            	<h1><?php _e( 'Nothing Found', 'spatreats' ); ?></h1>
				<p><?php _e( 'Apologies, but no results were found for the requested archive.', 'spatreats' ); ?></p>
				<?php get_search_form(); ?>
            <?php endif;?>

            <!-- **Pagination** -->
            <div class="pagination">
				<div class="prev-post"> <?php previous_posts_link('<span> Prev Posts </span>');?> </div>           
                <div class="next-post"> <?php next_posts_link('<span> Next Posts </span>');?> </div>
                <?php my_pagination();?>
            </div><!-- **Pagination - End** -->

        </div><!-- **Content Full Width End** -->
<?php get_footer();?>