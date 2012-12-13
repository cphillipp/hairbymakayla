<?php 
## MY_Twitter
class MY_Twitter extends WP_Widget {
		#1.constructor
		function MY_Twitter() {
			$widget_options = array("classname"=>'tweetbox', 'description'=>'To Show latest tweets from your tweets');
			$this->WP_Widget(false,wp_get_theme()." Twitter",$widget_options);
		}
	
		#2.Input Form
		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'twitter_uname' => '', 'tweets_count' => '' ) );
			$title = strip_tags($instance['title']);
			$twitter_uname = strip_tags($instance['twitter_uname']);
			$tweets_count = strip_tags($instance['tweets_count']); ?>
			
    		  <!-- TWITTER WIDGET FORM -->
			  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
			  <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>"/>
              </p>
		
              <p><label for="<?php echo $this->get_field_id('twitter_uname'); ?>">Twitter Username:</label>
              <input class="widefat" id="<?php echo $this->get_field_id('twitter_uname'); ?>" name="<?php echo $this->get_field_name('twitter_uname'); ?>" type="text" 
              value="<?php echo $twitter_uname;?>"/></p>
                
              <p><label for="<?php echo $this->get_field_id('tweets_count'); ?>">No.of tweets to show:</label> 
              <input class="widefat" id="<?php echo $this->get_field_id('tweets_count');?>" name="<?php echo $this->get_field_name('tweets_count');?>" type="text" 
              value="<?php echo $tweets_count;?>"/></p>
        
<?php	}
		
		#3.Update Process
		function update($new_instance, $old_instance) {
			// processes widget options to be saved
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['twitter_uname'] = strip_tags($new_instance['twitter_uname']);
			$instance['tweets_count'] = strip_tags($new_instance['tweets_count']);
		return $instance;
		}
		
		#4.Output hte Widget in Fornt End
		function widget($args, $instance) {
			extract($args);
			echo $before_widget;
				$title = empty($instance['title']) ? 'Latest Tweets' : apply_filters('widget_title', $instance['title']);
				$twitter_uname = empty($instance['twitter_uname']) ? '' : apply_filters('widget_entry_title', $instance['twitter_uname']);
				$tweets_count = empty($instance['tweets_count']) ? (int)'5' :(int) $instance['tweets_count'];
				
				if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
				#$feed = fetch_feed('http://twitter.com/statuses/user_timeline.rss?screen_name='.$twitter_uname); # Showing errors
				$feed = fetch_feed('http://api.twitter.com/1/statuses/user_timeline.rss?screen_name='.$twitter_uname);	

				echo "<ul>";
				if (! is_wp_error($feed)) {
					
					$maxitems = $feed->get_item_quantity($tweets_count);
					$tweet_items = $feed->get_items(0, $maxitems);
					
					if ($maxitems == 0) { 
						echo '<li>No items.</li>';
					} else {
						foreach ( $tweet_items as $item ) : 
							echo '<li>';
							echo '<span class="tweet-time">'.$item->get_date('j F Y | g:i a').'</span>';
							echo substr($item->get_description(),strlen($twitter_uname.":"),strlen($item->get_description())-strlen($twitter_uname.":"));
							echo '<a href="'.$item->get_permalink().'" title="'.$item->get_title().'">'.
									substr($item->get_title(),strlen($twitter_uname.":"),strlen($item->get_title())-strlen($twitter_uname.":"))
								.'</a>';	
							echo '</li>';
						endforeach;
					}
					
				}else{
					echo "<li>Error..!</li>";
				}
				echo "</ul>";
		    echo $after_widget;
		}
}
?>