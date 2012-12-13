<?php get_header();?>
    	<!-- **Content Full Width** -->
    	<div class="content menu-items-list content-full-width">
        	<?php $desc = category_description(); 
			 	  if(!empty($desc)):
				  	echo "{$desc}";
				  	echo '<div class="clear"></div>';
				  endif;?>
        
        	<?php $categories = get_categories('taxonomy=item_category&hide_empty=1');?>
            
            
               	<div class="menu-sidebar">
	                <ul>
                    <?php foreach( $categories as $category ):
						  $name =  $category->cat_name;
						  $slug = $category->slug;
					      $class = (get_query_var('item_category')  == $slug) ? "class='active' " : NULL;?>
                         <li><a <?php echo $class;?> href="<?php echo get_term_link( $slug,'item_category');?>"><?php echo $name ?></a></li>
					<?php endforeach ?>	
    	            </ul>
                </div> 

            
            <!-- **Column Three Fourth** -->
        	<div class="column three-fourth">
				<?php if( have_posts() ): ?>
                <?php while ( have_posts() ) : the_post(); 
						$the_id = get_the_ID();
						$item = get_post_meta($the_id,'_item_post_meta',TRUE);
						$price = isset( $item['price']) ? $item['price'] : NULL;
						$subtitle = isset( $item['sub-title']) ? $item['sub-title'] : NULL;
						$class = isset( $item['rounded']) ? "rounded-img" : NULL;?>
                        <div class="menu-list">
	                    <?php $attachment  = wp_get_attachment_image_src(get_post_thumbnail_id($the_id),'my-square'); 
                        if( $attachment ): ?>
	                    	<div class="menu-image">
                                <span class="border <?php echo $class;?>"> <img alt="<?php the_title();?>"  src="<?php echo $attachment[0]; ?>" /></span>
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
                <?php endwhile; ?>
                <?php else:?>
                    <div class="hr_invisible"> </div>
                    <h1><?php _e( 'Nothing Found', 'spatreats' ); ?></h1>
                    <p><?php _e( 'Apologies, but no results were found for the requested archive.', 'spatreats' ); ?></p>
                    <?php get_search_form(); ?>
                <?php endif;?>
            </div> <!-- **Column Three Fourth - End** -->
            
            
        

            <!-- **Pagination** -->
            <div class="pagination">
				<div class="prev-post"> <?php previous_posts_link('<span> Prev Posts </span>');?> </div>           
                <div class="next-post"> <?php next_posts_link('<span> Next Posts </span>');?> </div>
                <?php my_pagination();?>
            </div><!-- **Pagination - End** -->

        </div><!-- **Content Full Width End** -->
<?php get_footer();?>