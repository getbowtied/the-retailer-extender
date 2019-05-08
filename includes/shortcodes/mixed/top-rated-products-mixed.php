<?php

// [top_rated_products_mixed]
function getbowtied_mc_shortcode_top_rated_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'widget_title' => '',
		'per_page'  => '4',
		'columns'  => '4',
        'orderby' => 'date',
        'order' => 'desc',
		'layout'  => 'listing',
		'show_product_details' => 'false',
		'gutter' => '0'
	), $atts));
	ob_start();

	if ($widget_title != '') {
		echo '<h3 class="shortcode_title">' . $widget_title . '</h3>';
	}

	if ($show_product_details == 'true')
	{
		// 
	} elseif ($show_product_details == 'false')
	{
		echo '<div class="hide_product_details">';
	}

    if ($layout == "masonry") {
		echo do_shortcode('[top_rated_products_list gutter="'.$gutter.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo '<div class="shortcode_gutter" data-gutter="'.$gutter.'">';
		echo do_shortcode('[top_rated_products per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
		echo '</div>';
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("top_rated_products_mixed", "getbowtied_mc_shortcode_top_rated_products_mixed");