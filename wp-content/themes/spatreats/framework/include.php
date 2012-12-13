<?php global $my_theme_settings;
	  $my_theme_settings =  get_option('_mytheme_settings');
	  
	  global $my_google_fonts;
	  $my_google_fonts  = apply_filters( 'my_google_fonts', array('Open Sans', 'Kreon','Droid Sans','Droid Serif','Lobster','Yanone Kaffeesatz','Nobile','Crimson Text','Arvo'
				,'Tangerine','Cuprum','Cantarell','Philosopher','Josefin Sans','Dancing Script','Raleway','Bentham','Goudy Bookletter 1911','Quattrocento','Ubuntu','PT Sans'));
	sort($my_google_fonts);

global $global_menu_fonts;
global $global_title_fonts;
global $global_footer_heading_fonts;
global $global_script_fonts;
global $global_body_fonts;

	   $global_menu_fonts = apply_filters('global_menu_fonts',array('Cabin Condensed','Economica','Open Sans Condensed','Advent Pro','Share','Homenaje'));
	   sort($global_menu_fonts);

	   $global_title_fonts = apply_filters('global_title_fonts',array('Copse','Share','Bitter','Belgrano','Coda','Patua One','Cutive','News Cycle','Ruda','Varela'));
	   sort($global_title_fonts);

	   $global_footer_heading_fonts = apply_filters('global_footer_heading_fonts',array('Nothing You Could Do','Satisfy','Engagement','Dancing Script'));
	   sort($global_footer_heading_fonts);

	   $global_script_fonts = apply_filters('global_script_fonts',array('Damion','Yellowtail','Satisfy','Engagement','Dancing Script'));
	   sort($global_script_fonts);

	   $global_body_fonts = apply_filters('global_body_fonts',array('Telex','Headland One','Quattrocento','Enriqueta','Open Sans','Duru Sans','Cabin Condensed','PT Sans Narrow','Lato','Karla','Ruda'));
	   sort($global_body_fonts);
add_theme_support('post-thumbnails', array('post','page','slide','catalog'));

##TO PASS THEME CHECK ONLY
add_theme_support( 'automatic-feed-links' );
add_editor_style('custom-editor-style.css');

$bargs = array('default-color'=> '','default-image'=> '','wp-head-callback'=> '_custom_background_cb','admin-head-callback'=> '','admin-preview-callback'=> '');
add_theme_support('custom-background', $bargs);	

$hargs = array('default-image'=>'','random-default'=>false,'width'=>0,'height'=>0,'flex-height'=> false,'flex-width'=> false,'default-text-color'=> '',
		 'header-text'=> false,'uploads'=> true,'wp-head-callback'=> '','admin-head-callback'=> '','admin-preview-callback' => '',);
add_theme_support('custom-header', $hargs);
## END TO PASS THEME CHECK

set_post_thumbnail_size(250,300,true);
add_image_size('my-slider',1200,555,true);
add_image_size('my-blog',850,340,true);
add_image_size("my-post-thumb",54,54,true);
add_image_size("my-releated-post",280,120,true);
add_image_size("my-gallery",940,864,true);
add_image_size("one-fourth",233,179,true);
add_image_size("one-fourth-with-sidebar",173,133,true);
add_image_size("one-half",468,379,true);
add_image_size("one-half-with-sidebar",348,282,true);
add_image_size("one-third",311,253,true);
add_image_size("one-third-with-sidebar",232,188,true);
add_image_size("my-square","300","300",true);
add_theme_support('menus');
register_nav_menu('main','Main Menu');

get_template_part('framework/utils');
get_template_part('framework/public_js');	

## WE INCLUDE ALL JAVASCRIPTS , WHICH ARE NEEDED AT ADMIN SIDE
get_template_part('framework/admin_js');

##THEME OPTIONS PAGE
get_template_part('framework/theme_options/menu');

##Register Sidebars
get_template_part('framework/register_sidebars');

##Register Shortcodes
get_template_part('framework/register_shortcodes');

##Register Widgets
get_template_part('framework/register_widgets');

##Filters
get_template_part('framework/register_filters');

#CUSTOM POST TYPES
get_template_part('framework/post_types/register_slider_post');
get_template_part('framework/post_types/register_gallery_post');
get_template_part('framework/post_types/register_catalog_post');

#META BOXES
get_template_part('framework/meta_boxes/slider_metabox');
get_template_part('framework/meta_boxes/gallery_metabox');
get_template_part('framework/meta_boxes/page_template_metabox');
get_template_part('framework/meta_boxes/catalog_metabox');

get_template_part('framework/ajax_calls');?>