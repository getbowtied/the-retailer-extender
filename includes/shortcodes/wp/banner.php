<?php

// [banner]

function getbowtied_mc_banner($params = array(), $content = null) {
	
	wp_enqueue_style(  'merchandiser-banner-shortcode-styles' );

	extract(shortcode_atts(array(
		'title' 					=> '',
		'title_font_size'			=> '64px',
		'title_line_height'			=> '',
		'title_font_family'			=> 'primary_font',
		'title_color'				=> '#000000',
		'subtitle' 					=> '',
		'subtitle_font_size' 		=> '21px',
		'subtitle_line_height'		=> '',
		'subtitle_font_family'		=> 'primary_font',
		'subtitle_color'			=> '#000000',
		'button_text' 				=> '',
		'button_url'				=> '',
		'inner_stroke' 				=> '2px',
		'inner_stroke_color' 		=> '#fff',
		'button_color'				=> '#000000',
		'button_text_color'			=>'#FFFFFF',
		'bg_color'					=> '#CCCCCC',
		'bg_image'					=> '',
		'height' 					=> '300px',
		'sep_padding' 				=> '5px',
		'sep_color' 				=> '#fff',
	), $params));
	
	$banner_with_img = '';
	
	if (is_numeric($bg_image)) {
		$bg_image = wp_get_attachment_url($bg_image);
		$banner_with_img = 'banner_with_img';
	}

	$cursor = 'style="cursor:default;"';

	if ($button_text && $button_url)
	{
		$image_link = '';
	}
	else 
	{
		if ($button_url)
		{
			$image_link = 'onclick="location.href=\''.$button_url.'\';"';
			$cursor = 'style="cursor:pointer;"';
		}
		else 
		{
			$image_link = '';
		}
	}
	
	$getbowtied_banner = '
		
		<div '.$cursor.' class="shortcode_getbowtied_banner '.$banner_with_img.'" '.$image_link.'>
			<div class="shortcode_getbowtied_banner_inner">
				<div class="shortcode_getbowtied_banner_bkg" style="background-color:'.$bg_color.'; background-image:url('.$bg_image.')"></div>
			
				<div class="shortcode_getbowtied_banner_inside" style="height:'.$height.'; border: '.$inner_stroke.' solid '.$inner_stroke_color.'">
					<div class="shortcode_getbowtied_banner_content">';
	if ($title)
	{
		$title_line_height = $title_line_height ? $title_line_height : $title_font_size;
		$getbowtied_banner .= '<div><h3 class="'.$title_font_family.'" style="color:'.$title_color.' !important; font-size: '.$title_font_size.'; line-height: '.$title_line_height.'">'.$title.'</h3></div>';
	}

	if ($title && $subtitle)
	{
		if ($sep_color):
			$getbowtied_banner .= '<div class="shortcode_getbowtied_banner_sep" style="margin:'.$sep_padding.' auto; background-color:'.$sep_color.';"></div>';
		endif;
	}

	if ($subtitle)
	{
		$subtitle_line_height = $subtitle_line_height ? $subtitle_line_height : $subtitle_font_size;
		$getbowtied_banner .= '<div><h4 class="'.$subtitle_font_family.'" style="color:'.$subtitle_color.' !important; font-size: '.$subtitle_font_size.'; line-height: '.$subtitle_line_height.'">'.$subtitle.'</h4></div>';
	}

	if ($button_text && $button_url)
	{
		$getbowtied_banner .= '<a href="'.$button_url.'" class="button" style="background-color:'.$button_color.'; color: '.$button_text_color.'">'.$button_text.'</a>';
	}

	$getbowtied_banner .= '
					</div>
				</div>
			</div>
		</div>';
	
	return $getbowtied_banner;
}

add_shortcode('banner', 'getbowtied_mc_banner');