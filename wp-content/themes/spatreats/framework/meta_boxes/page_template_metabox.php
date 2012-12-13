<?php  add_action("admin_init", "template_pages_metabox"); 
function template_pages_metabox(){
	add_meta_box("template-pages-metabox", "Page Template Settings", "template_pages_settings", "page", "normal",'default');
	add_action('save_post','template_page_meta_save');
}?>
<?php function template_pages_settings(){ 
		global $post;
		
		#tpl-gallery page meta values
		$tpl_gallery_meta = get_post_meta($post->ID,'_tpl_gallery_meta',TRUE);
		
		$tpl_booknow_meta = get_post_meta($post->ID,'_tpl_booknow_meta',TRUE);
		
		$tpl_catalog_meta = get_post_meta($post->ID,'_tpl_catalog_meta',TRUE);?>
	<div class="j-pagetemplate-container">
    
    		<div class="iamd_pt_info">
				<p><?php _e('Additional settings appear here, when one of page templates is selected ( Page Attributes -> Template )','spatreats');?></p>
                <p><input type="checkbox" name="_fullwidthpage" id="_fullwidthpage" value="" <?php checked(get_post_meta($post->ID,'_fullwidthpage',TRUE)); ?> />
                	<?php _e('Full Width Page','spatreats');?></label></p>
			</div> <!-- .iamd_pt_info -->
            
            <!-- Catalog  Template Page-->
            <div class="tpl-catalog">
            	<div style="display:none;">
            	<p><strong><?php _e('Item Display','spatreats');?></strong></p>
                <p><?php $s = array('all'=>__('All Item in a single page','spatreats') , 'category_wise' => __('Category Wise','spatreats'));
						 $v = 	 isset( $tpl_catalog_meta['item_view'] ) ? $tpl_catalog_meta['item_view'] : 'all';
						 
						echo '<select name="item_view">';
							foreach($s as $key => $value):
								$selected =  selected($v,esc_attr($key),false);
								echo "<option value='{$key}' {$selected} >{$value}</option>";
							endforeach;
						echo '</select>';
					?></p>
                    
                <!-- Post Count -->
                <?php $items_perpage = isset( $tpl_catalog_meta['items_perpage'] ) ? $tpl_catalog_meta['items_perpage'] : NULL; ?>
                <p><label><strong><?php _e('Items per page:( If your Item display mode is "category_wise")','spatreats');?></strong></label></p>
                <p><input type="text" size="2" name="c_items_perpage"  value="<?php echo($items_perpage);?>" class="small-text"></p>
                <p><em><?php _e('How many items should be displayed per page?','spatreats'); ?></em></p>
                </div>
                
                <?php $is_fullwidthpage = isset( $tpl_catalog_meta['is_fullwidthpage'] ) ? $tpl_catalog_meta['is_fullwidthpage'] : NULL; ?>
                <p><input type="checkbox" name="_fullwidthpage" id="_fullwidthpage" value="" <?php checked($is_fullwidthpage); ?> />
               	<?php _e('Full Width Page','spatreats');?></label></p>
            </div>
            <!-- Catalog  Template Page end-->

            <div class="tpl-booknow">
	            <?php $emailid = isset( $tpl_booknow_meta['emailid'] ) ? $tpl_booknow_meta['emailid'] : get_option('admin_email'); ?>
                <p><label><strong><?php _e('Email id:','spatreats');?></strong></label>
                   <input type="text" name="emailid" id="emailid" class="large" value="<?php echo($emailid);?>" /></p>
                <p><em><?php _e('Please give email id to whom , you need to send book now requests.','spatreats'); ?></em></p>

                <?php $is_fullwidthpage = isset( $tpl_booknow_meta['is_fullwidthpage'] ) ? $tpl_booknow_meta['is_fullwidthpage'] : NULL; ?>
                <p><input type="checkbox" name="_fullwidthpage" id="_fullwidthpage" value="" <?php checked($is_fullwidthpage); ?> />
                	<?php _e('Full Width Page','spatreats');?></label></p>
            </div>

            <!-- Gallery settings -->
            <div class="tpl-gallery">
            	<!-- Columns -->
            	<p><label><strong><?php _e('Gallery Columns','spatreats');?></strong></label></p>
                <p><em><?php _e('How many columns should be displayed?','spatreats');?></em></p>
	            <p><?php $d = array('1'=>'1 Column', '2'=>'2 Columns','3'=>'3 Columns','4'=>'4 Columns');
					$columns = isset($tpl_gallery_meta['columns']) ? $tpl_gallery_meta['columns'] : NULL;?>
                    <select name="gallery_column">
                    	<option><?php _e('Select','spatreats');?></option>
                        <?php foreach( $d as $key => $value): ?>
                        	<option value="<?php echo(esc_attr($key));?>" <?php selected($columns,esc_attr($key));?>><?php echo(esc_html($value)); ?></option>
                        <?php endforeach; ?>
                    </select></p>
                <p><label><strong><?php _e('Which categories should be used for the gallery?','spatreats');?></strong></label></p>
                <p><em><?php _e('You can select multiple categories here. The Gallrey Page that you choose below will then show all posts from those categories, along with a sort option for each category.','spatreats');?></em></p>
                <p><?php $b = get_categories('taxonomy=gallery_entries&hide_empty=0');?>
                   <?php $p = array();
						 $q = isset($tpl_gallery_meta['categories'] ) ? unserialize($tpl_gallery_meta['categories']) : array();	
						 if( is_array( $q)) $p = $q;?>
                    <?php foreach( $b as $cats): ?>
                    <label style="padding-bottom: 5px; display: block;">
                    <input type="checkbox" name="gallery_cats[]" id="gallery_entries-<?php echo(esc_attr($cats->cat_ID));?>" value="<?php echo(esc_attr($cats->cat_ID));?>"
                    	   <?php checked(in_array(esc_attr($cats->cat_ID),$p)); ?>	/> <?php echo(esc_html($cats->cat_name.' - ( '. $cats->count.' )'));?>
                    </label>        
                    <?php endforeach;?>
                </p>

                <!-- Ajax -->
                <?php $is_ajax_load = isset( $tpl_gallery_meta['is_ajax_load'] ) ? $tpl_gallery_meta['is_ajax_load'] : NULL; ?>
                <p><input type="checkbox" name="is_ajax_load" id="is_ajax_load" value=""  <?php checked($is_ajax_load);?>/>
                   <label><strong><?php _e('Gallery Details?','spatreats');?></strong></label></p>
                <p><em><?php _e('Should the gallery details be opened on the same page when someone clicks a gallery item - known as AJAX Gallery?','spatreats');?></em></p>

                <!-- Sorting -->
                <?php $is_sortable = isset( $tpl_gallery_meta['is_sortable'] ) ? $tpl_gallery_meta['is_sortable'] : NULL; ?>
                <p><input type="checkbox" name="is_page_sortable" id="is_page_sortable" value="" <?php checked($is_sortable);?>/>
                   <label><strong><?php _e('Gallery Sortable?','spatreats');?></strong></label></p>
                <p><em><?php _e('Should the sorting options based on categories be displayed?','spatreats');?></em></p>

                <!-- Title -->
                <?php $show_title = isset( $tpl_gallery_meta['show_title'] ) ? $tpl_gallery_meta['show_title'] : NULL; ?>
                <p><input type="checkbox" name="items_showtitle" id="items_showtitle" value=""  <?php checked($show_title);?>/> 
                   <label><strong><?php _e('Show Titles','spatreats');?></strong></label></p>
                <p><em><?php _e('Display Title of entry?','spatreats');?></em></p>

                <!-- Post Count -->
                <?php $items_perpage = isset( $tpl_gallery_meta['items_perpage'] ) ? $tpl_gallery_meta['items_perpage'] : NULL; ?>
                <p><label><strong><?php _e('Posts per page:','spatreats');?></strong></label>
                  <input type="text" size="2" name="items_perpage" id="items_perpage" value="<?php echo($items_perpage);?>" class="small-text"></p>
                <p><em><?php _e('How many items should be displayed per page?','spatreats'); ?></em></p>

                <?php $is_fullwidthpage = isset( $tpl_gallery_meta['is_fullwidthpage'] ) ? $tpl_gallery_meta['is_fullwidthpage'] : NULL; ?>
                <p><input type="checkbox" name="_fullwidthpage" id="_fullwidthpage" value="" <?php checked($is_fullwidthpage); ?> />
                	<?php _e('Full Width Page','spatreats');?></label></p>
            </div>
    </div><!-- .j-pagetemplate-container -->
<?php } ?>
<?php function template_page_meta_save($post_id){
		if(isset($_POST['post_type']) && $_POST['post_type'] == 'page') {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		}

		if( isset($_POST["page_template"]) && 'tpl-gallery.php' == $_POST["page_template"]):
			$gallery = array();
				$gallery['columns'] 		= ( (isset($_POST['gallery_column'])) && ( $_POST['gallery_column']!="Select") )?$_POST['gallery_column']:3;
				$gallery['categories'] 		= isset($_POST['gallery_cats'])? serialize($_POST['gallery_cats']):NULL;
				$gallery['is_ajax_load'] 	= isset($_POST['is_ajax_load'])?1:NULL;
				$gallery['is_sortable'] 	= isset($_POST['is_page_sortable'])?1:NULL;
				$gallery['show_title'] 		= isset($_POST['items_showtitle'])?1:NULL;
				$gallery['items_perpage'] 	= (isset($_POST['items_perpage']) && !empty($_POST['items_perpage']))?(int) $_POST['items_perpage']:NULL;
				$gallery['is_fullwidthpage'] = isset( $_POST["_fullwidthpage"] ) ? 1 : 0;
				
				update_post_meta($post_id, '_tpl_gallery_meta',array_filter($gallery));
				delete_post_meta($post_id, '_tpl_booknow_meta');
				delete_post_meta($post_id, '_tpl_catalog_meta');
				delete_post_meta($post_id, "_fullwidthpage");
				
		elseif( isset($_POST["page_template"]) && 'tpl-booknow.php' == $_POST["page_template"] ):		
		
				$booknow = array();
				$booknow['is_fullwidthpage'] = isset( $_POST["_fullwidthpage"] ) ? 1 : 0;
				$booknow['emailid'] = isset( $_POST["emailid"] ) ? $_POST["emailid"] : get_option('admin_email');
				
				update_post_meta($post_id, '_tpl_booknow_meta',array_filter($booknow));
				delete_post_meta($post_id, '_tpl_gallery_meta');
				delete_post_meta($post_id, '_tpl_catalog_meta');				
				delete_post_meta($post_id, "_fullwidthpage");
				
		elseif( isset($_POST["page_template"]) && 'tpl-catalog.php' == $_POST["page_template"] ):
		
				$catalog = array();
				$catalog['item_view']		= $_POST['item_view'];
				$catalog['items_perpage'] 	= (isset($_POST['c_items_perpage']) && !empty($_POST['c_items_perpage']))?(int) $_POST['c_items_perpage']:NULL;
				$catalog['is_fullwidthpage'] = isset( $_POST["_fullwidthpage"] ) ? 1 : 0;
				
				update_post_meta($post_id, '_tpl_catalog_meta',array_filter($catalog));
				delete_post_meta($post_id, '_tpl_gallery_meta');
				delete_post_meta($post_id, '_tpl_booknow_meta');				
				delete_post_meta($post_id, "_fullwidthpage");
				
		elseif( isset($_POST["page_template"]) && 'default' == $_POST["page_template"]):

			delete_post_meta($post_id, '_wp_page_template');
			delete_post_meta($post_id, '_tpl_gallery_meta');
			delete_post_meta($post_id, '_tpl_booknow_meta');
			delete_post_meta($post_id, '_tpl_catalog_meta');			
			$is_fullwidth_page = isset( $_POST["_fullwidthpage"] ) ? 1 : 0;
			update_post_meta( $post_id, "_fullwidthpage", $is_fullwidth_page );

		endif;
	}?>