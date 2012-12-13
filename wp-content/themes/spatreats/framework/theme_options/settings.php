<?php ob_start();
function generalSettings(){ 
	global $my_google_fonts;
	global $global_menu_fonts;
	global $global_title_fonts;
	global $global_footer_heading_fonts;
	global $global_script_fonts;
	global $global_body_fonts;
	global $my_theme_settings;
	$themename = ucfirst (wp_get_theme());

##FORM SUBMIT PROCESS
	if ( isset ( $_REQUEST['page'] ) && ( $_REQUEST['page'] == "parent") ):
		if ( isset ($_REQUEST['action']) && ( 'save' == $_REQUEST['action'] ) ):
			
			if( !empty( $_REQUEST['spa-home-page'])  ):
				update_option("page_on_front", $_REQUEST['spa-home-page']);
				update_option("show_on_front","page");
				$data = array();
				$data['slider_height'] = isset($_POST['height']) ? $_POST['height'] : '555';
				$data['slider_width'] = isset($_POST['width']) ? $_POST['width'] : '1200';
				$data['sliders']  = isset($_POST['_used_slider_id'])? serialize($_POST['_used_slider_id']):NULL;
				$data['effects'] = isset($_POST['effects'])? serialize($_POST['effects']):NULL;
				$data['slices'] = isset($_POST['slices'])? $_POST['slices']:NULL;
				$data['animSpeed'] = isset($_POST['animSpeed'])? $_POST['animSpeed']:NULL;
				$data['pauseTime'] = isset($_POST['pauseTime'])? $_POST['pauseTime']:NULL;
				$data['boxCols'] = isset($_POST['boxCols'])? $_POST['boxCols']:NULL;
				$data['boxRows'] = isset($_POST['boxRows'])? $_POST['boxRows']:NULL;
				$data['pauseOnHover'] = isset( $_POST['pauseOnHover'] ) ? 1 : 0;
				$data['randomStart'] = isset( $_POST['randomStart'] ) ? 1 : 0;
				$data['directionNav'] = isset( $_POST['directionNav'] ) ? 1 : 0;
				$data['controlNav'] = isset( $_POST['controlNav'] ) ? 1 : 0;
				update_post_meta($_REQUEST['spa-home-page'], '_sliders_post_meta',array_filter($data));
			endif; 

			if( !empty( $_REQUEST['spa-blog-page'])  ):
				update_option("page_for_posts", $_REQUEST['spa-blog-page']);
				update_option("show_on_front","page");
			endif;
			
			if( (empty($_REQUEST['spa-home-page']))  && ( empty( $_REQUEST['spa-blog-page'])) ):
				update_option("page_on_front", 0);
				update_option("page_for_posts", 0);
				update_option("show_on_front","post");
			endif;
			
			if(empty($_REQUEST['spa-home-page'])):
				update_option("page_on_front", 0);
				update_option("show_on_front","post");
			endif;
			
			#General Settings
			$logo 		= !empty($_REQUEST['spa-logo']) ? $_REQUEST['spa-logo']:NULL;
			$favicon 	= !empty($_REQUEST['spa-favicon']) ? $_REQUEST['spa-favicon']:NULL;
			$image_404 	= !empty($_REQUEST['spa-404-image']) ? $_REQUEST['spa-404-image']:NULL;
			
			$menu_font  = ( (!empty($_REQUEST['spa-menu-font'])) && ($_REQUEST['spa-menu-font']!="Select Menu Font") ) ? $_REQUEST['spa-menu-font']:NULL;
			$title_font = ( (!empty($_REQUEST['spa-title-font'])) && ($_REQUEST['spa-title-font'] != "Select Title Font") ) ? $_REQUEST['spa-title-font']:NULL;
			$script_font  = ( (!empty($_REQUEST['spa-script-font'])) && ($_REQUEST['spa-script-font'] != "Select Script Font") ) ? $_REQUEST['spa-script-font']:NULL;
			$body_font  = ( (!empty($_REQUEST['spa-body-font'])) && ($_REQUEST['spa-body-font'] != "Select Body Font") ) ? $_REQUEST['spa-body-font']:NULL;
			$footer_font  = ( (!empty($_REQUEST['spa-footer-font'])) && ($_REQUEST['spa-footer-font'] != "Select Footer Font") ) ? $_REQUEST['spa-footer-font']:NULL;
			$theme =  isset($_REQUEST['_current_theme']) ? $_REQUEST['_current_theme'] : 'spatreats';
			
			$is_responsive = ( (!empty($_REQUEST['is-spa-responsive'])) && ($_REQUEST['is-spa-responsive']=="true")) ? $_REQUEST['is-spa-responsive'] : NULL;
			$is_mobile_slider_disabled = ( (!empty($_REQUEST['disable-silder-in-mobile'])) && ($_REQUEST['disable-silder-in-mobile']=="true")) ? 
										$_REQUEST['disable-silder-in-mobile'] : NULL;
										
			$is_breadcrumb_disabled = isset($_REQUEST['disable-spa-breadcrumb']) ? 1 : NULL;										
			
										var_dump($is_breadcrumb_disabled);	
			
			$general = array_filter(array("logo"=>$logo,"favicon"=>$favicon,"404-image"=>$image_404,"theme"=> $theme, "menu-font"=>$menu_font,"title-font"=>$title_font,"script-font"=>$script_font,
								"body-font"=>$body_font, "footer-font"=>$footer_font, "is_responsive"=>$is_responsive , "is_mobile_slider_disabled"=>$is_mobile_slider_disabled, "is_breadcrumb_disabled"=>$is_breadcrumb_disabled));
								
							
							

			$settings["general"] = $general;
			
			#Social Links
			$facebook =  !empty($_REQUEST['spa-facebook']) ? $_REQUEST['spa-facebook'] : NULL;
			$rss 	  =  !empty($_REQUEST['spa-rss']) ? $_REQUEST['spa-rss'] : NULL; 
			$twitter  =  !empty($_REQUEST['spa-twitter']) ? $_REQUEST['spa-twitter'] : NULL;
			$youtube  =  !empty($_REQUEST['spa-youtube']) ? $_REQUEST['spa-youtube'] : NULL;
			$flickr   =  !empty($_REQUEST['spa-flickr']) ? $_REQUEST['spa-flickr'] : NULL;
			$social = array_filter(array("facebook"=>$facebook,"rss"=>$rss,"twitter"=>$twitter,"youtube"=>$youtube,"flickr"=>$flickr));
			$settings["social"] = $social;

			#Footer settings
			$footer_columns = ( (!empty($_REQUEST['spa-footer-columns'])) && ($_REQUEST['spa-footer-columns'] != "Select") ) ? $_REQUEST['spa-footer-columns'] : NULL;
			$copyright = !empty($_REQUEST['spa-copyright-text']) ? $_REQUEST['spa-copyright-text'] : NULL;
			$footer = array_filter( array("footer-columns"=>$footer_columns , "copyright"=>$copyright) );
			$settings["footer"] = $footer;
			
			#Code 
			$header_code =  !empty( $_REQUEST['spa-head-code']) ? trim(stripslashes($_REQUEST['spa-head-code'])) : NULL;
			$header_code_status = isset($_REQUEST['enable-spa-head-code']) ? 1: NULL;
			$footer_code = !empty( $_REQUEST['spa-body-code']) ? trim(stripslashes($_REQUEST['spa-body-code'])) : NULL;
			$footer_code_status = isset($_REQUEST['enable-spa-body-code']) ? 1: NULL;
			$post_top_code =  !empty($_REQUEST['spa-single-post-top-code']) ? trim(stripslashes($_REQUEST['spa-single-post-top-code'])) : NULL;
			$post_top_code_status = isset($_REQUEST['enable-spa-single-post-top-code']) ? 1 : NULL;
			$post_bottom_code = !empty($_REQUEST['spa-single-post-bottom-code']) ? trim(stripslashes($_REQUEST['spa-single-post-bottom-code'])) : NULL;
			$post_bottom_code_status = isset($_REQUEST['enable-spa-single-post-bottom-code']) ? 1 : NULL;
			$post_facebook_status =  isset($_REQUEST['enable-spa-single-post-facebook']) ? 1 : NULL;
			$post_googleplus_status = isset($_REQUEST['enable-spa-single-post-googleplus']) ? 1 : NULL;
			$post_twitter_status = isset($_REQUEST['enable-spa-single-post-twitter']) ? 1 : NULL;
			$is_post_comment_disabled =  isset($_REQUEST['disable-spa-post-comment']) ? 1 : NULL;
			
			
			$page_top_code =  !empty($_REQUEST['spa-single-page-top-code']) ? trim(stripslashes($_REQUEST['spa-single-page-top-code'])) : NULL;
			$page_top_code_status = isset($_REQUEST['enable-spa-single-page-top-code']) ? 1 : NULL;
			$page_bottom_code = !empty($_REQUEST['spa-single-page-bottom-code']) ? trim(stripslashes($_REQUEST['spa-single-page-bottom-code'])) : NULL;
			$page_bottom_code_status = isset($_REQUEST['enable-spa-single-page-bottom-code']) ? 1 : NULL;
			$is_page_comment_disabled = isset($_REQUEST['disable-spa-page-comment']) ? 1 : NULL;

			$codes = array_filter (array("header-code"=>$header_code,"enable-head-code"=>$header_code_status,
						"footer-code"=>$footer_code,"enable-footer-code"=>$footer_code_status,
						"post-top-code"=>$post_top_code,"enable-post-top-code"=> $post_top_code_status,
						"post-bottom-code"=>$post_bottom_code,"enable-post-bottom-code"=>$post_bottom_code_status,
						"post-facebook-status"=>$post_facebook_status,"post-googleplus-status"=>$post_googleplus_status,"post-twitter-status"=>$post_twitter_status,
						"disable-spa-post-comment"=>$is_post_comment_disabled,
						"page-top-code"=>$page_top_code, "enable-page-top-code"=>$page_top_code_status,
						"page-bottom-code"=>$page_bottom_code, "enable-page-bottom-code"=>$page_bottom_code_status
						,"disable-spa-page-comment"=>$is_page_comment_disabled));
			$settings["codes"] = $codes;
			update_option('_mytheme_settings', array_filter($settings));
			header("Location: admin.php?page=parent&saved=true");
		elseif(isset ($_REQUEST['action']) && ( 'reset' == $_REQUEST['action'] )):
			delete_option('_mytheme_settings');
			#To set home and blogpage
			update_option("show_on_front","post");
			update_option("page_on_front", 0);
			update_option("page_for_posts", 0);
			header("Location: admin.php?page=parent&reset=true");
		endif;
	endif;
	## END OF FORM PROCESS ##	
	if ( isset ($_REQUEST['saved']) && ($_REQUEST['saved'] ) )echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( isset ($_REQUEST['reset']) && ($_REQUEST['reset'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
##FPRM SUMBIT PROCESS END?>
<!-- wrapper -->
<div id="wrapper">
	<!-- panel-wrap -->
	<div id="panel-wrap">
    
        	<!-- bpanel-wrapper -->
            <div id="bpanel-wrapper">

            	<!-- bpanel -->
            	<div id="bpanel">

	               	<!-- bpanel-left -->
                	<div id="bpanel-left">     
                    	<div id="logo"> <img src="<?php echo IAMD_FW_URL.'css/admin/images/logo.png';?>" alt="" title="" /> </div>
                        <ul id="epanel-mainmenu">
                        	<li> <a href="#general" title="<?php _e('General Settings','spatreats');?>">
                            		<span class="general"> </span><?php _e('General Settings','spatreats');?></a> </li>
                                    
                            <li> <a href="#integration" title="<?php _e('Integration','spatreats');?>"> 
                            		<span class="integration"> </span><?php _e('Integration','spatreats');?></a> </li>

                            <li> <a href="#appearance" title="<?php _e('Appearance','spatreats');?>">
                            		<span class="appearance"></span><?php _e('Appearance','spatreats');?></a></li>
                                    
                            <li> <a href="#responsive" title="<?php _e('Responsive','spatreats');?>">
                            		<span class="responsive"></span><?php _e('Responsive','spatreats');?></a></li>        
                        </ul>

                    </div> <!-- bpanel-left ends -->               

                    

                    <form method="post">
                    <!-- #general -->
                    <div id="general" class="bpanel-content">
                    	<div class="bpanel-main-content">
                        
                            <ul class="sub-panel">   
                                <li><a href="#my_general"><?php _e("General",'spatreats');?></a></li>
                                <li><a href="#my_home"><?php _e("Home",'spatreats');?></a></li>
                                <li><a href="#my_blog"><?php _e("Blog",'spatreats');?></a></li>	
                                <li><a href="#social_media"><?php _e("Social Media Links",'spatreats');?></a></li>
                                <li><a href="#my_footer"><?php _e("Footer",'spatreats');?></a></li>
                            </ul>
                        <?php $general		= isset($my_theme_settings["general"]) ? $my_theme_settings["general"] : array();
                        	  $logo 		= isset($general['logo'])?$general['logo']:'';
							  $image_404 	= isset($general['404-image'])?$general['404-image']:'';
                        	  $favicon 		= isset($general['favicon'])?$general['favicon']:'';
							  $menu_font 	= isset($general['menu-font']) ? $general['menu-font'] :NULL;
							  $title_font 	= isset($general['title-font']) ? $general['title-font'] :NULL;
							  $script_font 	= isset($general['script-font']) ? $general['script-font'] : NULL;
							  $body_font 	= isset($general['body-font']) ? $general['body-font'] : NULL;
							  $footer_font 	= isset($general['footer-font']) ? $general['footer-font'] : NULL;
							  $is_breadcrumb_disabled = isset($general['is_breadcrumb_disabled']) ? $general['is_breadcrumb_disabled'] : NULL;?>
                              
                        <!-- General tab-content -->
                        <div id="my_general" class="tab-content"> 
                        	<div class="bpanel-box">
                            
                            	<div class="box-title"><h3><?php _e('Logo','spatreats');?></h3></div>
                                <div class="box-content">
                                   <input id="spa-logo" name="spa-logo" type="text" class="uploadfield" value="<?php echo(esc_html($logo));?>" />
                                   <p><?php _e('Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)','spatreats');?></p>
                                   <input type="button" value="<?php _e('Upload Image','spatreats');?>" class=" black upload_image_button" />
                                   <input type="button" value="<?php _e('Remove','spatreats');?>" class="black upload_image_reset" />
                                </div>

                               	<div class="box-title"> <h3><?php _e('Favicon','spatreats');?></h3> </div>
                                <div class="box-content">
                                   <input id="spa-favicon" name="spa-favicon" class="uploadfield" type="text" value="<?php echo(esc_html($favicon));?>" />
                                   <p><?php _e('Upload a favicon for your theme, or specify the image address of your online.(http://yoursite.com/favicon.gif)','spatreats');?></p>
                                   <input type="button" value="<?php _e('Upload Image','spatreats');?>" class="black upload_image_button" />
                                   <input type="button" value="<?php _e('Remove','spatreats');?>" class="black upload_image_reset" />
                                </div>

                               	<div class="box-title"> <h3><?php _e('404 Image','spatreats');?></h3> </div>
                                <div class="box-content">
                                   <input id="spa-404-image" name="spa-404-image" class="uploadfield" type="text" value="<?php echo(esc_html($image_404));?>" />
                                   <p><?php _e('Upload a image for the 404 page in your theme, or specify the image address of your online.','spatreats');?></p>                                   
                                   <input type="button" value="<?php _e('Upload Image','spatreats');?>" class="black upload_image_button" />
                                   <input type="button" value="<?php _e('Remove','spatreats');?>" class="black upload_image_reset" />
                                </div>
                                
                                <div class="box-title"><h3><?php _e('Disable Breadcrumbs','spatreats');?></h3></div>
                                <div class="box-content">
                                	<input class="bpanel-checkbox" type="checkbox" name="disable-spa-breadcrumb" id="disable-spa-breadcrumb"  
									<?php checked($is_breadcrumb_disabled);?>/>
                                    <label class="bpanel-label"><?php _e('Globally Disable Breadcrumbs','spatreats');?></label>                                
                                <p><?php _e('Check if you do not want breadcrumbs to display anywhere in your site.','spatreats');?></p>
                                </div>



	                            <div class="box-title"><h3><?php _e("Menu Font",'spatreats');?></h3></div>
    	                        <div class="box-content">
	                               	<select id="spa-menu-font" name="spa-menu-font">
                                    	<option><?php _e("Select Menu Font",'spatreats');?></option>
                                        <?php foreach($global_menu_fonts as $google_font): ?>
                                        	<option <?php selected($menu_font,esc_attr($google_font));?>><?php echo(esc_html($google_font));?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p><?php _e("Select Menu font for the theme.",'spatreats');?></p>
                                </div>

                                <div class="box-title"><h3><?php _e("Title Font",'spatreats');?></h3></div>
                                <div class="box-content">
                                	<select id="spa-title-font" name="spa-title-font">
                                    	<option><?php _e("Select Title Font",'spatreats');?></option>
                                        <?php foreach($global_title_fonts as $google_font): ?>
                                        	<option <?php selected($title_font,esc_attr($google_font));?>><?php echo(esc_html($google_font));?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p><?php _e("Select Title's font for the theme.",'spatreats');?></p>
                                </div>

                                <div class="box-title"><h3><?php _e('Script Font','spatreats');?></h3></div>
                                <div class="box-content">
                                	<select id="spa-script-font" name="spa-script-font">
                                    	<option><?php _e("Select Script Font",'spatreats');?></option>
                                        <?php foreach($global_script_fonts as $google_font): ?>
                                        	<option <?php selected($script_font,esc_attr($google_font));?>><?php echo(esc_html($google_font));?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p><?php _e("Select Script font for the theme.",'spatreats');?></p>
                                </div>

                                <div class="box-title"><h3><?php _e('Body Font','spatreats');?></h3></div>
                                <div class="box-content">
                                	<select id="spa-body-font" name="spa-body-font">
                                    	<option><?php _e("Select Body Font",'spatreats');?></option>
                                        <?php foreach($global_body_fonts as $google_font): ?>
                                        	<option <?php selected($body_font,esc_attr($google_font));?>><?php echo(esc_html($google_font));?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p><?php _e("Select Body's font for the theme.",'spatreats');?></p>
                                </div>

                                <div class="box-title"><h3><?php _e('Footer Title Font','spatreats');?></h3></div>
                                <div class="box-content">
                                    <select id="spa-footer-font" name="spa-footer-font">
                                        <option><?php _e("Select Footer Font",'spatreats');?></option>
                                        <?php foreach($global_footer_heading_fonts as $google_font): ?>
                                            <option <?php selected($footer_font,esc_attr($google_font));?>><?php echo(esc_html($google_font));?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p><?php _e("Select Footer Heading's font for the theme.",'spatreats');?></p>
                                </div>
                                
                            </div><!-- .bpanel-main-content-->               
                        </div><!-- General tab-content ends -->

                        <!-- Home tab-content -->
                        <div id="my_home" class="tab-content">
                        	<div class="bpanel-box">
                            	<div class="box-title"> <h3><?php _e('Homepage Settings','spatreats');?></h3></div>
                                <div class="box-content">
                                    <?php page_list("spa-home-page",get_option("page_on_front"));?>
                                	<p><?php _e('Select which page to display on your Frontpage. If left blank the Blog will be displayed','spatreats');?></p>
                                </div>

								<!-- Sliders -->
                                <div class="box-title"><h3><?php _e("Banners&frasl;Sliders",'spatreats');?></h3></div>
                                <?php if( get_option("page_on_front") > 0): ?>
                                <div class="box-content">
	                                    <p><?php _e("Used Sliders",'spatreats');?></p>
    	                                <p id="j-no-images-container"><?php _e('Please, add some sliders','spatreats'); ?></p>
                                        <?php $slider_meta = get_post_meta( get_option("page_on_front"), '_sliders_post_meta', true );?>
        	                            <ul id="j-used-sliders-containers">
            	                        <?php if((get_option("show_on_front") == "page") && (!empty($slider_meta)) ):
											  		$sliders = isset($slider_meta["sliders"]) ? unserialize($slider_meta["sliders"]):array();
											  	if(!empty($sliders)):
												foreach($sliders as $slider):
													$p = get_post($slider);
													echo "<li data-attachment-id='{$p->ID}'>";
													echo wp_get_attachment_image(get_post_thumbnail_id($p->ID));
													echo "<span class='my_delete'>x</span>";
													echo "<input type='hidden' name='_used_slider_id[]' value='{$p->ID}'/>";
													echo "</li>";												
												endforeach;
												endif;
            	                        	 endif;?>
                	                    </ul><!-- #j-used-sliders-container -->
                                   		<p class="slider-info"><?php _e("Available Sliders",'spatreats');?></p>
	                                	<ul id="j-available-sliders">
                                        <?php global $post;
											$args = array( 'post_type' => 'slide', 'orderby' => 'id', 'order' => 'ASC', 'posts_per_page' => 5 );
											$slider_query = new WP_Query($args);
											foreach ($slider_query->posts as $slider):
												$added_class = @(  in_array( $slider->ID, $sliders ,false ) ) ? ' class="my_added"' : ''; 
												echo "<li {$added_class} data-attachment-id='{$slider->ID}'>";
												echo wp_get_attachment_image(get_post_thumbnail_id($slider->ID));
												echo "<span class='my_delete'>x</span>";
												echo "</li>";
											endforeach;?>
	                                    </ul><!-- #j-available-sliders container -->
                                        
                                         <!-- Pagination -->
                                        <?php if ( $slider_query->max_num_pages > 1 ): ?>
                                            <div id="j-slider-pagination" class="admin-pagination">
                                              <?php  for ( $i=1; $i <= $slider_query->max_num_pages; $i++ ): ?>
                                                <a href="#" <?php echo( 1 == $i ? ' class="active_page"' : '' ) ?>><?php echo($i);?></a>
                                              <?php endfor;?>
                                            </div>
                                        <?php endif;?>
                                </div><!-- .box-content -->
                                <!-- Sliders End -->

                              	<div class="box-title"><h3><?php _e('Banners&frasl;Sliders Settings','spatreats');?></h3></div>
                                <div class="box-content">
                                         <?php 	$height = isset($slider_meta['slider_height']) ? $slider_meta['slider_height']:'555';
										  $width 		= isset($slider_meta['slider_width']) ? $slider_meta['slider_width']:'1200';
										  $speed 		= isset($slider_meta['animSpeed']) ? $slider_meta['animSpeed']:'';
										  $pauseTime 	= isset($slider_meta['pauseTime']) ? $slider_meta['pauseTime']:'';
										  $slice 		= isset($slider_meta['slices'])? $slider_meta['slices']:'';
										  $boxCols 		= isset($slider_meta['boxCols']) ? $slider_meta['boxCols']:'';
										  $boxRows		= isset($slider_meta['boxRows']) ? $slider_meta['boxRows']:'';
										  $pauseOnHover	= isset($slider_meta['pauseOnHover']) ? $slider_meta['pauseOnHover']:0;
										  $randomStart	= isset($slider_meta['randomStart']) ? $slider_meta['randomStart']:0;
										  $directionNav	= isset($slider_meta['directionNav']) ? $slider_meta['directionNav']:0;
										  $controlNav	= isset($slider_meta['controlNav'])? $slider_meta['controlNav']:0;?>
                                
                	                    <h4><?php _e("Slider Width x Height (in px)",'spatreats');?></h4>
                                        <input type="text" class="medium" name="width" value="<?php echo(esc_html($width));?>" />
                    	                <input type="text" class="medium" name="height" value="<?php echo(esc_html($height));?>" />
                        	            <p><?php _e("For better view,","spatreats");?></p>
                                        <ol class="info">
                                            <li><?php _e('Please re-upload all the slider images with the correct dimensions.','spatreats');?></li>
                                        	<li><?php _e('The slider height should be above 300px.','spatreats');?></li>                                            
                                        </ol>
                                    
                                	 <h4><?php _e("Choose effects:",'spatreats');?></h4>
									<?php $effects = array("sliceDown","sliceDownLeft","sliceUp","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade",
										"random","slideInRight","slideInLeft","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");
                                         sort($effects);
                                         $p = ( isset($slider_meta["effects"]) && is_array( unserialize($slider_meta["effects"]) ) ) 
										 	?  unserialize($slider_meta["effects"]) : array();
	                                     foreach( $effects as $effect): ?>
                                             <label class="one-third">
                                                <input type="checkbox" name="effects[]" value="<?php echo($effect);?>"<?php checked(in_array(esc_attr($effect),$p));?>/>
                                                  <?php echo(esc_html($effect));?>
                                             </label>
                                         <?php endforeach; ?>
                                        <p><?php _e("You can choose animation effects here.",'spatreats');?></p>
	                                    <h4><?php _e("Slider animation speed &amp; pause time settings (in ms) ",'spatreats');?></h4>
    	                                <input type="text" name="animSpeed" class="medium" value="<?php echo(esc_html($speed));?>" />
        	                            <input type="text" name="pauseTime" class="medium" value="<?php echo(esc_html($pauseTime));?>" />
            	                        <p><?php _e("Please enter slider transition(eg: 500) &amp; pasue time( eg:3000) in ms",'spatreats');?></p>
                                  

                	                    <h4><?php _e("Slices",'spatreats');?></h4>
                    	                <input type="text" class="medium" name="slices" value="<?php echo(esc_html($slice));?>" />
                        	            <p><?php _e("For slice animation( SliceDown, SliceDownLeft, SliceUp, SliceUpDown, sliceUpDownLeft and sliceUpLeft ), you can give number of slices here. For eg: 15","spatreats");?></p>

                            	        <h4><?php _e("Box animation settings",'spatreats');?></h4>
                                	    <input type="text" name="boxCols" class="medium" value="<?php echo(esc_html($boxCols));?>" />
                                    	<input type="text" name="boxRows" class="medium" value="<?php echo(esc_html($boxRows));?>" />
	                                    <p><?php _e("For box animation( boxRain, boxRainGrow, boxRainGrowReverse, boxRainReverse &amp; boxRandom ), you can give number of columns(eg: 5) &amp; rows(eg: 8) ",'spatreats');?></p>

                                        <h4><?php _e("Others",'spatreats');?></h4>
                                        <label class="one-half">
		                                    <input type="checkbox" name="pauseOnHover" value="" <?php checked($pauseOnHover); ?>/>
    	                                    <?php _e("Would you like to pasue the slider on hover?",'spatreats');?>
        	                            </label>
                                        
                                        <label class="one-half">
                                            <input type="checkbox" name="randomStart" value="" <?php checked($randomStart); ?>/>
                                            <?php _e("Would you like to use random slider?",'spatreats');?>
                                        </label>

                                        <label class="one-half">
                                            <input type="checkbox" name="directionNav" value="" <?php checked($directionNav); ?>/>
                                            <?php _e("Would you like to show slider navigation?",'spatreats');?>
                                        </label>

                                        <label class="one-half">
                                            <input type="checkbox" name="controlNav" value="" <?php checked($controlNav); ?>/>
                                            <?php _e("Would you like to show control navigation on bottom of slider?",'spatreats');?>
                                        </label>
                                </div>
                                <?php else:?>
                                 <div class="box-content">
	                                 <p><?php _e("Select your Frontpage and save your settings. After that , you have an option to choose sliders here :)",'spatreats');?></p>
                                 </div>
                                <?php endif;?>
                            </div>               
                        </div><!-- Home tab-content -->



                        <!-- Blog tab-content -->
                        <div id="my_blog" class="tab-content">
                        	<div class="bpanel-box">
                            	<div class="box-title"><h3><?php _e('Blogpage Settings','spatreats');?></h3></div>
                                <div class="box-content">
                                    <?php page_list("spa-blog-page",get_option("page_for_posts"));?>
                                	<p><?php _e('Select which page to display as your Blog Page. If left blank no blog will be displayed','spatreats');?></p>
                                </div>
                            </div>               
                        </div><!-- Blog tab-content -->

                        <!-- Social tab-content -->
                        <div id="social_media" class="tab-content">
                        	<div class="bpanel-box">
                               	<?php $social = isset($my_theme_settings["social"]) ? $my_theme_settings["social"] : array();
									  $fb 	  = isset($social['facebook']) ? $social['facebook']:'';
								      $rss 	  = isset($social["rss"]) ? $social["rss"] : get_bloginfo('rss2_url');
									  $twitter = isset($social['twitter']) ? $social['twitter']:'';
									  $youtube	= isset($social['youtube']) ? $social['youtube']:'';
									  $flickr = isset($social['flickr']) ? $social['flickr']:'';?>
                                    
                            	<div class="box-title"> <h3><?php _e("Link for the facebook icon",'spatreats');?></h3> </div>
                                <div class="box-content">
                                     <input id="spa-facebook" name="spa-facebook" type="text" value="<?php echo(esc_html($fb));?>" />
		                             <p><?php _e('Link to your Facebook page, with http://. Leaving it blank will keep the Facebook icon suppressed. ','spatreats');?></p>
                                </div>
                                
                            	<div class="box-title"><h3><?php _e("Link for the RSS icon",'spatreats');?></h3></div>
                                <div class="box-content">
                                    <input id="spa-rss" name="spa-rss" type="text"  value="<?php echo(esc_html($rss));?>"/>
                                    <p><?php _e('You can use your own feed URL (with http://). Paste your Feedburner URL here to let readers see it in your website.','spatreats');?></p>
                                </div>

                            	<div class="box-title"><h3><?php _e("Link for the twitter icon",'spatreats');?></h3></div>
                                <div class="box-content">
                                    <input id="spa-twitter" name="spa-twitter" type="text" value="<?php echo(esc_html($twitter));?>"/>
                                    <p><?php _e('Your Twitter user name, please. Leaving it blank will keep the Twitter icon suppressed.','spatreats','spatreats');?></p>
                                </div>

                            	<div class="box-title"><h3><?php _e("Link for the YouTube icon",'spatreats');?></h3></div>
                                <div class="box-content">
                                    <input id="spa-youtube" name="spa-youtube" type="text" value="<?php echo(esc_html($youtube));?>"/>
                                    <p><?php _e('Link to your YouTube page, with http://. Leaving it blank will keep the YouTube icon suppressed. ','spatreats');?></p>
                                </div>

                            	<div class="box-title"><h3><?php _e("Link for the Flickr icon",'spatreats');?></h3></div>
                                <div class="box-content">
                                    <input id="spa-flickr" name="spa-flickr" type="text" value="<?php echo(esc_html($flickr));?>"/>
                                    <p><?php _e('Link to your Flickr page, with http://. Leaving it blank will keep the Flickr icon suppressed. ','spatreats');?></p>
                                </div>
                            </div>               
                        </div><!-- Social tab-content -->

                        <!-- Footer tab-content -->
                        <div id="my_footer" class="tab-content">
                        	<div class="bpanel-box">
	                            <?php $footer 	 = isset($my_theme_settings["footer"]) ? $my_theme_settings["footer"] : NULL;
									  $copyright =  isset($footer['copyright']) ? $footer['copyright'] : NULL;?>
                            	<div class="box-title"> <h3><?php _e('Footer Columns','spatreats');?></h3> </div>
                                <div class="box-content">
                                	<?php $columns = array("full-width"=>"1","one-half"=>"2","one-third"=>"3","one-fourth"=>"4");?>
                                    <select id="spa-footer-columns" name="spa-footer-columns">
                                    	<option><?php _e("Select",'spatreats');?></option>
                                        <?php foreach($columns as $key => $value):?>
                                        	<option value="<?php echo($key)?>" <?php selected($footer["footer-columns"],esc_attr($key));?>><?php echo( esc_html($value));?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="box-title"><h3><?php _e('Copyright Text','spatreats');?></h3></div>
	                            <div class="box-content">
                                    <textarea id="spa-copyright-text" name="spa-copyright-text"><?php echo(esc_html($copyright));?></textarea>
                                    <p><?php _e('You can paste your copyright text in this box. This will be automatically added to the footer.','spatreats');?></p>
                                </div>
                            </div>               
                        </div><!-- Footer tab-content -->
                    	</div> <!-- bpanel Main-content -->   
                    </div><!-- #general ends -->


                    <!-- #integration .bpanel-content -->
                    <div id="integration" class="bpanel-content">
                    	<div class="bpanel-main-content">

                    	<ul class="sub-panel">   
                        	<li><a href="#integration-general"><?php _e("General",'spatreats');?></a></li>
                            <li><a href="#integration-post"><?php _e("Post",'spatreats');?></a></li>
                            <li><a href="#integration-page"><?php _e("Page",'spatreats');?></a></li>
                        </ul>
                        <?php $codes = isset($my_theme_settings["codes"]) ? $my_theme_settings["codes"] : NULL;
							  $header_code = isset($codes['header-code']) ? $codes['header-code'] : NULL;
							  $enable_header_code = isset($codes['enable-head-code']) ? $codes['enable-head-code'] : NULL;
							  $footer_code = isset($codes['footer-code']) ? $codes['footer-code'] : NULL;
							  $enable_footer_code = isset($codes['enable-footer-code']) ? $codes['enable-footer-code'] : NULL;
							  $enable_post_top_code = isset($codes['enable-post-top-code']) ? $codes['enable-post-top-code'] : NULL;
							  $post_top_code = isset($codes['post-top-code']) ? $codes['post-top-code'] : NULL;
							  $post_bottom_code = isset($codes['post-bottom-code']) ? $codes['post-bottom-code'] : NULL;
							  $enable_post_bottom_code = isset($codes['enable-post-bottom-code']) ? $codes['enable-post-bottom-code'] : NULL;
							  
							  $is_post_comment_disabled = isset($codes['disable-spa-post-comment']) ? $codes['disable-spa-post-comment'] : NULL;
							  
							  $post_facebook_status = isset($codes['post-facebook-status']) ? $codes['post-facebook-status'] : NULL;
							  $post_googleplus_status = isset($codes['post-googleplus-status']) ? $codes['post-googleplus-status'] : NULL;
							  $post_twitter_status = isset($codes['post-twitter-status']) ? $codes['post-twitter-status'] : NULL;
							  $page_top_code = isset($codes['page-top-code']) ? $codes['page-top-code'] : NULL;
							  $enable_page_top_code = isset($codes['enable-page-top-code']) ? $codes['enable-page-top-code'] : NULL;
							  $page_bottom_code = isset($codes['page-bottom-code']) ? $codes['page-bottom-code'] : NULL;
							  $enable_page_bottom_code =  isset($codes['enable-page-bottom-code']) ? $codes['enable-page-bottom-code']: NULL;
							  $is_page_comment_disabled = isset($codes['disable-spa-page-comment']) ? $codes['disable-spa-page-comment'] : NULL;?>

                        <!-- Integration General tab-content -->
                        <div id="integration-general" class="tab-content"> 
                        	<div class="bpanel-box">
                            	<!-- Head Code -->
                              	<div class="box-title"><h3><?php _e('Add code to the &lt;head&gt;  of your blog','spatreats');?></h3></div>
                                <div class="box-content">
                                	<textarea id="spa-head-code" name="spa-head-code"><?php echo (esc_html($header_code));?></textarea>
                                    <br/>
                                    <input class="bpanel-checkbox" type="checkbox" name="enable-spa-head-code" id="enable-spa-head-code" 
                                        	<?php checked($enable_header_code);?>/>
                                    	<label class="bpanel-label"><?php _e('Enable header code','spatreats'); ?></label>
                                    	<p><?php _e('Any code you place here will appear in the head section of every page of your blog. This is useful when you need to add javascript or css to all pages.','spatreats');?></p>
                                </div><!-- Head Code End -->

                                  <!-- Body Code -->
                                  <div class="box-title"><h3><?php _e('Add code to the &lt;/body&gt;','spatreats');?></h3></div>
	                              <div class="box-content">
	                                <textarea id="spa-body-code" name="spa-body-code"><?php echo(esc_html($footer_code));?></textarea>
    	                            <br/>
					                <input class="bpanel-checkbox" type="checkbox" name="enable-spa-body-code" id="enable-spa-body-code"
                                    <?php checked($enable_footer_code);?>/>
									<label class="bpanel-label"><?php _e('Enable body code','spatreats'); ?></label>
                	                <p><?php _e('You can paste your Google Analytics or other website tracking code in this box. This will be automatically added to the footer.','spatreats');?></p>
                                  </div><!-- Body Code End -->
                            </div><!-- .bpanel-box -->
                        </div><!-- Integration General tab-content ends -->

                       <!-- Integration Post tab-content -->
                        <div id="integration-post" class="tab-content">
                        	<div class="bpanel-box">
                                  <!-- Single Post Top Code -->
                                  <div class="box-title"><h3><?php _e('Add code to the top of your posts','spatreats');?></h3></div>
                                  <div class="box-content">
                                        <textarea id="spa-single-post-top-code" name="spa-single-post-top-code"><?php echo(esc_html($post_top_code));?></textarea>
                                        <br/>
                                        <input class="bpanel-checkbox" type="checkbox" name="enable-spa-single-post-top-code" id="enable-spa-single-post-top-code"
                                            <?php checked($enable_post_top_code);?>/>
                                        <label class="bpanel-label"><?php _e('Enable single post top code','spatreats');?></label>
                                        <p><?php _e('Any code you place here will be placed at the top of all single posts. This is useful if you are looking to integrating things such as social bookmarking links.','spatreats');?></p>
                                  </div>

                                  <!--  Single Post Bottom Code -->
                                  <div class="box-title"><h3><?php _e('Add code to the bottom of your posts, before the comments','spatreats');?></h3></div>
                                  <div class="box-content">
                                        <textarea id="spa-single-page-bottom-code" name="spa-single-post-bottom-code"><?php echo(esc_html($post_bottom_code));?></textarea>
                                        <br/>
                                        <input class="bpanel-checkbox" type="checkbox" name="enable-spa-single-post-bottom-code" id="enable-spa-single-post-bottom-code"
                                            <?php checked($enable_post_bottom_code);?>/>
                                       <label class="bpanel-label"><?php _e('Enable single post bottom code','spatreats');?></label>
                                        <p><?php _e('Any code you place here will be placed at the top of all single posts. This is useful if you are looking to integrating things such as social bookmarking links.','spatreats','spatreats');?></p>
                                  </div>
                                  
                                  <!-- Single Post Comment option -->
	                              <div class="box-title"><h3><?php _e('Disable Comments on Posts','spatreats');?></h3></div>
                                  <div class="box-content">
                                		<input class="bpanel-checkbox" type="checkbox" name="disable-spa-post-comment" id="disable-spa-post-comment"  
										<?php checked($is_post_comment_disabled);?>/>
    	                                <label class="bpanel-label"><?php _e('Globally Disable Comments on Posts','spatreats');?></label>                                
        	                        <p><?php _e('Check if you want to disable comments on posts.','spatreats');?></p>
            	                  </div><!-- Single Post Comment option end-->
                                  

                                  <!-- Share option -->
                                  <div class="box-title"><h3><?php _e('Show share buttons','spatreats');?></h3></div>
                                  <div class="box-content">
                                    <label class="bpanel-label clear">
                                    <input type="checkbox" name="enable-spa-single-post-facebook" id="enable-spa-single-post-facebook"
                                        <?php checked($post_facebook_status);?>/>
                                        <?php _e('Enable Facebook','spatreats');?>
                                    </label>
                                    <br/>
                                   <label class="bpanel-label clear">
	                               <input type="checkbox" name="enable-spa-single-post-googleplus" id="enable-spa-single-post-googleplus"
                                        <?php checked($post_googleplus_status);?>/>
                                        <?php _e('Enable Google Plus','spatreats');?>
                                    </label>
                                    <br/>
                                    <label class="bpanel-label clear">                              
                                    <input type="checkbox" name="enable-spa-single-post-twitter" id="enable-spa-single-post-twitter"
                                        <?php checked($post_twitter_status);?>/>
                                       <?php _e('Enable Twitter','spatreats');?>
                                    </label>    
                                    <p><?php _e('Please choose appropriate social media share buttons to show in post.','spatreats');?></p>
                                  </div>
                            </div><!-- .bpanel-box End -->               
                        </div><!-- Integration Post tab-content ends -->

                        <!-- Integration Page tab-content -->
                        <div id="integration-page" class="tab-content">
                        	<div class="bpanel-box">
                            
                                <!-- Single Page Top Code -->
                                <div class="box-title"><h3><?php _e('Add code to the top of your pages','spatreats');?></h3></div>
                                <div class="box-content">
                                    <textarea id="spa-single-page-top-code" name="spa-single-page-top-code"><?php echo(esc_html($page_top_code));?></textarea>
                                    <br/>
                                    <input class="bpanel-checkbox" type="checkbox" name="enable-spa-single-page-top-code" id="enable-spa-single-page-top-code"
                                        <?php checked($enable_page_top_code);?>/>
                                    <label class="bpanel-label"><?php _e('Enable single page top code ','spatreats');?></label>
                                    <p><?php _e('Any code you place here will be placed at the top of all single pages. This is useful if you are looking to integrating things such as social bookmarking links.','spatreats');?></p>
                                </div>

                                <!--  Single Page Bottom Code -->
                                <div class="box-title"><h3><?php _e('Add code to the bottom of your pages, before the comments','spatreats');?></h3></div>
                                <div class="box-content">
                                    <textarea id="spa-single-page-bottom-code" name="spa-single-page-bottom-code"><?php echo(esc_html($page_bottom_code));?></textarea>
                                    <br/>
                                    <input class="bpanel-checkbox" type="checkbox" name="enable-spa-single-page-bottom-code" id="enable-spa-single-page-bottom-code"
                                        <?php checked($enable_page_bottom_code);?>/>
                                    <label class="bpanel-label"><?php _e('Enable single page bottom code','spatreats');?></label>
                                    <p><?php _e('Any code you place here will be placed at the top of all single pages. This is useful if you are looking to integrating things such as social bookmarking links.','spatreats');?></p>
                                </div>
                                
                                <!-- Single Page Comment Code -->
                                <div class="box-title"><h3><?php _e('Disable Comments on Pages','spatreats');?></h3></div>
                                <div class="box-content">
                                    <input class="bpanel-checkbox" type="checkbox" name="disable-spa-page-comment" id="disable-spa-page-comment"  
                                    <?php checked($is_page_comment_disabled);?>/>
                                    <label class="bpanel-label"><?php _e('Globally Disable Comments on Pages','spatreats');?></label>                                
                                <p><?php _e('Check if you want to disable comments on pages.','spatreats');?></p>
                                </div><!-- Single Page Comment Code end-->
                                
                           
                            </div><!-- .bpanel-box End -->               
                        </div><!-- Integration Page tab-content ends -->
                    	</div> <!-- bpanel Main-content -->       
                    </div><!-- #integration .bpanel-content ends -->

                    <!-- #appearance ends -->
                    <div id="appearance" class="bpanel-content">
                    	<div class="bpanel-main-content">
                            <ul class="sub-panel">   
                                <li><a href="#theme"><?php _e("Theme",'spatreats');?></a></li>
                            </ul>
                            
                            <div id="theme" class="tab-content">
                        
                                <div class="bpanel-box">
                                    <div class="box-title"><h3><?php _e('Current Theme','spatreats');?></h3></div>
                                    <div class="box-content">
                                    <?php $path = get_template_directory()."/themes/";  
                                          $theme = isset($general['theme'])?$general['theme']:'spatreats';?>
                                        <ul id="j-current-theme-container">
                                            <li data-attachment-theme="<?php echo $theme;?>">
                                                <img src="<?php echo IAMD_BASE_URL."/themes/{$theme}/screenshot.png";?>" alt='' width='200' height='163' />
                                                <input type="hidden" name="_current_theme" value="<?php echo $theme;?>" />
                                                <h4><?php echo $theme;?></h4>
                                            </li>
                                        </ul>
                                    </div>
    
                                    <div class="box-title"><h3><?php _e('Available Theme','spatreats');?></h3></div>
                                    <div class="box-content">
                                        <ul id="j-available-themes">
                                        <?php foreach(getFolders($path) as $childtheme ):
                                                $childtheme = $childtheme;
                                                $active = ($theme == $childtheme) ? 'class="active"' : NULL;
                                                $img = IAMD_BASE_URL."/themes/{$childtheme}/screenshot.png";
                                                echo "<li data-attachment-theme='{$childtheme}' {$active}>";
                                                echo "<img src='{$img}' alt='' width='200' height='163'/>";
                                                echo "<h4>{$childtheme}</h4>";
                                                echo "</li>";
                                             endforeach;?>
                                        </ul>
                                    </div>
                            	</div>
                           </div> <!-- #theme -->     
                        </div><!-- ."bpanel-main-content -->
                    </div><!-- #appearance .bpanel-content ends -->
                    
                    <!-- #responsive ends -->
                    <div id="responsive" class="bpanel-content">
                    	<div class="bpanel-main-content">
                            <ul class="sub-panel">   
                                <li><a href="#my-responsive"><?php _e("Responsive",'spatreats');?></a></li>
                            </ul>
                            
                            <div id="my-responsive" class="tab-content">
								<div class="bpanel-box">
                                
                                	<!-- Responsive -->
                                    <div class="box-title"><h3><?php _e('Responsive Layout Options','spatreats');?></h3></div>
                                    <div class="box-content">
                                    	<?php 
										 $responsive   = isset($general['is_responsive']) ? $general['is_responsive'] : "";
										 $is_responsive = array(
													"id"=>		"is-spa-responsive",
												 	"options"=> array(
														"true" =>	__("Make My Site Responsive",'spatreats'),
														""	   =>	__("Don't Make My Site Responsive",'spatreats')	
												)); 
												
												foreach($is_responsive['options'] as $key => $value): ?>
                                                	<label class="bpanel-label clear">
                                                        <input type="radio" name="<?php echo $is_responsive['id'];?>" 
                                                        	value="<?php echo $key?>" <?php checked($responsive,$key);?> />
                                                        <?php echo $value;?>
                                                    </label>
                                                    <br/>
										<?php	endforeach;?>
                                    </div>
                                    <!-- Responsive End -->
                                    
                                    <!-- Mobile Slider -->
                                    <div class="box-title"><h3><?php _e('Mobile Device Slider Options','spatreats');?></h3></div>
                                    <div class="box-content">
                                    	<?php $mobile_silder   = isset($general['is_mobile_slider_disabled']) ? $general['is_mobile_slider_disabled'] : ""; 
											$is_mobile_slider_disabled = array(
													"id"=>			"disable-silder-in-mobile",
													"options"	=> 	array(
															//"true" 	=>  __("Convert my Default Slider to Responsive",'spatreats'),
															"true"		=>	__("Disable Slider for Mobile Devices",'spatreats')
											));
											
											foreach($is_mobile_slider_disabled['options'] as $key => $value):?>
                                            <label class="bpanel-label clear">
                                                <input type="checkbox" name="<?php echo $is_mobile_slider_disabled['id'];?>" 
                                                    value="<?php echo $key?>" <?php checked($mobile_silder,$key);?> />
                                                <?php echo $value;?>
                                            </label>
                                            <br/>
                                     <?php	endforeach;?>
                                     <p><?php _e('Choose what to display in the slider area of your website on mobile devices','spatreats');?></p>
                                    </div>
                                    <!-- Mobile Slider End -->
                                    
                                </div><!--.bpanel-box -->
                            </div><!-- #my-responsive -->
                            
                        </div><!-- .bpanel-main-content end -->
                    </div><!-- #responsive-->

                    <div id="bpanel-bottom">
               	         <input type="hidden" name="action" value="save" />	
				         <input type="submit" value="Save All"  class="save-reset" />
			            </form>

                       <form method="post">
                          <input type="hidden" name="action" value="reset" />
                          <input type="submit" value="Reset All" class="save-reset"/>
                       </form>          
                    </div>
                </div> <!-- bpanel ends -->           
            </div> <!--bpanel-wrapper ends -->
    </div><!-- panel-wrap ends -->
</div><!-- wrapper ends -->
<?php  } 
ob_flush();?>