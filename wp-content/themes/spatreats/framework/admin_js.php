<?php 
add_action('admin_print_scripts', 'my_admin_panel_scripts');
add_action('admin_print_styles', 'my_admin_panel_styles');

function my_admin_panel_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('my-gallery-post-script',IAMD_FW_URL.'js/admin/my_gallery_post_script.js');
	wp_enqueue_script('my-page-template-script',IAMD_FW_URL.'js/admin/my_page_template.js');
	
	if( (isset($_GET['page']) && $_GET['page'] == 'parent') ):
		wp_enqueue_script('my-admin-panel-script',IAMD_FW_URL.'js/admin/my_themeoption.js');
	endif;
	wp_localize_script('custom_script', 'my_settings', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );		
}
function my_admin_panel_styles() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style('my-admin-css', IAMD_FW_URL.'css/admin/style.css');
}?>