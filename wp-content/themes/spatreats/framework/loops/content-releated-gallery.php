<?php //TO Show Releated Gallery Items
	global $count;
	$output	= "";
	$category_ids = array();
 	$input  = wp_get_object_terms( $post->ID, 'gallery_entries');
	foreach($input as $category) $category_ids[] = $category->term_id;
	$args = array('orderby'		=>	'rand'
				,'showposts'	=>	5
				,'post__not_in' => 	array($post->ID)
				,'tax_query'	=> 	array( array( 'taxonomy'=>'gallery_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$category_ids  ) )
	 );
	 
 query_posts($args);
 if( have_posts() ):
		$output .= "<h2 class='title'><span>".__(' Related Posts ','spatreats')."</span></h2>";
		$output .= '<div id="mycarousel" class="jcarousel-skin-tango">'; 
		$output .= ' <ul class="related-posts">';

 	while(have_posts()):
		the_post();
		$count++;
		$the_id = get_the_ID();
		$title = $title = ( strlen(get_the_title()) > 28 ) ? substr(get_the_title(),0,26)."..." :get_the_title() ;
		$permalink = get_permalink();
		$output .= "<li>";
		$output .= "<h2><a href='{$permalink}' title='{$title}'>{$title}</a></h2>";
		$slider = new MySlideShow($the_id,'single');
	    $slider->setImageSize('my-releated-post');
		$slider->setPermalinkForAjaxCall(get_permalink());
		$output .=  $slider->singleImage();		
		$output .= 	wpe_excerpt('wpe_excerptlength_teaser', 'wpe_no_excerptmore');
		$output .= "</li>";
	endwhile;

		$output .= "</ul>";
		$output .= "</div>";
		$output .= '<div class="related-slider-controls ">';
		$output .= '    <a href="#" id="mycarousel-prev" class="prev-posts">Prev</a>';
		$output .= '		<div class="jcarousel-control">';
							for($i = 1 ;$i <= $count; $i++):
								$output .= "<a href='#'>{$i}</a>";
							endfor;	
		$output .= '		</div>';
		$output .= '	<a href="#" id="mycarousel-next" class="next-posts">Next</a>';
		
		$output .= "</div>";

	
endif;
echo $output;	
?>