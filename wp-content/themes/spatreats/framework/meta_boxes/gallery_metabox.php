<?php 
add_action("admin_init", "gallery_metabox");
function gallery_metabox(){
	add_meta_box("gallery-post-meta-container", __('Gallery Images Settings','spatreats'), "gallery_settings", "gallery", "normal", "high");
	add_action('save_post','gallery_item_meta_save');
}

function gallery_settings($callback_args){ 
	global $post;
	$args = array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image', 'posts_per_page' => 7 );
	$media_query = new WP_Query($args);
	
	$data = get_post_meta( $post->ID, '_gallery_post_meta', true );?>
    	<h2><?php _e('Currently used images','spatreats');?></h2>
        <p id="j-no-images-container"><?php _e('Please, add some sliders','spatreats'); ?></p>
        <ul id="j-used-images-containers">
		<?php $images = ( isset($data["images"]) && is_array( unserialize( $data['images'] ) ) ) ? array_filter(  unserialize( $data['images'] ) ) : array(); 
            if( !empty($images) ):
                foreach( $images as $image_id ):
                    if( is_numeric($image_id) ):
                        $image = wp_get_attachment_image($image_id);
                        if( '' != $image ):?>
                            <li data-attachment-id="<?php echo(esc_attr($image_id));?>">
                            	<?php echo($image); ?>
                               	<span class="my_delete">x</span>
                               	<input type="hidden" value="<?php echo(esc_attr($image_id));?>" name="_used_image_id[]">
	                        </li>                                
                  <?php endif;
                    endif;
                endforeach;
            endif;?>
        </ul><!-- #j-used-images-containers-->
        
        <h2><?php _e("Choose effects:",'spatreats');?></h2>
        <?php $effects = array("fade","scrollLeft","scrollRight","scrollUp","scrollDown","slideX","slideY","turnUp","turnDown","turnLeft","turnRight","zoom",
			"fadeZoom","growX","growY");
			 sort($effects);
			 $p = (isset($data['effects']) && is_array( unserialize($data['effects'])) )? unserialize($data['effects'])  : array();
			 foreach( $effects as $effect): ?>
	         <label style="padding:5px; width:100px; float:left; display: block;">
             	<input type="checkbox" name="effects[]" value="<?php echo($effect);?>"<?php checked(in_array(esc_attr($effect),$p));?>/>  <?php echo(esc_html($effect));?>
             </label>
             <?php endforeach; ?> 
        
        <h2><?php _e("Add Image",'spatreats');?></h2>
        <ul id="j-available-images">
        	<?php foreach ($media_query->posts as $attachment):
					@$added_class = (  in_array( $attachment->ID, $images ,false ) ) ? ' class="my_added"' : ''; ?>
                    	<li <?php echo($added_class);?> data-attachment-id="<?php echo(esc_attr($attachment->ID));?>">
                        	<?php echo(wp_get_attachment_image( $attachment->ID));?>
				            <span class="my_delete">x</span>
                    	</li>                    
			<?php endforeach;?>	
        </ul><!-- #j-available-images -->
        
        <!-- Pagination -->
        <?php if ( $media_query->max_num_pages > 1 ): ?>
        		<div id="j-gallery-pagination" class="admin-pagination">
				  <?php  for ( $i=1; $i <= $media_query->max_num_pages; $i++ ): ?>
                    <a href="#" <?php echo( 1 == $i ? ' class="active_page"' : '' ) ?>><?php echo($i);?></a>
                  <?php endfor;?>
                </div>
        <?php endif; ?>	
        
<?php wp_reset_postdata(); ?>       
<?php }?>
<?php function gallery_item_meta_save( $post_id){
		$data = array();
		$data['images']  = isset($_POST['_used_image_id'])? serialize($_POST['_used_image_id']):NULL;
		$data['effects'] = isset($_POST['effects'])? serialize($_POST['effects']):NULL;
		update_post_meta($post_id, '_gallery_post_meta',array_filter($data));
	  }?>