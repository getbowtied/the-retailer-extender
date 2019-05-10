jQuery(document).ready(function($) {	
			
		$(".style_1 .products_slider_item").mouseenter(function(){
			
			var that = $(this);
			
			that.find('.products_slider_infos').stop().fadeTo(100, 0);
			that.find('.products_slider_images img').stop().fadeTo(100, 0.1, function() { 
				that.find('.products_slider_infos').stop().fadeTo(200, 1);
			});

		}).mouseleave(function(){
			$(this).find('.products_slider_images img').stop().fadeTo(100, 1);
			$(this).find('.products_slider_infos').stop().fadeTo(100, 0);
		});


	$('.products_slider.swiper-container').each(function() {

		var myPostsSwiper = new Swiper($(this), {
			slidesPerView: 4,
			loop: false,
			navigation: {
			    nextEl: '.products_slider_next',
			    prevEl: '.products_slider_previous',
			},
		});
	});

});	