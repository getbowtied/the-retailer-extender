<?php
	
function getbowtied_mc_shortcode_product_categories( $atts ) {

	wp_enqueue_style(  'merchandiser-product-categories-shortcode-styles' );

	extract( shortcode_atts( array(
		'layout'	 					=> 'default',
		'product_categories_selection'	=> 'auto',
		'ids'							=> '',
		'number'     					=> '12',
		'order'      					=> 'asc',
		'columns'						=> '4',
		'gutter'	 					=> '0',		
		'hide_empty' 					=> '1',
		'parent'     					=> '0'
	), $atts ) );
	ob_start();

	if ( isset( $atts[ 'ids' ] ) ) {
		$ids = explode( ',', $atts[ 'ids' ] );
		$ids = array_map( 'trim', $ids );
	} else {
		$ids = array();
	}

	$hide_empty = ( $hide_empty == true && $hide_empty == 1 ) ? 1 : 0;

	if ($product_categories_selection == "auto") {

		$args = array(
			'orderby'    => 'title',
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'pad_counts' => true,
		);

	} else {

		$args = array(
			'orderby'    => 'include',
			'hide_empty' => $hide_empty,
			'include'    => $ids,
			'pad_counts' => true,
		);

		$parent = 999;

	}

	$product_categories = get_terms( 'product_cat', $args );

	if ( $parent == "0" ) {
		$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
	}

	if ( $hide_empty ) {
		foreach ( $product_categories as $key => $category ) {
			if ( $category->count == 0 ) {
				unset( $product_categories[ $key ] );
			}
		}
	}

	if ( $number && $product_categories_selection == 'auto' ) {
		$product_categories = array_slice( $product_categories, 0, $number );
	}

	if ($gutter) {
		
		$paddings1 = 'style="margin-left:'. ($gutter/2) .'px; margin-right:'. ($gutter/2) .'px"';
		$paddings2 = 'style="margin-left:'. ($gutter/2) .'px; margin-right:'. ($gutter/2) .'px; margin-bottom:'. ($gutter) .'px; display: block; overflow:hidden; position:relative;"';
	
	} else {
		
		$paddings1 = '';
		$paddings2 = '';

	}

	if ( $product_categories ) {

		switch ($layout)
		{        
		    case "default":
		        require('product-categories-layouts/default.php');
		        break;
		    case "layout_1":
		        require('product-categories-layouts/layout_1.php');
		        break;
		    case "layout_2":
		        require('product-categories-layouts/layout_2.php');
		        break;
		    case "layout_3":
		        require('product-categories-layouts/layout_3.php');
		        break;
		    case "layout_4":
		        require('product-categories-layouts/layout_4.php');
		        break;
		    default:
		        require('product-categories-layouts/default.php');
		        break;
		}		

		woocommerce_reset_loop();

	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("product_categories_grid", "getbowtied_mc_shortcode_product_categories");