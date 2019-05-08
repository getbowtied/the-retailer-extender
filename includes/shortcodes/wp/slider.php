<?php

// [slider]

function getbowtied_mc_slider($params = array(), $content = null) {

	wp_enqueue_style( 'merchandiser_swiper_style' );
	wp_enqueue_script( 'merchandiser_swiper_script' );

	wp_enqueue_style(  'merchandiser-slider-shortcode-styles' );
	wp_enqueue_script( 'merchandiser-slider-shortcode-script' );

	extract(shortcode_atts(array(
		'full_height' 	=> 'yes',
		'custom_height' => '',
		'hide_arrows'	=> '',
		'hide_bullets'	=> ''
	), $params));

	if ($full_height == 'no' && !empty($custom_height))
	{
		$height = 'height:'.$custom_height.';';
		$extra_class = '';
	}
	else 
	{
		$height = '';
		$extra_class = 'full_height';
	}

	$getbowtied_slider = '
		
		<div class="shortcode_getbowtied_slider swiper-container '.$extra_class.'" style="'.$height.' width: 100%">
			<div class="swiper-wrapper">
			'.do_shortcode($content).'
			</div>';

	if (!$hide_arrows):
			$getbowtied_slider .= '
				<div class="swiper-button-prev"></div>
    			<div class="swiper-button-next"></div>';
    endif;

    if (!$hide_bullets):
    		$getbowtied_slider .= '
				<div class="quickview-pagination"></div>';
    endif;

	$getbowtied_slider .=	'</div>';
	
	return $getbowtied_slider;
}

add_shortcode('slider', 'getbowtied_mc_slider');

function getbowtied_mc_image_slide($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' 					=> '',
		'title_font_size'			=> '64px',
		'title_line_height'			=> '',
		'title_font_family'			=> 'primary_font',
		'description' 				=> '',
		'description_font_size' 	=> '21px',
		'description_line_height'	=> '',
		'description_font_family'	=> 'primary_font',
		'text_color'				=> '#000000',
		'button_text' 				=> '',
		'button_url'				=> '',
		'link_whole_slide'			=> '',
		'button_color'				=> '#000000',
		'button_text_color'			=>'#FFFFFF',
		'bg_color'					=> '#CCCCCC',
		'bg_image'					=> '',
		'text_align'				=> 'left'

	), $params));

	switch ($text_align)
	{
		case 'left':
			$class = 'left-align';
			break;
		case 'right':
			$class = 'right-align';
			break;
		case 'center':
			$class = 'center-align';
	}

	if (!empty($title))
	{
		$title_line_height = $title_line_height ? $title_line_height : $title_font_size;
		$title = '<h1 class="'.$title_font_family.'" style="color:'.$text_color.'; font-size:'.$title_font_size.'; line-height: '.$title_line_height.'">'.$title.'</h1>';
	} else {
		$title = "";
	}

	if (is_numeric($bg_image)) 
	{
		$bg_image = wp_get_attachment_url($bg_image);
	} else {
		$bg_image = "";
	}

	if (!empty($description))
	{
		$description_line_height = $description_line_height ? $description_line_height : $description_font_size;
		$description = '<p class="'.$description_font_family.'" style="color:'.$text_color.'; font-size:'.$description_font_size.'; line-height: '.$description_line_height.'">'.$description.'</p>';
	} else {
		$description = "";
	}

	if (!empty($button_text))
	{
		$button = '<a class="button" style="color:'.$button_text_color.'; background: '.$button_color.'" href="'.$button_url.'">'.$button_text.'</a>';
	} else {
		$button = "";
	}

	if ($link_whole_slide && !empty($button_url))
	{
		$slide_link = '<a href="'.$button_url.'" class="fullslidelink"></a>';
	}
	else 
	{
		$slide_link = '';
	}
	

	$getbowtied_image_slide = '
			<div class="swiper-slide '.$class.'" 
			style=	"background: '.$bg_color.' url('.$bg_image.') center center no-repeat ;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					color: '.$text_color.'">
				'.$slide_link.'
				<div class="slider-content" data-swiper-parallax="-1000">
					<div class="slider-content-wrapper">
						'.$title.'
						'.$description.'
						'.$button.'
					</div>
				</div>
			</div>';

	return $getbowtied_image_slide;
}

add_shortcode('image_slide', 'getbowtied_mc_image_slide');