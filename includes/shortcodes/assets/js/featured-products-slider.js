jQuery( function($) {

	$(".featured_products_slider .products_slider_item").on({
		mouseenter: function(){
			var that = $(this);

			that.find('.products_slider_infos').stop().fadeTo(100, 0);
			that.find('.products_slider_images img').stop().fadeTo(100, 0.1, function() {
				that.find('.products_slider_infos').stop().fadeTo(200, 1);
			});
		},
		mouseleave: function(){
			$(this).find('.products_slider_images img').stop().fadeTo(100, 1);
			$(this).find('.products_slider_infos').stop().fadeTo(100, 0);
		}
	});

	$('.featured_products_slider.swiper-container').each(function() {

		var data_id = $(this).attr('data-id');

		var myPostsSwiper = new Swiper('.swiper-' + data_id, {
			slidesPerView: 4,
			loop: false,
			breakpoints: {
				0: {
				  slidesPerView: 1,
				},
				640: {
				  slidesPerView: 2,
				},
				959: {
				  slidesPerView: 4,
				}
			},
			navigation: {
			    nextEl: '.swiper-' + data_id + ' .slider-button-next',
			    prevEl: '.swiper-' + data_id + ' .slider-button-prev',
			},
		});
	});
});
