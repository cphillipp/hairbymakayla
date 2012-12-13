<?php
// Adding Slide Post Type 
add_action( 'init', 'create_catalog' );
function create_catalog() {
  $labels = array(
    'name' => __('Catalog','spatreats'),
    'singular_name' => __('Catalog','spatreats'),
    'add_new' => __('Add New','spatreats'),
    'add_new_item' => __('Add New Item','spatreats'),
    'edit_item' => __('Edit Item','spatreats'),
    'new_item' => __('New Item','spatreats'),
    'view_item' => __('View Item','spatreats'),
    'search_items' => __('Search Items','spatreats'),
    'not_found' =>  __('No Items found','spatreats'),
    'not_found_in_trash' => __('No Items found in Trash','spatreats'),
    'parent_item_colon' => ''
  );

 $args = array(
		'labels' => $labels,
		'description'=>'This is cstom post type to hold Catalog items',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>'catalog'),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'menu_position' => 22,
		'supports' => array('title','thumbnail','editor'),
		'menu_icon' => IAMD_FW_URL.'css/admin/images/icon_slider.png'
 );

  register_post_type( 'catalog',$args);

	 register_taxonomy("item_category", 
		array("catalog"), 
		array(	"hierarchical" => true, 
		"label" => "Categories", 
		"singular_label" => "Category", 
		"rewrite" => true,
		"query_var" => true
	));  

  
}
  
add_filter("manage_edit-catalog_columns", "catalog_edit_columns");
add_action("manage_posts_custom_column", "catalog_columns_display",10,2);

function catalog_edit_columns($slide_columns){
	$slide_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"item-image"=>"Image",
		"title" => "Title",
		"author"=>"Author",
		"item_category"=>"Category",
		"tags"=>"Tags",
		"comments"=>"<span class='vers'><img src='".home_url()."/wp-admin/images/comment-grey-bubble.png' alt='Comments'></span>",
		"date"=>"Date"
	);

	return $slide_columns;
}
 
function catalog_columns_display($slide_columns,$id){
	global $post;
	switch ($slide_columns):
		
		case "item-image":
			$image =  wp_get_attachment_image(get_post_thumbnail_id($id));
			$image =  empty($image) ? "No Image" : $image ;
			echo $image;
		break;

		case "item_category":
			echo get_the_term_list($post->ID, 'item_category', '', ', ','');
		break;

	endswitch;
}?>