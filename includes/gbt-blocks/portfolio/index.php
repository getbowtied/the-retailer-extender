<?php

// Portfolio

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_action( 'enqueue_block_editor_assets', 'getbowtied_tr_portfolio_editor_assets' );

if ( ! function_exists( 'getbowtied_tr_portfolio_editor_assets' ) ) {
	function getbowtied_tr_portfolio_editor_assets() {
		
		wp_enqueue_script(
			'getbowtied-portfolio',
			plugins_url( 'block.js', __FILE__ ),
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'jquery' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
		);

		wp_enqueue_style(
			'getbowtied-portfolio-editor-css',
			plugins_url( 'css/editor.css', __FILE__ ),
			array( 'wp-blocks' )
		);
	}
}

add_action( 'enqueue_block_assets', 'getbowtied_tr_portfolio_assets' );

if ( ! function_exists( 'getbowtied_tr_portfolio_assets' ) ) {
	function getbowtied_tr_portfolio_assets() {
		
		wp_enqueue_style(
			'getbowtied-portfolio-css',
			plugins_url( 'css/style.css', __FILE__ ),
			array()
		);
	}
}

register_block_type( 'getbowtied/tr-portfolio', array(
	'attributes'      => array(
		'itemsNumber'					=> array(
			'type'						=> 'integer',
			'default'					=> '12',
		),
		'category'						=> array(
			'type'						=> 'string',
			'default'					=> '',
		),
		'showFilters'					=> array(
			'type'						=> 'boolean',
			'default'					=> true,
		),
		'orderBy'						=> array(
			'type'						=> 'string',
			'default'					=> 'date',
		),
		'order'							=> array(
			'type'						=> 'string',
			'default'					=> 'ASC',
		),
		'itemsPerRow'					=> array(
			'type'						=> 'number',
			'default'					=> '3',
		),
		'align'							=> array(
			'type'						=> 'string',
			'default'					=> 'center',
		),
	),

	'render_callback' => 'getbowtied_tr_render_frontend_portfolio',
) );

function getbowtied_tr_render_frontend_portfolio( $attributes ) {

	global $theretailer_theme_options;
	
	$sliderrandomid = rand();
	$u = uniqid();
	
	extract(shortcode_atts(array(
		"itemsNumber"				=> '12',
		"category" 					=> '',
		"showFilters" 				=> true,
		"orderBy" 					=> 'date',
		"order" 					=> 'ASC',
		"itemsPerRow" 				=> '3',
		"align"						=> 'center'
	), $attributes));
	ob_start();
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

add_action('wp_ajax_getbowtied_tr_render_portfolio_categories', 'getbowtied_tr_render_portfolio_categories');
function getbowtied_tr_render_portfolio_categories() {

	$args = array(
		'type'                     => 'post',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 1,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'portfolio_filter',
		'pad_counts'               => false
	);

	$categories = get_terms($args);

	$output_categories = array();

	$i = 0;
	$output_categories[$i] = array( 'value' => '', 'label' => 'All Categories');

	foreach($categories as $category) { 
		$i++;
		$output_categories[$i] = array( 'value' => htmlspecialchars_decode($category->name), 'label' => htmlspecialchars_decode($category->name));
	}

	echo json_encode($output_categories);
	exit;
}

add_action('wp_ajax_getbowtied_tr_get_preview_grid', 'getbowtied_tr_get_preview_grid');
function getbowtied_tr_get_preview_grid() {

	$output = '';

	$image_src = plugin_dir_url( __FILE__ ) . 'assets/portfolio_equal_boxes.png';

	$output = 'el("img",{key:"portfolio-preview-image",className:"portfolio-preview-image",src:"'.$image_src.'"})';

	echo json_encode($output);
	exit;
}