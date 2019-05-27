<?php

function tr_products_slider( $type = '', $products = null, $title = '' ) {
?>
	
	<div class="<?php echo $type; ?>-wrapper wc-products-slider">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title">
                	<strong>
                		<?php echo $title ?>
                	</strong>
                </div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
            </div>
        </div>

        <div class="gbtr_bold_sep"></div>

        <div class="swiper-container">
        
            <div class="swiper-wrapper">
    	
                <?php if ( $products->have_posts() ) : ?>
                            
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                		
                		<div class="swiper-slide">
                        	<?php wc_get_template_part( 'content', 'product' ); ?>
                        </div>
            
                    <?php endwhile; ?>
                    
                <?php endif; ?>

    		</div>

        </div>
    
    </div>

<?php
}