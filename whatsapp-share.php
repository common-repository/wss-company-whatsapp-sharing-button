<?php
/*
Plugin Name:  WSS Company WhatsApp Sharing Button
Plugin URI: https://www.wss.com.ve/whatsapp-share-plugin-para-wordpress/
Description:  Add button of WhatsApp on your post and more, also it includes a "shortcode".
Version:      1.0.3
Text Domain: wss-company-whatsapp-sharing-button
Author: WSS Company, C.A.
Author URI: https://www.wss.com.ve
License: GPL v3 

*/
if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) )
	require 'class-admin.php';
else
	require 'class-frontend.php';
load_plugin_textdomain('wss-company-whatsapp-sharing-button', false, basename( dirname( __FILE__ ) ) . '/languages' );
// Add settings link on plugin page
function wss_link( $links ) {
	$settings_link = '<a href="options-general.php?page=wa_btn">' . esc_html__('Configuration','wss-company-whatsapp-sharing-button') . '</a>';
	array_unshift( $links, $settings_link );
	return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'wss_link' );


add_action( 'admin_enqueue_scripts', 'wss_enqueue_color_picker' );
function wss_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wss-script-handle', plugins_url('js/wss-script.min.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
?>
