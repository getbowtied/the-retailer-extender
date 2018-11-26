<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//==============================================================================
//  Enqueue Editor Assets
//==============================================================================
add_action( 'enqueue_block_editor_assets', 'gbt_18_tr_social_media_editor_assets' );
if ( ! function_exists( 'gbt_18_tr_social_media_editor_assets' ) ) {
    function gbt_18_tr_social_media_editor_assets() {
        
        wp_enqueue_script(
            'gbt_18_tr_social_media_script',
            plugins_url( 'block.js', __FILE__ ),
            array( 'wp-blocks', 'wp-components', 'wp-editor', 'wp-i18n', 'wp-element' )
        );

        wp_enqueue_style(
            'gbt_18_tr_social_media_editor_styles',
            plugins_url( 'assets/css/editor.css', __FILE__ ),
            array( 'wp-edit-blocks' )
        );
    }
}

//==============================================================================
//  Enqueue Frontend Assets
//==============================================================================
add_action( 'enqueue_block_assets', 'gbt_18_tr_social_media_assets' );
if ( ! function_exists( 'gbt_18_tr_social_media_assets' ) ) {
    function gbt_18_tr_social_media_assets() {
        
        wp_enqueue_style(
            'gbt_18_tr_social_media_styles',
            plugins_url( 'assets/css/style.css', __FILE__ ),
            array()
        );
    }
}

//==============================================================================
//  Register Block Type
//==============================================================================
register_block_type( 'getbowtied/tr-social-media-profiles', array(
	'attributes'     			=> array(
		'align'			        => array(
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

	'render_callback' => 'gbt_18_tr_social_media_frontend_output',
) );

//==============================================================================
//  Frontend Output
//==============================================================================
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

function gbt_18_tr_social_media_frontend_output($attributes) {

	global $theretailer_theme_options;

	extract(shortcode_atts(
		array(
			'align' => 'left',
            'fontSize'    => '24',
            'fontColor'   => '#000',
		), $attributes));
    ob_start();

    $socials = get_tr_social_media_icons();

?>

    <div class="gbt_18_tr_social_media_profiles">
        <div class="gbt_18_tr_social_media_icons site-social-icons-shortcode">
            <ul class="gbt_18_tr_profiles <?php echo esc_html($align); ?>">

                <?php foreach($socials as $social) : ?>
                	<?php if ( (isset($theretailer_theme_options[$social['link']])) && (trim($theretailer_theme_options[$social['link']]) != "" ) ) : ?>
                		<li>
                            <a style="color:<?php echo $fontColor; ?>;font-size:<?php echo $fontSize; ?>px;" 
                                class="social_media <?php echo $social['link']; ?>" 
                                target="_blank" 
                                href="<?php echo esc_url($theretailer_theme_options[$social['link']]); ?>" >
                                <i class="<?php echo $social['icon']; ?>"></i>
                            </a>
                        </li>
                	<?php endif; ?>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>

    <?php 
	return ob_get_clean();
}