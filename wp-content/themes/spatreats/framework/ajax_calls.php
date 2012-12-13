<?php #####	 	PAGINATION FOR SLIDER IMAGES AT BACKEND HOME PAGE OPTION	##### ?>
<?php add_action('wp_ajax_show_slider_page', 'show_slider_page');?>
<?php function show_slider_page() {
		$page = intval($_POST['page']);
		$args = array( 'post_type' => 'slide', 'orderby' => 'id', 'order' => 'ASC', 'posts_per_page' => 5 , 'offset' => ( 5 * ( $page - 1 ) ));
		$slider_query = new WP_Query($args);
			foreach ($slider_query->posts as $slider): ?>
				<li data-attachment-id="<?php echo($slider->ID);?>">
					<?php echo wp_get_attachment_image(get_post_thumbnail_id($slider->ID)); ?>
                	<span class='my_delete'>x</span>
				</li>            
<?php		endforeach;
		die();	
} ?>
<?php #####	 	PAGINATION FOR SLIDER IMAGES AT BACKEND HOME PAGE OPTION	##### ?>
<?php add_action('wp_ajax_show_gallery_page', 'show_gallery_page');?>
<?php function show_gallery_page(){
		$page = intval($_POST['page']);
		$args = array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image', 'posts_per_page' => 7 , 'offset' => ( 7 * ( $page - 1 ) ));
		$media_query = new WP_Query($args);
			foreach ($media_query->posts as $attachment):?>
            <li data-attachment-id="<?php echo(esc_attr($attachment->ID));?>">
					<?php echo(wp_get_attachment_image( $attachment->ID));?>
                    <span class="my_delete">x</span>
            </li>
<?php		endforeach;
		die();
	  }?>
<?php #####		LOAD GALLERY ITEM USING AJAX CALL IN FRONT END		##### ?>
<?php add_action('wp_ajax_load_gallery_item', 'load_gallery_item_ajax_request');
	  add_action('wp_ajax_nopriv_load_gallery_item', 'load_gallery_item_ajax_request');
	  
	  function load_gallery_item_ajax_request(){
		  $pid = intval($_POST['pid']);
		  $action = $_POST['action'];
		  $post_type = get_post_type( $pid );
		  
		  $args = array('post_type'=>$post_type,'p'=>$pid);
		  query_posts($args);
		  the_post();
		 	  $more  = 0;
			  $slider = new MySlideShow($pid,'all');
			  #$slider->setImageSize('full');
			  $slider->setImageSize('my-gallery');
			  $slider->setPermalinkForAjaxCall(get_permalink());
			  $sliders = $slider->slideShow();?>
              	<div class="ajax_slide ajax_slide_<?php echo($pid);?>" data-slide-id="<?php echo($pid);?>">
                
                    <div class="column one-third no-margin gallery-entry">
                    	<h2><?php echo the_title();?></h2>
                        <?php the_content(); ?>
                    </div>

                	<div class="gallery-image-container column two-third no-margin last">
						<?php echo($sliders);?>
                        <?php if( intval($slider->getSliderCount()) > 1 ) : ?>
	                        <div class='nav'><a class='prev2' href='#'><?php _e('Prev','spatreats');?></a> <a class='next2' href='#'><?php _e('Next','spatreats');?></a></div>
                        <?php endif; ?>    
                    </div>
                </div>
<?php	  die();
	  }
?>