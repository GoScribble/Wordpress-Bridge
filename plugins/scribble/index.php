<?php

/*
Plugin Name: Scribble Bridge
Plugin URI: https://github.com/GoScribble/WordpressBridge
Description: Bridge's with Scribble to allow the creation of posts on your Wordpress site.
Version: 0.1
Author: Scribble Bridge
Author URI: https://github.com/GoScribble
*/

// Add rewrite rule and flush on plugin activation
register_activation_hook( __FILE__, 'wp_scribble_plu_activate' );
function wp_scribble_plu_activate() {
    wp_scribble_plu_rewrite();
    flush_rewrite_rules();
}
 
// Flush on plugin deactivation
register_deactivation_hook( __FILE__, 'wp_scribble_plu_deactivate' );
function wp_scribble_plu_deactivate() {
    flush_rewrite_rules();
}
 
// Create new rewrite rule
add_action( 'init', 'wp_scribble_plu_rewrite' );
function wp_scribble_plu_rewrite() {
    add_rewrite_rule( 'scribbleapi/?$', 'wp-content/plugins/scribble/api.php', 'top' );
}