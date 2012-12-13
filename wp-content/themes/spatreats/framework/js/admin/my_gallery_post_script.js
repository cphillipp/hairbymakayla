jQuery(document).ready(function($) {

	var $no_images_container = $('#j-no-images-container'),
		$pagination_link  = $('div#j-gallery-pagination a'),
		$used_images_container = $('#j-used-images-containers'),
		$available_images_container = $('#j-available-images');
	

	$.fn.my_gallery_pagination =  function( args ){
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
						data:{action : 'show_gallery_page',page: link_value},	
						success: function(data){
							link.addClass('active_page').siblings().removeClass();
							$available_images_container.html(data);
							$available_images_container.find('li').each( function(){
								var $this = $(this),
								attachment_id = $this.attr('data-attachment-id');
								if ( $used_images_container.find('li[data-attachment-id="' + attachment_id + '"]').length ) $this.addClass('my_added');
							});
						}					
					});
					return false;
				});
		});		
	} //my_gallery_pagination()
	

	if($("ul#j-available-images li").length > 0){
		$('body').delegate("ul#j-available-images li","click",function(){
			var $this_li = $(this),
				$cloned_li,
				attachment_id;
				if ( $this_li.hasClass('my_added') ) return;
				$this_li.addClass('my_added');
				attachment_id = $this_li.attr('data-attachment-id');
				$clone_li = $this_li.clone().removeClass("my_added").append('<input type="hidden" name="_used_image_id[]" value="' + attachment_id + '" />');
				$used_images_container.append($clone_li);
				if ( $no_images_container.is(':visible') ) $no_images_container.hide();
		});
	}

	//Delete button click function
	$('body').delegate('span.my_delete','click', function(){
		var $this = $(this),
		attachment_id = $this.parent('li').attr('data-attachment-id');
		$available_images_container.find('li[data-attachment-id="'+attachment_id+'"]').removeClass('my_added');
		$this.parent('li').remove();
		if ( ! $used_images_container.find('li').length ) $no_images_container.show();
	});


	
	if($('#j-gallery-pagination').length > 0 ) {
		$('#j-gallery-pagination').my_gallery_pagination();
	}
	

	//Sorting Sliders
	if( $used_images_container.find('li').length){
		$no_images_container.hide();
	}

	$used_images_container.sortable( {
		forcePlaceholderSize: true,
		cancel: '.my_delete, input, textarea, label'
	});


});