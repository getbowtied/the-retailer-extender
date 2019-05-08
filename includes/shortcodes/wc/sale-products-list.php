<?php

// [sale_products_list]
function getbowtied_mc_shortcode_sale_products_list($atts, $content = null) {
	global $woocommerce;
	extract(shortcode_atts(array(
		'widget_title' => '',
		'per_page'  => '12',
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
			
			// Get products on sale
			$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			
			$meta_query = $woocommerce->query->get_meta_query();
			
			$args = array(
				'posts_per_page'	=> $per_page,
				'no_found_rows' 	=> 1,
				'post_status' 		=> 'publish',
				'post_type' 		=> 'product',
				'orderby' 			=> $orderby,
				'order' 			=> $order,
				'meta_query' 		=> $meta_query,
				'post__in'			=> $product_ids_on_sale
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
            
            $products = new WP_Query( $args );
            
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

add_shortcode("sale_products_list", "getbowtied_mc_shortcode_sale_products_list");

