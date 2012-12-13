<?php add_action('init', 'gallery_register');
function gallery_register() {
		$labels = array(
		'name' => __('Gallery Items','spatreats'),
		'singular_name' =>__('Gallery Entry','spatreats'),
		'add_new' => __('Add New','spatreats'),
		'add_new_item' => __('Add New Gallery Entry','spatreats'),
		'edit_item' => __('Edit Gallery Entry','spatreats'),
		'new_item' => __('New Gallery Entry','spatreats'),
		'view_item' => __('View Gallery Entry','spatreats'),
		'search_items' => __('Search Gallery Entries','spatreats'),
		'not_found' =>  __('No Gallery Entries found','spatreats'),
		'not_found_in_trash' => __('No Gallery Entries found in Trash','spatreats'), 
		'parent_item_colon' => ''
	);
	
	$args = array(
		'labels' => $labels,
		'description'=>'This is cstom post type to hold Gallery items',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>'gallery','with_front'=>true),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'menu_position' => 21,
		'supports' => array('title','thumbnail','excerpt','editor','comments'),
		'menu_icon' => IAMD_FW_URL.'css/admin/images/icon_gallery.png'
	);
	
	 register_post_type( 'gallery',$args);
	 
	 register_taxonomy("gallery_entries", 
		array("gallery"), 
		array(	"hierarchical" => true, 
		"label" => "Categories", 
		"singular_label" => "Category", 
		"rewrite" => true,
		"query_var" => true
	));  
}

add_filter("manage_edit-gallery_columns", "gallery_edit_columns");
add_action("manage_posts_custom_column",  "gallery_columns_display",10,2);
function gallery_edit_columns($gallery_columns){
	$gallery_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"gallery-image"=>"Image",
		"title" => "Title",
		"author"=>"Author",
		"gallery_entries"=>"Categories",
		"tags"=>"Tags",
		"comments"=>"<span class='vers'><img src='".home_url()."/wp-admin/images/comment-grey-bubble.png' alt='Comments'></span>",
		"date"=>"Date"
	);

	return $gallery_columns;
}
 
function gallery_columns_display($gallery_columns,$id){
	global $post;
	switch ($gallery_columns):
		case "gallery-image":
			$data = get_post_meta( $id, '_gallery_post_meta', true );
			$images = ( isset($data["images"]) && is_array( unserialize( $data['images'] ) ) ) ? array_filter(  unserialize( $data['images'] ) ) : array();
			$images = !empty( $images) ? $images[0] :0;

			if($images > 0):
			
				$images = wp_get_attachment_image($images);
			else:
				$images = "No Image";
			endif;		
			
			echo $images;
		break;
		
		case "gallery_entries":
			echo get_the_term_list($post->ID, 'gallery_entries', '', ', ','');
		break;
	endswitch;
}?>