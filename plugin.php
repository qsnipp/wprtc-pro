<?php
/**
 * Plugin Name:				wpRTC Pro - WebRTC for WordPress
 * Plugin URI:				https://wordpress.org/plugins/wprtc-real-time-video-for-wp/
 * Description:				This plugin will allow you to easily create peer-to-peer video chats
 * Version:						1.1.1
 * Author:						Roy Sivan
 * Author URI:				http://roysivan.com
 * Text Domain:				wprtc
 * License:						GPL-2.0+
 * License URI:				http://www.gnu.org/licenses/gpl-2.0.txt
 */

require_once('includes/settings.php');
require_once('includes/licensing.php');
require_once('includes/shortcode.php');


define('WordPressWebRTC', '1.1.1');

class WordPressWebRTC {
	function WordPressWebRTC(){
		global $wpdb;

		add_shortcode( 'wpRTC', 'webRTCsc' );
		add_action( 'admin_menu', 'wprtc_menu' );
		add_action( 'admin_enqueue_scripts', array( $this, 'adminSettings' ) );
		add_action('wp_enqueue_scripts' , array( $this, 'wprtcCSS' ) );

		new pluginLicense();
	}

	function adminSettings( $hook_suffix ) {
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script('jquery-ui-tabs');
	    wp_enqueue_script( 'my-script-handle', plugin_dir_url( __FILE__ ).'includes/js/wpRTCadmin.js', array( 'wp-color-picker' ), false, true );

	    wp_enqueue_style('tab-ui', plugin_dir_url( __FILE__ ).'includes/css/jquery-ui-1.10.4.custom.min.css', null, false);
	    wp_enqueue_style('wpRTCcss', plugin_dir_url( __FILE__ ).'includes/css/wprtc.css', null, false);
	}

	function wprtcCSS(){
		wp_enqueue_style('wpRTCcss', plugin_dir_url( __FILE__ ).'includes/css/wprtc.css', null, false);
	}
}

new WordPressWebRTC();
?>
