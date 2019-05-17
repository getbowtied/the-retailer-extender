jQuery(function($) {
	
	"use strict";

	$('.wc-products-slider').each(function() {

		var slides = 4;
		var medium_slides = 3;
		if( $(this).parents('.wpb_column').hasClass('vc_span6') || $(this).parents('.wpb_column').hasClass('vc_col-sm-6') ) {
			slides = 2;
			medium_slides = 2;
		}

		var myPostsSwiper = new Swiper($(this).find('.swiper-container'), {
			slidesPerView: slides,
			loop: false,
			spaceBetween: 40,
			breakpoints: {
				640: {
			      slidesPerView: 2,
			    },
			    959: {
			      slidesPerView: medium_slides,
			    }
			},
			navigation: {
			    nextEl: $(this).find('.big_arrow_right'),
			    prevEl: $(this).find('.big_arrow_left'),
			},
		});
	});

});