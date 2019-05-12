jQuery(function($) {
	
	"use strict";

	$('.from-the-blog-wrapper.swiper-container').each(function() {

		var myPostsSwiper = new Swiper($(this), {
			slidesPerView: 2,
			loop: true,
			breakpoints: {
				640: {
			      slidesPerView: 1,
			    }
			},
			navigation: {
			    nextEl: '.big_arrow_right',
			    prevEl: '.big_arrow_left',
			},
		});
	});

});