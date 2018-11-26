<?php

/**
 * Plugin Name:       		The Retailer Extender
 * Plugin URI:        		https://github.com/getbowtied/the-retailer-extender
 * Description:       		Extends the functionality of The Retailer with Gutenberg elements.
 * Version:           		1.0
 * Author:            		GetBowtied
 * Author URI:        		https://getbowtied.com
 * Requires at least: 		4.9
 * Tested up to: 			4.9.8
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

add_action( 'init', 'github_mt_plugin_updater' );
function github_mt_plugin_updater() {

	include_once 'updater.php';

	define( 'WP_GITHUB_FORCE_UPDATE', true );

	if ( is_admin() ) {

		$config = array(
			'slug' 				 => plugin_basename(__FILE__),
			'proper_folder_name' => 'the-retailer-extender',
			'api_url' 			 => 'https://api.github.com/repos/getbowtied/the-retailer-extender',
			'raw_url' 			 => 'https://raw.github.com/getbowtied/the-retailer-extender/master',
			'github_url' 		 => 'https://github.com/getbowtied/the-retailer-extender',
			'zip_url' 			 => 'https://github.com/getbowtied/the-retailer-extender/zipball/master',
			'sslverify'			 => true,
			'requires'			 => '4.9',
			'tested'			 => '4.9.8',
			'readme'			 => 'README.txt',
			'access_token'		 => '',
		);

		//new WP_GitHub_Updater( $config );

	}
}

function gbt_tr_gutenberg_blocks() {

	$theme = wp_get_theme();
	if ( $theme->template != 'theretailer') {
		return;
	}

	if( is_plugin_active( 'gutenberg/gutenberg.php' ) || tr_is_wp_version('>=', '5.0-beta') ) {
		include_once 'includes/gbt-blocks/index.php';
	} else {
		add_action( 'admin_notices', 'tr_theme_warning' );
	}
}
add_action( 'init', 'gbt_tr_gutenberg_blocks' );

function tr_theme_warning() {

	echo '<div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">';
	echo '<p>The Retailer Extender is enabled but not effective. Please activate Gutenberg plugin in order to work.</p>';
	echo '</div>';
}

function tr_is_wp_version( $operator = '>', $version = '4.0' ) {

	global $wp_version;

	return version_compare( $wp_version, $version, $operator );
}
