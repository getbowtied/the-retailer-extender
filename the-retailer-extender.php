<?php

/**
 * Plugin Name:       		The Retailer Extender
 * Plugin URI:        		https://theretailer.wp-theme.design/
 * Description:       		Extends the functionality of The Retailer with Gutenberg elements.
 * Version:           		1.2.2
 * Author:            		GetBowtied
 * Author URI:        		https://getbowtied.com
 * Requires at least: 		5.0
 * Tested up to: 			5.1
 *
 * @package  The Retailer Extender
 * @author   GetBowtied
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

require 'updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/the-retailer-extender/master/core/updater/assets/plugin.json',
	__FILE__,
	'the-retailer-extender'
);

if ( ! class_exists( 'TheRetailerExtender' ) ) :

	/**
	 * TheRetailerExtender class.
	*/
	class TheRetailerExtender {

		/**
		 * The single instance of the class.
		 *
		 * @var TheRetailerExtender
		*/
		protected static $_instance = null;

		/**
		 * TheRetailerExtender constructor.
		 *
		*/
		public function __construct() {

			$theme = wp_get_theme();
			$parent_theme = $theme->parent();

			// Helpers
			include_once( 'includes/helpers/helpers.php' );

			// Customizer
			include_once( 'includes/customizer/class/class-control-toggle.php' );

			// Vendor
			//include_once( 'includes/vendor/enqueue.php' );

			if( ( $theme->template == 'theretailer' && ( $theme->version >= '2.11.1' || ( !empty($parent_theme) && $parent_theme->version >= '2.11.1' ) ) ) || $theme->template != 'theretailer' ) {

				//Widgets
				include_once( 'includes/widgets/social-media.php' );
				include_once( 'includes/widgets/recent-posts.php' );

			// 	// Shortcodes
			// 	include_once( 'includes/shortcodes/index.php' );

				// Social Media
				include_once( 'includes/social-media/class-social-media.php' );

			// 	// Addons
			// 	if ( $theme->template == 'merchandiser' && is_plugin_active( 'woocommerce/woocommerce.php') ) { 
			// 		include_once( 'includes/addons/class-wc-category-header-image.php' );
			// 	}
			}

			// Gutenberg Blocks
			add_action( 'init', array( $this, 'gbt_tr_gutenberg_blocks' ) );

			// if( $theme->template == 'merchandiser' && ( $theme->version >= '1.9' || ( !empty($parent_theme) && $parent_theme->version >= '1.9' ) ) ) {

			// 	// Custom Code Section
			// 	include_once( 'includes/custom-code/class-custom-code.php' );

			// 	// Social Sharing Buttons
			// 	if ( is_plugin_active( 'woocommerce/woocommerce.php') ) { 
			// 		include_once( 'includes/social-sharing/class-social-sharing.php' );
			// 	}
			// }
		}

		/**
		 * Loads Gutenberg blocks
		 *
		 * @return void
		*/
		public function gbt_tr_gutenberg_blocks() {

			if( is_plugin_active( 'gutenberg/gutenberg.php' ) || tr_is_wp_version('>=', '5.0') ) {
				include_once 'includes/gbt-blocks/index.php';
			} else {
				add_action( 'admin_notices', 'tr_theme_warning' );
			}
		}

		/**
		 * Ensures only one instance of TheRetailerExtender is loaded or can be loaded.
		 *
		 * @return TheRetailerExtender
		*/
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
	}
endif;

$theretailer_extender = new TheRetailerExtender;