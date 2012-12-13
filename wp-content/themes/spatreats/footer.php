<?php global $my_theme_settings; ?>

        <!-- **Newsletter** -->
        <div id="newsletter">
        	<h2> <?php _e('Subscribe to Newsletter','spatreats');?></h2>
            <form action="#" method="get">
            	<p><input name="name" type="text" onblur="this.value=(this.value=='') ? 'Enter Name' : this.value;" 
                	   onfocus="this.value=(this.value=='Enter Name') ? '' : this.value;" value="Enter Name" /></p>
                <p><input name="name" type="text" onblur="this.value=(this.value=='') ? 'Enter Email Address' : this.value;" 
                	   onfocus="this.value=(this.value=='Enter Email Address') ? '' : this.value;" value="Enter Email Address" /></p>
                <p><input name="submit" type="submit" value="Subscribe" /></p>
            </form>
        </div><!-- **Newsletter - End** -->
        

    </div><!-- **Main Container - End** -->
    
    <!-- ** Footer** -->
    <div id="footer">
    	<div class="main-container">
        <?php 	$columns = array("full-width"=>"1","one-half"=>"2","one-third"=>"3","one-fourth"=>"4");	
				$footer_columns = (isset($my_theme_settings['footer']) && isset($my_theme_settings['footer']['footer-columns'])) ? 
								$columns[$my_theme_settings['footer']['footer-columns']]:4; 
				$columns = array_search($footer_columns,$columns);
				for( $i = 1; $i <=$footer_columns; $i++ ):
					$last = ( $i == $footer_columns ) ? 'last' : '';
					echo "<div class='column {$columns} {$last}'>";
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) :
						endif;
					echo "</div>";
				endfor;?>
        </div>
    </div><!-- **Footer - End** -->
    
    <!-- **Footer Bottom** -->
    <div class="footer-bottom"> 
    	<div class="main-container">
        	<?php 	$copyright = '&copy; '.get_bloginfo('name').' '.date('Y').' | Design: Design themes';
					$copyright = ( isset($my_theme_settings['footer']) && isset( $my_theme_settings['footer']['copyright']) ) ?
								 $my_theme_settings['footer']['copyright']  : $copyright; ?>
          <p><?php echo($copyright);?></p>        
        </div>
    </div><!-- **Footer Bottom - End** -->

</div><!-- **Main - End**-->
<?php wp_footer(); ?>
<?php $footer_section_code = ( isset($my_theme_settings["codes"]["footer-code"])  && (isset($my_theme_settings["codes"]["enable-footer-code"])) ) 
	? $my_theme_settings["codes"]["footer-code"] : '';
echo $footer_section_code;?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		if( $('span.arctext').length){
			$('span.arctext').each(function(){
				$(this).arctext({
					radius: parseInt($(this).attr('data-radius')),
					rotate: ($(this).attr('data-rotate') == 'true') ? true : false ,
					dir: parseInt($(this).attr('data-dir'))
				});
			});
		}
	});
</script>
</body>
</html>