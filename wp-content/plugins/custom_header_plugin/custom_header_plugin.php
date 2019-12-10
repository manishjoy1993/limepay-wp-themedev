<?php
/**
* Plugin Name: Custom Header Plugin
* Plugin URI: http://demo.limepay.com.au/wordpress_498/
* Description: Plugin to add top-header-item to the Header.
* Version: 1.0
* Author: Limepay
* Author URI: http://demo.limepay.com.au/wordpress_498/
**/

function pluginprefix_setup_post_type() {
    // register the "book" custom post type
    register_post_type( 'book', ['public' => 'true'] );
}
add_action( 'init', 'pluginprefix_setup_post_type' );
 
function pluginprefix_install() {
    // trigger our function that registers the custom post type
    pluginprefix_setup_post_type();
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pluginprefix_install' );

function pluginprefix_deactivation() {
    // unregister the post type, so the rules are no longer in memory
    unregister_post_type( 'book' );
    // clear the permalinks to remove our post type's rules from the database
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

function custom_css() {
    wp_enqueue_style( 'custon_head_plugin', plugins_url( "style.css", __FILE__ ));
    // wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'custom_css' );



/* Describe what the code snippet does so you can remember later on */
add_action('wp_head', 'top_header_function');

function top_header_function(){

include_once( 'header/header-top.php' );
// get_template_part( 'header/header-top' );
// echo "custom header";

}