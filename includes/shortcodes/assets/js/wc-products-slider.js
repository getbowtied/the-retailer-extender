jQuery(function($) {
	
	"use strict";

	$('.wc-products-slider.swiper-container').each(function() {

		var slides = 4;
		var medium_slides = 3;
		if( $(this).parents('.wpb_column').hasClass('vc_span6') || $(this).parents('.wpb_column').hasClass('vc_col-sm-6') ) {
			slides = 2;
			medium_slides = 2;
		}

		var myPostsSwiper = new Swiper($(this), {
			slidesPerView: slides,
			loop: true,
			breakpoints: {
				640: {
			      slidesPerView: 2,
			    },
			    959: {
			      slidesPerView: medium_slides,
			    }
			},
			navigation: {
			    nextEl: '.big_arrow_right',
			    prevEl: '.big_arrow_left',
			},
		});
	});

});