<?php

// [products_mixed]
function getbowtied_mc_shortcode_products_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"widget_title" => '',
		'columns'  => '4',
		'layout'  => 'listing',
        'orderby' => 'date',
        'order' => 'desc',
		'ids' => '',
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
		echo do_shortcode('[products_list gutter="'.$gutter.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'" ids="'.$ids.'"]');
	} else {
		echo '<div class="shortcode_gutter" data-gutter="'.$gutter.'">';
		echo do_shortcode('[products columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'" ids="'.$ids.'"]');
		echo '</div>';
	}

	if ($show_product_details == 'true')
	{
		// 
	} elseif ($show_product_details == 'false')
	{
		echo '</div>';
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("products_mixed", "getbowtied_mc_shortcode_products_mixed");