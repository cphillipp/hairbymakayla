jQuery(document).ready(function($){
	
	$.fn.my_iso_tope_sort = function(options){
		return this.each(function(){
			var container		= $(this),
			parentContainer		= container.parents('.gallery-wrapper'),
			filter				= parentContainer.prev('#sorting-container').find('#js_sort_items').css({visibility:"visible", opacity:1}),
			links				= filter.find('a'),
			isoActive			= false,
			items				= $('.post-entry', container);
			
			function applyIso(){
				container.css({overflow:'hidden'}).isotope({itemSelector : '.post-entry'});
			};
			
			
			links.bind('click',function(){
				var current		= $(this),
		  		selector		= current.data('filter');
				links.removeClass('active_sort');
				current.addClass('active_sort');
				parentContainer.find('.open_container .ajax_controlls .ajax_close').trigger('click');
				container.css({overflow:'hidden'}).isotope({  itemSelector : '.post-entry' , filter: '.'+selector,
				 animationOptions: { duration: 750, easing: 'linear',  queue: false }},	 function()	{ container.css({overflow:'visible'}); });
				return false;
			});
			
			// update columnWidth on window resize
			$(window).smartresize(function(){
			  	applyIso();
			});

		});
	}

	$.fn.my_ajax_gallery = function(args){
		var win  = $(window),
		defaults = {
			open_wrap	: '.gallery-details',
			open_in		: '.gallery-details-inner',
			items		: '.gallery-container',
			easing		: 'easeOutQuint',
			timing		: 800,
			transition	: 'slide' // 'fade' or 'slide'

		} //defaults end
		
		options = $.extend({}, defaults, args);
		return this.each(function(){
			var container			= $(this),
				target_wrap			= container.find(options.open_wrap),
				target_container	= container.find(options.open_in),
				item_container		= container.find(options.items),
				items				= item_container.find('.post-entry'),
				content_retrieved	= {},
				is_open				= false,
				animating			= false,
				index_open			= false,
				ajax_call			= false,
				methods,
				controls,
				methods 			= {
							load_item: function(){
								var link		= $(this),
								post_container 	= link.parents('.post-entry'),
								post_id			= "ID_" + post_container.data('ajax-id'),
								clickedIndex	= items.index(post_container)

									item_container.find('.active-gallery-item').removeClass('active-gallery-item');
									post_container.addClass('active-gallery-item');
									
									//check if current item is the clicked item or if we are currently animating
									if(post_id === is_open || animating) {
										return false;
									}
									
									methods.ajax_get_contents(post_id, clickedIndex); //get the content by calling ajax
									
							return false;	
							} //load_item()
							
							,ajax_get_contents: function(post_id, clickedIndex){

								if(content_retrieved[post_id] !== undefined) {
									methods.show_item(post_id, clickedIndex);
									return;
								}
								
								//Ajax call
								$.ajax({
									url		:  global_settings.ajaxurl
									,type	: "POST"
									,data	: "action=load_gallery_item&pid="+post_id.replace(/ID_/,"")
									,success:function(msg){
										content_retrieved[post_id] = msg;
										methods.attach_item(post_id);
										setTimeout(function(){ methods.show_item(post_id, clickedIndex); },10);
									}
									,error: function(){
											console.log("error");
									}
									
								});
							}//ajax_get_contents()
							
							,attach_item: function(post_id) {
								content_retrieved[post_id] = $(content_retrieved[post_id]).appendTo(target_container);
								ajax_call = true;
							} //attach_item()
							
							,show_item : function(post_id, clickedIndex){
								

									if(post_id === is_open || animating) {
										return false;
									}				
									animating = true;
									methods.scroll_top();

									if(false === is_open){
										target_wrap.addClass('open_container');
										content_retrieved[post_id].addClass('open_slide');
										content_retrieved[post_id].find("div.slideshow_container").find("ul").addClass("slideshow");										
										target_wrap.css({display:'none'}).slideDown(options.timing, function() {									
											index_open	= clickedIndex;
											is_open		= post_id;
											animating	= false
										});
									}else{
										var initCSS = { zIndex:3 },
										easing	= options.easing;
										if(index_open > clickedIndex) { initCSS.left = '-110%'; }	
										if(options.transition === 'fade'){ initCSS.left = '0%'; initCSS.opacity = 0; easing = 'easeOutQuad'; }
										
										//fixate height for container during animation
										target_container.height(target_container.height()); //outerHeight = border problems?
										
										content_retrieved[post_id].css(initCSS).animate({'left':"0%", opacity:1}, options.timing);
										content_retrieved[is_open].animate({opacity:0}, options.timing,function() {
											content_retrieved[is_open].attr({'style':""}).removeClass('open_slide');
											content_retrieved[post_id].addClass('open_slide');
											  target_container.animate({height: content_retrieved[post_id].outerHeight()}, options.timing/2, function(){
												  target_container.attr({'style':""});
												  is_open		= post_id;
												  index_open	= clickedIndex;
												  animating	= false
											  });
										});
									}
									
								//Calling cycle plugin	
								$x = content_retrieved[post_id].find("div.slideshow_container").find("ul.slideshow").attr("data-transition");
								$("ul.slideshow").my_cycle_slideshow({effect:$x});
								
							}//show_item()
							
							,scroll_top: function() {
								var target_offset = container.offset().top - 100,
								window_offset = win.scrollTop();
									if(window_offset > target_offset || target_offset - window_offset > 100  ) 	{
										$('html:not(:animated),body:not(:animated)').animate({ scrollTop: target_offset }, options.timing);
									}
							} //scroll_top()
							
							,add_controls: function(){
									var c = '<div class="ajax_controlls">'
												+'<a href="#prev" class="ajax_previous"></a>'
												+'<a href="#next" class="ajax_next"></a>'
												+'<a href="#close" class="ajax_close"></a>'
											+'</div>';
									controls = $(c).appendTo(target_wrap);
							} //add_controls()
							
							,control_click: function(){
								var showItem,
									activeID = item_container.find('.active-gallery-item').data('ajax-id'),
									active   = item_container.find('.post-entry-'+activeID);
									switch(this.hash) {
										case "#next":
											showItem = active.nextAll('.post-entry:not(.isotope-hidden):eq(0)').find('a:eq(0)');
											if(!showItem.length) { showItem = $('.post-entry:not(.isotope-hidden):eq(0)', container).find('a:eq(0)'); }
											showItem.trigger('click');
										break;
										
										case "#prev":
											showItem = active.prevAll('.post-entry:not(.isotope-hidden):eq(0)').find('a:eq(0)');
											if(!showItem.length) { showItem = $('.post-entry:not(.isotope-hidden):last', container).find('a:eq(0)'); }
											showItem.trigger('click');
										break;
										
										case "#close":
											animating = true;
											target_wrap.slideUp( options.timing,function()	{ 
												item_container.find('.active-gallery-item').removeClass('active-gallery-item');
												content_retrieved[is_open].attr({'style':""}).removeClass('open_slide');
												target_wrap.removeClass('open_container');
												animating = is_open = index_open = false;
											});
										break;
									}
								return false;		 
							} //control_click
							
				} //methods end
			
			methods.add_controls();	
			item_container.on("click","a",methods.load_item);
			controls.on("click", "a", methods.control_click);
		}); // each end
	}//my_ajax_gallery end

	/*$.fn.my_cycle_slideshow = function(args){
		my_defaults = { effect:'fade' }
		my_settings = $.extend({}, my_defaults, args);
		
		return this.each(function(){
			var container = $(this),
			items     = $("li",container);
			if(items.length > 1) {
				container.cycle({
					fx		:   my_settings.effect
					,next	:   '.next2'
					,prev	:   '.prev2' 
				});
			}
		});
	}*/	

	if($('.ajax-gallery-container').length > 0){
		$('.ajax-gallery-container').my_ajax_gallery();
	}
	
	if($('.gallery-sort-container').length > 0 ) {
		$('.gallery-sort-container').my_iso_tope_sort();
		$('.gallery-sort-container').isotope({ filter: '*', animationOptions: { duration: 750, easing: 'linear', queue: false  }});
	}
});