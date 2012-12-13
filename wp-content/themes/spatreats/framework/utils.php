<?php
##PUBLIC UTIL FUNCTIONS:
function page_list($id,$selected) {
	echo "<select name=$id id=$id>";
	echo '<option value="">Select Page</option>';
	$pages = get_pages('title_li=&orderby=name');
	foreach ($pages as $page): ?>
        <option value="<?php echo($page->ID)?>" <?php selected($selected,esc_attr($page->ID));?>><?php echo( esc_html($page->post_title));?></option>
<?php endforeach;
	echo "</select>";
}

#FRONT PAGE TITLE FUNCTION
function my_title() {
	
	#TAG ARCHIVE PAGE
	if ( function_exists('is_tag') && is_tag() ) :
		echo __("Tag archive for","spatreats")."&quot;".single_tag_title('',FALSE);
		echo ("&quot;-");
	elseif ( is_archive() ) : #ARCHHIVE PAGE
		_e("Category archive for","spatreats");
		echo "- &quot;";
		wp_title('');
		echo "&quot; - ";
	elseif ( is_search() ) : #Search Page
		$s = $_REQUEST['s'];
		echo __("Search for","spatreats")." &quot; ".esc_html($s) ." &quot;";
	elseif ( !(is_404())  && ( is_single() || is_page()) ) :   #PAGE,SINGLE POST
	    if(!is_front_page()):
			wp_title('');
			echo "-";
		endif;

	elseif (is_404() ):
		_e("Not Found","spatreats");
		echo "-";
	endif;	
		bloginfo('name');
}#FRONT PAGE TITLE FUNCTION ENDS

#BREADCRUMB
class my_breadcrumb {
	var $options;

	function my_breadcrumb(){
		$this->options = array( 	//change this array if you want another output scheme
			'before' => '<span class="arrow"> ',
			'after' => ' </span>',
			'delimiter' => '',
			'delimiter' => '');
		$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
		global $post;
		echo '<!-- **Breadcrumb** -->
            	<div class="breadcrumb">
				<div class="container">				
				<a href="'.home_url().'">'.__('Home','spatreats').'</a>';
		if(!is_front_page() && !is_home()){echo $markup;}
		$output = $this->simple_breadcrumb_case($post);

		if ( is_page() || is_single()) {
			echo "<h1 class='current-crumb'>";
					the_title();
			echo " </h1>";		
		}else if($output != NULL){
			echo "<h1 class='current-crumb'>";
			echo $output;
			echo " </h1>";
		}else {
			$title =  (get_option( 'page_for_posts' ) > 0) ? get_the_title( get_option( 'page_for_posts' ))  :NULL;
			echo $markup;
			echo "<h1 class='current-crumb'>";
			echo $title;
			echo " </h1>";
		}
		echo "
			</div>  <!-- **Breadcrumb - End** -->  
		</div> <!-- ** container - End -->";
	}
	
	function simple_breadcrumb_case($der_post){
		$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
		if (is_page()){
			 if($der_post->post_parent) {
				 $my_query = get_post($der_post->post_parent);			 
				 $this->simple_breadcrumb_case($my_query);
				 $link = '<a href="'.get_permalink($my_query->ID).'">';
				 $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
				 echo $link;
			 }
		return;	 	
		} 

		if(is_single()){
			$category = get_the_category();
			if (is_attachment()){
				$my_query = get_post($der_post->post_parent);			 
				$category = get_the_category($my_query->ID);
				$ID = $category[0]->cat_ID;
				echo get_category_parents($ID, TRUE, $markup, FALSE );
				previous_post_link("%link $markup");
			}else{
				$postType = get_post_type();

				if($postType == 'post')	{
					$ID = $category[0]->cat_ID;
					echo get_category_parents($ID, TRUE,$markup, FALSE );
				} else if($postType == 'gallery') {
					global $post;
					$terms = get_the_term_list( $post->ID, 'gallery_entries', '', '$$$', '' );
					$terms =  array_filter(explode('$$$',$terms));
					if( !empty($terms)):
						echo $terms[0].$markup;
				    endif;
				}
			}
		return;
		}

		if(is_tax()){
			  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			  return $term->name;
		}

		if(is_category()){
			$category = get_the_category(); 
			$i = $category[0]->cat_ID;
			$parent = $category[0]-> category_parent;
			if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
				echo get_category_parents($parent, TRUE, $markup, FALSE);
			}
		return __("Archive for Category: ","spatreats").single_cat_title('',FALSE);
		}

		if(is_author()){
			$curauth = get_userdatabylogin(get_query_var('author_name'));
			return __("Archive for Author: ","spatreats").$curauth->nickname;
		}

		if(is_tag()){ return __("Archive for Tag: ","spatreats").single_tag_title('',FALSE); }

		if(is_404()){ return __("LOST","spatreats"); }

		if(is_search()){ return __("Search","spatreats"); }	

		if(is_year()){ return get_the_time('Y'); }

		if(is_month()){
			$k_year = get_the_time('Y');
			echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
			return get_the_time('F'); 
		}

		if(is_day() || is_time()){ 
			$k_year = get_the_time('Y');
			$k_month = get_the_time('m');
			$k_month_display = get_the_time('F');
			echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
			echo "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;
		return get_the_time('jS (l)'); 
		}

	}
}
#END OF BREADCRUMB
####################################


#### BLOG COMMENT STYLE
####################################
function my_customComments($comment,$args,$depth){
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
		   case 'pingback' :
  
		   case 'trackback' :
			   echo '<li class="post pingback">';
			   echo "<p>";
				   _e( 'Pingback:','spatreats');
				   comment_author_link();
				   edit_comment_link( __('Edit','spatreats'), ' ' ,'');
			   echo "</p>";
		   break;
		   default :                                        

		   case '' :
				echo "<li ";
					comment_class();
				echo ' id="li-comment-';
					comment_ID();
				echo '">';
					echo '<div id="comment-';
							comment_ID();
					echo '">';
					echo '<div class="comment-author">';
						echo '<div class="gravatar"> <span>';
							echo get_avatar( $comment, 50 );
						echo '</span></div>';	
				
						echo '<cite>'.ucfirst(get_comment_author_link()).'</cite>';
						echo '<div class="comment-meta">';
						 printf(__( '%1$s at %2$s','spatreats'), get_comment_date('D M d, Y'), get_comment_time());
						echo '</div>';
					echo '</div><!--.comment-author -->';
					echo '<div class="reply">';
                    echo comment_reply_link( array_merge( $args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
					echo '</div><!-- .reply -->';
					echo '<div class="comment-body">';
							comment_text();
							if ( $comment->comment_approved == '0' ) :
								_e( 'Your comment is awaiting moderation.','spatreats'); 
							endif;
							edit_comment_link( __('Edit','spatreats') );
					echo '</div><!-- .comment-body -->';
					echo '</div><!-- .comment-ID -->';
			break;
		endswitch;
}

############################################
# PAGINATION
############################################
function my_pagination($pages = ''){
	global $paged;
	if(empty($paged))$paged = 1;
	$prev = $paged - 1;							
	$next = $paged + 1;	
	$range = 10; // only edit this if you want to show more page-links
	$showitems = ($range * 2)+1;
	if($pages == '') {	
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)	{
			$pages = 1;
		}
	}
	if(1 != $pages){
	echo "<ul>";
	echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<li> <a href='".get_pagenum_link(1)."'>&laquo;</a></li>":"";
	echo ($paged > 1 && $showitems < $pages)? "<li> <a href='".get_pagenum_link($prev)."'>&lsaquo;</a></li>":"";

	for ($i=1; $i <= $pages; $i++){
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
			echo ($paged == $i)? "<li class='active-page'>".$i."</li>":
			"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>"; 
		}
	}
	
	echo ($paged < $pages && $showitems < $pages) ? "<li> <a href='".get_pagenum_link($next)."'>&rsaquo;</a> </li>" :"";
	echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<li> <a href='".get_pagenum_link($pages)."'>&raquo;</a></li>":"";
	echo "</ul>";
	}
}

##ADMIN UNTIL FUNCTIONS
class MySlideShow {
	var $post_id;
	var $imageSize;
	var $link;
	var $sliders;
	var $slideshow_poster;
	var $slider_count = 0;
	var $slider_effects;

	function MySlideShow($postId= false,$poster = 'single'){
		$this->post_id = $postId;
		$this->slideshow_poster = $poster;
		$data = get_post_meta( $this->post_id, '_gallery_post_meta', true );
		$this->sliders = isset( $data['images']) ? unserialize($data['images']):'';
		$this->slider_effects = isset( $data['effects']) ?  unserialize($data['effects']):array("fade");
		$this->modify_slide_poster();
		$this->link = "";
	}

	function setImageSize($imageSize){
		$this->imageSize = $imageSize;
	}
	
	function setPermalinkForAjaxCall($link){
		$this->link = $link;
	}

	function getSliderCount(){
		return $this->slider_count;
	}

	function modify_slide_poster(){
		if($this->slideshow_poster == 'single'):
			if((is_array($this->sliders)) && (!empty($this->sliders))):
				$this->sliders = array_slice($this->sliders, 0, 1);
			endif;
		endif;
	}

	function generateImage($size,$attachment_id = false){
		$local =  array(
					'my-gallery'=>'my-gallery'
					,'gallery-one-half'=>'one-half'
					,'gallery-one-half-with-sidebar'=>'one-half-with-sidebar'
					,'gallery-one-thrid'=>'one-third'
					,'gallery-one-third-with-sidebar'=>'one-third-with-sidebar'
					,'gallery-one-fourth'=>'one-fourth'
					,'gallery-one-fourth-with-sidebar'=>'one-fourth-with-sidebar'
					,'my-releated-post'=>'my-releated-post'
					,'my-post-thumb'=>'my-post-thumb');

		$img_size = array(
					'my-gallery'=>" width='940' height='864' "
					,'gallery-one-half'=>" width='468' height='379' "
					,'gallery-one-half-with-sidebar'=>" width='348' height='282' "
					,'gallery-one-thrid'=>" width='312' height='253' "
					,'gallery-one-third-with-sidebar'=>" width='232' height='188' "
					,'gallery-one-fourth'=>" width='233' height='179' "
					,'gallery-one-fourth-with-sidebar'=>" width='173' height='133' "
					,'my-releated-post'=>" width='280' height='120' "
					,'my-post-thumb'=>" width='54' height='54' ");
					
		if($attachment_id) {
			$image_src = wp_get_attachment_image_src($attachment_id, $local[$size]);
			$attachment = get_post($attachment_id);
			
			if(is_object($attachment)) :
				$image_description = $attachment->post_excerpt == "" ? $attachment->post_content : $attachment->post_excerpt;
				$image_description = trim(strip_tags($image_description));
				$image_title = trim(strip_tags($attachment->post_title));
				return "<img src='{$image_src[0]}' title='{$image_title}' alt='{$image_description}' width='{$image_src[1]}' height='{$image_src[2]}' />";
				#return "<img src='{$image_src[0]}' title='{$image_title}' alt='{$image_description}' />";
			else:
				return "<img src='".IAMD_BASE_URL."images/poster-".$local[$size].".jpg' {$img_size[$size]}  title='' alt='dummy-poster'/>";
			endif;
		}else{
			return "<img src='".IAMD_BASE_URL."images/poster-".$local[$size].".jpg' {$img_size[$size]}  title='' alt='dummy-poster'/>";
		}
	}

	function singleImage(){
		$output = NULL;	
		if( is_array($this->sliders) && !empty($this->sliders)  ):
			foreach($this->sliders as $slider):
				$this->slider_count +=1;
					if(!empty($this->link)):
						$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize,$slider)."</a>";
					else:
						$output .= $this->generateImage($this->imageSize,$slider);
					endif;
			endforeach;
		else:
			if(!empty($this->link)):
				$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize)."</a>";
			else:
				$output .= $this->generateImage($this->imageSize);
			endif;			
		endif;
	return $output;	
	}

	function slideShow(){
		$output = "";
		$output .= "<div class='slideshow_container'>";
			$effect = implode(", ", $this->slider_effects);
			$output .= "<ul class='slideshow' data-transition='{$effect}'>";
				if( is_array($this->sliders) && !empty($this->sliders)  ):
					foreach($this->sliders as $slider):
						$this->slider_count +=1;
						$output .= "<li>";
						if(!empty($this->link)): 
							$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize,$slider)."
											<span class='image-overlay'> <span class='image-overlay-inside'> </span> </span>
										</a>";
						else:
							$output .= $this->generateImage($this->imageSize,$slider);
						endif;			
						$output .="</li>";
					endforeach;
				else:
					$output .= "<li>";
					if(!empty($this->link)):
						$output .= "<a href='{$this->link}'>".$this->generateImage($this->imageSize)."<span class='image-overlay'>
									<span class='image-overlay-inside'> </span> </span></a>";
					else:
						$output .= $this->generateImage($this->imageSize);
					endif;			
					$output .="</li>";
				endif;
			$output .= "</ul>";			
		$output .= "</div>";
		return $output;	
	}
}

function getFolders($directory, $starting_with = "", $sorting_order = 0) {
	if(!is_dir($directory)) return false;
	$dirs = array();
	$handle = opendir($directory);
	while (false !== ($dirname = readdir($handle))) {
		if ($dirname != "." && $dirname != ".." && is_dir($directory."/".$dirname)) 
		{
			if ($starting_with == "")
				$dirs[] = $dirname;
			else {
				$filter = strstr($dirname, $starting_with);
				if ($filter !== false) $dirs[] = $dirname;
			}
		}  
	}

	closedir($handle);
	
	if($sorting_order == 1) {
		rsort($dirs); 
	} else {
		sort($dirs); 
	}
	return $dirs;
}

function is_moible_view(){
	
	global $my_theme_options;
	$out = "";
	
	if(isset($my_theme_options["general"]["is_mobile_slider_disabled"])):
		$out .=	'<style type="text/css">';
		$out .=	'@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
		 (max-width:1200px) {
				div#home-slider { display:none !important; }
				.home #main { padding:55px 0px 0px; margin:0px; }
			}';
		$out .=	'</style>';
	endif;
echo $out;
}?>