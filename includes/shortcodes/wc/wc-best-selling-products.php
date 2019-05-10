<?php

// [custom_best_sellers]
function shortcode_custom_best_sellers($atts, $content = null) {

	wp_enqueue_script('theretailer-wc-products-slider-script'); 

	$sliderrandomid = rand();
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
    
    <div class="slider-master-wrapper best-sellers-wrapper wc-products-list swiper-container <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
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
					'post_type' 			=> 'product',
					'post_status' 			=> 'publish',
					'ignore_sticky_posts'   => 1,
					'posts_per_page'		=> $per_page,
					'meta_key' 		 		=> 'total_sales',
					'orderby' 		 		=> 'meta_value_num',
					'meta_query' 			=> array(
						array(
							'key' 		=> '_visibility',
							'value' 	=> array( 'catalog', 'visible' ),
							'compare' 	=> 'IN'
						)
					)
				);
                
                $products = new WP_Query( $args );
                
                if ( $products->have_posts() ) : ?>
                            
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                		
                		<div class="slider swiper-slide">
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

add_shortcode("custom_best_sellers", "shortcode_custom_best_sellers");