<?php

// [products_slider]
function tr_ext_shortcode_products_slider($atts, $content=null, $code) {

	wp_enqueue_style('getbowtied_swiper_styles');
    wp_enqueue_script('getbowtied_swiper_scripts');

	wp_enqueue_style('theretailer-featured-products-slider-shortcode-styles');
	wp_enqueue_script('theretailer-featured-products-slider-script'); 

	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?> 
    
    <div class="featured_products_slider swiper-container">  
    
		<div class="swiper-wrapper">
                    
                <?php

				$atts = shortcode_atts( array(
					'per_page' => '12',
					'columns'  => '4',
					'orderby'  => 'date',
					'order'    => 'desc',
					'category' => '',  // Slugs
					'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
				), $atts, 'featured_products' );

				$meta_query  = WC()->query->get_meta_query();
				$tax_query   = WC()->query->get_tax_query();
				$tax_query[] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				);

				$query_args = array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $per_page,
					'orderby'             => $orderby,
					'order'               => $order,
					'meta_query'          => $meta_query,
					'tax_query'           => $tax_query,
				);

				$products = new WP_Query( $query_args );
					
				if ( $products->have_posts() ) : ?>
							
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<div class="swiper-slide">
                
                        	<?php wc_get_template_part( 'content', 'product-slider' ); ?>

                        </div>
            
                    <?php endwhile; // end of the loop. ?>
					
				<?php
				
				endif; ?>
                    
        </div>
		 
		<div class='swiper-button-prev'></div>
        <div class='swiper-button-next'></div>
    
	</div>

	<?php
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("products_slider", "tr_ext_shortcode_products_slider");