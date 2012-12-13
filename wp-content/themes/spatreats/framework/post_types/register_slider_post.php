<?php
// Adding Slide Post Type 
add_action( 'init', 'create_sliders' );
function create_sliders() {
  $labels = array(
    'name' => __('Slides','spatreats'),
    'singular_name' => __('Slide','spatreats'),
    'add_new' => __('Add New','spatreats'),
    'add_new_item' => __('Add New Slide','spatreats'),
    'edit_item' => __('Edit Slide','spatreats'),
    'new_item' => __('New Slide','spatreats'),
    'view_item' => __('View Slide','spatreats'),
    'search_items' => __('Search Slides','spatreats'),
    'not_found' =>  __('No Slides found','spatreats'),
    'not_found_in_trash' => __('No Slides found in Trash','spatreats'),
    'parent_item_colon' => ''
  );

 $args = array(
		'labels' => $labels,
		'description'=>'This is cstom post type to hold Slider items',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>'slider'),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'menu_position' =>20,
		'supports' => array('title','thumbnail','editor')
		,'menu_icon' => IAMD_FW_URL.'css/admin/images/icon_slider.png'
 );

  register_post_type( 'slide',$args);
}
  
add_filter("manage_edit-slide_columns", "slide_edit_columns");
add_action("manage_posts_custom_column", "slide_columns_display",10,2);

function slide_edit_columns($slide_columns){
	$slide_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"id" => "ID",
		"slider-image"=>"Image",
		"title" => "Title",
		"author"=>"Author",
		"tags"=>"Tags",
		"comments"=>"<span class='vers'><img src='".home_url()."/wp-admin/images/comment-grey-bubble.png' alt='Comments'></span>",
		"date"=>"Date"
	);

	return $slide_columns;
}
 
function slide_columns_display($slide_columns,$id){
	switch ($slide_columns):
		case "id":
			echo $id;
		break;
		
		case "slider-image":
			$image =  wp_get_attachment_image(get_post_thumbnail_id($id));
			$image =  empty($image) ? "No Image" : $image ;
			echo $image;
		break;
	endswitch;
}?>