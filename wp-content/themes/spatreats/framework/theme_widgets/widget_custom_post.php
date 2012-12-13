<?php
#Custom Post Widget
class MY_Custom_Post extends WP_Widget {
		#1.constructor
		function MY_Custom_Post() {
			$widget_options = array("classname"=>"widget_recent_entries","description"=>"To Show posts from custom post types.");
			$this->WP_Widget(false,wp_get_theme()." Show Posts",$widget_options);
		}
	
		#2.Input Form
		function form($instance) {
			$instance = wp_parse_args( (array) $instance,
										array('title'=>'', '_post_type'=>'', '_thumbnail_size'=>'','_post_count'=>''
											  ,'_enabled_image'=>'','_popular_post'=>'') );
			$title = strip_tags($instance['title']);
			$_post_type = strip_tags($instance['_post_type']);
			$_thumbnail_size = strip_tags($instance['_thumbnail_size']);
			$_post_count = strip_tags($instance['_post_count']);
			$_enabled_image = isset($instance['_enabled_image']) ? (bool) $instance['_enabled_image'] : false;
			$_popular_post = isset($instance['_popular_post']) ? (bool) $instance['_popular_post'] : false;?>
            
        	<!-- FORM -->
		  <p>
          	 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','spatreats');?></label>
			 <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>"/>
          </p>

		  <p>
          	<label for="<?php echo $this->get_field_id('_post_type'); ?>"><?php _e('Choose post type:','spatreats');?></label>
            <?php $post_types = array("gallery","page","post","slide");?>
          	<select class="widefat" id="<?php echo $this->get_field_id('_post_type');?>" name="<?php echo $this->get_field_name('_post_type');?>">
	            <option value=""><?php _e('Select','spatreats'); ?></option>
                <?php foreach ($post_types  as $post_type ): 
						$selected = ($_post_type == $post_type ) ? "selected='selected'" : "";?>
                        <option <?php echo($selected);?> value="<?php echo($post_type);?>"><?php echo($post_type);?></option>
                <?php endforeach; ?>
			</select></p>
                    
          <p><input type="checkbox"  id="<?php echo $this->get_field_id('_popular_post');?>" name="<?php echo $this->get_field_name('_popular_post');?>"
	         <?php checked($_popular_post); ?> /> <?php _e("Show Popular Posts",'spatreats');?></p>  

          <p><input type="checkbox"  id="<?php echo $this->get_field_id('_enabled_image');?>" name="<?php echo $this->get_field_name('_enabled_image');?>"
	         <?php checked($_enabled_image); ?> /> <?php _e("Show Image",'spatreats');?></p>  

             
		  <p><label for="<?php echo $this->get_field_id('_post_count'); ?>"><?php _e('No.of posts to show:','spatreats');?></label>
			 <input id="<?php echo $this->get_field_id('_post_count'); ?>" name="<?php echo $this->get_field_name('_post_count'); ?>"
             value="<?php echo $_post_count?>" />
		  </p>
          
<?php   }
	
		#3.Update Processs
		function update( $new_instance,$old_instance ) {
			// processes widget options to be saved
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['_post_type'] = strip_tags($new_instance['_post_type']);
			$instance['_post_count'] = strip_tags($new_instance['_post_count']);
			$instance['_popular_post'] = !empty($new_instance['_popular_post']) ? 1 : 0;
			$instance['_enabled_image'] = !empty($new_instance['_enabled_image']) ? 1 : 0;
		return $instance;
			
		}
	
		#4.Output the widget in Fornt End
		function widget( $args,$instance ) {
			global $post;
			extract($args);

				$title = empty($instance['title']) ? 'Recent Posts' : apply_filters('widget_title', $instance['title']);
				$_post_type = empty($instance['_post_type']) ? 'post' : apply_filters('widget_entry_title', $instance['_post_type']);
				$_post_count = empty($instance['_post_count']) ? (int)'5' :(int) $instance['_post_count'];
				$_popular_post = $instance['_popular_post'];
				$_enabled_image = $instance['_enabled_image'];
			
			echo $before_widget;
						$arg = "post_type=$_post_type&posts_per_page=$_post_count&ignore_sticky_posts=1"; #Show Posts ordered by Name 
					 if (1 == $_popular_post  and 'post' == $_post_type ) { 
					 	$arg = "post_type=$_post_type&posts_per_page=$_post_count&orderby=comment_count&ignore_sticky_posts=1"; #Show Popular Post
					 }	
					 
					 echo $before_title.$title.$after_title;
					 query_posts($arg);
					 if( have_posts()) :
					 	echo "<ul>";
					 	while( have_posts() ):
							the_post();
							echo "<li>";
							$title = ( strlen(get_the_title()) > 20 ) ? substr(get_the_title(),0,19)."..." :get_the_title() ;
							if(1 == $_enabled_image):
							
								if($_post_type == "gallery"):
									$slider = new MySlideShow($post->ID,'single');
									$slider->setImageSize('my-post-thumb');
									$slider->setPermalinkForAjaxCall(get_permalink());
									$image = $slider->singleImage();
									echo $image;
								else:
									$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-post-thumb',false);
									$image = ( $image != false)? $image[0]:get_bloginfo('template_directory')."/images/poster-my-post-thumb.jpg";
	
									echo "<a href='".get_permalink()."'>";
									echo "<img src='$image' width='54' height='54' alt='{$title}'/>";
									echo "</a>";
								endif;
																
								echo "<h6><a href='".get_permalink()."' title='".get_the_title()."'>{$title}</a></h6>";
							 	echo wpe_excerpt('wpe_excerptlength_teaser1', 'wpe_excerptmore');
							else:	
								echo "<a href='".get_permalink()."' title='".get_the_title()."'>".get_the_title()."</a>";
							endif;
							
							echo "</li>";
						endwhile;
						echo "</ul>";
					endif;
					wp_reset_query();
			echo $after_widget;
		}
}
?>