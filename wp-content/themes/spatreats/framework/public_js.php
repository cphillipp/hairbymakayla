<?php 
#add_action( 'wp_enqueue_scripts', 'add_google_fonts' );
add_action( 'wp_head', 'set_font_properties' );
add_action('wp_print_scripts', 'my_public_scripts');

 /*function add_google_fonts(){
	wp_enqueue_style( 'google_font_open_sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700&amp;subset=latin,latin-ext,cyrillic' );
}*/

function set_font_properties(){
	global $my_theme_settings;
	$general = isset($my_theme_settings["general"]) ? $my_theme_settings["general"] : array();
	
	$menu_font 		= isset($general['menu-font']) ? $general['menu-font'] :"Oswald";
	$title_font 	= isset($general['title-font']) ? $general['title-font'] :"Oswald";
	$script_font 	= isset($general['script-font']) ? $general['script-font'] :"Niconne";
	$body_font 		= isset($general['body-font']) ? $general['body-font'] : NULL;
	$footer_font 	= isset($general['footer-font']) ? $general['footer-font'] :"Norican";
							  	
	#Menu
	$menu_font			= ( $menu_font == "Open Sans Condensed") ? "Open Sans Condensed:300" : $menu_font;
	$menu_font			= str_replace(" ", "+",$menu_font);
	$menu_style 	    = "<link id='menu-font' href='".esc_url("http://fonts.googleapis.com/css?family=".$menu_font)."' rel='stylesheet' type='text/css'/>\n";
	
	$menu_font			= ( $menu_font == "Open+Sans+Condensed:300") ? "Open+Sans+Condensed" : $menu_font;
	$menu_font			= str_replace("+", " ",$menu_font);						  
	
	$menu_font_family   = "font-family: '" . esc_html($menu_font) . "', Arial, sans-serif";
	$menu_style		   .= "<style type='text/css'>
							ul.menu li a { {$menu_font_family} }														
							</style>\n";
	echo $menu_style;
	
	#Title Font
	$title_font			= str_replace(" ", "+",$title_font);
	$title_style 	    = "<link id='title-font' href='".esc_url("http://fonts.googleapis.com/css?family=".$title_font)."' rel='stylesheet' type='text/css'/>\n";
	$title_font			= str_replace("+", " ",$title_font);						  
	$title_font_family  = "font-family: '" . esc_html($title_font) . "', Arial, sans-serif";
	$title_style		.= "<style type='text/css'>
									.breadcrumb { {$title_font_family} }
									.sidebar h2 { {$title_font_family} }
									ul.cat-menu li a { {$title_font_family} }
									.categories-list ul li a { {$title_font_family} }
									.post-title h2 { {$title_font_family} }
									.post-details { {$title_font_family} } 
									.pagination { {$title_font_family} }
									.page-link a, .page-link span { {$title_font_family} }
									#sorting-container a { {$title_font_family} }
									.gallery-title h5 a { {$title_font_family} }
									.tabs ul li a { {$title_font_family} }
									.accordion li a { {$title_font_family} }
									a.tooltip  { {$title_font_family} }
									h1,h2,h3,h4,th,.button,input[type=submit] { {$title_font_family} }
									.widget.widget_calendar caption { {$title_font_family} }
									.sticky .post-title .featured  { {$title_font_family} }													
							</style>\n";
	echo $title_style;
	
	#script Font
	$script_font		= str_replace(" ", "+",$script_font);
	$script_style 	    = "<link id='script-font' href='".esc_url("http://fonts.googleapis.com/css?family=".$script_font)."' rel='stylesheet' type='text/css'/>\n";
	$script_font		= str_replace("+", " ",$script_font);						  
	$script_font_family = "font-family: '" . esc_html($script_font) . "', Arial, sans-serif";
	$script_style		.= "<style type='text/css'>
								.big-ico-button { {$script_font_family} }
								span.arctext { {$script_font_family} } 
								.notice  { {$script_font_family} }
								.back-btn { {$script_font_family} }
								table.price-table td.even { {$script_font_family} }
								#newsletter h2 { {$script_font_family} }
								.theme-default .nivo-caption h2 { {$script_font_family} }
							</style>\n";
	echo $script_style;
	
	
	#Footer Title Font
	$footer_font 		= isset($general['footer-font']) ? $general['footer-font'] : "Norican" ;
	$footer_font		= str_replace(" ","+", $footer_font);
	$footer_style 	    = "<link id='footer-font' href='".esc_url("http://fonts.googleapis.com/css?family=".$footer_font)."' rel='stylesheet' type='text/css'/>\n";
	$footer_font		= str_replace("+"," ", $footer_font);
	$footer_font_family = "font-family: '" . esc_html($footer_font) . "', Arial, sans-serif !important; ";
	$footer_style 	   .= "<style type='text/css'>#footer h2 { {$footer_font_family} }</style>\n";
	echo $footer_style;
		
	
	#Body Font	
	$body_font 			= isset( $general['body-font']) ? $general['body-font']:NULL;
	if($body_font != NULL):
		$body_font			= str_replace(" ","+",$body_font);
		$body_style 	    = "<link id='body-font' href='".esc_url("http://fonts.googleapis.com/css?family=".$body_font)."' rel='stylesheet' type='text/css'/>\n";
		$body_font			= str_replace("+"," ",$body_font);
		$body_font_family	= "font-family: '" . esc_html($body_font) . "', Arial, sans-serif !important; ";
		$body_style		   .= "<style type='text/css'>
									body { {$body_font_family} }
									input[type=text], input[type=password], input.text, textarea{ {$body_font_family} }
									.widget.widget_nav_menu ul.menu li a{ {$body_font_family} }
									#searchform input[type='text']{ {$body_font_family} }
									#footer .widget.social-widget h2{ {$body_font_family} }
								</style>\n";
		echo $body_style;
	endif;	
}

function my_public_scripts(){
 if(!is_admin()): 	
	global $post;
	global $my_theme_settings;

	$home_page  = get_option("page_on_front");
	$slider_options = NULL;


	if( $home_page > 0):
		$slider_meta =  get_post_meta( get_option("page_on_front"), '_sliders_post_meta', true );
		
	
		if( !empty($slider_meta)):
			$effects = isset($slider_meta['effects']) ? unserialize($slider_meta['effects']) : array();
			$effects = implode(",",$effects);
			$slider_options =  "var global_slider_settings = {\n";
			if( !empty( $effects ))
				$slider_options .= "\t effects:'{$effects}'\n";
			else
				$slider_options .= "\t effects:'random'\n";
					
			if( isset($slider_meta['slices']) )	
				$slider_options .= "\t ,slices : '{$slider_meta['slices']}' \n";
				
			if( isset( $slider_meta['boxCols']))
				$slider_options.= "\t ,boxCols: '{$slider_meta['boxCols']}' \n";
	
			if( isset( $slider_meta['boxRows']))
				$slider_options.= "\t ,boxRows: '{$slider_meta['boxRows']}' \n";
	
			if( isset($slider_meta['animSpeed']) )
				$slider_options .= "\t ,animSpeed : '{$slider_meta['animSpeed']}' \n";
				
			if( isset($slider_meta['pauseTime']))
				$slider_options .= "\t ,pauseTime : '{$slider_meta['pauseTime']}' \n";
				
			if( isset( $slider_meta['directionNav']))
				$slider_options.= "\t ,directionNav: true \n";
			else	
				$slider_options.= "\t ,directionNav: false \n";
			#if( isset( $slider_meta['directionNavHide']))
			#	$slider_options.= "\t ,directionNavHide:true \n";
			#else	
				$slider_options.= "\t ,directionNavHide:false \n";
				
			if( isset( $slider_meta['controlNav']))
				$slider_options.= "\t ,controlNav: true \n";
			else
				$slider_options.= "\t ,controlNav: false \n";
	
			#if( isset( $slider_meta['controlNavThumbs']))
			#	$slider_options.= "\t ,controlNavThumbs: true \n";
			#else
				$slider_options.= "\t ,controlNavThumbs: false \n";	
	
			if( isset( $slider_meta['pauseOnHover']))
				$slider_options.= "\t ,pauseOnHover: true \n";
			else
				$slider_options.= "\t ,pauseOnHover: false \n";	
				
			if( isset( $slider_meta['randomStart']))
				$slider_options.= "\t ,randomStart:true \n";
			
			$slider_options .= "};\n";	
		endif;
	endif;		
	
	echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
	echo $slider_options;
	echo "var global_settings = {\n \tajaxurl: '".admin_url( 'admin-ajax.php' )."'\n \t}; \n /* ]]> */ \n ";
	echo "</script>\n \n ";

	echo "\n<style type='text/css'>\n";	
		$css = "#home-slider { height:560px;}\n.slider-wrapper { height:555px; }\n#slider img { height:555px;}\n ";
		$css .= ".slider-container { width:1200px; }\n .slider-wrapper { width:1200px;}\n";
		if( !empty($slider_meta) && isset( $slider_meta['slider_height']) && isset($slider_meta['slider_width']) ):
			$width = $slider_meta['slider_width'].'px';
			$height1 = $slider_meta['slider_height'].'px';
			$height2 = ($slider_meta['slider_height']+5).'px';
			$css = "#home-slider { height:{$height2};}\n .slider-wrapper { height:{$height1}; }\n #slider img { height:{$height1}}\n ";
			$css .= ".slider-container { width:{$width}; }\n.slider-wrapper { width:{$width};}\n";			
		endif;
		echo $css;	
	echo "</style>\n";
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-validator',IAMD_FW_URL.'js/public/jquery.validate.min.js');
	
	if( is_front_page() ):
		wp_enqueue_script('slider-script',IAMD_FW_URL.'js/public/jquery.nivo.slider.js');	
	endif;
	
	
	if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1) ):
	      wp_enqueue_script( 'comment-reply' );
	endif;

	wp_enqueue_script('tooltip-script',IAMD_FW_URL.'js/public/jquery.tipTip.minified.js');
	wp_enqueue_script('arctext-script',IAMD_FW_URL.'js/public/jquery.arctext.js');
	wp_enqueue_script('toogle-script',IAMD_FW_URL.'js/public/animatedcollapse.js');
	wp_enqueue_script('organictabs-script',IAMD_FW_URL.'js/public/organictabs.jquery.js');
	wp_enqueue_script('jcarousel-script',IAMD_FW_URL.'js/public/jquery.jcarousel.min.js');

	wp_enqueue_script('spa-enquiry',IAMD_FW_URL.'js/public/spa.enquiryform.js');

	wp_enqueue_script('spa-enquiry',IAMD_FW_URL.'js/public/jquery.smartresize.js'); # To resize window v1.1
	wp_enqueue_script('spa-custom',IAMD_FW_URL.'js/public/spa.custom.js',false ,false,true);

	if(is_page_template('tpl-gallery.php')):
		$tpl_gallery_meta = get_post_meta($post->ID,'_tpl_gallery_meta',TRUE);
			wp_enqueue_script('isotope-script',IAMD_FW_URL.'js/public/isotope.js');
			wp_enqueue_script('cycle-plugin',IAMD_FW_URL.'js/public/jquery.cycle.all.js');
			wp_enqueue_script('custom',IAMD_FW_URL.'js/public/custom.js');
	endif;
	
	if(is_page_template('tpl-booknow.php')):
		wp_enqueue_script('spa-booknow',IAMD_FW_URL.'js/public/spa.booknow.js');
	endif;
	
	if(is_page_template('tpl-catalog.php')):
			$tpl_catalog_meta = get_post_meta($post->ID,'_tpl_catalog_meta',TRUE);
			if($tpl_catalog_meta['item_view'] == 'all'):
				wp_enqueue_script('spa-smothscroll',IAMD_FW_URL.'js/public/smoothscroll.js');
				wp_enqueue_script('spa-stickyfloat',IAMD_FW_URL.'js/public/stickyfloat.js',false,false,true);
			endif;
			
	endif;
	
	if( is_singular('gallery')):
		wp_enqueue_script('cycle-plugin',IAMD_FW_URL.'js/public/jquery.cycle.all.js');
	endif;
 endif;	
}?>