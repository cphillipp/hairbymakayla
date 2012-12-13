<?php global $my_theme_settings;

	#Display Everywhere
		register_sidebar(array(
			'name' 			=>	'Display Everywhere',
			'id'			=>	'display-everywhere-sidebar',
			'before_widget' => 	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> 	'</div>',
			'before_title' 	=> 	'<h2 class="widgettitle"><span>',
			'after_title' 	=> 	'</span></h2>'
		));
		
	#Sidebar Page		
		register_sidebar(array(
			'name' 			=>	'Sidebar Pages',
			'id'			=>	'page-sidebar',
			'before_widget' =>	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=>	'</div>',
			'before_title' 	=>	'<h2 class="widgettitle"><span>',
			'after_title'	=>	'</span></h2>'));

	#Book now  Page		
		register_sidebar(array(
			'name' 			=>	'Booknow Page',
			'id'			=>	'booknow-sidebar',
			'before_widget' =>	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=>	'</div>',
			'before_title' 	=>	'<h2 class="widgettitle"><span>',
			'after_title'	=>	'</span></h2>'));
			
			
	#404 Page		
		register_sidebar(array(
			'name' 			=>	'404 Page Column 1',
			'id'			=>	'404-sidebar-column1',
			'before_widget' =>	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=>	'</div>',
			'before_title' 	=>	'<h2 class="widgettitle"><span>',
			'after_title'	=>	'</span></h2>'));

		register_sidebar(array(
			'name' 			=>	'404 Page Column 2',
			'id'			=>	'404-sidebar-column2',
			'before_widget' =>	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=>	'</div>',
			'before_title' 	=>	'<h2 class="widgettitle"><span>',
			'after_title'	=>	'</span></h2>'));

		register_sidebar(array(
			'name' 			=>	'404 Page Column 3',
			'id'			=>	'404-sidebar-column3',
			'before_widget' =>	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=>	'</div>',
			'before_title' 	=>	'<h2 class="widgettitle"><span>',
			'after_title'	=>	'</span></h2>'));
			
			
	
	#Sidebar for Footer section
	$columns = array("full-width"=>"1","one-half"=>"2","one-third"=>"3","one-fourth"=>"4");
	$footer_columns = (isset($my_theme_settings['footer']) && isset($my_theme_settings['footer']['footer-columns']))?$columns[$my_theme_settings['footer']['footer-columns']]:4;
	
	for ($i = 1; $i <= $footer_columns; $i++){
		register_sidebar(array(
			'name' 			=>	'Footer - column'.$i,
			'id'			=>	"footer-column-{$i}",
			'before_widget' =>	'<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=>	'</div>',
			'before_title' 	=>	'<h2 class="widgettitle"><span>',
			'after_title' 	=>	'</span></h2>'
		));
	}
	
?>