<?php class MY_Social_Links extends WP_Widget {
		#1.Constructor
		function MY_Social_Links() {
			$widget_options	 = array("classname"=>"social-widget","description"=>"To Show your social links.");
			$this->WP_Widget(false, wp_get_theme()." Social Icons",$widget_options);
		}
		
		#2.Form
		function form($instance) {
			
			$my_theme_options =  get_option('_mytheme_settings');
			$social_links = isset( $my_theme_options['social']) ? $my_theme_options['social'] : NULL;
			$theme_fb = isset( $social_links['facebook']) ? $social_links['facebook'] : ''; 
			$theme_rss = isset( $social_links['rss']) ? $social_links['rss'] : '';
			$theme_twitter = isset( $social_links['twitter']) ? $social_links['twitter'] : ''; 
			$theme_youtube = isset( $social_links['youtube']) ? $social_links['youtube'] : ''; 
			$theme_flickr = isset( $social_links['flickr']) ? $social_links['flickr'] : ''; 
			
			$instance = wp_parse_args( (array) $instance,
						array(	'title'=>''
							  	,'_digg'=>'', '_digg_enabled'=>''
								,'_facebook'=>'','_facebook_enabled'=>''
								,'_twitter'=>'','_twitter_enabled'=>''
								,'_flickr'=>'', '_flickr_enabled'=>''
								,'_rss'=>'','_rss_enabled'=>''
								,'_stumblr'=>'','_stumblr_enabled'=>''
								,'_youtube'=>'','_youtube_enabled'=>'') );
								
						$title 				= strip_tags($instance['title']);
						$digg  				= strip_tags($instance['_digg']);
						$digg_enabled 		= isset( $instance['_digg_enabled'] ) ? (bool) $instance['_digg_enabled'] : false;
						
						$stumblr  			= strip_tags($instance['_stumblr']);
						$stumblr_enabled 	= isset( $instance['_stumblr_enabled'] ) ? (bool) $instance['_stumblr_enabled'] : false;
						
						$fb	   				= !empty($instance['_facebook'] )? strip_tags($instance['_facebook']) : $theme_fb;
						$fb_enabled 		= isset( $instance['_facebook_enabled'] ) ? (bool) $instance['_facebook_enabled'] : false;
						
						$twitter			= strip_tags($instance['_twitter']) <> ''? strip_tags($instance['_twitter']) : $theme_twitter;
						$twitter_enabled 	= isset( $instance['_twitter_enabled'] ) ? (bool) $instance['_twitter_enabled'] : false;
						
						
						$flickr	   			= strip_tags($instance['_flickr']) <> '' ? strip_tags($instance['_flickr']) : $theme_flickr;
						$flickr_enabled 	= isset( $instance['_flickr_enabled'] ) ? (bool) $instance['_flickr_enabled'] : false;
						
						$rss	   			= strip_tags($instance['_rss']) <> ''? strip_tags($instance['_rss']) : $theme_rss;
						$rss_enabled 		= isset( $instance['_rss_enabled'] ) ? (bool) $instance['_rss_enabled'] : false;
						
						$youtube			= strip_tags($instance['_youtube']) <> '' ? strip_tags($instance['_youtube']) : $theme_youtube;
						$youtube_enabled 	= isset( $instance['_youtube_enabled'] ) ? (bool) $instance['_youtube_enabled'] : false;?>
                        
		  <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','spatreats');?></label>
			 <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" 
             type="text" value="<?php echo $title;?>"/></p>
             
         <!-- DIGG -->
         <p><label for="<?php echo $this->get_field_id('_digg'); ?>"><?php _e('Digg:','spatreats');?></label>
             <input class="widefat" id="<?php echo $this->get_field_id('_digg'); ?>" name="<?php echo $this->get_field_name('_digg'); ?>"
            value="<?php echo $digg;?>" />
         	<input type="checkbox" id="<?php echo $this->get_field_id('_digg_enabled');?>" name="<?php echo $this->get_field_name('_digg_enabled');?>"
         <?php checked($digg_enabled) ?> /> <?php _e("Enable",'spatreats');?></p>

         <!-- FACEBOOK -->	
         <p><label for="<?php echo $this->get_field_id('_facebook'); ?>"><?php _e('Facebook:','spatreats');?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('_facebook'); ?>" name="<?php echo $this->get_field_name('_facebook'); ?>"
            value="<?php echo $fb;?>" />
         <input type="checkbox"  id="<?php echo $this->get_field_id('_facebook_enabled');?>" name="<?php echo $this->get_field_name('_facebook_enabled');?>"
         <?php checked($fb_enabled); ?> /> <?php _e("Enable",'spatreats');?></p>
         
         <!-- FLICKR -->	
         <p><label for="<?php echo $this->get_field_id('_flickr'); ?>"><?php _e('Flickr:','spatreats');?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('_flickr'); ?>" name="<?php echo $this->get_field_name('_flickr'); ?>"
            value="<?php echo $flickr?>" />
         <input type="checkbox"  id="<?php echo $this->get_field_id('_flickr_enabled');?>" name="<?php echo $this->get_field_name('_flickr_enabled');?>"
         <?php checked($flickr_enabled); ?> /> <?php _e("Enable",'spatreats');?></p>


         <!-- RSS -->	
         <p><label for="<?php echo $this->get_field_id('_rss'); ?>"><?php _e('RSS:','spatreats');?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('_rss'); ?>" name="<?php echo $this->get_field_name('_rss'); ?>"
            value="<?php echo $rss?>" />
         <input type="checkbox"  id="<?php echo $this->get_field_id('_rss_enabled');?>" name="<?php echo $this->get_field_name('_rss_enabled');?>"
         <?php checked($rss_enabled); ?> /> <?php _e("Enable",'spatreats');?></p>

         <!-- Stumblr -->	
         <p><label for="<?php echo $this->get_field_id('_stumblr'); ?>"><?php _e('Stumblr:','spatreats');?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('_stumblr'); ?>" name="<?php echo $this->get_field_name('_stumblr'); ?>"
            value="<?php echo $stumblr?>" />
         <input type="checkbox"  id="<?php echo $this->get_field_id('_stumblr_enabled');?>" name="<?php echo $this->get_field_name('_stumblr_enabled');?>"
         <?php checked($stumblr_enabled); ?> /> <?php _e("Enable",'spatreats');?></p>

         <!-- Twitter -->	
         <p><label for="<?php echo $this->get_field_id('_twitter'); ?>"><?php _e('Twitter:','spatreats');?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('_twitter'); ?>" name="<?php echo $this->get_field_name('_twitter'); ?>"
            value="<?php echo $twitter?>" />
         <input type="checkbox"  id="<?php echo $this->get_field_id('_twitter_enabled');?>" name="<?php echo $this->get_field_name('_twitter_enabled');?>"
         <?php checked($twitter_enabled); ?> /> <?php _e("Enable",'spatreats');?></p>
         

         <!-- Youtube -->	
         <p><label for="<?php echo $this->get_field_id('_youtube'); ?>"><?php _e('Youtube:','spatreats');?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('_youtube'); ?>" name="<?php echo $this->get_field_name('_youtube'); ?>"
            value="<?php echo $youtube?>" />
         <input type="checkbox"  id="<?php echo $this->get_field_id('_youtube_enabled');?>" name="<?php echo $this->get_field_name('_youtube_enabled');?>"
         <?php checked($youtube_enabled); ?> /> <?php _e("Enable",'spatreats');?></p>
<?php						
		}

		#3.Update Process
		function update( $new_instance,$old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['_digg'] = strip_tags($new_instance['_digg']);
			$instance['_digg_enabled'] = !empty($new_instance['_digg_enabled']) ? 1 : 0;
			$instance['_facebook'] = strip_tags($new_instance['_facebook']);
			$instance['_facebook_enabled'] = !empty($new_instance['_facebook_enabled']) ? 1 : 0;
			$instance['_twitter'] = strip_tags($new_instance['_twitter']);
			$instance['_twitter_enabled'] = !empty($new_instance['_twitter_enabled']) ? 1 : 0;
			$instance['_flickr'] = strip_tags($new_instance['_flickr']);
			$instance['_flickr_enabled'] = !empty($new_instance['_flickr_enabled']) ? 1 : 0;
			$instance['_rss'] = strip_tags($new_instance['_rss']);
			$instance['_rss_enabled'] = !empty($new_instance['_rss_enabled']) ? 1 : 0;
			$instance['_stumblr'] = strip_tags($new_instance['_stumblr']);
			$instance['_stumblr_enabled'] = !empty($new_instance['_stumblr_enabled']) ? 1 : 0;
			$instance['_youtube'] = strip_tags($new_instance['_youtube']);
			$instance['_youtube_enabled'] = !empty($new_instance['_youtube_enabled']) ? 1 : 0;
		return $instance;	
		}
		
		#4.widget Frontend
		function widget( $args,$instance ) {
			extract($args);
			$title 				= strip_tags($instance['title']);
			$digg  				= strip_tags($instance['_digg']);
			$digg_enabled 		= $instance['_digg_enabled'];
			$stumblr  			= strip_tags($instance['_stumblr']);
			$stumblr_enabled 	= $instance['_stumblr_enabled'];
			$fb	   				= strip_tags($instance['_facebook']);
			$fb_enabled 		= $instance['_facebook_enabled'];
			$twitter			= strip_tags($instance['_twitter']);
			$twitter_enabled 	= $instance['_twitter_enabled'];
			$flickr	   			= strip_tags($instance['_flickr']);
			$flickr_enabled 	= $instance['_flickr_enabled'];
			$rss	   			= strip_tags($instance['_rss']);
			$rss_enabled 		= $instance['_rss_enabled'];
			$youtube			= strip_tags($instance['_youtube']);
			$youtube_enabled 	= $instance['_youtube_enabled'];
			
			$url = IAMD_BASE_URL.'images/';
			
			echo "{$before_widget}";
			echo "	{$before_title}";
			echo "		{$title}";
			echo "	{$after_title}";
			echo "		<ul>";
			
			if(1 == $digg_enabled ):
			echo "			<li><a href='{$digg}'>
									<img src='{$url}digg-hover.png' alt='Digg' title='Digg'/>
									<img src='{$url}digg.png' alt='Digg' title='Digg'/>
							</a></li>";
			endif;
			if( 1 == $stumblr_enabled ):				
			echo "			<li><a href='{$stumblr}'>
									<img src='{$url}stumble-hover.png' alt='Stumblr' title='Stumblr'/>
									<img src='{$url}stumble.png' alt='Stumblr' title='Stumblr'/>
							</a></li>";
			endif;
			if( 1 == $fb_enabled ):				
			echo "			<li><a href='{$fb}'>
									<img src='{$url}facebook-hover.png' alt='Facebook' title='Facebook'/>
									<img src='{$url}facebook.png' alt='Facebook' title='Facebook'/>
							</a></li>";
			endif;
			if( 1 == $twitter_enabled ):				
			echo "			<li><a href='{$twitter}'>
									<img src='{$url}twitter-hover.png' alt='Twitter' title='Twitter'/>
									<img src='{$url}twitter.png' alt='Twitter' title='Twitter'/>
							</a></li>";
			endif;
			if( 1 == $flickr_enabled):				
			echo "			<li><a href='{$flickr}'>
									<img src='{$url}flickr-hover.png' alt='Flickr' title='Flickr'/>
									<img src='{$url}flickr.png' alt='Flickr' title='Flickr'/>
							</a></li>";
			endif;
			if( 1 == $youtube_enabled):				
			echo "			<li><a href='{$youtube}'>
									<img src='{$url}youtube-hover.png' alt='Youtube' title='Youtube'/>
									<img src='{$url}youtube.png' alt='Youtube' title='Youtube'/>
							</a></li>";
			endif;
			if( 1 == $rss_enabled):
			echo "			<li><a href='{$rss}'>
									<img src='{$url}rss-hover.png' alt='RSS' title='RSS'/>
									<img src='{$url}rss.png' alt='RSS' title='RSS'/>
							</a></li>";
			
			endif; 
			echo "		</ul>";
			echo "{$after_widget}";


		}
		
}?>