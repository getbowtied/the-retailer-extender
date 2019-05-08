jQuery(function($) {
	
	"use strict";

	$('.shortcode_getbowtied_slider').each(function(){

		var mySwiper = new Swiper ($(this), {
			// Optional parameters
		    direction: 'horizontal',
		    loop: true,
		    grabCursor: true,
			preventClicks: true,
			preventClicksPropagation: true,
			parallax: true,
			autoplay: {
			    delay: 10000
			},
			speed: 600,
			effect: 'slide',
		    // If we need pagination
		    pagination: { 
		    	el: $(this).find('.quickview-pagination'),
		    	clickable: true 
		    },
		    // Navigation
		    navigation: {
			    nextEl: $(this).find('.swiper-button-next'),
			    prevEl: $(this).find('.swiper-button-prev'),
		  	},
		})

	})
});
