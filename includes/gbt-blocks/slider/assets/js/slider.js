jQuery(function($) {

	"use strict";

	$('.gbt_18_tr_slider_container').each(function() {

		var mySwiper = new Swiper( '.gbt_18_tr_slider_container', {

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
			    el: '.gbt_18_tr_slider_pagination',
				dynamicBullets: true
			},
		    // Navigation
		    navigation: {
			    nextEl: '.swiper-button-next',
			    prevEl: '.swiper-button-prev',
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
