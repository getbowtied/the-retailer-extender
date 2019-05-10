jQuery(function($) {
	
	"use strict";

	$('.wc-products-list.swiper-container').each(function() {

		var myPostsSwiper = new Swiper($(this), {
			slidesPerView: 4,
			loop: true,
			navigation: {
			    nextEl: '.big_arrow_right',
			    prevEl: '.big_arrow_left',
			},
		});
	});

});