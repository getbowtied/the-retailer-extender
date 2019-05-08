<?php

// [blog_posts]
function getbowtied_mc_shortcode_blog_posts($atts, $content = null) {

	wp_enqueue_style( 'merchandiser_swiper_style' );
	wp_enqueue_script( 'merchandiser_swiper_script' );

	wp_enqueue_style(  'merchandiser-blog-posts-shortcode-styles' );
	wp_enqueue_script( 'merchandiser-blog-posts-shortcode-script' );

	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"posts" 		=>  '9',
		"category" 		=>  '',
		"hide_arrows" 	=>  0,
		"hide_bullets" 	=>  0
	), $atts));
	ob_start();
	?>

	<div class="shortcode_getbowtied_blog_posts swiper-container">
		<div class="swiper-wrapper">
		<?php

        $args = array(
            'post_status' => 'publish',
            'post_type' => 'post',
            'category_name' => $category,
            'posts_per_page' => $posts
        );
        
        $recentPosts = new WP_Query( $args );
        
        if ( $recentPosts->have_posts() ) : ?>
                    
            <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>

            		<?php if ( has_post_thumbnail()) :
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id,'full', true);
						endif;
					?>
                
	                <div class="shortcode_blog_posts_item swiper-slide">
						<div class="slide-wrapper" style="background: url(<?php echo esc_url($image_url[0]); ?>) center center no-repeat;
	                			-webkit-background-size: cover;
								-moz-background-size: cover;
								-o-background-size: cover;
								background-size: cover;
								">
						</div>
						<div class="text-wrapper">
	                    	<a class="shortcode_blog_posts_link" href="<?php the_permalink() ?>">
								<span class="shortcode_blog_posts_link_wrapper">
									<h4 class="shortcode_blog_posts_title"><?php echo get_the_title(); ?></h4>
									<span class="shortcode_blog_posts_date"><?php echo get_the_date(); ?></span>
								</span>
							</a>
						</div>
	                    
	                </div>

                </li>
    
            <?php endwhile; // end of the loop. ?>
            
        <?php

        endif;
        
        ?>
		</div>    
		<?php if (!$hide_arrows): ?>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>	
		<?php endif; ?>
		<?php if (!$hide_bullets): ?>
			<div class="quickview-pagination"></div>
		<?php endif; ?>	    
	</div>
	
	<?php
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("blog_posts", "getbowtied_mc_shortcode_blog_posts");