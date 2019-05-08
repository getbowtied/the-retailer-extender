<div class="categories_layout_1">

	<div class="woocommerce">
		
		<ul class="shortcode_products visible" <?php echo $paddings1; ?> >

			<?php

			foreach ( $product_categories as $category ) {
				   
				$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
				$image_url = esc_url($image) ? esc_url($image) : WC()->plugin_url() . '/assets/images/placeholder.png';
				
				?>

				<?php if ($gutter): ?>
				<div <?php echo ent2ncr($paddings2); ?>>
				<?php endif; ?>
	
				<li class="category_item">
					
					<a class="cat_link" href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
						<div class="category_thumbnail" style="background: url(<?php echo esc_url($image_url); ?>)"></div>
					</a>
					
					<div class="category_name">
						<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
							<?php echo esc_html($category->name); ?> <span class="count"><?php echo ent2ncr($category->count); ?></span>
						</a>
					</div>

				</li>

				<?php if ($gutter): ?>
				</div>
				<?php endif; ?>

			<?php

			}		

			?>

		</ul>
		
	</div>

</div>