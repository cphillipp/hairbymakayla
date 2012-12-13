<?php
add_shortcode('enquiry_form','my_enquiry_form');
function my_enquiry_form($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array( "to"=>'','title'=>''), $attrs));
		$to  = !empty($to) ? $to : get_option('admin_email');
		$title = !empty($title) ? "<h2>{$title}</h2>" : NULL ;
	$output  =	'<div class="enquiry-form">';
	$output .=	"{$title}";
	$output .=  '<form class="frmcontact" action="'.IAMD_FW_URL.'forms/enquiry.php" method="post">';
	$output .=  '<div id="ajax_message"></div>';	
	$output .=  "	<p><input type='hidden' id='admin_emailid'  readonly='readonly' name='admin_emailid'  value='{$to}' /></p>";
	$output .=  '	<p><input id="name" name="name" type="text" class="placeholder" value="'.__('Name','spatreats').'" title="'.__('Name','spatreats').'" /></p>';
	$output .=  '	<p><input id="email" name="email" type="text" class="placeholder" value="'.__('Email','spatreats').'"  title="'.__('Email','spatreats').'" /></p>'; 
	$output .=	'	<p><textarea id="message" name="message" class="placeholder" title="'.__('Message','spatreats').'" rows="20" cols="7">'.__('Message','spatreats').'</textarea> </p>';
	$output .=	'	<p><input name="submit" id="send" type="submit" value="Message" /></p>';  
	$output .=  '</form>';
	$output .=	'</div>';
	return $output;
}?>