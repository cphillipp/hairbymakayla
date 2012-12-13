<?php 
get_template_part('framework/theme_widgets/widget_custom_post');
get_template_part('framework/theme_widgets/widget_social_links');
get_template_part('framework/theme_widgets/widget_twitter');
add_action( 'widgets_init', 'my_widgets' );
function my_widgets(){
	#Custom Post Widget
	register_widget('MY_Custom_Post');
	
	#Social Links Widget
	register_widget('MY_Social_Links');
	
	#Twitter
	register_widget('MY_Twitter');
	
}?>