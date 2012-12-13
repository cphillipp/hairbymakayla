jQuery(document).ready(function($){
	var $ptemplate_select = $('select#page_template'),
		$ptemplate_box = jQuery('#template-pages-metabox');
		
	$ptemplate_select.live('change', function(){
		var $val = $(this).val();
		$ptemplate_box.find('.j-pagetemplate-container > div').css('display','none');
		
		switch($val) {
			case 'tpl-booknow.php':
				$ptemplate_box.find('span:first').text('Booknow Template Settings');
				$ptemplate_box.find('.tpl-booknow').css('display','block');
			break;

			case 'tpl-gallery.php':
				$ptemplate_box.find('span:first').text('Gallery Template Settings');
				$ptemplate_box.find('.tpl-gallery').css('display','block');
			break;
			
			case 'tpl-catalog.php':
				$ptemplate_box.find('span:first').text('Catalog Template Settings');
				$ptemplate_box.find('.tpl-catalog').css('display','block');
			break;
			
			default:
				$ptemplate_box.find('span:first').text('Default Template Settings');
				$ptemplate_box.find('.iamd_pt_info').css('display','block');
			break;

		}
	});	
	
	$ptemplate_select.trigger('change');

});