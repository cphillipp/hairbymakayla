<?php global $my_theme_settings; ?>
<?php if( have_posts() ): 
		while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('gallery-post'); ?>>
    <!-- **Gallery Wrapper -->
    <div class="gallery-wrapper">
        <!-- **Gallery Details** -->
        <div class="single-gallery-details">
			<div class="single-gallery-details-inner">
            	<div class="column one-third no-margin gallery-entry">
                	<h2><?php the_title();?></h2>
                    <?php the_content();?>
                </div>
                <div class="single-gallery-image-container gallery-image-container column two-third no-margin last">
                	<?php $the_id = get_the_ID(); 
						  $slider = new MySlideShow($the_id,'all');
						  $slider->setImageSize('my-gallery');
						  $sliders = $slider->slideShow();
						  echo $sliders;
						   if( intval($slider->getSliderCount()) > 1 ) : ?>
		                       <div class='nav'><a class='prev2' href='#'><?php _e('Prev','spatreats');?></a> <a class='next2' href='#'><?php _e('Next','spatreats');?></a></div>
                        <?php endif; ?>    
                </div>
            </div><!-- **Single Gallery Details Inner - End** -->

            <div class="pagination">
                <div class="prev-post"> <?php previous_post_link('%link','<span>'.__('Prev Post','spatreats').'</span>');?> </div>           
                <div class="next-post"> <?php next_post_link('%link','<span>'.__('Next Post','spatreats').'</span>');?> </div>
            </div><!-- **Pagination - End** -->

            
        </div><!-- **Single Gallery Details - End** -->
    </div><!-- **Gallery Wrapper** -->
    <?php edit_post_link( __( 'Edit','spatreats'), '<span class="edit-link">', '</span>' ); ?>
</div><!-- #post-<?php the_ID(); ?> -->
<?php  endwhile;
	endif;?>	