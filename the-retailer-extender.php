<?php

/**
 * Plugin Name:       		The Retailer Extender
 * Plugin URI:        		https://github.com/getbowtied/the-retailer-extender
 * Description:       		Extends the functionality of The Retailer with Gutenberg elements.
 * Version:           		1.2.1
 * Author:            		GetBowtied
 * Author URI:        		https://getbowtied.com
 * Requires at least: 		5.0
 * Tested up to: 			5.0.3
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

global $theme;
$theme = wp_get_theme();

require 'core/updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/the-retailer-extender/master/core/updater/assets/plugin.json',
	__FILE__,
	'the-retailer-extender'
);

add_action( 'init', 'gbt_tr_gutenberg_blocks' );
if(!function_exists('gbt_tr_gutenberg_blocks')) {
	function gbt_tr_gutenberg_blocks() {

		if( is_plugin_active( 'gutenberg/gutenberg.php' ) || tr_is_wp_version('>=', '5.0') ) {
			include_once 'includes/gbt-blocks/index.php';
		} else {
			add_action( 'admin_notices', 'tr_theme_warning' );
		}
	}
}

if( !function_exists('tr_theme_warning') ) {
	function tr_theme_warning() {

		?>

		<div class="error">
			<p>The Retailer Extender plugin couldn't find the Block Editor (Gutenberg) on this site. It requires WordPress 5+ or Gutenberg installed as a plugin.</p>
		</div>

		<?php
	}
}

if( !function_exists('tr_is_wp_version') ) {
	function tr_is_wp_version( $operator = '>', $version = '4.0' ) {

		global $wp_version;

		return version_compare( $wp_version, $version, $operator );
	}
}
