<?php

// [custom_on_sale_products]
function shortcode_custom_on_sale_products($atts, $content = null) {
	global $woocommerce;

	wp_enqueue_script('theretailer-wc-products-slider-script');

	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
    <div class="slider-master-wrapper on_sale_products_wrapper wc-products-list swiper-container <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
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
			
			// Get products on sale
			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			
			$meta_query = $woocommerce->query->get_meta_query();
			
			$args = array(
				'posts_per_page' 	=> $per_page,
				'no_found_rows' => 1,
				'post_status' 	=> 'publish',
				'post_type' 	=> 'product',
				'orderby' 		=> $orderby,
				'order' 		=> $order,
				'meta_query' 	=> $meta_query,
				'post__in'		=> $product_ids_on_sale
			);
            
            $products = new WP_Query( $args );
            
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

add_shortcode("custom_on_sale_products", "shortcode_custom_on_sale_products");