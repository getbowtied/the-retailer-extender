<?php

// Social Media Profiles

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_action( 'enqueue_block_editor_assets', 'getbowtied_tr_socials_editor_assets' );

if ( ! function_exists( 'getbowtied_tr_socials_editor_assets' ) ) {
    function getbowtied_tr_socials_editor_assets() {
    	
        wp_enqueue_script(
            'getbowtied-socials',
            plugins_url( 'block.js', __FILE__ ),
            array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element', 'jquery' )
        );

        wp_enqueue_style(
            'getbowtied-socials-styles',
            plugins_url( 'css/editor.css', __FILE__ ),
            array( 'wp-edit-blocks' )
        );
    }
}

add_action( 'enqueue_block_assets', 'getbowtied_tr_socials_assets' );

if ( ! function_exists( 'getbowtied_tr_socials_assets' ) ) {
    function getbowtied_tr_socials_assets() {
        
        wp_enqueue_style(
            'getbowtied-socials-css',
            plugins_url( 'css/style.css', __FILE__ ),
            array()
        );
    }
}

register_block_type( 'getbowtied/tr-socials', array(
	'attributes'     			=> array(
		'items_align'			=> array(
			'type'				=> 'string',
			'default'			=> 'left',
		),
        'fontSize'              => array(
            'type'              => 'number',
            'default'           => '24',
        ),
        'fontColor'             => array(
            'type'              => 'string',
            'default'           => '#000',
        ),
	),

	'render_callback' => 'getbowtied_tr_render_frontend_socials',
) );

function get_tr_social_media_icons() {
    $socials = array(
        array( 
            'link'  => 'social_media_facebook',
            'icon'  => 'fa fa-facebook',
            'name'  => 'Facebook'
        ),
        array( 
            'link'  => 'social_media_pinterest',
            'icon'  => 'fa fa-pinterest',
            'name'  => 'Pinterest'
        ),
        array( 
            'link'  => 'social_media_linkedin',
            'icon'  => 'fa fa-linkedin',
            'name'  => 'LinkedIn'
        ),
        array( 
            'link'  => 'social_media_twitter',
            'icon'  => 'fa fa-twitter',
            'name'  => 'Twitter'
        ),
        array( 
            'link'  => 'social_media_googleplus',
            'icon'  => 'fa fa-google-plus',
            'name'  => 'Google Plus'
        ),
        array( 
            'link'  => 'social_media_rss',
            'icon'  => 'fa fa-rss',
            'name'  => 'RSS'
        ),
        array( 
            'link'  => 'social_media_tumblr',
            'icon'  => 'fa fa-tumblr',
            'name'  => 'Tumblr'
        ),
        array( 
            'link'  => 'social_media_instagram',
            'icon'  => 'fa fa-instagram',
            'name'  => 'Instagram'
        ),
        array( 
            'link'  => 'social_media_vimeo',
            'icon'  => 'fa fa-vimeo-square',
            'name'  => 'Vimeo'
        ),
        array( 
            'link'  => 'social_media_behance',
            'icon'  => 'fa fa-behance',
            'name'  => 'Behance'
        ),
        array( 
            'link'  => 'social_media_dribble',
            'icon'  => 'fa fa-dribbble',
            'name'  => 'Dribbble'
        ),
        array( 
            'link'  => 'social_media_flickr',
            'icon'  => 'fa fa-flickr',
            'name'  => 'Flickr'
        ),
        array( 
            'link'  => 'social_media_git',
            'icon'  => 'fa fa-git',
            'name'  => 'Github'
        ),
        array( 
            'link'  => 'social_media_skype',
            'icon'  => 'fa fa-skype',
            'name'  => 'Skype'
        ),
        array( 
            'link'  => 'social_media_weibo',
            'icon'  => 'fa fa-weibo',
            'name'  => 'Weibo'
        ),
        array( 
            'link'  => 'social_media_foursquare',
            'icon'  => 'fa fa-foursquare',
            'name'  => 'Foursquare'
        ),
        array( 
            'link'  => 'social_media_soundcloud',
            'icon'  => 'fa fa-soundcloud',
            'name'  => 'Soundcloud'
        ),
        array( 
            'link'  => 'social_media_vk',
            'icon'  => 'fa fa-vk',
            'name'  => 'VK'
        ),
        array( 
            'link'  => 'social_media_snapchat',
            'icon'  => 'fa fa-snapchat',
            'name'  => 'Snapchat'
        ),
        array( 
            'link'  => 'social_media_houzz',
            'icon'  => 'fa fa-houzz',
            'name'  => 'Houzz'
        ),
    );

    return $socials;
}

function getbowtied_tr_render_frontend_socials($attributes) {

	global $theretailer_theme_options;

	extract(shortcode_atts(
		array(
			'items_align' => 'left',
            'fontSize'    => '24',
            'fontColor'   => '#000',
		), $attributes));
    ob_start();

    $socials = get_tr_social_media_icons();

    $output = '<div class="wp-block-gbt-social-media">';

        $output .= '<div class="site-social-icons-shortcode">';
        $output .= '<ul class="' . esc_html($items_align) . '">';

        foreach($socials as $social) {

        	if ( (isset($theretailer_theme_options[$social['link']])) && (trim($theretailer_theme_options[$social['link']]) != "" ) ) {
        		$output .= '<li>';
        		$output .= '<a style="color:'.$fontColor.';font-size:'.$fontSize.'px;" class="social_media '.$social['link'].'" target="_blank" href="' . esc_url($theretailer_theme_options[$social['link']]) . '">';
                $output .= '<i class="' . $social['icon'] . '"></i>';
        		$output .= '</a></li>';
        	}
        }

        $output .= '</ul>';
        $output .= '</div>';

    $output .= '</div>';

	ob_end_clean();

	return $output;
}