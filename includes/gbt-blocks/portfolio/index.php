<?php

// Portfolio

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_action( 'enqueue_block_editor_assets', 'getbowtied_portfolio_editor_assets' );

if ( ! function_exists( 'getbowtied_portfolio_editor_assets' ) ) {
	function getbowtied_portfolio_editor_assets() {
		
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

add_action( 'enqueue_block_assets', 'getbowtied_portfolio_assets' );

if ( ! function_exists( 'getbowtied_portfolio_assets' ) ) {
	function getbowtied_portfolio_assets() {
		
		wp_enqueue_style(
			'getbowtied-portfolio-css',
			plugins_url( 'css/style.css', __FILE__ ),
			array()
		);
	}
}

register_block_type( 'getbowtied/portfolio', array(
	'attributes'      => array(
		'itemsNumber'					=> array(
			'type'						=> 'integer',
			'default'					=> 6,
		),
		'category'						=> array(
			'type'						=> 'string',
			'default'					=> '',
		),
		'showFilters'					=> array(
			'type'						=> 'boolean',
			'default'					=> false,
		),
		'orderBy'						=> array(
			'type'						=> 'string',
			'default'					=> 'date',
		),
		'order'							=> array(
			'type'						=> 'string',
			'default'					=> 'asc',
		),
		'grid'							=> array(
			'type'						=> 'string',
			'default'					=> 'default',
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

	'render_callback' => 'getbowtied_render_frontend_portfolio',
) );

function getbowtied_render_frontend_portfolio( $attributes ) {
	
	$sliderrandomid = rand();
	
	extract(shortcode_atts(array(
		"itemsNumber" 				=> '9999',
		"category" 					=> '',
		"showFilters" 				=> false,
		"orderBy" 					=> 'date',
		"order" 					=> 'desc',
		"grid" 						=> 'default',
		"itemsPerRow" 				=> '3',
		"align"						=> 'center'
	), $attributes));
	ob_start();
	?>
    
    <?php
				
	if ($orderBy == "alphabetical") $orderBy = 'title';
	
	$args = array(					
		'post_status' 			=> 'publish',
		'post_type' 			=> 'portfolio',
		'posts_per_page' 		=> $itemsNumber,
		'portfolio_categories' 	=> $category,
		'orderby' 				=> $orderBy,
		'order' 				=> $order,
	);
	
	$portfolioItems = get_posts( $args );

	if ( !empty($portfolioItems) ) :
	
		foreach($portfolioItems as $post) :
			
			$terms = get_the_terms( $post->ID, 'portfolio_categories' ); // get an array of all the terms as objects.
			
			if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
				foreach($terms as $term) {
					$portfolio_categories_queried[$term->slug] = $term->name;
				}
			}
			
		endforeach;

	endif;

	if ( count($portfolio_categories_queried) > 0 ) :
	
		$portfolio_categories_queried = array_unique($portfolio_categories_queried);
		
		if ($grid == "default") {
			$items_per_row_class = ' default_grid items_per_row_'.$itemsPerRow;
		} else {
			$items_per_row_class = '';
		}
		
		?>
	    
	    <div class="wp-block-gbt-portfolio <?php echo $align; ?>">
			<div class="portfolio-isotope-container<?php echo $items_per_row_class ;?>">
		                
		        <?php if ($category == "") : ?>
		        <?php if ($showFilters) : ?>
		        <div class="portfolio-filters">            
		            <?php
					
					if ( !empty( $portfolio_categories_queried ) && !is_wp_error( $portfolio_categories_queried ) ){
		                echo '<ul class="filters-group list-centered">';
		                    echo '<li class="filter-item is-checked" data-filter="*">' . __("Show all", "shopkeeper") . '</li>';
		                foreach ( $portfolio_categories_queried as $key => $value ) {
		                    echo '<li class="filter-item" data-filter=".' . $key . '">' . $value . '</li>';
		                }
		                echo '</ul>';
		            }
					           
		            ?>            
		        </div>
		        <?php endif; ?>
		        <?php endif; ?>
		        
		        <div class="portfolio-isotope">
		            
		            <div class="portfolio-grid-sizer"></div>
		                
		                <?php
						
		                $post_counter = 0;
		                                
			                if ( !empty($portfolioItems) ) :
			
								foreach($portfolioItems as $post) :
			                    
									$post_counter++;
				                    
				                    if ( has_post_thumbnail($post->ID))
				                    {
										$related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
									}

				                   $terms_slug = get_the_terms( $post->ID, 'portfolio_categories' ); // get an array of all the terms as objects.

				                    $term_slug_class = "";
				                    
				                    if ( !empty( $terms_slug ) && !is_wp_error( $terms_slug ) ){
				                        foreach ( $terms_slug as $term_slug ) {
				                            $term_slug_class .=  $term_slug->slug . " ";
				                        }
				                    }
				                    
				                    if (get_post_meta( $post->ID, 'portfolio_color_meta_box', true )) {
				                        $portfolio_color_option = get_post_meta( $post->ID, 'portfolio_color_meta_box', true );
				                    } else {
				                        $portfolio_color_option = "none";
				                    }
									
									$portfolio_item_width = "";
									$portfolio_item_height = "";
									
									switch ($grid) {
										
										case "grid1":							
											
											switch ($post_counter) {
												case (($post_counter == 1)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "height2";
													break;
												case (($post_counter == 2)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												case (($post_counter == 7)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												case (($post_counter == 8)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "height2";
													break;
												default :
													$portfolio_item_width = "";
													$portfolio_item_height = "";
											}							
											break;
											
										case "grid2":
											
											switch ($post_counter) {
												case (($post_counter == 3)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "height2";
													break;
												case (($post_counter == 8)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												case (($post_counter == 13)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												default :
													$portfolio_item_width = "";
													$portfolio_item_height = "";
											}							
											break;
											
										case "grid3":
										
											switch ($post_counter) {
												case (($post_counter == 3)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												case (($post_counter == 8)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												case (($post_counter == 11)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												case (($post_counter == 14)) :
													$portfolio_item_width = "width2";
													$portfolio_item_height = "";
													break;
												default :
													$portfolio_item_width = "";
													$portfolio_item_height = "";
											}							
											break;
											
										default:
											
											$portfolio_item_width = "";
											$portfolio_item_height = "";
											
									}
				                    
				                ?>

				                    <div class="portfolio-box hidden <?php echo esc_html($portfolio_item_width); ?> <?php echo esc_html($portfolio_item_height); ?> <?php echo esc_html($term_slug_class); ?>">
				                        
				                        <a href="<?php echo get_permalink($post->ID); ?>" class="portfolio-box-inner hover-effect-link" style="background-color:<?php echo esc_html($portfolio_color_option); ?>">
				                            
				                            <div class="portfolio-content-wrapper hover-effect-content">
				                                
				                                <?php if ($related_thumb[0] != "") : ?>
				                                    <span class="portfolio-thumb hover-effect-thumb" style="background-image: url(<?php echo esc_url($related_thumb[0]); ?>)"></span>
				                                <?php endif; ?>
				                                
				                                <h2 class="portfolio-title hover-effect-title"><?php echo $post->post_title; ?></h2>
				                                
				                                <p class="portfolio-categories hover-effect-text"><?php echo strip_tags (get_the_term_list($post->ID, 'portfolio_categories', "", ", "));?></p>
				                                 
				                            </div>
				                            
				                        </a>
				                        
				                    </div>
			                
			                <?php endforeach; // end of the loop. ?>

			            <?php endif; ?>

		        </div><!--portfolio-isotope-->
		    
		    </div><!--portfolio-isotope-container-->
		</div> <!--wp-block-gbt-portfolio-->
	
	<?php

	endif;

	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_action('wp_ajax_getbowtied_render_portfolio_categories', 'getbowtied_render_portfolio_categories');
function getbowtied_render_portfolio_categories() {

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
		'taxonomy'                 => 'portfolio_categories',
		'pad_counts'               => false
	);

	$categories = get_categories($args);

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

add_action('wp_ajax_getbowtied_get_preview_grid', 'getbowtied_get_preview_grid');
function getbowtied_get_preview_grid() {

	$attributes = $_POST['attributes'];
	$output = '';

	extract( shortcode_atts( array(
		'grid' => 'default',
	), $attributes ) );

	$image_src = '';

	switch( $grid )
	{
		case 'default':
			$image_src = plugin_dir_url( __FILE__ ) . 'assets/portfolio_equal_boxes.png';
			break;
		case 'grid1':
			$image_src = plugin_dir_url( __FILE__ ) . 'assets/portfolio_masonry_1.png';
			break;
		case 'grid2':
			$image_src = plugin_dir_url( __FILE__ ) . 'assets/portfolio_masonry_2.png';
			break;
		case 'grid3':
			$image_src = plugin_dir_url( __FILE__ ) . 'assets/portfolio_masonry_3.png';
			break;
		default:
			$image_src = plugin_dir_url( __FILE__ ) . 'assets/portfolio_equal_boxes.png';
			break;
	}

	$output = 'el("img",{key:"portfolio-preview-image",className:"portfolio-preview-image",src:"'.$image_src.'"})';

	echo json_encode($output);
	exit;
}