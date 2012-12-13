<?php global $my_theme_settings; ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>

        <div class="post-title">
            <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
            <span class="arrow"> </span>
        </div><!-- .post-title -->

        <div class="post-details">
            <div class="date">
                <span class="day"><?php echo  get_the_date('d');?></span>
                <span class="date-group">
                    <span class="month"><?php  echo get_the_date('M');?></span>
                    <span class="year"><?php echo  get_the_date('Y');?></span>
                </span>
                <span class="arrow"> </span> 
            </div><!-- .date -->

            <?php if ( comments_open() && ! post_password_required() ):?>
            <div class="post-comments">
                <?php comments_popup_link('<span class="count"> 0 </span>  <span class="comment">Comment</span>', 
                        '<span class="count">1</span>  <span class="comment">Comment</span>', '<span class="count">%</span> <span class="comment">Comment</span>');?>
                <span class="arrow"> </span>
            </div> <!-- .post-comments -->
            <?php endif;?>

            <div class="blog-post-social">
           	<?php if( isset($my_theme_settings["codes"]["post-facebook-status"])) facebook_button(urlencode(get_permalink($post->ID)));?>
           	<?php if( isset($my_theme_settings["codes"]["post-googleplus-status"])) google_plusone(urlencode(get_permalink($post->ID)));?>
            <?php if( isset($my_theme_settings["codes"]["post-twitter-status"])) tweet_button(get_the_title($post->ID),urlencode(get_permalink($post->ID)));?>
            </div>
        </div><!-- .post-details -->

        <div class="post-content">
            <?php $attachment  = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
                if( $attachment ):?>
                     <div class="post-thumb">
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
                     </div>
            <?php endif; ?>
            <?php the_content();?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>',
			'next_or_number' => 'number','pagelink' => '%','echo' => 1 ) );?>
            <?php if(get_the_tags($post->ID)) :?>
                <div class="post-tags">
                    <span></span>
                    <?php the_tags('',', ');?>
                </div> <!-- .post-tags -->
            <?php endif; ?>
            <?php edit_post_link( __( 'Edit','spatreats'), '<span class="edit-link">', '</span>' ); ?>
        </div><!-- .pos-content -->
    </div><!-- #post-<?php the_ID(); ?> -->

<?php global $my_theme_options;  $my_theme_options =  get_option('_mytheme_settings');?>
<?php  if(!isset($my_theme_options["codes"]['disable-spa-post-comment'])):?>
        <!-- **Blog Comment Entry** -->
        <div id="comments" class="comment-entry">
            <?php  comments_template('', true); ?>
        </div>
        <!-- **Blog Comment Entry - End** -->
<?php endif;?>