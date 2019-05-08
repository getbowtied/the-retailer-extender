<?php

// [product_category_mixed]
function getbowtied_mc_shortcode_product_category_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		'widget_title' => '',
		'category' => '',
		'per_page'  => '4',
		'columns'  => '4',
		'layout'  => 'listing',
        'orderby' => 'date',
        'order' => 'desc',
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
		echo do_shortcode('[product_category_list gutter="'.$gutter.'" category="'.$category.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
	} else {
		echo '<div class="shortcode_gutter" data-gutter="'.$gutter.'">';
		echo do_shortcode('[product_category category="'.$category.'" per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]');
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

add_shortcode("product_category_mixed", "getbowtied_mc_shortcode_product_category_mixed");