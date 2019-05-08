<?php

function getbowtied_mc_product_mod($atts, $content = null) {	

	wp_enqueue_style(  'merchandiser-single-product-shortcode-styles' );

	extract(shortcode_atts(array(
		"id" => ''
	), $atts));
    ob_start();
    
	echo '<div class="shortcode_single_product">'.do_shortcode('[product id="'.$id.'"]').'</div>';
	
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("product_mod", "getbowtied_mc_product_mod");