<?php

// [title]
function getbowtied_mc_shortcode_title($params = array(), $content = null) {

	wp_enqueue_style(  'merchandiser-title-shortcode-styles' );

	extract(shortcode_atts(array(
		'text' 			=> 'Title',
		'tag' 			=> 'h3',
		'font' 			=> 'secondary_font',		
		'font_size'		=> '',
		'line_height' 	=> '',
		'text_align' 	=> '',
		'css'			=> '',
		'el_class'		=> '',
		'color'			=> ''
	), $params));

	$title_styles = "";
	
	if ($font_size != '') 		$title_styles .= 'font-size:' . 	$font_size . ';';
	if ($line_height != '') 	$title_styles .= 'line-height:' . 	$line_height . ';';
	if ($text_align != '') 		$title_styles .= 'text-align:' . 	$text_align . ';';
	if ($color != '') 			$title_styles .= 'color:' . 	$color . ';';
	
	$title_html = '<'.$tag.' class="shortcode_title '.$font.' '.$el_class.'" style="'.$title_styles.'" >'.$text.'</'.$tag.'>';
	
	return $title_html;
}

add_shortcode('title', 'getbowtied_mc_shortcode_title');