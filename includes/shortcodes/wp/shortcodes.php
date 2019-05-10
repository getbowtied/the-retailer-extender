<?php

// [full_column]
function content_grid_12($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$full_column = '<div class="content_grid_12 clr">'.$content.'</div>';
	return $full_column;
}

// [one_half]
function content_grid_6($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_half = '<div class="content_grid_6">'.$content.'</div>';
	return $one_half;
}

// [one_third]
function content_grid_4($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_third = '<div class="content_grid_4">'.$content.'</div>';
	return $one_third;
}

// [two_third]
function content_grid_2_3($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$two_third = '<div class="content_grid_2_3">'.$content.'</div>';
	return $two_third;
}

// [one_fourth]
function content_grid_3($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_fourth = '<div class="content_grid_3">'.$content.'</div>';
	return $one_fourth;
}

// [one_sixth]
function content_grid_2($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_sixth = '<div class="content_grid_2">'.$content.'</div>';
	return $one_sixth;
}

// [one_twelves]
function content_grid_1($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_twelves = '<div class="content_grid_1">'.$content.'</div>';
	return $one_twelves;
}

// [column_demo]
function column_demo($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'bgcolor' => '#ccc'
	), $params));
	
	$content = do_shortcode($content);
	$column_demo = '<div class="column_demo" style="background-color:'.$bgcolor.'">'.$content.'</div>';
	return $column_demo;
}

// [separator]
function shortcode_separator($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'top_space' => '10px',
		'bottom_space' => '30px'
	), $params));
	$separator = '
		<div class="clr"></div><div class="content_hr" style="margin-top:'.$top_space.';margin-bottom:'.$bottom_space.'"></div><div class="clr"></div>
	';
	return $separator;
}

// [empty_separator]
function shortcode_empty_separator($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'top_space' => '10px',
		'bottom_space' => '30px'
	), $params));
	$empty_separator = '
		<div class="clr"></div><div class="empty_separator" style="margin-top:'.$top_space.';margin-bottom:'.$bottom_space.'"></div><div class="clr"></div>
	';
	return $empty_separator;
}

// [featured_box]
function shortcode_big_box_txt_bg($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'background_url' => ''
	), $params));
	
	$content = do_shortcode($content);
	$featured_box = '
		<div class="shortcode_big_box_txt_bg_wrapper" style="background-image:url('.$background_url.')">
		<div class="shortcode_big_box_txt_bg">
			<h3>'.$title.'</h3>
			<div class="sep"></div>
			<h5>'.$content.'</h5>
		</div>
		</div>
	';
	return $featured_box;
}

// [text_block]
function shortcode_text_block($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title'
	), $params));
	
	$content = do_shortcode($content);
	$text_block = '		
		<div class="shortcode_text_block">
			<h3>'.$title.'</h3>
			<p>'.$content.'</p>
		</div>
	';
	return $text_block;
}

// [featured_1]
function shortcode_featured_1($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'title' => 'Title',
		'button_text' => 'Link button',
		'button_url' => '#'
	), $params));
	
	if (is_numeric($image_url)) {
		$image_url = wp_get_attachment_url($image_url);
	}
	
	$content = do_shortcode($content);
	$featured_1 = '		
		<div class="shortcode_featured_1">
			<div class="shortcode_featured_1_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$title.'</h3>
			<p>'.$content.'</p>
			<a href="'.$button_url.'">'.$button_text.'</a>
		</div>
	';
	return $featured_1;
}

//[section_title]

function section_title($params = array(), $content = null) {
	
	$content = do_shortcode($content);
	$section_title = '<div class="section_title">'.$content.'</div>';
	return $section_title;
}


// [tabgroup]
function tabgroup( $params, $content = null ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();
	
	extract(shortcode_atts(array(
		'title' => 'Title'
	), $params));

	do_shortcode($content);

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $tab ){	
			$tabs[] = '<li class="tab"><a href="#panel'.$randomid.$i.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div class="panel" id="panel'.$randomid.$i.'"><p>'.do_shortcode($tab['content']).'</p></div>';
			$i++;
		}
		$return = '
		<div class="shortcode_tabgroup">
			<h3>'.$title.'</h3>
			<ul class="tabs">'.implode( "\n", $tabs ).'</ul><div class="panels">'.implode( "\n", $panes ).'</div><div class="clr"></div></div>';
	}
	return $return;
}

function tab( $params, $content = null) {
	extract(shortcode_atts(array(
			'title' => ''
	), $params));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	$GLOBALS['tab_count']++;
}

// [bold_title]
function bold_title($params = array(), $content = null) {
	$bold_title = '
		<h2 class="bold_title"><span>'.$content.'</span></h2>
	';
	return $bold_title;
}

// [our_services]
function our_services($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'title' => 'Title',
		'link_name' => '',
		'link_url' => ''
	), $params));
	
	if (is_numeric($image_url)) {
		$image_url = wp_get_attachment_url($image_url);
	}
	
	$content = do_shortcode($content);
	$our_services = '		
		<div class="shortcode_our_services">
			<div class="shortcode_our_services_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$title.'</h3>
			<div class="small_sep"></div>
			<p>'.$content.'</p>
			<a href="'.$link_url.'">'.$link_name.'</a>
		</div>
	';
	return $our_services;
}

// [accordion]
function accordion($atts, $content=null, $code) {

	extract(shortcode_atts(array(
		'open' => '1',
		'title' => 'Title'
	), $atts));

	if (!preg_match_all("/(.?)\[(accordion-item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion-item\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} 
	else {
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
						
			$output .= '<div class="accordion-title"><a href="#">' . $matches[3][$i]['title'] . '</a></div><div class="accordion-inner">' . do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		return '<h3 class="accordion_h3">'.$title.'</h3><div class="accordion" rel="'.$open.'">' . $output . '</div>';
		
	}	
}

// [container]
function shortcode_container($params = array(), $content = null) {
	
	$content = do_shortcode($content);
	$container = '		
		<div class="shortcode_container">'.$content.'<div class="clr"></div></div>';
	return $container;
}

function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit) {
		array_pop($words);
		return implode(' ', $words) . '...';
	} else {
		return $string;
	}
}

// [from_the_portfolio]
function shortcode_from_the_portfolio($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"posts" => '4'
	), $atts));
	ob_start();
	?> 

    <div class="from_the_portfolio">

            <?php
    
            $args = array(
                'post_status' => 'publish',
                'post_type' => 'portfolio',
                'posts_per_page' => $posts
            );
            
            $recentPosts = new WP_Query( $args );
            
            if ( $recentPosts->have_posts() ) : ?>
                        
                <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
            
                    <div class="from_the_portfolio_item">
                        <a class="from_the_portfolio_img" href="<?php the_permalink() ?>">
                            <?php if ( has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('portfolio_4_col') ?>
                            <?php else : ?>
                            <span class="from_the_portfolio_noimg"></span>
                            <?php endif; ?>
                        </a>
                        
                        <a class="from_the_portfolio_title" href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>
                        
                        <div class="portfolio_sep"></div>	
                                                    
                        <div class="from_the_portfolio_cats">
                            <?php 
                            echo strip_tags (
                                get_the_term_list( get_the_ID(), 'portfolio_filter', "",", " )
                            );
                            ?>
                        </div>
                    </div>
        
                <?php endwhile; // end of the loop. ?>
                
                <div class="clr"></div>
                
            <?php

            endif;
            
            ?>   
    </div>


	<?php
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [slide_everything]
function shortcode_slide_everything($atts, $content=null, $code) {
	$sliderrandomid = rand();
	ob_start();
	?> 
    
    <script>
	
	(function($){
		$(window).load(function(){
			
				/* items_slider */
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					scrollbar: true,
					scrollbarHide: true,
					scrollbarLocation: 'bottom',
					scrollbarHeight: '2px',
					scrollbarBackground: '#ccc',
					scrollbarBorder: '0',
					scrollbarMargin: '0',
					scrollbarOpacity: '1',
					navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything_next'),
					navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything_previous'),
					onSliderLoaded: update_height_slide_everything,
					onSlideChange: update_height_slide_everything,
					onSliderResize: update_height_slide_everything
				});
				
				function update_height_slide_everything(args) {
					
					/* update height of the first slider */
					
					setTimeout(function() {
						var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything .slide_everything_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
						$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything').css({ visibility: "visible" });
						$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything').stop().animate({ height: setHeight+20 }, 300);
					},0);
					
				}
			
		})
	})(jQuery);

	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?> slide_everything">  
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider slide_everything">
                <ul class="slider">
                    
                    <?php
                    if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches)) {
						return do_shortcode($content);
					} 
					else {
						$output = '';
						for($i = 0; $i < count($matches[0]); $i++) {
										
							$output .= '<li class="slide_everything_item">
											<div class="slide_everything_content">' . do_shortcode(trim($matches[5][$i])) .'</div>
										</li>';
						}
						echo $output;
						
					}
					?>

                </ul>
                                       
                <div class='slide_everything_previous'></div>
                <div class='slide_everything_next'></div>
                    
            </div>
        </div>
    
    </div>

	<?php
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [sourcecode]
function shortcode_sourcecode($params = array(), $content = null) {
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$sourcecode = '<pre class="shortcode_sourcecode">'.$content.'</pre>';
	return $sourcecode;
}

// [code]
function shortcode_code($params = array(), $content = null) {
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$code = '<span class="shortcode_code">'.$content.'</span>';
	return $code;
}

// [testimonial_left]
function shortcode_testimonial_left($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image_url" => '',
		"name" => '',
		"company" => ''
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$testimonial_left = '
	<div class="testimonial_left">
		<div class="testimonial_left_content">
			<div><span>'.$content.'</span></div>
		</div>
		<div class="testimonial_left_author">
			<img src="'.$image_url.'" alt="'.$name.'" />
			<h4>'.$name.'</h4>
			<h5>'.$company.'</h5>
		</div>
		<div class="clr"></div>
	</div>
	';
	return $testimonial_left;
}

// [testimonial_right]
function shortcode_testimonial_right($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image_url" => '',
		"name" => '',
		"company" => ''
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$testimonial_right = '
	<div class="testimonial_right">
		<div class="testimonial_right_content">
			<div><span>'.$content.'</span></div>
		</div>
		<div class="testimonial_right_author">
			<img src="'.$image_url.'" alt="'.$name.'" />
			<h4>'.$name.'</h4>
			<h5>'.$company.'</h5>
		</div>
		<div class="clr"></div>
	</div>
	';
	return $testimonial_right;
}

// [light_button]
function shortcode_light_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$light_button = '<a href="'.$url.'" class="light_button" target="'.$target.'">'.$content.'</a>';
	return $light_button;
}

// [dark_button]
function shortcode_dark_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$dark_button = '<a href="'.$url.'" class="dark_button" target="'.$target.'">'.$content.'</a>';
	return $dark_button;
}

// [light_grey_button]
function shortcode_light_grey_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$light_grey_button = '<a href="'.$url.'" class="light_grey_button" target="'.$target.'">'.$content.'</a>';
	return $light_grey_button;
}

// [dark_grey_button]
function shortcode_dark_grey_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$dark_grey_button = '<a href="'.$url.'" class="dark_grey_button" target="'.$target.'">'.$content.'</a>';
	return $dark_grey_button;
}

// [custom_button]
function shortcode_custom_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"color" => '',
		"bg_color" => '',
		"target" => ''
	), $params));
	$custom_button = '<a href="'.$url.'" class="custom_button" target="'.$target.'" style="background-color:'.$bg_color.'; border-color:'.$bg_color.'; color:'.$color.';">'.$content.'</a>';
	return $custom_button;
}

/* Add shortcodes */

add_shortcode('full_column', 'content_grid_12');
add_shortcode('one_half', 'content_grid_6');
add_shortcode('one_third', 'content_grid_4');
add_shortcode('two_third', 'content_grid_2_3');
add_shortcode('one_fourth', 'content_grid_3');
add_shortcode('one_sixth', 'content_grid_2');
add_shortcode('one_twelves', 'content_grid_1');
add_shortcode('column_demo', 'column_demo');
add_shortcode('separator', 'shortcode_separator');
add_shortcode('empty_separator', 'shortcode_empty_separator');
add_shortcode('featured_box', 'shortcode_big_box_txt_bg');
add_shortcode('text_block', 'shortcode_text_block');
add_shortcode('featured_1', 'shortcode_featured_1');
add_shortcode('section_title', 'section_title');
add_shortcode('tabgroup', 'tabgroup');
add_shortcode('tab', 'tab');
add_shortcode('bold_title', 'bold_title');
add_shortcode('our_services', 'our_services');
add_shortcode('accordion', 'accordion');
add_shortcode('accordion-item', 'accordion');
add_shortcode('container', 'shortcode_container');
add_shortcode("from_the_portfolio", "shortcode_from_the_portfolio");
add_shortcode("slide_everything", "shortcode_slide_everything");
add_shortcode('sourcecode', 'shortcode_sourcecode');
add_shortcode('code', 'shortcode_code');
add_shortcode('testimonial_left', 'shortcode_testimonial_left');
add_shortcode('testimonial_right', 'shortcode_testimonial_right');
add_shortcode('light_button', 'shortcode_light_button');
add_shortcode('dark_button', 'shortcode_dark_button');
add_shortcode('light_grey_button', 'shortcode_light_grey_button');
add_shortcode('dark_grey_button', 'shortcode_dark_grey_button');
add_shortcode('custom_button', 'shortcode_custom_button');