<?php

/**
 * Plugin Name:       		The Retailer Extender
 * Plugin URI:        		https://theretailer-demo.getbowtied.com
 * Description:       		Extends the functionality of The Retailer with theme specific features.
 * Version:           		6.0.1
 * Author:            		Get Bowtied
 * Author URI:        		https://getbowtied.com
 * Requires at least: 		6.0
 * Tested up to: 			6.8
 *
 * @package  The Retailer Extender
 * @author   Get Bowtied
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require 'dashboard/inc/puc/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$plugin_update_checker = PucFactory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/the-retailer-extender/master/core/updater/assets/plugin.json',
	__FILE__,
	'the-retailer-extender'
);

if ( ! class_exists( 'TheRetailerExtender' ) ) :

	class TheRetailerExtender {

		private static $instance = null;
		private static $initialized = false;
		private $theme_slug;

		private function __construct() {
			// Empty constructor - initialization happens in init_instance
		}

		private function init_instance() {
			if (self::$initialized) {
				return;
			}

			if ( ! function_exists( 'is_plugin_active' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}
			
			$version = ( isset(get_plugin_data( __FILE__ )['Version']) && !empty(get_plugin_data( __FILE__ )['Version']) ) ? get_plugin_data( __FILE__ )['Version'] : '1.0';
			define ( 'TR_EXT_VERSION', $version );

			$theme = wp_get_theme();
			$parent_theme = $theme->parent();

			$this->theme_slug = 'theretailer';

			// Helpers
			include_once( 'includes/helpers/helpers.php' );

			// Vendor
			include_once( 'includes/vendor/enqueue.php' );

			if ($theme->template == 'theretailer') {

				//Widgets
				include_once( 'includes/widgets/social-media.php' );
				include_once( 'includes/widgets/recent-posts.php' );

				// Shortcodes
				include_once( 'includes/shortcodes/index.php' );

                // Customizer
    			include_once( dirname( __FILE__ ) . '/includes/customizer/repeater/class-tr-ext-repeater-control.php' );

				// Social Media
				include_once( 'includes/social-media/class-social-media.php' );

				// Addons
				if ( is_plugin_active( 'woocommerce/woocommerce.php') ) {
					include_once( 'includes/addons/class-wc-category-header-image.php' );
				}
			}

			// Gutenberg Blocks
			add_action( 'init', array( $this, 'gbt_tr_gutenberg_blocks' ) );

			if( $theme->template == 'theretailer' && ( $theme->version >= '2.12' || ( !empty($parent_theme) && $parent_theme->version >= '2.12' ) ) ) {

				// Custom Code Section
				include_once( 'includes/custom-code/class-custom-code.php' );

				// Social Sharing Buttons
				include_once( 'includes/social-sharing/class-social-sharing.php' );
			}

			// VC Templates
			add_action( 'plugins_loaded', function() {
				$theme = wp_get_theme();
				$parent_theme = $theme->parent();

				if ( defined(  'WPB_VC_VERSION' ) ) {

					if( $theme->version >= '2.12.1' || ( !empty($parent_theme) && $parent_theme->version >= '2.12.1' ) ) {

						// Modify and remove existing shortcodes from VC
						include_once('includes/wpbakery/custom_vc.php');

						// VC Templates
						$vc_templates_dir = dirname(__FILE__) . '/includes/wpbakery/vc_templates/';
						vc_set_shortcodes_templates_dir($vc_templates_dir);
					}
				}
			});

			if ( is_admin() || ( defined('WP_CLI') && WP_CLI ) ) {
				global $gbt_dashboard_params;
				$gbt_dashboard_params = array(
					'gbt_theme_slug' => $this->theme_slug,
				);
				include_once( dirname( __FILE__ ) . '/dashboard/index.php' );
			}

			self::$initialized = true;
		}

		public static function get_instance() {
			return self::init();
		}

		public static function init() {
			if (self::$instance === null) {
				self::$instance = new self();
				self::$instance->init_instance();
			}
			return self::$instance;
		}

		private function __clone() {}
		
		public function __wakeup() {
			throw new Exception("Cannot unserialize singleton");
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
	}
endif;

add_action( 'after_setup_theme', function() {
    TheRetailerExtender::init();
} );
