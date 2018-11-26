<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once 'functions/function-setup.php';
include_once 'functions/function-helpers.php';

//==============================================================================
//  Frontend Output
//==============================================================================
function getbowtied_tr_render_frontend_portfolio( $attributes ) {

	global $theretailer_theme_options;
	
	$sliderrandomid = rand();
	$u = uniqid();
	
	extract(shortcode_atts(array(
        'number'                    => '12',
        'categoriesSavedIDs'        => '',
        'showFilters'               => false,
        'columns'                   => '3',
        'align'                     => 'center',
        'orderby'                   => 'title_asc',
    ), $attributes));
	ob_start();

	if($category == 'All') $category = '';
	?>

	<div class="wp-block-gbt-portfolio <?php echo $align; ?>">

	    <?php if( $category == '' && $showFilters ) :
		    $terms = get_terms("portfolio_filter");
		    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
		        echo '<ul class="portfolio_categories">';
		            echo '<li class="filter controls-'.$u.'" data-filter="all">' . __("All", "theretailer") . '</li>';
		        foreach ( $terms as $term ) {
		            echo '<li class="filter controls-'.$u.'" data-filter=".' . strtolower($term->slug) . '">' . $term->name . '</li>';
		        }
		        echo '</ul>';
		    }
		endif;
	    
	    ?>

	    <div class="portfolio_section shortcode_portfolio mixitup-<?php echo $u;?>">		
	            
	        <div class="items_wrapper">
	        
	        <?php
	        $number_of_portfolio_items = new WP_Query(array(
	        	'post_status' 			=> 'publish',
	            'post_type' 			=> 'portfolio',
	            'posts_per_page'		=> $itemsNumber,
	            'portfolio_filter' 		=> $category,
	            'orderby' 				=> $orderBy,
	            'order' 				=> $order
	        ));
	        
	        $portfolio_items = $number_of_portfolio_items->post_count;

	        $post_counter = 0;
	        
	        $wp_query_portfolio_shortcode = new WP_Query(array(
	            'post_type' => 'portfolio',
	            'posts_per_page' => $itemsNumber,
	            'portfolio_filter' => $category,
	            'orderby' => $orderBy,
	            'order' => $order
	        ));
	                        
	        while ($wp_query_portfolio_shortcode->have_posts()) : $wp_query_portfolio_shortcode->the_post();
	            $post_counter++;
	            $related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	            
	            $terms_slug = get_the_terms( get_the_ID(), 'portfolio_filter' ); // get an array of all the terms as objects.

	            $term_slug_class = "";
	            
	            if ( !empty( $terms_slug ) && !is_wp_error( $terms_slug ) ){
	                foreach ( $terms_slug as $term_slug ) {
	                    $term_slug_class .=  $term_slug->slug . " ";
	                }
	            }
	            
	        ?>

	            <div class="portfolio_<?php echo $itemsPerRow; ?>_col_item_wrapper mix <?php echo $term_slug_class; ?>">
	                <div class="portfolio_item">
	                    <div class="portfolio_item_img_container">
	                        <a class="img_zoom_in" href="<?php echo get_permalink(get_the_ID()); ?>">
	                            <img src="<?php echo $related_thumb[0]; ?>" alt="" />
	                        </a>
	                    </div>
	                    <a  class="portfolio-title" href="<?php echo get_permalink(get_the_ID()); ?>"><h3><?php the_title(); ?></h3></a>
	                    <div class="portfolio_sep"></div>
	                    <div class="portfolio_item_cat">

	                    <?php 
	                    echo strip_tags (
	                        get_the_term_list( get_the_ID(), 'portfolio_filter', "",", " )
	                    );
	                    ?>
	                    
	                    </div>
	                </div>
	            </div>
	        
	        <?php endwhile; // end of the loop. ?>
	        
	        </div>
	        
	        <div class="clr"></div>
	        
	    </div><!-- #primary .content-area -->

	</div> <!-- .wp-block-gbt-portfolio -->

    <script type="text/javascript">
    	jQuery(document).ready(function($) {
        	jQuery('.mixitup-<?php echo $u; ?>').mixItUp({
		     	selectors: {
		       		filter: '.controls-<?php echo $u; ?>'
		     	}
	    	});
		});

    </script>
    
	<?php
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}