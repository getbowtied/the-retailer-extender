<?php

// [custom_product_attribute]
function shortcode_custom_product_attribute($atts, $content = null) {

	wp_enqueue_script('theretailer-wc-products-slider-script'); 

	extract(shortcode_atts(array(
		'title'  => '',
		'per_page'  => '12',
		'orderby'   => 'title',
		'order'     => 'asc',
		'attribute' => '',
		'filter'    => ''
	), $atts));
	
	$attribute 	= strstr( $attribute, 'pa_' ) ? sanitize_title( $attribute ) : 'pa_' . sanitize_title( $attribute );

	$args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => $per_page,
		'orderby'             => $orderby,
		'order'               => $order,
		'meta_query'          => array(
			array(
				'key'               => '_visibility',
				'value'             => array('catalog', 'visible'),
				'compare'           => 'IN'
			)
		),
		'tax_query' 			=> array(
			array(
				'taxonomy' 	=> $attribute,
				'terms'     => array_map( 'sanitize_title', explode( ",", $filter ) ),
				'field' 	=> 'slug'
			)
		)
	);	
	
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
    <div class="slider-master-wrapper custom-products-wrapper wc-products-list swiper-container <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>
    
        <div class="slider-wrapper swiper-wrapper">

            <?php
    
            $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
            
            if ( $products->have_posts() ) : ?>
                        
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            
                   <div class="swiper-slide slider">
                   		<?php wc_get_template_part( 'content', 'product' ); ?>
                   </div>
        
                <?php endwhile; // end of the loop. ?>
                
            <?php
            
            endif; 
            
            ?>

		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("custom_product_attribute", "shortcode_custom_product_attribute");