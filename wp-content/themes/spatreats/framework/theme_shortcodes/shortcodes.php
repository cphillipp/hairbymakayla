<?php
#TITLE SHORTCODES
add_shortcode('h1','my_title_tag');
add_shortcode('h2','my_title_tag');
add_shortcode('h3','my_title_tag');
add_shortcode('h4','my_title_tag');
add_shortcode('h5','my_title_tag');
add_shortcode('h6','my_title_tag');
function my_title_tag($atts, $content=null, $shortcodename =""){
	$content = my_shortcode_helper($content);
	$output = "<{$shortcodename} class='title'><span>{$content}</span></{$shortcodename}>";
	return $output;
}

add_shortcode('arctext','my_arctext');
function my_arctext( $attrs ,$content = null, $shortcodename="" ){
	extract(shortcode_atts(array( "rotate"=>'',"radius"=>'',"dir"=>''), $attrs));
	$dir = !empty($dir) ? " data-dir = '{$dir}' " : " data-dir = '1'";
	$radius = !empty($radius) ? " data-radius = '{$radius}'" : "data-radius = '100'";
	$rotate = $rotate ? " data-rotate = 'true' " : " data-rotate = 'false'";
	$content = my_shortcode_helper($content);
	$output = "<span class='arctext' {$dir} {$radius} {$rotate} >{$content}</span>";
return $output;	
}



#COLUMNS SHORTCODE
add_shortcode('one-half', 'my_column_shortcode');
add_shortcode('one-third', 'my_column_shortcode');
add_shortcode('two-third', 'my_column_shortcode');
add_shortcode('one-fourth', 'my_column_shortcode');
add_shortcode('three-fourth', 'my_column_shortcode');
function my_column_shortcode($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( 'id'=>'', 'class'=>''), $attrs));
	$class	= $class <> '' ? $class : '';
	$id  = $id <> '' ? " id = '{$id}'" : '';
	$last = (isset($attrs[0]) &&  trim( $attrs[0] == 'last')) ? 'last' : '';
	$content = my_shortcode_helper($content);
	$output = "<div {$id} class='column {$shortcodename} {$class} {$last}'>{$content}</div>";
return $output;	
}

#BOX CONTENT
add_shortcode('box-content-with-design','my_box_content');
add_shortcode('box-content','my_box_content');
function my_box_content( $attrs ,$content = null, $shortcodename=""){
	extract(shortcode_atts(array( "class"=>''), $attrs));
	$class = $class <> '' ? $class : '';
	$content = my_shortcode_helper($content);
	$output = "<div class='{$shortcodename} {$class}'>{$content}</div>";
return $output;	
}

#CONTENT ALIGN SHORTCODE
add_shortcode('content-right-aligned', 'my_content_align');
add_shortcode('content-left-aligned', 'my_content_align');
add_shortcode('content-center-aligned','my_content_align');
function my_content_align($attrs, $content=null, $shortcodename =""){
	$content = my_shortcode_helper($content);
	$output = "<div class='{$shortcodename}'>{$content}</div>";
return $output;	
}

#For blockquote & Testimonials
add_shortcode('blockquote','my_blockquote');
function my_blockquote($attrs, $content = null, $shortcodename=""){
	extract(shortcode_atts(array( "class"=>'',"author"=>''), $attrs));
	$class = $class <> '' ? "class = '{$class}'" : '';
	$author = $author <> '' ? "<cite> - {$author}</cite>" : '';
	$content = my_shortcode_helper($content);
	$output = "<blockquote {$class}><p>{$content} {$author}</p></blockquote>";
return $output;	
}

#List styles
add_shortcode("green-flower","my_list");
add_shortcode("brown-flower","my_list");
add_shortcode("darkbrown-flower","my_list");
add_shortcode("pink-flower","my_list");
add_shortcode("orange-flower","my_list");
add_shortcode("tick","my_list");
add_shortcode("arrow","my_list");
add_shortcode("arrow2","my_list");
add_shortcode("star","my_list");
function my_list($attrs, $content=null, $shortcodename =""){
	
	extract(shortcode_atts(array( "class"=>''), $attrs));
	$class = $class <> '' ? $class : '';

	$shortcodename = explode("-",$shortcodename);
	$shortcodename = $shortcodename[0];
	$content = my_shortcode_helper($content);
	$content = str_replace('<ul>', "<ul class='flower-bullet {$shortcodename} {$class}'>", $content);
	return $content;
}
#ABOVE ARE GOOD #

#PRICE TABLE
add_shortcode("price-table","my_price_table");
function my_price_table($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( "class"=>''), $attrs));
	$class = $class <> '' ? $class : '';
	$content = my_shortcode_helper($content);
	$content = str_replace('<table>', "<table class='{$shortcodename} {$class}'>", $content);
	return $content;
}
#PRICE TABLE END

#COLOR BOX
add_shortcode('green-border','my_color_box');
add_shortcode('pink-border','my_color_box');
add_shortcode('brown-border','my_color_box');
function my_color_box($atts, $content=null, $shortcodename =""){
	$output = "<div class='{$shortcodename}'>{$content}</div>";
return $output;	
}

#BUTTONS
add_shortcode('button','my_button');
function my_button($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( 'size'=>'','color'=>'','class'=>'','href'=>'','text'=>'','title'=>''), $attrs));
	$size	= $size <> '' ? $size : 'small';
	$color	= $color <> '' ? $color : 'black';
	$text	= $text <> '' ? $text : 'Button';
	$title  = $title <> '' ? " title= '{$title}'" : NULL;
	$class	= $class <> '' ? $class : '';
	$href =  (isset($href) && $href<>'') ? $href :"#";
	$output = "<a href='{$href}' {$title} class='{$shortcodename} {$size} {$color} {$class}'>{$text}</a>";;
return $output;
}

add_shortcode('shape-button','my_button1');
function my_button1($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( 'size'=>'','color'=>'','class'=>'','href'=>'','text'=>'','title'=>''), $attrs));
	$size	= $size <> '' ? $size : 'small';
	$color	= $color <> '' ? $color : 'black';
	$text	= $text <> '' ? $text : 'Button';
	$title  = $title <> '' ? " title= '{$title}'" : NULL;
	$class	= $class <> '' ? $class : '';
	$href =  (isset($href) && $href<>'') ? $href :"#";
	$output = "<a href='{$href}' {$title} class='button shape {$size} {$color} {$class}'>{$text}<span></span></a>";;
return $output;
}

add_shortcode('icon-button','my_button2');
function my_button2($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array('color'=>'','class'=>'','href'=>'','text'=>'','title'=>''), $attrs));
	$color	= $color <> '' ? $color : 'red';
	$text	= $text <> '' ? $text : 'Button';
	$title  = $title <> '' ? " title= '{$title}'" : NULL;
	$class	= $class <> '' ? $class : '';
	$href =  (isset($href) && $href<>'') ? $href :"#";
	
	$output = "<a href='{$href}' {$title} class='big-ico-button {$color} {$class}'><span>{$text}</span></a>";;
return $output;
}



	
#Ancher
add_shortcode('anchor','my_big_icon_button');
add_shortcode('big-ico-button','my_big_icon_button');
function my_big_icon_button($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( 'color'=>'',"class"=>'','href'=>'','text'=>''), $attrs));
	$text  = $text <> '' ? "<span>{$text}</span>" : '<span>Click Me</span>';
	$class = $class <> '' ? $class : '';
	$href  = $href <> '' ? $href : '#';
	$color	= $color <> '' ? $color : 'red';
	$link = "<a href='{$href}' title='' class='{$shortcodename} {$color} {$class}'>{$text}</a>";
return $link;	
}

#CONTACT DETAILS
add_shortcode("contact-details","my_contant_details");
function my_contant_details($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( "class"=>''), $attrs));
	$class = $class <> '' ? $class : '';
	$content = my_shortcode_helper($content);
	$output = "<ul class='{$shortcodename} {$class}'>{$content}</ul>";
return $output;
}

#address
add_shortcode("address","my_address");
function my_address($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( "class"=>'','line1'=>'','line2'=>'','line3'=>'','line4'=>'','line5'=>''), $attrs));
	$class = $class <> '' ? $class : '';
	$line1 = $line1 <> '' ? $line1.'<br/>' : '';
	$line2 = $line2 <> '' ? $line2.'<br/>' : '';
	$line3 = $line3 <> '' ? $line3.'<br/>' : '';
	$line4 = $line4 <> '' ? $line4.'<br/>' : '';
	$line5 = $line5 <> '' ? $line5.'<br/>' : '';
	$line = '<p>'.$line1.$line2.$line3.$line4.$line5.'</p>';
return "<li><span class='address'></span>{$line}</li>";
}
	
add_shortcode("mail","my_mail");
function my_mail($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array( "class"=>'','id1'=>'','id2'=>'','id3'=>'','id4'=>'','id5'=>''), $attrs));
	$class = $class <> '' ? $class : '';
	$id1 = $id1 <> '' ? "<a href='mailto:{$id1}'>".$id1.'</a><br/>' : '';
	$id2 = $id2 <> '' ? "<a href='mailto:{$id2}'>".$id2.'</a><br/>' : '';
	$id3 = $id3 <> '' ? "<a href='mailto:{$id3}'>".$id3.'</a><br/>' : '';
	$id4 = $id4 <> '' ? "<a href='mailto:{$id4}'>".$id4.'</a><br/>' : '';
	$id5 = $id5 <> '' ? "<a href='mailto:{$id5}'>".$id5.'</a><br/>' : '';
	$mail = "<p>{$id1}{$id2}{$id3}{$id4}{$id5}</p>";
return "<li><span class='mail'></span>{$mail}</li>";	
}

add_shortcode("phone","my_phone");
	function my_phone($attrs, $content=null, $shortcodename=""){
		extract(shortcode_atts(array( "class"=>'','no1'=>'','no2'=>'','no3'=>'','no4'=>'','no5'=>''), $attrs));
		$class = $class <> '' ? $class : '';
		$no1 = $no1 <> '' ? $no1.'<br/>' : '';
		$no2 = $no2 <> '' ? $no2.'<br/>' : '';
		$no3 = $no3 <> '' ? $no3.'<br/>' : '';
		$no4 = $no4 <> '' ? $no4.'<br/>' : '';
		$no5 = $no5 <> '' ? $no5.'<br/>' : '';
		$no = "<p>{$no1}{$no2}{$no3}{$no4}{$no5}</p>";
	return "<li><span class='phone'></span>{$no}</li>";	
	}
	
##CONTACT DETAILS END



#Image 
add_shortcode('image','my_image');
function my_image($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array( "src"=>'',"alt"=>'',"title"=>'',"class"=>''), $attrs));
	$class = $class <> '' ? "class = '{$class}'" : '';
	$img = '';
	if( $src <> ''):
		$img = "<img src='{$src}' alt='{$alt}' title='{$title}'/>";
	endif;
	$output = "<span {$class}> {$img}</span>";
	return $output;
}

#linked Image
add_shortcode('linked-image', 'my_linked_image');
function my_linked_image($attrs, $content = null, $shortcodename=""){
	extract(shortcode_atts(array( "src"=>'',"alt"=>'',"title"=>'',"class"=>'','href'=>''), $attrs));
	$class = $class <> '' ? "class = '{$class}'" : '';
	$href  = $href <> '' ? "href='{$href}'" : "href='#'";
	$img = '';
	if( $src <> ''):
		$img = "<img src='{$src}' alt='{$alt}' title='{$title}'/>";
	endif;
	
	$output = "<a {$href} {$class}> {$img} </a>";
return $output;	
}

#ToolTip
add_shortcode("tooltip","my_tooltip");
function my_tooltip($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array("title"=>'',"position"=>'',"href"=>'','class'=>'','text'=>''),$attrs));
	$title 	=  !empty($title) ? $title : "Title";
	$href 	=  !empty($href) ? $href :'#';
	$class 	=  !empty($class) ? $class : '';
	$position	= !empty($position) ? $position : 'top';
	$text 	=  !empty($text) ? $text : '';

	return "<a href='{$href}' class='tooltip-{$position} readmore {$class}' title='{$title}'>{$text}</a>";
}



#TEAM MEMBER SHORTCODE
add_shortcode('member',"my_member");
function my_member($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array("name"=>'',"role"=>''),$attrs));	
	$name = !empty($name) ? "<h1>{$name}</h1>":'';
	$role = !empty($role) ? "<span class='role'> <strong>".__('Designation','spatreats').": </strong>{$role}</span>":'';
	$content = my_shortcode_helper($content);
	$output = "<div class='team'> {$name} {$role} {$content}</div>";
	return $output;
}

/*add_shortcode('member_info',"my_member_info");
function my_member_info($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array("name"=>'',"role"=>''),$attrs));	
	$name = !empty($name) ? "<h1>{$name}</h1>":'';
	$role = !empty($role) ? "<span class='role'> <strong>Designation:</strong>{$role}</span>":'';
	$content = my_shortcode_helper($content);
	$output = "{$name} {$role} {$content}";
	return $output;
}*/

##POPULAR PROCEDURE
add_shortcode('popular_message', "my_popular_message");
function my_popular_message($attrs, $content=null, $shortcodename=""){
	$content = my_shortcode_helper($content);
	$output = "<div class='popular-procedures'>{$content}</div>";
	return $output;
}

add_shortcode('popular_message_info', "my_popular_message_info");
function my_popular_message_info($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array("title"=>'',"link"=>'',"tooltip"=>''),$attrs));
	$title = !empty($title) ? "<h2>{$title}</h2>":'';
	$tooltip = !empty($tooltip) ? $tooltip : 'Read More';
	$link = !empty($link) ? "<a href='{$link}' tooltip='{$tooltip}' class='readmore'></a>":'';
	$content = my_shortcode_helper($content);
	$output = "{$title}<p>{$content}</p>{$link}";
	return $output;
}




add_shortcode('notice','my_notice');
function my_notice( $attrs, $content = null, $shortcodename=""){
	extract(shortcode_atts(array("right"=>'',"left"=>''), $attrs));
	$right = !empty($right) ? "<span class='right'>{$right}</span>" : '';
	$left  = !empty($left)  ? "<span class='left'>{$left}</span>" : '';
	$output = "<div class='{$shortcodename}'>{$left} {$right}</div>";
return $output;	
}



add_shortcode("carousel","carousel");
function carousel($attrs, $content=null, $shortcodename =""){
	extract(shortcode_atts(array( "class"=>''), $attrs));
	$class = $class <> '' ? $class : '';
	$content = my_shortcode_helper($content);
	$content = str_replace('<ul>', "<ul  class='testimonial-carousel {$class}'>", $content);
	return "<div class='testimonial-skin-carousel {$class}'>".$content."</div>";
}


#Accordion
add_shortcode('accordion_item','accordion_item');
function accordion_item($attrs, $content = null){
	extract(shortcode_atts(array("title"=>''), $attrs));
	$content = my_shortcode_helper($content);
	$title = ($title<>'')?my_shortcode_helper($title):'Title Here';
	$output = "<li>
			<a href='#' class='item'>{$title}<span> </span></a>
			<div class='holder'>{$content}</div>
	</li>";
	   return $output;
}
add_shortcode('accordion', 'accordion');
function accordion( $attrs, $content = null) {
	extract(shortcode_atts(array( "class"=>'',"open"=>''), $attrs));
	$class = $class <> '' ? $class : '';
	$open  = $open <> '' ? $open : '1';
	$content = my_shortcode_helper($content);
	$output = "<ul class='accordion {$class}' data-open-index ='{$open}'>{$content}</ul>";
return $output;
}
#Accordion End

#Tab
add_shortcode('tab_nav','tab_nav');
function tab_nav( $attrs, $content = null) {
	extract(shortcode_atts(array("href"=>'',"title"=>''), $attrs));
	$href 	= !empty($href) ? $href : "#";
	$title 	= !empty($title) ? $title : "Tab";
	return "<li><a href='#{$href}'>{$title}</a></li>";
}
add_shortcode("tab_nav_container","tab_nav_container");
function tab_nav_container($attrs, $content = null){
	$content = my_shortcode_helper($content);
	$output = "<ul class='tabnav'>{$content}</ul>";
	return $output;	
}

add_shortcode('tab','tab');
function tab( $attrs, $content = null) {
	extract(shortcode_atts(array(), $attrs));
	$content = my_shortcode_helper($content);
	return "<div class='tabs'>{$content}</div>";
}

add_shortcode('tab_container','tab_container');
function tab_container( $attrs, $content = null) {
	$content = my_shortcode_helper($content);
	return "<div class='tab-container'>{$content}</div>";
}

add_shortcode('tab_item','tab_item');
function tab_item( $attrs, $content = null) {
	extract(shortcode_atts(array("id"=>''), $attrs));
	$content = my_shortcode_helper($content);
	return "<div id='{$id}'>{$content}</div>";
}

#Tab End

#Hellper Shortcodes
add_shortcode("clear","my_clear");
function my_clear($atts, $content=null, $shortcodename=""){
	$output = "<div class='{$shortcodename}'></div>";
	return $output;
}
#For code
add_shortcode('code', 'code');
function code( $atts, $content = null ) {
	 $out = '<code>'.stripslashes(htmlspecialchars($content)).'</code>';
return $out;
}

#hr line
add_shortcode('hr','my_hr_line');
add_shortcode('hr_invisible','my_hr_line');
function my_hr_line($attrs, $content=null, $shortcodename=""){
	extract(shortcode_atts(array( "class"=>''), $attrs));
	$output = "<div class='{$shortcodename} {$class}'></div>";
	return $output;
}
#Clear?>