<?php /*Template Name: Catalog Template*/?>
<?php get_header();?>
<?php $tpl_catalog_meta = get_post_meta($post->ID,'_tpl_catalog_meta',TRUE);
	  $items_per_page 		= isset($tpl_catalog_meta['items_perpage'])? $tpl_catalog_meta['items_perpage']:-1;
	  $is_fullwidth_page 	= isset($tpl_catalog_meta['is_fullwidthpage']) ? "content-full-width": NULL;
	  $view_type = 			  isset($tpl_catalog_meta['item_view']) ? $tpl_catalog_meta['item_view'] : 'all';
	  #$img_size =   		 ( $is_fullwidth_page != NULL)	? "one-fourth" : "one-fourth-with-sidebar";
	  $img_size  ="my-square";
	  
	  
	  $terms = array();
	  
	  $categories = get_categories('taxonomy=item_category&hide_empty=1');
	  #var_dump($categories[0]);
	  foreach($categories as $category):
		  $link =  ($view_type == "all") ? "name = '".$category->slug."'": "href='".get_term_link( $category->slug,'item_category')."'";
		  $terms[$category->term_id] =  array ("name"=>$category->name , "slug"=>$category->slug,"link" => $link);
		  if($view_type != "all"):
		  	break;
		  endif;
		  
	  endforeach;?>
        
	   	<!-- **Content Full Width** -->
	   	<div class="content menu-items-list <?php echo $is_fullwidth_page; ?>">
            <?php if($view_type == "all"): ?>
   			<?php 	if( have_posts() ): ?>
            <?php 		while ( have_posts() ) : the_post(); ?>
            <?php 			get_template_part( 'framework/loops/content', 'page' ); ?>
            <?php   	endwhile; // end of the loop. ?>
            <?php 	endif;?>
            <?php else: ?>
            <?php	$desc = category_description($categories[0]->term_id);  if(!empty($desc)) echo $desc;?>
            <?php endif;?>
                  
              <div class="clear"></div>    


            	<div class="menu-sidebar">
                	<?php $class = ($view_type == "all") ?  "j-load-all" : "j-default";?>
	                <ul class="<?php echo $class;?>">
                    <?php foreach( $categories as $category ):
						  	$link =  ($view_type == "all") ? "#".$category->slug : get_term_link( $category->slug,'item_category');?>
	                          <li><a href="<?php echo $link;?>" class="smoothScroll"><?php echo $category->cat_name;?></a></li>
					<?php endforeach ?>	
    	            </ul>
                </div> 

        
           	<!-- **Column Three Fourth** -->
        	<div class="column three-fourth">
            <?php foreach($terms as $key => $value ): ?>
			      <h1><a <?php echo $value['link'];?>><?php echo $value['name'];?></a></h1>
                  <?php $args = array(	'paged' 			=> get_query_var( 'paged' )
										,'posts_per_page' 	=> $items_per_page
										,'tax_query'		=> array( array( 'taxonomy'=>'item_category', 'field'=>'id', 'operator'=>'IN', 'terms'=>array($key)  ) ) );
				  	query_posts($args);
					if( have_posts() ):
						while( have_posts() ):
							the_post();
							$the_id = get_the_ID();
							$item = get_post_meta($the_id,'_item_post_meta',TRUE);
							$price = isset( $item['price']) ? $item['price'] : NULL;
							$subtitle = isset( $item['sub-title']) ? $item['sub-title'] : NULL;
							$class = isset( $item['rounded']) ? "rounded-img" : NULL;
							?>
                            <div class="menu-list">
	                            <?php $attachment  = wp_get_attachment_image_src(get_post_thumbnail_id($the_id),$img_size); 
                                if( $attachment ): ?>
	                            	 <div class="menu-image">
    	                                <span class="border <?php echo $class;?>">
                                         	<img alt="<?php the_title();?>"  src="<?php echo $attachment[0]; ?>" />
                                         </span>
	                                 </div>	
                                     
                                    <div class="menu-details">  
                          <?php	else: ?>
                                    <div class="menu-details with-no-image">  
                          <?php endif;?>       
                                         <h2 class="menu-title"> <span><?php the_title();?></span> </h2>
                                         <?php if( !empty($price) ): ?>
                                         <span class="menu-item-price"><?php echo $price;?></span>
                                         <?php endif;?>
                                         <?php if( !empty($subtitle) ): ?>
                                         <span class="sub-title"><?php echo $subtitle;?></span>
                                         <?php endif;?>
                                         <?php #echo wpe_excerpt('wpe_excerptlength_blog', 'wpe_no_excerptmore');?>
                                         <?php the_content();?>
                                 </div>
                            </div>
            <?php 		endwhile;
					endif;                
			 endforeach;?>
            </div> <!-- **Column Three Fourth - End** --> 
            
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