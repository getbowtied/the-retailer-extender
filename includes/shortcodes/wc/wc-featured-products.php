<?php

// [custom_featured_products]
function shortcode_custom_featured_products($atts, $content = null) {

	wp_enqueue_style('theretailer-wc-featured-products-shortcode-styles');
	wp_enqueue_script('theretailer-wc-products-slider-script');

	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title'		=> '',
		'per_page'  => '12',
        'orderby' 	=> 'date',
        'order' 	=> 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>  
	
    <div class="slider-master-wrapper featured-products-wrapper wc-products-list swiper-container <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
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

add_shortcode("custom_featured_products", "shortcode_custom_featured_products");