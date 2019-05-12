jQuery(function($) {
	
	"use strict";

	$('.wc-products-slider.swiper-container').each(function() {

		var myPostsSwiper = new Swiper($(this), {
			slidesPerView: 4,
			loop: true,
			breakpoints: {
				640: {
			      slidesPerView: 2,
			    },
			    959: {
			      slidesPerView: 3,
			    }
			},
			navigation: {
			    nextEl: '.big_arrow_right',
			    prevEl: '.big_arrow_left',
			},
		});
	});

});