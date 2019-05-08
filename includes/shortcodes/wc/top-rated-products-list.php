<?php

// [top_rated_products_list]
function getbowtied_mc_shortcode_top_rated_products_list($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'widget_title' => '',
		'per_page'  => '4',
		'columns'  => '4',
		'layout'  => 'listing',
        'orderby' => 'date',
        'order' => 'desc',
        'gutter'	=> '0'
	), $atts));
	ob_start();
	?>

    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
    <div class="woocommerce">
            <?php
			
			$args = array(
				'post_type' 			=> 'product',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'   => 1,
				'orderby' 				=> $orderby,
				'order'					=> $order,
				'posts_per_page' 		=> $per_page,
				'meta_query' 			=> array(
					array(
						'key' 			=> '_visibility',
						'value' 		=> array('catalog', 'visible'),
						'compare' 		=> 'IN'
					)
				)
			);

			if ($gutter)
			{
				$paddings1 = 'style="margin-left:'. ($gutter/2) .'px; margin-right:'. ($gutter/2) .'px"';
				$paddings2 = 'style="margin-left:'. ($gutter/2) .'px; margin-right:'. ($gutter/2) .'px; margin-bottom:'. ($gutter) .'px; display: block; overflow:hidden; position:relative;"';
			}
			else 
			{
				$paddings1 = '';
				$paddings2 = '';
			}
            
            add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );

			$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
	
			remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
            
            if ( $products->have_posts() ) : ?>

            	<ul class="shortcode_products visible products masonry_columns_<?php echo intval($columns); ?>" <?php echo ent2ncr($paddings1); ?> data-columns>
                        
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                	<?php if ($gutter): ?><div <?php echo ent2ncr($paddings2); ?>> <?php endif; ?>
            
                    <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php if ($gutter): ?></div><?php endif; ?>
        
                <?php endwhile; // end of the loop. ?>

                </ul>
                
            <?php
            
            endif;
            
            ?>
    </div>
    
    <?php } ?>
    

	<?php
    wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("top_rated_products_list", "getbowtied_mc_shortcode_top_rated_products_list");

