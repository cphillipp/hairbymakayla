<?php
ob_start();
add_action('admin_menu', 'create_admin_menu');
function create_admin_menu() {
	$role = get_role('administrator');
	if ( !$role->has_cap('manage_theme') ) {
		$role->add_cap('manage_theme');
	}

    if( function_exists('add_object_page') )  {
		$theme_name = wp_get_theme();
		 add_object_page ('General Settings',"$theme_name",'manage_theme','parent','generalSettings');
    }
	
	if(function_exists('add_submenu_page')){
	 	add_submenu_page ('parent',"$theme_name - options","Options",'manage_theme','parent','generalSettings');		
	}
}
get_template_part('framework/theme_options/settings');
ob_flush();?>