jQuery(function($) {

	"use strict";

	function tr_generate_slider_unique_ID() {
		return Math.round(new Date().getTime() + (Math.random() * 100));
	}

	$('.gbt_18_tr_slider_container').each(function() {

		var data_id = tr_generate_slider_unique_ID();
		$(this).addClass( 'swiper-' + data_id );

		var mySwiper = new Swiper( '.swiper-' + data_id, {

			// Optional parameters
		    direction: 'horizontal',
		    loop: true,
		    grabCursor: true,
			preventClicks: true,
			preventClicksPropagation: true,
			autoplay: {
			    delay: 10000
		  	},
			speed: 600,
			effect: 'slide',
			parallax: true,
		    // Pagination
		    pagination: {
			    el: '.swiper-' + data_id + ' .gbt_18_tr_slider_pagination',
				dynamicBullets: true
			},
		    // Navigation
		    navigation: {
			    nextEl: '.swiper-' + data_id + ' .swiper-button-next',
			    prevEl: '.swiper-' + data_id + ' .swiper-button-prev',
			},
		});

		if( $(this).hasClass('full_height') ) {

			if( $(this)[0] == $('.content_wrapper').children().first()[0] || $(this)[0] == $('.entry-content').children().first()[0] ) {

				var windowHeight = $(window).height();
				var offsetTop = $(this).offset().top;
				var fullHeight = 100-offsetTop/(windowHeight/100);

				if( windowHeight && fullHeight ) {
					$(this).css('max-height', fullHeight+"vh");
					$(this).css('min-height', fullHeight+"vh");
				}
			}
		}

	});
});
