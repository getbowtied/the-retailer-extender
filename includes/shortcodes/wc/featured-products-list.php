<?php

// [featured_products_list]
function getbowtied_mc_shortcode_featured_products_list($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title' => '',
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
				'post_status' => 'publish',
				'post_type' => 'product',
				'ignore_sticky_posts'   => 1,
				'meta_key' => '_featured',
				'meta_value' => 'yes',
				'posts_per_page' => $per_page,
				'orderby' => $orderby,
				'order' => $order,
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

add_shortcode("featured_products_list", "getbowtied_mc_shortcode_featured_products_list");

