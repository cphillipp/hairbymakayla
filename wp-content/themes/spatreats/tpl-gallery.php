<?php /*Template Name: Gallery Template*/?>
<?php get_header();?>
<?php $tpl_gallery_meta 	= get_post_meta($post->ID,'_tpl_gallery_meta',TRUE);
	  $sortable 			= isset($tpl_gallery_meta['is_sortable'])?'sortable':NULL;
	  $ajax_class 			= isset($tpl_gallery_meta['is_ajax_load'])?'ajax-gallery-container':NULL;
	  $items_per_page 		= isset($tpl_gallery_meta['items_perpage'])? $tpl_gallery_meta['items_perpage']:-1;
	  $is_fullwidth_page 	= isset($tpl_gallery_meta['is_fullwidthpage']) ? "content-full-width": NULL;
	  $categories 			= ( isset($tpl_gallery_meta['categories']) && ( is_array( unserialize($tpl_gallery_meta['categories']) ) ) )
	  						  ? unserialize($tpl_gallery_meta['categories']) : array();
							  
	 $grid = "one-third";
	 $image_size = "gallery-one-third";
	 
	 switch($tpl_gallery_meta['columns']):
	 
		case "1":
			$grid = "full-width";
			if( empty($is_fullwidth_page) ):
				$grid = "full-width full-width-with-sidebar";
			endif;
			$image_size = "my-gallery";
		break;

		case "2":
			$grid = "one-half";
			if( empty($is_fullwidth_page) ):
				$image_size = "gallery-one-half-with-sidebar";
				$grid = "one-half with-sidebar";
			else:
				$image_size = "gallery-one-half";
			endif;	
		break;

		case "3":
			$grid = "one-third";
			if( empty($is_fullwidth_page) ):
				$image_size = "gallery-one-third-with-sidebar";
				$grid = "one-third with-sidebar";
			else:
				$image_size = "gallery-one-thrid";
			endif;	
		break;

		case "4":
			$grid = "one-fourth";
			if( empty($is_fullwidth_page) ):
				$image_size = "gallery-one-fourth-with-sidebar";
				$grid = "one-fourth with-sidebar";
			else:
				$image_size = "gallery-one-fourth";
			endif;
		break;
	endswitch;


		if( empty($categories) ):
			$categories = get_categories('taxonomy=gallery_entries&hide_empty=1');
		else:
			$args = array('taxonomy'=>'gallery_entries','hide_empty'=>1,'include'=>$categories);
			$categories = get_categories($args);			
		endif;?>
        
	   	<!-- **Content Full Width** -->
	   	<div class="content <?php echo $is_fullwidth_page; ?>">
			<?php if( have_posts() ): ?>
            <?php 	while ( have_posts() ) : the_post(); ?>
            <?php 		get_template_part( 'framework/loops/content', 'page' ); ?>
            <?php   endwhile; // end of the loop. 
                  endif;?>

            <!-- Sorting Container -->
            <?php if( (!empty($sortable)) && ( !empty($categories) ) ):?>      
                 <div id="sorting-container">
                 	<div id="js_sort_items">
                        <a href='#' data-filter='all_sort' class='all_sort_button active_sort'><?php echo __('All','spatreats');?></a>
                        <?php foreach( $categories as $category ): ?>
                            <a href='#' data-filter="<?php echo $category->category_nicename;?>_sort" 
                                class="<?php echo $category->category_nicename;?>_sort_button"><?php echo $category->cat_name;?></a>
                        <?php endforeach;?>
                    </div>
                 </div>
           <?php endif;?><!-- Sorting Container END -->
          
           		 <!-- **Gallery Wrapper -->
                 <div class="gallery-wrapper <?php echo($ajax_class.' '.$sortable);?>">
                 		<!-- **Gallery Details** -->
		            	<div class="gallery-details">
                        	 <div class="gallery-details-inner">
                             </div>
                        </div><!-- **Gallery Details**  END -->
                        
                        <!-- **Gallery Container** -->
		                <div class="gallery-sort-container gallery-container">
                        	<?php $args = array();
								  if( isset($tpl_gallery_meta['categories']) ):
								  	$terms = unserialize($tpl_gallery_meta['categories']);
									$args = array(	'orderby' 			=> 'ID'
													,'order' 			=> 'ASC'
													,'paged' 			=> get_query_var( 'paged' )
													,'posts_per_page' 	=> $items_per_page
													,'tax_query'		=> array( array( 'taxonomy'=>'gallery_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$terms  ) ) );
								  else:
								  	$args = array(	'paged' => get_query_var( 'paged' ) ,'posts_per_page' => $items_per_page ,'post_type' => 'gallery');
								  endif;
								  
								  query_posts($args); 	
								  if( have_posts() ):
								  	$count = 1; $last_class=''; #To add last-column class
									while( have_posts() ):
										the_post();
										$the_id = get_the_ID();
										#Find sort class by using the gallery_entries
										$sort = "";
										$item_categories = get_the_terms( $the_id, 'gallery_entries' );
										if(is_object($item_categories) || is_array($item_categories)):
											foreach ($item_categories as $category):
												$sort .= $category->slug.'_sort ';
											endforeach;
										endif;
										
										if($count == $tpl_gallery_meta['columns']) $last_class = 'last';?>
                                        	<div data-ajax-id="<?php echo $the_id;?>"
                                            	class="isotope-item post-entry post-entry-<?php echo($the_id.'  all_sort '.$sort.' '.$grid.' column  no-margin');?>">
                                                <div class="inner-entry">
                                                <?php $slider = new MySlideShow($the_id,'single');
													  $slider->setImageSize($image_size);
													  $slider->setPermalinkForAjaxCall(get_permalink());
 	 												  echo $slider->slideShow();?>
                                                 <?php if(isset($tpl_gallery_meta['show_title'])): ?>     
                                                 <div class="gallery-title">
                                                       <h5><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h5>
                                                 </div>
                                                 <?php endif;?>
                                                </div>
                                            </div>    
									<?php
										#To add last-column class 
										 if($count == $tpl_gallery_meta['columns']): 
											$last_class = ''; 
											$count = 0;
									  	endif; 	
										$count ++;
									endwhile;
									else:?>
                                        <div class="hr_invisible"> </div>
                                        <h1><?php _e( 'Nothing Found', 'spatreats' ); ?></h1>
                                        <h3><?php _e( 'Apologies, but no items found in our gallery.', 'spatreats' ); ?></h3>
                                        <?php get_search_form(); ?>
                              <?php endif;?>
                        </div><!-- **Gallery Container - End** -->
                 </div><!-- **Gallery Wrapper END -->

            <!-- **Pagination** -->
            <div class="pagination">
				<div class="prev-post"> <?php previous_posts_link('<span> Prev Posts </span>');?> </div>           
                <div class="next-post"> <?php next_posts_link('<span> Next Posts </span>');?> </div>
                <?php my_pagination();?>
            </div><!-- **Pagination - End** -->

        </div><!-- ** Content Full Width End -->
<?php if( empty($is_fullwidth_page) ):?>
         <!-- **Sidebar** -->
    	<div class="sidebar">
        	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('display-everywhere-sidebar') ): endif;?>
        	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page-sidebar') ): endif;?>
        </div>
<?php endif; ?>
<?php get_footer();?>