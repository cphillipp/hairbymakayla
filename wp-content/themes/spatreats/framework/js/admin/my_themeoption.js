jQuery(document).ready(function($) {
	
	$('#bpanel,#bpanel div.bpanel-content').tabs({ fx: { opacity: 'toggle', duration:'fast' }, selected: 0 });
	
	//Logo & Favicon upload
	var fileInput = '';
	$('.upload_image_reset').click(function() {
		$(this).prev("input.upload_image_button").prev("p").prev("input").val('');
	});

	$('.upload_image_button').click(function() {
		fileInput = $(this).prev("p").prev('input.uploadfield');
		tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (fileInput) {
			fileurl = $('img',html).attr('src');
			fileInput.val(fileurl);
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
	};
	
	
	//Home page panel
	var $no_sliders_container = $('#j-no-images-container'),
		$pagination_link  = $('div#j-slider-pagination a'),
		$used_sliders_container = $('#j-used-sliders-containers'),
		$available_sliders_container = $('#j-available-sliders');
		
	
	$.fn.my_add_sliders = function( args ){
		return this.each(function(){
			var current_li = $(this),
			clone_li,
			attachment_id;
			
			current_li.bind("click",function(){
				if( current_li.hasClass("my_added")) return;
				
				current_li.addClass("my_added");
				attachment_id = current_li.attr("data-attachment-id");
				clone_li = current_li.clone().removeClass("my_added")
						   .append('<input type="hidden" name="_used_slider_id[]" value="' + attachment_id + '" />');
				$used_sliders_container.append(clone_li);
				if ( $no_sliders_container.is(':visible') ) $no_sliders_container.hide();
			});
		});
	}	

	$.fn.my_slider_pagination = function( args ){
		return this.each(function(){
			var container = $(this),
				links = container.find("a");
				links.bind('click',function(){
					link = $(this),
					link_value = link.text();
					if( link.hasClass("active_page"))  return false;
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data:{action : 'show_slider_page',page: link_value},	
						success: function(data){
							link.addClass('active_page').siblings().removeClass();
							$available_sliders_container.html(data);
							$available_sliders_container.find('li').each( function(){
								var $this = $(this),
								attachment_id = $this.attr('data-attachment-id');
								if ( $used_sliders_container.find('li[data-attachment-id="' + attachment_id + '"]').length ) $this.addClass('my_added');
							});
						}					
					});
					return false;
				});
		});
	}
	
	if($('#j-slider-pagination').length > 0 ) {
		$('#j-slider-pagination').my_slider_pagination();
	}
	
	if($("ul#j-available-sliders li").length > 0){
		//$("ul#j-available-sliders li").my_add_sliders();
		$('body').delegate("ul#j-available-sliders li","click",function(){
			var $this_li = $(this),
				$cloned_li,
				attachment_id;
				if ( $this_li.hasClass('my_added') ) return;
				$this_li.addClass('my_added');
				attachment_id = $this_li.attr('data-attachment-id');
				$clone_li = $this_li.clone().removeClass("my_added").append('<input type="hidden" name="_used_slider_id[]" value="' + attachment_id + '" />');
				$used_sliders_container.append($clone_li);
				if ( $no_sliders_container.is(':visible') ) $no_sliders_container.hide();
		});
	}
	
	
	//Delete button click function
	$('body').delegate('span.my_delete','click', function(){
		var $this = $(this),
		attachment_id = $this.parent('li').attr('data-attachment-id');
		$available_sliders_container.find('li[data-attachment-id="'+attachment_id+'"]').removeClass('my_added');
		$this.parent('li').remove();
		if ( ! $used_sliders_container.find('li').length ) $no_sliders_container.show();
	});

	//Sorting Sliders
	if( $used_sliders_container.find('li').length){
		$no_sliders_container.hide();
	}

	$used_sliders_container.sortable( {
		forcePlaceholderSize: true,
		cancel: '.my_delete, input, textarea, label'
	});
	
	
	//Child theme selection
	if($("ul#j-available-themes li").length > 0){
		$current_theme_container = $("#j-current-theme-container");
		$('body').delegate("ul#j-available-themes li","click",function(){
			var $this_li = $(this),
			$cloned_li,
			attachment_theme = $this_li.attr('data-attachment-theme');
			$("ul#j-available-themes li").removeClass('active');
			$this_li.addClass('active');
			$clone_li = $this_li.clone().append('<input type="hidden" name="_current_theme" value="' + attachment_theme + '" />');
			$current_theme_container.empty();
			$current_theme_container.append($clone_li);
		});
	}
});