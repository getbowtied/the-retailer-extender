jQuery(function($) {

	"use strict";

	$('.wc-products-slider').each(function() {

		var slides = 4;
		var medium_slides = 3;
		if( $(this).parents('.wpb_column').hasClass('vc_span6') || $(this).parents('.wpb_column').hasClass('vc_col-sm-6') ) {
			slides = 2;
			medium_slides = 2;
		}

		var data_id = $(this).find('.swiper-container').attr('data-id');

		var myPostsSwiper = new Swiper( '.swiper-' + data_id, {
			slidesPerView: slides,
			loop: false,
			spaceBetween: 40,
			breakpoints: {
				0: {
			      slidesPerView: 2,
			    },
				640: {
			      slidesPerView: medium_slides,
			    },
			    959: {
			      slidesPerView: slides,
			    }
			},
			navigation: {
			    nextEl: '.swiper-' + data_id + ' .slider-button-next',
			    prevEl: '.swiper-' + data_id + ' .slider-button-prev',
			},
			pagination: {
		        el: '.swiper-' + data_id + ' .swiper-pagination',
		        dynamicBullets: true
		    },
		});

		var swiper__slidecount = myPostsSwiper.slides.length;
        if (swiper__slidecount < 4) {
          	$(this).find('.slider-button-prev, .slider-button-next').remove();
          	$(this).find('.swiper-wrapper').addClass( "disabled" );
		  	$(this).find('.slider-pagination').addClass( "disabled" );
        }
	});
});
