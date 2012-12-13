<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>

	<div class="post-title">
		<?php if(is_sticky()): ?>	
	        <div class="featured"><span><?php _e('Featured','spatreats');?></span></div>
        <?php endif;?>
		<h2>
        	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
	        <a href="<?php the_permalink(); ?>" class="tooltip-top readmore" title="<?php _e('Read More','spatreats');?>"> </a>
        <span class="arrow"> </span>
    </div><!-- .post-title -->
    
    <div class="post-details">
        <div class="date">
            <span class="day"><?php echo get_the_date('d');?></span>
            <span class="date-group">
                <span class="month"><?php echo get_the_date('M');?></span>
                <span class="year"><?php echo get_the_date('Y');?></span>
            </span>
            <span class="arrow"> </span> 
        </div><!-- .date -->
        <?php if ( comments_open() && ! post_password_required() ) : ?>
        <div class="post-comments">
        	<?php comments_popup_link('<span class="count"> 0 </span>  <span class="comment">Comment</span>', 
					'<span class="count">1</span>  <span class="comment">Comment</span>', '<span class="count">%</span> <span class="comment">Comment</span>');?>
            <span class="arrow"> </span>
        </div> <!-- .post-comments -->
        <?php endif;?>
    </div><!-- .post-details -->
    
    <div class="post-content">
    	<?php $attachment  = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
			if( $attachment ):?>
            	 <div class="post-thumb">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s'), the_title_attribute( 'echo=0' ) ); ?>">
                 	<?php  $attachment =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-blog');
					if($attachment[3]): #Original Size my-blog 
						if($attachment[1] == 850 && $attachment[2] == 340):?>
                       		<img alt="<?php the_title(); ?>" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>" />
                        <?php else: ?>
	                        <img alt="<?php the_title(); ?>" class="alignleft" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>" />
                    <?php endif; ?>
			<?php  else: #Image original size  ?>
						<img alt="<?php the_title(); ?>" class="alignleft" src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>" />
            <?php endif;?>
		            </a>
                 </div>
        <?php endif; ?>
        
		<?php echo wpe_excerpt('wpe_excerptlength_blog', 'wpe_no_excerptmore');?>
        <?php edit_post_link( __( 'Edit','spatreats'), '<span class="edit-link">', '</span>' ); ?>
    </div><!-- .pos-content -->
</div><!-- #post-<?php the_ID(); ?> -->