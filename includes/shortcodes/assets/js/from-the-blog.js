jQuery(function($) {

	"use strict";

	$('.from-the-blog-wrapper.swiper-container').each(function() {

		var data_id = $(this).attr('data-id');

		var myPostsSwiper = new Swiper( '.swiper-' + data_id, {
			slidesPerView: 2,
			loop: true,
			spaceBetween: 50,
			breakpoints: {
				0: {
					slidesPerView: 1,
					spaceBetween: 0,
			    },
				640: {
					slidesPerView: 2,
  					spaceBetween: 30,
			    },
			},
			navigation: {
			    nextEl: '.swiper-' + data_id + ' .big_arrow_left',
			    prevEl: '.swiper-' + data_id + ' .big_arrow_right',
			},
		});
	});

});
