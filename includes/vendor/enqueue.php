<?php

$theme = wp_get_theme();
if ( $theme->template != 'theretailer') {

	add_action( 'wp_enqueue_scripts', 'tr_extender_vendor_scripts', 99 );
	function tr_extender_vendor_scripts() {

		wp_register_style(
			'swiper',
			plugins_url( 'swiper/css/swiper.min.css', __FILE__ ),
			array(),
			'6.4.1'
		);
		wp_register_script(
			'swiper',
			plugins_url( 'swiper/js/swiper.min.js', __FILE__ ),
			array(),
			'6.4.1',
			true
		);
	}
}
