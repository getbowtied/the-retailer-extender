jQuery(function($) {
	
	"use strict";

	if ($('.shortcode_gutter').length > 0)
	{
		$('.shortcode_gutter').each(function(idx, obj){
			var gutter = $(this).attr('data-gutter');
			$(this).find('ul.products-grid').css({"padding-left": gutter/2, "padding-right": gutter/2});
			$(this).find('li.product').css({"padding-left": gutter/2, "padding-right": gutter/2, "padding-bottom": parseInt(gutter)});
		})
	}
});
