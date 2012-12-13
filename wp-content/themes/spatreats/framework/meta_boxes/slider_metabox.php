<?php 
add_action("admin_init", "slider_metabox");
function slider_metabox(){
	add_meta_box("slider-post-meta-container", __('Slider Options','spatreats'), "slider_effect", "slide", "normal", "high");
	add_action('save_post','slider_item_meta_save');
}

function slider_effect($slider_effect){
	global $post;?>
    <div class="form-field" style="width:100%">
    	<h4><?php  _e('Custom Link','spatreats');?></h4>
        <input type="text" name="custom_link"  value="<?php echo get_post_meta($post->ID, '_custom_link',true);?>" />
    </div>
    
    <div style="width:100%">
    	<h4><?php  _e('Choose Slider Images Effect ','spatreats');?></h4>
    <?php $effects = array("sliceDown","sliceDownLeft","sliceUp","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade",
		"random","slideInRight","slideInLeft","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse","None");
         sort($effects);
		 
	  	foreach( $effects as $effect): 
			$checked = ( $effect == get_post_meta($post->ID, '_slider_effect',TRUE)) ? 'checked="checked"' : '';?>   
             <label style="padding:5px; width:18%; display:inline-block;">        		
    	         <input type="radio" name="effect" value="<?php echo $effect;?>" <?php echo $checked;?>  /> <?php echo(esc_html($effect));?>
	         </label>
<?php  endforeach; ?> 
    </div> 
<?php }?>
<?php function slider_item_meta_save( $post_id){
	   
	    if( isset($_POST['custom_link']) )
			update_post_meta($post_id, '_custom_link',$_POST['custom_link']);
		else
			delete_post_meta($post_id, '_custom_link');
	
		if( isset($_POST['effect']) && $_POST['effect'] != "None" )
			update_post_meta($post_id, '_slider_effect',$_POST['effect']);
			
		if(isset($_POST['effect']) && $_POST['effect'] == "None")
			delete_post_meta($post_id, '_slider_effect');
	  }?>