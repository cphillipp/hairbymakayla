<?php #SHORTCODE HELPER 
function delete_htmltags($content,$paragraph_tag=false,$br_tag=false){	
	$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
	$content = preg_replace('#<br \/>#', '', $content);
	if ( $paragraph_tag ) $content = preg_replace('#<p>|</p>#', '', $content);
	return trim($content);
}

function my_shortcode_helper($content,$paragraph_tag=false,$br_tag=false){
	 return delete_htmltags( do_shortcode(shortcode_unautop($content)), $paragraph_tag, $br_tag );
}

get_template_part('framework/theme_shortcodes/shortcodes'); 
get_template_part('framework/theme_shortcodes/enquiry_form'); 

add_shortcode('related-post','my_releated_post');

function my_releated_post($attrs, $content=null, $shortcodename=""){
	global $post;
	global $count;
	extract(shortcode_atts(array( "title"=>'',"class"=>'',"by"=>'',"postcount"=>""), $attrs));
	$class = $class <> '' ? "class = '{$class}'" : '';
	$title = $title <> '' ? "{$title}" : 'Related Posts';
	$postcount = $postcount <> '' ? $postcount : 5;
	$by =  ($by == "tag" || $by == "" ) ? "tag" : "category";
	$output = NULL;
	$input = array();
	$arg = array();
	if($by == "category"){
		$input = get_the_category($post->ID);
		if($input){
			$category_ids = array();
			foreach($input as $category) $category_ids[] = $category->term_id;
			$arg=array('category__in' => $category_ids,	'post__not_in' => array($post->ID),'ignore_sticky_posts'=>1,
				'showposts'=>5 // Number of related posts that will be shown.
			);
		}
	}else{
		$input = wp_get_post_tags($post->ID);
		if($input){
			$tag_ids = array();
			foreach($input as $tag)
				$tag_ids[] = $tag->term_id;	
				$arg=array('tag__in' => $tag_ids,'post__not_in' => array($post->ID),'ignore_sticky_posts'=>1,
						'showposts'=>$postcount // Number of related posts that will be shown.
				);
		}
	}

	if($arg){
		$query = new wp_query($arg);
		if( $query->have_posts() ):
			$output .= do_shortcode("[h2]{$title}[/h2]");
			$output .= '<div id="mycarousel" class="jcarousel-skin-tango">'; 
			$output .= ' <ul class="related-posts">';
			
			while( $query->have_posts() ):
				$query->the_post();
				$count++;

				#$title = get_the_title();
				$title = ( strlen(get_the_title()) > 28 ) ? substr(get_the_title(),0,26)."..." :get_the_title() ;
				$permalink = get_permalink();
				$output .= "<li>";
				$output .= "<h2><a href='{$permalink}' title='{$title}'>{$title}</a></h2>";
						$attachment =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-releated-post');
						if( is_array($attachment) ):
			                if($attachment[3]): #Original Size my-blog 
								if($attachment[1] == 280 && $attachment[2] == 120):
									$output .= "<a href='{$permalink}' title='{$title}'>
										<img src='{$attachment[0]}'  width='{$attachment[1]}' height='{$attachment[2]}' alt='{$title}' /></a>";
								else:
									 $output .= "<a href='{$permalink}' title='{$title}'>
									 	<img class='aligncenter' src='{$attachment[0]}'  width='{$attachment[1]}' height='{$attachment[2]}' alt='{$title}' /></a>";
								endif;
	               			else: #Image original size  
								$output .= "<a href='{$permalink}' title='{$title}'>
									<img class='aligncenter' src='{$attachment[0]}'  width='{$attachment[1]}' height='{$attachment[2]}' alt='{$title}' /></a>";
        					endif;
						else:
								$output .= "<a href='{$permalink}' title='{$title}'>
									<img class='aligncenter' src='".IAMD_BASE_URL."images/poster-my-releated-post.jpg'  width='280' height='120' alt='{$title}' /></a>";
					   endif;		

				$output .= 	wpe_excerpt('wpe_excerptlength_teaser', 'wpe_no_excerptmore');								
				$output .= "</li>";
			endwhile;

			$output .= "</ul>";
			$output .= "</div>";
			$output .= '<div class="related-slider-controls">';
			$output .= '    <a href="#" id="mycarousel-prev" class="prev-posts">Prev</a>';
			$output .= '		<div class="jcarousel-control">';
									for($i = 1 ;$i <= $count; $i++):
										$output .= "<a href='#'>{$i}</a>";
									endfor;	
			$output .= '		</div>';
			$output .= '	<a href="#" id="mycarousel-next" class="next-posts">Next</a>';
			$output .= "</div>";
		endif;
	}
	return $output;
}//my_releated_post?>