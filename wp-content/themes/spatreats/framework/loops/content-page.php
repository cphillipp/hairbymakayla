<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail()):
			$attr = array('class' => 'alignleft', 'title' => get_the_title());	
			 the_post_thumbnail('my-gallery',$attr); endif;?>
	<?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>','next_or_number' => 'number',
			'pagelink' => '%','echo' => 1 ) );?>
    <?php edit_post_link( __( 'Edit','spatreats' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- #post-<?php the_ID(); ?> -->
<?php global $my_theme_options;  $my_theme_options =  get_option('_mytheme_settings');?>
<?php  if(!isset($my_theme_options["codes"]['disable-spa-page-comment'])):?>
        <!-- **Blog Comment Entry** -->
        <div id="comments" class="comment-entry">
            <?php  comments_template('', true); ?>
        </div>
        <!-- **Blog Comment Entry - End** -->
<?php endif;?>    