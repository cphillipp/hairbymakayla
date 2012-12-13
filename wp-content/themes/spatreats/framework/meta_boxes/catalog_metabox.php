<?php 
add_action("admin_init", "catalog_metabox");
function catalog_metabox(){
	add_meta_box("catalog-post-meta-container", __('Item\'s Details ','spatreats'), "catalog_details", "catalog", "side", "high");
	add_action('save_post','catalog_item_meta_save');
}

function catalog_details(){
	global $post;
	$item = get_post_meta($post->ID,'_item_post_meta',TRUE);
	$subtitle 	= 	isset($item['sub-title']) ? $item['sub-title'] : NULL;
	$price 		=	isset($item['price']) ? $item['price'] : NULL;
	$rounded 	=	isset($item['rounded']) ? $item['rounded'] : 0;?>
	<div class="catalog-items-details">
	    <label><strong><?php _e('Sub title:','spatreats');?></strong></label>
        <br/>
        <textarea name="sub-title" cols="43" rows="3"><?php echo $subtitle;?></textarea>
        <br/>
        <em><?php _e('Please give sub title for the item.','spatreats'); ?></em>
        <br/>
        <br/>
        <label><strong><?php _e('Price:','spatreats');?></strong></label>
        <br/>
        <input type="text" class="small" name="price" value="<?php echo $price;?>"/>
        <br/>
        <em><?php _e('Enter item price here (eg : $12.50).','spatreats'); ?></em>
        <br/>
        <br/>
        <label><input type="checkbox" name="rounded" value="" <?php checked($rounded); ?> />
        <?php _e('Show Rounded Image','spatreats');?></label>
        
        
    </div>
<?php
}

function catalog_item_meta_save($post_id){
	$item = array();
	$item['sub-title'] =  isset( $_POST['sub-title']) ? $_POST['sub-title'] : NULL;
	$item['price'] =  isset( $_POST['price']) ? $_POST['price'] : NULL;
	$item['rounded'] =  isset( $_POST['rounded']) ? 1 : 0;
	
	update_post_meta($post_id, '_item_post_meta',array_filter($item));
}
?>