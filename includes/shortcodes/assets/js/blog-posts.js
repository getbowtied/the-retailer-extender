jQuery(function($) {
	
	"use strict";

	if ($('.shortcode_getbowtied_blog_posts').length > 0) {

		$('.shortcode_getbowtied_blog_posts').each(function(){

			window.blog_posts = new Swiper ($(this), {
				// Optional parameters
			    direction: 'horizontal',
			    loop: true,
			    grabCursor: true,
				preventClicks: true,
				preventClicksPropagation: true,
				parallax: true,
				autoplay: {
				    delay: 10000,
			  	},
				speed: 600,
				effect: 'slide',
				slidesPerView: 2,
				breakpoints: {
					640: {
				      slidesPerView: 1,
				    }
				},
			    // If we need pagination
			    pagination: { 
			    	el: '.quickview-pagination',
			    	clickable: true 
			    },
			    // Navigation
			    navigation: {
				    nextEl: '.swiper-button-next',
				    prevEl: '.swiper-button-prev',
			  	},
			});
		});
	}
});