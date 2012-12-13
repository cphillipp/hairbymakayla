<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php global $my_theme_options;  $my_theme_options =  get_option('_mytheme_settings');?>
	<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="generator" content="WordPress<?php bloginfo('version');?>" />
    
    <!-- To Check , is Responsive enabled  -->
    <?php if(isset( $my_theme_options["general"]["is_responsive"] )):?>
    		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php endif;?>
    <!-- Responsive check end -->
    
	<title><?php my_title();?></title>
    <!-- **Favicon** -->
    <?php $favicon = isset($my_theme_options["general"]["favicon"]) ? $my_theme_options["general"]["favicon"] : IAMD_BASE_URL.'images/favicon.ico'; ?>
    
	<link rel="shortcut icon" type="image/ico" href="<?php echo $favicon;?>"/>
    
	<!-- **CSS - stylesheets** -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="claymore/style.css" />
    

    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ie7.css" type="text/css" />
    <![endif]-->

    <!--[if IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/ie8.css" />
    <![endif]-->

    <!-- ** Child Theme**-->
    <?php $childtheme = isset($my_theme_options["general"]["theme"]) ? $my_theme_options["general"]["theme"] : 'spatreats'; 
		  $childtheme = "/themes/{$childtheme}";
		  $childtheme_css = "{$childtheme}/style.css";
		  $childtheme_responsive_css = "{$childtheme}/responsive.css";?>
		 <link href="<?php echo get_template_directory_uri().$childtheme_css;?>" rel="stylesheet" type="text/css" media="all" />
         
    <?php if(isset( $my_theme_options["general"]["is_responsive"] )):?>
    <!-- To Check , is Responsive enabled  -->
		    <link href="<?php echo get_template_directory_uri().'/responsive.css';?>" rel="stylesheet" type="text/css" />
            <link href="<?php echo get_template_directory_uri().$childtheme_responsive_css;?>" rel="stylesheet" type="text/css" media="all" />
	<!-- Responsive check end -->            
    <?php endif;?>
    
    <?php if( is_front_page() ): ?>
	    <link href="<?php echo get_template_directory_uri();?>/css/nivo-slider.css" rel="stylesheet" type="text/css" media="all" />
    <?php endif; ?>
    
    <?php is_moible_view();?>

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo get_bloginfo_rss('rss2_url');?>"/>

    <?php $header_section_code = ( isset($my_theme_options["codes"]["header-code"])  && (isset($my_theme_options["codes"]["enable-head-code"])) ) 
		? $my_theme_options["codes"]["header-code"] : '';
	echo $header_section_code;?>
   
	<?php wp_head();?>
</head>

<body <?php if(is_front_page()): echo "class='home'"; else: body_class(); endif; ?>>
<?php do_action('my_header_top'); ?>

<!-- **Header** -->
<div id="header">
	<div class="container">

    	<!-- **Top-Menu** -->
    	<div id="top-menu">
        	<?php $primaryMenu = NULL; 
				if (function_exists('wp_nav_menu')) :
					$primaryMenu = wp_nav_menu(array('theme_location'=>'main','menu_id'=>'','menu_class'=>'menu'
						,'fallback_cb'=>'my_default_navigation','echo'=>false,'walker' => new my_menu_walker())); 
				endif;
				if(!empty($primaryMenu)):
					echo $primaryMenu;
				endif;?>
        </div><!-- **Top-Menu - End** -->
       
        <!-- **Logo** -->
        <div id="logo">
        	<a href="<?php echo home_url();?>" title="<?php echo get_bloginfo('description');?>">
            <?php $logo = isset($my_theme_options["general"]["logo"]) ? $my_theme_options["general"]["logo"] : IAMD_BASE_URL.'/images/logo.png';?>
            	<img src="<?php echo $logo;?>" alt="<?php echo get_bloginfo('description');?>" title="<?php echo get_bloginfo('description');?>" />
            </a>
        </div><!-- **Logo - End** -->

        <!-- **Searchform** -->
        <?php get_search_form();?>
		<!-- **Searchform - End** -->
    </div>
</div><!-- **Header - End** -->

<?php if( is_front_page()): ?>
<!-- ** Home Slider** -->
<div id="home-slider">
	<div class="slider-container">

    	<div class="slider-wrapper theme-default">
		<?php $slider_meta = get_post_meta( get_option("page_on_front"), '_sliders_post_meta', true );
              $sliders = isset( $slider_meta['sliders'] ) ? unserialize( $slider_meta['sliders']) : NULL;
			  $width = $slider_meta['slider_width'];
			  $height= $slider_meta['slider_height'];
              if (is_front_page() && $sliders != NULL): ?>
                    <div id="slider" class="nivoSlider">
                    <?php foreach($sliders as $slider):
                                $p = get_post($slider);
								$title = NULL;
								$a_title = $p->post_title;
								$content = $p->post_content;
								if(!empty($content)):
									$title = "title='#htmlcaption-{$p->ID}'";
								endif;
                                $effect = ( get_post_meta($p->ID, '_slider_effect',TRUE)!= NULL ) ? "data-transition='".get_post_meta($p->ID, '_slider_effect',TRUE)."'" : NULL;
									
                                #$attachment =  wp_get_attachment_image_src(get_post_thumbnail_id($p->ID),'my-slider');
								$attachment =  wp_get_attachment_image_src(get_post_thumbnail_id($p->ID),'full');
								
								$link = get_post_meta($p->ID,'_custom_link',true);
								$img = "<img src='{$attachment[0]}' alt='' width='{$width}' height='{$height}' {$title}  {$effect} />";
								
								if(!empty($link)):
									echo "<a href='{$link}' title='{$a_title}'>{$img}</a>";
								else:
									echo $img;
								endif;
								
                            endforeach;?>
                    </div><!-- #slider -->
                    
		            <!-- Slider Data -->
					<?php   if (is_front_page() && $sliders != NULL):
                                foreach($sliders as $slider):
                                    $p = get_post($slider);
									$content = $p->post_content;
									if(!empty($content)):
	                                     echo "<div id='htmlcaption-{$p->ID}' class='nivo-html-caption'>";
    	                                 echo do_shortcode($content);
        	                             echo "</div>";
									endif;										 
                                endforeach;
                            endif;?><!-- Slider Data End -->
        </div> <!-- .slider-wrapper -->    
       <?php endif;?> 
    </div><!-- .slider-container -->

</div><!-- **Home Slider - End** -->
<?php endif;?>

<!-- ** Main** -->
<div id="main">
    <?php if( !is_front_page() ):
	
			if((!isset( $my_theme_options["general"]["is_breadcrumb_disabled"])) ):
				#Breadcrumb
				if(class_exists('my_breadcrumb')):
					 $bc = new my_breadcrumb;
				endif;
		 	 else:
		  		 global $post;		
			  	echo "<div class='breadcrumb'> <div class='container'><h1 class='current-crumb'>".$post->post_title."</h1></div> </div>";
			 endif;	
		  endif;?>
                    
	<!-- **Main Container** -->
	<div class="main-container">