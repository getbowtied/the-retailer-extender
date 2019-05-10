<?php

// [products_by_category]
function shortcode_products_by_category($atts, $content = null) {

	wp_enqueue_script('theretailer-wc-products-slider-script'); 

	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc',
		'category' => ''
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
    <div class="slider-master-wrapper products-by-category-wrapper wc-products-list swiper-container <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
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
    
            $args = array(
                'post_type'		=> 'product',
		        'orderby' 		=> $orderby,
		        'order' 		=> $order,
				'post_status' 	=> 'publish',
				'tax_query' 	=> array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'slug',
						'terms' => $category
					)
				),
				'ignore_sticky_posts'   => 1,
				'posts_per_page' => $per_page
            );
            
            $products = new WP_Query($args);
            
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

add_shortcode("products_by_category", "shortcode_products_by_category");