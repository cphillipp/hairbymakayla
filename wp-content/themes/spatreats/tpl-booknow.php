<?php /*Template Name: Booknow Template*/?>
<?php global $my_theme_settings; ?>
<?php get_header();?>
		<?php $tpl_booknow_meta = get_post_meta($post->ID,'_tpl_booknow_meta',TRUE);
			  $is_fullwidth_page =  isset($tpl_booknow_meta['is_fullwidthpage']) ? 	"content-full-width" : NULL;
			  $emailid = isset( $tpl_booknow_meta['emailid'] ) ? $tpl_booknow_meta['emailid'] : get_option('admin_email');?>
    	<!-- **Content Full Width** -->
    	<div class="content <?php echo $is_fullwidth_page; ?>">
        
        <!-- Page header code -->
		<?php $header_section = ( isset($my_theme_settings["codes"]["page-top-code"])  && (isset($my_theme_settings["codes"]["enable-page-top-code"])) ) 
            ? $my_theme_settings["codes"]["page-top-code"] : '';
        echo $header_section;?>
        <!-- Page header code end-->
        
        	<?php if( have_posts() ): ?>
        	<?php while ( have_posts() ) : the_post(); ?>
            	<?php get_template_part( 'framework/loops/content', 'page' ); ?>
			<?php endwhile; // end of the loop. 
           		  endif;?>
                  
                              
                <div class="column one-half">
                	<div id="ajax_message"></div>
                    <form id="booknow-form" action="<?php echo IAMD_FW_URL;?>forms/booknow.php" method="get" class="booknow-form">
	                    <p><input type="hidden" name="admin_emailid" value="<?php echo $emailid;?>" /></p>
                        <p><label> First Name <span class="required"> * </span> </label><input name="fname" type="text" /></p>
                        <p><label> Last Name <span class="required"> * </span> </label><input name="lname" type="text" /></p>
                        <p><label> Gender </label>
                           <span class="gender">
                            <input type="radio" class="radiob1" id="Male" name="Gender" value="Male" />Male
                            <input type="radio" class="Female" id="Female" name="Gender" value="Female" checked="checked" />Female
                           </span>
	                    </p>
                        <p><label> Telephone <span class="required"> * </span> </label><input name="phone" type="text" /></p>
                        <p><label> Email <span class="required"> * </span> </label><input name="email" type="text" /></p>
                        <p><label> Address </label><textarea name="address" cols="20" rows="7"></textarea></p>
                        <p><label> Date of Treatment <span class="required"> * </span> </label>
                           <select class="day" id="treatment_day" name="treatment_day">	
                               <option value="">Day</option>
                               <option value="1">1</option>	<option value="2">2</option>	<option value="3">3</option>
                               <option value="4">4</option>	<option value="5">5</option>	<option value="6">6</option>
                               <option value="7">7</option>	<option value="8">8</option>	<option value="9">9</option>
                               <option value="10">10</option>	<option value="11">11</option>	<option value="12">12</option>                               
                               <option value="13">13</option>	<option value="14">1</option>                               
                               <option value="15">15</option>	<option value="16">16</option>	<option value="17">17</option>
                               <option value="18">18</option>	<option value="19">19</option>	<option value="20">20</option>
                               <option value="21">21</option>	<option value="22">22</option>	<option value="23">23</option>
                               <option value="24">24</option>	<option value="25">25</option>	<option value="26">26</option>
	                           <option value="27">27</option>	<option value="28">28</option>	<option value="29">29</option>
                               <option value="30">30</option>	<option value="31">31</option></select>
                                
                             <select class="day" id="treatment_month" name="treatment_month">
                             	<option value="">Month</option>
                                <option value="1">Jan</option>	<option value="2">Feb</option>	<option value="3">Mar</option>
	                            <option value="4">Apr</option>	<option value="5">May</option>	<option value="6">June</option>
                               	<option value="7">July</option>	<option value="8">Aug</option>	<option value="9">Sep</option>
                                <option value="10">Oct</option> <option value="11">Nov</option>	<option value="12">Dec</option>
                              </select>
                                
                              <select class="day" id="treatment_year" name="treatment_year">
                                <option value="">Year</option> <option value="2012">2012</option> <option value="2013">2013</option>
                              </select>
                            </p>
                            <p>
                                <label> Preferred time <span class="required"> * </span> </label>
                                <select class="salutation" id="PreferredTime" name="PreferredTime">
                                    <option>Time</option>
                                    <option>8 AM</option>
                                    <option>9 AM</option>
                                    <option>10 AM</option>
                                    <option>11 AM</option>
                                    <option>12 PM</option>
                                    <option>01 PM</option>
                                    <option>02 PM</option>
                                    <option>03 PM</option>
                                    <option>04 PM</option>
                                    <option>05 PM</option>
                                    <option>06 PM</option>
                                </select>
                            </p>
                            <p>
                                <label> Type of Treatment </label> 
                                <select class="treatment" id="treatment" name="treatment">
                                    <option value="">Please Select a Treatment</option>
                                    <option value="Jivaniya">Jivaniya</option>
                                    <option value="Mewar Khas">Mewar Khas</option>
                                    <option value="Pehlwan Malish">Pehlwan Malish</option>
                                </select>       
                            </p>
                            <p>
                                <label> No. of Persons <span class="required"> * </span> </label>
                                <input name="persons" type="text" />
                            </p>
                            <p>
                                <label> Special Requests </label>
                                <textarea name="requests" cols="20" rows="7"></textarea>
                            </p>
                            <p class="submit">
                                <input name="booknow" type="submit" value="Book Now" />
                            </p>                    
                        
                    </form>
                </div>
                
                <div class="booknow-page-sidebar column one-half last">
	                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('booknow-sidebar') ): endif;?>        
                </div>
            
        </div> <!-- **Content Full Width - End** -->
      	<?php if( empty($is_fullwidth_page) ):?>
         <!-- **Sidebar** -->
    	<div class="sidebar">
        	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('display-everywhere-sidebar') ): endif;?>        
	        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('page-sidebar') ): endif;?>
        </div>
        <?php endif; ?>

        <!-- Page footer code -->
		<?php $footer_section = ( isset($my_theme_settings["codes"]["page-bottom-code"])  && (isset($my_theme_settings["codes"]["enable-page-bottom-code"])) ) 
            ? $my_theme_settings["codes"]["page-bottom-code"] : '';
        echo $footer_section;?>
        <!-- Page footer code end-->

        
<?php get_footer();?>