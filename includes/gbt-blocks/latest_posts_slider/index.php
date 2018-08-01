<?php

// Posts Slider

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_action( 'enqueue_block_editor_assets', 'getbowtied_tr_latest_posts_editor_assets' );

if ( ! function_exists( 'getbowtied_tr_latest_posts_editor_assets' ) ) {
	function getbowtied_tr_latest_posts_editor_assets() {
		
		wp_enqueue_script(
			'getbowtied-latest-posts-slider',
			plugins_url( 'block.js', __FILE__ ),
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'jquery' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
		);

		wp_enqueue_style(
			'getbowtied-latest-posts-slider-editor-css',
			plugins_url( 'css/editor.css', __FILE__ ),
			array( 'wp-blocks' )
		);
	}
}

add_action( 'enqueue_block_assets', 'getbowtied_tr_latest_posts_assets' );

if ( ! function_exists( 'getbowtied_tr_latest_posts_assets' ) ) {
	function getbowtied_tr_latest_posts_assets() {
		
		wp_enqueue_style(
			'getbowtied-latest-posts-slider-css',
			plugins_url( 'css/style.css', __FILE__ ),
			array()
		);
	}
}

register_block_type( 'getbowtied/tr-latest-posts-slider', array(
	'attributes'      					=> array(
		'number'						=> array(
			'type'						=> 'number',
			'default'					=> '12',
		),
		'category'						=> array(
			'type'						=> 'string',
			'default'					=> '',
		),
		'align'							=> array(
			'type'						=> 'string',
			'default'					=> 'center',
		),
		'title'							=> array(
			'type'						=> 'string',
			'default'					=> 'Latest Posts'
		),
	),

	'render_callback' => 'getbowtied_tr_render_frontend_latest_posts_slider',
) );

function getbowtied_tr_render_frontend_latest_posts_slider( $attributes ) {

	extract( shortcode_atts( array(
		'number'	=> '12',
		'category'	=> 'All Categories',
		'title'		=> 'Latest Posts',
		'align'		=> 'center',
	), $attributes ) );

	ob_start();
	?> 

	<div class="wp-block-gbt-posts-slider <?php echo $align; ?>">
    
		<script>
		jQuery(document).ready(function($) {
			
			var from_the_blog_slider = $("#from-the-blog-<?php echo $sliderrandomid ?>");
			
			from_the_blog_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsTabletSmall:false,
				itemsMobile : [480,1],
				lazyLoad : true,
			});
			
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
				from_the_blog_slider.trigger('owl.prev');
			})
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
				from_the_blog_slider.trigger('owl.next');
			})
			
		});
		</script>
	    
	    <div class="from-the-blog-section gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
	    
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
	    
	        <div class="slider-wrapper from-the-blog-wrapper">
				<div class="slider" id="from-the-blog-<?php echo $sliderrandomid ?>">
						
						<?php
	            
	                    $args = array(
	                        'post_status' => 'publish',
	                        'post_type' => 'post',
							'category_name' => $category,
	                        'posts_per_page' => $number
	                    );
	                    
	                    $recentPosts = new WP_Query( $args );
	                    
	                    if ( $recentPosts->have_posts() ) : ?>
	                                
	                        <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
	                    
	                            <?php $post_format = get_post_format(get_the_ID()); ?>
	                            
	                            <ul>
	                            <li class="from_the_blog_item <?php echo $post_format; ?> <?php if ( !has_post_thumbnail()) : ?>no_thumb<?php endif; ?>">
	                                
	                                <a class="from_the_blog_img img_zoom_in" href="<?php the_permalink() ?>">
	                                    <?php if ( has_post_thumbnail()) : ?>
	                                    	<?php the_post_thumbnail('recent_posts_shortcode') ?>
	                                    <?php else : ?>
	                                    	<div><span class="from_the_blog_noimg"></span></div>
	                                    <?php endif; ?>
	                                    <span class="from_the_blog_date">
											<span class="from_the_blog_date_day"><?php echo get_the_time('d', get_the_ID()); ?></span>
	                                        <span class="from_the_blog_date_month"><?php echo get_the_time('M', get_the_ID()); ?></span>
	                                    </span>
	                                    <?php if ($post_format != "") : ?>
	                                    <span class="post_format_icon"></span>
	                                    <?php endif ?>
	                                </a>
	                                
	                                <div class="from_the_blog_content">
	                                
	                                    <?php if ( ($post_format == "") || ($post_format == "video") ) : ?>
	                                    	<a class="from_the_blog_title" href="<?php the_permalink() ?>"><h3><?php echo string_limit_words(get_the_title(), 5); ?></h3></a>
	                                    <?php endif ?>	
	                                                                
	                                    <div class="from_the_blog_excerpt">
											<?php											
												$limit_words = 12;
												if ( ($post_format == "status") || ($post_format == "quote") || ($post_format == "aside") ) {
													$limit_words = 40;
												}
												$excerpt = get_the_excerpt();
	                                            echo string_limit_words($excerpt, $limit_words);
	                                        ?>
	                                    </div>

	                                    <?php if ( ($post_format == "") || ($post_format == "quote") || ($post_format == "video") || ($post_format == "image") || ($post_format == "audio") || ($post_format == "gallery") ) : ?>
	                                    	<div class="from_the_blog_comments">
												<?php comments_popup_link( __( 'Leave a comment', 'theretailer' ), __( '1 Comment', 'theretailer' ), __( '% Comments', 'theretailer' ), '', '' ); ?>
	                                        </div>
	                                    <?php endif ?>
	                                
	                                </div>
	                                
	                            </li>
	                            </ul>
	                
	                        <?php endwhile; // end of the loop. ?>
	                        
	                    <?php

	                    endif;
	                    
	                    ?>
	            </div><!--.slider-->
			</div><!--.slider-wrapper-->
	    
	    </div>

	</div>
	
	<?php

	wp_reset_query();

	return ob_get_clean();
}