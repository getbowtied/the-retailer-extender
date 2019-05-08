<?php

// [blog_posts_mixed]
function getbowtied_mc_shortcode_blog_posts_mixed($atts, $content = null) {
	extract(shortcode_atts(array(
		"posts" 		=> '2',
		"category" 		=> '',
		"layout"  		=> 'listing',
		"hide_arrows" 	=> 0,
		"hide_bullets"	=> 0
	), $atts));
	ob_start();

    if ($layout == "masonry") {
		echo do_shortcode('[blog_posts posts="'.$posts.'" category="'.$category.'"]');
	//} else {
        //echo do_shortcode('[blog_posts_list posts="'.$posts.'" category="'.$category.'"]');
	}

	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("blog_posts_mixed", "getbowtied_mc_shortcode_blog_posts_mixed");